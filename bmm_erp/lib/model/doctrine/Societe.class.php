<?php

/**
 * Societe
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Societe extends BaseSociete {

    public function __toString() {
        return "" . $this->getRs();
    }

    public function getLienLogo() {
        echo '<img src="' . sfconfig::get('sf_appdir') . "uploads/images/" . $this->getLogo() . '" style="width: 10%;">';
    }
    
    public function getTdLienLogo() {
        echo '<img src="' . sfconfig::get('sf_appdir') . "uploads/images/" . $this->getLogo() . '" style="height: 29px;">';
    }

}
