<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a type="button" onclick="document.location.href = '<?php echo url_for('planing/edit') . '?id=' . $planing->getId() ?>'" class="btn btn-outline btn-primary width-fixed">
                        <i class="ace-icon fa fa-edit bigger-110"></i> Modifier</a>
                </li>
                <li> 
                    <a onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'planing/delete?id=<?php echo $planing->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button" class="btn btn-outline btn-danger width-fixed"><i class="fa fa-bitbucket"></i> Supprimer</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-warning width-fixed" href="<?php echo url_for('planing/imprimerConsultation?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Edition Consultation</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-success width-fixed" href="<?php echo url_for('planing/imprimerPlannigprevisionnel?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Panning Prévisionnel</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-primary width-fixed" href="<?php echo url_for('planing/showPlan?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Voir T.B.Execut°P.Défi</a>
                </li>
            </ul>
        </div>
    </div>
</td>

<style>

    .width-fixed{min-width: 172px;}

</style>