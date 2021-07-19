<?php


namespace Entity;


class CurrencyEntity
{
    /**
     * @var string
     */
    public string $symbol;

    /**
     * @var float
     */
    public float $buy;

    /**
     * @var float
     */
    public float $sell;

    /**
     * @var float
     */
    public float $last;

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @param float $buy
     */
    public function setBuy(float $buy): void
    {
        $this->buy = $buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @param float $sell
     */
    public function setSell(float $sell): void
    {
        $this->sell = $sell;
    }

    /**
     * @return float
     */
    public function getLast(): float
    {
        return $this->last;
    }

    /**
     * @param float $last
     */
    public function setLast(float $last): void
    {
        $this->last = $last;
    }

    /**
     * @param array $fields
     * @return static
     */
    public static function map(array $fields): self
    {
        $o = new static();

        $o->setSymbol((string)$fields['symbol']);
        $o->setSell((float)$fields['sell']);
        $o->setBuy((float)$fields['buy']);
        $o->setLast((float)$fields['last']);

        return $o;
    }
}
