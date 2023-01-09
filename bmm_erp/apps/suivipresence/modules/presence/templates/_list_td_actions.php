<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a  href = "<?php echo url_for('presence/showpresence') . '?id=' . $presence->getId() ?>"  class="btn btn-primary widthfixed"  >
                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</a>
                </li>


                <li> 
                    <a href=""   onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'presence/delete?id=<?php echo $presence->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button" class="btn btn-outline btn-default widthfixed" ><i class="fa fa-bitbucket"></i>  Supprimer</a>
                </li>
                <li>
                    <a  target="_blanc" class="btn btn-outline btn-danger widthfixed" href="<?php echo url_for('presence/imprimerPresence?iddoc=' . $presence->getId()) ?>">
                        <i class="fa fa-eye"></i>Fiche Présence </a>
                </li>
            </ul>
        </div>
    </div>
</td>
<style>

    .widthfixed{
        min-width: 172px;
    }

</style>




