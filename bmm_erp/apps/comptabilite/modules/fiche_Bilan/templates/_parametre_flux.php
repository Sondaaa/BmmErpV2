<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage des Flux MA
                    <button id="chargement_button_3" class="btn btn-xs btn-purple" style="float: right;" onclick="chargerPrecedent('3')"><i class="ace-icon fa fa-arrow-down"></i> Charger Paramétrage Précédent (<?php echo $_SESSION['exercice'] - 1; ?>)</button>
                    <span style="display: none;" id="chargement_info_3" class="label label-xlg label-purple arrowed-in-right arrowed pull-right">Paramétrage <?php echo $_SESSION['exercice'] - 1; ?> chargé</span>
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
                            <td style="padding-left: 2%;" colspan="4">Flux de trésorerie liés à l'exploitation</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Résultat net</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[0]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[0]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_0" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_0" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_0" value="<?php echo $parametre_flux[0]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(0)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(0)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[0]->getId()) echo $parametre_flux[0]->getPlandossiercomptable2(); ?>" id="compte_debut_3_0" onkeyup="chargerCompte('#compte_debut_3_0', '#hidden_compte_debut_3_0', '#compte_debut_3_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[0]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_0" />
                                <input type="hidden" value="<?php echo $parametre_flux[0]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_0_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[0]->getId()) echo $parametre_flux[0]->getPlandossiercomptable(); ?>" id="compte_fin_3_0" onkeyup="chargerCompte('#compte_fin_3_0', '#hidden_compte_fin_3_0', '#compte_fin_3_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[0]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_0" />
                                <input type="hidden" value="<?php echo $parametre_flux[0]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_0_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Ajustements pour</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[1]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[1]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_1" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_1" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_1" value="<?php echo $parametre_flux[1]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(1)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(1)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[1]->getId()) echo $parametre_flux[1]->getPlandossiercomptable2(); ?>" id="compte_debut_3_1" onkeyup="chargerCompte('#compte_debut_3_1', '#hidden_compte_debut_3_1', '#compte_debut_3_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[1]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_1" />
                                <input type="hidden" value="<?php echo $parametre_flux[1]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_1_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[1]->getId()) echo $parametre_flux[1]->getPlandossiercomptable(); ?>" id="compte_fin_3_1" onkeyup="chargerCompte('#compte_fin_3_1', '#hidden_compte_fin_3_1', '#compte_fin_3_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[1]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_1" />
                                <input type="hidden" value="<?php echo $parametre_flux[1]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_1_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Amortissements et provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[2]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[2]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_2" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_2" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_2" value="<?php echo $parametre_flux[2]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(2)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(2)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[2]->getId()) echo $parametre_flux[2]->getPlandossiercomptable2(); ?>" id="compte_debut_3_2" onkeyup="chargerCompte('#compte_debut_3_2', '#hidden_compte_debut_3_2', '#compte_debut_3_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[2]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_2" />
                                <input type="hidden" value="<?php echo $parametre_flux[2]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_2_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[2]->getId()) echo $parametre_flux[2]->getPlandossiercomptable(); ?>" id="compte_fin_3_2" onkeyup="chargerCompte('#compte_fin_3_2', '#hidden_compte_fin_3_2', '#compte_fin_3_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[2]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_2" />
                                <input type="hidden" value="<?php echo $parametre_flux[2]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_2_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Variation des :</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">- Stocks</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[3]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[3]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_3" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_3" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_3" value="<?php echo $parametre_flux[3]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(3)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(3)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[3]->getId()) echo $parametre_flux[3]->getPlandossiercomptable2(); ?>" id="compte_debut_3_3" onkeyup="chargerCompte('#compte_debut_3_3', '#hidden_compte_debut_3_3', '#compte_debut_3_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[3]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_3" />
                                <input type="hidden" value="<?php echo $parametre_flux[3]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_3_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[3]->getId()) echo $parametre_flux[3]->getPlandossiercomptable(); ?>" id="compte_fin_3_3" onkeyup="chargerCompte('#compte_fin_3_3', '#hidden_compte_fin_3_3', '#compte_fin_3_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[3]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_3" />
                                <input type="hidden" value="<?php echo $parametre_flux[3]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_3_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">- Créances</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[4]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[4]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_4" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_4" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_4" value="<?php echo $parametre_flux[4]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(4)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(4)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[4]->getId()) echo $parametre_flux[4]->getPlandossiercomptable2(); ?>" id="compte_debut_3_4" onkeyup="chargerCompte('#compte_debut_3_4', '#hidden_compte_debut_3_4', '#compte_debut_3_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[4]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_4" />
                                <input type="hidden" value="<?php echo $parametre_flux[4]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_4_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[4]->getId()) echo $parametre_flux[4]->getPlandossiercomptable(); ?>" id="compte_fin_3_4" onkeyup="chargerCompte('#compte_fin_3_4', '#hidden_compte_fin_3_4', '#compte_fin_3_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[4]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_4" />
                                <input type="hidden" value="<?php echo $parametre_flux[4]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_4_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">- Fournisseurs et autres dettes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[5]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[5]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_5" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_5" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_5" value="<?php echo $parametre_flux[5]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(5)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(5)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[5]->getId()) echo $parametre_flux[5]->getPlandossiercomptable2(); ?>" id="compte_debut_3_5" onkeyup="chargerCompte('#compte_debut_3_5', '#hidden_compte_debut_3_5', '#compte_debut_3_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[5]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_5" />
                                <input type="hidden" value="<?php echo $parametre_flux[5]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_5_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[5]->getId()) echo $parametre_flux[5]->getPlandossiercomptable(); ?>" id="compte_fin_3_5" onkeyup="chargerCompte('#compte_fin_3_5', '#hidden_compte_fin_3_5', '#compte_fin_3_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[5]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_5" />
                                <input type="hidden" value="<?php echo $parametre_flux[5]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_5_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Plus ou moins values de cession</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[6]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[6]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_6" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_6" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_6" value="<?php echo $parametre_flux[6]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(6)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(6)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[6]->getId()) echo $parametre_flux[6]->getPlandossiercomptable2(); ?>" id="compte_debut_3_6" onkeyup="chargerCompte('#compte_debut_3_6', '#hidden_compte_debut_3_6', '#compte_debut_3_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[6]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_6" />
                                <input type="hidden" value="<?php echo $parametre_flux[6]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_6_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[6]->getId()) echo $parametre_flux[6]->getPlandossiercomptable(); ?>" id="compte_fin_3_6" onkeyup="chargerCompte('#compte_fin_3_6', '#hidden_compte_fin_3_6', '#compte_fin_3_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[6]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_6" />
                                <input type="hidden" value="<?php echo $parametre_flux[6]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_6_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Transfert de charges</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[7]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[7]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_7" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_7" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_7" value="<?php echo $parametre_flux[7]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(7)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(7)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[7]->getId()) echo $parametre_flux[7]->getPlandossiercomptable2(); ?>" id="compte_debut_3_7" onkeyup="chargerCompte('#compte_debut_3_7', '#hidden_compte_debut_3_7', '#compte_debut_3_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[7]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_7" />
                                <input type="hidden" value="<?php echo $parametre_flux[7]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_7_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[7]->getId()) echo $parametre_flux[7]->getPlandossiercomptable(); ?>" id="compte_fin_3_7" onkeyup="chargerCompte('#compte_fin_3_7', '#hidden_compte_fin_3_7', '#compte_fin_3_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[7]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_7" />
                                <input type="hidden" value="<?php echo $parametre_flux[7]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_7_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Flux de trésorerie liés à l'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 2%;">Flux de trésorerie liés aux activités d'investissement</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Acquisitions d'immobilisations</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[8]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[8]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_8" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_8" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_8" value="<?php echo $parametre_flux[8]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(8)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(8)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[8]->getId()) echo $parametre_flux[8]->getPlandossiercomptable2(); ?>" id="compte_debut_3_8" onkeyup="chargerCompte('#compte_debut_3_8', '#hidden_compte_debut_3_8', '#compte_debut_3_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[8]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_8" />
                                <input type="hidden" value="<?php echo $parametre_flux[8]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_8_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[8]->getId()) echo $parametre_flux[8]->getPlandossiercomptable(); ?>" id="compte_fin_3_8" onkeyup="chargerCompte('#compte_fin_3_8', '#hidden_compte_fin_3_8', '#compte_fin_3_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[8]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_8" />
                                <input type="hidden" value="<?php echo $parametre_flux[8]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_8_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Cessions d'immobilisations</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[9]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[9]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_9" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_9" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_9" value="<?php echo $parametre_flux[9]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(9)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(9)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[19]->getId()) echo $parametre_flux[9]->getPlandossiercomptable2(); ?>" id="compte_debut_3_9" onkeyup="chargerCompte('#compte_debut_3_9', '#hidden_compte_debut_3_9', '#compte_debut_3_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[9]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_9" />
                                <input type="hidden" value="<?php echo $parametre_flux[9]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_9_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[9]->getId()) echo $parametre_flux[9]->getPlandossiercomptable(); ?>" id="compte_fin_3_9" onkeyup="chargerCompte('#compte_fin_3_9', '#hidden_compte_fin_3_9', '#compte_fin_3_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[9]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_9" />
                                <input type="hidden" value="<?php echo $parametre_flux[9]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_9_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Acquisitions d'immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[10]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[10]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_10" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_10" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_10" value="<?php echo $parametre_flux[10]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(10)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(10)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[10]->getId()) echo $parametre_flux[10]->getPlandossiercomptable2(); ?>" id="compte_debut_3_10" onkeyup="chargerCompte('#compte_debut_3_10', '#hidden_compte_debut_3_10', '#compte_debut_3_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[10]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_10" />
                                <input type="hidden" value="<?php echo $parametre_flux[10]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_10_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[10]->getId()) echo $parametre_flux[10]->getPlandossiercomptable(); ?>" id="compte_fin_3_10" onkeyup="chargerCompte('#compte_fin_3_10', '#hidden_compte_fin_3_10', '#compte_fin_3_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[10]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_10" />
                                <input type="hidden" value="<?php echo $parametre_flux[10]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_10_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Cessions d'immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[11]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[11]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_11" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_11" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_11" value="<?php echo $parametre_flux[11]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(11)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(11)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[11]->getId()) echo $parametre_flux[11]->getPlandossiercomptable2(); ?>" id="compte_debut_3_11" onkeyup="chargerCompte('#compte_debut_3_11', '#hidden_compte_debut_3_11', '#compte_debut_3_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[11]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_11" />
                                <input type="hidden" value="<?php echo $parametre_flux[11]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_11_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[11]->getId()) echo $parametre_flux[11]->getPlandossiercomptable(); ?>" id="compte_fin_3_11" onkeyup="chargerCompte('#compte_fin_3_11', '#hidden_compte_fin_3_11', '#compte_fin_3_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[11]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_11" />
                                <input type="hidden" value="<?php echo $parametre_flux[11]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_11_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Flux de trésorerie liés aux activités d'investissement</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 2%;">Flux de trésorerie liés aux activités de financement</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Encaissements suite à l'émission de parts sociales</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[12]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[12]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_12" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_12" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_12" value="<?php echo $parametre_flux[12]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(12)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(12)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[12]->getId()) echo $parametre_flux[12]->getPlandossiercomptable2(); ?>" id="compte_debut_3_12" onkeyup="chargerCompte('#compte_debut_3_12', '#hidden_compte_debut_3_12', '#compte_debut_3_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[12]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_12" />
                                <input type="hidden" value="<?php echo $parametre_flux[12]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_12_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[12]->getId()) echo $parametre_flux[12]->getPlandossiercomptable(); ?>" id="compte_fin_3_12" onkeyup="chargerCompte('#compte_fin_3_12', '#hidden_compte_fin_3_12', '#compte_fin_3_12_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[12]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_12" />
                                <input type="hidden" value="<?php echo $parametre_flux[12]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_12_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Distribution dividendes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[13]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[13]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_13" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_13" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_13" value="<?php echo $parametre_flux[13]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(13)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(13)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[13]->getId()) echo $parametre_flux[13]->getPlandossiercomptable2(); ?>" id="compte_debut_3_13" onkeyup="chargerCompte('#compte_debut_3_13', '#hidden_compte_debut_3_13', '#compte_debut_3_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[13]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_13" />
                                <input type="hidden" value="<?php echo $parametre_flux[13]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_13_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[13]->getId()) echo $parametre_flux[13]->getPlandossiercomptable(); ?>" id="compte_fin_3_13" onkeyup="chargerCompte('#compte_fin_3_13', '#hidden_compte_fin_3_13', '#compte_fin_3_13_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[13]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_13" />
                                <input type="hidden" value="<?php echo $parametre_flux[13]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_13_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Encaissements provenant des emprunts</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[14]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[14]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_14" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_14" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_14" value="<?php echo $parametre_flux[14]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(14)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(14)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[14]->getId()) echo $parametre_flux[14]->getPlandossiercomptable2(); ?>" id="compte_debut_3_14" onkeyup="chargerCompte('#compte_debut_3_14', '#hidden_compte_debut_3_14', '#compte_debut_3_14_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[14]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_14" />
                                <input type="hidden" value="<?php echo $parametre_flux[14]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_14_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[14]->getId()) echo $parametre_flux[14]->getPlandossiercomptable(); ?>" id="compte_fin_3_14" onkeyup="chargerCompte('#compte_fin_3_14', '#hidden_compte_fin_3_14', '#compte_fin_3_14_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[14]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_14" />
                                <input type="hidden" value="<?php echo $parametre_flux[14]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_14_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Remboursements d'emprunts</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[15]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[15]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_15" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_15" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_15" value="<?php echo $parametre_flux[15]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(15)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(15)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[15]->getId()) echo $parametre_flux[15]->getPlandossiercomptable2(); ?>" id="compte_debut_3_15" onkeyup="chargerCompte('#compte_debut_3_15', '#hidden_compte_debut_3_15', '#compte_debut_3_15_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[15]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_15" />
                                <input type="hidden" value="<?php echo $parametre_flux[15]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_15_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[15]->getId()) echo $parametre_flux[15]->getPlandossiercomptable(); ?>" id="compte_fin_3_15" onkeyup="chargerCompte('#compte_fin_3_15', '#hidden_compte_fin_3_15', '#compte_fin_3_15_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[15]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_15" />
                                <input type="hidden" value="<?php echo $parametre_flux[15]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_15_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">Flux de trésorerie liés aux activités de financement</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Incidence des variations des taux de change sur les</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[16]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[16]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_16" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_16" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_16" value="<?php echo $parametre_flux[16]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(16)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(16)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[16]->getId()) echo $parametre_flux[16]->getPlandossiercomptable2(); ?>" id="compte_debut_3_16" onkeyup="chargerCompte('#compte_debut_3_16', '#hidden_compte_debut_3_16', '#compte_debut_3_16_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[16]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_16" />
                                <input type="hidden" value="<?php echo $parametre_flux[16]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_16_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[16]->getId()) echo $parametre_flux[16]->getPlandossiercomptable(); ?>" id="compte_fin_3_16" onkeyup="chargerCompte('#compte_fin_3_16', '#hidden_compte_fin_3_16', '#compte_fin_3_16_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[16]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_16" />
                                <input type="hidden" value="<?php echo $parametre_flux[16]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_16_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">liquidités et équivalents de liquidités</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[17]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[17]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_17" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_17" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_17" value="<?php echo $parametre_flux[17]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(17)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(17)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[17]->getId()) echo $parametre_flux[17]->getPlandossiercomptable2(); ?>" id="compte_debut_3_17" onkeyup="chargerCompte('#compte_debut_3_17', '#hidden_compte_debut_3_17', '#compte_debut_3_17_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[17]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_17" />
                                <input type="hidden" value="<?php echo $parametre_flux[17]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_17_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[17]->getId()) echo $parametre_flux[17]->getPlandossiercomptable(); ?>" id="compte_fin_3_17" onkeyup="chargerCompte('#compte_fin_3_17', '#hidden_compte_fin_3_17', '#compte_fin_3_17_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[17]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_17" />
                                <input type="hidden" value="<?php echo $parametre_flux[17]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_17_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">Variation de trésorerie</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Trésorerie au début de l'exercice</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[18]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[18]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_18" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_18" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_18" value="<?php echo $parametre_flux[18]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(18)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(18)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[18]->getId()) echo $parametre_flux[18]->getPlandossiercomptable2(); ?>" id="compte_debut_3_18" onkeyup="chargerCompte('#compte_debut_3_18', '#hidden_compte_debut_3_18', '#compte_debut_3_18_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[18]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_18" />
                                <input type="hidden" value="<?php echo $parametre_flux[18]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_18_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[18]->getId()) echo $parametre_flux[18]->getPlandossiercomptable(); ?>" id="compte_fin_3_18" onkeyup="chargerCompte('#compte_fin_3_18', '#hidden_compte_fin_3_18', '#compte_fin_3_18_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[18]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_18" />
                                <input type="hidden" value="<?php echo $parametre_flux[18]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_18_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Trésorerie à la clôture de l'exercice</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_flux[19]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_flux[19]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_3_19" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_3">
                                <input id="compte_coche_3_19" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_3">
                                <input id="parametre_id_3_19" value="<?php echo $parametre_flux[19]->getId(); ?>" type="hidden">
                                <button title="Ajouter par Compte" onclick="gererOneCompte3(19)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte3(19)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[19]->getId()) echo $parametre_flux[19]->getPlandossiercomptable2(); ?>" id="compte_debut_3_19" onkeyup="chargerCompte('#compte_debut_3_19', '#hidden_compte_debut_3_19', '#compte_debut_3_19_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[19]->getIdComptedebut(); ?>" name="hidden_compte_debut_3" id="hidden_compte_debut_3_19" />
                                <input type="hidden" value="<?php echo $parametre_flux[19]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_3_19_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_flux[19]->getId()) echo $parametre_flux[19]->getPlandossiercomptable(); ?>" id="compte_fin_3_19" onkeyup="chargerCompte('#compte_fin_3_19', '#hidden_compte_fin_3_19', '#compte_fin_3_19_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_flux[19]->getIdComptefin(); ?>" name="hidden_compte_fin_3" id="hidden_compte_fin_3_19" />
                                <input type="hidden" value="<?php echo $parametre_flux[19]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_3_19_libelle" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="saveFlux()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreBilan?type=3') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function  gererCompte3(a) {
        if ($('#compte_debut_3_' + a + '_libelle').val() != '' && $('#compte_fin_3_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_3_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_3_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_3_' + a).val() +
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
                                                    getComptesDecocheFlux(a);
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

    function gererOneCompte3(a) {
        if ($('#compte_debut_3_' + a + '_libelle').val() != '' && $('#compte_fin_3_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererOneComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_3_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_3_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_3_' + a).val() +
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
                                                    getComptesDecocheFlux(a);
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

    function getComptesDecocheFlux(a) {
        var comptes_decoche = '';
        $('.list_checbox_compte[type=checkbox]:not(:checked)').each(function () {
            comptes_decoche += $(this).val() + ',';
        });
        $('#compte_decoche_3_' + a).val(comptes_decoche);
        var comptes_coche = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes_coche += $(this).val() + ',';
        });
        $('#compte_coche_3_' + a).val(comptes_coche);
    }

    function saveFlux() {
        var compte_debut = '';
        $('[name="hidden_compte_debut_3"]').each(function () {
            compte_debut = compte_debut + ';' + $(this).val();
        });

        var compte_fin = '';
        $('[name="hidden_compte_fin_3"]').each(function () {
            compte_fin = compte_fin + ';' + $(this).val();
        });

        var note = '';
        $('[name="note_3"]').each(function () {
            note = note + ';' + $(this).val();
        });

        var comptes_decoche = '';
        $('[name="compte_decoche_3"]').each(function () {
            comptes_decoche = comptes_decoche + ';' + $(this).val();
        });

        var comptes_coche = '';
        $('[name="compte_coche_3"]').each(function () {
            comptes_coche = comptes_coche + ';' + $(this).val();
        });

        var type = 3;
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/saveParametreBilan'); ?>',
            async: true,
            data: 'compte_debut=' + compte_debut +
                    '&compte_fin=' + compte_fin +
                    '&note=' + note +
                    '&type=' + type +
                    '&comptes_decoche=' + comptes_decoche +
                    '&comptes_coche=' + comptes_coche,
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
            }
        });
    }

</script>