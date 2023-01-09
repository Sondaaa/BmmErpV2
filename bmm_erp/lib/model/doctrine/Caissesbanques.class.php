<?php

/**
 * Caissesbanques
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Caissesbanques extends BaseCaissesbanques {

    public function __toString() {
        return " " . $this->getLibelle();
    }

    public function ReadHtmlBonCaissesBanques() {

        $html = '<div class="contenue">
                    <div class="titre"><h3> Nom du compte: ' . $this->getLibelle() . '</h3></div>
                <div>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <table style="width:100%;">
                 <tr>
                    <td style="font-weight:bold;"> Date ouverture du compte </td>
                    <td style="border-bottom: 1px dashed #000000;"><h4>' . date('d/m/Y', strtotime($this->getDateouvert())) . '</h4></td> 
                </tr>
             </table>
             </div>';
        $html.='<h4>
            <table style="width:100%;">
                <tr>
                    <td style="width:50%;">Identité bancaire</td>
                    <td style="direction:rtl; width:50%; text-align:right;">كشف الهوية البنكية</td>
                </tr>    
            </table>
            </h4>          
            <table class="tableligne">
            <tbody>
                <tr>
                    <td style="width:30%;"><h4>Date d\'ouverture du compte</h4></td>
                    <td style="width:40%;">' . date('d/m/Y', strtotime($this->getDateouvert())) . '</td>
                    <td style="width:30%;"><h4>تاريخ فتح الحساب</h4></td>
                </tr>
                <tr>
                    <td><h4>Nom du compte</h4></td>
                    <td>' . $this->getLibelle() . ' </td>
                    <td><h4>اسم الحساب</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>Nature du compte</h4></td>
                    <td>' . $this->getNaturebanque() . '</td>
                    <td><h4>طبيعة الحساب</h4></td>
                </tr>
                <tr>
                    <td style="height:30px;"><h4>Identifiant bancaire</h4></td>
                    <td>' . $this->getCodecb() . '</td>
                    <td><h4>المعرف البنكي</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>RIB</h4></td>
                    <td>' . $this->getRib() . '</td>
                    <td><h4>كشف الهوية البنكية</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>IBAN</h4></td>
                    <td>' . $this->getIban() . '</td>
                    <td><h4>رقم الحساب المصرفي البنكي</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>Code BIC</h4></td>
                    <td>' . $this->getCodebic() . '</td>
                    <td><h4>رمز السويفت</h4></td>
                </tr>
            </tbody>
        </table>';

        return $html;
    }

    public function ReadHtmlCaisse() {
        if ($this->getDateouvert() != null) {
            $date_ouverture = date('d/m/Y', strtotime($this->getDateouvert()));
        } else {
            $date_ouverture = '';
        }

        $html = '<div class="contenue">
                    <div class="titre"><h3> Caisse : ' . $this->getLibelle() . '</h3></div>
                <div>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <table style="width:100%;">
                 <tr>
                    <td style="font-weight:bold;"> Date ouverture du caisse </td>
                    <td style="border-bottom: 1px dashed #000000;"><h4>' . $date_ouverture . '</h4></td> 
                </tr>
             </table>
             </div>';
        $html.='<h4>
            <table style="width:100%;">
                <tr>
                    <td style="width:50%;">Identité Caisse</td>
                    <td style="direction:rtl; width:50%; text-align:right;">كشف  الخزينة</td>
                </tr>    
            </table>
            </h4>          
            <table class="tableligne">
            <tbody>
                <tr>
                    <td style="width:30%;"><h4>Date d\'ouverture du caisse</h4></td>
                    <td style="width:40%;">' . $date_ouverture . '</td>
                    <td style="width:30%;"><h4>تاريخ فتح الخزينة</h4></td>
                </tr>
                <tr>
                    <td><h4>Nom du caisse</h4></td>
                    <td>' . $this->getLibelle() . ' </td>
                    <td><h4>اسم الخزينة</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>Code caisse</h4></td>
                    <td>' . $this->getCodecb() . '</td>
                    <td><h4>رقم الخزينة</h4></td>
                </tr>
                <tr>
                    <td style="height:30px;"><h4>Référence caisse</h4></td>
                    <td>' . $this->getReferencecb() . '</td>
                    <td><h4>رمز الخزينة</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>Montant d\'ouverture</h4></td>
                    <td>' . number_format($this->getMntouverture(), 3, '.', ' ') . '</td>
                    <td><h4>المبلغ الإفتتاحي</h4></td>
                </tr>
                 <tr>
                    <td style="height:30px;"><h4>Montant provisoire</h4></td>
                    <td>' . number_format($this->getMntprov(), 3, '.', ' ') . '</td>
                    <td><h4>المبلغ الإفتراضي</h4></td>
                </tr>
                <tr>
                    <td style="height:30px;"><h4>Montant final</h4></td>
                    <td>' . number_format($this->getMntdefini(), 3, '.', ' ') . '</td>
                    <td><h4>المبلغ النهائي</h4></td>
                </tr>
                <tr>
                    <td style="height:30px;"><h4>Description</h4></td>
                    <td>' . $this->getDescription() . '</td>
                    <td><h4>ملاحظات</h4></td>
                </tr>
            </tbody>
        </table>';

        return $html;
    }

}