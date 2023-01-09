<div id="html"></div>
<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage des Actifs
                    <button id="chargement_button_0" class="btn btn-xs btn-purple" style="float: right;" onclick="chargerPrecedent('0')"><i class="ace-icon fa fa-arrow-down"></i> Charger Paramétrage Précédent (<?php echo $_SESSION['exercice'] - 1; ?>)</button>
                    <span style="display: none;" id="chargement_info_0" class="label label-xlg label-purple arrowed-in-right arrowed pull-right">Paramétrage <?php echo $_SESSION['exercice'] - 1; ?> chargé</span>
                    <input type="hidden" id="allarray_regroupement_actif">
                    <!--<input type="text" id="allarray_regroupement_actif_enregistre">-->
                </legend>
                <table class="mws-table" id="liste_ligne" style="font-weight: bold; font-size: 14px;">
                    <thead>
                        <tr>
                            <th style="width: 30%;">ACTIFS</th>
                            <th style="width: 10%; text-align: center;">Notes</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Début</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left: 2%;" colspan="4">ACTIFS NON COURANTS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Actifs immobilisés</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations incorporelles</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                $regroupement='';
                                
                                if ($parametre_actif[0]->getId() != ''):
//                                    die($parametre_actif[1]->getId().'l');
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[0]->getId());
                                  
                                foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1) {
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        $regroupement =   trim($param_compte->getRegrouppement()) . ',';
                                        } else
                                        { $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                        $regroupement='';}
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_0" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_0" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_0" value="<?php echo $parametre_actif[0]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_0_0" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(0)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(0)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(0)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[0]->getId()) echo $parametre_actif[0]->getPlandossiercomptable2(); ?>" id="compte_debut_0" onkeyup="chargerCompte('#compte_debut_0', '#hidden_compte_debut_0', '#compte_debut_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[0]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_0" />
                                <input type="hidden" value="<?php echo $parametre_actif[0]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_0_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[0]->getId()) echo $parametre_actif[0]->getPlandossiercomptable(); ?>" id="compte_fin_0" onkeyup="chargerCompte('#compte_fin_0', '#hidden_compte_fin_0', '#compte_fin_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[0]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_0" />
                                <input type="hidden" value="<?php echo $parametre_actif[0]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_0_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : amortissements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[1]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[1]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                                <input id="compte_decoche_1" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_1" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_1" value="<?php echo $parametre_actif[1]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1" value="<?php if (isset($regroupement)): echo $regroupement;
                                endif;
                                ?>" type="hidden" name="compte_regroupe">


                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(1)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(1)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(1)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[1]->getId()) echo $parametre_actif[1]->getPlandossiercomptable2(); ?>" id="compte_debut_1" onkeyup="chargerCompte('#compte_debut_1', '#hidden_compte_debut_1', '#compte_debut_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[1]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_1" />
                                <input type="hidden" value="<?php echo $parametre_actif[1]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[1]->getId()) echo $parametre_actif[1]->getPlandossiercomptable(); ?>" id="compte_fin_1" onkeyup="chargerCompte('#compte_fin_1', '#hidden_compte_fin_1', '#compte_fin_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[1]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_1" />
                                <input type="hidden" value="<?php echo $parametre_actif[1]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-1</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations corporelles</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[2]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[2]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_2" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_2" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_2" value="<?php echo $parametre_actif[2]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_2" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(2)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(2)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(2)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[2]->getId()) echo $parametre_actif[2]->getPlandossiercomptable2(); ?>" id="compte_debut_2" onkeyup="chargerCompte('#compte_debut_2', '#hidden_compte_debut_2', '#compte_debut_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[2]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_2" />
                                <input type="hidden" value="<?php echo $parametre_actif[2]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[2]->getId()) echo $parametre_actif[2]->getPlandossiercomptable(); ?>" id="compte_fin_2" onkeyup="chargerCompte('#compte_fin_2', '#hidden_compte_fin_2', '#compte_fin_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[2]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_2" />
                                <input type="hidden" value="<?php echo $parametre_actif[2]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : amortissements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[3]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[3]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_3" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_3" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_3" value="<?php echo $parametre_actif[3]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_3" value="<?php if (isset($regroupement)): echo $regroupement;
                                       endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(3)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(3)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(3)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[3]->getId()) echo $parametre_actif[3]->getPlandossiercomptable2(); ?>" id="compte_debut_3" onkeyup="chargerCompte('#compte_debut_3', '#hidden_compte_debut_3', '#compte_debut_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[3]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_3" />
                                <input type="hidden" value="<?php echo $parametre_actif[3]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[3]->getId()) echo $parametre_actif[3]->getPlandossiercomptable(); ?>" id="compte_fin_3" onkeyup="chargerCompte('#compte_fin_3', '#hidden_compte_fin_3', '#compte_fin_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[3]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_3" />
                                <input type="hidden" value="<?php echo $parametre_actif[3]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-2</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[4]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[4]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_4" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_4" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_4" value="<?php echo $parametre_actif[4]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4" value="<?php if (isset($regroupement)): echo $regroupement;
                                       endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(4)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(4)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(4)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[4]->getId()) echo $parametre_actif[4]->getPlandossiercomptable2(); ?>" id="compte_debut_4" onkeyup="chargerCompte('#compte_debut_4', '#hidden_compte_debut_4', '#compte_debut_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[4]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_4" />
                                <input type="hidden" value="<?php echo $parametre_actif[4]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[4]->getId()) echo $parametre_actif[4]->getPlandossiercomptable(); ?>" id="compte_fin_4" onkeyup="chargerCompte('#compte_fin_4', '#hidden_compte_fin_4', '#compte_fin_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[4]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_4" />
                                <input type="hidden" value="<?php echo $parametre_actif[4]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[5]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[5]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
                                       <?php endif; ?>
                                <input id="compte_decoche_5" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_5" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_5" value="<?php echo $parametre_actif[5]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_5" value="<?php if (isset($regroupement)): echo $regroupement;
                                       endif;
                                       ?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(5)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(5)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(5)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[5]->getId()) echo $parametre_actif[5]->getPlandossiercomptable2(); ?>" id="compte_debut_5" onkeyup="chargerCompte('#compte_debut_5', '#hidden_compte_debut_5', '#compte_debut_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[5]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_5" />
                                <input type="hidden" value="<?php echo $parametre_actif[5]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_5_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[5]->getId()) echo $parametre_actif[5]->getPlandossiercomptable(); ?>" id="compte_fin_5" onkeyup="chargerCompte('#compte_fin_5', '#hidden_compte_fin_5', '#compte_fin_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[5]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_5" />
                                <input type="hidden" value="<?php echo $parametre_actif[5]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_5_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-3</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="2">Total des actifs immobilisés</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres actifs non courants</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[6]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[6]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
                                       <?php endif; ?>
                                <input id="compte_decoche_6" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_6" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_6" value="<?php echo $parametre_actif[6]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_6" value="<?php if (isset($regroupement)): echo $regroupement;
                                       endif;
                                       ?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(6)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(6)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(6)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[6]->getId()) echo $parametre_actif[6]->getPlandossiercomptable2(); ?>" id="compte_debut_6" onkeyup="chargerCompte('#compte_debut_6', '#hidden_compte_debut_6', '#compte_debut_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[6]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_6" />
                                <input type="hidden" value="<?php echo $parametre_actif[6]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_6_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[6]->getId()) echo $parametre_actif[6]->getPlandossiercomptable(); ?>" id="compte_fin_6" onkeyup="chargerCompte('#compte_fin_6', '#hidden_compte_fin_6', '#compte_fin_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[6]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_6" />
                                <input type="hidden" value="<?php echo $parametre_actif[6]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_6_libelle" />
                            </td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS NON COURANTS</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>


                        <tr>
                            <td style="padding-left: 2%;" colspan="4">ACTIFS COURANTS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Stocks</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[7]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[7]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_7" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_7" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_7" value="<?php echo $parametre_actif[7]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_7" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(7)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(7)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(7)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[7]->getId()) echo $parametre_actif[7]->getPlandossiercomptable2(); ?>" id="compte_debut_7" onkeyup="chargerCompte('#compte_debut_7', '#hidden_compte_debut_7', '#compte_debut_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[7]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_7" />
                                <input type="hidden" value="<?php echo $parametre_actif[7]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_7_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[7]->getId()) echo $parametre_actif[7]->getPlandossiercomptable(); ?>" id="compte_fin_7" onkeyup="chargerCompte('#compte_fin_7', '#hidden_compte_fin_7', '#compte_fin_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[7]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_7" />
                                <input type="hidden" value="<?php echo $parametre_actif[7]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_7_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[8]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[8]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_8" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_8" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_8" value="<?php echo $parametre_actif[8]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_8" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(8)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(8)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(8)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[8]->getId()) echo $parametre_actif[8]->getPlandossiercomptable2(); ?>" id="compte_debut_8" onkeyup="chargerCompte('#compte_debut_8', '#hidden_compte_debut_8', '#compte_debut_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[8]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_8" />
                                <input type="hidden" value="<?php echo $parametre_actif[8]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_8_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[8]->getId()) echo $parametre_actif[8]->getPlandossiercomptable(); ?>" id="compte_fin_8" onkeyup="chargerCompte('#compte_fin_8', '#hidden_compte_fin_8', '#compte_fin_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[8]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_8" />
                                <input type="hidden" value="<?php echo $parametre_actif[8]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_8_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-4</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Clients et comptes rattachés</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[9]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[9]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_9" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_9" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_9" value="<?php echo $parametre_actif[9]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_9" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(9)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(9)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(9)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[9]->getId()) echo $parametre_actif[9]->getPlandossiercomptable2(); ?>" id="compte_debut_9" onkeyup="chargerCompte('#compte_debut_9', '#hidden_compte_debut_9', '#compte_debut_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[9]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_9" />
                                <input type="hidden" value="<?php echo $parametre_actif[9]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_9_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[9]->getId()) echo $parametre_actif[9]->getPlandossiercomptable(); ?>" id="compte_fin_9" onkeyup="chargerCompte('#compte_fin_9', '#hidden_compte_fin_9', '#compte_fin_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[9]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_9" />
                                <input type="hidden" value="<?php echo $parametre_actif[9]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_9_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[10]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[10]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_10" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_10" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_10" value="<?php echo $parametre_actif[10]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_10" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(10)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(10)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(10)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[10]->getId()) echo $parametre_actif[10]->getPlandossiercomptable2(); ?>" id="compte_debut_10" onkeyup="chargerCompte('#compte_debut_10', '#hidden_compte_debut_10', '#compte_debut_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[10]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_10" />
                                <input type="hidden" value="<?php echo $parametre_actif[10]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_10_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[10]->getId()) echo $parametre_actif[10]->getPlandossiercomptable(); ?>" id="compte_fin_10" onkeyup="chargerCompte('#compte_fin_10', '#hidden_compte_fin_10', '#compte_fin_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[10]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_10" />
                                <input type="hidden" value="<?php echo $parametre_actif[10]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_10_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-5</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres actifs courants</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[11]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[11]->getId()); ?>
                                    <?php
                                    $compte_decoche = '';
                                    $compte_coche = '';
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                    ?>
<?php endif; ?>
                                <input id="compte_decoche_11" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_11" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_11" value="<?php echo $parametre_actif[11]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_11" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(11)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(11)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(11)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[11]->getId()) echo $parametre_actif[11]->getPlandossiercomptable2(); ?>" id="compte_debut_11" onkeyup="chargerCompte('#compte_debut_11', '#hidden_compte_debut_11', '#compte_debut_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[11]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_11" />
                                <input type="hidden" value="<?php echo $parametre_actif[11]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_11_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[11]->getId()) echo $parametre_actif[11]->getPlandossiercomptable(); ?>" id="compte_fin_11" onkeyup="chargerCompte('#compte_fin_11', '#hidden_compte_fin_11', '#compte_fin_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[11]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_11" />
                                <input type="hidden" value="<?php echo $parametre_actif[11]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_11_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Moins : provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note">
                                <?php if ($parametre_actif[12]->getId() != ''): ?>
                                    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[12]->getId()); ?>
    <?php
    $compte_decoche = '';
    $compte_coche = '';
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1)
            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
        else
            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
    endforeach;
    ?>
