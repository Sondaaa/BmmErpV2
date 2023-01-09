<div id="sf_admin_container">
    <h1 id="replacediv"> Utilisateur 
        <small><i class="ace-icon fa fa-angle-double-right"></i>Affecter le Profil</small>
    </h1>
</div>

<?php $utilisateur = UtilisateurTable::getInstance()->find($id); ?>
<div class="row">
    <div class="col-sm-8">
        <legend style="margin-bottom: 10px; font-size: 17px;">Affecter un profil à un utilisateur : </legend>
        <table>
            <tr>
                <td style="width: 30%;">Utilisateur : </td>
                <td style="width: 70%;"><?php echo $utilisateur; ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Agent : </td>
                <td style="width: 70%;"><?php echo $utilisateur->getAgents(); ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Profil : </td>
                <td style="width: 70%;">
                    <?php $profils = ProfilTable::getInstance()->findAll(); ?>
                    <select id="profil_id">
                        <option value=""></option>
                        <?php foreach ($profils as $profil): ?>
                            <option value="<?php echo $profil->getId(); ?>" <?php if ($profil->getId() == $utilisateur->getIdProfil()): ?>selected="true"<?php endif; ?>><?php echo $profil->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <button class="btn btn-white btn-primary" onclick="affecterProfil()">
                        <i class="ace-icon fa fa-save"></i> Enregistrer
                    </button>
                    <a href="<?php echo url_for('@utilisateur') ?>" class="btn btn-white btn-success">
                        <i class="ace-icon fa fa-undo"></i> Retour à la Liste
                    </a>
                </td>
            </tr>
        </table>
        <hr>
    </div>
</div>

<script  type="text/javascript">

    function affecterProfil() {
        if ($("#profil_id").val() == '' || $("#profil_id").val() == null) {
            bootbox.dialog({
                message: "Veuillez choisir un profil !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        } else {
            $.ajax({
                url: '<?php echo url_for('utilisateur/affecterProfil') ?>',
                data: 'id=' + '<?php echo $utilisateur->getId(); ?>' +
                        '&profil_id=' + $("#profil_id").val(),
                success: function (data) {
                    bootbox.dialog({
                        message: "Profil affecté avec succès !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        }
    }

</script>