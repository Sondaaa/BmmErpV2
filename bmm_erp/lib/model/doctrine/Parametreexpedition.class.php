<?php

/**
 * Parametreexpedition
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Parametreexpedition extends BaseParametreexpedition
{
    public function __toString() {
        return "".$this->getExpdest()." -->";
    }
    public function getDestinationexpdest(){
        $dest=null;
        if($this->getIdDest()){
            $destination=Doctrine_Core::getTable('expdest')->findOneById($this->getIdDest());
            if($destination){
                $dest=$destination;
            }
        }
        return $dest;
    }
}