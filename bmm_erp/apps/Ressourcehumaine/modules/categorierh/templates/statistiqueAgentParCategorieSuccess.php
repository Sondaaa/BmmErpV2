<div id="sf_admin_container">
    <h1>Statistique Agent Par Catégorie </h1>
</div>
<!--<div class="col-md-12">
    <div class="panel panel-default">-->
        <!-- /.panel-heading -->
        <!--        <div class="panel-body">
                    <fieldset style="padding: 10px">
        -->                <div id="zone_data_cat" style="display: none;"></div>
        <!--
                    </fieldset>
                </div>-->
<!--    </div>
</div>-->
<div class="col-md-12" id="zone_categorie" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_categorie" style="min-width: 150px; height: 500px; margin: 0 auto; width: 100%;"></div>
            <div id="container_categorie_2"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">

    getDataCategorie();
    function getDataCategorie() {
        $.ajax({
            url: '<?php echo url_for('categorierh/getCategorie') ?>',
            data: '',
            success: function (data) {
                $('#zone_data_cat').html(data);
                $('#zone_categorie').fadeIn();
                $('#container_categorie_2').html(data);
                $('#container_categorie_2').html('');
            }
        });
    }
</script>