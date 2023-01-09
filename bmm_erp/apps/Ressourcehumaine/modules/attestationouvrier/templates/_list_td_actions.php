

<td style="width:20%" >
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                 <li>
                    <a href="<?php echo url_for('attestationouvrier/edit') . '?id=' . $attestationouvrier->getId() ?>">Modifier</a> 
                </li>
              
                        <li> 
                    <a href=""  onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'attestationouvrier/delete?id=<?php echo $attestationouvrier->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" ></i> Supprimer</a>
                </li>
        
                <li>
                    <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('attestationouvrier/Imprimerattestationdetravail?iddoc=' . $attestationouvrier->getId()) ?>">Attestation de Travail</a>
                </li>
            </ul>
        </div>
    </div>
</td>