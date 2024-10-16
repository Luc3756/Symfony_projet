<?php
namespace App\Enum;

enum Status: string
{
    case  dispo = "Disponible";
    case  rupture = "En_rupture";
    case precommande = "Précommande";
}