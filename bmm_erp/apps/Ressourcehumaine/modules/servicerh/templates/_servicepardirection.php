<div id="my-modalservicepardirection"  >

<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
  <?php $direction = Doctrine_Core::getTable('direction')->findOneById($idd); ?>
   
                <h4 class="smaller lighter blue no-margin"> Liste des Service de la Direction " <?php echo $direction->getLibelle(); ?>"</h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr >
                                   <th style="width: 20%">Numéro</th>
                                <th>Libellé</th> 
                                
                                <th style="display: none">Code Unite</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                     ->from('servicerh s, sousdirection sd , direction d')
                                     ->Where('s.id_sousdirection=sd.id')
                                    ->andWhere('sd.id_direction=?',$idd)
                                    ->execute();
                            $ag = new Servicerh();
                        $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chUnitepardirection1('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

                                  <td style="width: 20%"><?php echo $i; ?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                          $i++;  }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('servicerh/Imprimerlisteservicepardirection?idservice=' . $idd) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerunitepardirection1()" >

                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script  type="text/javascript">   $("table").addClass("table  table-bordered table-hover");
    function chUnitepardirection1(id,libelle)
    {
         $('#my-modalservicepardirection').removeClass('in');
         $('#my-modalservicepardirection').css('display','none');
         $('#idservice').val(id);
        $('#libelleservice').val(libelle);
       

    }
    function fermerunitepardirection1()
    {  $('#my-modalservicepardirection').removeClass('in');
        $('#my-modalservicepardirection').css('display', 'none');
    }

</script>


