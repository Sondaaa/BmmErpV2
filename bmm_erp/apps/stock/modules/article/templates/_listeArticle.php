<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="10">Liste des articles Vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $article): ?>
    <tr>
        <td style="text-align: center;"><?php echo $article->getCodeart() ?></td>
        <td><?php echo $article->getDesignation() ?></td>
        <td style="text-align: center;"><?php echo $article->getFamillearticle() ?></td>
        <td style="text-align: center;"><?php echo $article->getSousfamillearticle() ?></td>
        <td style="text-align: center;"><?php echo $article->getUnitemarche() ?></td>
        <td style="text-align: center;"><?php echo $article->getAht() ?></td>
        <td style="text-align: center;"><?php echo $article->getTva() ?></td>
        <td style="text-align: center;"><?php echo $article->getAttc() ?></td>
        <td style="text-align: center;"><?php echo $article->getPamp() ?></td>
        <td style="text-align: center;">
            <a href="<?php echo sfconfig::get('sf_appdir') ?>stock.php/article/<?php echo $article->getId(); ?>/edit" class="btn btn-white btn-sm btn-primary" title="Modifier"><i class="ace-icon fa fa-pencil"></i></a>
            <a onclick="if (confirm('Êtes-vous sûr ?')) {
                        var f = document.createElement('form');
                        f.style.display = 'none';
                        this.parentNode.appendChild(f);
                        f.method = 'post';
                        f.action = this.href;
                        var m = document.createElement('input');
                        m.setAttribute('type', 'hidden');
                        m.setAttribute('name', 'sf_method');
                        m.setAttribute('value', 'delete');
                        f.appendChild(m);
                        f.submit();
                    }
                    ;
                    return false;" href="<?php echo sfconfig::get('sf_appdir') ?>stock.php/article/<?php echo $article->getId(); ?>" class="btn btn-white btn-sm btn-danger" title="Supprimer"><i class="ace-icon fa fa-trash"></i></a>
        </td>
    </tr>
<?php endforeach; ?>

<style>

    #listArticle tbody td{vertical-align: middle;}

</style>