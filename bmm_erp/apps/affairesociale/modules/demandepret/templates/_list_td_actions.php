<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">

                <!--                <li>
                                    <button type="button" onclick="document.location.href = '<?php // echo url_for('demandepret/edit') . '?id=' . $demandepret->getId()   ?>'"  class="btn btn-primary widthf"  >
                                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</button>
                                </li>-->
                <li>
                    <a href="<?php echo url_for('demandepret/edit') . '?id=' . $demandepret->getId() ?>" class="btn btn-outline btn-primary" >
                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</a>

                </li>

                <li> 
                    <a href="" onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'demandepret/delete?id=<?php echo $demandepret->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button"  class="btn btn-outline btn-default">
                        <i class="fa fa-bitbucket"></i>  
                        Supprimer
                    </a>
                </li>
                <li>
                    <a  target="_blanc" class="btn btn-outline btn-success widthf" href="<?php echo url_for('demandepret/imprimerDemande?iddoc=' . $demandepret->getId()) ?>">
                    <i class="fa fa-eye"></i>    Demande De Prêt  </a>
                    
                </li>
            </ul>
        </div>
    </div>
</td>
<style>

    .widthf{
        min-width: 160px;
    }

</style>




