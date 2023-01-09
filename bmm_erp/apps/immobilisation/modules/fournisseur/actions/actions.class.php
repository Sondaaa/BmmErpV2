<?php

require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fournisseurGeneratorHelper.class.php';

/**
 * fournisseur actions.
 *
 * @package    Commercial
 * @subpackage fournisseur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fournisseurActions extends autoFournisseurActions {

    public function executeAjouter(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');
        $data = '{';
        $data .= '"entities":';
        $data .= '[';
        $fournissuer = new Fournisseur();
        if ($request->getParameter('nom') != "0")
            $fournissuer->setNom($request->getParameter('nom'));
        if ($request->getParameter('prenom') != "0")
            $fournissuer->setPrenom($request->getParameter('prenom'));
        if ($request->getParameter('ref') != "0")
            $fournissuer->setReference($request->getParameter('ref'));
        if ($request->getParameter('rs') != "0")
            $fournissuer->setRs($request->getParameter('rs'));
        if ($request->getParameter('mail') != "0")
            $fournissuer->setMail($request->getParameter('mail'));
        if ($request->getParameter('gsm') != "0")
            $fournissuer->setGsm($request->getParameter('gsm'));
        if ($request->getParameter('tel') != "0")
            $fournissuer->setTel($request->getParameter('tel'));
        $fournissuer->save();
        $data .= '{"msg":"' . "l'ajout du fournisseur :" . $fournissuer . " a été effectuée avec succès" . '","id":"' . $fournissuer->getId() . '","frs":"' . $fournissuer . '"}';
        $data .= ']';
        $data .= '}';
        die($data);
    }

}
