<div id="sf_admin_container">
    <h1>Statistique Agent Par Echelon </h1>
</div>
<div class="col-md-12" id="zone_data_echelon" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_echelon" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_echelon_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataEchelon();
    function getDataEchelon() {
        $.ajax({
            url: '<?php echo url_for('echelon/getEchelon') ?>',
            data: '',
            success: function (data) {
                $('#container_echelon').html(data);
                $('#zone_data_echelon').fadeIn();
                $('#container_echelon_2').html(data);
                $('#container_echelon_2').html('');
            }
        });
    }

</script>