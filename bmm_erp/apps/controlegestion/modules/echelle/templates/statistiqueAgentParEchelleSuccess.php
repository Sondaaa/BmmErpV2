<div id="sf_admin_container">
    <h1>Statistique Agent Par Echelle </h1>
</div>
<div class="col-md-12" id="zone_data_echelle" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_echelle" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_echelle_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataEchelle();
    function getDataEchelle() {
        $.ajax({
            url: '<?php echo url_for('echelle/getEchelle') ?>',
            data: '',
            success: function (data) {
                $('#container_echelle').html(data);
                $('#zone_data_echelle').fadeIn();
                $('#container_echelle_2').html(data);
                $('#container_echelle_2').html('');
            }
        });
    }
    
</script>