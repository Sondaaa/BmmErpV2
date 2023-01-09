<div id="sf_admin_container">
    <h1>Statistique Agent Par Grade </h1>
</div>
<!--<div class="col-md-12">
    <div class="panel panel-default">-->
        <div id="zone_data_grade" style="display: none;"></div>
<!--    </div>
</div>-->
<div class="col-md-12" id="zone_grdae" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_grade" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_grade_2"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataCategorie();
    function getDataCategorie() {
        $.ajax({
            url: '<?php echo url_for('grade/getGrade') ?>',
            data: '',
            success: function (data) {
                $('#zone_data_grade').html(data);
                $('#zone_grdae').fadeIn();
                $('#container_grade_2').html(data);
                $('#container_grade_2').html('');
            }
        });
    }
</script>