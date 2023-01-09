<td style="width:20%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?php echo url_for('contrat/edit') . '?id=' . $contrat->getId() ?>" class="btn btn-primary width-fixed">Afficher</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-info btn-circle width-fixed" style="width: 200px;" href="<?php echo url_for('Documents/Imprimerattestation?iddoc=' . $contrat->getId()) ?>">Attestation de travail</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-danger width-fixed" href="<?php echo url_for('Documents/Imprimerattestationdesalaire?iddoc=' . $contrat->getId()) ?>">Attestation de salaire</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-primary width-fixed" href="<?php echo url_for('contrat/ImprimerFiche?iddoc=' . $contrat->getId()) ?>">Imprimer</a>
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