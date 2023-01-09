<div id="sf_admin_container">
    <h1 id="replacediv"><?php echo $typedocument; ?>  </h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post" >
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('contratachat/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        De <input type="date"
                                  value="<?php echo $date_debut ?>" id="debut" name="debut">
                        à 
                        <input type="date" min="<?php echo date('Y') . "-01-01" ?>" max="<?php echo date('Y') . "-12-31" ?>" 
                               id="fin" name="fin" value="<?php echo $date_fin ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Fournisseur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $form['id_frs']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="widget-body col-xs-4 pull-right">
        <?php if ($idtype == 19): ?>
            <div class="widget-main" style="padding: 5%; text-align: center;">


    <!--                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/imprimerlisteContrat?id_type=' . $idtype)  ?>" class=" btn btn-outline btn-danger">
                        <i class="ace-icon fa fa-print bigger-110"></i>   Exporter Contrat PDF
                    </a>
                    <br><br>
                    <a style="height: 55px !important; width: 350px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/exporterlisteContratExcel?id_type=' . $idtype)  ?>" class=" btn btn-outline btn-primary">
                        <i class="ace-icon fa fa-file-excel-o"></i>     Exporter Contrat vers Excel (.xlsx )
                    </a>-->
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter Contrat PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Contrat vers Excel (.xlsx )
                </button>
            </div>
        <?php elseif ($idtype == 20): ?>
            <div class="widget-main" style="padding: 5%; text-align: center;">


    <!--                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/imprimerlisteContratDef?id_type=' . $idtype)  ?>" class=" btn btn-outline btn-danger">
                        <i class="ace-icon fa fa-print bigger-110"></i>   Exporter Contrat Définitif PDF
                    </a>
                    <br><br>
                    <a style="height: 55px !important; width: 350px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/exporterlisteContratDefExcel?id_type=' . $idtype)  ?>" class=" btn btn-outline btn-primary">
                        <i class="ace-icon fa fa-file-excel-o"></i>     Exporter Contrat Définitif vers Excel (.xlsx )
                    </a>-->
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter Contrat Définitif PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Contrat Définitif <br>vers Excel (.xlsx )
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                <?php if ($idtype == 20):?>
                Liste des Contrats définitifs
                 <?php elseif ($idtype == 19):?>
                Liste des Contrats Provisoire
                <?php endif;?>
            </div>
            <div>
                <table id="list_forme" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">Nom Contrat & Numéro</th>
                            <th style="text-align: center;">Date Création</th>
                            <th style="text-align: center;">Numéro BCIS</th>
                            <th>Fournisseur</th>
                            <th style="text-align: center;">Mnt.TTC</th>
                            <th style="text-align: center;">Mnt.Contrat</th>
                            <th style="width: 25%;">Imputation budgétaire</th>
                            <th>Caisse</th>
                            <th style="width: 25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($idtype == 20):
                            include_partial('contratachat/list_contratdef', array('pager' => $pager, 'page' => $page));
                            ?>
                            <?php
                        elseif ($idtype == 19):
                            include_partial('contratachat/list_contratprovisoire', array('pager' => $pager));
                            ?>
                            <?php
                        endif;
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php if ($idtype == 20): ?>
            <?php include_partial('pagination_contratdefinitif', array('pager' => $pager))
            ?>
        <?php endif; ?>
        <?php if ($idtype == 19): ?>
            <?php include_partial('pagination_contratprovisoire', array('pager' => $pager))
            ?>
        <?php endif; ?>
    </div>
</div>

<style>

    #list_forme tbody td{vertical-align: middle;}

</style>
<script>

    function goPageDef(page) {

        $.ajax({
            url: '<?php echo url_for('contratachat/goPageDef'); ?>',
            data: 'page=' + page + '&idfrs=' + $('#idfrs').val(),
            success: function (data) {
                $('#list_forme tbody').html(data);
            }
        });
    }
    function goPageProvi(page) {

        $.ajax({
            url: '<?php echo url_for('contratachat/goPageProvi'); ?>',
            data: 'page=' + page + '&idfrs=' + $('#idfrs').val() + '&idtype=' + <?php echo $idtype; ?>,
            success: function (data) {
                $('#list_forme tbody').html(data);
            }
        });
    }
    function supprimer(id) {
        var message_text = "Voulez-vous supprimer ce document ? ";
        bootbox.confirm({
            message: message_text,
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerSupression(id);
                }
            }
        });
    }
    function validerSupression(id) {

        $.ajax({
            url: '<?php echo url_for('Documents/deleteDemandedeprix') ?>',
            data: 'iddemandedeprix=' + id,
            success: function (data) {
                document.location.reload();
//              
            }
        });
    }
    function printListDocAchats(id_type) {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        if (id_type != '') {
            {
                if (url == '')
                    url = '?id_type=' + id_type;
                else
                    url = url + '&id_type=' + id_type;
            }
        }
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }

        if ($('#idfrs').val() != '')
        {
            if (url == '')
                url = '?idfrs=' + $('#idfrs').val();
            else
                url = url + '&idfrs=' + $('#idfrs').val();
        }
        if (id_type == 19) {
            url = '<?php echo url_for('Documents/imprimerlisteContrat') ?>' + url;
        }
        else if (id_type == 20) {
            url = '<?php echo url_for('Documents/imprimerlisteContratDef') ?>' + url;
        }

        window.open(url, '_blank');
        win.focus();
    }

    function ExportListDocAchats(id_type) {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        if (id_type != '') {
            {
                if (url == '')
                    url = '?id_type=' + id_type;
                else
                    url = url + '&id_type=' + id_type;
            }
        }
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }

        if ($('#idfrs').val() != '')
        {
            if (url == '')
                url = '?idfrs=' + $('#idfrs').val();
            else
                url = url + '&idfrs=' + $('#idfrs').val();
        }

        if (id_type == 19) {
            url = '<?php echo url_for('Documents/exporterlisteContratExcel') ?>' + url;
        }
        else if (id_type == 20) {
            url = '<?php echo url_for('Documents/exporterlisteContratDefExcel') ?>' + url;
        }


        window.open(url, '_blank');
        win.focus();
    }
</script>