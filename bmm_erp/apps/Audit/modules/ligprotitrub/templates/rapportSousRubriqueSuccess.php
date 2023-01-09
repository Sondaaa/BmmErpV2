<div id="sf_admin_container">
    <h1 id="replacediv">
        Rapport des Sous Rubriques
    </h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">
            <div class="widget-body" style="display: block;">
                <form>
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover" cellspacing="0">
                        <tbody>
                            <tr class="sf_admin_form_row sf_admin_foreignkey sf_admin_filter_field_id_fournisseur">
                                <td><label>Budgets Définitifs</label></td>
                                <td>
                                    <select id="budget_id">
                                        <option value="0"></option>
                                        <?php foreach ($budgets as $budget): ?>
                                            <option value="<?php echo $budget->getId(); ?>"><?php echo $budget->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a onclick="" href="<?php echo url_for('ligprotitrub/rapportSousRubrique') ?>" class="btn btn-white btn-success">Effacer</a>
                                    <input type="submit" value="Filtrer" class="btn btn-white btn-success" onclick="detailSousRubrique()">
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

    function detailSousRubrique() {
        $.ajax({
            url: '<?php echo url_for('ligprotitrub/detailSousRubrique') ?>',
            data: 'id=' + $("#budget_id").val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - C.Gestion : Rapport des Sous Rubriques");
</script>