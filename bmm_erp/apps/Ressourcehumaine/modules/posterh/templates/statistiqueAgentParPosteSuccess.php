<div id="sf_admin_container">
    <h1>Statistique Agent Par Poste  </h1>
</div>
<div class="col-md-12" id="zone_data_poste" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_poste" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_poste_2"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataPoste();
    function getDataPoste() {
        $.ajax({
            url: '<?php echo url_for('posterh/getPoste') ?>',
            data: '',
            success: function (data) {
                $('#container_poste').html(data);
                $('#zone_data_poste').fadeIn();
                $('#container_poste_2').html(data);
                $('#container_poste_2').html('');
            }
        });
    }
</script>