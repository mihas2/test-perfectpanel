<?php


namespace Api\v1;


use Api\ApiAbstract;
use GuzzleHttp\Exception\GuzzleException;
use Manager\CurrencyManager;

class Rates extends ApiAbstract
{
    /**
     * Usage: http://localhost/v1/rates/
     *
     * @access protected
     * @return array
     */
    public function getIndex()
    {
        try {
            $currency = new CurrencyManager();
            $coins = $currency->getAll();
        } catch (\Exception | GuzzleException $e) {
            return $this->error('invalid token');
        }

        return $this->success($coins);
    }
}
