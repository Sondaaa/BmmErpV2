<td>
    <a id="btnimpexpo" style="font-size: 18px" class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/showdocument?iddoc=').$documentachat->getId() ?>">Détail N°:<?php  echo $documentachat->getNumerodocachat() ?></a>
    <button onclick="document.location.href='documentachat/valideretenvoyer/iddoc/<?php echo $documentachat->getId() ?>'" type="button" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Vérifier et envoyer</button>
   
</td>
