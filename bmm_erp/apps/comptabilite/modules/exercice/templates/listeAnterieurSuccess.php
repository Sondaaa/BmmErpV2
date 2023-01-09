<div id="sf_admin_container">
    <h1 id="replacediv"> Dossier Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Exercice Antérieur
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter exercice antérieurs</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Dossier comptable</label>
                            <?php
                            $user = $sf_user->getAttribute('userB2m');
                            if ($user->getProfil()->getId() != 1) {
                                $dossiers = DossierComptableTable::getInstance()->getDossierByUser($user->getId());
                            } else {
                                $dossiers = DossiercomptableTable::getInstance()->getAll();
                            }
                            ?>
                            <select class="chosen-select form-control" id="dossier_exercice">
                                <option value=""></option>
                            <?php foreach ($dossiers as $dossier): ?>
                                    <option value="<?php echo $dossier->getId() ?>"><?php echo trim($dossier->getRaisonsociale()); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--<input type="text" value="<?php // echo $dossier->getRaisonsociale()     ?>" disabled="true" class="form-control" />-->
                        </fieldset>
                        <br>
                        <fieldset>
                            <label>Exercice comptable</label>
                            <select class="chosen-select form-control" id="exercice" data-placeholder="Exercice comptable">
                                <option value=""></option>
<?php foreach ($exercices as $exercice): ?>
                                    <option value="<?php echo $exercice->getId() ?>"><?php echo $exercice->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>

                        <hr />
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-sm btn-success pull-right" onclick="AjoutAnterieur()">
                                    Ajouter
                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
            Liste des exercices antérieurs
        </div>

        <div>
<?php include_partial('exercice/listeAnterieur', array('pager' => $pager)) ?> 
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPageAnterieur(page) {
        $.ajax({
            url: '<?php echo url_for('@goPageAnterieur') ?>',
            data: 'page=' + page +
                    '&dossier=' + $("#dossier_filtre").val() +
                    '&exercice=' + $("#exercice_filtre").val() +
                    '&cloture=' + $("#cloture_filtre").val(),
            success: function (data) {
                $('#list_anterieur > tbody').html(data);
            }
        });
    }

    function AjoutAnterieur() {
//        var dossier = '<?php // echo $dossier->getId()     ?>';

        if (verifierForm()) {
            var dossier = $("#dossier_exercice").val();
            $.ajax({
                url: '<?php echo url_for('@ajoutAnterieur') ?>',
                data: 'dossier_save=' + dossier + '&exercice_save=' + $("#exercice").val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cet exercice antérieur existe déjà, Veuillez choisir un autre exercice !</span>",
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                        return false;
                    } else {
                        $('#list_anterieur > tbody').html(data);
                    }
                }
            });
        }
    }

    function verifierForm() {
        var valide = true;
        if ($('#dossier_exercice').val() !== '')
            $('#dossier_exercice_chosen > .chosen-single').css('border', '');
        else {
            $('#dossier_exercice_chosen > .chosen-single').css('border-color', '#f2a696');
            valide = false;
        }

        if ($('#exercice').val() !== '')
            $('#exercice_chosen > .chosen-single').css('border', '');
        else {
            $('#exercice_chosen > .chosen-single').css('border-color', '#f2a696');
            valide = false;
        }
        return valide;
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Exercice Antérieur");
</script>