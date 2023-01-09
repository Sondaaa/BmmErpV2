<div id="sf_admin_container">
    <h1>Suivi présence </h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
                <?php $agents = Doctrine_Core::getTable('agents')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 10%;">Agents</td>
                        <td style="width: 40%;">
                            <select id="agents_presence" onchange="getDataPresnce()">
                                <option value="0"></option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getIdrh() . " " . $agent->getNomcomplet() . " " . $agent->getPrenom(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 5%;">Année</td>
                        <td style="width: 20%;">
                            <select id="annee_presence" class="chosen-select form-control" data-placeholder="Déterminez l'année"  onchange="getDataPresnce()">
                                <option value=""></option>                  
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td style="width: 5%;">Mois</td>
                        <td style="width: 20%;">
                            <select id="mois_presence" onchange="getDataPresnce()" data-placeholder="Déterminez le mois" >
                                <option value="0"></option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <?php $k = "0" . $i; ?>
                                    <option value="
                                    <?php
                                    if ($i < 10): echo $k;
                                    else: echo $i;
                                    endif;
                                    ?>" id="mois_<?php echo $i; ?>" 
                                            >
                                                <?php
                                                if ($i < 10): $j = "0" . $i;
                                                else: $j = $i;
                                                endif;
                                                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                                                echo strftime('%B', strtotime(date('Y') . '-' . $j . '-01'))
                                                ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </td>

                    </tr>
                </table>
                <div id="zone_data_presence" style="display: block;"></div>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_presence_3" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presence_1" style="min-width: 150px; height: 300px; margin: 0 auto; width: 100%;"></div>
            <div id="container_presence_mensuelle" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_presence_annuelle" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presence_annuelle" style="min-width: 150px; height: 400px; margin: 0 auto; width: 100%;"></div>
            <div id="container_presence_annuelle_2" style="margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>



<script>

    function getDataPresnce() {
        if ($('#agents_presence').val() != 0 && $('#annee_presence').val() != 0) {
            $.ajax({
                url: '<?php echo url_for('conge/getPresence') ?>',
                data: 'id=' + $('#agents_presence').val() + '&mois=' + $('#mois_presence').val() + '&annee=' + $('#annee_presence').val(),
                success: function (data) {

                    $('#zone_data_presence').fadeIn();


                    if ($('#mois_presence').val() != 0)
                    {
                        $('#zone_presence_3').fadeIn();
                        $('#zone_presence_annuelle').hide();
                    }
                    else
                    {
                        $('#zone_presence_3').hide();
                        $('#zone_presence_annuelle').fadeIn();
                    }
                    $('#container_presence_annuelle').html(data);
                }
            });
        } else {
            $('#zone_data_presence').html('');
            $('#zone_presence_3').hide();
            $('#zone_presence_annuelle').hide();
        }
    }
</script>