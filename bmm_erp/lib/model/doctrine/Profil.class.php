<?php

/**
 * Profil
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Profil extends BaseProfil {

    public function __toString() {
        return "" . $this->getLibelle();
    }

    public function ReadHtmlFiche($id) {
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $profil = ProfilTable::getInstance()->find($id);

        $html = '<h3 style="font-size:18px;">' . $societe->getRs() . '<br>Profil : ' . $profil . '</h3>
                <p>
                    <b>Remarque :</b> Créa : Création / Cons : Consultation / Modif : Modification / Supp : Suppression<br>
                    <b style="color:#FFF;">Remarque :</b> Valid : Validation / Bloc : Blocage / Annul : Annulation / Impr : Impression
                </p>';

        foreach ($profil->getProfilapplication() as $profil_application):
            $html.='<table border="1" cellpadding="5">
                    <thead>
                        <tr style="font-weight:bold; background-color:#F0F0F0;">
                            <td style="width: 100%; height: 25px; text-align: center;">Module : ' . $profil_application->getApplication()->getLibelle() . '</td>
                        </tr>
                        <tr style="font-weight:bold;background-color:#F0F0F0;">
                            <td style="width: 52%; height: 25px;">Sous Module</td>
                            <td style="width: 6%; text-align: center;">Créa</td>
                            <td style="width: 6%; text-align: center;">Cons</td>
                            <td style="width: 6%; text-align: center;">Modif</td>
                            <td style="width: 6%; text-align: center;">Supp</td>
                            <td style="width: 6%; text-align: center;">Valid</td>
                            <td style="width: 6%; text-align: center;">Bloc</td>
                            <td style="width: 6%; text-align: center;">Annul</td>
                            <td style="width: 6%; text-align: center;">Impr</td>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($profil_application->getProfilmodule() as $profil_module):

                $array = array("Création" => "", "Consultation" => "", "Modification" => "", "Suppression" => "",
                    "Validation" => "", "Blocage" => "", "Annulation" => "", "Impression" => "");

                foreach ($profil_module->getProfilmoduleaction() as $profil_action):
                    $array[$profil_action->getLibelle()] = "X";
                endforeach;

                $html.='<tr>
                        <td style="width: 52%; height: 25px;">' . $profil_module->getApplicationmodule()->getLibelle() . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Création"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Consultation"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Modification"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Suppression"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Validation"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Blocage"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Annulation"] . '</td>
                        <td style="width: 6%; text-align: center; font-weight: bold;">' . $array["Impression"] . '</td>
                    </tr>';
            endforeach;

            $html.='</tbody>
                </table>';
        endforeach;

        return $html;
    }

}
