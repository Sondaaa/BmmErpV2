<?php

/**
 * Naturearticle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Naturearticle extends BaseNaturearticle
{
    public function __toString() {
        return "Code:".$this->getCode().' '.$this->getLibelle();
    }
}