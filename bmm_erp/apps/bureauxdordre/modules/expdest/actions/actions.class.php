<?php

require_once dirname(__FILE__) . '/../lib/expdestGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/expdestGeneratorHelper.class.php';

/**
 * expdest actions.
 *
 * @package    Bmm
 * @subpackage expdest
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class expdestActions extends autoExpdestActions {

    public function executeChoisirfrs(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];


            header('Access-Control-Allow-Origin: *');
            $query = "SELECT    fournisseur.nom,   fournisseur.prenom,   fournisseur.rs,   fournisseur.mail, "
                    . "  fournisseur.tel,   fournisseur.gsm  "
                    . "FROM   fournisseur"
                    . " where fournisseur.id=" . $idfrs;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $frss = $conn->fetchAssoc($query);
            die(json_encode($frss));
        }
    }

    public function executeAjouterexp(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idtype = $params['idtype'];

            $user =  $this->getUser()->getAttribute('userB2m');
            $type = $params['type'];
            $mode = $params['mode'];

            if ($type == "reception") {

                $dest = $user->getExpdestinataire();
                $idexp = $params['idexp'];
                if ($mode == 0) {
                    $parametreexpedition = new Parametreexpedition();
                    $par_exp = Doctrine_Core::getTable('parametreexpedition')->findOneByIdExpAndIdDestAndIdTypecourrier($idexp, $dest->getId(), $idtype);

                    if ($par_exp)
                        $parametreexpedition = $par_exp;
                    $parametreexpedition->setIdExp($idexp);
                    $parametreexpedition->setIdDest($dest->getId());
                    $parametreexpedition->setIdTypecourrier($idtype);
                    $parametreexpedition->save();
                    //die($parametreexpedition);

                    $query = "SELECT   expdest.id,expdest.npresponsable as libelle "
                            . "FROM    parametreexpedition,    expdest "
                            . "WHERE    parametreexpedition.id_exp = expdest.id and parametreexpedition.id_exp=" . $idexp . " "
                            . " order by parametreexpedition.id";
                }else {
                    $query = "SELECT   famexpdes.id,famexpdes.famille as libelle "
                            . "FROM    famexpdes "
                            . "WHERE    famexpdes.id = " . $idexp;
                }


                //die($query);
            } else {
                $exp = $user->getExpdestinataire();
                $idexp = $params['idexp'];
                $iddest = $params['idexp'];
                if ($mode == 0) {
                    $parametreexpedition = new Parametreexpedition();
                    $par_exp = Doctrine_Core::getTable('parametreexpedition')->findOneByIdExpAndIdDestAndIdTypecourrier($exp->getId(), $iddest, $idtype);

                    if ($par_exp)
                        $parametreexpedition = $par_exp;
                    $parametreexpedition->setIdExp($exp->getId());
                    $parametreexpedition->setIdDest($iddest);
                    $parametreexpedition->setIdTypecourrier($idtype);
                    $parametreexpedition->save();
                    //die($parametreexpedition);

                    $query = "SELECT   expdest.id, expdest.npresponsable as libelle "
                            . "FROM    parametreexpedition,    expdest "
                            . "WHERE    parametreexpedition.id_dest = expdest.id and parametreexpedition.id_exp=" . $exp->getId() . " "
                            . " order by parametreexpedition.id";
                }else {
                    $query = "SELECT   famexpdes.id,famexpdes.famille as libelle "
                            . "FROM    famexpdes "
                            . "WHERE    famexpdes.id = " . $idexp;
                }


                // die($query);
            }
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $listes = $conn->fetchAssoc($query);
            die(json_encode($listes));
        }
        die('Erreur');
    }

    public function executeAjouterexpediteur(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];
            $idagent = $params['idagent'];
            $idfamille = $params['idfamille'];
            $idtypeexp = $params['idtypeexp'];
            $npresponsable = $params['npresponsable'];

            if ($idfamille != "" && $idtypeexp != "" && $npresponsable != "") {
                if ($idagent)
                    $expdests = Doctrine_Core::getTable('expdest')->findOneByIdAgent($idagent);
                if ($idfrs)
                    $expdests = Doctrine_Core::getTable('expdest')->findOneByIdFrs($idfrs);

                if (!$expdests) {
                    $exp = new Expdest();
                    if ($idagent && $idagent != "")
                        $exp->setIdAgent($idagent);
                    if ($idfrs && $idfrs != "")
                        $exp->setIdFrs($idfrs);
                    $exp->setIdFamille($idfamille);
                    $exp->setIdType($idtypeexp);
                    $exp->setNpresponsable($npresponsable);
                    $exp->setDatecreation(date('Y-m-d'));
                    $exp->save();
                    die($exp->getId() . '');
                } else
                    die($expdests->getId() . '');
            }else {
                die('0');
            }
        }
        die('0');
    }

    public function executeChoisiradrs(sfWebRequest $request) {
        header('Access-Control-Allow-Origin: *');

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $idfrs = $params['idfrs'];


            header('Access-Control-Allow-Origin: *');
            $query = "select adressefrs.* from adressefrs where adressefrs.id_frs=" . $idfrs;

            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $adrs = $conn->fetchAssoc($query);
            die(json_encode($adrs));
        }
    }

}
