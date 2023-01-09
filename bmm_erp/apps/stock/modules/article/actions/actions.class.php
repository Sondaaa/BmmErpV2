<?php

require_once dirname(__FILE__) . '/../lib/articleGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/articleGeneratorHelper.class.php';

/**
 * article actions.
 *
 * @package    Bmm
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articleActions extends autoArticleActions {

    //__________________________________________________________________________Export fiche inventaire
    public function executeExportinv(sfWebRequest $request) {

        if ($request->getParameter('mag') && $request->getParameter('mag') != "") {
            header('Access-Control-Allow-Origin: *');
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $query = "SELECT    article.codeart, magasin.libelle,   article.designation "
                    . "FROM    article,    stock,magasin   "
                    . "WHERE    stock.id_article = article.id  "
                    . " AND magasin.id=stock.id_mag "
                    . "AND   (stock.qtereel > 0 OR  stock.qtetheorique > 0 ) "
                    . "AND    stock.id_mag =" . $request->getParameter('mag');


            $listesdocs = $conn->execute($query);
            $query1 = "SELECT    article.codeart, magasin.libelle,   article.designation "
                    . ",stock.qtereel,stock.qtetheorique "
                    . "FROM    article,    stock,magasin   "
                    . "WHERE    stock.id_article = article.id  "
                    . " AND magasin.id=stock.id_mag "
                    . "AND   (stock.qtereel > 0 OR  stock.qtetheorique > 0 ) "
                    . "AND    stock.id_mag =" . $request->getParameter('mag');


            $listesdocs1 = $conn->execute($query1);
            $this->stocks = $listesdocs;
            $this->stocks2 = $listesdocs1;
        } else {
            $this->stocks = null;
            $this->stocks2 = null;
        }
    }

    //__________________________________________________________________________Les fiche de mouvement de stock
    public function executeMouvement(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    public function executeFiltermouvement(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('article/mouvement');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('article/mouvement');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('mouvement');
    }

    //____________misajourtva______________________________________________________________Mis ajour tva Article 
    public function executeMisajourtva(sfWebRequest $request) {
        $this->tvas = Doctrine_Core::getTable('tva')->findAll();
        if ($request->getParameter('slttva') && $request->getParameter('acttous') == 0) {

            Doctrine_Query::create()
                    ->update('article')
                    ->set('id_tva', '?', $request->getParameter('slttva'))
                    ->execute();
        }
        if ($request->getParameter('slttva') && $request->getParameter('acttous') == 1) {

            if ($request->getParameter('codeart') && $request->getParameter('codeart') != "")
                $query = Doctrine_Query::create()
                        ->update('article')
                        ->set('id_tva', $request->getParameter('slttva'))
                        ->where("codeart like '" . $request->getParameter('codeart') . "%'");
            if ($request->getParameter('designation') && $request->getParameter('designation') != "")
                $query = Doctrine_Query::create()
                        ->update('article')
                        ->set('id_tva', $request->getParameter('slttva'))
                        ->where("upper(designation) like '" . strtoupper($request->getParameter('designation')) . "%'");
            //die($query);
            $query = $query->execute();
        }
    }

    public function executeAjouterarticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $numero = $params['numero'];
            $date = $params['date'];
            $typestock = $params['typestock'];
            $famille = $params['famille'];
            $sfamille = $params['sfamille'];
            $nature = $params['nature'];
            $methode = $params['methode'];
            $designation = $params['designation'];
            $code = $params['code'];
            $idtva = $params['idtva'];
            $idunite = $params['idunite'];
            $codef = $params['codef'];
            $codesf = $params['codesf'];
            $codenature = $params['codenature'];
            $article = new Article();
            //die($idarticle.' c'.$idcar.' '.$valeur);
            if ($designation != "" && $idtva != "") {
                $articles = Doctrine_Query::create()
                                ->select("*")
                                ->from('article')
                                ->where("Designation like '%" . $designation . "%'")->execute();


                if (count($articles) > 0)
                    $article = $articles[count($articles) - 1];
                //die($codef." ".$codesf." ".$codenature);
                if ($code != "") {
                    $article->setCodeart($code);
                } else if ($codef != "" && $codesf && $codenature != "") {
                    $codearticle = $article->getSeqCode($codef, $codesf, $codenature);
                    $article->setCodeart($codearticle);
                    //die($codearticle);
                }
                $article->setDesignation($designation);
                $article->setIdTva($idtva);
                if ($idunite != "")
                    $article->setIdUnite($idunite);
                if ($methode != "")
                    $article->setIdMethode($methode);
                if ($typestock != "")
                    $article->setIdTypestock($typestock);
                if ($famille != "")
                    $article->setIdFamille($famille);
                if ($sfamille != "")
                    $article->setIdSousfamille($sfamille);
                if ($nature != "")
                    $article->setIdNature($nature);
                if ($numero != "")
                    $article->setNumero($numero);
                if ($date != "")
                    $article->setDatecreation($date);
                $article->setIdUser( $this->getUser()->getAttribute('userB2m')->getId());
                if ($codef != "")
                    $article->setCodefamille($codef);
                if ($codesf != "")
                    $article->setCodesf($codesf);
                if ($codenature != "")
                    $article->setCodenature($codenature);
                $article->save();
                $q = Doctrine_Query::create()
                                ->select("a.*")->from('article a')->where('a.id=' . $article->getId())->fetchArray();
                die(json_encode($q));
            } else
                die('Erreur au niveau de mise à jour');
        }
        die('Mise à jour effectuée avec succès');
    }

    public function executeRecherchearticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $designation = $params['designation'];

            if ($designation != "") {
                $articles = Doctrine_Query::create()
                                ->select("*")
                                ->from('article')
                                ->where("Designation like '%" . $designation . "%'")->fetchArray();

                die(json_encode($articles));
            } else
                die('Erreur de recherche');
        }
        die('Mise à jour effectuée avec succès');
    }

    public function executeMouvementstockbyarticle(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $idarticle = $params['idarticle'];
            $query = "SELECT   lignedocachat.qte,   lignedocachat.pamp,  "
                    . " lignedocachat.mntttc,   typedoc.libelle as type,  "
                    . " magasin.libelle as magasin,article.codeart,article.designation,  "
                    . " documentachat.datecreation "
                    . "FROM    article,   documentachat,   typedoc,   lignedocachat,   magasin "
                    . "WHERE   "
                    . " documentachat.id_typedoc = typedoc.id AND    lignedocachat.id_doc = documentachat.id "
                    . "AND   lignedocachat.id_articlestock = article.id "
                    . "AND   lignedocachat.id_mag = magasin.id AND   article.id =" . $idarticle;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listesdocs = $conn->fetchAssoc($query);
            die(json_encode($listesdocs));
        } else
            die('Erreur de recherche');

        die('Mise à jour effectuée avec succès');
    }

    public function ExtraireCodeFaSfNa($code, $libellefamille, $article) {
        $codefamille = substr($code, 0, 2);
        $codesousfamille = substr($code, 2, 2);
        $codenature = substr($code, 4, 2);
        $fa = new Famillearticle();
        $famille = Doctrine_Core::getTable('famillearticle')->findOneByCode($codefamille);
        if ($famille) {
            $fa = $famille;
        }
        $fa->setCode($codefamille);
        $fa->setLibelle($libellefamille);
        $fa->save();
        $sousfamille = new Sousfamillearticle();
        $sf = Doctrine_Core::getTable('sousfamillearticle')->findOneByCodeAndIdFamille($codesousfamille, $fa->getId());
        if ($sf)
            $sousfamille = $sf;
        $sousfamille->setCode($codesousfamille);
        $sousfamille->setIdFamille($fa->getId());
        $sousfamille->save();
        $nature = new Naturearticle();
        $naturesarticle = Doctrine_Core::getTable('naturearticle')->findOneByCode($codenature);
        if ($naturesarticle)
            $nature = $naturesarticle;
        $nature->setCode($codenature);
        $nature->save();

        $art = new Article();
        $art = $article;
        $art->setCodefamille($codefamille);
        $art->setCodesf($codesousfamille);
        $art->setCodenature($codenature);
        $art->setIdFamille($fa->getId());
        $art->setIdSousfamille($sousfamille->getId());
        $art->setIdNature($nature->getId());
        $art->save();
    }

    public function ExtraireTva($taux, $article) {
        $tva = new Tva();
        $tvarecherche = Doctrine_Core::getTable('tva')->findOneByValeurtva($taux);

        if ($tvarecherche)
            $tva = $tvarecherche;
        $ta = intval($taux);

        $tva->setLibelle($taux . "%");
        $tva->setValeurtva($taux);
        $tva->save();
        $art = new Article();
        $art = $article;
        $art->setIdTva($tva->getId());
        $art->save();
    }

    public function ExtraireUnite($unite, $article) {
        //  die($unite);
        $u = new Unitemarche();
        $un = Doctrine_Core::getTable('unitemarche')->findOneByLibelle($unite);

        if ($un)
            $u = $un;
        $u->setLibelle($unite);
        $u->save();

        $art = new Article();
        $art = $article;
        $art->setIdUnite($u->getId());
        $art->save();
    }

    public function executeImport(sfWebRequest $request) {
        if ($request->getParameter('param') && $request->getParameter('param') == "importfichierarticle") {
            if (isset($_FILES['lib_fichier']['tmp_name'])) {
                $tmp_name = $_FILES['lib_fichier']['tmp_name'];
                $name = $_FILES['lib_fichier']['name'];

                move_uploaded_file($tmp_name, "uploads/import/" . $name);
                $arrLines = file('uploads/import/' . $name);

                $ArrayColumn = explode(";", $arrLines[0]);



                foreach ($arrLines as $line) {
                    $arrResult = explode(';', $line);
                    $code = trim($arrResult[0]);
                    $designation = utf8_encode($arrResult[1]);
                    $libellefamille = utf8_encode($arrResult[4]);
                    $datecration = date('d-m-Y', strtotime(trim(str_replace("/", "-", $arrResult[2]))));

                    $article = new Article();
                    //__________________________________________________________Recherche article
                    $art = Doctrine_Core::getTable('article')->findOneByCodeart($code);
                    if ($art)
                        $article = $art;
                    $article->setCodeart($code);
                    $article->setDesignation($designation);
                    $article->setDatecreation($datecration);
                    $article->save();
                    //__________________________________________________________taux tva
                    $taux = trim(str_replace(",", ".", $arrResult[3]));
                    $this->ExtraireTva($taux, $article);
                    $this->ExtraireCodeFaSfNa($code, $libellefamille, $article);
                    //__________________________________________________________Unité 
                    $unite = trim(utf8_encode($arrResult[6]));
                    $this->ExtraireUnite($unite, $article);
                    //__________________________________________________________Qte
                    if ($arrResult[7] != "") {
                        $qtetheorique = str_replace(",", ".", trim($arrResult[7]));
                        $article->setQtetheorique(floatval($qtetheorique));
                    }
                    if ($arrResult[8] != "") {
                        $qteretirer = str_replace(",", ".", trim($arrResult[8]));
                        $article->setEnlinstance(floatval($qteretirer));
                    }
                    if ($arrResult[9] != "") {
                        $qtereel = str_replace(",", ".", trim($arrResult[9]));
                        $article->setStockreel(floatval($qtereel));
                    }
                    if ($arrResult[11] != "") {
                        $pamp = str_replace("TND", "", trim($arrResult[11]));
                        $prixcmp = str_replace(",", ".", $pamp);
                        $article->setPamp(floatval($prixcmp));
                    }
                    if ($arrResult[12] != "") {
                        $prixu = str_replace("TND", "", trim($arrResult[12]));
                        $prixunitaire = str_replace(",", ".", $prixu);
                        $article->setAht(floatval($prixunitaire));
                    }
                    $article->save();
                }
            }
        }
    }

    //__________________________________________________________________________Article stock
    public function executeImportmag(sfWebRequest $request) {
        if ($request->getParameter('param') && $request->getParameter('param') == "importfichierarticle") {
            if (isset($_FILES['lib_fichier']['tmp_name'])) {
                $tmp_name = $_FILES['lib_fichier']['tmp_name'];
                $name = $_FILES['lib_fichier']['name'];

                move_uploaded_file($tmp_name, "uploads/import/" . $name);
                $arrLines = file('uploads/import/' . $name);

                $ArrayColumn = explode(";", $arrLines[0]);
                foreach ($arrLines as $line) {
                    $arrResult = explode(';', $line);
                    $code = trim($arrResult[0]);
                    $article = new Article();
                    //__________________________________________________________Recherche article
                    $art = Doctrine_Core::getTable('article')->findOneByCodeart($code);
                    if ($art) {
                        $article = $art;
                    } else {
                        $article->setCodeart($code);
                        $designation = utf8_encode($arrResult[1]);
                        $article->setDesignation($designation);
                        $article->save();
                    }
                    $mag = new Magasin();
                    $codemag = trim($arrResult[5]);
                    $magasin = Doctrine_Core::getTable('magasin')->findOneByCode($codemag);
                    if ($magasin)
                        $mag = $magasin;
                    $mag->setCode($codemag);
                    $mag->save();
                    $stock = new Stock();
                    $st = Doctrine_Core::getTable('stock')->findOneByIdMagAndIdArticle($mag->getId(), $article->getId());
                    if ($st)
                        $stock = $st;
                    $stock->setIdArticle($article->getId());
                    $stock->setIdMag($mag->getId());
                    if ($arrResult[2] != "") {
                        $pamp = str_replace("TND", "", trim($arrResult[2]));
                        $prixcmp = str_replace(",", ".", $pamp);
                        $stock->setPuht(floatval($prixcmp));
                    }
                    if ($arrResult[3] != "") {

                        $qtereel = str_replace(",", ".", trim($arrResult[3]));
                        $stock->setQtereel(floatval($qtereel));
                    }
                    if ($arrResult[4] != "") {

                        $qtethe = str_replace(",", ".", trim($arrResult[4]));
                        $stock->setQtetheorique(floatval($qtethe));
                    }
                    $stock->save();
                }
            }
        }
        $this->Redirect('article/index');
    }
    
    public function executeListe(sfWebRequest $request) {
        $this->pager = $this->paginateListe($request);
        $this->page = $request->getParameter('page', 1);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial("listeArticle", array("pager" => $this->pager, "page" => $this->page));
        }
    }
    
    public function executeExporter(sfWebRequest $request) {

    }

    public function paginateListe(sfWebRequest $request) {
        $page = $request->getParameter('page', 1);
        $code = strtoupper($request->getParameter('code', ''));
        $designation = $request->getParameter('designation', '');
        $famille = strtoupper($request->getParameter('famille', ''));
        $sous_famille = $request->getParameter('sous_famille', '');
        $nature = $request->getParameter('nature', '');
        $unite=$request->getParameter('unite','');
        $pager = new sfDoctrinePager('Article', 10);
        $pager->setQuery(ArticleTable::getInstance()->load($code, $designation, $famille, $sous_famille, $nature,$unite));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }
    
    public function executeImprimerListeArticle(sfWebRequest $request) {

        $pdf = new sfTCPDF('L');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        $pdf->SetTitle('Liste des Articles');
        $pdf->SetSubject("Liste des Articles");
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

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetFooterMargin(8);

        // set auto page breaks
//        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 10);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage();
        $html = $this->ReadHtmlListeArticles($request);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Liste des Articles.pdf', 'I');

        // Stop symfony process
        throw new sfStopException();
    }

    public function ReadHtmlListeArticles(sfWebRequest $request) {
        $html = StyleCssHeader::header1();
        $articles = new Article();
        $html .= $articles->ReadHtmlListeArticles($request);
        return $html;
    }

}
