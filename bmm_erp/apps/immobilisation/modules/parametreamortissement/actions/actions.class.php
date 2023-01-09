<?php

require_once dirname(__FILE__) . '/../lib/parametreamortissementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/parametreamortissementGeneratorHelper.class.php';

/**
 * parametreamortissement actions.
 *
 * @package    Bmm
 * @subpackage parametreamortissement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parametreamortissementActions extends autoParametreamortissementActions {

    public function executeSave(sfWebRequest $request) {
        $id = $request->getParameter('id');
        if($id != ''){
            $param = ParametreamortissementTable::getInstance()->find($id);
        }else{
            $param = new Parametreamortissement();
        }
        
        $param->setDate(date('Y-m-d'));
        $param->setDateamortissement($request->getParameter('dateamortissement'));
        $param->setAlign($request->getParameter('align'));
        $param->setFontcaractere($request->getParameter('fontcaractere'));
        $param->setFooter($request->getParameter('footer'));
        $param->setHeader($request->getParameter('header'));
        $param->setHeightcode($request->getParameter('heightcode'));
        $param->setHeightticket($request->getParameter('heightticket'));
        $param->setTaillecaractere($request->getParameter('taillecaractere'));
        $param->setWidthcode($request->getParameter('widthcode'));
        $param->setWidthticket($request->getParameter('widthticket'));
        $param->setBorder($request->getParameter('border'));
        
        $param->save();

        die("OK");
    }
    
    public function executeImprimerTest(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $nombre = $request->getParameter('nombre');
        
        return $this->renderPartial('parametreamortissement/impression', array('id' => $id, 'nombre' => $nombre));
    }

}
