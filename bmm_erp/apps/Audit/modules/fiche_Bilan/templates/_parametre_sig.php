<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage du Solde Intermediaire de Gestion (SIG)
                    <button id="chargement_button_4" class="btn btn-xs btn-purple" style="float: right;" onclick="chargerPrecedent('4')"><i class="ace-icon fa fa-arrow-down"></i> Charger Paramétrage Précédent (<?php echo $_SESSION['exercice'] - 1; ?>)</button>
                    <span style="display: none;" id="chargement_info_4" class="label label-xlg label-purple arrowed-in-right arrowed pull-right">Paramétrage <?php echo $_SESSION['exercice'] - 1; ?> chargé</span>
                    <input type="hidden" id="allarray_regroupement_sig">
          
                </legend>
                <table class="mws-table" id="liste_ligne" style="font-weight: bold; font-size: 14px;">
                    <thead>
                        <tr>
                            <th style="width: 30%;"></th>
                            <th style="width: 10%; text-align: center;">Notes</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Début</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left: 4%;">Produits d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[0]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[0]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_0" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_0" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_0" value="<?php echo $parametre_sig[0]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_0" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(0)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(0)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(0)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[0]->getId()) echo $parametre_sig[0]->getPlandossiercomptable2(); ?>" id="compte_debut_4_0" onkeyup="chargerCompte('#compte_debut_4_0', '#hidden_compte_debut_4_0', '#compte_debut_4_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[0]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_0" />
                                <input type="hidden" value="<?php echo $parametre_sig[0]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_0_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[0]->getId()) echo $parametre_sig[0]->getPlandossiercomptable(); ?>" id="compte_fin_4_0" onkeyup="chargerCompte('#compte_fin_4_0', '#hidden_compte_fin_4_0', '#compte_fin_4_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[0]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_0" />
                                <input type="hidden" value="<?php echo $parametre_sig[0]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_0_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Production Immobilisée</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[1]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[1]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_1" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_1" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_1" value="<?php echo $parametre_sig[1]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_1" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(1)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(1)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(1)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[1]->getId()) echo $parametre_sig[1]->getPlandossiercomptable2(); ?>" id="compte_debut_4_1" onkeyup="chargerCompte('#compte_debut_4_1', '#hidden_compte_debut_4_1', '#compte_debut_4_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[1]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_1" />
                                <input type="hidden" value="<?php echo $parametre_sig[1]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_1_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[1]->getId()) echo $parametre_sig[1]->getPlandossiercomptable(); ?>" id="compte_fin_4_1" onkeyup="chargerCompte('#compte_fin_4_1', '#hidden_compte_fin_4_1', '#compte_fin_4_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[1]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_1" />
                                <input type="hidden" value="<?php echo $parametre_sig[1]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_1_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Production</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Coût des matières consommées</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[2]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[2]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_2" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_2" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_2" value="<?php echo $parametre_sig[2]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_2" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(2)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(2)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(2)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[2]->getId()) echo $parametre_sig[2]->getPlandossiercomptable2(); ?>" id="compte_debut_4_2" onkeyup="chargerCompte('#compte_debut_4_2', '#hidden_compte_debut_4_2', '#compte_debut_4_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[2]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_2" />
                                <input type="hidden" value="<?php echo $parametre_sig[2]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_2_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[2]->getId()) echo $parametre_sig[2]->getPlandossiercomptable(); ?>" id="compte_fin_4_2" onkeyup="chargerCompte('#compte_fin_4_2', '#hidden_compte_fin_4_2', '#compte_fin_4_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[2]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_2" />
                                <input type="hidden" value="<?php echo $parametre_sig[2]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_2_libelle" />
                            </td>
                        </tr>                       
                        <tr>
                            <td style="padding-left: 4%;">Déstokage de production</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[3]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[3]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_3" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_3" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_3" value="<?php echo $parametre_sig[3]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_3" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(3)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(3)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(3)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[3]->getId()) echo $parametre_sig[3]->getPlandossiercomptable2(); ?>" id="compte_debut_4_3" onkeyup="chargerCompte('#compte_debut_4_3', '#hidden_compte_debut_4_3', '#compte_debut_4_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[3]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_3" />
                                <input type="hidden" value="<?php echo $parametre_sig[3]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_3_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[3]->getId()) echo $parametre_sig[3]->getPlandossiercomptable(); ?>" id="compte_fin_4_3" onkeyup="chargerCompte('#compte_fin_4_3', '#hidden_compte_fin_4_3', '#compte_fin_4_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[3]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_3" />
                                <input type="hidden" value="<?php echo $parametre_sig[3]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_3_libelle" />
                            </td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Achats consommés</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Marge sur coût matières</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Autres produits d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[4]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[4]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_4" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_4" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_4" value="<?php echo $parametre_sig[4]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_4" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(4)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(4)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(4)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[4]->getId()) echo $parametre_sig[4]->getPlandossiercomptable2(); ?>" id="compte_debut_4_4" onkeyup="chargerCompte('#compte_debut_4_4', '#hidden_compte_debut_4_4', '#compte_debut_4_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[4]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_4" />
                                <input type="hidden" value="<?php echo $parametre_sig[4]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_4_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[4]->getId()) echo $parametre_sig[4]->getPlandossiercomptable(); ?>" id="compte_fin_4_4" onkeyup="chargerCompte('#compte_fin_4_4', '#hidden_compte_fin_4_4', '#compte_fin_4_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[4]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_4" />
                                <input type="hidden" value="<?php echo $parametre_sig[4]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_4_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Autres charges d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[5]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[5]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_5" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_5" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_5" value="<?php echo $parametre_sig[5]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_5" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(5)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(5)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(5)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[5]->getId()) echo $parametre_sig[5]->getPlandossiercomptable2(); ?>" id="compte_debut_4_5" onkeyup="chargerCompte('#compte_debut_4_5', '#hidden_compte_debut_4_5', '#compte_debut_4_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[5]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_5" />
                                <input type="hidden" value="<?php echo $parametre_sig[5]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_5_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[5]->getId()) echo $parametre_sig[5]->getPlandossiercomptable(); ?>" id="compte_fin_4_5" onkeyup="chargerCompte('#compte_fin_4_5', '#hidden_compte_fin_4_5', '#compte_fin_4_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[5]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_5" />
                                <input type="hidden" value="<?php echo $parametre_sig[5]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_5_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Impôts et taxes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[6]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[6]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_6" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_6" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_6" value="<?php echo $parametre_sig[6]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_6" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(6)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(6)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(6)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[6]->getId()) echo $parametre_sig[6]->getPlandossiercomptable2(); ?>" id="compte_debut_4_6" onkeyup="chargerCompte('#compte_debut_4_6', '#hidden_compte_debut_4_6', '#compte_debut_4_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[6]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_6" />
                                <input type="hidden" value="<?php echo $parametre_sig[6]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_6_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[6]->getId()) echo $parametre_sig[6]->getPlandossiercomptable(); ?>" id="compte_fin_4_6" onkeyup="chargerCompte('#compte_fin_4_6', '#hidden_compte_fin_4_6', '#compte_fin_4_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[6]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_6" />
                                <input type="hidden" value="<?php echo $parametre_sig[6]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_6_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Charges de personnel</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[7]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[7]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_7" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_7" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_7" value="<?php echo $parametre_sig[7]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_7" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(7)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(7)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>

                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(7)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[7]->getId()) echo $parametre_sig[7]->getPlandossiercomptable2(); ?>" id="compte_debut_4_7" onkeyup="chargerCompte('#compte_debut_4_7', '#hidden_compte_debut_4_7', '#compte_debut_4_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[7]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_7" />
                                <input type="hidden" value="<?php echo $parametre_sig[7]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_7_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[7]->getId()) echo $parametre_sig[7]->getPlandossiercomptable(); ?>" id="compte_fin_4_7" onkeyup="chargerCompte('#compte_fin_4_7', '#hidden_compte_fin_4_7', '#compte_fin_4_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[7]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_7" />
                                <input type="hidden" value="<?php echo $parametre_sig[7]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_7_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">EXCEDENT BRUT D'EXLOITATION</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Charges financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[8]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[8]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_8" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_8" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_8" value="<?php echo $parametre_sig[8]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_8" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(8)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(8)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(8)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[8]->getId()) echo $parametre_sig[8]->getPlandossiercomptable2(); ?>" id="compte_debut_4_8" onkeyup="chargerCompte('#compte_debut_4_8', '#hidden_compte_debut_4_8', '#compte_debut_4_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[8]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_8" />
                                <input type="hidden" value="<?php echo $parametre_sig[8]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_8_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[8]->getId()) echo $parametre_sig[8]->getPlandossiercomptable(); ?>" id="compte_fin_4_8" onkeyup="chargerCompte('#compte_fin_4_8', '#hidden_compte_fin_4_8', '#compte_fin_4_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[8]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_8" />
                                <input type="hidden" value="<?php echo $parametre_sig[8]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_8_libelle" />
                            </td>
                        </tr>



                        <tr>
                            <td style="padding-left: 4%;">Dotation aux amortissements et aux provisions </td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[9]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[9]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_9" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_9" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_9" value="<?php echo $parametre_sig[9]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_9" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(9)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(9)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(9)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[9]->getId()) echo $parametre_sig[9]->getPlandossiercomptable2(); ?>" id="compte_debut_4_9" onkeyup="chargerCompte('#compte_debut_4_9', '#hidden_compte_debut_4_9', '#compte_debut_4_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[9]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_9" />
                                <input type="hidden" value="<?php echo $parametre_sig[9]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_9_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[9]->getId()) echo $parametre_sig[9]->getPlandossiercomptable(); ?>" id="compte_fin_4_9" onkeyup="chargerCompte('#compte_fin_4_9', '#hidden_compte_fin_4_9', '#compte_fin_4_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[9]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_9" />
                                <input type="hidden" value="<?php echo $parametre_sig[9]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_9_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;"> Produits Financiers </td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[10]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[10]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_10" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_10" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_10" value="<?php echo $parametre_sig[10]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_10" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(10)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(10)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(10)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[10]->getId()) echo $parametre_sig[10]->getPlandossiercomptable2(); ?>" id="compte_debut_4_10" onkeyup="chargerCompte('#compte_debut_4_10', '#hidden_compte_debut_4_10', '#compte_debut_4_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[10]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_10" />
                                <input type="hidden" value="<?php echo $parametre_sig[10]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_10_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[10]->getId()) echo $parametre_sig[10]->getPlandossiercomptable(); ?>" id="compte_fin_4_10" onkeyup="chargerCompte('#compte_fin_4_10', '#hidden_compte_fin_4_10', '#compte_fin_4_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[10]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_10" />
                                <input type="hidden" value="<?php echo $parametre_sig[10]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_10_libelle" />
                            </td>
                        </tr>


                        <tr>
                            <td style="padding-left: 4%;">Autres gains ordinaires </td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[11]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[11]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_11" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_11" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_11" value="<?php echo $parametre_sig[11]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_11" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(11)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(11)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(11)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[11]->getId()) echo $parametre_sig[11]->getPlandossiercomptable2(); ?>" id="compte_debut_4_11" onkeyup="chargerCompte('#compte_debut_4_11', '#hidden_compte_debut_4_11', '#compte_debut_4_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[11]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_11" />
                                <input type="hidden" value="<?php echo $parametre_sig[11]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_11_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[11]->getId()) echo $parametre_sig[11]->getPlandossiercomptable(); ?>" id="compte_fin_4_11" onkeyup="chargerCompte('#compte_fin_4_11', '#hidden_compte_fin_4_11', '#compte_fin_4_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[11]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_11" />
                                <input type="hidden" value="<?php echo $parametre_sig[11]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_11_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Autres pertes ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[12]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[12]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_12" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_12" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_12" value="<?php echo $parametre_sig[12]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_12" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(12)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(12)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(12)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[12]->getId()) echo $parametre_sig[12]->getPlandossiercomptable2(); ?>" id="compte_debut_4_12" onkeyup="chargerCompte('#compte_debut_4_12', '#hidden_compte_debut_4_12', '#compte_debut_4_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[12]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_12" />
                                <input type="hidden" value="<?php echo $parametre_sig[12]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_12_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[12]->getId()) echo $parametre_sig[12]->getPlandossiercomptable(); ?>" id="compte_fin_4_12" onkeyup="chargerCompte('#compte_fin_4_12', '#hidden_compte_fin_4_12', '#compte_fin_4_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[12]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_12" />
                                <input type="hidden" value="<?php echo $parametre_sig[12]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_12_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">RESULTAT DES ACTIVITES AVANT IMPÔT</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Impôt sur les bénéfices</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_sig[13]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_sig[13]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_4_13" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_4">
                                <input id="compte_coche_4_13" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_4">
                                <input id="parametre_id_4_13" value="<?php echo $parametre_sig[13]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_4_13" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_4">

                                <button title="Ajouter par Compte" onclick="gererOneCompte4(13)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte4(13)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte4(13)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[13]->getId()) echo $parametre_sig[13]->getPlandossiercomptable2(); ?>" id="compte_debut_4_13" onkeyup="chargerCompte('#compte_debut_4_13', '#hidden_compte_debut_4_13', '#compte_debut_4_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[13]->getIdComptedebut(); ?>" name="hidden_compte_debut_4" id="hidden_compte_debut_4_13" />
                                <input type="hidden" value="<?php echo $parametre_sig[13]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_4_13_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_sig[13]->getId()) echo $parametre_sig[13]->getPlandossiercomptable(); ?>" id="compte_fin_4_13" onkeyup="chargerCompte('#compte_fin_4_13', '#hidden_compte_fin_4_13', '#compte_fin_4_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_sig[13]->getIdComptefin(); ?>" name="hidden_compte_fin_4" id="hidden_compte_fin_4_13" />
                                <input type="hidden" value="<?php echo $parametre_sig[13]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_4_13_libelle" />
                            </td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">RESULTAT NET APRES IMPÔT </td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="saveSig()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreBilan?type=4') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">
function regrouperCompte4(a) {
        if ($('#compte_debut_4_' + a + '_libelle').val() != '' && $('#compte_fin_4_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesRegroupementParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_4_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_4_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_4_' + a).val() +
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
                                                    getComptesDecocheResultat(a);

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

    function  gererCompte4(a) {
        if ($('#compte_debut_4_' + a + '_libelle').val() != '' && $('#compte_fin_4_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_4_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_4_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_4_' + a).val() +
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
                                                    getComptesDecocheSig(a);
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

    function gererOneCompte4(a) {
        if ($('#compte_debut_4_' + a + '_libelle').val() != '' && $('#compte_fin_4_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererOneComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_4_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_4_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_4_' + a).val() +
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
                                                    getComptesDecocheSig(a);
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

    function getComptesDecocheSig(a) {
        var comptes_decoche = '';
        $('.list_checbox_compte[type=checkbox]:not(:checked)').each(function () {
            comptes_decoche += $(this).val() + ',';
        });
        $('#compte_decoche_4_' + a).val(comptes_decoche);
        var comptes_coche = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes_coche += $(this).val() + ',';
        });
        $('#compte_coche_4_' + a).val(comptes_coche);
           var comptes_regrouppe = '';
        $('[name="regrouppement"]').each(function () {
            comptes_regrouppe += $(this).val() + ',';

        });
        $('#compte_coche_4_' + a).val(comptes_coche);
        $('#regroupement_id_4_' + a).val(comptes_regrouppe);
    }

    function saveSig() {
        var compte_debut = '';
        $('[name="hidden_compte_debut_4"]').each(function () {
            compte_debut = compte_debut + ';' + $(this).val();
        });

        var compte_fin = '';
        $('[name="hidden_compte_fin_4"]').each(function () {
            compte_fin = compte_fin + ';' + $(this).val();
        });

        var note = '';
        $('[name="note_4"]').each(function () {
            note = note + ';' + $(this).val();
        });

        var comptes_decoche = '';
        $('[name="compte_decoche_4"]').each(function () {
            comptes_decoche = comptes_decoche + ';' + $(this).val();
        });

        var comptes_coche = '';
        $('[name="compte_coche_4"]').each(function () {
            comptes_coche = comptes_coche + ';' + $(this).val();
        });
        var compte_regroupe = '';

        $('[name="compte_regroupe_4"]').each(function () {
            compte_regroupe = compte_regroupe + ';' + $(this).val();
        });
        var type = 4;
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/saveParametreBilan'); ?>',
            async: true,
            data: 'compte_debut=' + compte_debut +
                    '&compte_fin=' + compte_fin +
                    '&note=' + note +
                    '&type=' + type +
                    '&comptes_decoche=' + comptes_decoche +
                    '&comptes_coche=' + comptes_coche+
                    '&array_regr=' + $('#allarray_regroupement_sig').val(),
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
                document.location.reload();
            }
        });
    }

</script>