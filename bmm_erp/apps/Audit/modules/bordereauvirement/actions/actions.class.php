<?php

require_once dirname(__FILE__) . '/../lib/bordereauvirementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/bordereauvirementGeneratorHelper.class.php';

/**
 * bordereauvirement actions.
 *
 * @package    Bmm
 * @subpackage bordereauvirement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bordereauvirementActions extends autoBordereauvirementActions {

    public function executeSave(sfWebRequest $request) {
        $id_banque = $request->getParameter('id_banque');
        $id_type = $request->getParameter('id_type');
        $id_nature = $request->getParameter('id_nature');
        $total = $request->getParameter('total');

        $bordereau = new Bordereauvirement();

        $bordereau->setDate(date('Y-m-d'));
        $bordereau->setIdCompte($id_banque);
        $bordereau->setIdNaturecompte($id_nature);
        $bordereau->setIdTypeoperation($id_type);
        $bordereau->setTotal($total);
        $bordereau->setValide(false);

        $bordereau->save();

        $ids = $request->getParameter('ids');
        $this->ids = $ids;
        $ids = substr($ids, 0, -1);
        $ids = explode(',', $ids);

        $mouvements = MouvementbanciareTable::getInstance()->getByListeId($ids);
        foreach ($mouvements as $mvt) {
            $mvt->setIdBordereauvirement($bordereau->getId());
            $mvt->save();
        }

        return $this->renderText($bordereau->getId());
    }

    public function executeGetOrderVirement(sfWebRequest $request) {
        $this->ordre_virement = PapierordrepostalTable::getInstance()->getFirstOrderVierge($request->getParameter('id_banque'));
    }

    public function executeValider(sfWebRequest $request) {
        $bordereau = BordereauvirementTable::getInstance()->find($request->getParameter('id_bordereau'));
        $bordereau->setIdPapierordrepostal($request->getParameter('id_papierordre'));
        $bordereau->setValide(true);
        $bordereau->save();

        $papier_ordre_postal = PapierordrepostalTable::getInstance()->find($request->getParameter('id_papierordre'));

        $papier_ordre_postal->setMnt($bordereau->getTotal());
        $papier_ordre_postal->setDatesignature($bordereau->getDate());
        $papier_ordre_postal->setEtat(true);
        $papier_ordre_postal->setObjet($request->getParameter('objet'));
        $papier_ordre_postal->setCible($request->getParameter('cible'));

        $papier_ordre_postal->save();
    }

    public function executeImprimerBordereau(sfWebRequest $request) {
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $id = $request->getParameter('id');

        $pdf = new sfTCPDF('L');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Bordereau');
        $pdf->SetSubject("Bordereau");
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
       $soc = $societe;
        $entete =  $soc->getMinistere();
        $rs=$soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete),strtoupper($rs), '', '');

//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), '', '');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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
        $html = $this->ReadHtmlBordereau($id);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bordereau.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlBordereau($id) {
        $html = StyleCssHeader::header1();
        $bordereau = new Bordereauvirement();
        $html .= $bordereau->ReadHtmlBordereau($id);
        return $html;
    }

    public function executeShow(sfWebRequest $request) {
        $this->bordereau = BordereauvirementTable::getInstance()->find($request->getParameter('id_bordereau'));
        $this->societe = SocieteTable::getInstance()->findAll()->getFirst();
    }

    public function executeDelete(sfWebRequest $request) {
        $bordereau = BordereauvirementTable::getInstance()->find($request->getParameter('id_bordereau'));
        foreach ($bordereau->getMouvementbanciare() as $mvt) {
            $mvt->setIdBordereauvirement(NULL);
            $mvt->save();
        }
        $bordereau->delete();

        die('OK');
    }

}
