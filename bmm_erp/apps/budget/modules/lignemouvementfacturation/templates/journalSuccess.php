<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <?php
    switch ($idtype) {
        case 2:
            $titre = " B.D.C";
            break;

        case 7:
            $titre = " B.C.E";
            break;

        case 19:
            $titre = " contrats";
            break;

        default :
            $titre = "";
            break;
    }
    ?>
    <h1><?php echo __('Journal des mouvements' . $titre, array(), 'messages') ?></h1>
    <?php
    $sDatedebut = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, $_SESSION['exercice_budget']));
    $d = new DateTime($_SESSION['exercice_budget'] . date('-m-d'));
    $sDateFin = $d->format($_SESSION['exercice_budget'] . '-m-t');
    ?>

    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">
            <div class="widget-body" style="display: block;">
                <form>
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover" cellspacing="0">
                        <tbody>
                            <tr class="sf_admin_form_row sf_admin_date sf_admin_filter_field_dateoperation">
                                <td><label for="mouvementbanciare_filters_dateoperation">Date d'opération</label></td>
                                <td>
                                    De <input type="date" value="<?php echo $sDatedebut; ?>" id="dateoperation_from">
                                    à <input type="date" value="<?php echo $sDateFin; ?>" id="dateoperation_to">
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_fournisseur">
                                <td><label for="mouvementbanciare_filters_id_fournisseur">Fournisseur</label></td>
                                <td>
                                    <select id="fournisseur_id" class="chosen-select form-control">
                                        <option value="0"></option>
                                        <?php foreach ($fournisseurs as $fr): ?>
                                            <option value="<?php echo $fr->getId(); ?>"><?php echo $fr->getReference() . ' - ' . $fr->getRs(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_facture">
                                <td><label for="mouvementbanciare_filters_id_facture">Facture</label></td>
                                <td><input id="facture" type="text" value="" /></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('mouvementfacturation/journal') ?>" class="btn btn-white btn-success">Effacer</a>
                                    <input type="submit" value="Filtrer" class="btn btn-white btn-success" onclick="goPage(1)">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">

    </div>
</div>

<script  type="text/javascript">
    goPage(1);
    setMinMaxDate();
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('lignemouvementfacturation/goPageJournal') ?>',
            data: 'page=' + page +
                    '&idtype=' + '<?php echo $idtype; ?>' +
                    '&date_debut=' + $("#dateoperation_from").val() +
                    '&date_fin=' + $("#dateoperation_to").val() +
                    '&fournisseur_id=' + $("#fournisseur_id").val() +
                    '&facture=' + $('#facture').val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

    function setMinMaxDate() {
        var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#dateoperation_from').attr('min', min_date);
        $('#dateoperation_from').attr('max', max_date);
        $('#dateoperation_to').attr('min', min_date);
        $('#dateoperation_to').attr('max', max_date);
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - Budget : Journal des mouvements" + "<?php echo $titre; ?>");
</script>