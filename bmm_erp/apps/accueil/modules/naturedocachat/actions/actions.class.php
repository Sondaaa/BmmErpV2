<?php

require_once dirname(__FILE__).'/../lib/naturedocachatGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/naturedocachatGeneratorHelper.class.php';

/**
 * naturedocachat actions.
 *
 * @package    Bmm
 * @subpackage naturedocachat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class naturedocachatActions extends autoNaturedocachatActions
{
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      if ($form->isValid())
      {
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
  
        try {
          $naturedocachat = $form->save();          
          $naturedocachat->setIdUser(json_encode($request->getParameter('id_user')));
          $naturedocachat->save();
        } catch (Doctrine_Validator_Exception $e) {
  
          $errorStack = $form->getObject()->getErrorStack();
  
          $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
          foreach ($errorStack as $field => $errors) {
              $message .= "$field (" . implode(", ", $errors) . "), ";
          }
          $message = trim($message, ', ');
  
          $this->getUser()->setFlash('error', $message);
          return sfView::SUCCESS;
        }
  
        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $naturedocachat)));
  
        if ($request->hasParameter('_save_and_add'))
        {
          $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
  
          $this->redirect('@naturedocachat_new');
        }
        else
        {
          $this->getUser()->setFlash('notice', $notice);
  
          $this->redirect(array('sf_route' => 'naturedocachat_edit', 'sf_subject' => $naturedocachat));
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
      }
    }
}
