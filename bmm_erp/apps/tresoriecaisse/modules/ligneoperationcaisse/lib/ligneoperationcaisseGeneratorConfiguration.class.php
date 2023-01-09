<?php

/**
 * ligneoperationcaisse module configuration.
 *
 * @package    Bmm
 * @subpackage ligneoperationcaisse
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ligneoperationcaisseGeneratorConfiguration extends BaseLigneoperationcaisseGeneratorConfiguration {

    public function getFilterDefaults() {
        $today = date("Y-m-d");
        return array('dateoperation' => array('from' => $today, 'to' => null));
    }

}
