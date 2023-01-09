<?php $devises = DeviseTable::getInstance()->findAll(); ?>
<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 15%;">Devise : </td>
        <td style="width: 75%;">
            <select id="devise" class="chosen-select form-control">
                <?php foreach ($devises as $dsoc) : ?>
                    <option value="<?php echo $dsoc->getId() ?>" selected="true"><?php echo $dsoc->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
        </td> 
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    function rechercher() {
        if ($('#devise').val() != '') {
            $('#devise').css('border', '');
            $.ajax({
                url: '<?php echo url_for('multicriteres/rechercheDevise') ?>',
                data: 'filtre=' + $('#filtre_all').val() + '&devise=' + $('#devise').val(),
                success: function (data) {
                    $('#liste_recherche').html(data);
                }
            });
        } else {
            $('#devise').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheDevise'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&devise=' + $('#devise').val(),
            success: function (data) {
                $('#liste_recherche').html(data);
            }
        });
    }

</script>