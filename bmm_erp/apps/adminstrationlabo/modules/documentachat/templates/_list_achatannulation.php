<?php if (sizeof($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">
         <?php if($id_type == 21):?>
            Liste des Documents achats BDC Regroupe annulés vide
            <?php else:?>
             Liste des Documents achats annulés vide
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
<?php $i = 1; ?>
<?php foreach ($pager as $docs): ?>

    <tr>
        <td style="text-align: center;"><?php echo $i + 1; ?></td>
        <td><?php echo $docs->getDocumentachat()->getTypedoc()->getLibelle() . " N° : "
              . $docs->getDocumentachat()->getNumero();
    ?></td>
        <td style="text-align: center;">
    <?php echo date('d/m/Y', strtotime($docs->getDocumentachat()->getDatecreation()));  ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs->getDateannulation()));  ?></td>
        <td><?php echo html_entity_decode($docs->getMotifannulation())  ?></td>
        <td><?php echo $docs->getUtilisateur()->getAgents()  ?></td>
        <td style="text-align: center;">
            <a type="button" href="<?php echo url_for('documentachat/showAnnule') . '?iddoc=' . $docs->getDocumentachat()->getId() ?>" class="btn btn-xs btn-primary">Détails</a>
        </td>
    </tr>

<?php endforeach; ?>