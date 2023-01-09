<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête Maquette</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 10%">Code * :</td>
                                <td style="width: 30%;">Libellé * :</td>
                                <td style="width: 15%;">Nature Pièce * :</td>
                                <td style="width: 45%;">Journal Comptable * :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="code_maquette" value="<?php echo trim($maquette->getCode()); ?>" onkeydown="chargerlisteMaquette(event, false)" ondblclick="chargerlisteMaquette(event, true)">
                                    <input type="hidden" id="maquette_id" value="<?php echo $maquette->getId(); ?>">
                                </td>
                                <td>
                                    <input type="text" id="libelle" value="<?php echo trim($maquette->getLibelle()); ?>">
                                </td>
                                <td>
                                    <select id="nature_piece">
                                        <option value="-1"></option>
                                        <?php foreach ($nature_pieces as $nature_piece): ?>
                                            <option id="nature_<?php echo $nature_piece->getId(); ?>" libelle="<?php echo $nature_piece->getLibelle(); ?>" value="<?php echo $nature_piece->getId(); ?>" <?php if ($maquette->getNaturepiece()->getId() == $nature_piece->getId()) echo 'selected = "true"' ?>><?php echo trim($nature_piece->getLibelle()); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td class="disabledbutton">
                                    <select id="journal" onchange="affichersigne()">
                                        <option value="-1"></option>
                                        <?php foreach ($journals as $j): ?>
                                            <option id="journal_option_<?php echo $j->getId(); ?>" type_journal="<?php echo $j->getIdTypeJournal(); ?>" value="<?php echo $j->getId(); ?>" <?php if ($maquette->getJournalcomptable()->getId() == $j->getId()) echo 'selected = "true"' ?>><?php echo trim($j->getLibelle()); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Détails Maquette</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <div class="mws-panel-toolbar">
                            <div class="col-xs-12">
                                <div class="btn-group" style="width: 100%;">

                                    <a class="btn btn-primary" href="<?php echo url_for('maquette_saisie/index') ?>"><i class="ace-icon fa fa-undo"></i> Retour à la Liste</a>
                                    <a onclick="validerMaquette()" class="btn btn-success" style="float: left"><i class="ace-icon fa fa-save align-top bigger-110"></i> Valider Maquette</a>

                                    <a onclick="supprimerLigne()" class="btn btn-danger" style="float: right; padding: 4px 12px;"><i class="ace-icon fa fa-trash align-top bigger-110"></i> Supprimer Ligne</a>
                                    <a onclick="ajouterLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px;"><i class="ace-icon fa fa-arrow-left align-top bigger-110"></i> Inserer Ligne</a>
                                    <a onclick="ajouterLastLigne()" class="btn btn-primary" style="float: right; padding: 4px 12px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110"></i> Ajouter Ligne</a>
                                    <a onclick="equilibrer()" class="btn btn-success" style="float: right; padding: 4px 12px;margin-right: 2px"><i class="ace-icon fa fa-balance-scale align-top bigger-110"></i> Equilibrer</a>

                                </div>
                            </div>
                        </div>
                        <div class="mws-panel-body no-padding">
                            <table class="mws-table" id="liste_ligne" style="margin-bottom: 0px;">
                                <thead>
                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                        <th style="width: 3%;">N°</th>
                                        <th style="width: 35%;">Numéro du Compte</th>
                                        <th colspan="2">Montant</th>
                                        <th style="width: 35%;">Contre Partie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($maquette->getLignemaquette() as $ligne): ?>
                                        <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>">
                                            <td name="col_number" style="text-align:center"><?php echo $i ?></td>
                                            <td>
                                                <span style="font-weight: bold;">
                                                    <input type="checkbox" name="ck_compte_retenue" id="ck_compte_retenue_<?php echo $i ?>" <?php if ($ligne->getCompteretenue() == 1): ?>checked="checked"<?php endif; ?> onchange="showSpecificationCompte(<?php echo $i ?>)"/> Compte Comptable Contre Partie                                                  </span>
                                                <span style="margin-top: 5px; margin-right: 2%; float: right; font-weight: bold;">
                                                    <input type="checkbox" name="ck_compte_tiers" id="ck_compte_tiers_<?php echo $i ?>" <?php if ($ligne->getTiers() == 1): ?>checked="checked"<?php endif; ?> onchange="showSpecificationCompte(<?php echo $i ?>)"/> Compte Comptable du Tiers
                                                </span>
                                                <div class="mws-form-row" name="div_specification_compte" id="div_specification_compte_<?php echo $i ?>" style="<?php if ($ligne->getTiers() == 1 || $ligne->getCompteretenue() == 1): ?>display: none;<?php endif; ?>">
                                                    <select name="specification_compte" onchange="showCompte(<?php echo $i ?>)" id="specification_compte_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <option value="fixe" <?php if (trim($ligne->getSpecificationcompte()) == 'fixe') echo 'selected = "true"' ?>>Fixe</option>
                                                        <option value="modifiable" <?php if (trim($ligne->getSpecificationcompte()) == 'modifiable') echo 'selected = "true"' ?>>Modifiable</option>
                                                        <option value="sans" <?php if (trim($ligne->getSpecificationcompte()) == 'sans') echo 'selected = "true"' ?>>Sans Spécification</option>
                                                    </select>
                                                </div>
                                                <div class="mws-form-row" name="div_ligne_compte" id="div_ligne_compte_<?php echo $i ?>" style="margin-top: 5px; <?php if (trim($ligne->getSpecificationcompte()) == 'sans' || $ligne->getTiers() == 1 || $ligne->getCompteretenue() == 1): ?>display: none;<?php endif; ?>">
                                                    <select name="ligne_compte" id="ligne_compte_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <?php foreach ($comptes as $compte): ?>
                                                            <option value="<?php echo $compte->getId(); ?>"
                                                            <?php
                                                            if (trim($ligne->getPlancomptable()->getNumerocompte()) ==
                                                                    trim($compte->getNumerocompte()))
                                                                echo 'selected = "true"'
                                                                ?>>
                                                                        <?php echo trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle()); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="width: 12%;">
                                                <div class="mws-form-row" style="text-align: center;">
                                                    Type
                                                    <select  name="type_montant" id="type_montant_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <option value="credit" <?php if (trim($ligne->getType()) == 'credit') echo 'selected = "true"' ?>>Credit</option>
                                                        <option value="debit" <?php if (trim($ligne->getType()) == 'debit') echo 'selected = "true"' ?>>Debit</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="width: 15%;">
                                                <div class="mws-form-row" style="text-align: center;">
                                                    <span style="font-weight: bold;">
                                                        <input type="checkbox" name="ck_montant" id="ck_montant_<?php echo $i ?>" <?php if ($ligne->getObligatoiremontant() == 1): ?> checked="checked" <?php endif; ?>/> Obligatoire
                                                    </span>
                                                    <select onchange="showMontant(<?php echo $i ?>)" name="specification_montant" id="specification_montant_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <option value="saisimanuel" <?php if (trim($ligne->getSpecificationmontant()) == 'saisimanuel') echo 'selected = "true"' ?>>Saisi Mauelle</option>
                                                        <option value="fixe" <?php if (trim($ligne->getSpecificationmontant()) == 'fixe') echo 'selected = "true"' ?>>Fixe</option>
                                                        <option value="copie" <?php if (trim($ligne->getSpecificationmontant()) == 'copie') echo 'selected = "true"' ?>>Copie du Montant</option>
                                                        <option value="taux" <?php if (trim($ligne->getSpecificationmontant()) == 'taux') echo 'selected = "true"' ?>>Montant * Taux</option>
                                                    </select>
                                                </div>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'saisimanuel'): ?>
                                                    <div name="div_montant_saisi" id="div_montant_saisi_<?php echo $i ?>" class="mws-form-row" style="text-align: center;">
                                                        <!--                                                        <label class="mws-form-label">Montant Saisi :</label>     
                                                                                                                <input type="text" id="montant_ligne_saisi_<?php // echo $i                  ?>" class="align_right" name="montant_ligne_saisi" value="<?php // echo $ligne->getMontant();                  ?>">-->
                                                    </div>
                                                    <div name="div_montant" id="div_montant_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none" >
                                                        <label class="mws-form-label"> Montant :</label>
                                                        <input type="text" id="montant_ligne_<?php echo $i ?>" class="align_right" name="montant_ligne" value="<?php echo $ligne->getMontant(); ?>">
                                                    </div>
                                                    <div name="div_numero" id="div_numero_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label">Numéro Colonne :</label>
                                                        <input type="text" id="numero_ligne_<?php echo $i ?>" name="numero_ligne" value="">
                                                    </div>
                                                    <div name="div_taux" id="div_taux_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label">Taux :</label>
                                                        <input type="text" id="taux_<?php echo $i ?>" name="taux" value="">
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (trim($ligne->getSpecificationmontant()) == 'fixe'): ?>
                                                    <div name="div_montant" id="div_montant_<?php echo $i ?>" class="mws-form-row" style="text-align: center;">
                                                        <label class="mws-form-label"> Montant :</label>
                                                        <input type="text" id="montant_ligne_<?php echo $i ?>" class="align_right" name="montant_ligne" value="<?php echo $ligne->getMontant(); ?>">
                                                    </div>
                                                    <div name="div_numero" id="div_numero_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label">Numéro Colonne :</label>
                                                        <input type="text" id="numero_ligne_<?php echo $i ?>" name="numero_ligne" value="">
                                                    </div>
                                                    <div name="div_taux" id="div_taux_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label">Taux :</label>
                                                        <input type="text" id="taux_<?php echo $i ?>" name="taux" value="">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'copie'): ?>
                                                    <div name="div_montant_saisi" id="div_montant_saisi_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none">
                                                        <!--                                                        <label class="mws-form-label">Montant Saisi :</label>     
                                                                                                                <input type="text" id="montant_ligne_saisi_<?php // echo $i                  ?>" class="align_right" name="montant_ligne_saisi" value="<?php // echo $ligne->getMontant();                  ?>">-->
                                                    </div>
                                                    <div name="div_montant" id="div_montant_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label"> Montant :</label>
                                                        <input type="text" id="montant_ligne_<?php echo $i ?>" class="align_right" name="montant_ligne" value="">
                                                    </div>
                                                    <div name="div_numero" id="div_numero_<?php echo $i ?>" class="mws-form-row" style="text-align: center;">
                                                        <label class="mws-form-label">Numéro Colonne :</label>
                                                        <input type="text" id="numero_ligne_<?php echo $i ?>" name="numero_ligne" value="<?php echo $ligne->getNumerolignemontant(); ?>">
                                                    </div>
                                                    <div name="div_taux" id="div_taux_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label">Taux :</label>
                                                        <input type="text" id="taux_<?php echo $i ?>" name="taux" value="">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'taux'): ?>
                                                    <div name="div_montant_saisi" id="div_montant_saisi_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none">
                                                        <!--                                                        <label class="mws-form-label">Montant Saisi :</label>     
                                                                                                                <input type="text" id="montant_ligne_saisi_<?php // echo $i                  ?>" class="align_right" name="montant_ligne_saisi" value="<?php // echo $ligne->getMontant();                  ?>">-->
                                                    </div>
                                                    <div name="div_montant" id="div_montant_<?php echo $i ?>" class="mws-form-row" style="text-align: center; display: none;">
                                                        <label class="mws-form-label"> Montant :</label>
                                                        <input type="text" id="montant_ligne_<?php echo $i ?>" class="align_right" name="montant_ligne" value="">
                                                    </div>
                                                    <div name="div_numero" id="div_numero_<?php echo $i ?>" class="mws-form-row" style="text-align: center;">
                                                        <label class="mws-form-label">Numéro Colonne :</label>
                                                        <input type="text" id="numero_ligne_<?php echo $i ?>" name="numero_ligne" <?php echo $ligne->getNumerolignemontant(); ?>>
                                                    </div>
                                                    <div name="div_taux" id="div_taux_<?php echo $i ?>" class="mws-form-row" style="text-align: center;">
                                                        <label class="mws-form-label">Taux :</label>
                                                        <input type="text" id="taux_<?php echo $i ?>" name="taux" value="<?php echo $ligne->getTaux(); ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span style="float: left; font-weight: bold;">
                                                    <input type="checkbox" name="ck_contre" id="ck_contre_<?php echo $i ?>" <?php if ($ligne->getObligatoirecontre() == 1): ?> checked="checked" <?php endif; ?>/> Obligatoire
                                                </span>
                                                <div class="mws-form-row" name="div_specification_compte_retenue" id="div_specification_compte_retenue_0">

                                                    <select onchange="showContre('<?php echo $i ?>')" name="specification_contre" id="specification_contre_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <option value="fixe" <?php if (trim($ligne->getSpecificationcontre()) == 'fixe') echo 'selected = "true"' ?>>Fixe</option>
                                                        <option value="modifiable" <?php if (trim($ligne->getSpecificationcontre()) == 'modifiable') echo 'selected = "true"' ?>>Modifiable</option>
                                                        <option value="sans" <?php if (trim($ligne->getSpecificationcontre()) == 'sans') echo 'selected = "true"' ?>>Sans Spécification</option>
                                                    </select>
                                                </div>
                                                <div class="mws-form-row" name="div_ligne_contre" id="div_ligne_contre_<?php echo $i ?>" style="margin-top: 5px;<?php if (trim($ligne->getSpecificationcontre()) == 'sans' || $ligne->getCompteretenue() == 1): ?>display: none;<?php endif; ?>">
                                                    <select name="ligne_contre" id="ligne_contre_<?php echo $i ?>">
                                                        <option value="-1"></option>
                                                        <?php
                                                        if ($ligne->getIdContrepartie() != '' && $ligne->getIdComptecomptable() != null) {
                                                            foreach ($comptes as $compte):
                                                                ?>
                                                                <option value="<?php echo $compte->getId(); ?>" 
                                                                <?php
                                                                $contrepartie = PlancomptableTable::getInstance()->findOneById($ligne->getIdContrepartie());
                                                                $numero_contrepartie = $contrepartie->getNumerocompte();
                                                                $libelle_contrepartie = $contrepartie->getPlandossiercomptable()->getLast()->getLibelle();
                                                                if (trim($numero_contrepartie) == trim($compte->getNumerocompte()))
                                                                    echo 'selected = "true"';
                                                                ?>>
                                                                    <?php echo trim($numero_contrepartie) . ' - ' . $libelle_contrepartie; ?></option>

                                                            <?php
                                                            endforeach;
                                                        }else {
                                                        ?>
                                                        <?php 
                                                       foreach ($comptes as $compte):?>
                                                          <option value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle(); ?></option>
                                                        <?php
                                                        endforeach;
                                                        }
                                                        ?>

                                                        

                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
    <?php $i++; ?>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="row" ><!--ng-controller="myCtrlPaysVille"-->
            <div class="col-xs-12" id="signe_achat" style="display: none">
                <div class="widget-main col-xs-8">
                    <span class="text-primary">. <u> ° Copie Montant &  Montant * Taux :<br>
                            - Numéro Colonne: N° Colonne dans l'excel (1 2 3)</br>
                            - 1° le M.H.TAX + D.Timbre  </br> - 2° le M.TVA </br> - 3° le M.TTC
                        </u></span>
                </div>
            </div>
            <div class="col-xs-12" id="signe_vente" style="display: none">
                <div class="widget-main col-xs-8">
                    <span class="text-primary">. <u> ° Copie Montant &  Montant * Taux :<br>
                            - Numéro Colonne: N° Colonne dans l'excel (1 2 3 4 5)</br>
                            - 1° le M.H.TAXE </br> - 2° le M.Fodec </br>     - 3° le M.HTVA </br> - 4° le M.TVA </br> - 5° le Timbre</br>
                            - 6° le M.TTC
                        </u></span>
                </div>
            </div>
            <div  class="col-xs-12" id="signe_od" style="display: none">
                <div class="widget-main col-xs-8">
                    <span class="text-primary">. <u> ° Copie Montant &  Montant * Taux :<br>
                            - Numéro Colonne: N° Colonne dans l'excel ( 3)</br>
                            - 3° Retenue
                        </u></span>

                </div>
            </div>
            <div  class="col-xs-12" id="signe_banque" style="display: none">
                <div class="widget-main col-xs-8">
                    <span class="text-primary">.<u> ° Copie Montant &  Montant * Taux :<br>
                            - Numéro Colonne: N° Colonne dans l'excel (1 2 3)</br>
                            - 1° le M.HT </br> - 2° le M.TVA </br> 
                            - 3° le M.TTC
                        </u></span>

                </div>
            </div>
        </div>
    </div>
