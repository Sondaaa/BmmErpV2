<?php

require_once dirname(__FILE__) . '/../lib/dossierfourniseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/dossierfourniseurGeneratorHelper.class.php';

/**
 * dossierfourniseur actions.
 *
 * @package    Bmm
 * @subpackage dossierfourniseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dossierfourniseurActions extends autoDossierfourniseurActions
{

    //save document 
    public function executeSavedocumentDossier(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true);
            $listeslignesdocP = $params['listeLignedocsDossier'];
            $iddossier = $params['iddossier'];
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            Doctrine_Query::create()->delete('lignedossierfournisseur')
                ->where('id_dossierfrs=' . $iddossier)
                ->execute();

            foreach ($listeslignesdocP as $lignedocL) {
                $nordre1 = $lignedocL['norgdre'];
                $piecejoint = $lignedocL['piecejoint'];
                $lignedocDossier = new Lignedossierfournisseur();

                //    $name =  $_FILES['fileSelected']['name'];
                // $uploads_dir = sfConfig::get('sf_upload') . $name;
                // move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);
                if ($nordre1 != "")
                    $lignedocDossier->setNordre($nordre1);
                if ($piecejoint != "")
                    $lignedocDossier->setUrl($piecejoint);
                if ($iddossier != "")
                    $lignedocDossier->setIdDossierfrs($iddossier);
                $lignedocDossier->save();
            }


            $lignedocDossier->save();
        }
        die('Pièce(s) Joint(s) Ajouté(s) avec succe');
    }

    public function executeAfficheligneDossier(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();
        $user =  $this->getUser()->getAttribute('userB2m');
        if (!empty($content)) {
            $params = json_decode($content, true);
            $iddossier = $params['id'];
            $query = " select lignedossierfournisseur.nordre as norgdre"
                . ",lignedossierfournisseur.url as piecejoint ,"
                . " lignedossierfournisseur.id  as id"
                . " from lignedossierfournisseur"
                . " where lignedossierfournisseur.id_dossierfrs=" . $iddossier

                . " ORDER BY nordre ASC";
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listedocs = $conn->fetchAssoc($query);
            die(json_encode($listedocs));
        }
        die("bien");
    }
    public function executeUploaderfile(sfWebRequest $request)
    {
        //header('Access-Control-Allow-Origin: *');
        $id = $_REQUEST['id'];
        $name =  $_FILES['fileSelected']['name'];
        $uploads_dir = sfConfig::get('sf_upload') . $name;
        move_uploaded_file($_FILES['fileSelected']['tmp_name'], $uploads_dir);

        $piece_joint = new Piecejoint();
        $piece_joint->setChemin($name);
        $piece_joint->setIdDossierfournisseur($id);
        $piece_joint->save();
        return $this->renderText(json_encode(array(
            "valid" => 'upload success'
        )));
    }

    public function executeDeletePiecejoint(sfWebRequest $request)
    {
        $request->checkCSRFProtection();
        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $iddossier = $piecejoint->getIdDossierfournisseur();
        $piecejoint->delete();

        $this->redirect('dossierfourniseur/edit?id=' . $iddossier);
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->dossierfourniseur = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->dossierfourniseur);
    }
}
