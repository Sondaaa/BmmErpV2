<?php

/**
 * Ordredeservicecontratachat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Ordredeservicecontratachat extends BaseOrdredeservicecontratachat {

    public function CreeOS($idcontrat, $idtype, $iddocachat) {
        $ios = new Ordredeservicecontratachat();
        $contratachat = ContratachatTable::getInstance()->find($idcontrat);
        $id_frs = $contratachat->getIdFrs();
        if ($idtype == 1) {
            $iosc = Doctrine_Core::getTable('ordredeservicecontratachat')->findOneByIdContratAndIdType($idcontrat, $idtype);
            if ($iosc)
                $ios = $iosc;
            else {
                $ios->setDateios(date("Y-m-d"));
            }
        }
        if ($idtype == 4) {
            $osarret = Doctrine_Core::getTable('ordredeservicecontratachat')->findOneByIdContratAndIdType($idcontrat, 4);
            if (count($osarret) <= 0) {
                $iosc = Doctrine_Core::getTable('ordredeservicecontratachat')->findOneByIdContratAndIdType($idcontrat, 1);
                if ($ios)
                    $ios->setDateios($iosc->getDateios());
            }else {
                $osreprise = Doctrine_Core::getTable('ordredeservicecontratachat')
                                ->createQuery('a')->where('id_contrat=' . $idcontrat)
                                ->andwhere('id_type=5')
                                ->orderBy('id asc')->execute();
                //  Doctrine_Core::getTable('ordredeservice')->findByIdBenificaireAndIdType($idlot, 5);
                if (count($osreprise) > 0)
                    $ios->setDateios($osreprise[count($osreprise) - 1]->getDateios());
            }
        }
        if ($idtype == 5) {

            $osarret = Doctrine_Core::getTable('ordredeservicecontratachat')
                            ->createQuery('a')->where('id_contrat=' . $idcontrat)
                            ->andwhere('id_type=4')
                            ->orderBy('id asc')->execute();
            if (count($osarret) > 0)
                $ios->setDateios($osarret[count($osarret) - 1]->getDateios());
        }
        $ios->setIdContrat($idcontrat);
        $ios->setIdFrs($id_frs);
        $ios->setIdDocachat($iddocachat);
        $ios->setIdType($idtype); //type commesement du travaux
        $ios->save();
        return $ios;
    }

    public function ReadHtmlOs($id) {
        $ordre = OrdredeservicecontratachatTable::getInstance()->find($id);
        $contratachat = $ordre->getContratachat();
        $doc_achat = $ordre->getDocumentachat();
        $html = '<div class="titre"><h3 style="font-size:18px;">O.S ' . $ordre->getTypeios() . ' - Le ' . date('d/m/Y', strtotime($ordre->getDateios())) .
                '<br>B??n??ficiaire : ' . $contratachat->getFournisseur() .
                '<br>Contrat : ' . $contratachat->getReference() . ' - Projet : ' . $doc_achat->getProjet() . '</h3></div>';

       $html.='<h4><span style="color:#000; font-size:16px;">Fiche B??n??ficiaire :</span></h4>
                <h5><span style="color:#000; font-size:14px;">Information B??n??ficiaire : '
                . $contratachat->getFournisseur() . '</span></h5>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr><td><label>Fournisseur</label></td>
                        <td colspan="5">' . $contratachat->getFournisseur() . ' </td> </tr>
                        <tr><td><label>Contrat </label></td>
                        <td colspan="2">' . $contratachat->getReference()
                . '   N??: ' . $contratachat->getNumero() . ' </td>
                        <td><label>Document achat </label></td>
                        <td colspan="2">' . $doc_achat->getNumerodocumentachat() . '</td></tr>
                        <tr>
                        <td>Date de cr??ation</td>
                        <td style="text-align: cenetr" colspan="2">' . date('d/m/Y', strtotime($contratachat->getDatecreation())) . '</td>
                        <td>Date de Signature</td>
                        <td style="text-align: cenetr" colspan="2">';
        if ($contratachat->getDatesigntaure()):
            $html.= date('d/m/Y', strtotime($contratachat->getDatesigntaure()));
        endif;
        $html.='</td></tr><tr><td>Type</td> <td colspan="2" >';

        if ($contratachat->getType() == 0)
            $html.= 'Livraison Total ';
        else
            $html.= 'Livraison Partiel';
        $html.='</td><td>Date Fin</td><td colspan="2">';
        if ($contratachat->getDatefin()):

            $html.= date('d/m/Y', strtotime($contratachat->getDatefin()));
        endif;

        $html.='</td> </tr>
                    </tbody>
                </table>';


        $dateaction = "";
        if ($ordre->getIdType() == "1")
            $dateaction = "Commencement";
        if ($ordre->getIdType() == "4")
            $dateaction = "d'arr??t";
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
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>R??f??rence</b></span></td>
                            <td style="text-align:justify;" colspan="3"><span style="color:#000">' . $ordre->getReference() . '</span></td>
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
