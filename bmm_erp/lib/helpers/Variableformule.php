<?php

class Variableformule {

    public static function getVariable() {
        return $array = array("0" => array("0" => "", "1" => ""),
            "1" => array("0" => "Mnt", "1" => "Mnt : Montant"),
            "2" => array("0" => "Njm", "1" => "Njm : Nbr de Jours / Mois"),
            "3" => array("0" => "Njmm", "1" => "Njmm : Nbr de Jours Moyen / Mois"),
            "4" => array("0" => "Njmm", "1" => "Njmm : Nbr de Jours Moyen / Mois"),
            "5" => array("0" => "Njt", "1" => "Njt : Nbr de Jours Travaillés"),
            "6" => array("0" => "Njc", "1" => "Njc : Nbr de Jours Congé / Mois"),
            "7" => array("0" => "Njf", "1" => "Njf : Nbr de Jours Férié / Mois"),
            "8" => array("0" => "Nhm", "1" => "Nhm : Nbr d'Heures Travaillées"),
            "9" => array("0" => "Nhc", "1" => "Nhc : Nbr d'Heures Congé / Mois"),
            "10" => array("0" => "SB", "1" => "SB : Salaire de Base"),
            "11" => array("0" => "Brut", "1" => "Brut : Salaire Brut")
        );
    }

    public static function getOperateur() {
        return $array = array("0" => "", "1" => "+",
            "2" => "-",
            "3" => "*",
            "4" => "/"
        );
    }

}

?>