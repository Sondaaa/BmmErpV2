<?php

require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorHelper.class.php';

/**
 * fournisseur actions.
 *
 * @package    Bmm
 * @subpackage fournisseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fournisseurActions extends autoFournisseurActions {

    public function executeCertificat(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
    }

    public function executeSetCertificatrs(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $etat = $request->getParameter('etat');

        $fournisseur = FournisseurTable::getInstance()->find($id);
        $fournisseur->setCertificatrs($etat);
        $fournisseur->save();

        die("OK");
    }

}
