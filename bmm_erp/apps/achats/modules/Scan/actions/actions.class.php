<?php

/**
 * Scan actions.
 *
 * @package    Bmm
 * @subpackage Scan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScanActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        if ($request->getParameter('id')) {
            $this->id = $request->getParameter('id');
            $this->courrier = Doctrine_Core::getTable('courrier')->findOneById($this->id);
        }
    }

    public function executeUploadimage(sfWebRequest $request) {
        header("Content-type: image/jpeg");
        $uploads_dir = sfconfig::get('sf_upload'); //Directory to save the file that comes from client application.
        if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["file"]["tmp_name"];
            $name = $_FILES["file"]["name"];
            $chemintestexiste = $uploads_dir . $name;
            $trouve = 1;
            while (file_exists($chemintestexiste)) {
                $name = rand(0, 100000000) . $name;
                $chemintestexiste = $uploads_dir . $name;
            }
            move_uploaded_file($tmp_name, $uploads_dir . $name);
            $src = sfconfig::get('sf_appdir') . "uploads/scanner/" . $name;
            Doctrine_Query::create()->delete('scanner')->execute();
            $scan = new Scanner();
            $scan->setChaine($name);
            $scan->save();
            die($src);
        }
    }

    public function executeLancerscan(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        if (!isset($_REQUEST['id'])) {
            $user =  $this->getUser()->getAttribute('userB2m');
            $chemin_exec = $user->getCheminexec();
            $this->redirect('http://localhost:8888/Scanner/index.php');
        }
        $q = Doctrine_Query::create()
                ->select("*")
                ->from('scanner');

        $scanners = $q->fetchArray();
        die(json_encode($scanners));
    }

    public function executeValiderattachementdemandedeprix(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['iddemande'];
            $chaine = $params['chaine'];
            $piecejoint = new Piecejoint();
            $demandedeprix = Doctrine_Core::getTable('documentachat')->findOneById($id);
            if ($demandedeprix) {
                $piecejoint->setIdDocachat($id);
            }

            $piecejoint->setIdTypepiece(7);

            $piecejoint->setChemin($chaine);
            $piecejoint->save();
            $this->CreateDossier($demandedeprix->getNumero() . '_', $chaine);
            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id,piecejoint.chemin")
                    ->from('piecejoint')
                    ->where('id_docachat=' . $id);

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function executeAfficheattachement(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['iddemande'];

            $q = Doctrine_Query::create()
                    ->select("piecejoint.objet as piece,  piecejoint.id,piecejoint.chemin")
                    ->from('piecejoint')
                    ->where('id_docachat=' . $id);

            $listespieces = $q->fetchArray();

            die(json_encode($listespieces));
        }
    }

    public function CreateDossier($url, $chaine) {
        $dossier = '/var/www/html/BmmErp/' . urldecode($url);
        if (!is_dir($dossier)) {
            mkdir($dossier);
        }
        copy(sfconfig::get('sf_appdir') . 'uploads/scanner/' . $chaine, $dossier . '/' . $chaine);
    }

}
