<div id="sf_admin_container">
    <h1 id="replacediv"> Fournisseur 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Certificat R.S Automatique
        </small>
    </h1>
    <?php $fournisseur = FournisseurTable::getInstance()->find($id); ?>
    <div class="panel-body">
        <div class="row">
            <legend>Fournisseur</legend>
            <table>
                <tr>
                    <td style="width: 15%; background-color: #F0F0F0;">Numéro Fiche</td>
                    <td style="width: 15%;"><?php echo $fournisseur->getNfiche(); ?></td>
                    <td style="width: 15%; background-color: #F0F0F0;">Raison Sociale</td>
                    <td style="width: 55%;"><?php echo $fournisseur->getRs() ?></td>
                </tr>
                <tr>
                    <td style="width: 15%; background-color: #F0F0F0;">Référence</td>
                    <td style="width: 15%;"><?php echo $fournisseur->getReference() ?></td>
                    <td style="width: 15%; background-color: #F0F0F0;">Tél</td>
                    <td style="width: 55%;"><?php echo $fournisseur->getTel() ?></td>
                </tr>
                <tr>
                    <td style="width: 15%; background-color: #F0F0F0;">Gsm</td>
                    <td style="width: 15%;"><?php echo $fournisseur->getGsm() ?></td>
                    <td style="width: 15%; background-color: #F0F0F0;">E-Mail</td>
                    <td style="width: 55%;"><?php echo $fournisseur->getMail() ?></td>
                </tr>
                <tr>
                    <td style="width: 15%; background-color: #F0F0F0;">Certificat R.S</td>
                    <td style="width: 15%;">
                        <?php if ($fournisseur->getCertificatrs()): ?>
                            <i class="ace-icon fa fa-check-square-o bigger-140"></i>
                        <?php else: ?>
                            <i class="ace-icon fa fa-square-o bigger-140"></i>
                        <?php endif; ?>
                    </td>
                    <td colspan="2">
                        <?php if ($fournisseur->getCertificatrs()): ?>
                            <span style="color: #2679B5;">
                                Génération automatique de la certificat de retenue à la source (Lors de la création de l'ordonnance de paiement).
                            </span>
                        <?php else: ?>
                            <span style="color: #B52626;">
                                Pas de génération automatique de la certificat de retenue à la source.
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <hr style="margin-bottom: 10px;">
            <div style="text-align: right;">
                <button class="btn btn-xs btn-danger" onclick="setCertificatrs(false)">
                    <i class="ace-icon fa fa-square-o bigger-110"></i> Sans Certificat R.S
                </button>
                <button class="btn btn-xs btn-primary" onclick="setCertificatrs(true)">
                    <i class="ace-icon fa fa-check-square-o bigger-110"></i> Avec Certificat R.S
                </button>
                <a class="btn btn-xs btn-success" href="<?php echo url_for('@fournisseur'); ?>">
                    <i class="ace-icon fa fa-undo bigger-110"></i> Retour à la Liste
                </a>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setCertificatrs(etat) {
        $.ajax({
            url: '<?php echo url_for('fournisseur/setCertificatrs') ?>',
            data: 'id=' + '<?php echo $fournisseur->getId(); ?>' +
                    '&etat=' + etat,
            success: function (data) {
                window.location.reload();
            }
        });
    }

</script>