<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <?php echo $helper->linkToEdit($contratouvrier, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit', 'class' => 'btn btn-primary1')) ?>
                </li>
                <li> 
                    <a href="" onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'contratouvrier/delete?id=<?php echo $contratouvrier->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" class="btn btn-danger width-fixed"></i> Supprimer</a>
                </li>
                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('contratouvrier/ajouterAffectation') . '?id=' . $contratouvrier->getId() ?>'" class="btn btn-primary width-fixed">
                        <!--<i class="ace-icon fa fa-share bigger-110"></i>--> 
                        Ajouter Affectation</button>
                </li>
                 <li class="sf_admin_action_edit">
                    <a target="_blank" href="<?php echo url_for('contratouvrier/ImprimerFiche') . '?id=' . $contratouvrier->getId() ?>" class="btn btn-success width-fixed">Imprimer</a>
                </li>
            </ul>
        </div>
    </div>
</td>


<style>

    .width-fixed{
        min-width: 172px;
    }

</style>








