<div id="sf_admin_container">
    <h1>Liste des <u>B.C.E.S & B.D.C.S</u> Provisoires</h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">

            <table class="table table-bordered table-hover" cellspacing="0" style="margin-bottom: 0px;">
                <tbody>
                    <tr>
                        <td><label>Fournisseur</label></td>
                        <td>
                            <select id="id_fournisseur">
                                <option value="0"></option>
                                <?php foreach ($fournisseurs as $fournisseur): ?>
                                    <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Date de création</label></td>
                        <td>
                            De <input type="date" value="<?php echo $datedebut ?>" id="datecreation_from"> à
                             <input type="date" value="<?php echo $datefin ?>"  id="datecreation_to"></label>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/documentProvisoireFournisseur') ?>" class="btn btn-white btn-success">Effacer</a>
                            <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">

    </div>
</div>

<script  type="text/javascript">
    goPage(1);
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('Documents/goPageDocProvisoire') ?>',
            data: 'page=' + page +
                    '&date_debut=' + $("#datecreation_from").val() +
                    '&date_fin=' + $("#datecreation_to").val() +
                    '&id_fournisseur=' + $("#id_fournisseur").val(),
            success: function (data) {
                $('#sf_admin_content').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - U. Contrôle Budgétaire : Liste des Documents Provisoires");
</script>