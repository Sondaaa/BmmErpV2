<div id="my-modalposteparunite" class="modal fade" tabindex="-1" >

<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
 <?php $unite = Doctrine_Core::getTable('unite')->findOneById($idd); ?>
                <h4 class="smaller lighter blue no-margin"> Liste des Postes reliés au "<?php echo $unite->getLibelle(); ?> "</h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr >
                                  <th style="width: 20%">Numéro</th>  
                                <th>Libelle</th> 
                                
                                <th style="display: none">Code Poste</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('posterh p')
                                    ->where('p.id_unite='.$idd)
                                    ->execute();
                            $ag = new Unite();
                            $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chPoste9('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

                                  <td style="width: 20%"><?php echo $i;?> </td>
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
                     <a id="button_print" target="_blanc" href="<?php echo url_for('posterh/Imprimerlisteposteparunite?idunite=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                      </a>
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerposte1()" >

                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script  type="text/javascript">   $("table").addClass("table  table-bordered table-hover");
    function chPoste9(id,libelle)
    {
        
         $('#my-modalposteparunite').removeClass('in');
         $('#my-modalposteparunite').css('display','none');
         $('#idposte').val(id);
        $('#libelleposte').val(libelle);
       

    }
    function fermerposte1()
    {  $('#my-modalposteparunite').removeClass('in');
        $('#my-modalposteparunite').css('display', 'none');
    }

</script>


