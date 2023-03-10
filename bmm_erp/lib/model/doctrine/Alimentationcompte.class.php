<?php

/**
 * Alimentationcompte
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Alimentationcompte extends BaseAlimentationcompte {

    public function ReadHtmlListe(sfWebRequest $request) {

        $compte_id = $request->getParameter('compte_id', '');
        $titre_id = $request->getParameter('titre_id', '');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');

        $q = Doctrine_Core::getTable('alimentationcompte')
                ->createQuery('a')
                ->from('alimentationcompte a');

        if ($compte_id != '')
            $q->where('r.id_compte = ' . $compte_id);
        if ($titre_id != '')
            $q->andWhere("a.id_tranchebudget =" . $titre_id);
        if ($date_debut != '')
            $q->andWhere("a.date >= " . $date_debut);
        if ($date_fin != '')
            $q->andWhere("a.date <= " . $date_fin);
        $q->orderBy('date');

        $alimentations = $q->execute();

        $html = '<h3>Liste des Alimentation</h3>
                    &nbsp;<br>
                    <table border="1" cellpadding="3">
                        <tr>
                            <td style="width:100%;">
                                <span style="margin-top:10px; color:#000;font-weight:bold;font-size:14px;">Recherche suivant :</span>
                                <ul style="width:100%;">';

        if ($compte_id != ''):
            $compte = CaissesbanquesTable::getInstance()->find($compte_id);
            $html.='<li> Compte bancaire/CCP : ' . $compte . '</li>';
        else:
            $html.='<li> Compte bancaire/CCP : - </li>';
        endif;
        if ($titre_id != ''):
            $titre = TranchebudgetTable::getInstance()->find($titre_id);
            $html.='<li> Titre Budget : ' . $titre . '</li>';
        else:
            $html.='<li> Titre Budget : - </li>';
        endif;

        if ($date_debut != ''):
            $html.='<li> Apr??s : ' . date('d/m/Y', strtotime($date_debut)) . '</li>';
        endif;
        if ($date_fin != ''):
            $html.='<li> Avant : ' . date('d/m/Y', strtotime($date_fin)) . '</li>';
        endif;
        $html.='</ul>
        </td>
        </tr>
        </table>&nbsp;
        <br>
        <table border = "1" cellpadding = "3">
            <tbody>
                <tr style="background-color:#EDEDED;font-weight:bold;font-size:12px;">
                    <td style="width:5%;text-align:center;height:30px;font-size:14px;">N??</td>
                    <td style="width:10%;text-align:center;">Date</td>
                    <td style="width:11%;text-align:center;">Type</td>
                    <td style="width:35%;text-align:center;">Compte Bancaire / CCP</td>
                    <td style="width:13%;text-align:center;">Montant</td>
                    <td style="width:26%;text-align:center;">Titre Budget</td>
                </tr>';
        $i = 1;
        foreach ($alimentations as $alimentation):
            if ($alimentation->getType() == 0)
                $type_text = "Encaissement Budget";
            elseif($alimentation->getType() == 1)
                $type_text = "Transfert";
            else
                $type_text = "Recette Hors Budget";

            $tranche_text = '';
            if ($alimentation->getIdTranchebudget() != null)
                $tranche_text = $alimentation->getTranchebudget();

            $html.='<tr style="font-size:10px;">
                        <td style="width:5%;text-align:center;height:25px;">' . $i . '</td>
                        <td style="width:10%;text-align:center;">' . date('d/m/Y', strtotime($alimentation->getDate())) . '</td>
                        <td style="width:11%;text-align:center;">' . $type_text . '</td>
                        <td style="width:35%;">' . trim($alimentation->getCaissesbanques()) . '</td>
                        <td style="width:13%;text-align:right;">' . number_format($alimentation->getMontant(), 3, '.', ' ') . '</td>
                        <td style="width:26%;">' . $tranche_text . '</td>
                    </tr>';
            $i++;
        endforeach;
        $html.='</tbody>
        </table>';
        return $html;
    }

    public function ReadHtmlFiche($id) {

        $alimentation = AlimentationcompteTable::getInstance()->find($id);
        $rib = '';
        if ($alimentation->getType() == 0) {
            $titre_text = "Alimentation par la source externe : " . trim($alimentation->getSourcesbudget());
        } else {
            $mouvement = MouvementbanciareTable::getInstance()->getSourceByAlimentation($id);
            $titre_text = "Transfert par le compte : " . $mouvement->getCaissesbanques();
            $rib = $mouvement->getCaissesbanques()->getRib();
        }
        $tranche_text = 'Non encore affect??(e)';
        if ($alimentation->getIdTranchebudget() != null)
            $tranche_text = $alimentation->getTranchebudget();

        $html = '<h3>Fiche Alimentation<br>' . date('d/m/Y', strtotime($alimentation->getDate())) . '</h3>
                    &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                    <b>' . $titre_text . '</b>
                        <hr>
                    &nbsp;<br>
                    <table cellpadding = "3">
                        <tr style="font-size:12px;">
                            <td style="height:25px"><b>Date :</b> ' . date('d/m/Y', strtotime($alimentation->getDate())) . '</td>
                        </tr>
                        <tr style="font-size:12px;">
                            <td style="height:25px"><b>Compte Bancaire / CCP :</b> ' . trim($alimentation->getCaissesbanques()) . '</td>
                        </tr>
                        <tr style="font-size:12px;">
                            <td style="height:25px"><b>Rib Bancaire / CCP :</b> ' . trim($alimentation->getCaissesbanques()->getRib()) . '</td>
                        </tr>
                        <tr style="font-size:12px;">
                            <td style="height:25px"><b>Montant :</b> ' . number_format($alimentation->getMontant(), 3, '.', ' ') . ' TND</td>
                        </tr>
                        <tr style="font-size:12px;">
                            <td style="height:25px">&nbsp;</td>
                        </tr>
                        <tr style="font-size:12px;">
                            <td style="height:25px"><b>Source :</b> ' . trim($titre_text) . '</td>
                        </tr>';

        if ($alimentation->getType() == 1) {
            $html.= '<tr style="font-size:12px;">
                        <td style="height:25px"><b>Rib Bancaire / CCP :</b> ' . $rib . '</td>
                    </tr>
                    <tr style="font-size:12px;">
                        <td style="height:25px"><b>Type Op??ration :</b> ' . trim($mouvement->getTypeoperation()) . '</td>
                    </tr>
                    <tr style="font-size:12px;">
                        <td style="height:25px"><b>Type Instrument :</b> ' . trim($mouvement->getInstrumentpaiment()) . '</td>
                    </tr>
                    <tr style="font-size:12px;">
                        <td style="height:25px"><b>Num??ro Instrument :</b> ' . trim($mouvement->getReferenceautre()) . '</td>
                    </tr>
                    <tr style="font-size:12px;">
                        <td style="height:25px"><b>R??f??rence Ordonnancement :</b> ' . trim($mouvement->getReford()) . '</td>
                    </tr>';
        }

        $html.= '<tr style="font-size:12px;">
                    <td style="height:25px">&nbsp;</td>
                </tr>
                <tr style="font-size:12px;">
                    <td style="height:25px"><b>Pour le Titre Budg??taire :</b> ' . trim($tranche_text) . '</td>
                </tr>
            </table>&nbsp;<br>';

        return $html;
    }

}
