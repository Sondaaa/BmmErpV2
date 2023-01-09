<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Rubriques</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 5%">Numero </th> 
                                <th style="width: 10%">Code</th>  
                                <th style="width: 85%">Libelle</th>  

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('rubriqueformation')
                                    ->execute();
                            $ag = new Rubriqueformation();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="id" ondblclick="ChargerRubrique('<?php echo $ag->getId(); ?>', '<?php echo $ag->getCode(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <!-- '', -->
                                    <td style="text-align: center;width: 5%"><?php echo $i; ?></td>
                                    <td style="text-align: center;width: 10%"><?php echo $ag->getCode(); ?></td>
                                    <td style="text-align: left;width: 85%"><?php echo $ag->getLibelle(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteRubrique') ?>" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerRurique()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script>
    function ChargerRubrique(id, bes, annee)
    {

        $('#my-modalRubrique').removeClass('in');
        $('#my-modalRubrique').css('display', 'none');
        $('#idRubrique').val(id);
        $('#idrubrique').val(bes);
        $('#rubrique').val(annee);

    }
    function fermerRurique()
    {
        $('#my-modalRubrique').removeClass('in');
        $('#my-modalRubrique').css('display', 'none');
    }

</script>


