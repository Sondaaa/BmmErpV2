<?php

/**
 * CategorieRH
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class CategorieRH extends BaseCategorieRH {

    public function __toString() {

        return "" . $this->getLibelle();
    }

    public function ReadHtmlAlllisteCategorie() {

        $html = ' <h3>Liste des Catègories  </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <th style="width: 20%;"><b><label>Numéro</label></b></th>
                    <th style="width: 80% text-align:left;"><b><label>Libellé</label></b></th>
                
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('categorierh')->findAll();

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

    //categrie par corps 

    public function ReadHtmlAlllisteCategorieparcorps($id1) {

        $html = ' <h3>Liste des Catègories  </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <th style="width: 20%;"><b><label>Numéro</label></b></th>
                    <th style="width: 80% text-align:left;"><b><label>Libellé</label></b></th>
                
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('categorierh')
                ->createQuery('a')
                ->select("*")
                ->from('categorierh cat , corps c')
                ->where('cat.id_corps=c.id')
                ->andwhere('c.id=' . $id1)
                ->execute();

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
