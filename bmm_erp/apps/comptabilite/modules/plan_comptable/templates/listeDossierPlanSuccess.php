<?php if (count($dossiersPlan) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="2">Liste des dossiers Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($dossiersPlan as $dossier): ?>
    <tr>
        <td style="text-align: center;"><?php echo $dossier->getCode() ?></td>
        <td style="text-align: left; padding-left: 1%;"><?php echo $dossier->getRaisonSociale() ?></td>
        <td style="text-align: center;">
            <a style="cursor: pointer" href="<?php echo url_for('@showDossier?id=' . $dossier->getId()); ?>" target="_blank" class="btn btn-small"><i class="icon-search"></i></a>
        </td>
    </tr>
<?php endforeach; ?>