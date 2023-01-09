<div id="sf_admin_container">
    <h1>Statistique Agent Par Sous Direction </h1>
</div>
<div class="col-md-12" id="zone_data_sousdirection" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_sousdirection" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_sousdirection_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataSousDirection();
    function getDataSousDirection() {
        $.ajax({
            url: '<?php echo url_for('sousdirection/getSousdirection') ?>',
            data: '',
            success: function (data) {
                $('#container_sousdirection').html(data);
                $('#zone_data_sousdirection').fadeIn();
                $('#container_sousdirection_2').html(data);
                $('#container_sousdirection_2').html('');
            }
        });

    }
</script>