</div>


<div id="my-modalListeMaquette" class="modal body" tabindex="1" > 
    <?php
    include_partial('maquette_saisie/listeMaquette', array());
    ?>
</div>
<script  type="text/javascript">

    var index_ligne = 0;
    function fermer() {
        $('#show_edit_maquette').fadeOut();
        $('#form_liste_piece').fadeIn();
    }

    function formatLigne(index) {
        $('#liste_ligne tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
    }

    function ajouterLigne() {
        if ($('#journal').val() != '-1') {
            $('#journal_chosen').css('border', '');
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function () {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('maquette_saisie/addLigne') ?>',
                async: true,
                data: 'journal_id=' + $('#journal').val(),
                success: function (data) {
                    if (count_ligne > 0) {
                        index_ligne--;
                        $('#liste_ligne > tbody > tr').eq(index_ligne).before(data);
                        index_ligne++;
                        index_ligne++;
                    } else {
                        $('#liste_ligne tbody').append(data);
                        index_ligne = 0;
                    }
                    ligneNumber();
                }
            });
        } else {
            $('#journal_chosen').css('border', '3px solid red');
            $('#journal_chosen').css('border-radius', '6px');
        }
    }

    function ajouterLastLigne() {
        if ($('#journal').val() != '-1') {
            $('#journal_chosen').css('border', '');
            $.ajax({
                url: '<?php echo url_for('maquette_saisie/addLigne') ?>',
                async: true,
                data: 'journal_id=' + $('#journal').val(),
                success: function (data) {
                    $('#liste_ligne tbody').append(data);
                    ligneNumber();
                }
            });
        } else {
            $('#journal_chosen').css('border', '3px solid red');
            $('#journal_chosen').css('border-radius', '6px');
        }
    }

    function supprimerLigne() {
        $('#ligne_' + index_ligne).remove();
        ligneNumber();
    }

    function showCompte(i) {
        if ($('#specification_compte_' + i).val() == 'fixe' || $('#specification_compte_' + i).val() == 'modifiable')
            $('#div_ligne_compte_' + i).fadeIn();
        else
            $('#div_ligne_compte_' + i).fadeOut();
    }

    function showSpecificationCompte(i) {

        if ($('#ck_compte_tiers_' + i).is(':checked') || $('#ck_compte_retenue_' + i).is(':checked')) {
            $('#div_specification_compte_retenue_' + i).fadeOut();
            $('#div_specification_compte_' + i).fadeOut();
            $('#div_ligne_compte_' + i).fadeOut();
        } else {
            $('#div_specification_compte_' + i).fadeIn();
            $('.chosen-container').attr("style", "width: 100%;");
            $('.chosen-container').trigger("chosen:updated");
            showCompte(i);
        }
    }
    function showSpecificationCompteretenue(i) {
        if ($('#ck_compte_retenue_' + i).is(':checked')) {
            $('#div_specification_compte_retenue_' + i).fadeOut();
            $('#div_specification_compte_' + i).fadeOut();
            $('#div_ligne_compte_' + i).fadeOut();
        } else {
//            $('#div_specification_compte_retenue_' + i).fadeIn();
            $('#div_specification_compte_' + i).fadeOut();
            $('.chosen-container').attr("style", "width: 100%;");
            $('.chosen-container').trigger("chosen:updated");
            showCompteRetenue(i);
        }
    }
    function showCompteRetenue(i) {
        if ($('#specification_compte_retenue' + i).val() == 'fixe' || $('#specification_compte_retenue' + i).val() == 'modifiable')
            $('#div_ligne_compte_' + i).fadeIn();
        else
            $('#div_ligne_compte_' + i).fadeOut();

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }
    function showMontant(i) {
        if ($('#specification_montant_' + i).val() == 'fixe') {
            $('#div_montant_' + i).fadeIn();
            $('#div_numero_' + i).fadeOut();
            $('#div_taux_' + i).fadeOut();
            $('#div_montant_saisi_' + i).fadeOut();
        }
        else if ($('#specification_montant_' + i).val() == 'copie') {
            $('#div_montant_' + i).fadeOut();
            $('#div_numero_' + i).fadeIn();
            $('#div_taux_' + i).fadeOut();
            $('#div_montant_saisi_' + i).fadeOut();
        }
        else if ($('#specification_montant_' + i).val() == 'taux') {
            $('#div_montant_' + i).fadeOut();
            $('#div_numero_' + i).fadeIn();
            $('#div_taux_' + i).fadeIn();
            $('#div_montant_saisi_' + i).fadeOut();
        }
        else if ($('#specification_montant_' + i).val() == 'saisimanuel') {
//            $('#div_montant_saisi_' + i).fadeIn();
            $('#div_montant_' + i).fadeOut();
            $('#div_numero_' + i).fadeOut();
            $('#div_taux_' + i).fadeOut();
        }
    }
    function equilibrer() {

        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        console.log('nb ligne =' + count_ligne);
        if (count_ligne > 0) {
            calculeTotal();
            if (parseFloat($('#total_solde').val()) > 0) {
                var credit = parseFloat($('#total_solde').val());
                var debit = '';
            } else {
                var credit = '';
                var debit = parseFloat($('#total_solde').val());
            }

            $.ajax({
                url: '<?php echo url_for('@addLigneMaquette') ?>',
                async: true,
                data: 'journal_id=' + $('#journal').val() +
                        '&credit=' + credit +
                        '&debit=' + debit +
                        '&typeop=' + $('#type_montant_' + count_ligne).val() +
                        '&typespec=' + $('#specification_montant_' + count_ligne).val() +
                        '&montant_ligne_saisi=' + $('#montant_ligne_saisi_' + count_ligne).val() +
                        '&montant_ligne=' + $('#montant_ligne_' + count_ligne).val() +
                        '&numero_ligne=' + $('#numero_ligne_' + count_ligne).val() +
                        '&taux=' + $('#taux_' + count_ligne).val() +
                        '&total=' + $('#total_solde').val()

                ,
                success: function (data) {
                    $('#liste_ligne tbody').append(data);
                    ligneNumber();
//                    $('#z_journal').val($('#journal_option_' + $('#journal').val()).text());
////                        $('#journal_chosen').fadeOut();
////                        $('#z_journal').fadeIn();
                }
            });
        }
    }
    function calculeTotal() {
        var total_credit = 0;
        var total_debit = 0;
        var total_solde = 0;
        $('[name="montant_ligne"]').each(function () {
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
            var selected = $('#type_montant_' + index_tr).val();
            if (selected == 'credit') {
                var credit = $(this).val();
                console.log('creadit=' + credit);
                credit = eval(credit.replace(/,/g, '.'));
                credit = Math.abs(credit);
                if (isNaN(credit))
                    credit = 0;
                if (credit != '' && credit != 0) {
                    total_credit = parseFloat(total_credit) + parseFloat(credit);
                    $(this).val(parseFloat(credit).toFixed(3));
                } else {

                    $(this).val('');
                }

            }
            if (selected == 'debit') {
                var debit = $(this).val();
                console.log('debit=' + debit);
                debit = eval(debit.replace(/,/g, '.'));
                debit = Math.abs(debit);
                if (isNaN(debit))
                    debit = 0;
                var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
                index_tr++;
                if (debit != '' && debit != 0) {
                    total_debit = parseFloat(total_debit) + parseFloat(debit);
                    $(this).val(parseFloat(debit).toFixed(3));
                } else {

                    $(this).val('');
                }
            }

        });
        total_solde = parseFloat(total_debit) - parseFloat(total_credit);
        $('#total_solde').val(total_solde);
        console.log('total=' + total_solde);
    }

    function showContre(i) {
        if ($('#specification_contre_' + i).val() == 'fixe' || $('#specification_contre_' + i).val() == 'modifiable')
            $('#div_ligne_contre_' + i).fadeIn();
        else
            $('#div_ligne_contre_' + i).fadeOut();
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }

    function ligneNumber() {
        var i = 1;
        $('#liste_ligne tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function () {
            $(this).text(i);
            i++;
        });
        var i = 1;
        $('[name="ck_compte"]').each(function () {
            var id = 'ck_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ck_compte_tiers"]').each(function () {
            var id = 'ck_compte_tiers_' + i;
            $(this).attr('id', id);
            var format = 'showSpecificationCompte("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="ck_compte_retenue"]').each(function () {
            var id = 'ck_compte_retenue_' + i;
            $(this).attr('id', id);
            var format = 'showSpecificationCompteretenue("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="div_specification_compte"]').each(function () {
            var id = 'div_specification_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_compte"]').each(function () {
            var id = 'specification_compte_' + i;
            $(this).attr('id', id);
            var format = 'showCompte("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="div_ligne_compte"]').each(function () {
            var id = 'div_ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_compte"]').each(function () {
            var id = 'ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ck_montant"]').each(function () {
            var id = 'ck_montant_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_montant"]').each(function () {
            var id = 'specification_montant_' + i;
            $(this).attr('id', id);
            var format = 'showMontant("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="type_montant"]').each(function () {
            var id = 'type_montant_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_montant"]').each(function () {
            var id = 'div_montant_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_numero"]').each(function () {
            var id = 'div_numero_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="div_taux"]').each(function () {
            var id = 'div_taux_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="montant_ligne"]').each(function () {
            var id = 'montant_ligne_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="numero_ligne"]').each(function () {
            var id = 'numero_ligne_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="taux"]').each(function () {
            var id = 'taux_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ck_contre"]').each(function () {
            var id = 'ck_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="specification_contre"]').each(function () {
            var id = 'specification_contre_' + i;
            $(this).attr('id', id);
            var format = 'showContre("' + i + '")';
            $(this).attr('onchange', format);
            i++;
        });
        var i = 1;
        $('[name="div_ligne_contre"]').each(function () {
            var id = 'div_ligne_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_contre"]').each(function () {
            var id = 'ligne_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        calculeTotal();
    }
    function chargerlisteMaquette(e, dbclick)
    {
        if (e.keyCode == true)
        {
            var key = e.keyCode;
        } else
        {
            var key = e.which;
        }
        if (key == 112 || dbclick) {
            $('#my-modalListeMaquette').addClass('in');
            $('#my-modalListeMaquette').css('display', 'block');
        }
    }
    affichersigne();
    function affichersigne() {
        if ($('#journal').val() != '') {
            $.ajax({
                url: '<?php echo url_for('maquette_saisie/affichetypejournal') ?>',
                async: true,
                data: 'journal_id=' + $('#journal').val(),
                dataType: "json",
                success: function (data) {
                    console.log(data[0].id_journal + '***');
                    $('#type_journal').val(data[0].id_journal);
                    affichesignification();
//                    alert($('#type_journal').val());
                }
            });
        }
    }
    function affichesignification() {
        if ($('#type_journal').val() != '') {

            if ($('#type_journal').val() == '1') {

                $('#signe_vente').fadeIn();
                $('#signe_achat').fadeOut();
            }
            if ($('#type_journal').val() == '2') {

                $('#signe_achat').fadeIn();
                $('#signe_vente').fadeOut();
            }
            if ($('#type_journal').val() == '5') {

                $('#signe_od').fadeIn();
            }

            if ($('#type_journal').val() == '3') {


                $('#signe_banque').fadeIn();
            }
        }
    }

</script>