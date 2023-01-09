<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste Dossiers Comptables
        </small>
    </h1>
</div>

<div>
    <div class="col-sm-12">
        <?php if ($permission_profil): ?>
            <a href="<?php echo url_for('dossier/new') ?>" class="btn btn-app btn-success radius-4">
                <i class="ace-icon fa fa-folder-open-o bigger-190"></i>
                Nouveau
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des dossiers comptables
        </div>

        <div>
            <table id="liste_dossier" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">Code</th>
                        <th style="width: 40%; text-align: center;">Dossier Comptable</th>
                        <th style="width: 10%; text-align: center;">Téléphone</th>
                        <th style="width: 10%; text-align: center;">Date Création</th>
                        <th style="width: 10%; text-align: center;">Etat</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="code_filtre" onkeyup="goPage(1);" <?php if (sizeof($dossiers) == 0): ?> disabled="true" <?php endif; ?>/></th>
                        <th><input type="text" id="raisonsociale_filtre" onkeyup="goPage(1);" <?php if (sizeof($dossiers) == 0): ?> disabled="true" <?php endif; ?>/></th>
                        <th></th>
                        <th></th>
                        <th><select id="etat_filtre" class="mws-select2 large"
                                    onchange="goPage(1);" <?php if (sizeof($dossiers) == 0): ?> disabled="true" <?php endif; ?>>
                                <option value="">choisir</option>
                                <option value="true">Actif</option>
                                <option value="false">Inactif</option>   
                            </select>
                 <!--<input type="text" id="etat_filtre" onkeyup="goPage(1);" <?php if (sizeof($dossiers) == 0): ?> disabled="true" <?php endif; ?>/></th>-->
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('dossier/liste', array('dossiers' => $dossiers)) ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('dossier/getPager') ?>',
            data: 'page=' + page +
                    '&code=' + $("#code_filtre").val() +
                    '&raisonsociale=' + $("#raisonsociale_filtre").val() + '&etat=' + $("#etat_filtre").val()
            ,
            success: function (data) {
                $('#liste_dossier > tbody').html(data);
            }
        });
    }

    function deleteDossier(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce dossier comptable ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerSuppressionAnterieur(id);
                }
            }
        });
    }

    function validerSuppressionAnterieur(id) {
        var page = 1;
        $.ajax({
            url: '<?php echo url_for('dossier/delete') ?>',
            data: 'id=' + id +
                    '&page=' + page +
                    '&code=' + $("#code_filtre").val() +
                    '&raisonsociale=' + $("#raisonsociale_filtre").val(),
            success: function (data) {
                if (data === 'erreur') {
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Ce dossier a un plan comptable ou un relation avec client ou fournisseuer on ne pete pas le supprimer </span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                } else
                    $('#liste_dossier > tbody').html(data);

            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Dossier Comptable");
</script>

<style>

    #liste_dossier tbody td{text-align: center; vertical-align: middle;}

</style>