<?php endif; ?>
                                <input id="compte_decoche_12" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_12" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_12" value="<?php echo $parametre_actif[12]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_12" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(12)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(12)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(12)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[12]->getId()) echo $parametre_actif[12]->getPlandossiercomptable2(); ?>" id="compte_debut_12" onkeyup="chargerCompte('#compte_debut_12', '#hidden_compte_debut_12', '#compte_debut_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[12]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_12" />
                                <input type="hidden" value="<?php echo $parametre_actif[12]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_12_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[12]->getId()) echo $parametre_actif[12]->getPlandossiercomptable(); ?>" id="compte_fin_12" onkeyup="chargerCompte('#compte_fin_12', '#hidden_compte_fin_12', '#compte_fin_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[12]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_12" />
                                <input type="hidden" value="<?php echo $parametre_actif[12]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_12_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"></td>
                            <td style="text-align: center;">3-6</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Placements et Autres Actifs Financiers</td>
                            <td style="text-align: center;">
                                <input value="3-7" type="hidden" name="note">
                                <?php if ($parametre_actif[13]->getId() != ''): ?>
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[13]->getId()); ?>
    <?php
    $compte_decoche = '';
    $compte_coche = '';
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1)
            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
        else
            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
    endforeach;
    ?>
<?php endif; ?>
                                <input id="compte_decoche_13" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_13" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_13" value="<?php echo $parametre_actif[13]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_13" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(13)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(13)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(13)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                3-7
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[13]->getId()) echo $parametre_actif[13]->getPlandossiercomptable2(); ?>" id="compte_debut_13" onkeyup="chargerCompte('#compte_debut_13', '#hidden_compte_debut_13', '#compte_debut_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[13]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_13" />
                                <input type="hidden" value="<?php echo $parametre_actif[13]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_13_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[13]->getId()) echo $parametre_actif[13]->getPlandossiercomptable(); ?>" id="compte_fin_13" onkeyup="chargerCompte('#compte_fin_13', '#hidden_compte_fin_13', '#compte_fin_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[13]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_13" />
                                <input type="hidden" value="<?php echo $parametre_actif[13]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_13_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Liquidités et équivalents de liquidités</td>
                            <td style="text-align: center;">
                                <input value="3-8" type="hidden" name="note">
<?php if ($parametre_actif[14]->getId() != ''): ?>
    <?php $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_actif[14]->getId()); ?>
    <?php
    $compte_decoche = '';
    $compte_coche = '';
    foreach ($params as $param_compte):
        if ($param_compte->getType() == 1)
            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
        else
            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
    endforeach;
    ?>
