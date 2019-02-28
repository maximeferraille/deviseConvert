<?php

namespace Devise;

class Price
{
    private $ammount;
    private $devise;

    public function __construct($ammount, $devise)
    {
        $this->ammount = $ammount;
        $this->devise  = $devise;
    }

    public function setDevise($devise)
    {
        $this->devise = $devise;
    }

    public function setAmmount($ammount)
    {
        $this->ammount += $ammount;
    }

    public function getAmmount() { return $this->ammount; }
    public function getDevise(){ return $this->devise; }
}