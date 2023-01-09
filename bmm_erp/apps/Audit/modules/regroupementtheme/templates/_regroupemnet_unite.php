<div style="overflow: auto; width: 100%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Regroupements des Thémes de Formation</h4>
            </div>
            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N°</th>  
                                <th style="width: 30%">Libellé</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('regroupementtheme')
                                    ->execute();
                            $ag = new Regroupementtheme();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idde" ondblclick="chargerpersonne1_unite('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getLibelle(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('regroupementtheme/ImprimerRegroupement') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermeragentsUnite()" >
                        Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function chargerpersonne1_unite(id, libelle)
    {
        //alert(mat);
        $('#my-modal-unite6').removeClass('in');
        $('#my-modal-unite6').css('display', 'none');
        $('#iddirection_unite6').val(id);
        $('#direction_unite6').val(libelle);

    }
    function fermeragentsUnite()
    {
        $('#my-modal-unite6').removeClass('in');
        $('#my-modal-unite6').css('display', 'none');
    }

</script>