<?php

class NumerotationSerie {

    public static function genererNumerotationMensuel($date_debut, $date_fin) {

        $m1 = date('m', strtotime($date_debut));
        $m2 = date('m', strtotime($date_fin));
        $y = date('Y', strtotime($date_fin));
        $numSerie = array();

        for ($i = $m1; $i <= $m2; $i++):
            $m = $i;

            $date_debut_mois = $y . '-' . $m . '-01';
            $date_fin_mois_1 = date('Y-m-d', strtotime("+1 month", strtotime($date_debut_mois)));
           
            $date_fin_mois = date('Y-m-d', strtotime("-1 day", strtotime($date_fin_mois_1)));

            if ($i != $m1 && $i < 10)
                $m = '0' . $m;
            $num_serie = array();
            $num_serie['prefix'] = date('y', strtotime($date_debut)) . $m;
            if ($i == $m1)
                $num_serie['datedebut'] = date('d/m/Y', strtotime($date_debut));
            else
                $num_serie['datedebut'] = date('d/m/Y', strtotime($date_debut_mois));
            if ($i == $m2)
                $num_serie['datefin'] = date('d/m/Y', strtotime($date_fin));
            else
                $num_serie['datefin'] = date('d/m/Y', strtotime($date_fin_mois));            
            $num_serie['numdebut'] = '001';
            $num_serie['numfin'] = '001';
            $num_serie['attendu'] = '001';
            $num_serie['bloque'] = '0';

            array_push($numSerie, $num_serie);
//            die($num_serie['datefin']);
        endfor;

        return $numSerie;
    }

    public static function genererNumerotationAnnuel($date_debut, $date_fin) {
        $num_serie = array();
//die($date_debut.'-'.$date_fin);
        $num_serie['prefix'] = date('Y', strtotime($date_debut));
        $num_serie['datedebut'] = $date_debut;
        $num_serie['datefin'] = $date_fin;
        $num_serie['numdebut'] = '001';
        $num_serie['numfin'] = '001';
        $num_serie['attendu'] = '001';
        $num_serie['bloque'] = '0';
//die($num_serie['datefin'] .'-'. $num_serie['datedebut']);
        return $num_serie;
    }

}

?>