<?php endif; ?>
                                <input id="compte_decoche_14" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche">
                                <input id="compte_coche_14" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche">
                                <input id="parametre_id_14" value="<?php echo $parametre_actif[14]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_14" value="<?php if (isset($regroupement)): echo $regroupement;
endif;
?>" type="hidden" name="compte_regroupe">

                                <button title="Ajouter par Compte" onclick="gererOneCompteActif(14)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte(14)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte(14)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                3-8
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[14]->getId()) echo $parametre_actif[14]->getPlandossiercomptable2(); ?>" id="compte_debut_14" onkeyup="chargerCompte('#compte_debut_14', '#hidden_compte_debut_14', '#compte_debut_14_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[14]->getIdComptedebut(); ?>" name="hidden_compte_debut" id="hidden_compte_debut_14" />
                                <input type="hidden" value="<?php echo $parametre_actif[14]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_14_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_actif[14]->getId()) echo $parametre_actif[14]->getPlandossiercomptable(); ?>" id="compte_fin_14" onkeyup="chargerCompte('#compte_fin_14', '#hidden_compte_fin_14', '#compte_fin_14_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_actif[14]->getIdComptefin(); ?>" name="hidden_compte_fin" id="hidden_compte_fin_14" />
                                <input type="hidden" value="<?php echo $parametre_actif[14]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_14_libelle" />
                            </td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS COURANTS</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES ACTIFS</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="saveActif()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreBilan?type=0') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">
    function regrouperCompte(a) {
        if ($('#compte_debut_' + a + '_libelle').val() != '' && $('#compte_fin_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesRegroupementParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_' + a).val() +
                        '&index=' + a,
                success: function (data) {
                  
                    bootbox.dialog({
                        message: data,
                        buttons:
                                {
                                    "click":
                                            {
                                                "label": "<i class='ace-icon fa fa-check'></i> Appliquer",
                                                "className": "btn-sm btn-warning",
                                                "callback": function () {
                                                    getComptesDecocheActif(a);

                                                }
                                            },
                                    "button":
                                            {
                                                "label": "Fermer",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        } else {
            bootbox.dialog({
                message: "<h4 style='color:#bd4444;'>Veuillez vérifier le compte comptable début ou/et fin !</h4>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Fermer",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

    function gererCompte(a) {
        if ($('#compte_debut_' + a + '_libelle').val() != '' && $('#compte_fin_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_' + a).val() +
                        '&index=' + a,
                success: function (data) {
                    bootbox.dialog({
                        message: data,
                        buttons:
                                {
                                    "click":
                                            {
                                                "label": "<i class='ace-icon fa fa-check'></i> Terminer",
                                                "className": "btn-sm btn-warning",
                                                "callback": function () {
                                                    getComptesDecocheActif(a);
                                                }
                                            },
                                    "button":
                                            {
                                                "label": "Fermer",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        } else {
            bootbox.dialog({
                message: "<h4 style='color:#bd4444;'>Veuillez vérifier le compte comptable début ou/et fin !</h4>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Fermer",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

    function gererOneCompteActif(a) {
        if ($('#compte_debut_' + a + '_libelle').val() != '' && $('#compte_fin_' + a + '_libelle').val() != '') {

            var compte_debut = '';
            var compte_fin = '';
            var parametre_id = '';
            var index = '';
            compte_debut = $('#compte_debut_' + a + '_libelle').val();
            compte_fin = $('#compte_fin_' + a + '_libelle').val();
            parametre_id = $('#parametre_id_' + a).val();
            index = a;
          
            var data = {
                compte_debut: compte_debut,
                compte_fin: compte_fin,
                parametre_id: parametre_id,
                index: index,
            };
            
            $.ajax({
                type: 'POST',
//                dataType: 'json',
                contentType: "html",
                url: '<?php echo url_for('fiche_Bilan/gererOneComptesParametreBilan') ?>',
                data: JSON.stringify(data),
                success: function (result) {
                   
                    bootbox.dialog({
                        message: result,
                        buttons:
                                {
                                    "click":
                                            {
                                                "label": "<i class='ace-icon fa fa-check'></i> Appliquer",
                                                "className": "btn-sm btn-warning",
                                                "callback": function () {
                                                    getComptesDecocheActif(a);
                                                }
                                            },
                                    "button":
                                            {
                                                "label": "Fermer",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                   
                }
            });
        } else {
            bootbox.dialog({
                message: "<h4 style='color:#bd4444;'>Veuillez vérifier le compte comptable début ou/et fin !</h4>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Fermer",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

    function getComptesDecocheActif(a) {
        var comptes_decoche = '';
        $('.list_checbox_compte[type=checkbox]:not(:checked)').each(function () {
            comptes_decoche += $(this).val() + ',';
        });
        $('#compte_decoche_' + a).val(comptes_decoche);
        var comptes_coche = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes_coche += $(this).val() + ',';

        });
        var comptes_regrouppe = '';
        $('[name="regrouppement"]').each(function () {
            comptes_regrouppe += $(this).val() + ',';

        });
        $('#compte_coche_' + a).val(comptes_coche);
        $('#regroupement_id_0_' + a).val(comptes_regrouppe);
    }

    function saveActif() {
        var compte_debut = '';
        $('[name="hidden_compte_debut"]').each(function () {
            compte_debut = compte_debut + ';' + $(this).val();
        });

        var compte_fin = '';
        $('[name="hidden_compte_fin"]').each(function () {
            compte_fin = compte_fin + ';' + $(this).val();
        });

        var note = '';
        $('[name="note"]').each(function () {
            note = note + ';' + $(this).val();
        });

        var comptes_decoche = '';
        $('[name="compte_decoche"]').each(function () {
            comptes_decoche = comptes_decoche + ';' + $(this).val();
        });

        var comptes_coche = '';
        $('[name="compte_coche"]').each(function () {
            comptes_coche = comptes_coche + ';' + $(this).val();
        });
        var compte_regroupe = '';

        $('[name="compte_regroupe"]').each(function () {
            compte_regroupe = compte_regroupe + ';' + $(this).val();
        });
        var type = 0;
        $.ajax({url: '<?php echo url_for('fiche_Bilan/saveParametreBilan'); ?>',
            async: true,
            data: 'compte_debut=' + compte_debut +
                    '&compte_fin=' + compte_fin +
                    '&note=' + note +
                    '&type=' + type +
                    '&comptes_decoche=' + comptes_decoche +
                    '&comptes_coche=' + comptes_coche +
                    '&compte_regroupe=' + compte_regroupe +
                    '&array_regr=' + $('#allarray_regroupement_actif').val(),
            success: function (data) {
                bootbox.dialog({
                 
                            message: "<h4 style='color: #4c9541;'>Changement appliqué avec succès !</h4>",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Fermer",
                                            "className": "btn-sm"
                                        }
                            }
                });

//                $('#allarray_regroupement_actif_enregistre').val($('#allarray_regroupement_actif').val());

            }
        });
    }

</script>