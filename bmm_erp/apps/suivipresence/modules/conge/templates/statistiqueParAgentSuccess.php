<div id="sf_admin_container">
    <h1>Statistiques du Consommation des Congés Par Agent</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">

                <?php $agents = Doctrine_Core::getTable('agents')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 20%;">Agents</td>
                        <td style="width: 30%;">
                            <select id="agents_conge" onchange="getData()">
                                <option value="0"></option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getIdrh() . " " . $agent->getNomcomplet() . " " . $agent->getPrenom(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 20%;">Choisir l'Année</td>
                        <td style="width: 30%;">
                            <select id="annee_conge" class="chosen-select form-control" data-placeholder="Déterminez l'année" onchange="getData()" >
                                <option value=""></option>                  
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div id="zone_data_conge" style="display: none;">Data</div>

            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_chart_conge" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_conge" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12 pull-right" id="zone_agent_conge" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_agent_conge" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>



<script>

    function getData() {
        if ($('#agents_conge').val() != 0 && $('#annee_conge').val() != 0) {
            $.ajax({
                url: '<?php echo url_for('conge/getChart') ?>',
                data: 'id=' + $('#agents_conge').val() + '&annee=' + $('#annee_conge').val(),
                success: function (data) {
                    $('#zone_data_conge').html(data);
                    $('#zone_data_conge').fadeIn();
                    $('#zone_chart_conge').fadeIn();
                    $('#zone_agent_conge').fadeIn();

                }
            });
        }
        else if ($('#agents_conge').val() == 0) {
//        alert("choisir l'agent !!");
            $('#zone_chart_conge').hide();
            $('#zone_data_conge').hide();
            $('#zone_agent_conge').hide();
        }
        else if ($('#annee_conge').val() == 0) {
//        alert("choisir l'année !!");
            $('#zone_chart_conge').hide();
            $('#zone_data_conge').hide();
            $('#zone_agent_conge').hide();
        }
        else {

            $('#zone_chart_conge').hide();
            $('#zone_data_conge').hide();
            $('#zone_agent_conge').hide();

        }
    }

</script>