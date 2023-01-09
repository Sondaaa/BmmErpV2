<?php

/**
 * Autoristation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Autoristation extends BaseAutoristation {

    public function ReadHtmlAutorisation() {

        $html = '<div class="titre" style="text-align:center;font-size:22px;width:100%;">'
                . ' ترخيـص<br> للقيام بعيادة طبية' .
                '</div>&nbsp;<br>&nbsp;<br>';

        $html.='<table>
                <tr><td style="width:160px;text-align:right;font-size:14px;">قبلي، في : ' . date('d/m/Y') . '</td></tr>
                </table>&nbsp;<br>&nbsp;<br>&nbsp;<br>';

        $html.='<table style="text-align:right;width:100%">
                    <tr>
                        <td style="width:25%; height:30px;">' . str_pad($this->getAgents()->getIdrh(), 20, '.', STR_PAD_LEFT) . '</td>
                        <td style="width:5%">رقم : </td>
                        <td style="width:47%"> ' . str_pad($this->getAgents()->getNomcomplet() . ' ' . $this->getAgents()->getPrenom(), 50, '.', STR_PAD_LEFT) . '</td>
                        <td style="width:23%">يرخص للسيد(ة)، الآنسة :</td>
                    </tr>
                    <tr>
                        <td style="width:85%; height:30px;">' . str_pad($this->getHopital(), 350, '.', STR_PAD_RIGHT) . '</td>
                        <td style="width:15%">للذهـاب إلـى :</td>
                    </tr>
                    <tr>
                        <td style="width:40%; height:30px;">' . str_pad($this->getMoyen(), 300, '.', STR_PAD_RIGHT) . '</td>
                        <td style="width:10%">بواسطــة :</td>
                        <td style="width:40%"> ' . str_pad(date('d/m/Y', strtotime($this->getDate())), 50, '.', STR_PAD_LEFT) . '</td>
                        <td style="width:10%"> يـوم :</td>
                    </tr>
                    <tr>
                        <td style="width:90%; height:30px;">' . str_pad($this->getCausedevisite(), 350, '.', STR_PAD_LEFT) . '</td>
                        <td style="width:10%">للقيام بـ :</td>
                    </tr>
                    <tr>
                        <td style="width:90%; height:30px;">' . str_pad($this->getReference(), 350, '.', STR_PAD_LEFT) . '</td>
                        <td style="width:10%"> المرجع :</td>
                    </tr>
                </table>&nbsp;<br>&nbsp;<br>&nbsp;<br>';

        $html.='<table border="1" style="width:100%;text-align:center;">
                    <tr>
                        <td style="height:140px; width:34%;">إمضاء و ختم الرئيس المباشر<br>' . $this->getSignaturedirecteur() . '</td>
                        <td style="width:33%;">تأشيرة طبيب الفيلق الثاني <br> الترابي الصحراوي <br> ' . $this->getVisamedecin() . '</td>
                        <td style="width:33%;">إمضاء العون<br>' . $this->getSignatureagents() . '</td>
                    </tr>
                    <tr>
                        <td style="height:140px; width:100%;">قرار السيد المدير العام<br>  لديوان تنمية رجيم معتوق<br>
                            <br><span style="color:#000;text-align:left;">' . $this->getDecision() . '</span>
                        </td>
                    </tr>
                </table>&nbsp;<br>&nbsp;<br>';

        $html.= '<div style="text-align:right;font-weight:bold;"> * مدة الترخيص:' . '</div>';
        $html.='<table style="width:100%;text-align:right;font-size:12px;">
                    <tr><td style="height:20px;width:100%;">-عيادة بالمستشفى الجهوي بقبلي ' . ':نصف يوم' . '</td></tr>
                    <tr><td style="height:20px;width:100%;">-عيادة بالمستشفى الجهوي بقابس ' . ': يوم واحد' . '</td></tr>
                    <tr><td style="height:20px;width:100%;">-عيادة بالمستشفى الجهوي بتونس ' . ': ثلاثة أيام ' . '</td></tr>
                </table>&nbsp;<br>';

        $html.= '<div style="text-align:right;font-weight:bold;"> * الموجه إليهم:' . '</div>';
        $html.='<table style="width:100%;text-align:right;font-size:12px;">
                    <tr><td style="height:20px;width:100%;">-	الإدارة الفرعية للشؤون الإدارية و المالية  ' . '</td></tr>
                    <tr><td style="height:20px;width:100%;">-	المصلحة أو الإدارة المشغلة' . '</td></tr>
                    <tr><td style="height:20px;width:100%;">-المعني بالأمر  ' . '</td></tr>
                </table>';

        return $html;
    }

}