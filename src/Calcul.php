<?php

namespace Devise;
use Devise\Price;

class Calcul
{
    private $currentRate = [];
    public  $ammount;

    public function __construct()
    {
        $this->setCurrentRate("EUR");
        $this->ammount = new Price(0, "EUR");
    }
    protected function setCurrentRate($devise)
    {
        $json  = file_get_contents('https://api.exchangeratesapi.io/latest?base='.$devise);
        $rates = json_decode($json, true);
        $rates['rates'] += [ $devise => round(1) ];
        return  $this->currentRate = $rates['rates'];
    }

    public function add(Price $price)
    {
        $this->ammount->setAmmount($this->convertAmmount($price));
    }

    public function mult($multiplier, Price $price)
    {
        return new Price(round($price->getAmmount()*$multiplier, 2), $price->getDevise());
    }

    public function convertAmmount(Price $price, $referer = NULL)
    {
        if (!is_null($referer)) {
            $this->setCurrentRate($referer);
        }

        $newAmmount = round($price->getAmmount() / $this->currentRate[$price->getDevise()], 2);

        if (!is_null($referer)) {
            $this->ammount->setDevise($referer);
            $this->ammount->setAmmount($newAmmount);
        }

        return $newAmmount;
    }
}