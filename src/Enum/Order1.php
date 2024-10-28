<?php
namespace App\Enum;

enum Order1: string
{
    case  preparation = "En_préparation";
    case  expediee = "expédiée";
    case livree = "livrée";
    case annule = "annulée";
}