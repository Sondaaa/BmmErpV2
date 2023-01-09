<?php

require_once dirname(__FILE__) . '/../lib/parcourcourierGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/parcourcourierGeneratorHelper.class.php';

/**
 * parcourcourier actions.
 *
 * @package    Bmm
 * @subpackage parcourcourier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parcourcourierActions extends autoParcourcourierActions {

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $id_user =  $this->getUser()->getAttribute('userB2m')->getId();
       
        if ($this->getFilters()['id_user'] != '') {
            $this->getFilters()['id_user'] = $id_user;
        }
        
//        $query = "FROM Parcourcourier r, courier c WHERE r.id_courier = c.id AND c.id_user = " . $id_user . " AND r.id_user = " . $id_user;

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        
//        $query = "FROM Parcourcourier r, courier c WHERE r.id_courier = c.id AND c.id_user = " . $id_user . " AND r.datecreation >= ? AND r.datecreation <= ? AND r.id_exp = ? AND r.id_rec = ? AND r.id_action = ? AND r.id_courier = ? AND r.id_user = " . $id_user . " AND r.id_typecourrier = ? ";
//        print $query;
        return $query;
    }
   public function executeImprimerlistecourrier(sfWebRequest $request) {
//        if($request->getParameter('arraycourrier'))
//            die($request->getParameter('arraycourrier'));
        $config = sfTCPDFPluginConfigHandler::loadConfig();

        $pdf = new sfTCPDF();

        $pdf->SetTitle('Mouvement des courriers');
        $pdf->SetSubject("Liste des courriers par utilisateur");

//         $image_file =  '../../../uploads/' . $societe->getLogo();
//        $pdf->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($entete), strtoupper($rs), '', '');

        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, strtoupper($societe), PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(10, 30, 10);
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

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // dejavusans or times to reduce file size.
//        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetFont('aefurat', '', 10);
//        $pdf->SetFont('aealarabiya', '', 10);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $html = $this->ReadHtmlListesCourrier($request);

        // Print text using writeHTMLCell()
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('ListesCourrier' . '.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListesCourrier(sfWebRequest $request) {
        $html = '<style>
    h3 {
        font-family: times;
        font-size: 12pt;
        text-align: center;
    }
    span {
        font-family: times;
        font-size: 10pt;
    }
    h6 {
        font-family: times;
        font-size: 9pt;
    }
    .tableclass{
        width: 750px;
        padding-left: 59%;
        margin-top: -6%;
    }
    .tableclass td {
        border: 2px solid #000;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
     .tableligne{
        padding: 1px;
        border: 1px solid #000;
        
    }
    .tableclass{
 border: 1px dashed #000000 ;
 padding: 5px;
}
.tableligne{
padding: 5px;
}
    .tableligne td{
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
} 
 .tableclass  th{
     
      border: 1px solid #000;
      font-weight: bold;
      font-size: 9pt;
      text-align: center;
} 
.tableligne th{
      border: 1px solid #000;
      font-weight: bold;
      font-size: 9pt;
      text-align: center;
} 
.tableclass td{
      text-align: justify;
      border: 1px solid #000;
}
body{
border: 1px solid #000;
}
.secondtd{
 background-color: #fff;
}
.fersttd{
 background-color: #f6f8f4;
}
td{
padding: 1%;
}
</style>';
        
        $mv_courrier = new Parcourcourier();
        $parcourcourriers = Doctrine_Core::getTable('parcourcourier')
                ->createQuery('a');
        
        $datecreation = "";
        if ($request->getParameter('datecreation'))
            $datecreation = $request->getParameter('datecreation');
        $datedebut = "";
        if ($request->getParameter('datecreationfrom')) {
            $datedebut = $request->getParameter('datecreationfrom');
            $parcourcourriers = $parcourcourriers->AndWhere("datecreation >='" . $datedebut . "'");
        }
        $datefin = "";
        if ($request->getParameter('datecreationto')) {
            $datefin = date('Y-m-d', strtotime($request->getParameter('datecreationto')));
            $parcourcourriers = $parcourcourriers->AndWhere("datecreation <='" . $datefin . "'");
        }
        $action = "";
        if ($request->getParameter('id_action')) {
            $action = Doctrine_Core::getTable('actionparcour')->findOneById($request->getParameter('id_action'));
            $parcourcourriers = $parcourcourriers->AndWhere("id_action=" . $request->getParameter('id_action'));
        }
        $expediteur = "";
        if ($request->getParameter('id_exp')) {
            $expediteur = Doctrine_Core::getTable('expdest')->findOneById($request->getParameter('id_exp'));
            $parcourcourriers = $parcourcourriers->AndWhere("id_exp=" . $request->getParameter('id_exp'));
        }
        $destination = "";
        if ($request->getParameter('id_dest')) {
            $destination = Doctrine_Core::getTable('expdest')->findOneById($request->getParameter('id_dest'));
            $parcourcourriers = $parcourcourriers->AndWhere("id_dest=" . $request->getParameter('id_dest'));
        }
        $utilisateur = "";
        if ($request->getParameter('id_user')) {
            $utilisateur = Doctrine_Core::getTable('utilisateur')->findOneById($request->getParameter('id_user'));
            $parcourcourriers = $parcourcourriers->AndWhere("id_user=" . $request->getParameter('id_user'));
        }
        $courrier = "";
        if ($request->getParameter('id_courier')) {
            $courrier = Doctrine_Core::getTable('courrier')->findOneById($request->getParameter('id_courier'));
            $array = $courrier->RecursiveCourrier();
            $parcourcourriers = $parcourcourriers->OrWhereIn('id_courrierdest', $array);
        }
        if ($request->getParameter('id_typecourrier')) {
            $parcourcourriers = $parcourcourriers->Andwhere('id_typecourrier=' . $request->getParameter('id_typecourrier'));
        }
       
        $html.='<div class="contenue">
                    <div class="titre"><h3 style="font-size:20px;">Mouvement des courriers</h3></div>
                    <div> 
                        <table style="width:100%;" class="tablecontenue">
                            <tr>
                                <td style="width:25%;font-weight:bold;"><span>Date</span></td> 
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $datedebut . ' ==>' . $datefin . '</p></td>
                            </tr>
                            <tr>
                                <td style="width:25%;font-weight:bold;"><span>Courrier</span></td>
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $courrier . '</p></td>
                            </tr>
                            <tr>
                                <td style="width:25%;font-weight:bold;"><span>Type d\'action</span></td>
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $action . '</p></td>
                            </tr>
                             <tr>
                                <td style="width:25%;font-weight:bold;"><span>Expéditeur</span></td>
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $expediteur . '</p></td>
                            </tr>
                             <tr>
                                <td style="width:25%;font-weight:bold;"><span>Destinataire</span></td>
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $destination . '</p></td>
                            </tr>
                            <tr>
                                <td style="width:25%;font-weight:bold;"><span>Utilisateur</span></td>
                                <td style="width:5%;font-weight:bold;">:</td>
                                <td style="width:70%"><p style="border-bottom: 1px dashed #000000;">' . $utilisateur . '</p></td>
                            </tr>
                        </table>
                    </div>';

        $html.= '<div>
                    <table cellpadding="3">
                        <tr>';
        $typecourriers = Doctrine_Core::getTable('typecourrier')->findAll();
        foreach ($typecourriers as $type) {
            $html.= '<td style="' . trim($type->getCoul()) . ';height:25x;">' . $type . '</td>';
        }

        $html.='</tr></table>
            </div>';

        $html.='<div class="tableligne">
                    <table cellpadding="3">
                        <tr>
                            <th style="width:25%;height:25px;font-weight:bold;font-size:14px;">Détail Création</th>
                            <th style="width:35%;font-weight:bold;font-size:14px;">Détail Courrier</th>
                            <th style="width:40%;font-weight:bold;font-size:14px;">Détail Parcour</th>
                        </tr>';

        $parcourcourriers = $parcourcourriers->OrderBy('id Asc')->execute();
        foreach ($parcourcourriers as $par) {
            $mv_courrier = $par;
            $courrier_dest = Doctrine_Core::getTable('courrier')->findOneById($mv_courrier->getIdCourrierdest());
           
            $html.='  <tr style="' . $courrier_dest->getTypecourrier()->getCoul() . '">
                            <td><p>' . $mv_courrier->getDatecreationetdatemax1() . '</p></td>
                            <td><p>' . $mv_courrier->getCourrieretcourriersource1() . '</p></td>
                            <td><p>' . $mv_courrier->getExpdestinataire1() . '</p></td>
                        </tr>';
        }
        $html.='</table></div></div>';
        
        return $html;
    }

}
