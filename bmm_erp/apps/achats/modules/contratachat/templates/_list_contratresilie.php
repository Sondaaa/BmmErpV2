<?php if (sizeof($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Contrats Définitifs Résilies vide</td>
    </tr>
<?php endif; ?>
<?php $i = 0; ?>
<?php foreach ($pager as $contratresilie): ?>
    <tr>
        <td style="text-align: center;"><?php echo $i + 1; ?></td>
        <td><?php echo $contratresilie->getContratachat()->getReference() . ' N° ' . $contratresilie->getContratachat()->getNumero(); ?></td>
        <td style="text-align: center;">
            <?php if ($contratresilie->getContratachat()->getDatecreation() != ''): ?>
                <?php echo date('d/m/Y', strtotime($contratresilie->getContratachat()->getDatecreation())); ?></td>
        <?php endif; ?>
        <td style="text-align: center;">
            <?php if ($contratresilie->getDateresiliation() != ''): ?>
                <?php echo date('d/m/Y', strtotime($contratresilie->getDateresiliation())); ?></td>
        <?php endif; ?>
        <td><?php echo html_entity_decode($contratresilie->getMotifresiliattion()) ?></td>
        <td style="text-align: right"><?php echo number_format($contratresilie->getMontantconsomme(), 3, ".", " ") ?></td>
        <td style="text-align: right"><?php echo number_format($contratresilie->getMontantrestant(), 3, ".", " ") ?></td>
        <td><?php echo  $contratresilie->getUtilisateur()->getAgents();   ?></td>
        <td style="text-align: center;">
            <a type="button" href="<?php echo url_for('contratachat/showResilie') . '?iddoc=' . $contratresilie->getId() ?>" class="btn btn-xs btn-primary">Détails</a>
        </td>
    </tr>
<?php $i++; endforeach; ?>