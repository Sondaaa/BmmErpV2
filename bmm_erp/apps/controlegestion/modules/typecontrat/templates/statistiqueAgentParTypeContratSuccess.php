<div id="sf_admin_container">
    <h1>Statistique Agent Par Situation Administrative </h1>
</div>
<div class="col-md-12" id="zone_data_typecontrat" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_typecontrat" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_typecontrat_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>
<script>

    getDataTypecontrat();
    function getDataTypecontrat() {
        $.ajax({
            url: '<?php echo url_for('typecontrat/getTypeContrat') ?>',
            data: '',
            success: function (data) {
                $('#container_typecontrat').html(data);
                $('#zone_data_typecontrat').fadeIn();
                $('#container_typecontrat_2').html(data);
                $('#container_typecontrat_2').html('');
            }
        });
    }
    
</script>