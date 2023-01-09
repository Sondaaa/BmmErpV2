<div id="sf_admin_container">
    <h1>Statistique Agent Par Service  </h1>
</div>
<div class="col-md-12" id="zone_data_service" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_service" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_service_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script>

    getDataDirection();
    function getDataDirection() {
        $.ajax({
            url: '<?php echo url_for('servicerh/getService') ?>',
            data: '',
            success: function (data) {
                $('#container_service').html(data);
                $('#zone_data_service').fadeIn();
                $('#container_service_2').html(data);
                $('#container_service_2').html('');
            }
        });
    }
    
</script>