<div id="sf_admin_container">
    <h1>Liste des Bons Dépenses aux comptants annulés</h1>
</div>
<input type="hidden" value="<?php echo $id_type; ?>" id="id_typedoc">
<div id="sf_admin_bar" >  
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post" >
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('docachat/listeAnnule') ?>">Effacer</a>
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
                        <?php
                        include_partial('docachat/list_achatannulation', array('pager' => $pager));
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<div class="col-md-12">
    <?php include_partial('pagination_documentachatannuler', array('pager' => $pager)) ?>

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
        if (url == '')
            url = url + '?id_type=6';
        else
            url = url + '&id_type=6';

        if (url == '')
            url = url + '?idtypedoc=' + $('#id_typedoc').val();
        else
            url = url + '&idtypedoc=' + $('#id_typedoc').val();
        url = '<?php echo url_for('docachat/imprimerlisteDocachatAnnuler') ?>' + url;

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
        if (url == '')
            url = url + '?id_type=6';
        else
            url = url + '&id_type=6';
        if (url == '')
            url = url + '?idtypedoc=' + $('#id_typedoc').val();
        else
            url = url + '&idtypedoc=' + $('#id_typedoc').val();
        url = '<?php echo url_for('docachat/exporterlisteDocumentachatAnnule') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>