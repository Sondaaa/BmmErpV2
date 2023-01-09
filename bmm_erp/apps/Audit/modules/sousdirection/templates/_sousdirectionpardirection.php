<div id="my-modalsousdirectionpardirection">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $direction = Doctrine_Core::getTable('direction')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Sous Directions de la Direction " <?php echo $direction->getLibelle(); ?>"</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Numéro</th>
                                    <th>Libellé</th> 
                                    <th style="display: none">Code Sous Direction</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('sousdirection sd')
                                        ->where('sd.id_direction=' . $idd)
                                        ->execute();
                                $ag = new Sousdirection();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer" ondblclick="chSousDirectpardirection_rh('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                        <td style="width: 20%"><?php echo $i; ?> </td>
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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('sousdirection/Imprimerliste?idd=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn  pull-left" onclick="Fermersousdirectionpardirection_rh()">
                            Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("table").addClass("table  table-bordered table-hover");
    function chSousDirectpardirection_rh(id, libelle){
        $('#my-modalsousdirection-rh').removeClass('in');
        $('#my-modalsousdirection-rh').css('display', 'none');
        $('#idsousdirection_rh').val(id);
        $('#libellesousdirection_rh').val(libelle);
    }
    function Fermersousdirectionpardirection_rh(){
        $('#my-modalsousdirection-rh').removeClass('in');
        $('#my-modalsousdirection-rh').css('display', 'none');
    }

</script>