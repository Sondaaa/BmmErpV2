<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Fiche Entête Budget : <?php echo $titrebudjet->getLibelle() . ' - ' . $titrebudjet->getTypebudget(); ?>
    </h1>
    <div class="col-sm-12">
        <?php
        $html = str_replace('<h2>', '<h3>', html_entity_decode($titrebudjet->getFormHtmlBudget($sf_user->getAttribute('userb2m'))));
        $html = str_replace('</h2>', '</h3>', $html);
        $html = str_replace('<br><h3>', '<h3>', $html);
        ?>
        <?php //echo html_entity_decode($html); ?>
        <?php echo $html; ?>
        <fieldset style="margin-top: 20px;" class="col-md-6 pull-right">
            <legend>Action</legend>
            <a class="btn btn-white btn-default" href="<?php echo url_for('Documents/Imprimerfichebudget?idfiche=') . $titrebudjet->getId() ?>" target="_blanc">
                <i class="ace-icon fa fa-file-pdf-o"></i> Exporter PDF
            </a>
            <?php if (trim($titrebudjet->getTypebudget()) == "Budget Prévisionnel / Direction & Projet"): ?>
                <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel') ?>">
                    <i class="ace-icon fa fa-undo"></i> Retour à la Liste
                </a>
            <?php elseif (trim($titrebudjet->getTypebudget()) == "Budget Prévisionnel Global"): ?>
                <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/index?type=Budget Prévisionnel Global') ?>">
                    <i class="ace-icon fa fa-undo"></i> Retour à la Liste
                </a>
            <?php else: ?>
                <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/index?type=Final') ?>">
                    <i class="ace-icon fa fa-undo"></i> Retour à la Liste
                </a>
            <?php endif; ?>
        </fieldset>
    </div>
</div>

<script>

    function setTableAnnexe(id) {
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/editTableAnnexe') ?>',
            data: 'id=' + id,
            success: function (data) {
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
                    callback: function (result) {
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
    table{margin-bottom: 0px !important;}
    h3{margin-top: 0px !important; text-align: center; font-weight: bold;}
    h2{font-weight: bold; color: #5a985b;}
</style>