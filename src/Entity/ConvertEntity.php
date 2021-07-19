<?php


namespace Entity;


class ConvertEntity implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $currencyFrom = '';

    /**
     * @var string
     */
    private string $currencyTo = '';

    /**
     * @var float
     */
    private float $value = 0;

    /**
     * @var float
     */
    private float $convertedValue = 0;

    /**
     * @var float
     */
    private float $rate = 0;

    /**
     * @return string
     */
    public function getCurrencyFrom(): string
    {
        return $this->currencyFrom;
    }

    /**
     * @param string $currencyFrom
     */
    public function setCurrencyFrom(string $currencyFrom): void
    {
        $this->currencyFrom = $currencyFrom;
    }

    /**
     * @return string
     */
    public function getCurrencyTo(): string
    {
        return $this->currencyTo;
    }

    /**
     * @param string $currencyTo
     */
    public function setCurrencyTo(string $currencyTo): void
    {
        $this->currencyTo = $currencyTo;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getConvertedValue(): float
    {
        return $this->convertedValue;
    }

    /**
     * @param float $convertedValue
     */
    public function setConvertedValue(float $convertedValue): void
    {
        $this->convertedValue = $convertedValue;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    public function jsonSerialize()
    {
        return [
            'currency_from' => $this->getCurrencyFrom(),
            'currency_to' => $this->getCurrencyTo(),
            'value' => $this->getValue(),
            'converted_value' => $this->getConvertedValue(),
            'rate' => $this->rate,
        ];
    }
}
