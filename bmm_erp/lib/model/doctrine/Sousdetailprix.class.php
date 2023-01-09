<?php

/**
 * Sousdetailprix
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Sousdetailprix extends BaseSousdetailprix {

    public function getQteDuMois() {
        $qte = 0;
        if ($this->getQtemois())
            $qte = $this->getQtemois();
        return $qte;
    }

    public function getAncienQteDuMois($nordre) {
        if (!$this->getQtecumule()) {
            $query = "SELECT   SUM(sousdetailprix.qtemois::numeric) as ant "
                    . "FROM    detailprix,    sousdetailprix "
                    . "WHERE    detailprix.id = sousdetailprix.id_detail  "
                    . " and detailprix.id_lots=" . $this->getDetailprix()->getIdLots() . " "
                    . "and sousdetailprix.nordre ='" . $nordre . "'";
            //die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $ant = $conn->fetchArray($query);
            if (!$ant[count($ant) - 1])
                $somme = 0;
            else
                $somme = $ant[count($ant) - 1];
            return $somme;
        } else
            return $this->getQtecumule();
    }

}