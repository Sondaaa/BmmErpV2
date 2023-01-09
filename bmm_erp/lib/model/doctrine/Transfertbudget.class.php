<?php

/**
 * Transfertbudget
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Transfertbudget extends BaseTransfertbudget {

    public function getDestination() {
        $budget = null;
        if ($this->getIdDestination()) {
            $lignetubrique = Doctrine_Core::getTable('ligprotitrub')->findOneById($this->getIdDestination());
            if ($lignetubrique)
                return $lignetubrique;
        }
        return $budget;
    }

    public function getSourcedubudget() {
        $budget = null;
        if ($this->getIdSource()) {
            $lignetubrique = Doctrine_Core::getTable('ligprotitrub')->findOneById($this->getIdSource());
            if ($lignetubrique)
                return $lignetubrique;
        }
        return $budget;
    }

    public function ReadHtmlListeTransfert($annee) {
        $transfert_budgets = transfertbudgetTable::getInstance()->getByAnnee($annee);

        $html = '';
        if ($annee != '')
            $html.='<h3 style="font-size:18px;">Liste des Transferts - ' . $annee . '</h3>';
        else
            $html.='<h3>Liste des Transferts</h3>';

        $html.='&nbsp;<br><table border="1" cellpadding="3">
                    <tr style="text-align:center;font-weight:bold;">
                        <td style="width:3%;">N°</td>
                        <td style="width:15%;">Type de Transfert<br>Date de Création</td>
                        <td style="width:15%;">Objectif de Transfert</td>
                        <td style="width:20%;">Source à partir de Budget (Interne)</td>
                        <td style="width:15%;">Source Externe</td>
                        <td style="width:20%;">Description de Transfert</td>
                        <td style="width:12%;">Montant Transféré</td>
                    </tr>';
        $i = 1;
        
        foreach ($transfert_budgets as $transfert_budget):
            if ($transfert_budget->getDatecreation() != '')
                $date_creation = date('d/m/Y', strtotime($transfert_budget->getDatecreation()));
            else
                $date_creation = '';
            $html.='<tr style="font-size:12px;">
                        <td style="height:25px;text-align:center;">' . $i . '</td>
                        <td>' . trim($transfert_budget->getTypetransfert()) . '<br>' . $date_creation . '</td>
                        <td>' . trim($transfert_budget->getObjectif()) . '</td>
                        <td style="font-size:10px;">' . trim($transfert_budget->getSourcedubudget()) . '</td>
                        <td>' . trim($transfert_budget->getSourcebudget()) . '</td>
                        <td style="font-size:10px;">' . trim($transfert_budget->getDestination()) . '</td>
                        <td style="text-align:right;">' . number_format($transfert_budget->getMnttransfert(), 3, '.', ' ') . '</td>
                </tr>';
            $i++;
        endforeach;

        $html.='</table>';

        return $html;
    }

    public function ReadHtmlTransfert($id) {
        $transfert_budget = transfertbudgetTable::getInstance()->find($id);
        if ($transfert_budget->getDatecreation() != '')
            $date_creation = date('d/m/Y', strtotime($transfert_budget->getDatecreation()));
        else
            $date_creation = '';

        $html = '<h3 style="font-size:18px;">Transfert Budget</h3>';

        $html.='&nbsp;<br>&nbsp;<br><table cellpadding="3">
                    <tr>
                        <td style="width:30%;font-weight:bold;height:30px;">Type de Transfert</td>
                        <td style="width:3%;">:</td>
                        <td style="width:60%;font-size:12px;">' . trim($transfert_budget->getTypetransfert()) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Date de Création</td>
                        <td>:</td>
                        <td style="font-size:12px;">' . $date_creation . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Objectif de Transfert</td>
                        <td>:</td>
                        <td style="font-size:12px;">' . trim($transfert_budget->getObjectif()) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Source à partir de Budget (Interne)</td>
                        <td>:</td>
                        <td style="font-size:10px;">' . trim($transfert_budget->getSourcedubudget()) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Source Externe</td>
                        <td>:</td>
                        <td style="font-size:12px;">' . trim($transfert_budget->getSourcebudget()) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Description de Transfert</td>
                        <td>:</td>
                        <td style="font-size:10px;">' . trim($transfert_budget->getDestination()) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;height:30px;">Montant Transféré</td>
                        <td>:</td>
                        <td style="font-size:12px;">' . number_format($transfert_budget->getMnttransfert(), 3, '.', ' ') . '</td>
                    </tr>
                </table>';

        return $html;
    }

}