<?php

require_once dirname(__FILE__) . '/../lib/stockGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/stockGeneratorHelper.class.php';

/**
 * stock actions.
 *
 * @package    Bmm
 * @subpackage stock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockActions extends autoStockActions {

    public function executeMisajourstock(sfWebRequest $request) {

        $stockpatrimoines = new Stock();
        $stockpatrimoines->MisAJourStockPatrimoine();
        $this->redirect('stock/index');
    }

}
