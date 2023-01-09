<?php

require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorHelper.class.php';

/**
 * fournisseur actions.
 *
 * @package    Bmm
 * @subpackage fournisseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fournisseurActions extends autoFournisseurActions {
    
    //______________________________________________________________________Ajouter fournisseur
    public function executeAjoutfournisseur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $frs = strtoupper($params['frs']);
            $ref = strtoupper($params['ref']);
            if ($frs != "" || $ref != "") {
                $fournisseur = new Fournisseur();
                $q = Doctrine_Query::create()
                        ->select("*")
                        ->from('fournisseur');
                if ($frs != "")
                    $q = $q->where("rs like '%" . $frs . "%'");
                if ($ref != "")
                    $q = $q->where("reference like '%" . $ref . "%'");
                if ($frs != "" && $ref != "")
                    $q = $q->where("rs like '%" . $frs . "%'")
                            ->Orwhere("reference like '%" . $ref . "%'");
                //die($q);
                $frss = $q->execute();

                if (count($frss) > 0)
                    $fournisseur = $frss[0];
              //  die(count($frss).'---'.$q);
                $fournisseur->setRs($frs);
                $fournisseur->setReference($ref);
                $fournisseur->save();
                if (!$frss)
                    die('Succès d\'ajout');
                else
                    die('Mise à jour fiche fournisseur');
            }
        }
        die('Erreur d\'ajout');
    }

    public function executeValiderRib(sfWebRequest $request){
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['id_rib'];
            $id_frs = $params['id_frs'];
           
            $rib = RibbancaireTable::getInstance()->findOneById($id);
           if($rib){
            
            $frs=FournisseurTable::getInstance()->findOneById($id_frs);
            if($frs){
                $frs->setIdNaturecompte($rib->getNaturebanqueId());
                $frs->setIdBanque($rib->getBanqueId());
                $frs->setRib($rib->getRib());
                $frs->save();
            }
            return $this->renderText(json_encode(array('data'=>'ok')));
           }
           
        }
        return $this->renderText(json_encode(array('data'=>'')));
    }
    public function executeImprimerficheFournisseur(sfWebRequest $request)
    {
        $id_forunisseur = $request->getParameter('idfrs');
        $pdf = new sfTCPDF('L');
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Fiche Fournisseur');
        $pdf->SetSubject("Fiche Fournisseur");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(5, 30, 5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlFournisseur($id_forunisseur);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Fiche Fournisseur.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlFournisseur($id_forunisseur)
    {
        $html = StyleCssHeader::header1();
        $piece = new Fournisseur();
        $html .= $piece->ReadHtmlFournisseur($id_forunisseur);
        return $html;
    }
}
