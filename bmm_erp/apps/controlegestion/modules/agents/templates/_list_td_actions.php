<td style="text-align: center;">
    <button type="button" onclick="document.location.href = '<?php echo url_for('agents/edit') . '?id=' . $agents->getId() ?>'" class="btn btn-xs btn-primary">
        <i class="ace-icon fa fa-eye bigger-110"></i> Afficher</button>
    <a target="_blank" href="<?php echo url_for('agents/ImprimerFiche') . '?id=' . $agents->getId() ?>" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-print bigger-110"></i> Imprimer</a>
    <a data-target="#my-modalimpression" role="button" onclick="setImprimeId('<?php echo $agents->getId(); ?>')" data-toggle="modal" target="_blanc" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-print bigger-110"></i> Impression Personnalisée</a>
</td>