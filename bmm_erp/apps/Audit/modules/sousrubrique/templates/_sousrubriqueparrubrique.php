<div id="my-modalsousrubriqueparrubrique" class="modal fade" tabindex="-1" >

    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $rubrique = Doctrine_Core::getTable('rubriqueformation')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Sous Rubriques Du Rubrique  "<?php echo $rubrique->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 20%">Numéro</th>  
                                    <th>C.Rubrique </th> 
                                    <th>Rubrique </th> 
                                    <th>Code</th>
                                    <th>Sous Rubrique </th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('sousrubrique s')
                                        ->where('s.id_rubrique=' . $idd)
                                        ->execute();
                                $ag = new Sousrubrique();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer;" ondblclick="chSousRubriqueParRubrique('<?php echo $ag->getId(); ?>','<?php echo $ag->getCode(); ?>', '<?php echo $ag->getLibelle(); ?>')">

                                        <td style="width: 20%"><?php echo $i; ?> </td>
                                        <td><?php echo $ag->getRubriqueformation()->getCode(); ?> </td>

                                        <td><?php echo $ag->getRubriqueformation()->getLibelle(); ?> </td>
                                        <td><?php echo $ag->getCode(); ?> </td>

                                        <td><?php echo $ag->getLibelle(); ?> </td>
                                        <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('sousrubrique/ImprimerlisteSousRubriqueParRubrique?idrubrique=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerSousRubriqueParRubrique()" >

                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>   $("table").addClass("table  table-bordered table-hover");
    function chSousRubriqueParRubrique(id, code,libelle)
    {

        $('#my-modalsousrubriqueparrubrique').removeClass('in');
        $('#my-modalsousrubriqueparrubrique').css('display', 'none');
          $('#idSousRubrique').val(id);
        $('#idsousrubrique').val(code);
        $('#sousrubrique').val(libelle);

  

    }
    function fermerSousRubriqueParRubrique()
    {
        $('#my-modalsousrubriqueparrubrique').removeClass('in');
        $('#my-modalsousrubriqueparrubrique').css('display', 'none');
    }

</script>


