<?php

/**
 * Aidesociale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Aidesociale extends BaseAidesociale {

    public function ReadHtmlListeAide(sfWebRequest $request) {

        $id_agents = $request->getParameter('id_agents', '');
        $date = $request->getParameter('date', '');
        $id_typeaide = $request->getParameter('id_typeaide', '');
        if ($id_agents != '') {
            $agents = Doctrine_Core::getTable('agents')->findOneById($id_agents);
        }
        if ($id_typeaide != '') {
            $typeaide = Doctrine_Core::getTable('typeaide')->findOneById($id_typeaide);
        }
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT  *, typeaide.libelle as nature,"
                . "  aidesociale.date as date,"
                . "  aidesociale.origine as origine"
                . "  ,aidesociale.observation as observation,"
                . "  aidesociale.montant as montant,"
                . "Concat(agents.nomcomplet, ' ', agents.prenom) as nom, agents.idrh as idrh"
                . " FROM agents, aidesociale ,typeaide"
                . " WHERE aidesociale.id_agents= agents.id "
                . " and aidesociale.id_typeaide=typeaide.id "
        ;
        if ($id_agents != '')
            $query.= "  and aidesociale.id_agents =" . $id_agents
            ;
        if ($id_typeaide != '')
            $query.= "  and aidesociale.id_typeaide =" . $id_typeaide
            ;

        if ($date != '')
            $query.= "  and aidesociale.date ='" . $date . "'"
            ;
        $query.= " ORDER BY agents.nomcomplet";
        $consultation = $conn->fetchAssoc($query);
        $html = '<h3>RECAPITULATIF DES AIDES SOCIALES  ';
        if ($id_agents != ""): $html .=" De " . $agents->getNomcomplet() . " " . $agents->getPrenom() . '';
        else :
            $html .= '';
        endif;
        if ($id_typeaide != ""): $html .=" ** Type Aide : " . $typeaide->getLibelle() . '';
        else :
            $html .= '';
        endif;
        if ($date != ""): $html .=" Â " . date('d/m/Y', strtotime($date)) . '</h3>';
        else :
            $html .= '</h3>';
        endif;
        $html.='&nbsp;<br>&nbsp;<br>
                <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 3%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 8%;text-align:center;"><label>Matricule</label></td>
                        <td style="width: 20%;text-align:center;"><label>Agents</label></td> 
                        <td style="width: 15%;text-align:center;"><label>Type d\'aide</label></td>
                        <td style="width: 10%;text-align:center;"><label>Date d\'aide</label></td>
                        <td style="width: 15%;text-align:center;"><label>Origine</label></td>
                        <td style="width: 10%;text-align:center;"><label>Montant</label></td>
                        <td style="width: 20%;text-align:center;"><label>Observations </label></td>
                    </tr>';

        if (sizeof($consultation) > 0) {
            $i = 1;
            foreach ($consultation as $consul):
                $html.='<tr style="font-size:12px;">
                        <td style="height:25px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $consul['idrh'] . '</td>
                        <td style="text-align:left;">' . $consul['nom'] . '</td>
                        <td style="text-align:left;">' . $consul['nature'] . '</td>
                        <td style="text-align:center;">' . date('d/m/Y', strtotime($consul['date'])) . '</td>
                        <td style="text-align:left;">' . $consul['origine'] . '</td>
                        <td style="text-align:center;">' . $consul['montant'] . '</td>
                        <td style="text-align:left;">' . $consul['observation'] . '</td>
                  </tr>';
                $i++;
            endforeach;
        }else {
            $html.='<tr style="font-size:16px;">
                        <td style="height:80px;text-align:center;width:100%;">&nbsp;<br>Pas d\'aides sociale</td>
                  </tr>';
        }

        $html.='</table>';

        return $html;
    }

}
