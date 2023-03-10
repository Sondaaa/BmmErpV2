<?php

/**
 * Rubriqueformation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Rubriqueformation extends BaseRubriqueformation {

    public function __toString() {
        return "" . $this->getCode() . '.' . $this->getLibelle();
    }

    public function ReadHtmllisteRubriique() {

        $html = ' <h3>Liste des  Rubriques </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                     <th style="width: 5%;"><b><label>N°</label></b></th>
                     <th style="width: 30%;"><b><label>Domaine d utilisattion</label></b></th>
                     <th style="width: 10% text-align:left;"><b><label>Code</label></b></th>
                     <th style="width: 50% text-align:left;"><b><label>Libellé</label></b></th>
              
                 
                </tr>
                ';

        $four = Doctrine_Core::getTable('rubriqueformation')->findAll();
        $i = 1;
        foreach ($four as $p):
            $html.= '<tr>'
                    . '<td>' . $i . '</td>'
                    . '<td style="text-align:left;">' . $p->getDomaineuntilisation()->getLibelle() . '</td>'
                    . '<td style="text-align:left;">' . $p->getCode() . '</td>'
                    . '<td style="text-align:left;">' . $p->getLibelle() . '</td>'
                    . '</tr>';
            $i++;
        endforeach;
        $html.='<tbody></table>';

        return $html;
    }

    //par domaine
    public function ReadHtmlAlllisterubriquepardomaine($idd) {
        $domaine = Doctrine_Core::getTable('domaineuntilisation')->findOneById($idd);
        $html = ' <h3>Liste des Postes du Domaine d\'unitlisation "' . $domaine->getLibelle() . '" </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                     <th style="width: 5%;"><b><label>N°</label></b></th>
                     <th style="width: 30%;"><b><label>Domaine d utilisattion</label></b></th>
                     <th style="width: 10% text-align:left;"><b><label>Code</label></b></th>
                     <th style="width: 50% text-align:left;"><b><label>Libellé</label></b></th>
              
                 
                </tr>
                ';

        $sousd = Doctrine_Query::create()
                ->select("*")
                ->from('rubriqueformation r')
                ->where('r.id_domaine=' . $idd)
                ->execute();


        $i = 1;
        foreach ($sousd as $p):
            $html.= '<tr>'
                    . '<td>' . $i . '</td>'
                   . '<td style="text-align:left;">' . $p->getDomaineuntilisation()->getLibelle() . '</td>'
                    . '<td style="text-align:left;">' . $p->getCode() . '</td>'
                    . '<td style="text-align:left;">' . $p->getLibelle() . '</td>'
                    . '</tr>';
            $i++;
        endforeach;
        $html.='<tbody></table>';

        return $html;
    }

}
