<?php

require_once dirname(__FILE__) . '/../lib/utilisateurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/utilisateurGeneratorHelper.class.php';

/**
 * utilisateur actions.
 *
 * @package    Bmm
 * @subpackage utilisateur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class utilisateurActions extends autoUtilisateurActions {
//  public function executeIndex(sfWebRequest $request)
//  {
//    // sorting
//    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
//    {
//      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
//    }
//
//    // pager
//    if ($request->getParameter('page'))
//    {
//      $this->setPage($request->getParameter('page'));
//    }
//
//    $this->pager = $this->getPager();
//    $this->sort = $this->getSort();
//     return sfView::SUCCESS; 
//  }


    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'L’élément a été créé avec succès.' : 'Ces données de l’utilisateur ont été mises à jour avec succès.';
            try {
                if ($form->getObject()->isNew()) {
                    $listesutilisateur = Doctrine_Core::getTable('utilisateur')
                            ->createQuery('a')
                            ->where("upper(login) like '" . strtoupper($form['login']->getValue()) . "'")
                            ->execute();
                    

                    if (count($listesutilisateur) <= 0){
                        
                           $utilisateur = $form->save();
                          
                    }
                    else {
                        $this->getUser()->setFlash('error', 'Login  existe!!!', false);
                        return sfView::SUCCESS;
                    }
                } else
                    $utilisateur = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $utilisateur)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@utilisateur_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'utilisateur_edit', 'sf_subject' => $utilisateur));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeUpdatemotif(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $user =  $this->getUser()->getAttribute('userB2m');
            $id = $user->getId();
            $sidebar = $params['sidebar'];
            $skin = $params['skin'];
            $parametrage = new Parametragedesseigne();
            $para = Doctrine_Core::getTable('parametragedesseigne')->findOneByIdUser($id);
            if ($para)
                $parametrage = $para;
            $parametrage->setIdUser($user->getId());
            $parametrage->setSidebar($sidebar);
            $parametrage->setCouleurfond($skin);
            $parametrage->save();
            die("votre mise a jour effectué avec succès");
        }
    }

    public function executeProfil(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
    }

    public function executeAffecterProfil(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $profil_id = $request->getParameter('profil_id');
        $utilisateur = UtilisateurTable::getInstance()->find($id);
        $utilisateur->setIdProfil($profil_id);
        $utilisateur->save();
        
        die("OK");
    }

}
