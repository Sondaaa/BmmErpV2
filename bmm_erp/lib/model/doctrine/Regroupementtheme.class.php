<?php

/**
 * Regroupementtheme
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Regroupementtheme extends BaseRegroupementtheme {

    public function __toString() {

        return "" . $this->getLibelle();
    }

   
    public function ReadHtmllisteRegroupementTheme() {

        $html = ' <h3>Liste des  Regrouppement des Thémes de Formation </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                     <th style="width: 20%;"><b><label>Numéro</label></b></th>
                    <th style="width: 80% text-align:left;"><b><label>Libellé</label></b></th>
              
                 
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('regroupementtheme')->findAll();
        $i = 1;
        foreach ($sousd as $p):
            $html.= '<tr>'
                . '<td>' . $i . '</td>'
                . '<td style="text-align:left;">' . $p->getLibelle() . '</td>'
                . '</tr>';
        $i++;
        endforeach;
        $html.='<tbody></table>';

        return $html;
    }

}
