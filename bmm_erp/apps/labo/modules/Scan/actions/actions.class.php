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
      //  die($uploads_dir);
      
        if ($_FILES["file"]) {
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
          
            $this->redirect('http://localhost:5000');
          
        }
        $q = Doctrine_Query::create()
                ->select("*")
                ->from('scanner');

        $scanners = $q->fetchArray();
        die(json_encode($scanners));
    }

}
