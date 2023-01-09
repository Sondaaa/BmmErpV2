<div id="sf_admin_container">
    <h1>Statistiques de Suivi Présence Par Agent</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
             <fieldset style="padding: 10px">
              
                <?php $agents =  Doctrine_Core::getTable('agents')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 10%;">Agents</td>
                        <td style="width: 25%;">
                            <select id="agents_presence" onchange="getDataPresence()">
                                <option value="0"></option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getIdrh()." " . $agent->getNomcomplet()." ".$agent->getPrenom(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                         <td style="width: 10%;">Choisir l'Année</td>
                        <td style="width: 25%;">
                            <select id="annee_conge" class="chosen-select form-control" data-placeholder="Déterminez l'année" onchange="getDataPresence()" >
                                <option value=""></option>                  
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                         <td style="width: 10%;">Choisir l'Année</td>
                        <td style="width: 20%;">
                            <select id="mois_conge" class="chosen-select form-control" data-placeholder="Déterminez l'année" onchange="getDataPresence()" >
                                <option value=""></option>                 
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                <?php if($i<10): $month="0".$i; else: $month=$i; endif;  ?>
                                <option value="<?php echo "0".$i; ?>" id="mois_<?php echo $i; ?>" >
                                        <?php  setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                                        echo html_entity_decode(strftime("%B",  strtotime(date("Y")."-".$month."-".date("d")))); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <div id="zone_data_presence" style="display: none;"></div>
               
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_chart_prese_1" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_pres_1" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12 pull-right" id="zone_agent_pr_1" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_agent_pr_1" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>



<script>

    function getDataPresence() {
        if ($('#agents_presence').val() != 0 && $('#annee_conge').val() != 0 ) {
            $.ajax({
                url: '<?php echo url_for('conge/getChartPresence') ?>', 
                data: 'id=' + $('#agents_presence').val() +'&annee=' + $('#annee_conge').val()+'&mois=' + $('#mois_conge').val(),
                success: function (data) {
//                    $('#zone_data_presence').html(data);
//                    $('#zone_data_presence').fadeIn();
                    $('#zone_chart_prese_1').fadeIn();
                    $('#zone_agent_pr_1').fadeIn();
                }
            });
        }
         else if ($('#agents_presence').val() == 0 ){ 
//          alert("choisir l'agent !!");
            $('#zone_chart_prese').hide();
            $('#zone_data_presence').hide();
            $('#zone_agent_pr').hide();}
        else if ($('#annee_conge').val() == 0) { 
//        alert("choisir l'année !!");
            $('#zone_chart_prese').hide();
            $('#zone_data_presence').hide();
            $('#zone_agent_pr').hide();
           }
        else {
        
            $('#zone_chart_prese_1').hide();
            $('#zone_data_presence').hide();
            $('#zone_agent_pr').hide();
        }
    }

</script>