<td style="width:10%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <!--                 <li>
                <?php // echo $helper->linkToEdit($contratachat, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
                                 </li>-->
                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('contratachat/edit') . '?id=' . $contratachat->getId(); ?>'" class="btn btn-primary width-fixed">
                        <i class="ace-icon fa fa-edit bigger-110"></i> Modifier Fiche Contrat
                    </button>
                </li>
                <li>
                    <button onclick="if (confirm('Etes-vous sûr?')) {
                        var f = document.createElement('form');
                        f.style.display = 'none';
                        this.parentNode.appendChild(f);
                        f.method = 'post';
                        f.action = 'contratachat/delete?id=<?php echo $contratachat->getId() ?>';
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
                <li>
                    <a id="btnimpexpo" target="_blank" class="btn btn-white btn-primary" href="<?php echo url_for('contratachat/imprimerContrat?iddoc=') .$contratachat->getId();  ?>"> <i class="ace-icon fa fa-print bigger-110"></i>Imprimer Contrat: <?php echo $contratachat->getNumero() ?></a>
                </li>
            </ul>
            </td>
