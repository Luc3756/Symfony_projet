<?php
namespace App\Enum;

enum Status: string
{
    case  dispo = "Disponible";
    case  rupture = "En_rupture";
    case precommande = "Précommande";

    public function toString(){
        return match($this){
            self::dispo=>"Disponible",
            self::rupture=>"En_rupture",
            self::precommande=>"Précommande"
        };
}

}

