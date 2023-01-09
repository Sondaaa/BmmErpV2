<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline">
                <legend>Paramétrage du Résultat
                    <button id="chargement_button_2" class="btn btn-xs btn-purple" style="float: right;" onclick="chargerPrecedent('2')"><i class="ace-icon fa fa-arrow-down"></i> Charger Paramétrage Précédent (<?php echo $_SESSION['exercice'] - 1; ?>)</button>
                    <span style="display: none;" id="chargement_info_2" class="label label-xlg label-purple arrowed-in-right arrowed pull-right">Paramétrage <?php echo $_SESSION['exercice'] - 1; ?> chargé</span>
                    <input type="hidden" id="allarray_regroupement_resultat">
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
                            <td style="padding-left: 2%;" colspan="4">PRODUITS D'EXPLOITATION</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Revenus</td>
                            <td style="text-align: center;">
                                <input value="5-1" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[0]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[0]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_0" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_0" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_0" value="<?php echo $parametre_resultat[0]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_2_0" value="<?php echo ''; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(0)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(0)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(0)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                5-1
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[0]->getId()) echo $parametre_resultat[0]->getPlandossiercomptable2(); ?>" id="compte_debut_2_0" onkeyup="chargerCompte('#compte_debut_2_0', '#hidden_compte_debut_2_0', '#compte_debut_2_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[0]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_0" />
                                <input type="hidden" value="<?php echo $parametre_resultat[0]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_0_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[0]->getId()) echo $parametre_resultat[0]->getPlandossiercomptable(); ?>" id="compte_fin_2_0" onkeyup="chargerCompte('#compte_fin_2_0', '#hidden_compte_fin_2_0', '#compte_fin_2_0_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[0]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_0" />
                                <input type="hidden" value="<?php echo $parametre_resultat[0]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_0_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres produits d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                 $regroupement = '';
                                if ($parametre_resultat[1]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[1]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_1" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_1" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_1" value="<?php echo $parametre_resultat[1]->getId(); ?>" type="hidden">
                                <input id="regroupement_id_2_1" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(1)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(1)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(1)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[1]->getId()) echo $parametre_resultat[1]->getPlandossiercomptable2(); ?>" id="compte_debut_2_1" onkeyup="chargerCompte('#compte_debut_2_1', '#hidden_compte_debut_2_1', '#compte_debut_2_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[1]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_1" />
                                <input type="hidden" value="<?php echo $parametre_resultat[1]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_1_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[1]->getId()) echo $parametre_resultat[1]->getPlandossiercomptable(); ?>" id="compte_fin_2_1" onkeyup="chargerCompte('#compte_fin_2_1', '#hidden_compte_fin_2_1', '#compte_fin_2_1_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[1]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_1" />
                                <input type="hidden" value="<?php echo $parametre_resultat[1]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_1_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;"> Production immobilisée </td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[2]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[2]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_2" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_2" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_2" value="<?php echo $parametre_resultat[2]->getId(); ?>" type="hidden">
                                   <input id="regroupement_id_2_2" value="<?php if(isset($regroupement)): echo $regroupement; endif;?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(2)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(2)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(2)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[2]->getId()) echo $parametre_resultat[2]->getPlandossiercomptable2(); ?>" id="compte_debut_2_2" onkeyup="chargerCompte('#compte_debut_2_2', '#hidden_compte_debut_2_2', '#compte_debut_2_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[2]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_2" />
                                <input type="hidden" value="<?php echo $parametre_resultat[2]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_2_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[2]->getId()) echo $parametre_resultat[2]->getPlandossiercomptable(); ?>" id="compte_fin_2_2" onkeyup="chargerCompte('#compte_fin_2_2', '#hidden_compte_fin_2_2', '#compte_fin_2_2_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[2]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_2" />
                                <input type="hidden" value="<?php echo $parametre_resultat[2]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_2_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 4%;">Total des produits d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 2%;" colspan="4">CHARGES D'EXPLOITATION</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Achats d'approvisionnements consommés</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[3]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[3]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_3" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_3" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_3" value="<?php echo $parametre_resultat[3]->getId(); ?>" type="hidden">
                                  <input id="regroupement_id_2_3" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(3)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(3)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(3)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>5-2
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[3]->getId()) echo $parametre_resultat[3]->getPlandossiercomptable2(); ?>" id="compte_debut_2_3" onkeyup="chargerCompte('#compte_debut_2_3', '#hidden_compte_debut_2_3', '#compte_debut_2_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[3]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_3" />
                                <input type="hidden" value="<?php echo $parametre_resultat[3]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_3_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[3]->getId()) echo $parametre_resultat[3]->getPlandossiercomptable(); ?>" id="compte_fin_2_3" onkeyup="chargerCompte('#compte_fin_2_3', '#hidden_compte_fin_2_3', '#compte_fin_2_3_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[3]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_3" />
                                <input type="hidden" value="<?php echo $parametre_resultat[3]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_3_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Charges de personnel</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[4]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[4]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_4" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_4" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_4" value="<?php echo $parametre_resultat[4]->getId(); ?>" type="hidden">
                                 <input id="regroupement_id_2_4" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(4)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(4)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(4)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>  5-3  
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[4]->getId()) echo $parametre_resultat[4]->getPlandossiercomptable2(); ?>" id="compte_debut_2_4" onkeyup="chargerCompte('#compte_debut_2_4', '#hidden_compte_debut_2_4', '#compte_debut_2_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[4]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_4" />
                                <input type="hidden" value="<?php echo $parametre_resultat[4]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_4_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[4]->getId()) echo $parametre_resultat[4]->getPlandossiercomptable(); ?>" id="compte_fin_2_4" onkeyup="chargerCompte('#compte_fin_2_4', '#hidden_compte_fin_2_4', '#compte_fin_2_4_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[4]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_4" />
                                <input type="hidden" value="<?php echo $parametre_resultat[4]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_4_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Dotation aux amortissements et aux provisions</td>
                            <td style="text-align: center;">
                                <input value="5-2" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[5]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[5]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_5" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_5" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_5" value="<?php echo $parametre_resultat[5]->getId(); ?>" type="hidden">
                                   <input id="regroupement_id_2_5" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(5)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(5)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(5)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                5-4
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[5]->getId()) echo $parametre_resultat[5]->getPlandossiercomptable2(); ?>" id="compte_debut_2_5" onkeyup="chargerCompte('#compte_debut_2_5', '#hidden_compte_debut_2_5', '#compte_debut_2_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[5]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_5" />
                                <input type="hidden" value="<?php echo $parametre_resultat[5]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_5_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[5]->getId()) echo $parametre_resultat[5]->getPlandossiercomptable(); ?>" id="compte_fin_2_5" onkeyup="chargerCompte('#compte_fin_2_5', '#hidden_compte_fin_2_5', '#compte_fin_2_5_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[5]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_5" />
                                <input type="hidden" value="<?php echo $parametre_resultat[5]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_5_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres charges d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="5-3" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[6]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[6]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_6" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_6" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_6" value="<?php echo $parametre_resultat[6]->getId(); ?>" type="hidden">
                                 <input id="regroupement_id_2_6" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(6)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(6)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(6)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                                <br>
                                5-3
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[6]->getId()) echo $parametre_resultat[6]->getPlandossiercomptable2(); ?>" id="compte_debut_2_6" onkeyup="chargerCompte('#compte_debut_2_6', '#hidden_compte_debut_2_6', '#compte_debut_2_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[6]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_6" />
                                <input type="hidden" value="<?php echo $parametre_resultat[6]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_6_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[6]->getId()) echo $parametre_resultat[6]->getPlandossiercomptable(); ?>" id="compte_fin_2_6" onkeyup="chargerCompte('#compte_fin_2_6', '#hidden_compte_fin_2_6', '#compte_fin_2_6_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[6]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_6" />
                                <input type="hidden" value="<?php echo $parametre_resultat[6]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_6_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 4%;">Total des charges d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Résultat d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>


                        <tr>
                            <td style="padding-left: 6%;">Charges financières nettes</td>
                            <td style="text-align: center;">
                                <input value="5-4" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[7]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[7]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_7" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_7" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_7" value="<?php echo $parametre_resultat[7]->getId(); ?>" type="hidden">
                                  <input id="regroupement_id_2_7" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(7)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(7)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(7)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>


                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[7]->getId()) echo $parametre_resultat[7]->getPlandossiercomptable2(); ?>" id="compte_debut_2_7" onkeyup="chargerCompte('#compte_debut_2_7', '#hidden_compte_debut_2_7', '#compte_debut_2_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[7]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_7" />
                                <input type="hidden" value="<?php echo $parametre_resultat[7]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_7_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[7]->getId()) echo $parametre_resultat[7]->getPlandossiercomptable(); ?>" id="compte_fin_2_7" onkeyup="chargerCompte('#compte_fin_2_7', '#hidden_compte_fin_2_7', '#compte_fin_2_7_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[7]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_7" />
                                <input type="hidden" value="<?php echo $parametre_resultat[7]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_7_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Produits des placements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[8]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[8]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_8" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_8" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_8" value="<?php echo $parametre_resultat[8]->getId(); ?>" type="hidden">
                                  <input id="regroupement_id_2_8" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(8)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(8)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(8)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[8]->getId()) echo $parametre_resultat[8]->getPlandossiercomptable2(); ?>" id="compte_debut_2_8" onkeyup="chargerCompte('#compte_debut_2_8', '#hidden_compte_debut_2_8', '#compte_debut_2_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[8]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_8" />
                                <input type="hidden" value="<?php echo $parametre_resultat[8]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_8_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[8]->getId()) echo $parametre_resultat[8]->getPlandossiercomptable(); ?>" id="compte_fin_2_8" onkeyup="chargerCompte('#compte_fin_2_8', '#hidden_compte_fin_2_8', '#compte_fin_2_8_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[8]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_8" />
                                <input type="hidden" value="<?php echo $parametre_resultat[8]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_8_libelle" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 6%;">Autres gains ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[9]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[9]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_9" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_9" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_9" value="<?php echo $parametre_resultat[9]->getId(); ?>" type="hidden">
                                 <input id="regroupement_id_2_9" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(9)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(9)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(9)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[9]->getId()) echo $parametre_resultat[9]->getPlandossiercomptable2(); ?>" id="compte_debut_2_9" onkeyup="chargerCompte('#compte_debut_2_9', '#hidden_compte_debut_2_9', '#compte_debut_2_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[9]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_9" />
                                <input type="hidden" value="<?php echo $parametre_resultat[9]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_9_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[9]->getId()) echo $parametre_resultat[9]->getPlandossiercomptable(); ?>" id="compte_fin_2_9" onkeyup="chargerCompte('#compte_fin_2_9', '#hidden_compte_fin_2_9', '#compte_fin_2_9_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[9]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_9" />
                                <input type="hidden" value="<?php echo $parametre_resultat[9]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_9_libelle" />
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Autres pertes ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[10]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[10]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_10" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_10" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_10" value="<?php echo $parametre_resultat[10]->getId(); ?>" type="hidden">
                                  <input id="regroupement_id_2_10" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(10)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(10)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(10)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[10]->getId()) echo $parametre_resultat[10]->getPlandossiercomptable2(); ?>" id="compte_debut_2_10" onkeyup="chargerCompte('#compte_debut_2_10', '#hidden_compte_debut_2_10', '#compte_debut_2_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[10]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_10" />
                                <input type="hidden" value="<?php echo $parametre_resultat[10]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_10_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[10]->getId()) echo $parametre_resultat[10]->getPlandossiercomptable(); ?>" id="compte_fin_2_10" onkeyup="chargerCompte('#compte_fin_2_10', '#hidden_compte_fin_2_10', '#compte_fin_2_10_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[10]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_10" />
                                <input type="hidden" value="<?php echo $parametre_resultat[10]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_10_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Résultat des activités ordinaires avant impôt</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 6%;">Impôt sur les bénéfices</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                                <?php
                                $compte_decoche = '';
                                $compte_coche = '';
                                if ($parametre_resultat[11]->getId() != ''):
                                    $params = ParametrebilancompteTable::getInstance()->findByIdParametrebilan($parametre_resultat[11]->getId());
                                    foreach ($params as $param_compte):
                                        if ($param_compte->getType() == 1)
                                            $compte_coche = $compte_coche . $param_compte->getIdCompte() . ',';
                                        else
                                            $compte_decoche = $compte_decoche . $param_compte->getIdCompte() . ',';
                                    endforeach;
                                endif;
                                ?>
                                <input id="compte_decoche_2_11" value="<?php echo $compte_decoche; ?>" type="hidden" name="compte_decoche_2">
                                <input id="compte_coche_2_11" value="<?php echo $compte_coche; ?>" type="hidden" name="compte_coche_2">
                                <input id="parametre_id_2_11" value="<?php echo $parametre_resultat[11]->getId(); ?>" type="hidden">
                                 <input id="regroupement_id_2_11" value="<?php echo $regroupement; ?>" type="hidden" name="compte_regroupe_2">

                                <button title="Ajouter par Compte" onclick="gererOneCompte2(11)" class="btn btn-xs btn-success"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Gèrer Tous les Comptes" onclick="gererCompte2(11)" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-file-text"></i></button>
                                <button title="Regroupper les Comptes" onclick="regrouperCompte2(11)" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-file-text"></i>R</button>

                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[11]->getId()) echo $parametre_resultat[11]->getPlandossiercomptable2(); ?>" id="compte_debut_2_11" onkeyup="chargerCompte('#compte_debut_2_11', '#hidden_compte_debut_2_11', '#compte_debut_2_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[11]->getIdComptedebut(); ?>" name="hidden_compte_debut_2" id="hidden_compte_debut_2_11" />
                                <input type="hidden" value="<?php echo $parametre_resultat[11]->getPlandossiercomptable2()->getNumerocompte(); ?>" id="compte_debut_2_11_libelle" />
                            </td>
                            <td>
                                <input type="text" value="<?php if ($parametre_resultat[11]->getId()) echo $parametre_resultat[11]->getPlandossiercomptable(); ?>" id="compte_fin_2_11" onkeyup="chargerCompte('#compte_fin_2_11', '#hidden_compte_fin_2_11', '#compte_fin_2_11_libelle')"/>
                                <input type="hidden" value="<?php echo $parametre_resultat[11]->getIdComptefin(); ?>" name="hidden_compte_fin_2" id="hidden_compte_fin_2_11" />
                                <input type="hidden" value="<?php echo $parametre_resultat[11]->getPlandossiercomptable()->getNumerocompte(); ?>" id="compte_fin_2_11_libelle" />
                            </td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;">Résultat des activités ordinaires après impôt</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr style="background-color: #F0F0F0;">
                            <td style="padding-left: 2%;" colspan="2">Résultat net de l'exercice</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                    </tbody>
                </table>

                <table style="margin-bottom: 0px;">
                    <tr>
                        <td>
                            <button class="btn btn-primary" style="float: right;" onclick="saveResultat()"><i class="ace-icon fa fa-save"></i> Enregistrer </button>
                            <a href="<?php echo url_for('fiche_Bilan/imprimerParametreBilan?type=2') ?>" target="_blank" class="btn btn-success"><i class="ace-icon fa fa-print"></i> Imprimer </a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">
 function regrouperCompte2(a) {
        if ($('#compte_debut_2_' + a + '_libelle').val() != '' && $('#compte_fin_2_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesRegroupementParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_2_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_2_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_2_' + a).val() +
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

    function  gererCompte2(a) {
        if ($('#compte_debut_2_' + a + '_libelle').val() != '' && $('#compte_fin_2_' + a + '_libelle').val() != '') {
            $.ajax({
                url: '<?php echo url_for('fiche_Bilan/gererComptesParametreBilan') ?>',
                data: 'compte_debut=' + $('#compte_debut_2_' + a + '_libelle').val() +
                        '&compte_fin=' + $('#compte_fin_2_' + a + '_libelle').val() +
                        '&parametre_id=' + $('#parametre_id_2_' + a).val() +
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

    function gererOneCompte2(a) {
         var compte_debut = '';
            var compte_fin = '';
            var parametre_id = '';
            var index = '';
           
        if ($('#compte_debut_2_' + a + '_libelle').val() != '' && $('#compte_fin_2_' + a + '_libelle').val() != '') {
             compte_debut = $('#compte_debut_2_' + a + '_libelle').val();
            compte_fin = $('#compte_fin_2_' + a + '_libelle').val();
            parametre_id = $('#parametre_id_2_' + a).val();
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
    

    function getComptesDecocheResultat(a) {
        var comptes_decoche = '';
        $('.list_checbox_compte[type=checkbox]:not(:checked)').each(function () {
            comptes_decoche += $(this).val() + ',';
        });
        $('#compte_decoche_2_' + a).val(comptes_decoche);
        var comptes_coche = '';
        $('.list_checbox_compte[type=checkbox]:checked').each(function () {
            comptes_coche += $(this).val() + ',';
        });
        $('#compte_coche_2_' + a).val(comptes_coche);
        
        var comptes_regrouppe = '';
        $('[name="regrouppement"]').each(function () {
            comptes_regrouppe += $(this).val() + ',';

        });
        $('#compte_coche_2_' + a).val(comptes_coche);
        $('#regroupement_id_2_' + a).val(comptes_regrouppe);
    }

    function saveResultat() {
        var compte_debut = '';
        $('[name="hidden_compte_debut_2"]').each(function () {
            compte_debut = compte_debut + ';' + $(this).val();
        });

        var compte_fin = '';
        $('[name="hidden_compte_fin_2"]').each(function () {
            compte_fin = compte_fin + ';' + $(this).val();
        });

        var note = '';
        $('[name="note_2"]').each(function () {
            note = note + ';' + $(this).val();
        });

        var comptes_decoche = '';
        $('[name="compte_decoche_2"]').each(function () {
            comptes_decoche = comptes_decoche + ';' + $(this).val();
        });

        var comptes_coche = '';
        $('[name="compte_coche_2"]').each(function () {
            comptes_coche = comptes_coche + ';' + $(this).val();
        });
         var compte_regroupe = '';

        $('[name="compte_regroupe_2"]').each(function () {
            compte_regroupe = compte_regroupe + ';' + $(this).val();
        });

        var type = 2;
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/saveParametreBilan'); ?>',
            async: true,
            data: 'compte_debut=' + compte_debut +
                    '&compte_fin=' + compte_fin +
                    '&note=' + note +
                    '&type=' + type +
                    '&comptes_decoche=' + comptes_decoche +
                    '&comptes_coche=' + comptes_coche+
                     '&compte_regroupe=' + compte_regroupe+
                    '&array_regr=' + $('#allarray_regroupement_resultat').val(),
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