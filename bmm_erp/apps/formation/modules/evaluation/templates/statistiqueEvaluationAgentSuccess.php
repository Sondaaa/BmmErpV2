<div id="sf_admin_container">
    <h1>Statistiques d'Evalutaions par Formation</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
                <legend>Rapport d'évaluation de la formation</legend>
                <?php $formations = BesoinsdeformationTable::getInstance()->getAllRealise(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 25%;">Formation</td>
                        <td style="width: 75%;">
                            <select id="formation" onchange="getChart()">
                                <option value="0"></option>
                                <?php foreach ($formations as $formation): ?>
                                    <option value="<?php echo $formation->getId(); ?>"><?php echo $formation->getBesoins(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div id="zone_data" style="display: none;">Data</div>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_chart" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-6 pull-right" id="zone_agent" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_agent" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-6 pull-left" id="zone_moyenne" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_moyenne" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<script>

    function getChart() {
        if ($('#formation').val() != 0) {
            $.ajax({
                url: '<?php echo url_for('evaluation/getChart') ?>',
                data: 'id=' + $('#formation').val(),
                success: function (data) {
                    $('#zone_data').html(data);
                    $('#zone_data').fadeIn();
                    $('#zone_chart').fadeIn();
                    $('#zone_agent').fadeIn();
                    $('#zone_moyenne').fadeIn();
                    $('#zone_data').html(data);
                }
            });
        } else {
            $('#zone_chart').hide();
            $('#zone_data').hide();
            $('#zone_agent').hide();
            $('#zone_moyenne').hide();
        }
    }

</script>