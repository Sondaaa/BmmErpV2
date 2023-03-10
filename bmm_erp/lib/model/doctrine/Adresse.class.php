<?php

/**
 * Adresse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Adresse extends BaseAdresse
{
    public function   __toString() {
        return $this->getCodepostal()." ".$this->getVille();
    }
    public function getVille(){
        $gouv="";
        if($this->getIdCouvernera()){
        $doc = Doctrine_Query::create()
                            ->select('gouvernera')
                            ->from('gouvernera a')
                            ->where('id=' . $this->getIdCouvernera())->execute();

            return  $doc[0]['gouvernera'];
        }
        return $gouv;
    }
    
 
    

}