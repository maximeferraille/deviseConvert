<?php

require_once __DIR__ . '/vendor/autoload.php';

// Pouvoir effectuer des additions, multiplications avec des motants exprimés
// dans des devises diverses et avoir multi devises comme
// montré ici

use Devise\Calcul;
use Devise\Price;

$calc = new Calcul();
$calc->add(new Price(69.99, "USD"));
$calc->add($calc->mult(2, new Price(21.4,"HKD"))); // 21.4 x 2 HKD ~= 4.8e (selon le taux du jour)
$calc->convertAmmount($calc->ammount, "SEK"); // entre et 650 et 710 selon le taux du jour

var_dump($calc);