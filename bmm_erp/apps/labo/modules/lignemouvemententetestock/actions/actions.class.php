<?php

require_once dirname(__FILE__) . '/../lib/lignemouvemententetestockGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/lignemouvemententetestockGeneratorHelper.class.php';

/**
 * lignemouvemententetestock actions.
 *
 * @package    symfony
 * @subpackage lignemouvemententetestock
 * @author     Your name here
 * @version    SVN: $Id$
 */
class lignemouvemententetestockActions extends autoLignemouvemententetestockActions
{
    //__________________________________________________________________________Les fiche de mouvement de stock
    public function executeMouvement(sfWebRequest $request)
    {
        $id_emplacemnt = null;
        
        $articles = Doctrine_Core::getTable('article')
            ->createQuery('a')
            //  ->where("stocable='true'")
        ;
        if ($id_emplacemnt)
            $articles = $articles->where('id_emplacement is null' );
        $this->articles = $articles->execute();
    }

    public function paginatePrecedent(sfWebRequest $request)
    {
        $page = $request->getParameter('page', 1);
        $article_min = $request->getParameter('article_min', '');

        $exercice = date('Y');

        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $order = '';
        //        $exercice_id = $_SESSION['exercice_id'];
        $pager_precedenet = new sfDoctrinePager('Lignemouvemententetestock');
        $pager_precedenet->setQuery(LignemouvemententetestockTable::getInstance()->loadEtatArticlePrece($article_min,  $date_debut, $order, $exercice));
        $pager_precedenet->setPage($page);
        $pager_precedenet->init();

        return $pager_precedenet;
    }
    public function executeAfficherEtatArticle(sfWebRequest $request)
    {
        $article_min = $request->getParameter('article_min', '');
        $exercice = date('Y');
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $etatLivre = LignemouvemententetestockTable::getInstance()->loadEtatArticle($article_min,  $date_debut, $date_fin,  $exercice);

        // $lignemouvement = LignemouvemententetestockTable::getInstance()->findByIdArticle($compte_min);
        // $etatLivre = LignePieceComptableTable::getInstance()->loadEtatLivre($compte_min, $compte_max, $date_debut, $date_fin, $order, $dossier_id, $exercice_id);
        $pager = $this->paginate($request);
        $pager_precedenet = $this->paginatePrecedent($request);
        $this->pager = $pager;
        //     $this->paginate($request);
        $this->pager_precedenet = $pager_precedenet;

        $page = $request->getParameter('page', 1);
        $this->page = $page;
        $etatLivre_precedent = LignemouvemententetestockTable::getInstance()->loadEtatArticle2Pre($article_min,  $date_debut,  $exercice);
        //$etatLivre_precedent = LignePieceComptableTable::getInstance()->loadEtatLivrePrece($compte_min, $compte_max, $date_debut, $order, $dossier_id, $exercice_id);
        $this->etatLivre_precedent = $etatLivre_precedent;

        $this->etatLivre = $etatLivre;
        return $this->renderPartial(
            "etat_article",
            array(
                "pager" => $pager, "page" => $page,
                "etatLivre" => $etatLivre,
                "date_debut" => $date_debut, "date_fin" => $date_fin,
                "article_min" => $article_min,
                "pager_precedenet" => $pager_precedenet,
                "etatLivre_precedent" => $etatLivre_precedent
            )
        );
    }
    public function paginate(sfWebRequest $request)
    {
        $page = $request->getParameter('page', 1);
        $article_min = $request->getParameter('article_min', '');
        $exercice = date('y');
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $pager = new sfDoctrinePager('Lignemouvemententetestock', 10);
        $listes_mouvement = LignemouvemententetestockTable::getInstance()->loadEtatArticle($article_min, $date_debut, $date_fin,  $exercice);
        $pager->setQuery($listes_mouvement);
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    public function executeImprimeMouvementstock(sfWebRequest $request)
    {
        $pdf = new sfTCPDF("");

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Mouvement Stock Article');
        $pdf->SetSubject("Mouvement Stock Article");
        $soc = new Societe();
        $soc = new Societe();
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $soc = $societe;
        $entete = $soc->getMinistere();
        $rs = $soc->getRs();
        $adresse = 'Tél:' . $soc->getTel() . '- Fax:' . $soc->getFax() . ' - Email:' . $soc->getMail() . '<br>Adresse:' . $soc->getAdresse();
        $pdf->SetAuthor($entete);
        $pdf->SetAuthor($rs);
        $logo=PDF_HEADER_LOGO.'/'.$societe->getLogo();
        $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, $entete,$rs, '', '');

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //        $pdf->SetMargins(10, 30, 10);
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
        ob_end_clean();
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetMargins(5, 30, 5);
        $pdf->AddPage();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(5, 10, 5);
        $html = $this->ReadHtmlEtatMouvementStock($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Mouvement Stock.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlEtatMouvementStock(sfWebRequest $request)
    {
        $html = StyleCssHeader::header1();
        $etat = new Lignemouvemententetestock();
        $html .= $etat->ReadHtmlMouvementstcok($request);
        return $html;
    }
    public function executeExporterMouvementexcelExcel(sfWebRequest $request)
    {
        $article_min = $request->getParameter('article_min', '');
        $exercice = date('y');
        $date_debut = $request->getParameter('date_debut');
        if ($date_debut == '' || $date_debut == NULL)
            $date_debut = $exercice . '-01-01';
        $date_fin = $request->getParameter('date_fin');
        if ($date_fin == '' || $date_fin == NULL)
            $date_fin = $exercice . '-12-31';
        $listes_mouvement = LignemouvemententetestockTable::getInstance()->loadEtatArticleMouvement($article_min, $date_debut, $date_fin,  $exercice);
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->article_min = $article_min;
        $this->listes_mouvement = $listes_mouvement;
    }
}
