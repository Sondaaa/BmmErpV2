<?php

/**
 * Detailprix
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Detailprix extends BaseDetailprix {

    public function getNumeroDcompte($idlots, $idfrs) {
        $query = "SELECT  COALESCE(MAX(detailprix.numero),1) as numero "
                . "FROM   detailprix,  lots "
                . "WHERE   detailprix.id_lots = lots.id "
                . "AND   lots.id_frs =" . $idfrs . " "
                . "AND lots.id=" . $idlots;
        //die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $ant = $conn->fetchArray($query);

        $somme = $ant[count($ant) - 1] + 1;
        return $somme;
    }

    public function CreesousdetailPrixDecompte($idlot) {
        $detail = new Detailprix();
        $details = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($idlot, 2);
        if ($details)
            $detail = $details;

        $listesSousdetails = $detail->getSousdetailprix();
        foreach ($listesSousdetails as $sd) {
            $this->RechercheSousDetailAndAjouter($sd);
        }
    }

    public function RechercheSousDetailAndAjouter($sousdetail_parent) {
        $sousdetail = new Sousdetailprix();
        $ssdetails = Doctrine_Core::getTable('sousdetailprix')
                        ->createQuery('a')->where('id_detail=' . $this->getId())
                        ->andWhere("nordre = " . $sousdetail_parent->getNordre())->execute();
        if (count($ssdetails) > 0) {
            $sousdetail = $ssdetails[count($ssdetails) - 1];
        } else {
            $sousdetail->setIdDetail($this->getId());
            $sousdetail->setDesignation($sousdetail_parent->getDesignation());
            $sousdetail->setNordre($sousdetail_parent->getNordre());
            if ($sousdetail_parent->getIdUnite())
                $sousdetail->setIdUnite($sousdetail_parent->getIdUnite());
            if ($sousdetail_parent->getIdSousdetail())
                $sousdetail->setIdSousdetail($sousdetail_parent->getIdSousdetail());
            if ($sousdetail_parent->getPrixthtva())
                $sousdetail->setPrixthtva($sousdetail_parent->getPrixthtva());
            if ($sousdetail_parent->getPrixunitaire())
                $sousdetail->setPrixunitaire($sousdetail_parent->getPrixunitaire());
            //$sousdetail->setQtecumule();
            // $sousdetail->setQtemois();
            if ($sousdetail_parent->getQuetiteant())
                $sousdetail->setQuetiteant($sousdetail_parent->getQuetiteant());
            $sousdetail->save();
        }
    }

    public function getMntAntirieur($idlot, $nordre) {
        $query = "SELECT   SUM(sousdetailprix.qtemois::numeric) as ant "
                . "FROM    detailprix,    lots,    sousdetailprix "
                . "WHERE    detailprix.id_lots = lots.id AND   sousdetailprix.id_detail = detailprix.id "
                . "AND   detailprix.id_typedetailprix = 4 AND    lots.id = " . $idlot . " "
                . "AND    sousdetailprix.nordre ='" . trim($nordre) . "' and detailprix.id!=" . $this->getId();
        // return $query;
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $ant = $conn->fetchArray($query);
        if (!$ant[count($ant) - 1])
            $somme = 0;
        else
            $somme = $ant[count($ant) - 1];
        return $somme;
    }

    public function AjouterDeponse($idlot) {
//        $query = "SELECT  COALESCE(SUM(detailprix.deponseantirieur::float + detailprix.netapayer::float),0) as ant"
        $query = "SELECT  COALESCE(SUM(detailprix.netapayer::float),0) as ant"
                . " FROM detailprix, lots "
                . " WHERE  detailprix.id_lots = lots.id  "
                . "AND detailprix.id_typedetailprix = 4 "
                . "AND lots.id =  " . $idlot . " ";

       // die($query);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $ant = $conn->fetchArray($query);
        if (!$ant[count($ant) - 1])
            $somme = 0;
        else
            $somme = $ant[count($ant) - 1];
        return $somme;
    }

    public function getDeponse_Antirieur($idlot) {

        $deponse = 0;

        if ($this->getDeponseantirieur()) {
            $deponse = $this->getDeponseantirieur();
        }
        return $deponse;
    }

}