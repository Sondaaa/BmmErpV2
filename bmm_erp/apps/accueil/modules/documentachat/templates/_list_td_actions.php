<td>
  <ul class="sf_admin_td_actions">
    <?php $doc_da = DocumentachatTable::getInstance()->findOnebyIdDocparent($documentachat->getId()); ?>
    <?php $doc_reg_achat = DocachatregTable::getInstance()->findByIdBci($documentachat->getId()); ?>
    <?php //echo $doc_da->getId() . ' ' . $documentachat->getId();
    if ((!$doc_da || !$doc_reg_achat) && !$documentachat->getDatesignaturebci()) { ?>
      <?php echo $helper->linkToEdit($documentachat, array('params' =>   array(),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php } ?>
    <a id="btnimpexpo" class="btn btn-xs btn-white btn-success " target="_blanc" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>"><i class="ace-icon fa fa-eye bigger-110"></i>Détails N°: <?php echo $documentachat->getNumerodocachat() ?></a>

    <?php if ((!$doc_da || !$doc_reg_achat) && !$documentachat->getDatesignaturebci()) { ?>
      <li>
        <button onclick="if (confirm('Etes-vous sûr?')) {
                                        var f = document.createElement('form');
                                        f.style.display = 'none';
                                        this.parentNode.appendChild(f);
                                        f.method = 'post';
                                        f.action = 'documentachat/delete?id=<?php echo $documentachat->getId() ?>';
                                        var m = document.createElement('input');
                                        m.setAttribute('type', 'hidden');
                                        m.setAttribute('name', 'sf_method');
                                        m.setAttribute('value', 'delete');
                                        f.appendChild(m);
                                        f.submit();
                                    }
                                    ;
                                    return false;" type="button" style="margin-left: 3px;" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-bitbucket"></i> Supprimer</button>
      </li>
    <?php } ?>
  </ul>
</td>