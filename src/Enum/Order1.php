<?php

namespace App\Enum;

enum Order1: string
{
    case preparation = "En_préparation";
    case expediee = "expédiée";
    case livree = "livrée";
    case annule = "annulée";

    public function toString(): string
    {
        return match($this) {
            self::preparation => "En préparation",
            self::expediee => "Expédiée",
            self::livree => "Livrée",
            self::annule => "Annulée",
        };
    }
}
