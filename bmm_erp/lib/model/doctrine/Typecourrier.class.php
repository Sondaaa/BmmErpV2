<?php

/**
 * Typecourrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Typecourrier extends BaseTypecourrier
{
    public function __toString() {
        return "".$this->getType();
    }
    public function getCouleurtext(){
        $couleur="";
        if($this->getCoul())
            $couleur="<p style='".$this->getCoul ()."'>".$this->getCoul ()."</p>";
        echo $couleur;
    }
}