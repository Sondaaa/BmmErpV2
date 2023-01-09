<?php if (sizeof($dossiers) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="6">Liste des dossiers comptables  vide</td>
    </tr>
<?php endif; ?><!--$pager->getResults()!-->
<?php foreach ($dossiers as $dossier): ?>
    <tr>
        <td><?php echo $dossier->getCode() ?></td>
        <td style="text-align: left;"><?php echo $dossier->getRaisonsociale(); ?></td>
        <td><?php echo $dossier->getTelephoneun() ?></td>
        <td><?php echo date('d/m/Y', strtotime($dossier->getDate())); ?></td>
        <td><?php
            if ($dossier->getEtat() == 1)
                echo 'Actif';
            else
                echo 'Inactif';
            ?></td>
        <td>
            <a type="button" class="btn btn-white btn-primary btn-sm" href="<?php echo url_for('@showDossier') . '?id=' . $dossier->getId() ?>" style="text-align: center;">
                Afficher
                <i class="ace-icon fa fa-eye icon-on-right bigger-110"></i>
            </a>
            <button type="button"
    <?php if ($dossier->getIdDevise() != null || $dossier->getIdUser() != null || $dossier->getIdComptevente() != null || $dossier->getIdCompteachat() != null || $dossier->getIdContribution() != null || $dossier->getIdLignecontribition() != null): ?> 
                        class="disabledbutton btn btn-white btn-danger btn-sm"

                    <?php else: ?>
                        class="btn btn-white btn-danger btn-sm" 
    <?php endif; ?>    onclick="deleteDossier('<?php echo $dossier->getId() ?>')" style="text-align: center;">
                Supprimer
                <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>

