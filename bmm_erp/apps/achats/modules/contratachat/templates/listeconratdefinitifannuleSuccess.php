<div id="sf_admin_container">
    <h1>Liste des Contrats Définitifs annulés</h1>

</div>
<div id="sf_admin_bar" > 
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post" >
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('contratachat/listeconratdefinitifannule') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>

                    <tr>
                        <td><label>Date Annulation</label></td>
                        <td>
                            De <input type="date" value="<?php if ($date_debut) echo $date_debut ?>" id="debut"  name="debut">
                            à <input type="date"  id="fin"   name="fin" value="<?php if ($date_fin) echo $date_fin ?>">
                        </td>
                    </tr>

                </tbody>
            </table>
        </form>
    </div>
   <div class="widget-body col-xs-4 pull-right">
        <div class="widget-main" style="padding: 5%; text-align: center;">               
            <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                    onclick="printListDocAchats()"
                    class=" btn btn-outline btn-danger">
                <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
            </button>
            <br><br>
            <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                    onclick="ExportListDocAchats()"   class=" btn btn-outline btn-primary">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue"></h3>
            <div class="clearfix"></div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div>
                <table id="list_forme" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Document</th>
                            <th>Date Création</th>
                            <th>Date Annulation</th>
                            <th>Motif d'annulation</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < sizeof($docs); $i++): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $i + 1; ?></td>
                                <td><?php echo $docs[$i]['type'] . " : " . $docs[$i]['numero'] ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['datecreation'])); ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['dateannulation'])); ?></td>
                                <td><?php echo html_entity_decode($docs[$i]['motif']) ?></td>
                                <td><?php echo $docs[$i]['user'] ?></td>
                                <td style="text-align: center;">
                                    <a type="button" href="<?php echo url_for('contratachat/showAnnule') . '?iddoc=' . $docs[$i]['id'] ?>" class="btn btn-xs btn-primary">Détails</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
               
            </div>
        </div>

    </div>
</div>
<script>
    function printListDocAchats() {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }
        url = '<?php echo url_for('contratachat/imprimerlisteContratachatAnnuler') ?>' + url;

        window.open(url, '_blank');
        win.focus();
    }

    function ExportListDocAchats() {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }
        url = '<?php echo url_for('contratachat/exporterlisteContratAnnule') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>