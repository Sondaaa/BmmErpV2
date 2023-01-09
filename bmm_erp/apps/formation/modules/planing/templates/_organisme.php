<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Organismes de Formation</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">Numero </th> 
                                <th style="width: 10%">Fournisseur</th>  
                         
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('fournisseur')
                                    ->execute();
                            $ag = new Organisme();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idorga" ondblclick="chargerOrganisme('<?php echo $ag->getId(); ?>', '<?php echo $ag->getRs(); ?>')">
                                    <!-- '', -->
                                    <td style="width: 10%;text-align: center"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getRs(); ?></td>
                                    </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteOrganisme') ?>" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerorganisme()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script>
    function chargerOrganisme(id, libelle)
    {

        $('#my-modal2').removeClass('in');
        $('#my-modal2').css('display', 'none');
        $('#idorganisme').val(id);
        $('#organisme').val(libelle);

    }
    function fermerorganisme()
    {
        $('#my-modal2').removeClass('in');
        $('#my-modal2').css('display', 'none');
    }

</script>


