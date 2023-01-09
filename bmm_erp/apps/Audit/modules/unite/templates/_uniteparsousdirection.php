<div id="my-modaluniteparsousdirection" class="modal fade" tabindex="-1" >

<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
  <?php $sousdirection = Doctrine_Core::getTable('sousdirection')->findOneById($idd); ?>
                <h4 class="smaller lighter blue no-margin"> Liste des unités reliés au sous direction "<?php echo $sousdirection->getLibelle(); ?>"</h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr >
                                    <th style="width: 20%">Numéro</th>
                                <th>Libelle</th> 
                                
                                <th style="display: none">Code Unite</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php  $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('unite u , servicerh s')
                                    ->Where('s.id_sousdirection=?',$idd)
                                    ->andwhere('u.id_service=s.id')
                                    ->execute();
                            $ag = new Unite();
                       $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chUnited('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

                                  <td style="width: 20%"><?php echo $i; ?> </td>

                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                           $i++; }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('unite/Imprimerlisteuniteparsousdirection?idunite=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                      </a>
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerunited()" >

                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script>   $("table").addClass("table  table-bordered table-hover");
    function chUnited(id,libelle)
    {
         $('#my-modaluniteparsousdirection').removeClass('in');
         $('#my-modaluniteparsousdirection').css('display','none');
         $('#idunite').val(id);
        $('#libelleunite').val(libelle);
       

    }
    function fermerunited()
    {  $('#my-modaluniteparsousdirection').removeClass('in');
        $('#my-modaluniteparsousdirection').css('display', 'none');
    }

</script>


