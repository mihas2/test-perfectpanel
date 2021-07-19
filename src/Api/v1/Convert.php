<?php


namespace Api\v1;


use Api\ApiAbstract;
use Entity\ConvertEntity;
use GuzzleHttp\Exception\GuzzleException;
use Manager\CurrencyManager;

class Convert extends ApiAbstract
{
    /**
     * Usage http://localhost/v1/convert/
     *
     * @param string $currency_from
     * @param string $currency_to
     * @param float $value
     * @access protected
     * @return array
     */
    public function postIndex(string $currency_from, string $currency_to, float $value = 1)
    {
        try {
            $currency = new CurrencyManager();
            $converted = $currency->convert($currency_from, $currency_to, $value);
        } catch (\Exception | GuzzleException $e) {
            return $this->error('invalid token');
        }

        return $this->success($converted);
    }
}
