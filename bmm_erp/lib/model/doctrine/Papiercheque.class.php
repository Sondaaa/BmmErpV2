<?php

/**
 * Papiercheque
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Papiercheque extends BasePapiercheque {

    public function __toString() {
        return "" . $this->getRefpapier();
    }

    public function ReadHtmlCheque($id) {

        $cheque = PapierchequeTable::getInstance()->find($id);
        $mouvement = MouvementbanciareTable::getInstance()->findOneByIdCheque($id);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        if ($cheque->getCarnetcheque()->getCaissesbanques()->getIdNature() == 1):
            $html = '<table>
                        <tr>
                            <td style="width:450px;"></td>
                            <td>&nbsp;<br>&nbsp;<br>' . $cheque->getMntcheque() . '</td>
                        </tr>
                     </table>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>'
                    . '<table cellpadding="6">
                        <tr>
                            <td style="width:500px; text-align:center;">' . chiffreToLettre::cvnbst($cheque->getMntcheque()) . '</td>
                        </tr>
                    </table>
                    <table cellpadding="6">
                        <tr>
                            <td style="width:100px;">&nbsp;</td>
                            <td style="width:300px; text-align:center;">' . $mouvement->getRefbenifi() . '</td>
                            <td style="width:100px;">&nbsp;</td>
                        </tr>
                     </table>'
                    . '<table>
                        <tr>
                            <td style="width:100px;"></td>
                            <td style="width:250px;"></td>
                            <td style="width:150px; font-size:10px;">' . $societe->getGouvernera()->getGouvernera() . '&nbsp;&nbsp;&nbsp;&nbsp;' . date('d-m-Y') . '</td>
                        </tr>
                     </table>';
        else:
            $html = '<table>
                        <tr>
                            <td style="width:450px;"></td>
                            <td>&nbsp;<br>' . $cheque->getMntcheque() . '</td>
                        </tr>
                     </table>&nbsp;<br>&nbsp;<br>'
                    . '<table cellpadding="6">
                        <tr>
                            <td style="width:500px; text-align:center;">' . chiffreToLettre::cvnbst($cheque->getMntcheque()) . '</td>
                        </tr>
                    </table>
                    <table cellpadding="6">
                        <tr>
                            <td style="width:100px;">&nbsp;</td>
                            <td style="width:300px; text-align:center;">' . $mouvement->getRefbenifi() . '</td>
                            <td style="width:100px;">&nbsp;</td>
                        </tr>
                     </table>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>'
                    . '<table>
                        <tr>
                            <td style="width:120px;"></td>
                            <td style="width:250px; text-align:center;font-size:10px;">' . $societe->getGouvernera()->getGouvernera() . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . date('d-m-Y') . '</td>
                            <td style="width:120px;"></td>
                        </tr>
                     </table>';
        endif;

        return $html;
    }

}
