<?php

/**
 * Typecontrat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Typecontrat extends BaseTypecontrat
{
public function  __toString() {
       
     return "".$this->getLibelle();
    }
 public function ReadHtmlAlllisteSituations() {

        $html = ' <h3>Liste des Situations Administratives </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
            <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';
        
        $sousd = Doctrine_Core::getTable('typecontrat')->findAll();
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