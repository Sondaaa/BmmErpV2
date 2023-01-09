<div id="sf_admin_container">
    <h1>Suivi Marche </h1>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <fieldset style="padding: 10px">
                <?php $marches = Doctrine_Core::getTable('marches')->findAll(); ?>
                <table style="margin-bottom: 20px;">
                    <tr>
                        <td style="width: 10%;">Marches</td>
                        <td style="width: 40%;">
                            <select id="marche" onchange="getDatamarche()">
                                <option value="0"></option>
                                <?php foreach ($marches as $marche): ?>
                                    <option value="<?php echo $marche->getId(); ?>"><?php echo $marche->getNumero() ; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>                       
                    </tr>
                </table>
                <div id="zone_data_marche" style="display: block;"></div>
            </fieldset>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_presence_3" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presence_1" style="min-width: 150px; height: 300px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>

<div class="col-md-12" id="zone_presence_annuelle" style="display: none;">
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="container_presence_annuelle" style="min-width: 150px; height: 400px; margin: 0 auto; width: 100%;"></div>
        </div>
    </div>
</div>



<script  type="text/javascript">

    function getDatamarche() {
        if ($('#marche').val() != 0 ) {
            $.ajax({
                url: '<?php echo url_for('Accueil/getMarche') ?>',
                data: 'id=' + $('#marche').val() ,
                success: function (data) {
                    $('#zone_data_marche').fadeIn();
                   
                    $('#zone_data_marche').html(data);
                }
            });
        } else {
            $('#zone_data_marche').html('');
         
        }
    }
</script>