<div id="sf_admin_container">
    <h1>Statistique Agent Par Corps </h1>
</div>
<div class="col-md-12" id="zone_data_corps" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_corps" style="height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_corps_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataEchelle();
    function getDataEchelle() {
        $.ajax({
            url: '<?php echo url_for('corps/getCorps') ?>',
            data: '',
            success: function (data) {
                $('#container_corps').html(data);
                $('#zone_data_corps').fadeIn();
                $('#container_corps_2').html(data);
                $('#container_corps_2').html('');
            }
        });
    }
    
</script>