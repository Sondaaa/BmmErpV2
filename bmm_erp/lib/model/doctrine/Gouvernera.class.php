<?php

/**
 * Gouvernera
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Gouvernera extends BaseGouvernera
{
    public function  __toString() {
        return "".$this->getGouvernera().','.$this->getPays();
    }
    public function getGouv(){
        $doc = Doctrine_Query::create()
                            ->select('gouvernera')
                            ->from('gouvernera a')
                            ->where('id=' . $this->getId())->execute();

            return  $doc[0]['gouvernera'];
       
    }
}