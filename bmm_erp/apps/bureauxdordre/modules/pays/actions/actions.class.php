<?php

require_once dirname(__FILE__).'/../lib/paysGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/paysGeneratorHelper.class.php';

/**
 * pays actions.
 *
 * @package    Commercial
 * @subpackage pays
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paysActions extends autoPaysActions
{
    public function executeListePays(sfWebRequest $request) {

        header('Access-Control-Allow-Origin: *');
        $des = split(" ", $request->getParameter('desc'));

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('pays ');

        $data = $q->fetchArray();
      
        die(json_encode($data));
    }
}
