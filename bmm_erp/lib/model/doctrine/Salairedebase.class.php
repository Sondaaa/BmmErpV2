<?php

/**
 * Salairedebase
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Salairedebase extends BaseSalairedebase {

    public function __toString() {
        if($this->getIdGrade() )
        return   $this->getSouscorps() . "-" .
                $this->getCategorierh() . "-" .
                $this->getGrade() . "-" . $this->getEchelle() . "-" .
                $this->getEchelon();
        else if($this->getIdEchelle() )
             return   $this->getSouscorps() . "-" .
                $this->getCategorierh() . "-" . $this->getEchelle() . "-" .
                $this->getEchelon();
        else if($this->getIdEchelon() )
             return   $this->getSouscorps() . "-" .
                $this->getCategorierh() . "-" . $this->getEchelle() . "-" .
                $this->getEchelon();
        else 
            return   $this->getSouscorps() . "-" .
                $this->getCategorierh() ;
    }

    public function getDate() {
        echo date('d-m-Y');
    }

}
