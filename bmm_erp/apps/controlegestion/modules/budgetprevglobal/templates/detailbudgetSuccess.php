<div id="sf_admin_container">
    <h1 id="replacediv">
        Fiche Entête Budget : <?php echo $titrebudjet->getLibelle() . ' - ' . $titrebudjet->getTypebudget(); ?>
    </h1>
    <div class="col-sm-12">
        <?php
        $html = str_replace('<h2>', '<h3>', html_entity_decode($titrebudjet->ReadHtmlBudgetPrevisionelleGlobal()));
        $html = str_replace('</h2>', '</h3>', $html);
        $html = str_replace('<br><h3>', '<h3>', $html);
        ?>
        <?php echo $html; ?>
        <fieldset style="margin-top: 20px;" class="col-md-6 pull-right">
            <legend>Action</legend>
            <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerfichebudget?idfiche=') . $titrebudjet->getId() ?>" target="_blanc">
                <i class="ace-icon fa fa-file-pdf-o"></i> Exporter PDF
            </a>

            <a class="btn btn-white btn-success" href="<?php echo url_for('budgetprevglobal') ?>">
                <i class="ace-icon fa fa-undo"></i> Retour à la Liste
            </a>

        </fieldset>
    </div>
</div>

<script>
    function setTableAnnexe(id) {
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/editTableAnnexe') ?>',
            data: 'id=' + id,
            success: function(data) {
                bootbox.confirm({
                    message: data,
                    buttons: {
                        cancel: {
                            label: "Annuler",
                            className: "btn-danger btn-sm",
                        },
                        confirm: {
                            label: "Valider",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            //rien à faire
                            return false;
                        }
                    }
                });
            }
        });
    }
</script>

<style>
    table {
        margin-bottom: 0px !important;
    }

    h3 {
        margin-top: 0px !important;
        text-align: center;
        font-weight: bold;
    }

    h2 {
        font-weight: bold;
        color: #5a985b;
    }
</style>