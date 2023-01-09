<td style="width:10%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <a id="btnimpexpo" class="btn btn-xs btn-success " href="<?php echo url_for('docachat/Showdocument?iddoc=') . $documentachat->getId() ?>"><i class="ace-icon fa fa-eye bigger-110"></i>Détails N°: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
                <li>
                    <a id="btnimpexpo" class="btn btn-white btn-primary" href="<?php echo url_for('docachat/imprimerboncomande?iddoc=') . $documentachat->getId() ?>"> <i class="ace-icon fa fa-print bigger-110"></i>Imprimer D.I.: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
                <?php if ($documentachat->getIdEtatdoc() == 10 ){ ?>
                <li>
                  <button type="button" onclick="document.location.href = '<?php echo url_for('docachat/exportbcc') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.D.C</button>
                </li>
                <?php }?>
            
             <?php
$doc_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 19);
$doc_parent_demandedeprix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 8);?>
                                <?php if ($documentachat->getEtatdocachat() == '' && $documentachat->getTypedocexporter() == 1):
                                    if (sizeof($doc_parent) == 0): ?>
			                        <?php if ($documentachat->getIdEtatdoc() == 1 || $documentachat->getIdEtatdoc() == 22 || $documentachat->getIdEtatdoc() == 24) {?>
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
			                                    return false;" type="button" class="btn btn-outline btn-warning"><i class="fa fa-bitbucket"></i> Supprimer</button>
			                            </li>
			                        <?php } ?>                        
                                 <?php endif;?>
                               <?php endif;?>
<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT documentbudget.id as id "
        . "FROM  piecejointbudget, documentachat, documentbudget "
        . "WHERE piecejointbudget.id_documentbudget = documentbudget.id "
        . "AND piecejointbudget.id_docachat = documentachat.id "
        . "AND documentbudget.id_type =2 "
        . "AND documentachat.id IN (select id from documentachat where id_docparent = " . $documentachat->getId() . ") ";
  $ordonnance_paiement = $conn->fetchAssoc($query);
                if (!sizeof($ordonnance_paiement) > 0): ?>
                                <li>
                                <a type="button" 
                                                href = '<?php echo url_for('docachat/annuler') . '?iddoc=' . $documentachat->getId() ?>'" 
                                                class="btn btn-outline btn-danger">
                                                <i class="fa fa-undo"></i> Annuler
                </a> 
                                </li>
                 <?php endif;?>
            </ul>
        </div>
    </div>
</td>