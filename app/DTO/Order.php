<?php

namespace App\DTO;

class Order
{
    public function __construct(
        protected string $productType,
        public float $amount,
        protected string $lang,
        public string $countryCode,
        protected string $userOs
    )
    {
    }

    /**
     * @return string
     */
    public function getProductType(): string
    {
        return $this->productType;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getUserOs(): string
    {
        return $this->userOs;
    }

}
