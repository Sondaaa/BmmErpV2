<div id="sf_admin_container">
    <h1>Statistiques Par Type Congé</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
                <?php $types = Doctrine_Core::getTable('typeconge')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 25%;">Type Congé</td>
                        <td style="width: 75%;">
                            <select id="typeconge" onchange="getType()">
                                <option value="0"></option>
                                <?php foreach ($types as $type): ?>
                                    <option value="<?php echo $type->getId(); ?>"><?php echo $type->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div id="type_conge" style="display: none;"></div>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_chart_type" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_type" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12 pull-right" id="zone_agent_type" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_agent_type" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>


<script>

    function getType() {

        if ($('#typeconge').val() != 0) {

            $.ajax({
                url: '<?php echo url_for('conge/getChartType') ?>',
                data: 'id=' + $('#typeconge').val(),
                success: function (data) {
                    $('#type_conge').html(data);
                    $("#type_conge").fadeIn();
                    $('#zone_chart_type').fadeIn();
                    $('#zone_agent_type').fadeIn();
                }
            });
        } else {
            $('#type_conge').hide();
            $('#zone_chart_type').hide();
            $('#zone_agent_type').hide();
        }
    }

</script>