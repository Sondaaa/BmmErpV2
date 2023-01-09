<div id="sf_admin_container">
    <h1>Statistique Agent Par Sous Corps </h1>
</div>
<div class="col-md-12" id="zone_data_souscorps" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_souscorps" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_souscorps_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script>

    getDataFonction();
    function getDataFonction() {
        $.ajax({
            url: '<?php echo url_for('souscorps/getSouscorps') ?>',
            data: '',
            success: function (data) {
                $('#container_souscorps').html(data);
                $('#zone_data_souscorps').fadeIn();
                $('#container_souscorps_2').html(data);
                $('#container_souscorps_2').html('');
            }
        });
    }

</script>