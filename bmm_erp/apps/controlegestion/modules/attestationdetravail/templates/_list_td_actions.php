<td style="width:20%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li class="align_right_menu">
                    <a target="_blanc" class="btn-primary" href="<?php echo url_for('attestationdetravail/ImprimerattestationdetravailArabe?iddoc=' . $attestationdetravail->getId()) ?>"> شهـادة عمــل</a>
                </li>
                <li>
                    <a target="_blanc" class="btn btn-outline btn-danger" href="<?php echo url_for('attestationdetravail/Imprimerattestationdetravail?iddoc=' . $attestationdetravail->getId()) ?>">Attestation de Travail</a>
                </li>
            </ul>
        </div>
    </div>
</td>