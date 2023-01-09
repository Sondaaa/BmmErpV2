<div id="sf_admin_container">
    <h1>Statistique Agent Par Direction </h1>
</div>
<div class="col-md-12" id="zone_data_direction" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_direction" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_direction_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataDirection();
    function getDataDirection() {
        $.ajax({
            url: '<?php echo url_for('direction/getDirection') ?>',
            data: '',
            success: function (data) {
                $('#container_direction').html(data);
                $('#zone_data_direction').fadeIn();
                $('#container_direction_2').html(data);
                $('#container_direction_2').html('');

            }
        });

    }
</script>