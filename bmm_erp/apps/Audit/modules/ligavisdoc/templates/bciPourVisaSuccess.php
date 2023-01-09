<div id="sf_admin_container">
    <?php if ($id_typedoc == 6): ?>
        <h1>Liste des B.C.I ( => Visa d'Achat )</h1>
    <?php elseif ($id_typedoc == 9): ?>
        <h1>Liste des B.C.I.M.P ( => Visa d'Achat )</h1>
    <?php endif; ?>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">
            <div class="widget-body" style="display: block;">
                <form>
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><label for="mouvementbanciare_filters_dateoperation">Date d'opération</label></td>
                                <td>
                                    De <input type="date" value="" id="datecreation_from">
                                    à <input type="date" value="" id="datecreation_to">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('ligavisdoc/bciPourVisa') ?>" class="btn btn-white btn-success">Effacer</a>
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

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('ligavisdoc/goPage') ?>',
            data: 'page=' + page +
                    '&id_typedoc=<?php echo $id_typedoc; ?>' +
                    '&date_debut=' + $("#datecreation_from").val() +
                    '&date_fin=' + $("#datecreation_to").val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

</script>

<?php if ($id_typedoc == 6): ?>
    <script  type="text/javascript">
        document.title = ("BMM - U. Contrôle Budgétaire : Liste des B.C.I ( => Visa d'Achat )");
    </script>
<?php elseif ($id_typedoc == 9): ?>
    <script  type="text/javascript">
        document.title = ("BMM - U. Contrôle Budgétaire : Liste des B.C.I.M.P ( => Visa d'Achat )");
    </script>
<?php endif; ?>