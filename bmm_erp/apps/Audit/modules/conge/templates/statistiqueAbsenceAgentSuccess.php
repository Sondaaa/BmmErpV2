<div id="sf_admin_container">
    <h1>Suivi Absence</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
                <?php $agents = Doctrine_Core::getTable('agents')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 15%;">Agents</td>
                        <td style="width: 55%;">
                            <select id="agents_presence" onchange="getDataPresnce()">
                                <option value="0"></option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getIdrh() . " " . $agent->getNomcomplet() . " " . $agent->getPrenom(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 15%;">
                            <select id="annee_presence" class="chosen-select form-control" data-placeholder="Déterminez l'année"  onchange="getDataPresnce()">
                                <option value=""></option>                  
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option value="<?php echo $i; ?>" id="annee_<?php echo $i; ?>" ><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div id="zone_data_presence_absence" style="display: block;"></div>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-6" id="zone_presence" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presence" style="min-width: 150px; height: 400px; margin: 0;width: 100%;"></div>
        </div>
    </div>
</div>
<div class="col-md-6" id="zone_absence" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_absence" style="min-width: 150px; height: 400px; margin: 0;width: 100%;"></div>
        </div>
    </div>
</div>


<script  type="text/javascript">

    function getDataPresnce() {
        if ($('#agents_presence').val() != 0 && $('#annee_presence').val() != 0) {
            $.ajax({
                url: '<?php echo url_for('conge/getAbsence') ?>',
                data: 'id=' + $('#agents_presence').val() + '&annee=' + $('#annee_presence').val(),
                success: function (data) {
                    $('#zone_presence').fadeIn();
                    $('#zone_absence').fadeIn();
                    $('#zone_data_presence_absence').html(data);
                }
            });
        } else {
            $('#zone_presence').hide();
            $('#zone_absence').hide();
        }
    }
</script>
