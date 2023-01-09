<div id="sf_admin_container">
    <h1 id="replacediv"> Accueil 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Profil
        </small>
    </h1>
</div>
<?php $user = $sf_user->getAttribute('userB2m'); ?>
<?php $agent = $user->getAgents(); ?>
<div class="row">
    <div class="col-xs-12">
        <div id="user-profile-1" class="user-profile row">
            <div class="col-xs-12 col-sm-3 center">
                <div>
                    <span class="profile-picture">
                        <?php if ($agent->getIdSexe() == 2): ?>
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php echo sfconfig::get('sf_appdir') ?>images/profile-pic.png" />
                        <?php else: ?>
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php echo sfconfig::get('sf_appdir') ?>images/profile-pic.jpg" />
                        <?php endif; ?>
                    </span>

                    <div class="space-4"></div>

                    <div class="width-80 label <?php if ($agent->getIdSexe() == 2): ?>label-pink<?php else: ?>label-info<?php endif; ?> label-xlg arrowed-in arrowed-in-right">
                        <div class="inline position-relative">
                            <i class="ace-icon fa fa-circle light-green"></i>
                            &nbsp;
                            <span class="white"><?php echo $agent->getNomcomplet() . ' ' . $agent->getPrenom(); ?></span>
                        </div>
                    </div>
                </div>

                <div class="space-6"></div>

                <div class="profile-contact-info">
                    <div class="profile-contact-links align-left">
                        <a class="btn btn-link">
                            <i class="ace-icon fa fa-barcode bigger-120 green"></i>
                            Code : <?php echo $agent->getIdrh(); ?>
                        </a>
                        <br>
                        <a class="btn btn-link">
                            <i class="ace-icon fa fa-user bigger-120 green"></i>
                            C.I.N : <?php echo $agent->getCin(); ?>
                        </a>
<!--                        <a href="#" class="btn btn-link">
                            <i class="ace-icon fa fa-clock-o bigger-120 green"></i>
                            Demande de Congé
                        </a>

                        <a href="#" class="btn btn-link">
                            <i class="ace-icon fa fa-credit-card bigger-120 pink"></i>
                            Demande de Prêt
                        </a>

                        <a href="#" class="btn btn-link">
                            <i class="ace-icon fa fa-book bigger-120 orange"></i>
                            Demande de Formation
                        </a>

                        <a href="#" class="btn btn-link">
                            <i class="ace-icon fa fa-user-md bigger-125 blue"></i>
                            Visite Médicale
                        </a>-->
                    </div>
                </div>

                <div class="hr hr12 dotted"></div>

            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Nom </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="nom" value="<?php echo $agent->getNomcomplet(); ?>">
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Prénom </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="prenom" value="<?php echo $agent->getPrenom(); ?>">
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> G.S.M </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="gsm" value="<?php echo $agent->getGsm(); ?>">
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> E-mail </div>

                        <div class="profile-info-value">
                            <input type="text" id="mail" value="<?php echo $agent->getMail(); ?>">
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Login </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="login" value="<?php echo $user->getLogin(); ?>">
                                <input type="hidden" id="pwd" value="<?php echo $user->getPwd(); ?>">
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Ancien Mot de Passe </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="old_password" value="">
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Nouveau Mot de Passe </div>

                        <div class="profile-info-value">
                            <span class="editable">
                                <input type="text" id="new_password" value="">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-10"></div>

                <div class="hr hr2 hr-double"></div>

                <div class="space-4"></div>

                <div style="text-align: right;">
                    <button class="btn btn-xs btn-primary" onclick="saveProfil()">
                        <i class="ace-icon fa fa-save bigger-110"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function saveProfil() {
        if ($("#pwd").val() != $("#old_password").val() && $("#new_password").val() != '') {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez entrer le mot de passe (en cours) correct, pour accepter le le nouveau mot de passe !</div>",
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
                url: '<?php echo url_for('Acceuil/saveProfil') ?>',
                data: 'id=' + '<?php echo $user->getId(); ?>' +
                        '&nom=' + $("#nom").val() +
                        '&prenom=' + $("#prenom").val() +
                        '&gsm=' + $("#gsm").val() +
                        '&mail=' + $("#mail").val() +
                        '&login=' + $("#login").val() +
                        '&password=' + $("#new_password").val(),
                success: function (data) {
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#1553b3;'>Information :</span><br><span class='bigger-110' style='margin:20px;color:#1553b3;'>Profil modifié avec succès !</span>",
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