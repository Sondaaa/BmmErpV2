<div id="my-modalposteparservice" class="modal fade" tabindex="-1" >

<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
 <?php $service = Doctrine_Core::getTable('servicerh')->findOneById($idd); ?>
                <h4 class="smaller lighter blue no-margin"> Liste des Postes relie au  "<?php echo $service->getLibelle(); ?> " </h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr >
                                   <th style="width: 20%">Numéro</th> 
                                <th>Libelle</th> 
                                
                                <th style="display: none">Code poste</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('posterh p ,unite u')
                                    ->where('p.id_unite=u.id ')
                                    ->andwhere('u.id_service='.$idd)
                                    ->execute();
                            $ag = new Unite();
                       $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chPoste4('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

                                  <td style="width: 20%"><?php echo $i;?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                      $i++;      }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                     <a id="button_print" target="_blanc" href="<?php echo url_for('posterh/Imprimerlisteposteparservice?idservice=' . $idd) ?>" class="btn  btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                      </a>
                    <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermerposte4()" >

                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script  type="text/javascript">   $("table").addClass("table  table-bordered table-hover");
    function chPoste4(id,libelle)
    {
        
         $('#my-modalposteparservice').removeClass('in');
         $('#my-modalposteparservice').css('display','none');
         $('#idposte').val(id);
        $('#libelleposte').val(libelle);
       

    }
    function fermerposte4()
    {  $('#my-modalposteparservice').removeClass('in');
        $('#my-modalposteparservice').css('display', 'none');
    }

</script>


