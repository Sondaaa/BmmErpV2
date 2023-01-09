<div class="modal-dialog" style="width: 95%;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="smaller lighter blue no-margin">
                Liste des ouvriers du chantier : <?php echo $chantier; ?>
                <span style="float: right;">
                    <button onclick="chargerOuvrierChantierByAnneeOuvrier('<?php echo $chantier->getId(); ?>')" class="btn btn-primary btn-xs" style="margin-top: -7px; height: 28px;">
                        <i class="ace-icon fa fa-search icon-only"></i>
                    </button>
                </span>
                <span style="float: right; margin-right: 15px;">Année : <input id="annee_chantier" class="bootbox-input bootbox-input-text" autocomplete="off" type="text" maxlength="4" style="width: 80px; float: right; text-align: center; margin-top: -7px; margin-left: 5px;" value="<?php echo date('Y') ?>"></span>
                <span style="float: right; margin-top: -7px; margin-right: 15px;">Ouvrier : 
                    <?php $ouvriers = OuvrierTable::getInstance()->findAll(); ?>
                    <select id="chantier_ouvrier_id" class="chosen-select">
                        <option value="0"></option>
                        <?php foreach ($ouvriers as $ouvrier): ?>
                            <option value="<?php echo $ouvrier->getId() ?>"><?php echo $ouvrier ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </h4>
        </div>
        <div class="modal-body">
            <div class="bootbox-body">
                <form class="bootbox-form">
                    <fieldset id="zone_table_chantier" class="col-lg-12" style="margin-bottom: 10px; margin-top: 5px;">
                        <?php include_partial('liste_historique_chantier', array('annee' => date('Y'), 'id_ouvrier' => '0', 'chantier' => $chantier)) ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row"></div>
        <div class="modal-footer">
            <a id="btn_imprime_chantier" target="_blanc" href="" class="btn btn-success pull-left"><i class="ace-icon fa fa-print"></i> Imprimer</a>
            <button id="btnfermer" class="btn pull-right" data-dismiss="modal">Fermer</button>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.chosen-select').chosen({allow_single_deselect: true});

    function chargerOuvrierChantierByAnneeOuvrier(id){
        $.ajax({
            url: '<?php echo url_for('chantier/chargerOuvrierChantierFiltre') ?>',
            data: 'id=' + id +
                    '&annee=' + $('#annee_chantier').val() +
                    '&id_ouvrier=' + $('#chantier_ouvrier_id').val(),
            success: function (data) {
                $('#zone_table_chantier').html(data);
            }
        });
    }
</script>

<style>

    .dataTables_wrapper .row:first-child {
        padding-top: 7px;
        padding-bottom: 0px;
    }

    .btn{padding: 2px 12px !important;}
    .modal-body{padding-top: 5px !important;}
    .table > tbody > tr > td{padding-top: 5px !important;padding-bottom: 5px !important;}

</style>