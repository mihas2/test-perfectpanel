<?php


namespace Manager;


use Entity\ConvertEntity;
use Entity\CurrencyEntity;
use Exception\NotfoundException;
use Service\BlockchainInfo\BlockchainInfoService;

/**
 * Class BlockchainManager
 * @package Manager
 */
class CurrencyManager
{
    private float $tax;
    private BlockchainInfoService $service;

    /**
     * @var CurrencyEntity[]
     */
    static ?array $result;

    /**
     * BlockchainManager constructor.
     */
    public function __construct()
    {
        $this->service = new BlockchainInfoService();
        $this->tax = (float)getenv('TAX');
        static::$result = null;
    }

    /**
     * @return CurrencyEntity
     */
    private function getBTC()
    {
        $btc = new CurrencyEntity();
        $btc->setSymbol('BTC');
        $btc->setSell(1);
        $btc->setBuy(1);
        $btc->setLast(1);

        return $btc;
    }

    /**
     * @return CurrencyEntity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function get()
    {
        if (!static::$result) {
            static::$result = $this->service->get();

            $btc = $this->getBTC();
            static::$result[$btc->getSymbol()] = $btc;
        }

        return static::$result;
    }

    /**
     * @param float $price
     * @return float
     */
    private function toTax(float $price)
    {
        return $price * $this->tax + $price;
    }

    /**
     * @return CurrencyEntity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll()
    {
        $resultCurrency = array_map(
            function ($curr) {
                $curr->setBuy($this->toTax($curr->getBuy()));
                $curr->setSell($this->toTax($curr->getSell()));
                $curr->setLast($this->toTax($curr->getSell()));

                return $curr;
            },
            $this->get()
        );

        uasort($resultCurrency, fn($a, $b) => $a->getSell() > $b->getSell());

        return $resultCurrency;
    }

    /**
     * @param string $symbol
     * @return CurrencyEntity
     * @throws NotfoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBy(string $symbol): CurrencyEntity
    {
        $coins = $this->getAll();
        if (!$coins[$symbol]) {
            throw new NotfoundException();
        }

        return $coins[$symbol];
    }

    public function convert(string $from, string $to, float $amount, int $round = 10)
    {
        $fromCoin = $this->getBy($from);
        $toCoin = $this->getBy($to);

        $convert = new ConvertEntity();

        $convert->setCurrencyFrom($fromCoin->getSymbol());
        $convert->setCurrencyTo($toCoin->getSymbol());
        $convert->setValue($amount);
        $convert->setConvertedValue($amount);
        $convert->setRate(round($toCoin->getSell() / $fromCoin->getSell() * $amount, $round));

        return $convert;
    }
}
