<?php

/**
 * Visitemedicale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Visitemedicale extends BaseVisitemedicale {

    public function ReadHtmlListeConsultation(sfWebRequest $request) {

        $id_agents = $request->getParameter('id_agents', '');
        $id_destination = $request->getParameter('id_destination', '');
        $date_depart = $request->getParameter('date_depart', '');
        $date_retour = $request->getParameter('date_retour', '');
        if ($id_agents != '') {
            $agents = Doctrine_Core::getTable('agents')->findOneById($id_agents);
        }
        if ($id_destination != "") {
            $destionation = Doctrine_Core::getTable('destinatonvisitemedicale')->findOneById($id_destination);
        }
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT  *, Visitemedicale.datedepart as datedepart,"
                . "  Visitemedicale.dateretour as dateretour,"
                . "  Visitemedicale.duree as duree,"
                . "  Visitemedicale.nbrjour as nbrjour,"
                . "  Visitemedicale.motif as motif,"
                . "Concat(agents.nomcomplet, ' ', agents.prenom) as nom, agents.idrh as idrh"
                . ",destinatonvisitemedicale.libelle as destination  "
                . " FROM destinatonvisitemedicale, Visitemedicale, agents "
                . " WHERE Visitemedicale.id_destination= destinatonvisitemedicale.id "
                . " and  visitemedicale.id_agents =agents.id ";

        if ($id_agents != '')
            $query.= "  and visitemedicale.id_agents =" . $id_agents
            ;
        if ($id_destination != '')
            $query.= "  and visitemedicale.id_destination =" . $id_destination
            ;
        if ($date_depart != '')
            $query.= "  and visitemedicale.datedepart ='" . $date_depart . "'"
            ;
        if ($date_retour != '')
            $query.= "  and visitemedicale.dateretour ='" . $date_retour . "'"
            ;
        $query.= " ORDER BY agents.nomcomplet";
        $consultation = $conn->fetchAssoc($query);



        $html = '<h3>RECAPITULATIF DES CONSULTATIONS MEDICALES   ';

        if ($id_agents != ""): $html .=" De " . $agents->getNomcomplet() . " " . $agents->getPrenom() . '';
        else :
            $html .= '';
        endif;

        if ($id_destination != ""): $html .=" ** Destination : " .$destionation->getLibelle() . '';
        else :
            $html .= '';
        endif;

        if ($date_depart != ""): $html .=" ?? Date D??part " . date('d/m/Y', strtotime($date_depart)) . '';
        else:
            $html .= '';
        endif;
        if ($date_retour != ""): $html .=" ??u Date Retour" . date('d/m/Y', strtotime($date_retour)) . '';
        else :
            $html .= '</h3>';
        endif;

        $html.='&nbsp;<br>&nbsp;<br>
                <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 3%;text-align:center;height:30px;"><label>N??</label></td>
                        <td style="width: 8%;text-align:center;"><label>Matricule</label></td>
                        <td style="width: 20%;text-align:center;"><label>Agents</label></td> 
                        <td style="width: 10%;text-align:center;"><label>Destinaion</label></td>
                           <td style="width: 10%;text-align:center;"><label>Nbre de Jour  </label></td>
                        <td style="width: 12%;text-align:center;"><label>Date D??part  </label></td>
                        <td style="width: 12%;text-align:center;"><label>Date Retour </label></td>
                        <td style="width: 25%;text-align:center;"><label>Motif  </label></td>
                    </tr>';
        if (sizeof($consultation) > 0) {
            $i = 1;
            foreach ($consultation as $consul):
                $html.='<tr style="font-size:12px;">
                        <td style="height:25px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $consul['idrh'] . '</td>
                        <td style="text-align:left;">' . $consul['nom'] . '</td>
                        <td style="text-align:center;">' . $consul['destination'] . '</td>
                      <td style="text-align:center;">' . $consul['nbrjour'] . ' Jour </td>
                     
                        <td style="text-align:center;">' . date('d/m/Y', strtotime($consul['datedepart'])) . '</td>
                        <td style="text-align:center;">' . date('d/m/Y', strtotime($consul['dateretour'])) . '</td>
                    
                        <td style="text-align:left;">' . $consul['motif'] . '</td>
                                
                  </tr>';
                $i++;
            endforeach;
        } else {
            $html.='<tr style="font-size:16px;">
                        <td style="height:80px;text-align:center;width:100%;">&nbsp;<br>Pas des Visites M??dicales</td>
                  </tr>';
        }

        $html.='</table>';

        return $html;
    }

}
