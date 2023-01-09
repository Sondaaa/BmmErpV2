<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('agents/edit') . '?id=' . $agents->getId() . '&reg=' . $agents->getIdRegrouppement() ?>'" class="btn btn-primary width-fixed">
                        <i class="ace-icon fa fa-edit bigger-110"></i> Modifier Fiche
                    </button>
                </li>
                <li> 
                    <button onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'agents/delete?id=<?php echo $agents->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button" class="btn btn-outline btn-danger width-fixed" ><i class="fa fa-bitbucket"></i> Supprimer Fiche </button>
                </li>
                <li>
                    <a  target="_blanc" class="btn btn-outline btn-success width-fixed" href="<?php echo url_for('agents/imprimerFichepersonnel?iddoc=' . $agents->getId()) ?>">
                        <i class="fa fa-eye"></i> 
                        Fiche personnel
                    </a>
                </li>
                <li> 
                    <a data-target="#my-modalimpression" role="button" onclick="setImprimeId('<?php echo $agents->getId(); ?>')" data-toggle="modal" target="_blanc" class="btn btn-outline btn-warning width-fixed">
                        Impression Personnalisée
                    </a>
                </li>
            </ul>
        </div>
    </div>
</td>

<style>

    .width-fixed{
        min-width: 190px;
    }

</style>