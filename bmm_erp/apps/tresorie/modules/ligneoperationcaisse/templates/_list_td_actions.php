<td>
    <ul class="sf_admin_td_actions">
        <?php //echo $helper->linkToEdit($ligneoperationcaisse, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php //echo $helper->linkToDelete($ligneoperationcaisse, array(  'params' =>   array(  ),  'confirm' => 'Êtes-vous sûr ?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
        <?php
        $id_doc_achat = $ligneoperationcaisse->getIdDocachat();
        $doc_achat = DocumentachatTable::getInstance()->find($id_doc_achat);
        $quitancepro = LigneoperationcaisseTable::getInstance()->getByCategorieAndDocAchat(1,$id_doc_achat);
        $quitancedef = LigneoperationcaisseTable::getInstance()->getByCategorieAndDocAchat(2,$id_doc_achat);

        if ($doc_achat->getIdTypedoc() == 21 && $ligneoperationcaisse->getIdCategorie() != 2):
            ?>
            <li>
                <a   class="btn btn-white btn-success" href="<?php echo url_for('Documents/preengagementBDCGDef') . '?id=' . $ligneoperationcaisse->getIdDocachat() . '&idoperation=' . $ligneoperationcaisse->getId() ?>">Exporter Quitance Définitif</a>  
            </li>  
        <?php endif; ?>
        <li>
            <a   class="btn btn-white btn-primary" href="<?php echo url_for('Documents/detailpreengagement') . '?id=' . $ligneoperationcaisse->getIdDocachat() . '&idoperation=' . $ligneoperationcaisse->getId() ?>">Détail & Exporter Pdf</a>  
        </li> 
        <?php if ($doc_achat->getIdTypedoc() == 21 && $ligneoperationcaisse->getIdCategorie() == 2): ?>

            <?php
           // echo(sizeof($quitancedef) . "  " . sizeof($quitancepro));
            // if (sizeof($quitancedef) == sizeof($quitancepro)):
            if ($doc_achat->getIdEtatdoc() != 62):
                ?>
                <li>
                    <a   class="btn btn-white btn-danger" href="<?php echo url_for('Documents/cloturer') . '?id=' . $ligneoperationcaisse->getIdDocachat() . '&idoperation=' . $ligneoperationcaisse->getId() ?>">Clôturer et envoyé à l'unité Achat</a>  
                </li> 
                <?php
            //  endif;
            endif;
            ?>

        <?php endif; ?>
        <?php if ($ligneoperationcaisse->getEtat() == 'Actif'): ?>
            <li>
                <a onclick="if (confirm('Êtes-vous sûr ?')) {
                            var f = document.createElement('form');
                            f.style.display = 'none';
                            this.parentNode.appendChild(f);
                            f.method = 'post';
                            f.action = 'ligneoperationcaisse/delete?id=<?php echo $ligneoperationcaisse->getId() ?>';
                            var m = document.createElement('input');
                            m.setAttribute('type', 'hidden');
                            m.setAttribute('name', 'sf_method');
                            m.setAttribute('value', 'delete');
                            f.appendChild(m);
                            f.submit();
                        }
                        ;
                        return false;" type="button" class="btn btn-danger width-fixed" 
                   style="border: none;font-size: 12px;text-align: center;">
                    <i class="ace-icon fa fa-bitbucket bigger-110"></i> Supprimer</a>
            </li>
        <?php endif; ?>
    </ul>
</td>
