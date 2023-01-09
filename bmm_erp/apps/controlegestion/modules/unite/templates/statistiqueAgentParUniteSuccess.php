<div id="sf_admin_container">
    <h1>Statistique Agent Par Unite   </h1>
</div>
<div class="col-md-12" id="zone_data_unite" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_unite" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_unite_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script>

    getDataUnite();
    function getDataUnite() {
        $.ajax({
            url: '<?php echo url_for('unite/getUnite') ?>',
            data: '',
            success: function (data) {
                $('#container_unite').html(data);
                $('#zone_data_unite').fadeIn();
                $('#container_unite_2').html(data);
                $('#container_unite_2').html('');
            }
        });
    }
    
</script>