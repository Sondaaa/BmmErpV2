<div id="sf_admin_container">
    <h1>Statistiques   Agent Par Hiérachie</h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body" ng-controller="CtrlRessourcehumaine">
            <fieldset style="padding: 10px">

                <?php $directions = Doctrine_Core::getTable('direction')->findAll(); ?>
                <?php $sousdirections = Doctrine_Core::getTable('sousdirection')->findAll(); ?>
                <?php $services = Doctrine_Core::getTable('servicerh')->findAll(); ?>
                <?php $unites = Doctrine_Core::getTable('unite')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 5%;">Direction</td>
                        <td style="width: 20%;">
                            <select id="direction_stat" >
                                <option value="0"></option>
                                <?php foreach ($directions as $direction): ?>
                                    <option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 5%;">Sous Direction</td>
                        <td style="width: 20%;">
                            <select id="sous_direction_stat" class="chosen-select form-control" data-placeholder="Sous Direction " >
                                <option value="0"></option>                  
                                <?php foreach ($sousdirections as $sousdirection): ?>
                                    <option value="<?php echo $sousdirection->getId(); ?>"><?php echo $sousdirection->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 5%;">Service</td>
                        <td style="width: 20%;">
                            <select id="service_stat" class="chosen-select form-control" data-placeholder="Service "  >
                                <option value="0"></option>                  
                                <?php foreach ($services as $service): ?>
                                    <option value="<?php echo $service->getId(); ?>"><?php echo $service->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 5%;">Unite</td>
                        <td style="width: 20%;">
                            <select id="unite_stat" class="chosen-select form-control" data-placeholder="Unite ">
                                <option value="0"></option>                  
                                <?php foreach ($unites as $unite): ?>
                                    <option value="<?php echo $unite->getId(); ?>"><?php echo $unite->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td colspan="7" ></td>
                        <td>
                            <button style="width: 250px" class="btn btn-xs btn-primary pull-right" onclick="getData()"> Afficher</button>  
                        </td>
                    </tr>
                </table>


            </fieldset>
        </div>
    </div>
</div>


<div class="col-md-12 pull-right" id="zone_agent_unite" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_unite" style="min-width: 500px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<script  type="text/javascript">

//    getData();
    function getData() {
        if ($('#direction_stat').val() != "0") {
            $.ajax({
                url: '<?php echo url_for('agents/getHierachie') ?>',
                data: 'direction=' + $('#direction_stat').val()
                        + '&sous_direction=' + $('#sous_direction_stat').val()
                        + '&service=' + $('#service_stat').val()
                        + '&unite=' + $('#unite_stat').val()
                ,
                success: function (data) {


                    $('#container_unite').html(data);
                    $('#zone_agent_unite').fadeIn();



                }
            });
        }
        else {
        alert("choisir la direction !!!")
        }
    }
</script>