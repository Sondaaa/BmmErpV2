<?php

/**
 * Souscorps
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Souscorps extends BaseSouscorps
{
 public function   __toString() {
        return "".$this->getCorps()." ---  ".$this->getLibelle()." ";;
    }
    
}