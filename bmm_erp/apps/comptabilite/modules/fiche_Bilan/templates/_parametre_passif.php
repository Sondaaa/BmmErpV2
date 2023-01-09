<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage des Passifs
                    <button id="chargement_button_1" class="btn btn-xs btn-purple" style="float: right;" onclick="chargerPrecedent('1')"><i class="ace-icon fa fa-arrow-down"></i> Charger Paramétrage Précédent (<?php echo $_SESSION['exercice'] - 1; ?>)</button>
                    <span style="display: none;" id="chargement_info_1" class="label label-xlg label-purple arrowed-in-right arrowed pull-right">Paramétrage <?php echo $_SESSION['exercice'] - 1; ?> chargé</span>
                    <input type="hidden" id="allarray_regroupement">
                </legend>
                <table class="mws-table" id="liste_ligne" style="font-weight: bold; font-size: 14px;">
                    <thead>
                        <tr>
                            <th style="width: 30%;">CAPITAUX PROPRES ET PASSIFS</th>
                            <th style="width: 10%; text-align: center;">Notes</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Début</th>
                            <th style="width: 30%; text-align: center;">Compte Comptable Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left: 2%;" colspan="4">CAPITAUX PROPRES ET PASSIFS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Capitaux propres</td>
                        </tr>
                        <tr>
                            <?php if ($_SESSION['dossier_id'] == 1): ?>
                                <td style="padding-left: 6%;">Subventions d'investissements amortissables</td>
                            <?php else: ?>
                                <td style="padding-left: 6%;">Capital social</td>
                            <?php endif; ?> 

                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                $regroupement = '';
                                if ($parametre_passif[0]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[0]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1):
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
//                                            $regroupement =  $regroupement . trim($param_compte->getRegrouppement()) . ',';
                                        else:
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_0" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_0" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_0" value="<?php echo $parametre_passif[0]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_0" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(0)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(0)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(0)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"> </i>R</button>

                            </td>
                            <td>
                                <input type="text" autocomplete="off" value="<?php if ($parametre_passif[0]->getId()) echo $parametre_passif[0]->getPlandossiercomptable2(); ?>" id="compte_debut_1_0" onkeyup="chargerCompte('#compte_debut_1_0', '#hidden_compte_debut_1_0', '#compte_debut_1_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[0]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_0" />
                                <input type="hidden" value="<?php echo $parametre_passif[0]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_0_libelle" />
                            </td>
                            <td>
                                <input type="text" autocomplete="off" value="<?php if ($parametre_passif[0]->getId()) echo $parametre_passif[0]->getPlandossiercomptable(); ?>" id="compte_fin_1_0" onkeyup="chargerCompte('#compte_fin_1_0', '#hidden_compte_fin_1_0', '#compte_fin_1_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[0]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_0" />
                                <input type="hidden" value="<?php echo $parametre_passif[0]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_0_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <?php if ($_SESSION['dossier_id'] == 1): ?>
                                <td style="padding-left: 6%;"> Subventions d'investissements non amortissables</td>
                            <?php else: ?>
                                <td style="padding-left: 6%;">Réserves légal</td>
                            <?php endif; ?>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[1]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[1]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_1" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_1" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_1" value="<?php echo $parametre_passif[1]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_1" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(1)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(1)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(1)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[1]->getId()) echo $parametre_passif[1]->getPlandossiercomptable2(); ?>" id="compte_debut_1_1" onkeyup="chargerCompte('#compte_debut_1_1', '#hidden_compte_debut_1_1', '#compte_debut_1_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[1]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_1" />
                                <input type="hidden" value="<?php echo $parametre_passif[1]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_1_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[1]->getId()) echo $parametre_passif[1]->getPlandossiercomptable(); ?>" id="compte_fin_1_1" onkeyup="chargerCompte('#compte_fin_1_1', '#hidden_compte_fin_1_1', '#compte_fin_1_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[1]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_1" />
                                <input type="hidden" value="<?php echo $parametre_passif[1]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_1_libelle" />
                            </td>
                        </tr>
                        <tr> <?php if ($_SESSION['dossier_id'] == 1): ?>
                                <td style="padding-left: 6%;"> Subvention à affecter</td>
                            <?php else: ?>
                                <td style="padding-left: 6%;">Effet de modification comptable</td>
                            <?php endif; ?>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[2]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[2]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_2" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_2" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_2" value="<?php echo $parametre_passif[2]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_2" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(2)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(2)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(2)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[2]->getId()) echo $parametre_passif[2]->getPlandossiercomptable2(); ?>" id="compte_debut_1_2" onkeyup="chargerCompte('#compte_debut_1_2', '#hidden_compte_debut_1_2', '#compte_debut_1_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[2]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_2" />
                                <input type="hidden" value="<?php echo $parametre_passif[2]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_2_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[2]->getId()) echo $parametre_passif[2]->getPlandossiercomptable(); ?>" id="compte_fin_1_2" onkeyup="chargerCompte('#compte_fin_1_2', '#hidden_compte_fin_1_2', '#compte_fin_1_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[2]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_2" />
                                <input type="hidden" value="<?php echo $parametre_passif[2]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_2_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Total capitaux propres avant résultat</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Résultat de l'exercice</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[3]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[3]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_3" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_3" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_3" value="<?php echo $parametre_passif[3]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_3" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(3)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(3)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(3)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[3]->getId()) echo $parametre_passif[3]->getPlandossiercomptable2(); ?>" id="compte_debut_1_3" onkeyup="chargerCompte('#compte_debut_1_3', '#hidden_compte_debut_1_3', '#compte_debut_1_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[3]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_3" />
                                <input type="hidden" value="<?php echo $parametre_passif[3]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_3_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[3]->getId()) echo $parametre_passif[3]->getPlandossiercomptable(); ?>" id="compte_fin_1_3" onkeyup="chargerCompte('#compte_fin_1_3', '#hidden_compte_fin_1_3', '#compte_fin_1_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[3]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_3" />
                                <input type="hidden" value="<?php echo $parametre_passif[3]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_3_libelle" />
                            </td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">TOTAL CAPITAUX PROPRES</td>
                            <td style="text-align: center;">4-1</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>


                        <tr>
                            <td style="padding-left: 2%;" colspan="4">PASSIFS</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Passifs non courants</td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[4]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[4]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_4" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_4" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_4" value="<?php echo $parametre_passif[4]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_4" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(4)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(4)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(4)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[4]->getId()) echo $parametre_passif[4]->getPlandossiercomptable2(); ?>" id="compte_debut_1_4" onkeyup="chargerCompte('#compte_debut_1_4', '#hidden_compte_debut_1_4', '#compte_debut_1_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[4]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_4" />
                                <input type="hidden" value="<?php echo $parametre_passif[4]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_4_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[4]->getId()) echo $parametre_passif[4]->getPlandossiercomptable(); ?>" id="compte_fin_1_4" onkeyup="chargerCompte('#compte_fin_1_4', '#hidden_compte_fin_1_4', '#compte_fin_1_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[4]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_4" />
                                <input type="hidden" value="<?php echo $parametre_passif[4]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_4_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Total passifs non courants</td>
                            <td style="text-align: center;">4-2</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;" colspan="4">Passifs courants</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Fournisseurs et comptes rattachés</td>
                            <td style="text-align: center;">
                                <input value="4-3" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[5]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[5]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_5" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_5" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_5" value="<?php echo $parametre_passif[5]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_5" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(5)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(5)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(5)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                4-2
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[5]->getId()) echo $parametre_passif[5]->getPlandossiercomptable2(); ?>" id="compte_debut_1_5" onkeyup="chargerCompte('#compte_debut_1_5', '#hidden_compte_debut_1_5', '#compte_debut_1_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[5]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_5" />
                                <input type="hidden" value="<?php echo $parametre_passif[5]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_5_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[5]->getId()) echo $parametre_passif[5]->getPlandossiercomptable(); ?>" id="compte_fin_1_5" onkeyup="chargerCompte('#compte_fin_1_5', '#hidden_compte_fin_1_5', '#compte_fin_1_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[5]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_5" />
                                <input type="hidden" value="<?php echo $parametre_passif[5]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_5_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres passifs courants</td>
                            <td style="text-align: center;">
                                <input value="4-4" type="hidden" name="note_1">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_passif[6]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_passif[6]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_1_6" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_1">
                                <input id="compte_coche_1_6" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_1">
                                <input id="parametre_id_1_6" value="<?php echo $parametre_passif[6]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_1_6" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_1">

                                <button title="Ajouter par Compte" onclick="gererOneCompte1(6)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte1(6)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte1(6)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>4-4
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[6]->getId()) echo $parametre_passif[6]->getPlandossiercomptable2(); ?>" id="compte_debut_1_6" onkeyup="chargerCompte('#compte_debut_1_6', '#hidden_compte_debut_1_6', '#compte_debut_1_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[6]->getIdComptedebut(); ?>" name="hidden_compte_debut_1" id="hidden_compte_debut_1_6" />
                                <input type="hidden" value="<?php echo $parametre_passif[6]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_1_6_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_passif[6]->getId()) echo $parametre_passif[6]->getPlandossiercomptable(); ?>" id="compte_fin_1_6" onkeyup="chargerCompte('#compte_fin_1_6', '#hidden_compte_fin_1_6', '#compte_fin_1_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_passif[6]->getIdComptefin(); ?>" name="hidden_compte_fin_1" id="hidden_compte_fin_1_6" />
                                <input type="hidden" value="<?php echo $parametre_passif[6]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_1_6_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Total passifs courants</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES PASSIFS</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>


                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">TOTAL DES CAPITAUX PROPRES ET PASSIFS</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="savePassif()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreBilan?type=1') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function regrouperCompte1(a) {
        if ($('#compte_debut_1_' + a + '_libelle').val() != '' && $('#compte_fin_1_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesRegroupementParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_1_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_1_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_1_' + a).val() +
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
                                                    getComptesDecochePassif(a);

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

    function gererCompte1(a) {
        if ($('#compte_debut_1_' + a + '_libelle').val() != '' && $('#compte_fin_1_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_1_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_1_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_1_' + a).val() +
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
                                                    getComptesDecochePassif(a);
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

    function gererOneCompte1(a) {
         var compte_debut = '';
            var compte_fin = '';
            var parametre_id = '';
            var index = '';
           
        if ($('#compte_debut_1_' + a + '_libelle').val() != '' && $('#compte_fin_1_' + a + '_libelle').val() != '') {
             compte_debut = $('#compte_debut_1_' + a + '_libelle').val();
            compte_fin = $('#compte_fin_1_' + a + '_libelle').val();
            parametre_id = $('#parametre_id_1_' + a).val();
            index = a;
             var data = {
                compte_debut: compte_debut,
                compte_fin: compte_fin,
                parametre_id: parametre_id,
                index: a,
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
                                                    getComptesDecochePassif(a);
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

    function getComptesDecochePassif(a) {
        var comptes_decoche = '';
        //Check all checkbox


        $('.list_checbox_compte[type=checkbox]:not(:checked)').each(function () {
            comptes_decoche += $(this).val() + ',';
        });
        $('#compte_decoche_1_' + a).val(comptes_decoche);
        var comptes_coche = '';


        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes_coche += $(this).val() + ',';
        });
        var comptes_regrouppe = '';
        $('[name="regrouppement"]').each(function () {
            comptes_regrouppe += $(this).val() + ',';

        });
        $('#compte_coche_1_' + a).val(comptes_coche);
        $('#regroupement_id_1_' + a).val(comptes_regrouppe);


    }

    function savePassif() {
        var compte_debut = '';
        $('[name="hidden_compte_debut_1"]').each(function () {
            compte_debut = compte_debut + ';' + $(this).val();
        });

        var compte_fin = '';
        $('[name="hidden_compte_fin_1"]').each(function () {
            compte_fin = compte_fin + ';' + $(this).val();
        });

        var note = '';
        $('[name="note_1"]').each(function () {
            note = note + ';' + $(this).val();
        });

        var comptes_decoche = '';
        $('[name="compte_decoche_1"]').each(function () {
            comptes_decoche = comptes_decoche + ';' + $(this).val();
        });

        var comptes_coche = '';
        $('[name="compte_coche_1"]').each(function () {
            comptes_coche = comptes_coche + ';' + $(this).val();
        });
        var compte_regroupe = '';

        $('[name="compte_regroupe_1"]').each(function () {
            compte_regroupe = compte_regroupe + ';' + $(this).val();
        });
        var type = 1;
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/saveParametreBilan'); ?>',
            async: true,
            data: 'compte_debut=' + compte_debut +
                    '&compte_fin=' + compte_fin +
                    '&note=' + note +
                    '&type=' + type +
                    '&comptes_decoche=' + comptes_decoche +
                    '&comptes_coche=' + comptes_coche +
                    '&compte_regroupe=' + compte_regroupe +
                    '&array_regr=' + $('#allarray_regroupement').val(),
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
//                document.location.reload();
            }
        });
    }

</script>