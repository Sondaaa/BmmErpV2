<td style="width:10%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <a id="btnimpexpo" class="btn btn-white btn-success " href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>"><i class="ace-icon fa fa-eye bigger-110"></i>Détails N°: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
                <li>
                    <a id="btnimpexpo" class="btn btn-white btn-primary" href="<?php echo url_for('documentachat/imprimerboncomande?iddoc=') . $documentachat->getId() ?>"> <i class="ace-icon fa fa-print bigger-110"></i>Imprimer B.C.I: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
                
                <?php
                $doc_parent = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 19);
                $doc_parent_demandedeprix = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 8);
                if ($documentachat->getEtatdocachat() == ''):
                if(sizeof($doc_parent) == 0):    ?>
                    <?php if ($documentachat->getIdEtatdoc() == 3 && sizeof($doc_parent) == 0) { ?>
                        <!--                        <li>
                                                                    <button onclick="document.location.href='<?php //echo url_for('documentachat/envoistock').'?iddoc='.$documentachat->getId()                                   ?>'" type="button" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Envoie Stock & patrimoine</button>
                                                    <button type="button" onclick="document.location.href = '<?php //echo url_for('documentachat/envoibudget') . '?iddoc=' . $documentachat->getId()           ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Remplire Avis Budget</button>
                                                </li>-->
                    <?php } ?>
                    <?php if ($documentachat->getIdEtatdoc() == 23) { ?>
                        <?php if ($documentachat->getLigavissig()->count() != 0): ?>
                            <li>
                                <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Valider les Qtes.</button>
                            </li>
                        <?php endif; ?>
                    <?php } ?> 
                    <?php if ($documentachat->getIdEtatdoc() == 10 && sizeof($doc_parent_demandedeprix) == 0) { ?>

                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/remplirdemandedeprix') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Remplire les demandes de prix</button>
                        </li>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbcc') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.D.C</button>
                        </li> 

                    <?php } ?>        
                    <?php if ($documentachat->getIdEtatdoc() == 10 && sizeof($doc_parent_demandedeprix) >= 1) { ?>
                        <?php if ($documentachat->getExportBce() == 0) { ?>
                            <li>
                                <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/remplirdemandedeprix') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Remplire les demandes de prix</button>
                            </li>
                        <?php } ?>
                        <?php // if (($documentachat->getExportBce() == 1 && $documentachat->getExportBdc() == 0)) {  ?>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbcc') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.D.C</button>
                        </li> 
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbce') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.C.E</button>
                        </li>
                        <?php // }  ?>
                        <?php // if (($documentachat->getExportBdc() == 1 && $documentachat->getExportBce() == 0 ) ) {  ?>

                        <li>
                            <button target="_blank" type="button" onclick="document.location.href = '<?php echo url_for('contratachat/new') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter En Contrat</button>
                        </li>
                        <?php // }  ?>  
                    <?php } ?>  

                    <?php if ($documentachat->getIdEtatdoc() == 1 || $documentachat->getIdEtatdoc() == 22 || $documentachat->getIdEtatdoc() == 24 || $documentachat->getIdEtatdoc() == 33) { ?>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/edit') . '?id=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-edit"></i> Modifier</button>
                        </li>
                    <?php }?>
                         <?php if ($documentachat->getIdEtatdoc() == 1 || $documentachat->getIdEtatdoc() == 22 || $documentachat->getIdEtatdoc() == 24 ) { ?>
                    
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
                    <?php } else { ?>
                        <?php
                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                        $query = "SELECT documentbudget.id as id "
                                . "FROM  piecejointbudget, documentachat, documentbudget "
                                . "WHERE piecejointbudget.id_documentbudget = documentbudget.id "
                                . "AND piecejointbudget.id_docachat = documentachat.id "
                                . "AND documentbudget.id_type =2 "
                                . "AND documentachat.id IN (select id from documentachat where id_docparent = " . $documentachat->getId() . ") ";

                        $ordonnance_paiement = $conn->fetchAssoc($query);
                        ?>
                        <?php if (!sizeof($ordonnance_paiement) > 0): ?>
                            <li>
                                <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/annuler') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-undo"></i> Annuler</button>
                            </li>
                        <?php endif; ?>
                    <?php } ?>
                    <?php if ($documentachat->getIdEtatdoc() == 11) { ?>
                        <?php // if (($documentachat->getExportBce() == 1 && $documentachat->getExportBdc() == 0) || $documentachat->getCountBdcOuBcc() == 0) {  ?>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbce') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.C.E</button>
                        </li>
                        <?php //}  ?>  
                        <?php //if (($documentachat->getExportBdc() == 1 && $documentachat->getExportBce() == 0 ) || $documentachat->getCountBdcOuBcc() == 0) {  ?>
                        <li>
                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbcc') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.D.C</button>
                        </li>
                        <?php //} ?>  
                    <?php } ?>
                    <?php
                    if (sizeof($doc_parent) >= 1) {
//                        die('23');
                        ?>

                    <?php } ?>

                <?php endif; endif; ?>
            </ul>
        </div>
    </div>
</td>