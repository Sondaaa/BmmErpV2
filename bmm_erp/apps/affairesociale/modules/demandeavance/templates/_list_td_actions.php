<!--<td>
  <ul class="sf_admin_td_actions">
<?php // echo $helper->linkToEdit($demandeavance, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
<?php // echo $helper->linkToDelete($demandeavance, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>-->
<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('demandeavance/showdemande') . '?id=' . $demandeavance->getId() ?>'"  class="btn btn-primary widthfixed"  >
                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</button>
                </li>
                
                <li> 
                    <button  onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'demandeavance/delete?id=<?php echo $demandeavance->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button" class="btn btn-outline btn-default widthfixed" ><i class="fa fa-bitbucket"></i>  Supprimer</button>
                </li>
                <!--                 <li>
                                    <a  target="_blanc" class="btn btn-outline btn-success widthfixed" href="<?php // echo url_for('demandeavance/imprimerDemande?iddoc=' . $demandeavance->getId())  ?>">
                                        <i class="fa fa-eye"></i>Fiche Demande d'Avance </a>
                                </li>-->
            </ul>
        </div>
    </div>
</td>
<style>

    .widthfixed{
        min-width: 140px;
    }

</style>




