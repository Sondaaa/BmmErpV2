<div id="my-modalrubriquepardomaine" class="modal fade" tabindex="-1" >

    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $domaine = Doctrine_Core::getTable('domaineuntilisation')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Rubriques du domaine d'utilisation "<?php echo $domaine->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr >
                                    <th style="width: 2%">N°</th>  
                                    <th>C.Domaine</th> 

                                    <th>Domaine d'utilisation</th> 
                                    <th>Code</th> 

                                    <th>Rubrique</th> 


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('rubriqueformation r')
                                        ->where('r.id_domaine=' . $idd)
                                        ->execute();
                                $ag = new Rubriqueformation();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer;" ondblclick="chRubriqueParDomaine('<?php echo $ag->getId(); ?>', '<?php echo $ag->getCode(); ?>', '<?php echo $ag->getLibelle(); ?>')">

                                        <td style="text-align: center"><?php echo $i; ?> </td>
                                        <td style="text-align: center"><?php echo $ag->getDomaineuntilisation()->getCode(); ?> </td>

                                        <td><?php echo $ag->getDomaineuntilisation()->getLibelle(); ?> </td>
                                        <td style="text-align: center"><?php echo $ag->getCode(); ?> </td>

                                        <td><?php echo $ag->getLibelle(); ?> </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('rubriqueformation/ImprimerlisteRubriqueParDomaine?iddomaine=' . $idd) ?>" class="btn  btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn  btn-sm pull-left"  onclick="fermerRubriqueParDomanie()" >

                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>   $("table").addClass("table  table-bordered table-hover");
    function chRubriqueParDomaine(id, code, libelle)
    {

        $('#my-modalrubriquepardomaine').removeClass('in');
        $('#my-modalrubriquepardomaine').css('display', 'none');
        $('#idRubrique').val(id);
        $('#idrubrique').val(code);
        $('#rubrique').val(libelle);


    }
    function fermerRubriqueParDomanie()
    {
        $('#my-modalrubriquepardomaine').removeClass('in');
        $('#my-modalrubriquepardomaine').css('display', 'none');
    }

</script>


