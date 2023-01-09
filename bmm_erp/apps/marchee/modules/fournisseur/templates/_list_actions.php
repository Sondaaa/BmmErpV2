<?php echo $helper->linkToNew(array('params' =>   array(),  'class_suffix' => 'new',  'label' => 'Nouvelle fiche fournisseur',)) ?>
<button onclick="printListFournisseur()" class=" btn btn-xs btn-danger">
    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer Liste des Fournisseurs
</button>
<button  onclick="exportFournisseur()" class=" btn btn-xs btn-primary">
    <i class="ace-icon fa fa-file_excel-o"></i> Exporter Liste des Fournisseurs vers Excel (.xlsx )
</button>



<script  type="text/javascript">
    function exportFournisseur() {
        var url = '';

        if ($('#fournisseur_filters_rs').val() != '' && $('#fournisseur_filters_rs').val() != 'undefined')
        {
            if (url == '')
                url = '?rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }
        if ($('#fournisseur_filters_codefrs').val() != '' && $('#fournisseur_filters_codefrs').val() != 'undefined')
        {
            if (url == '')
                url = '?codefrs=' + $('#fournisseur_filters_codefrs').val();
            else
                url = url + '&codefrs=' + $('#fournisseur_filters_codefrs').val();
        }
        if ($('#fournisseur_filters_id_famillearticle').val() != '' && $('#fournisseur_filters_id_famillearticle').val() != 'undefined')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '' && $('#fournisseur_filters_id_activite').val() != 'undefined')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/exporterFourniseseurExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function printListFournisseur() {
        var url = '';


        if ($('#fournisseur_filters_rs').val() != '')
        {
            if (url == '')
                url = '?rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }
        if ($('#fournisseur_filters_codefrs').val() != '')
        {
            if (url == '')
                url = '?codefrs=' + $('#fournisseur_filters_codefrs').val();
            else
                url = url + '&codefrs=' + $('#fournisseur_filters_codefrs').val();
        }

        if ($('#fournisseur_filters_id_famillearticle').val() != '')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/ImprimerListeFounisseur') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>