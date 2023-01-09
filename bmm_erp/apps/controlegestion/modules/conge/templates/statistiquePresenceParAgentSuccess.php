<div id="sf_admin_container">
    <h1>Statistiques du Consommation des Congés Par Agent</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
              
                <?php $agents =  Doctrine_Core::getTable('agents')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 25%;">Agents</td>
                        <td style="width: 75%;">
                            <select id="agents_presence" onchange="getData()">
                                <option value="0"></option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getIdrh()." " . $agent->getNomcomplet()." ".$agent->getPrenom(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div id="zone_data_presence" style="display: block;"></div>
               
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_chart_presence" style="display: block;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presences" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12 pull-right" id="zone_agent_presence" style="display: block;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_agent_conge" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>



<script  type="text/javascript">

    function getData() {
        if ($('#agents_presence').val() != 0) {
            $.ajax({
                url: '<?php echo url_for('conge/getPresence') ?>',
                data: 'id=' + $('#agents_presence').val(),
                success: function (data) {
                    $('#zone_data_presence').html(data);
                    $('#zone_data_presence').fadeIn();
                    $('#zone_chart_presence').fadeIn();
                    $('#zone_agent_presence').fadeIn();
                    
                }
            });
        } else {
            $('#zone_data_presence').hide();
            $('#zone_chart_presence').hide();
            $('#zone_agent_conge').hide();
            
        }
        }

</script>