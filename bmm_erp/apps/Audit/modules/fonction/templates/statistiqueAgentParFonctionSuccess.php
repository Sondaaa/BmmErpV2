<div id="sf_admin_container">
    <h1>Statistique Agent Par Fonction </h1>
</div>
<div class="col-md-12" id="zone_data_fonc" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_fonction" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_fonction_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataFonction();
    function getDataFonction() {
        $.ajax({
            url: '<?php echo url_for('fonction/getFonction') ?>',
            data: '',
            success: function (data) {
                $('#container_fonction').html(data);
                $('#zone_data_fonc').fadeIn();
                $('#container_fonction_2').html(data);
                $('#container_fonction_2').html('');
            }
        });
    }
    
</script>