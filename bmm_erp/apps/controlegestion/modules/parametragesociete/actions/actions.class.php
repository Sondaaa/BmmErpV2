<?php

require_once dirname(__FILE__).'/../lib/parametragesocieteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/parametragesocieteGeneratorHelper.class.php';

/**
 * parametragesociete actions.
 *
 * @package    symfony
 * @subpackage parametragesociete
 * @author     Your name here
 * @version    SVN: $Id$
 */
class parametragesocieteActions extends autoParametragesocieteActions
{
    public function executeIndex(sfWebRequest $request)
  {
    $societe=SocieteTable::getInstance()->findAll()->getFirst();
   
    if($societe){
        $parametre=ParametragesocieteTable::getInstance()->findOneByIdSociete($societe->getId());
        if($parametre){
            
            $this->redirect('parametragesociete/edit?id=' . $parametre->getId());
            
        }else{
            $parametre=new Parametragesociete();
            $parametre->setIdSociete($societe->getId());
            $parametre->save();
            $this->redirect('parametragesociete/edit?id=' . $parametre->getId());
        }
    }else{
        $this->redirect('@homepage').'?stat=1';
    }
  }
}
