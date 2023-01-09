<?php

/**
 * Sousdirection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Sousdirection extends BaseSousdirection {

    public function __toString() {
        return "" . $this->getLibelle();
    }

    public function ReadHtmllisteSousDirections($idd) {
   $direction = Doctrine_Core::getTable('direction')->findOneById($idd); 
        $html = ' <h3>Liste des Sous directions de la direction "'.$direction->getLibelle().'"</h3>'
        ;
        $html.=
                '<table id="tab" class="tableligne">
           
            <tbody>
                <tr>
                   <td style="width: 20%;"><h3>Numéro</h3></td>
                    <td style="width: 80% text-align:left;"><h3>Libellé</h3></td>
                 
                </tr>
                ';
        
        $sousd = Doctrine_Core::getTable('sousdirection')->findByIdDirection($idd);

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

    public function ReadHtmlAlllisteSousDirections($idd) {

        $html = ' <h3>Liste des Sous directions </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';
        
        $sousd = Doctrine_Core::getTable('sousdirection')->findAll();

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