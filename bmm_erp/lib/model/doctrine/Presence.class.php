<?php

/**
 * Presence
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Presence extends BasePresence {

    public function getDate() {
        // echo date('M');
    }

    public function ReadHtmlPresence($idd) {
        $presence = Doctrine_Core::getTable('presence')->findOneById($idd);

        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        $titre = html_entity_decode(strftime("%B", strtotime($presence->getAnnee() . "-" . $presence->getMois() . "-" . date("d")))) . ' ' . $presence->getAnnee();

        $html = '<h3>RECAPITULATIF DE '
                . 'DE ' . $presence->getAgents()->getNomcomplet() . " " . $presence->getAgents()->getPrenom()
                . '<br> ' . ucfirst($titre) . '</h3>
            <table cellpadding="3">
                <tr>
                    <td style="width:47%">
            <div style="font-size:16px;text-align:center;width:100%;">PRESENCE</div>
            <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 10%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 50%;text-align:center;"><label>Jour Présence</label></td>
                        <td style="width: 20%;text-align:center;"><label>Nbr.H. Norm</label></td>
                        <td style="width: 20%;text-align:center;"><label>Nbr.H. Supp </label></td>
                    </tr>';
        $var = 0;
        $document = Doctrine_Core::getTable('grillepresence')
                ->createQuery('a')
                ->select("*")
                ->from('grillepresence gr ,presence p')
                ->where('gr.id_presnece=' . $idd)
//                ->andwhere('p.id=' . $idd)
//                ->andwhere("gr.semaine != '" . $var . "'")
                ->andwhere("gr.id_motif IS  NULL")
                ->execute();
        $i = 1;
        if (sizeof($document) != 0):
            foreach ($document as $p):
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                if ($p->getJour() < 10)
                    $jour = '0' . $p->getJour();
                else
                    $jour = $p->getJour();
                $jour_lettre = html_entity_decode(strftime("%A", strtotime(trim($presence->getAnnee()) . "-" . trim($presence->getMois()) . "-" . $jour)));
                if ($jour_lettre == "samedi" || $jour_lettre == "dimanche")
                    $color = '#FFF2E6';
                else
                    $color = '#FFF';
                $html.= '<tr style="background-color:' . $color . '">'
                        . '<td style="text-align:center;">'
                        . $i
                        . '</td>'
                        . '<td  style="font-weight:bold;"> '
                        . $p->getJour() . ' --> ' . $jour_lettre
                        . '</td>'
                        . '<td  style="font-weight:bold;text-align:center">'
                        . $p->getSemaine()
                        . '</td>'
                        . '<td style="font-weight:bold;text-align:center">'
                        . $p->getHeuresupp()
                        . '</td>'
                        . '</tr>';
                $i++;
            endforeach;
        else:
            $html.= '<tr>
                        <td style="text-align:center;width:100%;height:25px;">Pas de présence dans ce moi !</td>
                    </tr>';
        endif;

        $html.='<tbody></table>';
        $html.='<table border="1" cellpadding="3">'
                . '<tbody><tr style="background-color:#EDEDED;font-weight:bold;">'
                . '<td style="width:15%;text-align:center;height:25px;">Total</td>'
                . '<td style="width:25%;text-align:center;">'
                . sizeof($document)
                . '</td>'
                . '<td  style="width:30%;text-align:center;">'
                . $presence->getNbrtotalnormal()
                . '</td>'
                . '<td style="width:30%;text-align:center;">'
                . $presence->getNbhsupp()
                . '</td>'
                . '</tr>';
        $html.='<tbody></table></td>';

        $html.='<td style="width:53%;">
           <div style="font-size:16px;text-align:center;width:100%;">ABSENCE</div>
            <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 7%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 33%;text-align:center;"><label>Jour Absence</label></td>
                        <td style="width: 60%;text-align:center;"><label>Motif</label></td>
                    </tr>';
        $var = 0;
        $document_absence = Doctrine_Core::getTable('grillepresence')
                ->createQuery('a')
                ->select("*")
                ->from('grillepresence gr ,presence p')
                ->where('gr.id_presnece=' . $idd)
                ->andwhere("gr.id_motif IS NOT NULL")
                ->execute();
        $i = 1;
        if (sizeof($document_absence) != 0):
            foreach ($document_absence as $ab):
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                if ($ab->getJour() < 10)
                    $jour = '0' . $ab->getJour();
                else
                    $jour = $ab->getJour();
                $jour_lettre = html_entity_decode(strftime("%A", strtotime(trim($presence->getAnnee()) . "-" . trim($presence->getMois()) . "-" . $jour)));
                $html.= '<tr>'
                        . '<td style="text-align:center;">'
                        . $i
                        . '</td>'
                        . '<td style="font-weight:bold;">'
                        . $ab->getJour() . ' --> ' . $jour_lettre
                        . '</td>'
                        . '<td  style="font-weight:bold; text-align: center">&nbsp;'
                        . $ab->getMotif()->getLibelle()
                        . '</td>'
                        . '</tr>';
                $i++;
            endforeach;
        else:
            $html.= '<tr>
                        <td style="text-align:center;width:100%;height:25px;">Pas d\'absence dans ce moi !</td>
                    </tr>';
        endif;
        $html.='<tbody></table>';
        $html.='<table border="1" cellpadding="3">'
                . '<tbody><tr style="background-color:#EDEDED;font-weight:bold;">'
                . '<td style="width: 15%;text-align:center;height:25px;">Total</td>'
                . '<td style="width: 85%;text-align:center;">'
                . sizeof($document_absence) . '&nbsp;&nbsp;&nbsp;&nbsp;JOUR D\'ABSENCE'
                . '</td>'
                . '</tr>';
        $html.='<tbody></table></td></tr></table>';
        return $html;
    }

    public function ReadHtmlListePresence($ids, $mois, $annee) {

        if (strpos($ids, ',')) {
            $ids = substr($ids, 0, -2);
            $ids = explode(',,', $ids);
            $idd = $ids[0];
        } else {
            $idd = $ids;
        }

        $presence = PresenceTable::getInstance()->getByIdAgentsAndMoisAndAnnee($idd, $mois, $annee);

        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        $titre = html_entity_decode(strftime("%B", strtotime($presence->getAnnee() . "-" . $presence->getMois() . "-" . date("d")))) . ' ' . $presence->getAnnee();

        $html = '<h3>RECAPITULATIF ' . ucfirst($titre) . '</h3>
            <div style="font-size:16px;text-align:center;width:100%;">AGENTS</div>
            <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 10%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 25%;text-align:center;"><label>Matricule</label></td>
                        <td style="width: 65%;text-align:center;"><label>Nom Complet</label></td>
                    </tr>';

        $agents = AgentsTable::getInstance()->getByListeId($ids);
        $i = 1;
        foreach ($agents as $agent) {
            $html.='<tr>
                        <td style="text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $agent->getIdrh() . '</td>
                        <td>' . $agent->getNomcomplet() . ' ' . $agent->getPrenom() . '</td>
                    </tr>';
            $i++;
        }

        $html.='<tbody></table>';

        $html.= '<table cellpadding="3">
                <tr>
                    <td style="width:47%">
            <div style="font-size:16px;text-align:center;width:100%;">PRESENCE</div>
            <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 10%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 50%;text-align:center;"><label>Jour Présence</label></td>
                        <td style="width: 20%;text-align:center;"><label>Nbr.H. Norm</label></td>
                        <td style="width: 20%;text-align:center;"><label>Nbr.H. Supp </label></td>
                    </tr>';
        $var = 0;
        $document = Doctrine_Core::getTable('grillepresence')
                ->createQuery('a')
                ->select("*")
                ->from('grillepresence gr ,presence p')
                ->where('gr.id_presnece=' . $presence->getId())
                ->andwhere("gr.id_motif IS  NULL")
                ->execute();
        $i = 1;
        if (sizeof($document) != 0):
            foreach ($document as $p):
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                if ($p->getJour() < 10)
                    $jour = '0' . $p->getJour();
                else
                    $jour = $p->getJour();
                $jour_lettre = html_entity_decode(strftime("%A", strtotime(trim($presence->getAnnee()) . "-" . trim($presence->getMois()) . "-" . $jour)));
                if ($jour_lettre == "samedi" || $jour_lettre == "dimanche")
                    $color = '#FFF2E6';
                else
                    $color = '#FFF';
                if ($jour_lettre != "dimanche") {
                    $html.= '<tr style="background-color:' . $color . '">'
                            . '<td style="text-align:center;">'
                            . $i
                            . '</td>'
                            . '<td  style="font-weight:bold;"> '
                            . $p->getJour() . ' --> ' . $jour_lettre
                            . '</td>'
                            . '<td  style="font-weight:bold;text-align:center">'
                            . $p->getSemaine()
                            . '</td>'
                            . '<td style="font-weight:bold;text-align:center">'
                            . $p->getHeuresupp()
                            . '</td>'
                            . '</tr>';
                    $i++;
                }
            endforeach;
        else:
            $html.= '<tr>
                        <td style="text-align:center;width:100%;height:25px;">Pas de présence dans ce moi !</td>
                    </tr>';
        endif;

        $html.='<tbody></table>';
        $html.='<table border="1" cellpadding="3">'
                . '<tbody><tr style="background-color:#EDEDED;font-weight:bold;">'
                . '<td style="width:15%;text-align:center;height:25px;">Total</td>'
                . '<td style="width:25%;text-align:center;">'
                . sizeof($document)
                . '</td>'
                . '<td  style="width:30%;text-align:center;">'
                . $presence->getNbrtotalnormal()
                . '</td>'
                . '<td style="width:30%;text-align:center;">'
                . $presence->getNbhsupp()
                . '</td>'
                . '</tr>';
        $html.='<tbody></table></td>';

        $html.='<td style="width:53%;">
           <div style="font-size:16px;text-align:center;width:100%;">ABSENCE</div>
            <table border="1" cellpadding="3">
                <tbody>
                    <tr style="background-color:#EDEDED;font-weight:bold;">
                        <td style="width: 7%;text-align:center;height:30px;"><label>N°</label></td>
                        <td style="width: 33%;text-align:center;"><label>Jour Absence</label></td>
                        <td style="width: 60%;text-align:center;"><label>Motif</label></td>
                    </tr>';
        $var = 0;
        $document_absence = Doctrine_Core::getTable('grillepresence')
                ->createQuery('a')
                ->select("*")
                ->from('grillepresence gr ,presence p')
                ->where('gr.id_presnece=' . $presence->getId())
                ->andwhere("gr.id_motif IS NOT NULL")
                ->execute();
        $i = 1;
        if (sizeof($document_absence) != 0):
            foreach ($document_absence as $ab):
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                if ($ab->getJour() < 10)
                    $jour = '0' . $ab->getJour();
                else
                    $jour = $ab->getJour();
                $jour_lettre = html_entity_decode(strftime("%A", strtotime(trim($presence->getAnnee()) . "-" . trim($presence->getMois()) . "-" . $jour)));
                $html.= '<tr>'
                        . '<td style="text-align:center;">'
                        . $i
                        . '</td>'
                        . '<td style="font-weight:bold;">'
                        . $ab->getJour() . ' --> ' . $jour_lettre
                        . '</td>'
                        . '<td  style="font-weight:bold; text-align: center">&nbsp;'
                        . $ab->getMotif()->getLibelle()
                        . '</td>'
                        . '</tr>';
                $i++;
            endforeach;
        else:
            $html.= '<tr>
                        <td style="text-align:center;width:100%;height:25px;">Pas d\'absence dans ce moi !</td>
                    </tr>';
        endif;
        $html.='<tbody></table>';
        $html.='<table border="1" cellpadding="3">'
                . '<tbody><tr style="background-color:#EDEDED;font-weight:bold;">'
                . '<td style="width: 15%;text-align:center;height:25px;">Total</td>'
                . '<td style="width: 85%;text-align:center;">'
                . sizeof($document_absence) . '&nbsp;&nbsp;&nbsp;&nbsp;JOUR D\'ABSENCE'
                . '</td>'
                . '</tr>';
        $html.='<tbody></table></td></tr></table>';
        return $html;
    }

//impression liste presence des agents 
    public function ReadHtmAlllListeAgents(sfWebRequest $request) {
        $array = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query_presence = " select agents.idrh as idrh, concat(agents.nomcomplet, ' '  ,agents.prenom )as nom ,agents.cin as cin,"
                . " COALESCE(count(grillepresence.semaine),0) as nbpresence "
                . ",trim(presence.mois) as mois"
                . " ,presence.id as id , trim(presence.annee) as annee "
                . " from grillepresence,presence,agents "
//                . " where ((grillepresence.id_motif IS NULL) or ( grillepresence.semaine <> '0'))"
                . " where grillepresence.semaine <> '0' "
                . " and grillepresence.id_presnece=presence.id"
                . " and presence.id_agents=agents.id"
                . " Group By presence.id,agents.idrh,agents.nomcomplet,agents.prenom,agents.cin"
                . " ORDER BY mois";

        $presences = $conn->fetchAssoc($query_presence);
        $query_absence = " select agents.idrh as idrh, concat(agents.nomcomplet, ' '  ,agents.prenom )as nom ,agents.cin as cin,"
                . " COALESCE(count(grillepresence.id_motif),0) as nbrjabsence "
                . ",presence.id as id,trim(presence.mois) as mois,trim(presence.annee) as annee  "
                . " from grillepresence,presence,agents "
                . " where  grillepresence.id_presnece=presence.id"
                . " and  ((grillepresence.id_motif IS NOT NULL) or( grillepresence.semaine = '0')) "
                . " and presence.id_agents=agents.id"
                . " Group By presence.id,agents.idrh,agents.nomcomplet,agents.prenom,agents.cin"
                . " ORDER BY mois";

        $absence = $conn->fetchAssoc($query_absence);
        $resultat = array();
        $resultat['presence'] = $presences;
        $resultat['abscent'] = $absence;
        $html = '<h3>Liste de Presence des  Agents</h3>
                    &nbsp;<br>';
        $html.='<table border = "1" cellpadding = "3">
            <tbody>
                <tr style="background-color:#EDEDED;font-weight:bold;">
                    <td style="width:5%;text-align:center;height:30px;font-size:14px;"><label>N°</label></td>
                    <td style="width:10%;text-align:center;"><label>Matricule</label></td>
                    <td style="width:25%;text-align:center;"><label>Nom & Prénom</label></td>
                    <td style="width:10%;text-align:center;"><label>Mois</label></td>
                     <td style="width:10%;text-align:center;"><label>Annee</label></td>
                    <td style="width:10%;text-align:center;"><label>J.Travaille.</label></td>
                    <td style="width:10%;text-align:center;"><label>J.Abscent</label></td>
                     <td style="width:10%;text-align:center;"><label>H.Supp</label></td>
                </tr>';
        $i = 1;
        for ($j = 0; $j < sizeof($resultat['presence']); $j++):
            $html.='<tr>
                        <td style="width:5%;text-align:center;">' . $i . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat['presence'][$j]['idrh'] . '</td>
                        <td style="width:25%;">' . $resultat['presence'][$j]['nom'] . '</td>
                        <td style="width:10%;text-align:center">' . $array[$resultat['presence'][$j]['mois']] . '</td>
                        <td style="width:10%;text-align:center">' . $resultat['presence'][$j]['annee'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat['presence'][$j]['nbpresence'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat['presence'][$j]['nbrjabsence'] . '</td>
                    </tr>';
            $i++;
        endfor;
        $html.='</tbody>
        </table>';
        return $html;
    }

    //2eme methode
    public function ReadHtmAlllListePresenceAgents(sfWebRequest $request) {
        $id_agents = $request->getParameter('id_agents', '');
        $mois = $request->getParameter('mois', '');
        $annee = $request->getParameter('annee', '');
        $array = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = " select agents.idrh as idrh, concat(agents.nomcomplet, ' '  ,agents.prenom )as nom ,agents.cin as cin,"
                . " CAST(presence.totalheuresupp1 as numeric )+CAST(presence.totalheuresupp2 as numeric) + CAST ( presence.totalheuresupp3 as numeric) +CAST(presence.totalheursupp4 as numeric)"
                . "+ CAST(presence.totalheuresupp5 as numeric) as  heursupp,"
                . " SUM(Case when grillepresence.semaine IS Not Null and grillepresence.semaine <> '0' then 1 else 0 END) as nbpresence, "
                . " SUM(Case when grillepresence.id_motif IS Not Null and grillepresence.id_motif <> 3 then 1 else 0  END) as nbrjabsence, "
                . " SUM(Case when grillepresence.id_motif = 3 then 1 else 0 END) as nbrconge, "
                . " trim(presence.mois) as mois, presence.id as id , trim(presence.annee) as annee "
                . " from grillepresence,presence,agents "
                . " where grillepresence.id_presnece=presence.id"

        ;
        if ($id_agents != '') {
            $query.=" and presence.id_agents=" . $id_agents;
        }
        if ($annee != '0') {
            $query.=" and presence.annee='" . $annee . "'";
        }
        if ($mois != '') {
            $query.=" and presence.mois='" . $mois . "'";
        }
        $query.= " and presence.id_agents=agents.id"
                . " Group By presence.id,agents.idrh,agents.nomcomplet,agents.prenom,agents.cin"
                . " ORDER BY mois";

        $resultat = $conn->fetchAssoc($query);

        $html = '<h3 style="font-size: 22px;">Liste des Présences par Agent
                    &nbsp;<br>';
        if ($mois != '')
            $html .= ' En ' . $array[$mois];
        if ($annee != '0')
            $html .= ' ' . $annee;
        $html.='</h3><table border = "1" cellpadding = "3">
                <thead>
                <tr style="background-color:#EDEDED;font-weight:bold;">
                    <th style="width:5%;text-align:center;height:30px;font-size:14px;"><label>N°</label></th>
                    <th style="width:10%;text-align:center;"><label>Matricule</label></th>
                    <th style="width:25%;text-align:center;"><label>Nom & Prénom</label></th>
                    <th style="width:10%;text-align:center;"><label>Mois</label></th>
                     <th style="width:10%;text-align:center;"><label>Annee</label></th>
                    <th style="width:10%;text-align:center;"><label>J.Travaille.</label></th>
                    <th style="width:10%;text-align:center;"><label>J.Abscent IR</label></th>
                    <th style="width:10%;text-align:center;"><label>J.Conge</label></th>
                    <th style="width:10%;text-align:center;"><label>H.Supp</label></th>
                </tr>
                </thead>';
        $i = 1;
        if (sizeof($resultat) > 0):
            for ($j = 0; $j < sizeof($resultat); $j++):
                $html.=' <tbody><tr>
                        <td style="width:5%;text-align:center;">' . $i . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat[$j]['idrh'] . '</td>
                        <td style="width:25%;">' . $resultat[$j]['nom'] . '</td>
                        <td style="width:10%;text-align:center">' . $array[$resultat[$j]['mois']] . '</td>
                        <td style="width:10%;text-align:center">' . $resultat[$j]['annee'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat[$j]['nbpresence'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat[$j]['nbrjabsence'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat[$j]['nbrconge'] . '</td>
                        <td style="width:10%;text-align:center;">' . $resultat[$j]['heursupp'] . '</td>
                    </tr>';
                $i++;
            endfor;
        else:
            $html.='<tr><td style="width: 100%;text-align:center">Pas d\'historiques</td></tr>';
        endif;
        $html.='</tbody>
        </table>';
        return $html;
    }

}
