<div id="sf_admin_container">
    <h1 id="replacediv">
        Aperçu Les Pièces Juridiques
    </h1>
</div>
<div class="col-xs-6" id="zone_edit" style="display: none;">
    <div class="widget-box widget-color-grey">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title smaller">Modifier Pièce Juridique</h4>
        </div>

        <div class="widget-body">
            <div class="widget-main" id="zone_form_edit">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des Pièces Juridiques
        </div>
        <div>
            <table id="list_forme" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Libellé</th>
                        <th style="width: 30%;">Chemin Rèfèrentiel</th>
                        <th style="width: 30%;">Dossier Comptable</th>
                        <th style="width: 20%; text-align: center;">Opérations</th>

                    </tr>
                    <tr>
                        <th><input type="text" id="libelle_filtre" onkeyup="goPage(1);" /></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('referentielcomptable/liste_piecesjuridique', array('pager' => $pager)) ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@piecejuridique') ?>',
            data: 'page=' + page + '&libelle=' + $("#libelle_filtre").val(),
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }
    function deleteForme(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette pièce juridique   ?",
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
                    validerSuppression(id);
                }
            }
        });
    }

    function validerSuppression(id) {
        $.ajax({
            url: '<?php echo url_for('@deletePieceJuridique') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_forme > tbody').html(data);
            }
        });
    }
    function editForme(id) {
        $.ajax({
            url: '<?php echo url_for('@editPiecejuridique') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#zone_form_edit').html(data);
                $('#zone_edit').fadeIn();
            }
        });
    }
    function annuler() {
        $('#zone_edit').fadeOut();
    }
</script>
<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Pièces Comptable ");
</script>