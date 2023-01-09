<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête et date de la Pièce comptable</h4>

                <a title="Charger pièce comptable suivante" data-rel="tooltip" onclick="chargerSuivante()" class="btn btn-success" style="float: right; padding: 7px 12px; padding-top: 0px;"><i class="ace-icon fa fa-arrow-right align-top bigger-110" style="margin-right: 0px; margin-top: 5px;"></i></a>
                <a title="Charger pièce comptable précédente" data-rel="tooltip" onclick="chargerPrecedente()" class="btn btn-success" style="float: right; padding: 7px 12px; padding-top: 0px; margin-right: 5px;"><i class="ace-icon fa fa-arrow-left align-top bigger-110" style="margin-right: 0px; margin-top: 5px;"></i></a>
            </div>
            <?php $data_contre = ''; ?>
            <div class="widget-body" ng-controller="myCtrlCompteComptable" <?php if ($_SESSION['dossier_id'] == 1) : ?> ng-init="InitisilerNaturepiece()" <?php endif; ?>>
                <div class="widget-main">
                    <form>
                        <table style="width: 100%; margin-bottom: 0px;">
                            <tr>
                                <td style="width: 15%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Journal * :</label>
                                        </div>
                                    </div>
                                </td>


                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Date * :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Série * :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Numéro * :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 95%; display: none;" id="td_label_attendu">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Attendu :</label>
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 13%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%">Type Pièce :</label>
                                    </div>
                                </td>
                                <td style="width: 11%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%">N° Externe:</label>
                                    </div>
                                </td>
                                <td style="width: 11%;display: none">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%">Référence:</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mws-form-row">
                                        <?php
                                        if ($id_journal != '')
                                            $journal = JournalcomptableTable::getInstance()->find($id_journal);
                                        ?>
                                        <input type="hidden" id="journal_id" value="<?php
                                                                                    if ($id_journal != '') : echo $id_journal;
                                                                                    endif;
                                                                                    ?>">
                                        <input type="hidden" id="libelle_type_journal" value="">
                                        <input class="form-control" ng-model="journal_option.text" id="journal_option" placeholder="Journal comptable" value="<?php
                                                                                                                                                                if ($id_journal != '') : echo trim($journal->getCode()) . ' - ' . trim($journal->getLibelle());
                                                                                                                                                                endif;
                                                                                                                                                                ?>" type="text" ng-change="Choisirjournalcomptable('#journal_option', '#journal_id')" onclick="afficher()" />
                                        <!--</select onfocus="chargerJournal('#journal_option', '#journal_id' ,'#z_journal')" >-->
                                        <?php // endforeach;    
                                        ?>
                                        <input class="display_none" id="z_journal" value="<?php // if ($j) echo $j->getLibelle();                  
                                                                                            ?>" type="text" disabled="disabled">
                                        <input class="display_none" id="journal_contre_id" value="<?php // echo $data_contre;                  
                                                                                                    ?>" type="text" disabled="disabled">
                                    </div>
                                </td>
                                <td>
                                    <input id="date" type="date" onchange="getSerie()" value="<?php echo $date; ?>">
                                </td>
                                <td>
                                    <input type="text" id="serie" readonly="readonly" value="<?php echo $serie; ?>">
                                    <input id="serie_id" type="hidden" readonly="readonly" value="<?php echo $id_serie; ?>">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $numero; ?>" id="numero" readonly="readonly" onchange="chargerPiece()" onkeypress="upDownNumero(event)" onblur="validerNumero()">
                                </td>
                                <td style="width: 95%; display: none;" id="td_attendu">
                                    <input type="text" id="attendu" readonly="readonly">
                                </td>

                                <td>
                                    <!--                                    <select id="nature_piece_comp" onchange="getLibelleNature()">onchange="getLibelleNature()"
                                        <option value=""></option>
                                    <?php // foreach ($nature_pieces as $nature_piece): 
                                    ?>
                                            <option
                                    <?php // if ($id_nature_pieces == $nature_piece->getId()): 
                                    ?>
                                                    selected = "true" 
                                    <?php // endif; 
                                    ?>

                                                id="nature_<?php // echo $nature_piece->getId();      
                                                            ?>" 
                                                libelle="<?php // echo $nature_piece->getLibelle();      
                                                            ?>" 
                                                value="<?php // if ($nature_piece->getId() != '') {      
                                                        ?>
                                    <?php
                                    //                                                    echo $nature_piece->getId();
                                    //                                                } else
                                    ?>
                                    <?php
                                    // {
                                    //                                    echo $nature_pardefaut->getId();
                                    //                                    }
                                    ?>">

                                    <?php
                                    //                                                if ($nature_piece->getId() != '') {
                                    //                                                    echo $nature_piece->getLibelle();
                                    //                                                } else {
                                    //                                                    echo $nature_pardefaut->getLibelle();
                                    //                                                }
                                    ?>
                                            </option>
                                    <?php // endforeach; 
                                    ?>
                                    </select>-->
                                    <?php
                                    if ($id_nature_pieces != '')
                                        $nature = NaturepieceTable::getInstance()->find($id_nature_pieces);
                                    else
                                        $nature_pardefaut = NaturepieceTable::getInstance()->findOneById(7);
                                    ?>
                                    <input type="hidden" id="nature_piece" value="<?php
                                                                                    if ($id_nature_pieces != '') : echo $id_nature_pieces;
                                                                                    else : echo 7;
                                                                                    endif;
                                                                                    ?>">
                                    <input ng-model="nature_piece_option.text" id="nature_piece_option" value="<?php
                                                                                                                if ($id_nature_pieces != '') :
                                                                                                                    echo $nature->getLibelle();
                                                                                                                else :
                                                                                                                    echo trim($nature_pardefaut->getLibelle());
                                                                                                                endif;
                                                                                                                ?>" type="text" ng-change="Choisirnaturepiece('#nature_piece_option', '#nature_piece')" />
                                    <input class="display_none" id="z_nature_piece" value="7" type="text" disabled="disabled">
                                </td>

                                <td>
                                    <input id="numero_externe" type="text" value="<?php echo $num_externe; ?>">
                                </td>
                                <td style="display: none">
                                    <input onchange="getPieceForLigne()" id="reference" type="text" value="<?php echo $reference; ?>">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="show_maquette" style="display: none;">
