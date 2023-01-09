<div id="sf_admin_container">
    <h1>Statistique Agent Par Sexe </h1>
</div>
<div class="col-md-12" id="zone_data_Sexe" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_sexe" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_sexe_2"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataSexe();
    function getDataSexe() {
        $.ajax({
            url: '<?php echo url_for('agents/getSexe') ?>',
            data: '',
            success: function (data) {
                $('#container_sexe').html(data);
                $('#zone_data_Sexe').fadeIn();
                $('#container_sexe_2').html(data);
                $('#container_sexe_2').html('');
            }
        });
    }
</script>