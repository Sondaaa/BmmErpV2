<?php 
//$liste_mvt=  LignemouvementfacturationTable::getInstance()->getByBdcg();

 $query = "SELECT lignemouvementfacturation.id as ref,documentachat.id as iddocachat,"
         . " lignemouvementfacturation.montant as montant ,lignemouvementfacturation.numerofacture as numerofacture,"
         . "concat(  typedoc.prefixetype,LPAD(documentachat.numero::text, 7, '0'))as numero, "
         . "documentachat.datecreation as date "
                        . "FROM   lignemouvementfacturation,documentachat ,typedoc "
                        . "WHERE lignemouvementfacturation.id_documentachat in (select id from documentachat where id_frs is NULL )"
                       
                    ."and lignemouvementfacturation.id_documentachat= documentachat.id "
         . " and typedoc .id=documentachat.id_typedoc";
           
//die($query);
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $liste_mvt = $conn->fetchAssoc($query);
            
//             $liste_mvt = Doctrine_Query::create()
//                                        ->select('*')
//                                        ->from('lignemouvementfacturation')
//                                        ->andWhere('lignemouvementfacturation.id_documentachat in (select id from documentachat where id_frs is NULL '
//                                                . ' and id_typedoc = 2)" ')
//                                        ->execute();
//            die(sizeof($liste_mvt).  json_encode($liste_mvt));
?>
<div id="sf_admin_container">
    <h1 id="replacediv"> Liste des Mouvements du BDCG
        <small><i class="ace-icon fa fa-angle-double-right"></i></small>
    </h1>
</div>
<!--
<div class="col-sm-12">
    <a target="_blank" href="<?php // echo url_for('plan_comptable/imprimer') ?>" class="btn btn-app btn-danger radius-4" style="margin-bottom: 5px; width: 23%; padding: 10px 0 8px; float: left;">
        <i class="ace-icon fa fa-file-pdf-o bigger-170" style="margin: 0px; line-height: 30px;"></i>
        Exporter vers PDF (.pdf )
    </a>
    <a target="_blank" href="<?php // echo url_for('plan_comptable/exporterExcel') ?>" class="btn btn-app btn-success radius-4" style="margin-bottom: 5px; width: 23%; padding: 10px 0 8px; float: left;">
        <i class="ace-icon fa fa-file-excel-o bigger-170" style="margin: 0px; line-height: 30px;"></i>
        Exporter vers Excel (.xlsx )
    </a>
   
</div>-->
<table>
    <thead>
    <tr>
        <th class="center">Num??ro Facture</th>
                            <th style="text-align: center;">Date Cr??ation</th>
                            <th style="text-align: center;">Num??ro BCIS</th>
                             <th style="text-align: center;">Montant Mouvement</th>
                             <th>Action</th>
    </tr>
    </thead>
    <tbody>
       <?php include_partial('documentachat/list_mvt', array('liste_mvt' => $liste_mvt)); ?> 
    </tbody>
</table>
