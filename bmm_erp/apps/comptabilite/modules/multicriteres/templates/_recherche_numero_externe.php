<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
    <tr>
        <td style="width: 15%;">N° externe : </td>
        <td style="width: 75%;">
            <input type="text" id="externe" style="width: 100%;" />
        </td> 
        <td style="text-align: center; width: 10%;">
            <button id="button_rechercher" style="min-width: 130px;" class="btn btn-xs btn-primary" onclick="rechercher()"><i class="ace-icon fa fa-search bigger-110"></i> Afficher</button>
        </td>
    </tr>
</table>

<script  type="text/javascript">
    
   function rechercher() {
        if($('#externe').val() != '' ){
            $('#externe').css('border', '');
        $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheExterne') ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&externe=' + $('#externe').val(),
            success: function(data) {
                $('#liste_recherche').html(data);
            }
        });
    } else {
            $('#externe').css('border', '3px solid red');
            $('#liste_recherche').html('');
        }
    }
    
    function goPage(page) {
         $.ajax({
            url: '<?php echo url_for('multicriteres/rechercheExterne'); ?>',
            data: 'filtre=' + $('#filtre_all').val() + '&page=' + page + '&externe=' + $('#externe').val(),
                  
            success: function(data) {
                $('#liste_recherche').html(data);
            }
        });
    }
</script>