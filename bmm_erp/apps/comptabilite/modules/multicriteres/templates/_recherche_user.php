<?php $users = UtilisateurTable::getInstance()->findAll(); ?>
<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 15%;">Utilisateur : </td>
        <td style="width: 75%;">
            <select id="user" class="chosen-select form-control">
                <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user->getId() ?>" selected="true"><?php echo $user; ?></option>
                <?php endforeach; ?>
            </select>
        </td> 
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    $('#user').chosen({allow_single_deselect: true});

    function rechercher() {
        if ($('#user').val() != '') {
            $('#user').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheUser') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&user=' + $('#user').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#user').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheUser'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&user=' + $('#user').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>