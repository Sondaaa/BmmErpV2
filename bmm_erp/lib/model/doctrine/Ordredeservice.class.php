<?php

/**
 * Ordredeservice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Ordredeservice extends BaseOrdredeservice {

    public function CreeOS($idlot, $idtype) {
        $ios = new Ordredeservice();
        if ($idtype == 1) {
            $iosc = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaireAndIdType($idlot, $idtype);
            if ($iosc)
                $ios = $iosc;
            else {
                $ios->setDateios(date("Y-m-d"));
            }
        }
        if ($idtype == 4) {
            $osarret = Doctrine_Core::getTable('ordredeservice')->findByIdBenificaireAndIdType($idlot, 4);
            if (count($osarret) <= 0) {
                $iosc = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaireAndIdType($idlot, 1);
                if ($ios)
                    $ios->setDateios($iosc->getDateios());
            }else {
                $osreprise = Doctrine_Core::getTable('ordredeservice')
                                ->createQuery('a')->where('id_benificaire=' . $idlot)
                                ->andwhere('id_type=5')
                                ->orderBy('id asc')->execute();
                //  Doctrine_Core::getTable('ordredeservice')->findByIdBenificaireAndIdType($idlot, 5);
                if (count($osreprise) > 0)
                    $ios->setDateios($osreprise[count($osreprise) - 1]->getDateios());
            }
        }
        if ($idtype == 5) {

            $osarret = Doctrine_Core::getTable('ordredeservice')
                            ->createQuery('a')->where('id_benificaire=' . $idlot)
                            ->andwhere('id_type=4')
                            ->orderBy('id asc')->execute();
            if (count($osarret) > 0)
                $ios->setDateios($osarret[count($osarret) - 1]->getDateios());
        }
        $ios->setIdBenificaire($idlot);
        $ios->setIdType($idtype); //type commesement du travaux
        $ios->save();
        return $ios;
    }

//    public function CreeOSDelai($idlot, $idtype) {
//        $ios = new Ordredeservice();
//        $iosc = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaire($idlot);
//        if ($iosc)
//            $ios = $iosc;
//        else {
//            $ios->setDateios(date("Y-m-d"));
//        }
//        $ios->setIdBenificaire($idlot);
//        $ios->setIdType($idtype); //type commesement du travaux
//        $ios->save();
//        return $ios;
//    }

    public function CreeAvenenatTypedate($idlot) {
        $ios = new Ordredeservice();
        $iosc = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaireAndIdType($idlot, 3);
        if ($iosc)
            $ios = $iosc;
        else {
            $ios->setDateios(date("Y-m-d"));
        }
        $ios->setIdBenificaire($idlot);
        $ios->setIdType(3); //type commesement du travaux
        $ios->save();

        return $ios;
    }

    public function CreeAvenenatTypedate2($idlot) {
        $ios = new Ordredeservice();
        $iosc = Doctrine_Core::getTable('ordredeservice')->findOneByIdBenificaireAndIdType($idlot, 2);
        if ($iosc)
            $ios = $iosc;
        else {
            $ios->setDateios(date("Y-m-d"));
        }
        $ios->setIdBenificaire($idlot);
        $ios->setIdType(2); //type commesement du travaux
        $ios->save();

        return $ios;
    }

    public function ReadHtmlOs($id) {
        $ordre = OrdredeserviceTable::getInstance()->find($id);
        $lot = $ordre->getLots();
        $marche = Doctrine_Core::getTable('marches')->findOneById($lot->getIdMarche());

        $html = '<div class="titre"><h3 style="font-size:18px;">O.S ' . $ordre->getTypeios() . ' - Le ' . date('d/m/Y', strtotime($ordre->getDateios())) .
                '<br>Bénéficiaire : ' . $lot->getFournisseur() .
                '<br>Marchés : ' . $lot->getMarches() . ' - Projet : ' . $marche->getProjet() . '</h3></div>';

        $html.='<h4><span style="color:#000; font-size:16px;">Bénéficiaire :</span></h4>
                <h5><span style="color:#000; font-size:14px;">Information Bénéficiaire : ' . $lot->getFournisseur() . '</span></h5>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="width: 20%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>N°Ordre</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getNordre() . '</span></td>
                            <td style="width: 13%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Marchés</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getMarches() . '</span></td>
                            <td style="width: 10%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Fournisseur</b></span></td>
                            <td style="width: 25%"><span style="color:#000">' . $lot->getFournisseur() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TOTAL GENERAL HTVA</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalht(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TVA</b></span></td>
                            <td><span style="color:#000">' . $lot->getTva() . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>RABAIS</b></span></td>
                            <td><span style="color:#000">' . $lot->getRrr() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>T. G. HTVA APRES RABAIS</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalapresrrr(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Net à payer TTC</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTtcnet(), 3, ".", ",") . '</span></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; height: 50px; background-color:#DEDEDE;"><span style="color:#000"><b>Objet</b></span></td>
                            <td style="text-align:justify;" colspan="5"><span style="color:#000">' . $lot->getObjet() . '</span></td>
                        </tr>
                    </tbody>
                </table>';

        $dateaction = "";
        if ($ordre->getIdType() == "1")
            $dateaction = "Commencement";
        if ($ordre->getIdType() == "4")
            $dateaction = "d'arrêt";
        if ($ordre->getIdType() == "5")
            $dateaction = "Reprise";

        $html.='<h4><span style="color:#000; font-size:16px;">Information O.S :</span></h4>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="width: 25%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Type O.S</b></span></td>
                            <td style="width: 25%"><span style="color:#000">' . $ordre->getTypeios() . '</span></td>
                            <td style="width: 25%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Date ' . $dateaction . '</b></span></td>
                            <td style="width: 25%"><span style="color:#000">' . date('d/m/Y', strtotime($ordre->getDateios())) . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Objet</b></span></td>
                            <td style="text-align:justify;" colspan="3"><span style="color:#000">' . $ordre->getObject() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Référence</b></span></td>
                            <td style="text-align:justify;" colspan="3"><span style="color:#000">' . $ordre->getReferece() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; height: 50px; background-color:#DEDEDE;"><span style="color:#000"><b>Description</b></span></td>
                            <td style="text-align:justify;" colspan="3"><span style="color:#000">' . $ordre->getDescription() . '</span></td>
                        </tr>
                    </tbody>
                </table>';

        return $html;
    }

}