</div>
<div id="details_document" style="display: none;">

</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 style="cursor:pointer;" data-toggle="collapse" data-target="#maquette_show" aria-expanded="false" aria-controls="maquette_show" class="widget-title smaller">
                    Choisir une maquette de Saisie !!!
                </h4>
            </div>
            <div id="maquette_show" class="collapse">
                <table id="listMaquette">
                    <thead>
                        <tr id="list_tri" style="border-bottom: 1px solid #000000">
                            <th><input type="checkbox" class="form_control" disabled=""></th>
                            <th id="tri_code" class="sorting" name="tri" onclick="tri('code')" style="width: 10%; text-align: center;">Code</th>
                            <th id="tri_libelle" class="sorting" name="tri" onclick="tri('libelle')" style="width: 20%;">Libellé</th>
                            <th id="tri_journal" class="sorting" name="tri" onclick="tri('journal')">Journal Comptable</th>
                            <th id="tri_nature" class="sorting" name="tri" onclick="tri('nature')" style="width: 10%; text-align: center;">Nature Pièce</th>
                            <th style="width: 10%; text-align: center;">Date Création</th>
                            <th id="tri_user" class="sorting" name="tri" onclick="tri('user')" style="width: 15%; text-align: center;">Utilisateur</th>
                            <th style="width: 10%; text-align: center;">Opérations</th>
                        </tr>
                        <tr>
                            <th><input type="checkbox" class="form_control" disabled=""></th>
                            <th><input type="text" id="code" onkeyup="goPage(1);" class="align_center" /></th>
                            <th><input type="text" id="libelle" onkeyup="goPage(1);" /></th>
                            <th>
                                <!--<input id="journal" onkeyup="goPage(1);" type="text"/>-->
                            </th>
                            <th><input type="text" id="nature" onkeyup="goPage(1);" class="align_center" /></th>
                            <th></th>
                            <th></th>
                            <th style="text-align: center;">
                                <a class="btn btn-xs btn-primary" style="cursor: pointer; padding: 6px 10px;" title="Réinitialiser" onclick="initform()"><i class="ace-icon fa fa-refresh"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tfoot id="listMaquette_footer">
                    </tfoot>
                    <tbody>
                        <?php // include_partial('maquette_saisie/liste_maquette_filter', array('maquettes' => $maquettes, "pager" => $pager, "page" => $page)) 
                        ?>
                    </tbody>
                </table>
                <input type="hidden" id="id_maquette" value="">
                <input type="hidden" id="type_tri" value="">
                <input type="hidden" id="tri" value="">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" style="min-height: 300px;">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Détails Pièce comptable :</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <form>
                        <table>
                            <tr>
                                <td style="width: 40%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%">Libellé * :</label>
                                    </div>
                                </td>
                                <td style="width: 20%" colspan="2">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%;color: #0069d6;font-size: 17px">Ancien Solde:</label>
                                    </div>
                                </td>
                                <td style="width: 20%" colspan="2">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%;color: #0069d6;font-size: 17px">Nouveau Solde:</label>
                                    </div>
                                </td>
                                <td style="width: 20%" colspan="2">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label" style="width: 100%;color: #0069d6;font-size: 17px">Compte Comptable:</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%">
                                    <div class="mws-form-row">
                                        <input id="libelle_piece" class="large" type="text" placeholder="Libellé pièce comptable" onchange="addFirstLigne()" value="<?php echo $libelle; ?>" onkeydown="chargerLigne(event, false)">
                                        <input id="detail_piece_id" value="" type="hidden" readonly="readonly">
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <label> Débit</label>
                                    <input id="solde_debit_ancien_hidden" class="text_align_right" type="hidden" placeholder="Ancien Solde Débit " readonly="readonly" style="text-align: right">

                                    <input id="solde_debit_ancien" class="text_align_right" type="text" placeholder="Ancien Solde Débit " readonly="readonly" style="text-align: right">
                                </td>
                                <td style="width: 10%">
                                    <label> Crédit</label>
                                    <input id="solde_credit_ancien_hidden" class="text_align_right" type="hidden" placeholder="Ancien Solde Crédit " readonly="readonly" style="text-align: right">

                                    <input id="solde_credit_ancien" class="text_align_right" type="text" placeholder="Ancien Solde Crédit " readonly="readonly" style="text-align: right">
                                </td>
                                <td style="width: 10%">
                                    <label> Débit</label>
                                    <input id="solde_debit" class="text_align_right" type="text" placeholder="Nouveau Solde Débit  " readonly="readonly" style="text-align: right">

                                    <input id="solde_debit_nouveau" class="text_align_right" type="hidden" placeholder="Solde Débit " readonly="readonly" style="text-align: right">
                                </td>
                                <td style="width: 10%">
                                    <label> Crédit</label>

                                    <input id="solde_credit" class="text_align_right" type="text" placeholder="Nouveau Solde Crédit " readonly="readonly" style="text-align: right">

                                    <input id="sold_credit_nouveau" class="text_align_right" type="hidden" placeholder="Solde Crédit" readonly="readonly" style="text-align: right">
                                </td>
                                <td style="width: 20%">
                                    <div class="mws-form-row">
                                        <label> </label> <label> </label>
                                        <input id="compte_comptable" class="large" type="text" placeholder="Compte comptable" readonly="readonly">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div class="mws-panel-toolbar ">
                        <div class="btn-toolbar" style="margin-left: 0px;">
                            <div class="btn-group" style="width: 100%">
                                <a class="btn btn-primary" href="<?php echo url_for('saisie_pieces/listePiece') ?>"><i class="ace-icon fa fa-undo"></i> Retour à la Liste</a>

                                <!--<a onclick="nouveauSaisiePieces()" class="btn  btn-info" style="float: left"><i class="ace-icon fa fa-file-o align-top bigger-110"></i> Nouvelle</a>-->
                                <a onclick="annulerPiece()" class="btn  btn-default" style="float: left"><i class="ace-icon fa fa-undo align-top bigger-110"></i> Annuler</a>
                                <a onclick="supprimerPiece()" class="btn  btn-danger" style="float: left"><i class="ace-icon fa fa-trash-o align-top bigger-110"></i> Supprimer</a>
                                <a title="Enregistrer (F4)" onclick="validerPiece('0')" class="btn  btn-success" style="float: left"><i class="ace-icon fa fa-save align-top bigger-110"></i> Enregistrer</a>
                                <a title="Enreg. en Série (F3)" onclick="validerPiece('1')" class="btn  btn-success" style="float: left"><i class="ace-icon fa fa-save align-top bigger-110"></i> Enreg. en Série</a>

                                <a title="Déplacer vers le haut." data-rel="tooltip" onclick="upLigne()" class="btn btn-warning" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-up align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Déplacer vers le bas." data-rel="tooltip" onclick="downLigne()" class="btn btn-warning" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Supprimer." data-rel="tooltip" onclick="supprimerLigne()" class="btn btn-danger" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-trash align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Ajouter après la ligne sélectionnée." data-rel="tooltip" onclick="ajouterLigne()" class="btn btn-primary" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Ajouter à la fin. (F2)" data-rel="tooltip" onclick="ajouterLastLigne()" class="btn btn-info" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Solder la pièce Avec Ajout un nv Ligne. (F1)" data-rel="tooltip" id="btn_solder" onclick="solderPiece()" class="btn btn-success" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-balance-scale align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Solder la pièce dans la ligne séléctionne" data-rel="tooltip" id="btn_solder_selectionne" onclick="solderPieceSelectionne()" class="btn btn-default" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-balance-scale align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="liste_ligne" style="width: 98%; margin-bottom: 10px; margin-left: 1%;">
                <thead>
                    <tr>
                        <th style="width: 3%; text-align: center;">N°</th>
                        <th style="width: 2%;"><input type="checkbox" disabled></th>
                        <th style="width: 27%;">Numéro du Compte</th>
                        <th style="width: 15%; text-align: center;">Débit</th>
                        <th style="width: 15%; text-align: center;">Crédit</th>
                        <th style="width: 15%;">Contre Partie</th>
                        <th style="width: 20%;">Libellé</th>
                        <th style="display: none;">Nature id</th>
                        <th style="display: none;">Type Pièce</th>
                        <th style="display: none;">N° Externe</th>
                        <th style="display: none;">Référence</th>
                        <th style="display: none;">document</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6" style="float: right;">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table style="width: 100%; margin-bottom: 0px;">
                            <tr>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><b>Total Débit :</b></label>
                                        <input class="text_align_right" id="total_debit" type="text" disabled="disabled" value="0.000">
                                    </div>
                                </td>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><b>Total Crédit :</b></label>
                                        <input class="text_align_right" id="total_credit" type="text" disabled="disabled" value="0.000">
                                    </div>
                                </td>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><b>Total Solde :</b></label>
                                        <input class="text_align_right" id="total_solde" type="text" disabled="disabled" value="0.000">
                                    </div>
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
                <h4 class="widget-title smaller">Liste des Pièces comptables</h4>
                <div class="mws-panel grid_8" id="liste_etat_journal">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function openPopupSupprimer(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette maquette de saisie ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function(result) {
                if (result) {
                    deletePiece(id);
                }
            }
        });
    }

    function deletePiece(id) {
        $.ajax({
            url: '<?php echo url_for('@deletePiece') ?>',
            data: 'id=' + id,
            success: function(data) {
                $('#listPiece_journal tbody').html(data);
            }
        });
    }

    function openPopupSupprimerForm(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cette maquette de saisie ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function(result) {
                if (result) {
                    deletePieceForm(id);
                }
            }
        });
    }

    function deletePieceForm(id) {
        $.ajax({
            url: '<?php echo url_for('@deletePiece') ?>',
            data: 'id=' + id,
            success: function(data) {
                afficher();
                //                $('#listPiece_journal tbody').html(data);
            }
        });
    }
    var index_ligne = 0;

    $("#numero").focus(function() {
        // Select input field contents
        this.select();
    });
    $("#numero").focusout(function() {
        validerLibellePiece();
    });

    function chargerSuivante() {
        if ($('#serie').val() != '' && $("#numero").val() != '') {
            var ancien_numero = $("#numero").val();
            if (ancien_numero.length > 4) {
                var serie = $('#serie').val().trim();
                var mask_numero = serie + "***";

                var nouveau_numero = ancien_numero.substring(serie.length, ancien_numero.length);
                if (nouveau_numero == '' || nouveau_numero == '___')
                    nouveau_numero = 0;
                nouveau_numero = parseInt(nouveau_numero) + 1;
                if (nouveau_numero < 10)
                    nouveau_numero = '00' + nouveau_numero;
                else if (nouveau_numero < 100)
                    nouveau_numero = '0' + nouveau_numero;

                nouveau_numero = serie + nouveau_numero;

                $("#numero").mask(mask_numero);
                $("#numero").val(nouveau_numero);
                chargerPiece();
            }
        }
    }

    function chargerPrecedente() {
        if ($('#serie').val() != '' && $("#numero").val() != '') {
            var ancien_numero = $("#numero").val();
            if (ancien_numero.length > 4) {
                var serie = $('#serie').val().trim();
                var mask_numero = serie + "***";

                var nouveau_numero = ancien_numero.substring(serie.length, ancien_numero.length);
                if (nouveau_numero == '' || nouveau_numero == '___')
                    nouveau_numero = 0;
                nouveau_numero = parseInt(nouveau_numero) - 1;
                if (nouveau_numero == 0)
                    nouveau_numero = 1;
                if (nouveau_numero < 10)
                    nouveau_numero = '00' + nouveau_numero;
                else if (nouveau_numero < 100)
                    nouveau_numero = '0' + nouveau_numero;

                nouveau_numero = serie + nouveau_numero;

                $("#numero").mask(mask_numero);
                $("#numero").val(nouveau_numero);
                chargerPiece();
            }
        }
    }

    function upDownNumero(event) {
        if (event.keyCode == 38) {
            if ($('#serie').val() != '' && $("#numero").val() != '') {
                var ancien_numero = $("#numero").val();
                if (ancien_numero.length > 4) {
                    var serie = $('#serie').val();
                    var mask_numero = serie + "***";

                    var nouveau_numero = ancien_numero.substring(serie.length, ancien_numero.length);
                    if (nouveau_numero == '' || nouveau_numero == '___')
                        nouveau_numero = 0;
                    nouveau_numero = parseInt(nouveau_numero) + 1;
                    if (nouveau_numero < 10)
                        nouveau_numero = '00' + nouveau_numero;
                    else if (nouveau_numero < 100)
                        nouveau_numero = '0' + nouveau_numero;

                    nouveau_numero = serie + nouveau_numero;

                    $("#numero").mask(mask_numero);
                    $("#numero").val(nouveau_numero);
                    chargerPiece();
                }
            }
        }
        if (event.keyCode == 40) {
            if ($('#serie').val() != '' && $("#numero").val() != '') {
                var ancien_numero = $("#numero").val();
                if (ancien_numero.length > 4) {
                    var serie = $('#serie').val();
                    var mask_numero = serie + "***";

                    var nouveau_numero = ancien_numero.substring(serie.length, ancien_numero.length);
                    if (nouveau_numero == '' || nouveau_numero == '___')
                        nouveau_numero = 0;
                    nouveau_numero = parseInt(nouveau_numero) - 1;
                    if (nouveau_numero == 0)
                        nouveau_numero = 1;
                    if (nouveau_numero < 10)
                        nouveau_numero = '00' + nouveau_numero;
                    else if (nouveau_numero < 100)
                        nouveau_numero = '0' + nouveau_numero;

                    nouveau_numero = serie + nouveau_numero;

                    $("#numero").mask(mask_numero);
                    $("#numero").val(nouveau_numero);
                    chargerPiece();
                }
            }
        }
    }

    function getSerie() {
        setTypePieceShow();
        if ($('#journal_id').val() != '' && $('#date').val() != '') {

            var date_saisie = $('#date').val();
            var d1 = new Date(<?php echo date('Y') ?>, <?php echo date('m') ?>, <?php echo date('d') ?>);
            var date_s = date_saisie.split("-");
            var d2 = new Date(date_s[0], date_s[1], date_s[2]);
            if (d1 >= d2) {
                goGetSerie(0);
            } else if (d1 < d2) {
                $('#date').val('');
                $('#serie').val('');
                $('#numero').val('');
                $('#attendu').val('');
                bootbox.confirm({
                    message: "La date saisie est une date postérieure, voulez-vous continuer ?",
                    buttons: {
                        cancel: {
                            label: "Non",
                            className: "btn-sm",
                        },
                        confirm: {
                            label: "Oui",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $('#date').val(date_saisie);
                            goGetSerie();

                        } else {
                            $('#date').focus();
                        }
                    }
                });
            }
        } else {
            $('#date').val('');
            $('#serie').val('');
            $('#numero').val('');
            $('#attendu').val('');
        }
        afficher();
        goPage(1);

    }
    //    if($('#journal_id').val()){
    //     afficher();
    //    }
    function afficher() {

        if ($('#journal_id').val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/afficherEtatJournalSeul') ?>',
                data: 'journal_id=' + $('#journal_id').val(),
                success: function(data) {
                    $('#liste_etat_journal').html(data);

                }
            });
            goPage(1);
        }

    }

    function setTypePieceShow() {
        var libelle_type_journal = $('#libelle_type_journal').val();
        if (libelle_type_journal.indexOf("RAN") >= 0 || libelle_type_journal.indexOf("OUVERTURE") >= 0) {
            $('#nature_piece option').each(function() {
                if ($(this).text().indexOf("RAN") >= 0 || $(this).text().indexOf("OUVERTURE") >= 0) {
                    $(this).css('display', 'block');
                } else {
                    $(this).css('display', 'none');
                }
            });
        } else {
            $('#nature_piece option').each(function() {
                if ($(this).text().indexOf("RAN") >= 0 || $(this).text().indexOf("OUVERTURE") >= 0)
                    $(this).css('display', 'none');
                else
                    $(this).css('display', 'block');
            });
        }
        $("#nature_piece").val('').trigger("liszt:updated");
        $("#nature_piece").trigger("chosen:updated");
    }

    function goGetSerie() {
        $('#numero').attr('readonly', 'readonly');
        $('#td_label_attendu').css('display', 'none');
        $('#td_attendu').css('display', 'none');
        $.ajax({
            dataType: 'json',
            url: '<?php echo url_for('@getSerieJournal') ?>',
            data: 'journal=' + $('#journal_id').val() + '&date=' + $('#date').val(),
            success: function(data) {
                if (data.bloque == '0') {
                    $('#serie').val(data.serie);
                    $('#serie_id').val(data.serie_id);
                    $('#numero').val(data.numero);
                    $('#attendu').val(data.attendu);
                    $('#numero').focus();
                } else {
                    $('#date').val('');
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>La date saisie appartient à une série bloquée!</span>",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    $('#date').focus();
                }
            }
        });
    }

    function activerNumero() {
        if ($('#serie').val() != '') {
            $('#numero').removeAttr('readonly');
            $('#td_label_attendu').css('display', 'block');
            $('#td_attendu').css('display', 'block');
            var serie = $('#serie').val();
            var mask_numero = serie + "***";
            $("#numero").val('');
            $("#numero").mask(mask_numero);
            $("#numero").val(serie);
        }
    }

    function validerNumero() {
        if ($('#numero').val() != '') {
            $('#numero').attr('readonly', 'readonly');
            $('#td_label_attendu').css('display', 'none');
            $('#td_attendu').css('display', 'none');
        } else {
            $('#numero').focus();
        }
    }

    function chargerPiece() {
        if ($('#numero').val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/getPieceJournal') ?>',
                data: 'numero=' + $('#numero').val() + '&journal=' + $('#journal_id').val(),
                success: function(data) {
                    $('#liste_ligne tbody').html(data);

                }
            });
            validerLibellePiece();
            validerNumero();
        } else {
            $('#numero').focus();
        }
    }

    function formatLigne(index) {
        console.log('index=' + index);
        $('#liste_ligne tbody tr').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#liste_ligne tbody tr input:checkbox').each(function() {
            $(this).prop('checked', false);

        });
        $('#ligne_' + index).css('background', '#E7E7E7');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
        $('#check_' + index).prop('checked', true);
        affichersolde(index);
    }

    function getLibelleNature() {
        if ($('#nature_piece').val() > -1) {
            var libelle = $('#nature_' + $('#nature_piece').val()).attr('libelle');
            $('#z_nature_piece').val(libelle);
        } else {
            $('#z_nature_piece').val();
        }
    }

    function upLigne() {
        console.log(index_ligne + 'fff_index' + $('#hidden_ligne_compte_' + index_ligne).val());
        if (index_ligne >= 1) {
            index_ligne++;
            var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + type_journal_id +
                    '&journal_id=' + $('#journal_id').val() +
                    '&selected_compte=' + $('#hidden_ligne_compte_' + index_ligne).val() +
                    '&credit=' + $('#ligne_credit_' + index_ligne).val() +
                    '&debit=' + $('#ligne_debit_' + index_ligne).val() +
                    '&selected_contre=' + $('#hidden_ligne_contre_' + index_ligne).val() +
                    '&libelle_ligne=' + $('#libelle_piece').val(),
                success: function(data) {
                    index_ligne--;
                    $('#ligne_' + index_ligne).remove();
                    index_ligne--;
                    $('#liste_ligne > tbody > tr').eq(index_ligne).before(data);
                    ligneNumber();
                    calculeTotal();
                    formatLigne(index_ligne);
                }
            });
        }
    }

    function downLigne() {
        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function() {
            count_ligne++;
        });
        if (count_ligne > 1) {
            if (index_ligne < count_ligne - 1) {
                index_ligne++;
                var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
                $.ajax({
                    url: '<?php echo url_for('@addLigneSaisie') ?>',
                    async: true,
                    data: 'nature_id=' + $('#nature_piece').val() +
                        '&numero_externe=' + $('#numero_externe').val() +
                        '&reference=' + $('#reference').val() +
                        '&type_journal_id=' + type_journal_id +
                        '&journal_id=' + $('#journal_id').val() +
                        '&selected_compte=' + $('#hidden_ligne_compte_' + index_ligne).val() +
                        '&credit=' + $('#ligne_credit_' + index_ligne).val() +
                        '&debit=' + $('#ligne_debit_' + index_ligne).val() +
                        '&selected_contre=' + $('#hidden_ligne_contre_' + index_ligne).val() +
                        '&libelle_ligne=' + $('#libelle_piece').val(),
                    success: function(data) {
                        index_ligne--;
                        $('#ligne_' + index_ligne).remove();
                        index_ligne++;
                        if (index_ligne < count_ligne - 1)
                            $('#liste_ligne > tbody > tr').eq(index_ligne).before(data);
                        else
                            $('#liste_ligne tbody').append(data);
                        ligneNumber();
                        calculeTotal();
                        formatLigne(index_ligne);
                    }
                });
            }
        }
    }

    function solderPiece() {
        var count_ligne = 0;
        $('#liste_ligne tbody tr').each(function() {
            count_ligne++;
        });
        if (count_ligne > 0 && parseFloat($('#total_solde').val()) != 0) {
            if (parseFloat($('#total_solde').val()) > 0) {
                var credit = parseFloat($('#total_solde').val());
                var debit = '';
            } else {
                var credit = '';
                var debit = parseFloat($('#total_solde').val());
            }
            var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + type_journal_id +
                    '&journal_id=' + $('#journal_id').val() +
                    '&selected_compte=' + $('#journal_contre_id').val() +
                    '&credit=' + credit +
                    '&debit=' + debit +
                    '&selected_contre=' + $('#ligne_contre_' + count_ligne).val() +
                    '&&numerofinligne=' + count_ligne + '&libelle_ligne=' + $('#libelle_piece').val(),
                success: function(data) {
                    $('#liste_ligne tbody').append(data);
                    ligneNumber();
                    calculeTotal();
                }
            });
        }
    }

    function solderPieceSelectionne() {console.log('selectionne=');
        //var count_ligne = 0;
        $('[name="checkk"]').each(function() {
            var id = $(this).attr("id");console.log('selectionne='+id);
            if ($('#' + id).prop("checked") == true) {console.log('selectionnechched='+id);
                var index_ligne_chek = $('#' + id).attr("index_ligne_chek");
                if (parseFloat($('#total_solde').val()) != 0) {
                    if (parseFloat($('#total_solde').val()) > 0) {
                        var credit = parseFloat($('#total_solde').val());
                        var debit = '';
                    } else {
                        var credit = '';
                        var debit = parseFloat($('#total_solde').val());
                    }
                    var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
                    if (debit != 0) {
                        console.log('debit' + debit);
                        $('#ligne_debit_' + index_ligne_chek).val(parseFloat(debit).toFixed(3));
                    }
                    if (credit != 0) {
                        console.log('crdit=' + credit );
                        $('#ligne_credit_' + index_ligne_chek).val(parseFloat(credit).toFixed(3));

                    }
                }
            }
        });

        // ligneNumber();
        calculeTotal();
        // formatLigne(0);
    }

    function ajouterLigne() {
        if ($('#journal_d').val() != '') {
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function() {
                count_ligne++;
            });
            var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + type_journal_id +
                    '&journal_id=' + $('#journal_id').val() + '&libelle_ligne=' + $('#libelle_piece').val(),
                success: function(data) {
                    if (count_ligne > 0) {
                        $('#liste_ligne > tbody > tr').eq(index_ligne).before(data);
                        index_ligne++;
                    } else {
                        $('#liste_ligne tbody').append(data);
                        index_ligne = 0;
                    }
                    $('#numero_externe').attr('disabled', 'disabled');
                    $('#reference').attr('disabled', 'disabled');

                    $('#nature_piece_chosen').hide();
                    $('#z_nature_piece').show();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable ou la Date !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    function addFirstLigne() {

        if ($('#libelle_piece').val() != '') {
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function() {
                count_ligne++;
            });

            if (count_ligne == 0) {
                ajouterLastLigne();
            }
            <?php if (isset($id_journal) && $id_journal != '') : ?>
                validerLibellePiece();
            <?php endif; ?>
        }
    }

    function chargerLigne(e, dbclick) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }
        if (key == 13 || dbclick) {
            addFirstLigne();
        }
    }

    function ajouterLastLigne() {
        if ($('#journal_id').val() != '') {
            var type_journal_id = $('#journal_option_' + $('#journal_id').val()).attr('type_journal');
            var maquette_id = $('#id_maquette').val();
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function() {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + $('#nature_piece').val() +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + type_journal_id +
                    '&journal_id=' + $('#journal_id').val() +
                    '&maquette_id=' + maquette_id +
                    '&numerofinligne=' + count_ligne +
                    '&selectedcontre=' + $('#ligne_contre_' + count_ligne).val() +
                    '&libelle_ligne=' + $('#libelle_piece').val(),
                success: function(data) {

                    $('#liste_ligne tbody').append(data);
                    //                    $('#numero_externe').attr('disabled', 'disabled');
                    //                    $('#reference').attr('disabled', 'disabled');

                    var count_ligne = 0;
                    $('#liste_ligne tbody tr').each(function() {
                        count_ligne++;
                    });
                    count_ligne--;

                    formatLigne(count_ligne);

                    //                    $('#nature_piece_chosen').fadeOut();
                    //                    $('#z_nature_piece').fadeIn();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable  ou la date !! </span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    //    function verifierNumeroExterne() {
    //        if ($('#numero_externe').val() != '') {
    //            $.ajax({
    //                url: '<?php // echo url_for('@verifierNumeroExterne')  
                            ?>',
    //                data: 'numero_externe=' + $('#numero_externe').val() + '&journal_id=' + $('#journal_id').val(),
    //                success: function (data) {
    //                    alert(data+'length'+ data.length);
    //                    if (data != '') {
    //                        bootbox.confirm({
    //                            message: data,
    //                            buttons: {
    //                                cancel: {
    //                                    label: "Non",
    //                                    className: "btn-sm",
    //                                },
    //                                confirm: {
    //                                    label: "Oui",
    //                                    className: "btn-primary btn-sm",
    //                                }
    //                            },
    //                            callback: function (result) {
    //                                if (result) {
    //
    //                                } else {
    //                                    $('#numero_externe').val('');
    //                                    $('#numero_externe').focus();
    //                                }
    //                            }
    //                        });
    //                    }
    //                }
    //            });
    //        }
    //    }

    function validerLibellePiece() {
        //        if ($('#date').val() != '' && $('#journal').val() != '-1') {
        //            $('#journal_chosen').hide();
        //            $('#z_journal').val($('#journal_option_' + $('#journal').val()).text());
        //            $('#journal_contre_id').val($('#journal_option_' + $('#journal').val()).attr('data-contre'));
        //            $('#z_journal').show();
        //            $('#serie').attr('disabled', 'disabled');
        //            $('#date').attr('disabled', 'disabled');
        //        }
    }

    function supprimerLigne() {
        $('#ligne_' + index_ligne).remove();
        ligneNumber();
        calculeTotal();
        formatLigne(0);
    }

    function ligneNumber() {
        var i = 1;
        $('#liste_ligne tbody tr').each(function() {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function() {
            $(this).text(i);
            i++;
        });
        var i = 1;
        $('[name="checkk"]').each(function() {
            var id = 'check_' + i;
            $(this).attr('id', id);

            $(this).attr('index_ligne_chek', i);
            var affichesolde = 'affichersolde("' + i + '")';
            $(this).attr('onclick', affichesolde);
            i++;
        });
        var i = 1;
        $('[name="ligne_compte"]').each(function() {
            var id = 'ligne_compte_' + i;
            $(this).attr('id', id);
            var format = 'chargerCompte("#ligne_compte_' + i + '", "#hidden_ligne_compte_' + i + '", "#ligne_compte_libelle_' + i + '")';
            $(this).attr('onkeyup', format);
            $(this).attr('onfocus', format);

            format = 'moveToNext(event, "ligne_compte", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="hidden_ligne_compte"]').each(function() {
            var id = 'hidden_ligne_compte_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_contre"]').each(function() {
            var id = 'ligne_contre_' + i;
            $(this).attr('id', id);
            var format = 'chargerCompte("#ligne_contre_' + i + '", "#hidden_ligne_contre_' + i + '", "#ligne_contre_libelle_' + i + '")';
            $(this).attr('onkeyup', format);
            $(this).attr('onfocus', format);
            format = 'moveToNext(event, "ligne_contre", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="hidden_ligne_contre"]').each(function() {
            var id = 'hidden_ligne_contre_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_debit"]').each(function() {
            var id = 'ligne_debit_' + i;
            $(this).attr('id', id);
            var format = 'moveToNext(event, "ligne_debit", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="button_debit"]').each(function() {
            var id = 'button_debit_' + i;
            $(this).attr('id', id);
            var format = 'showCalculatrice("ligne_debit_' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="ligne_credit"]').each(function() {
            var id = 'ligne_credit_' + i;
            $(this).attr('id', id);
            var format = 'moveToNext(event, "ligne_credit", ' + i + ')';
            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="button_credit"]').each(function() {
            var id = 'button_credit_' + i;
            $(this).attr('id', id);
            var format = 'showCalculatrice("ligne_credit_' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="ligne_nature_id"]').each(function() {
            var id = 'ligne_nature_id_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_numero_externe"]').each(function() {
            var id = 'ligne_numero_externe_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_reference"]').each(function() {
            var id = 'ligne_reference_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_facture_id"]').each(function() {
            var id = 'ligne_facture_id_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_compte_libelle"]').each(function() {
            var id = 'ligne_compte_libelle_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_contre_libelle"]').each(function() {
            var id = 'ligne_contre_libelle_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="ligne_libelle"]').each(function() {
            var id = 'ligne_libelle_' + i;
            $(this).attr('id', id);
            var format = 'moveToNext(event, "ligne_libelle", "' + i + '")';
            $(this).attr('onkeydown', format);
            //  $('#ligne_libelle_' + i).val($('#libelle_piece').val());
            i++;
        });


        calculeTotal();
    }

    function calculeTotal() {
        var total_credit = 0;

        $('[name="ligne_credit"]').each(function() {

            var credit = $(this).val();
            credit = eval(credit.replace(/,/g, '.'));
            credit = Math.abs(credit);
            if (isNaN(credit))
                credit = 0;
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
            //            index_tr++;

            if (credit != '' && credit != 0) {
                total_credit = parseFloat(total_credit) + parseFloat(credit);
                $(this).val(parseFloat(credit).toFixed(3));
                $('#ligne_debit_' + index_tr).attr('readonly', 'readonly');
                $('#button_debit_' + index_tr).attr('disabled', 'true');
                //                var solde_nouveua_credit = parseFloat(credit) + parseFloat($('#solde_credit_ancien_hidden').val());
                //                $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));
                //                var solde_nouveau_debit = parseFloat($('#solde_debit_ancien_hidden').val());
                //                $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));

                // var solde = solde_nouveau_debit - solde_nouveua_credit;
                //                if (solde < 0)
                //                {
                //                    $('#solde_cerdit').val(parseFloat(Math.abs(solde)).toFixed(3));
                //                    $('#solde_debit').val('');
                //                }
                //                else {
                //                    $('#solde_debit').val(parseFloat(Math.abs(solde)).toFixed(3));
                //                    $('#solde_cerdit').val('');
                //                }
            } else {
                $('#ligne_debit_' + index_tr).removeAttr('readonly');
                $('#button_debit_' + index_tr).removeAttr('disabled');
                $(this).val('');
                //                if ($('#solde_credit_ancien_hidden').val() != '')
                //                {
                //                    var solde_nouveua_credit = parseFloat($('#solde_credit_ancien_hidden').val());
                //                    $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));
                //                }
            }
            // affichersolde(index_tr);
            index_tr++;
        });
        var total_debit = 0;
        $('[name="ligne_debit"]').each(function() {
            var debit = $(this).val();
            debit = eval(debit.replace(/,/g, '.'));
            debit = Math.abs(debit);
            if (isNaN(debit))
                debit = 0;
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');

            //            debugger;
            if (debit != '' && debit != 0) {
                total_debit = parseFloat(total_debit) + parseFloat(debit);
                $(this).val(parseFloat(debit).toFixed(3));

                //                var solde_nouveau_debit = parseFloat(debit) + parseFloat($('#solde_debit_ancien_hidden').val());
                //                $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));
                //                var solde_nouveua_credit = parseFloat($('#solde_credit_ancien_hidden').val());
                //                $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));

                //  var solde = solde_nouveau_debit - solde_nouveua_credit;

                //                if (solde < 0)
                //                {
                //                    $('#solde_cerdit').val((parseFloat(Math.abs(solde)).toLocaleString()));
                //                    $('#solde_debit').val('');
                //                }
                //                else {
                //                    $('#solde_debit').val((parseFloat(Math.abs(solde)).toLocaleString()));
                //                    $('#solde_cerdit').val('');
                //                }

                $('#ligne_credit_' + index_tr).attr('readonly', 'readonly');
                $('#button_credit_' + index_tr).attr('disabled', 'true');
            } else {
                $('#ligne_credit_' + index_tr).removeAttr('readonly');
                $('#button_credit_' + index_tr).removeAttr('disabled');
                $(this).val('');
                //                if ($('#solde_debit_ancien_hidden').val() != '')
                //                {
                //                    var solde_nouveau_debit = parseFloat($('#solde_debit_ancien_hidden').val());
                //                    $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));
                //                }
            }
            // affichersolde(index_tr);
            index_tr++;
        });
        var total_solde = parseFloat(total_debit) - parseFloat(total_credit);
        $('#total_credit').val(parseFloat(total_credit).toFixed(3));
        $('#total_debit').val(parseFloat(total_debit).toFixed(3));

        $('#total_solde').val(parseFloat(total_solde).toFixed(3));
        $('#detail_total_solde').html(parseFloat(total_solde).toFixed(3));
        if (total_solde > 0)
            $('#nature_solde').html('Débiteur');
        else if (total_solde < 0)
            $('#nature_solde').html('Créditeur');
        else
            $('#nature_solde').html('Soldé');

    }

    function getPieceForLigne() {
        if ($('#reference').val() != '') {
            var type_journal_id = $('#journal_option_' + $('#journal').val()).attr('type_journal');
            if (type_journal_id == 1 && $('#nature_piece').val() == 7) {
                //facture vente
                $.ajax({
                    url: '<?php echo url_for('@getPieceLigneVente') ?>',
                    data: 'reference=' + $('#reference').val(),
                    success: function(data) {
                        $('#details_document').html(data);
                        $('#details_document').fadeIn();
                    }
                });
            }

            if (type_journal_id == 2 && $('#nature_piece').val() == 7) {
                //facture achat
                $.ajax({
                    url: '<?php echo url_for('@getPieceLigneAchat') ?>',
                    data: 'reference=' + $('#reference').val(),
                    success: function(data) {
                        $('#details_document').html(data);
                        $('#details_document').fadeIn();
                    }
                });
            }
            if (type_journal_id == 5) {
                //facture achat
                $.ajax({
                    url: '<?php echo url_for('saisie_pieces/getPieceLigneOd') ?>',
                    data: 'reference=' + $('#reference').val(),
                    success: function(data) {
                        $('#details_document').html(data);
                        $('#details_document').fadeIn();
                    }
                });
            }
            if (type_journal_id == 3) {
                //facture achat
                $.ajax({
                    url: '<?php echo url_for('saisie_pieces/getPieceLigneBanque') ?>',
                    data: 'reference=' + $('#reference').val(),
                    success: function(data) {
                        $('#details_document').html(data);
                        $('#details_document').fadeIn();
                    }
                });
            }
            if (type_journal_id == 7) {
                //facture achat
                $.ajax({
                    url: '<?php // echo url_for('saisie_pieces/getPieceLignePaie')                          
                            ?>',
                    data: 'reference=' + $('#reference').val(),
                    success: function(data) {
                        $('#details_document').html(data);
                        $('#details_document').fadeIn();
                    }
                });
            }
        } else {
            $('#details_document').fadeOut();
        }
    }

    function annulerPiece() {
        if ($('#detail_piece_id').val() != '') {
            chargerPiece();
        } else {
            $('#liste_ligne tbody').html('');
            ligneNumber();
        }
    }

    function showPieceExistantes() {
        $('#zone_piece_existante').fadeIn();
    }
</script>

<?php include_partial('saisie_pieces/calculatrice') ?>
<script type="text/javascript">
    var bootbox_id = '';
    var data_bootbox = '';

    function showCalculatrice(id) {
        bootbox_id = id;
        data_bootbox = $('#calculatrice_area').html();
        $('#calculatrice_area').html('');
        bootbox.confirm({
            message: data_bootbox,
            callback: function(result) {
                afterClose();
            }
        });
        $('.modal-footer').attr("style", "display: none;");
        $('.modal-dialog').attr("style", "width: 301px;");
    }

    function afterClose() {
        if ($('#resultat_calcule').val() != '' && eval($('#resultat_calcule').val().replace(/,/g, '.')) != 0) {
            if (verification($('#resultat_calcule').val()))
                a = eval($('#resultat_calcule').val().replace(/,/g, '.'));
            if (a) {
                $('#' + bootbox_id).val(a);
                if (data_bootbox != '') {
                    $('#calculatrice_area').html(data_bootbox);
                    data_bootbox = '';
                    $('#resultat_calcule').val('');
                }
                $('#' + bootbox_id).focus();
                bootbox_id = '';
            } else {
                $('#' + bootbox_id).focus();
                return;
            }
        } else {
            //            $('#' + bootbox_id).val('');
            if (data_bootbox != '') {
                $('#calculatrice_area').html(data_bootbox);
                data_bootbox = '';
                $('#resultat_calcule').val('');
            }
            $('#' + bootbox_id).focus();
            bootbox_id = '';
        }
        calculeTotal();
    }

    function numStr(a, b) {
        a = '' + a;
        b = b || ' ';
        var c = '',
            d = 0;
        while (a.match(/^0[0-9]/)) {
            a = a.substr(1);
        }
        for (var i = a.length - 1; i >= 0; i--) {
            c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
            d++;
        }
        return c;
    }

    function chargerJournal(id1, id2, id3) {

        if ($(id1).val() != '') {
            console.log($(id1).val());
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/JournalParCode') ?>',
                data: 'numero=' + $(id1).val(),
                success: function(data) {
                    var data = JSON.parse(data);

                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                            '<ul id="ul_compte" onkeydown="selectLiComptable(event)" style="z-index: 9;">';
                        for (var i = 0; i < data.length; i++) {
                            if (i == 0)
                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                            else
                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                        }
                        htmlins += '</ul></div>';
                    }
                    $(id1).after(htmlins);
                }
            });
        } else {
            $(id2).val('');
            $(id3).html('');
            $(id3).text();
        }
    }

    function Choisirnaturepiece22(id1, id2) {
        //        if ($(id1).val() != '') {
        $.ajax({
            url: '<?php echo url_for('saisie_pieces/NaturePieceParCodeEdit') ?>',
            data: 'numero=' + $(id1).val(),
            success: function(data) {
                //                data = response.data;
                //                alert(response);
                //                alert(response+'id='+id+'id_hiden'+id_hidden);
                //                AjoutHtmlAfter(data, id, id_hidden);
                var data = JSON.parse(data);
                $(".testul ul").css('width', $(id1).width());
                htmlins = '';
                table = data;
                $(".testul").remove();
                if (data.length > 0) {
                    htmlins = '<div class="testul">' +
                        '<ul id="ul_compte" style="z-index: 9;">';
                    for (i = 0; i < data.length; i++) {
                        if (i == 0)
                            htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                        else
                            htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                    }
                    htmlins += '</ul></div>';
                }
                $(id1).after(htmlins);

            }
        });

    }
    //    else {
    //            $(id1).val('');
    //          
    //            $(id2).text();
    //        }
    //        }
</script>

<style>
    .display_none {
        display: none;
    }

    .text_align_right {
        text-align: right;
    }
</style>