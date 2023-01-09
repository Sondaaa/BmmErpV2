<td style="text-align: center;">
    <a id="btnimpexpo" class="btn btn-sm btn-outline btn-success" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>"><i class="fa fa-eye"></i> Détail</a>
    <?php if ($documentachat->getEtatdocachat() == ''): ?>
        <?php if ($documentachat->getIdEtatdoc() == 24 && $documentachat->getLigavisdoc()->count() == 0): ?>
            <a href ="<?php echo url_for('documentachat/envoibudget') . '?iddoc=' . $documentachat->getId(); ?>" type="button" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-long-arrow-right"></i> Remplir Avis Budget</a>
        <?php endif; ?>
      
        
    <?php endif; ?>
</td>