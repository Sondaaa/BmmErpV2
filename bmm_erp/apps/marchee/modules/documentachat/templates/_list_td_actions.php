<td style="width: 45%;">
    <a id="btnimpexpo" class="btn btn-xs btn-success" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>">Détail N°: <?php echo $documentachat->getNumerodocachat() ?></a>

    <?php if ($documentachat->getEtatdocachat() == ''): ?>

        <?php // if ($documentachat->getIdEtatdoc() == 1) { ?>
            <!--<button type="button" onclick="document.location.href = '<?php // echo url_for('documentachat/envoibudget') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i>Remplir Avis Budget</button>-->
        <?php // } ?>

        <?php // if ($documentachat->getIdEtatdoc() == 6) { ?>
            <!--<button type="button" onclick="document.location.href = '<?php // echo url_for('documentachat/rempliretexporter') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Remplir les visa </button>-->
        <?php // } ?> 
        <?php if ($documentachat->getIdEtatdoc() == 14) { ?>
            <button type="button" onclick="document.location.href = '<?php echo url_for('marches/new') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-xs btn-primary"><i class="fa fa-long-arrow-right"></i> Remplir Fiche marchés</button>
        <?php } ?>  
        <?php // if ($documentachat->getIdEtatdoc() == 11) { ?>
<!--            <button type="button" onclick="document.location.href = '<?php // echo url_for('documentachat/exportbce') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.C.E</button>
            <button type="button" onclick="document.location.href = '<?php // echo url_for('documentachat/exportbcc') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.D.C</button>-->
        <?php // } ?>  
        <!--    <?php // if ($documentachat->getIdEtatdoc() == 12) { ?>
                        <a id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php // echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId()   ?>">Détail BDC N°:<?php // echo $documentachat->getNumerodocachat()   ?></a>
        <?php // } ?>  -->
        <?php if ($documentachat->getIdEtatdoc() == 1 || $documentachat->getIdEtatdoc() == 9) { ?>
            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/edit') . '?id=' . $documentachat->getId() ?>'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Modifier</button>
            <button onclick="if (confirm('Etes-vous sûr?')) {
                            var f = document.createElement('form');
                            f.style.display = 'none';
                            this.parentNode.appendChild(f);
                            f.method = 'post';
                            f.action = '<?php echo url_for('documentachat/delete') . '?id=' . $documentachat->getId() ?>';
                            var m = document.createElement('input');
                            m.setAttribute('type', 'hidden');
                            m.setAttribute('name', 'sf_method');
                            m.setAttribute('value', 'delete');
                            f.appendChild(m);
                            f.submit();
                        }
                        ;
                        return false;" type="button" class="btn btn-xs btn-danger"><i class="fa fa-bitbucket"></i> Supprimer</button>
        <?php } ?>
    <?php endif; ?>
</td>
