<td style="width:20%" >
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">

                <li> 
                    <a href="<?php echo url_for('contrat/edit?id=' . $contrat->getId() .'&reg=' . $contrat->getAgents()->getIdRegrouppement() )?>" class="btn btn-primary width-fixed">Modifier</a> <!-- '&id_salairedebase=' . $contrat->getIdSalairedebase()-->
                </li>
                <li> 
                    <a href=""  onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'contrat/delete?id=<?php echo $contrat->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" class="btn btn-danger width-fixed" ></i> Supprimer</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-warning width-fixed" style="width: 100px" href="<?php echo url_for('Documents/Imprimerattestation?iddoc=' . $contrat->getId()) ?>">Attestation de travail</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-success width-fixed" style="width: 100px" href="<?php echo url_for('Documents/Imprimerattestationdesalaire?iddoc=' . $contrat->getId()) ?>">Attestation de salaire</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-primary width-fixed" style="width: 100px" href="<?php echo url_for('contrat/ImprimerFiche?iddoc=' . $contrat->getId()) ?>">Imprimer</a>
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