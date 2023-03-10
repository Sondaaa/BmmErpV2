<?php

/**
 * Unite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Unite extends BaseUnite {

    public function __toString() {
        return $this->getServicerh()->getLibelle().'---'.$this->getLibelle();
    }

    public function ReadHtmlAlllisteUnite() {

        $html = ' <h3>Liste des Unités </h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('unite')->findAll();
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

//unite par direction 
    public function ReadHtmlAlllisteUnitepardirection($idd) {
        $direction = Doctrine_Core::getTable('direction')->findOneById($idd);
        $html = ' <h3>Liste des Unités de la Direction "' . $direction->getLibelle() . '"</h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('unite')
                ->createQuery('a')
                ->select("*")
                ->from('unite u , servicerh s, sousdirection sd')
                ->where('u.id_service=s.id')
                ->andWhere('s.id_sousdirection=sd.id')
                ->andWhere('sd.id_direction=' . $idd)
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

//unite par service

    public function ReadHtmlAlllisteUniteparservice($idd) {
        $service = Doctrine_Core::getTable('servicerh')->findOneById($idd);
        $html = ' <h3>Liste des Unités reliés au "' . $service->getLibelle() . '"</h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('unite')
                ->createQuery('a')
                ->select("*")
                ->from('unite u ')
                ->Where('u.id_service= ?', $idd)
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

//unite par sous direction 

    public function ReadHtmlAlllisteUniteparsousdirection($idd) {
        $sousdirection = Doctrine_Core::getTable('sousdirection')->findOneById($idd);
        $html = ' <h3>Liste des Unités reliés au " ' . $sousdirection->getLibelle() . '"</h3>'
        ;
        $html.=
                '<table border="1" style="padding:1%">
           
            <tbody>
                <tr>
                    <td style="width: 20%;"><b><label>Numéro</label></b></td>
                    <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>
                 
                </tr>
                ';

        $sousd = Doctrine_Core::getTable('unite')
                ->createQuery('a')
                ->select("*")
                ->from('unite u , servicerh s')
                ->Where('s.id_sousdirection=?', $idd)
                ->andwhere('u.id_service=s.id')
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

//par direction et service

        public function ReadHtmlAlllisteUnitepardirectionservice($idd, $id1) {
        $service = Doctrine_Core::getTable('servicerh')->findOneById($id1);
       
        $direction = Doctrine_Core::getTable('direction')->findOneById($idd); 
$html = ' <h3>Liste des Unités de la Direction "'.$direction->getLibelle().'"et reliés au " '.$service->getLibelle().'" </h3>'
;
$html.=
'<table border="1" style="padding:1%">

    <tbody>
        <tr>
            <td style="width: 20%;"><b><label>Numéro</label></b></td>
            <td style="width: 80% text-align:left;"><b><label>Libellé</label></b></td>

        </tr>
        ';

        $sousd = Doctrine_Core::getTable('unite')
        ->createQuery('a')
        ->select("*")
        ->from('unite u , servicerh s, sousdirection sd ')
        ->where('u.id_service=' . $id1)
        ->andWhere('s.id_sousdirection=sd.id')
        ->andWhere('sd.id_direction= ?', $idd)
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
