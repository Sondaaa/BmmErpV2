<?php

/**
 * Typefamille
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    InventaireTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Typefamille extends BaseTypefamille
{
public function   __toString() {
    return " ".$this->getCode()." ".$this->getLibelle();
}
}