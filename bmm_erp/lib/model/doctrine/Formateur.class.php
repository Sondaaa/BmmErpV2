<?php

/**
 * Formateur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Formateur extends BaseFormateur {

    public function __toString() {

        return $this->getNom() . " " . $this->getPrenom();
    }

//impression

    public function ReadHtmllisteFormateur() {

        $html = ' <h3>Liste des  Formateurs </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                   <th style="width: 20%;"><b><label>Numéro</label></b></th>
                   <th style="width: 20%;"><b><label>CIN</label></b></th>
                    <th style="width: 80% text-align:left;"><b><label>Nom & Prénom</label></b></th>
              
                 
                </tr>
                ';

        $for = Doctrine_Core::getTable('formateur')->findAll();
        $i = 1;
        foreach ($for as $p):
            $html.= '<tr>'
                    . '<td>' . $i . '</td>'
                    . '<td style="text-align:left;">' . $p->getCin() . '</td>'
                    . '<td style="text-align:left;">' . $p->getNom()."  " .$p->getPrenom(). '</td>'
                    . '</tr>';
            $i++;
        endforeach;
        $html.='<tbody></table>';

        return $html;
    }

}
