<?php

/**
 * Documenttransfert
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 *
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Documenttransfert extends BaseDocumenttransfert
{

    public function ReadHtmlDocTransfert($iddoc)
    {
        $doctransfert = DocumenttransfertTable::getInstance()->find($iddoc);
        $html = '';

        $liste_ligne_doctransfert = Doctrine_Core::getTable('lignedocumenttransfert')
            ->createQuery('a')
            ->where('id_documenttransfert=' . $doctransfert->getId())
            ->orderBy('id asc')
            ->execute();
        $html .= '<div class="contenue"><h3>Document Transfert ' . $doctransfert->getType() . '</h3></div>';
        $html .= '<table  align = "center" style="width:100%;font-size:12px; " >

            <tr>
                <td style="width: 20%; text-align: left">Description:</td>
                <td style="width: 20%; text-align: left;">' . $doctransfert->getDescription() . '</td>
              </tr>
              <tr>
                <td style="width: 20%; text-align: left;">Date création:</td>
                <td style="width: 30%; text-align: left;">' . date('d/m/Y', strtotime($doctransfert->getCreatedAt())) . '</td>
            </tr>
            <tr>
            <td style="width: 20%; text-align: left;">Type Affectation:</td>
            <td style="width: 30%; text-align: left;">';
        if ($doctransfert->getIdTypetransfert()) {
            $html .= $doctransfert->getTypeaffectationimmo();
        }

        $html .= '</td>
        </tr>
       </table>
     </div>';
        $html .= ' <div></div>';
        $html .= '<table class="tableligne" align = "center" style="width:100% " border="1" cellpadding="3" padding:2%; margin-bottom:0px;margin-left: 2px; >
  <thead>
   <tr style="font-size:10px;text-align:center;font-weight:bold;background-color:#E0E0E0;">
       <th style="text-align:center;width: 25%;background-color:#E0E0E0;">Article</th>
            <th style="text-align:center;width: 25%;background-color:#E0E0E0;">Local Source</th>';
        if (strtoupper($doctransfert->getType()) != 'MISEENREBUS' && strtoupper($doctransfert->getType()) != 'VENTE' ):
            $html .= ' <th style="text-align:center;width: 25%;background-color:#E0E0E0;">Local Destination</th>';
        endif;
        $html .= ' <th style="text-align:center;width: 25%;background-color:#E0E0E0;">
            Utilisateur</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($liste_ligne_doctransfert as $lignedoc) {
            $html .= '<tr style="font-size:12px;text-align:center;"> ';
            $html .= ' <td style="text-align:left;width: 25%">' . trim($lignedoc->getImmobilisation()->getReference()) . ' ' . trim($lignedoc->getImmobilisation()->getDesignation()) . '</td>';
            $html .= ' <td style="text-align:left;width: 25%">' . $lignedoc->getBureaux() . '</td>';
            if (strtoupper($doctransfert->getType()) == 'INTERNE'):
                $html .= ' <td style="text-align:left;width: 25%">' . $lignedoc->getBureaux_3() . '</td>';
            elseif (strtoupper($doctransfert->getType()) == 'EXTERNE'):
                $html .= ' <td style="text-align:left;width: 25%">' . $lignedoc->getOrganisme() . '</td>';
            endif;
            $html .= ' <td style="text-align:left;width: 25%">' . $lignedoc->getAgents() . '</td>';
            $html .= ' </tr>';

        }
        $html .= ' </tbody>
            </table>
        ';
        // $s = count($liste_ligne_doctransfert);
        // if (($s % 43 > 5 && $s % 43 < 18)) {
        //     $html .= '<br pagebreak="true"/>';
        // }

        return $html;
    }
}
