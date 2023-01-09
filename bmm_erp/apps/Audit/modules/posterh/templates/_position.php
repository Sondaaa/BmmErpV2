<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Positions administratives</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 20%">Numéro</th>
                                <th>Libellé</th> 
                                <th style="display: none">Code Position</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('positionadministratif')
                                    ->execute();
                            $ag = new PositionadministratifForm();
                     $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer" ondblclick="chPosition('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <td style="width: 20%"><?php echo $i; ?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                         $i++;   }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('posterh/ImprimerAlllistePositions') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn  pull-left" onclick="fermerposition()">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    function chPosition(id, libelle)
    {
        $('#my-modalposition').removeClass('in');
        $('#my-modalposition').css('display', 'none');
        $('#idposition').val(id);
        $('#libelleposition').val(libelle);
    }
    function fermerposition()
    {
        $('#my-modalposition').removeClass('in');
        $('#my-modalposition').css('display', 'none');
    }

</script>