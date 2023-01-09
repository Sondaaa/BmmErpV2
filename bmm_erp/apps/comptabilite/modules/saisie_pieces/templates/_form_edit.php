<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête et date de la Pièce comptable : </h4>
            </div>
            <?php
            $id_nature_pieces = '';
            $id_journal = $piece->getIdJournalcomptable();
            if (sizeof($piece->getLignepiececomptable()) >= 1) {
                if ($piece->getLignepiececomptable()->getFirst()->getIdNaturepiece() != null)
                    $id_nature_pieces = $piece->getLignepiececomptable()->getFirst()->getIdNaturepiece();
            }
            ?>
            <div class="widget-body" <?php if (sizeof($piece->getLignepiececomptable()) >= 1) :
                                            if ($id_journal != null) : ?> ng-init="InitisilerNaturepieceEtJournal('<?php echo $id_journal; ?>', '<?php echo $id_nature_pieces; ?>')" <?php endif;
                                                                                                                                                                                                                                                                            endif; ?>>
                <div class="widget-main">
                    <form ng-controller="myCtrlCompteComptable">
                        <table class="table table-bordered table-hover" style="width: 100%; margin-bottom: 0px;">
                            <tr>
                                <td style="width: 15%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Journal :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Date :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Série :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Numéro :</label>
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
                                    <?php $journals = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
                                    <div class="mws-form-row">

                                        <?php
                                        $id_journal = $piece->getIdJournalcomptable();
                                        if ($id_journal != '')
                                            $journal = JournalcomptableTable::getInstance()->find($id_journal);
                                        ?>
                                        <input type="hidden" id="journal_id" value="<?php
                                                                                    if ($id_journal != '') : echo $id_journal;
                                                                                    endif;
                                                                                    ?>" width="300%">
                                        <input type="hidden" id="libelle_type_journal" value="">
                                        <input class="form-control" ng-model="journal_option" ng-value="journal_option.text" id="journal_option" placeholder="Journal comptable" value="<?php
                                                                                                                                                                                        if ($id_journal != '') :
                                                                                                                                                                                            echo trim($journal->getCode()) . ' - ' . trim($journal->getLibelle());
                                                                                                                                                                                        endif;
                                                                                                                                                                                        ?>" type="text" ng-change="ChoisirjournalcomptableEdit('#journal_option', '#journal_id')" onclick="afficher()" />
                                        <!--<input type="hidden" id="journal_id">-->

                                        <input class="display_none" id="z_journal" value="<?php // if ($j) echo $j->getLibelle();              
                                                                                            ?>" type="text" disabled="disabled">
                                        <input class="display_none" id="journal_contre_id" value="<?php // echo $data_contre;              
                                                                                                    ?>" type="text" disabled="disabled">
                                    </div>
                                </td>

                                <!--                                <td>
                                    <div class="mws-form-row">
                                        <input id="z_journal" value="<?php // echo $piece->getJournalcomptable()->getLibelle();                              
                                                                        ?>" type="text" readonly="readonly">
                                    </div>
                                </td>-->
                                <td>
                                    <input id="date" type="date" onchange="getSerieEdit()" value="<?php echo $piece->getDate(); ?>">
                                </td>
                                <td>
                                    <input type="text" id="serie" readonly="readonly" value="<?php echo $piece->getNumeroseriejournal()->getPrefixe(); ?>">
                                    <input id="serie_id" type="hidden" readonly="readonly" value="<?php echo $piece->getNumeroseriejournal()->getId(); ?>">
                                </td>
                                <!--                                <td>
                                    <input type="text" value="<?php // echo $piece->getNumeroseriejournal()->getPrefixe()                             
                                                                ?>" id="serie" readonly="readonly">
                                </td>-->
                                <td>
                                    <input type="text" value="<?php echo $piece->getNumero() ?>" id="numero" readonly="readonly">
                                </td>

                                <td style="width: 95%; display: none;" id="td_attendu">
                                    <input type="text" id="attendu" readonly="readonly">
                                </td>
                                <td><?php // $nature_pieces = NaturepieceTable::getInstance()->findAll();                        
                                    ?>
                                    <!--                                    <select id="nature_piece" onchange="getLibelleNature()" class="chosen-select form-control">
                                        <option value=""></option>
                                    <?php // foreach ($nature_pieces as $nature_piece):    
                                    ?>
                                            <option <?php //  if ($piece->getLignepiececomptable()->getFirst()->getIdNaturepiece() == $nature_piece->getId()):                    
                                                    ?>selected="true" <?php
                                                                        //                                                endif;
                                                                        ?>
                                                                                                                                                                                                            value="<?php // echo $nature_piece->getId();                    
                                                                                                                                                                                                                    ?>"><?php // echo $nature_piece->getLibelle();                    
                                                                                                                                                                                                                        ?></option>
                                    <?php // endforeach;    
                                    ?>
                                    </select>-->
                                    <?php
                                    if (sizeof($piece->getLignepiececomptable()) >= 1) :
                                        if ($piece->getLignepiececomptable()->getFirst()->getIdNaturepiece() != null)
                                            $id_nature_pieces = $piece->getLignepiececomptable()->getFirst()->getIdNaturepiece();
                                        if ($piece->getLignepiececomptable()->getFirst()->getIdNaturepiece() != null) {
                                            if ($id_nature_pieces != '')
                                                $nature = NaturepieceTable::getInstance()->find($id_nature_pieces);
                                        }
                                    endif;
                                    ?>
                                    <input type="hidden" id="nature_piece" value="<?php
                                                                                    if (sizeof($piece->getLignepiececomptable()) >= 1) : if ($id_nature_pieces != '') : echo $id_nature_pieces;
                                                                                        endif;
                                                                                    endif;
                                                                                    ?>" width="300%">
                                    <input class="form-control" ng-model="nature_piece_option_edit" ng-value="nature_piece_option_edit.text" id="nature_piece_option_edit" placeholder="Nature Pièce" value="<?php
                                                                                                                                                                                                                if ($id_nature_pieces != '') : echo $nature->getLibelle();
                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                ?>" type="text" onfocus="this.select();" ng-change="ChoisirnaturepieceEdit('#nature_piece_option_edit', '#nature_piece')" />

                                    <input class="display_none" id="z_nature_piece" value="" type="text" disabled="disabled">
                                </td>
                                <!--                                <td>
                                         <input id="z_nature_piece" value="" type="text" >
                                     </td>-->

                                <td>
                                    <!--value="<?php // echo $piece->getLignepiececomptable()->getFirst()->getNumeroexterne();       
                                                ?>"-->
                                    <input id="numero_externe" value=" <?php
                                                                        if ($id_journal != '') :
                                                                            echo trim($num_externe);
                                                                        endif;
                                                                        ?>" type="text">
                                </td>
                                <td style="display: none">
                                    <input id="reference" value="" type="text">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="details_document" style="display: none;">

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
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td style="width: 60%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Libellé * :</label>
                                        <input id="libelle_piece" value="<?php echo $piece->getLibelle(); ?>" type="text" placeholder="Libellé pièce comptable" style="width: 100%;">
                                        <input id="detail_piece_id" value="<?php echo $piece->getId(); ?>" type="hidden" readonly="readonly">
                                    </div>
                                </td>
                                <td style="width: 20%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Solde :</label>
                                        <div id="detail_total_solde" style="margin-top: 7px;">0.000</div>
                                    </div>
                                </td>
                                <td style="width: 20%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Nature Solde :</label>
                                        <div id="nature_solde" style="margin-top: 7px;">Soldé</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-hover">
                            <tr>
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
                                        <label class="mws-form-label" style="width: 100%">Compte Comptable:</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
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

                                    <input id="solde_cerdit" class="text_align_right" type="text" placeholder="Nouveau Solde Crédit " readonly="readonly" style="text-align: right">

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
                    <div class="mws-panel-toolbar">
                        <div class="btn-toolbar" style="margin-left: 0px;">
                            <div class="btn-group" style="width: 100%">
                                <a class="btn btn-default" href="<?php echo url_for('saisie_pieces/listePiece') ?>"><i class="ace-icon fa fa-undo"></i> Retour à la Liste</a>

                                <a style="float: left;margin-right: 2px" type="button" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $piece->getId()) ?>" class="btn btn-primary "><i class="ace-icon fa fa-print"></i>Imprimer</a>

                                <a onclick="fermerEditPiece()" style="float: left;margin-right: 2px" class="btn  btn-default" style="float: left"><i class="ace-icon fa fa-undo align-top bigger-110"></i> Annuler</a>
                                <a onclick="validerPiece()" class="btn  btn-success" style="float: left"><i class="ace-icon fa fa-save align-top bigger-110"></i> Enregistrer</a>

                                <a title="Déplacer vers le haut." data-rel="tooltip" onclick="upLigne()" class="btn btn-warning" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-up align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Déplacer vers le bas." data-rel="tooltip" onclick="downLigne()" class="btn btn-warning" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Supprimer." data-rel="tooltip" onclick="supprimerLigne()" class="btn btn-danger" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-trash align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Ajouter avant la ligne sélectionnée." data-rel="tooltip" onclick="ajouterLigne()" class="btn btn-primary" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-right align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Ajouter à la fin. (F2)" data-rel="tooltip" onclick="ajouterLastLigne()" class="btn btn-info" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-arrow-down align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Solder la pièce. (F1)" data-rel="tooltip" onclick="solderPiece()" class="btn btn-success" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-balance-scale align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>
                                <a title="Solder la pièce dans la ligne séléctionne" data-rel="tooltip" id="btn_solder_selectionne" onclick="solderPieceSelectionne()" class="btn btn-default" style="float: right; padding: 5.5px 12px; padding-top: 3px;"><i class="ace-icon fa fa-balance-scale align-top bigger-110" style="margin-top: 4px; margin-right: 0px;"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="liste_ligne" class="table table-bordered table-hover" style="width: 98%; margin-bottom: 10px; margin-left: 1%;">
                <thead>
                    <tr>
                        <th style="width: 3%; text-align: center;">N°</th>
                        <th style="width: 2%;"><input type="checkbox" disabled></th>
                        <th style="width: 25%;">Numéro du Compte</th>
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
                    <?php
                    $i = 0;
                    $nature_id = '';
                    $nature_libelle = '';
                    $numero_externe = '';
                    $reference = '';
                    ?>
                    <?php $lignes = LignepiececomptableTable::getInstance()->getByPieceInOrderSaisie($piece->getId()); ?>
                    <?php
                    foreach ($lignes as $ligne) :
                        if (($ligne->getMontantdebit() != 0) || ($ligne->getMontantcredit() != 0)) :
                    ?>
                            <tr id="ligne_<?php echo $i; ?>" onclick="formatLigne(<?php echo $i; ?>)" index_ligne="<?php echo $i; ?>" <?php if (trim($ligne->getLettrelettrage()) != '') : ?> style="background-color: #82AF6F;" class="disabledbutton" <?php endif; ?>>
                                <td name="col_number" style="text-align:center"><?php echo $i + 1; ?></td>
                                <?php
                                $compte_libelle = '';
                                $compte_id = '';
                                if ($ligne->getIdComptecomptable() != '') :
                                    $compte = PlandossiercomptableTable::getInstance()->find($ligne->getIdComptecomptable());
                                    $compte_libelle = trim($compte->getNumerocompte()) . ' - ' . trim($compte->getLibelle());
                                    $compte_id = $ligne->getIdComptecomptable();
                                endif;
                                ?>
                                <td>
                                    <input type="checkbox" onclick="affichersolde('<?php echo $compte_id ?>')" name="checkk" id="check_<?php echo $compte_id ?>" index_ligne_chek="0" />
                                </td>
                                <td>

                                    <input type="text" value="<?php echo $compte_libelle; ?>" name="ligne_compte" id="ligne_compte_<?php echo $i + 1; ?>" onfocus="chargerCompte('#ligne_compte_<?php echo $i + 1; ?>', '#hidden_ligne_compte_<?php echo $i + 1; ?>', '#ligne_compte_libelle_<?php echo $i + 1; ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i + 1; ?>', '#hidden_ligne_compte_<?php echo $i + 1; ?>', '#ligne_compte_libelle_<?php echo $i + 1; ?>')" onkeydown="moveToNext(event, 'ligne_compte', <?php echo $i; ?>)" />
                                    <input type="hidden" value="<?php echo $compte_id; ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i + 1; ?>" />


                                    <input type="hidden" value="<?php echo trim($ligne->getLettrelettrage()); ?>" name="hidden_ligne_compte_lettre" id="hidden_ligne_compte_lettre_<?php echo $i + 1; ?>" />
                                    <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i + 1; ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                                        <?php echo $compte_libelle; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control text_align_right" data-text="decimal" value="<?php echo $ligne->getMontantdebit(); ?>" type="text" id="ligne_debit_<?php echo $i + 1; ?>" name="ligne_debit" onchange="calculeTotal()">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" onclick="showCalculatrice(<?php echo $i + 1; ?>)" name="button_debit" id="button_debit_<?php echo $i + 1; ?>" type="button">
                                                <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control text_align_right" data-text="decimal" value="<?php echo $ligne->getMontantcredit(); ?>" type="text" id="ligne_credit_<?php echo $i + 1; ?>" name="ligne_credit" style="text-align:right;" onchange="calculeTotal()">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" onclick="showCalculatrice(<?php echo $i + 1; ?>)" name="button_credit" id="button_credit_<?php echo $i + 1; ?>" type="button">
                                                <i class="ace-icon fa fa-calculator bigger-110" style="margin-right: 0px;"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $contre_libelle = '';
                                    $contre_id = '';
                                    if ($ligne->getIdContrepartie() != '') :
                                        $contre = PlandossiercomptableTable::getInstance()->find($ligne->getIdContrepartie());
                                        $contre_libelle = trim($contre->getNumerocompte()) . ' - ' . trim($contre->getLibelle());
                                        $contre_id = $ligne->getIdContrepartie();
                                    endif;
                                    ?>
                                    <input type="text" value="<?php echo $contre_libelle; ?>" name="ligne_contre" id="ligne_contre_<?php echo $i + 1; ?>" onfocus="chargerCompte('#ligne_contre_<?php echo $i + 1; ?>', '#hidden_ligne_contre_<?php echo $i + 1; ?>', '#ligne_contre_libelle_<?php echo $i + 1; ?>')" onkeyup="chargerCompte('#ligne_contre_<?php echo $i + 1; ?>', '#hidden_ligne_contre_<?php echo $i + 1; ?>', '#ligne_contre_libelle_<?php echo $i + 1; ?>')" onkeydown="moveToNext(event, 'ligne_contre', <?php echo $i + 1; ?>)" />
                                    <input type="hidden" value="<?php echo $contre_id; ?>" name="hidden_ligne_contre" id="hidden_ligne_contre_<?php echo $i + 1; ?>" />
                                    <div name="ligne_contre_libelle" id="ligne_contre_libelle_<?php echo $i + 1; ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                                        <?php echo $contre_libelle; ?>
                                    </div>
                                </td>
                                <td><input type="text" id="ligne_libelle_<?php echo $i + 1; ?>" name="ligne_libelle" value="<?php if ($ligne->getLibelle() && $ligne->getLibelle() != 'undefined')  echo $ligne->getLibelle(); ?>" onkeydown="moveToNext(event, 'ligne_libelle', <?php echo $i + 1; ?>)"></td>
                                <td style="display:none">
                                    <input type="text" id="ligne_nature_id_<?php echo $i + 1; ?>" name="ligne_nature_id" value="<?php echo $ligne->getIdNaturepiece(); ?>">
                                </td>
                                <td style="display: none;">
                                    <?php
                                    if ($ligne->getIdNaturepiece() != null) {
                                        echo $ligne->getNaturepiece()->getLibelle();
                                        if ($nature_id == '') {
                                            $nature_id = $ligne->getIdNaturepiece();
                                            $nature_libelle = $ligne->getNaturepiece()->getLibelle();
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="display: none;">
                                    <?php echo $ligne->getNumeroexterne(); ?>
                                    <input style="display:none;" type="text" id="ligne_numero_externe_<?php echo $i + 1; ?>" name="ligne_numero_externe" value="<?php echo $ligne->getNumeroexterne(); ?>">
                                </td>
                                <?php
                                $facture = null;
                                if ($ligne->getIdFacturevente() != null) {
                                    $facture = $ligne->getFacturecomptablevente();
                                }
                                if ($ligne->getIdFactureachat() != null) {
                                    $facture = $ligne->getFacturecomptableachat();
                                }
                                if ($numero_externe == '')
                                    $numero_externe = $ligne->getNumeroexterne();
                                if ($reference == '')
                                    $reference = $ligne->getReference();
                                ?>
                                <?php if ($facture != null) : ?>
                                    <td style="display:none">
                                        <?php echo $facture->getReference(); ?>
                                        <input type="text" id="ligne_reference_<?php echo $i + 1; ?>" name="ligne_reference" value="<?php echo $facture->getReference(); ?>">
                                    </td>
                                    <td style="display:none">
                                        <?php echo $facture->getId(); ?>
                                        <input type="text" id="ligne_facture_id_<?php echo $i + 1; ?>" name="ligne_facture_id" value="<?php echo $facture->getId(); ?>">
                                    </td>
                                <?php else : ?>
                                    <td style="display:none">
                                        <?php echo $ligne->getReference(); ?>
                                        <input type="text" id="ligne_reference_<?php echo $i + 1; ?>" name="ligne_reference" value="<?php echo $ligne->getReference(); ?>">
                                    </td>
                                    <td style="display:none">
                                        <input type="text" id="ligne_facture_id_<?php echo $i + 1; ?>" name="ligne_facture_id" value="">
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endif;
                        $i++;
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>







<div class="col-xs-6" style="float: right;">
    <div class="widget-box">
        <div class="widget-body">
            <div class="widget-main">
                <form>
                    <table class="table table-bordered table-hover" style="width: 100%; margin-bottom: 0px;">
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
    function afficher() {

        if ($('#journal_id').val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/afficherEtatJournalSeul') ?>',
                data: 'journal_id=' + $('#journal_id').val(),
                success: function(data) {
                    $('#liste_etat_journal').html(data);

                }
            });
        }
    }
    var index_ligne = 0;
    var class_ligne = '';
    ligneNumber();
    detailsPiece();

    function detailsPiece() {
        $('#numero_externe').val('<?php echo $numero_externe; ?>');
        $('#reference').val('<?php echo $reference; ?>');
        $('#z_nature_piece').val('<?php echo $nature_libelle; ?>');
        var t_solde = $('#total_solde').val();
        if (parseFloat(t_solde) < 0) {
            t_solde = Math.abs(t_solde);
            $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
            $('#nature_solde').val('Créditeur');
        } else if (parseFloat(t_solde) > 0) {
            $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
            $('#nature_solde').val('Débiteur');
        } else {
            $('#detail_total_solde').val(parseFloat(t_solde).toFixed(3));
            $('#nature_solde').val('Soldé');
        }
    }

    function formatLigne(index) {
        $('#liste_ligne tbody tr').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background', '#E7E7E7');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');
    }

    function upLigne() {
        if (index_ligne >= 1) {
            index_ligne++;
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + '<?php echo $nature_id; ?>' +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + '<?php echo $piece->getJournalcomptable()->getIdTypeJournal() ?>' +
                    '&journal_id=' + '<?php echo $piece->getIdJournalcomptable() ?>' +
                    '&selected_compte=' + $('#hidden_ligne_compte_' + index_ligne).val() +
                    '&credit=' + $('#ligne_credit_' + index_ligne).val() +
                    '&debit=' + $('#ligne_debit_' + index_ligne).val() +
                    '&selected_contre=' + $('#hidden_ligne_contre_' + index_ligne).val(),
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
                $.ajax({
                    url: '<?php echo url_for('@addLigneSaisie') ?>',
                    async: true,
                    data: 'nature_id=' + '<?php echo $nature_id; ?>' +
                        '&numero_externe=' + $('#numero_externe').val() +
                        '&reference=' + $('#reference').val() +
                        '&type_journal_id=' + '<?php echo $piece->getJournalcomptable()->getIdTypeJournal() ?>' +
                        '&journal_id=' + '<?php echo $piece->getIdJournalcomptable() ?>' +
                        '&selected_compte=' + $('#hidden_ligne_compte_' + index_ligne).val() +
                        '&credit=' + $('#ligne_credit_' + index_ligne).val() +
                        '&debit=' + $('#ligne_debit_' + index_ligne).val() +
                        '&selected_contre=' + $('#hidden_ligne_contre_' + index_ligne).val(),
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
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + '<?php echo $nature_id; ?>' +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + '<?php echo $piece->getJournalcomptable()->getIdTypeJournal() ?>' +
                    '&journal_id=' + '<?php echo $piece->getIdJournalcomptable() ?>' +
                    '&selected_compte=' + '<?php echo $piece->getJournalcomptable()->getIdComptecontrepartie() ?>' +
                    '&credit=' + credit +
                    '&debit=' + debit +
                    '&selected_contre=' + '' +
                    '&libelle_ligne=' + $('#libelle_piece').val(),
                success: function(data) {
                    $('#liste_ligne tbody').append(data);
                    ligneNumber();
                    calculeTotal();
                }
            });
        }
    }

    function ajouterLigne() {
        if ($('#journal').val() != '-1') {
            var count_ligne = 0;
            $('#liste_ligne tbody tr').each(function() {
                count_ligne++;
            });
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + '<?php echo $nature_id; ?>' +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + '<?php echo $piece->getJournalcomptable()->getIdTypeJournal() ?>' +
                    '&journal_id=' + '<?php echo $piece->getIdJournalcomptable() ?>',
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
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable !</span>",
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
        }
    }

    function ajouterLastLigne() {
        if ($('#journal').val() != '-1') {
            $.ajax({
                url: '<?php echo url_for('@addLigneSaisie') ?>',
                async: true,
                data: 'nature_id=' + '<?php echo $nature_id; ?>' +
                    '&numero_externe=' + $('#numero_externe').val() +
                    '&reference=' + $('#reference').val() +
                    '&type_journal_id=' + '<?php echo $piece->getJournalcomptable()->getIdTypeJournal() ?>' +
                    '&journal_id=' + '<?php echo $piece->getIdJournalcomptable() ?>' +
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
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Veuillez déterminer le journal comptable !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    function supprimerLigne() {

        class_ligne = $('#ligne_' + index_ligne).attr('class');

        if (class_ligne != 'disabledbutton') {
            $('#ligne_' + index_ligne).remove();
            ligneNumber();
            calculeTotal();
            formatLigne(0);
        }
    }

    function ligneNumber() {
        var i = 0;
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
        $('[name="ligne_compte"]').each(function() {
            var id = 'ligne_compte_' + i;
            $(this).attr('id', id);
            //            var format = 'setLibelleCompte("' + i + '")';
            var format = 'chargerCompte("#ligne_compte_' + i + '", "#hidden_ligne_compte_' + i + '", "#ligne_compte_libelle_' + i + '")';
            $(this).attr('onkeyup', format);
            $(this).attr('onfocus', format);
            format = 'moveToNext(event, "ligne_compte", ' + i + ')';
            $(this).attr('onkeydown', format);
            //            var format = 'setLibelleCompte("' + i + '")';
            //            $(this).attr('onchange', format);
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
            //            var format = 'setLibelleContre("' + i + '")';
            //            $(this).attr('onchange', format);
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
        $('[name="checkk"]').each(function() {
            var id = 'check_' + i;
            $(this).attr('id', id);

            $(this).attr('index_ligne_chek', i);
            var affichesolde = 'affichersolde("' + i + '")';
            $(this).attr('onclick', affichesolde);
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
            index_tr++;
            if (credit != '' && credit != 0) {
                total_credit = parseFloat(total_credit) + parseFloat(credit);
                $(this).val(parseFloat(credit).toFixed(3));
                $('#ligne_debit_' + index_tr).attr('readonly', 'readonly');
                $('#button_debit_' + index_tr).attr('disabled', 'true');
                var solde_nouveua_credit = parseFloat(credit) + parseFloat($('#solde_credit_ancien_hidden').val());
                $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));
                var solde_nouveau_debit = parseFloat($('#solde_debit_ancien').val());
                $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));
                var solde = solde_nouveau_debit - solde_nouveua_credit;
                if (solde < 0) {
                    $('#solde_cerdit').val(parseFloat(Math.abs(solde)).toFixed(3));
                    $('#solde_debit').val('');
                } else {
                    $('#solde_debit').val(parseFloat(Math.abs(solde)).toFixed(3));
                    $('#solde_cerdit').val('');
                }
            } else {
                $('#ligne_debit_' + index_tr).removeAttr('readonly');
                $('#button_debit_' + index_tr).removeAttr('disabled');
                $(this).val('');
                if ($('#solde_credit_ancien_hidden').val() != '') {
                    var solde_nouveua_credit = parseFloat($('#solde_credit_ancien_hidden').val());
                    $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));
                }
            }
        });
        var total_debit = 0;
        $('[name="ligne_debit"]').each(function() {
            var debit = $(this).val();
            debit = eval(debit.replace(/,/g, '.'));
            debit = Math.abs(debit);
            if (isNaN(debit))
                debit = 0;
            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
            index_tr++;
            if (debit != '' && debit != 0) {
                total_debit = parseFloat(total_debit) + parseFloat(debit);
                $(this).val(parseFloat(debit).toFixed(3));
                var solde_nouveau_debit = parseFloat(debit) + parseFloat($('#solde_debit_ancien_hidden').val());
                $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));
                var solde_nouveua_credit = parseFloat($('#solde_credit_ancien_hidden').val());
                $('#sold_credit_nouveau').val((parseFloat(solde_nouveua_credit).toLocaleString()));
                var solde = solde_nouveau_debit - solde_nouveua_credit;
                if (solde < 0) {
                    $('#solde_cerdit').val((parseFloat(Math.abs(solde)).toLocaleString()));
                    $('#solde_debit').val('');
                } else {
                    $('#solde_debit').val((parseFloat(Math.abs(solde)).toLocaleString()));
                    $('#solde_cerdit').val('');
                }

                $('#ligne_credit_' + index_tr).attr('readonly', 'readonly');
                $('#button_credit_' + index_tr).attr('disabled', 'true');
            } else {
                $('#ligne_credit_' + index_tr).removeAttr('readonly');
                $('#button_credit_' + index_tr).removeAttr('disabled');
                $(this).val('');
                if ($('#solde_debit_ancien_hidden').val() != '') {
                    var solde_nouveau_debit = parseFloat($('#solde_debit_ancien_hidden').val());
                    $('#solde_debit_nouveau').val((parseFloat(solde_nouveau_debit).toLocaleString()));
                }
            }
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

    function numStr1(a, b) {
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

    function affichersolde(id) {


        //        if ($('#ligne_' + id).attr('style') && $('#check_' + id).is(':checked') == true) {
        //            $('#ligne_' + id).removeAttr('style');
        //            $('#check_' + id).prop("checked", false);
        //        } else {
        //            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
        //            $('#check_' + id).prop("checked", true);
        //
        //        }
        ////        console.log('style=' + ($('#ligne_' + id).attr('style') + 'checked=' + $('#check_' + id).is(':checked')));
        //        if ($('#check_' + id).is(':checked')) {
        //            $('#ligne_' + id).attr('style', 'background-color:  #e5e7e9 ;');
        //        } else {
        //            $('#ligne_' + id).removeAttr('style');
        //        }
        // $("input:checked").each(function () {
        //            var id = $(this).attr("id");
        ////              console.log(id);
        //            if ('#select_maq_' + id_selected != '#' + id)
        //                $('#' + id).prop("checked", false);
        //
        //        });

        $('input[name=check]').each(function() {
            var id_selected = $(this).attr("id");
            console.log(id_selected);
            if ('#check_' + id != '#' + id_selected)
                $('#' + id_selected).prop("checked", false);
            var index = 0;
            //            index_ligne_chek = $('#check_' + index).attr('index_ligne');
            var sThisVal = (this.checked ? "1" : "0");
            if (sThisVal == '1') {
                var solde_credit = 0;
                var solde_debit = 0;
                index_ligne++;
                var id_compte = $('#hidden_ligne_compte_' + index_ligne).val();
                if (id != '' || id_compte != '') {
                    $.ajax({
                        //                 index_ligne--;
                        dataType: 'json',
                        url: '<?php echo url_for('saisie_pieces/affichersolde2') ?>',
                        data: 'id=' + id + '&id_compte=' + id_compte,
                        success: function(data) {
                            //                            index_ligne--;
                            //                            if (data.soldeouv != '0.000' && data.typesolde == 1)
                            //                            {
                            //                                solde_credit = Math.abs(data.solde);
                            //                                solde_debit = 0;
                            //                            }
                            //                            if (data.soldeouv != '0.000' && data.typesolde == 2)
                            //                            {
                            //                                solde_debit = Math.abs(-data.solde);
                            //                                solde_credit = 0;
                            //                            }
                            //                            if (data.typesolde != 2 && data.typesolde != 1)
                            //                            {
                            if (data.crediteur != 0)
                            //                                {alert('14');
                            {
                                solde_credit = Math.abs(data.crediteur);
                                solde_debit = 0
                            }
                            if (data.debiteur != 0) {
                                solde_debit = Math.abs(data.debiteur);
                                solde_credit = 0;
                            }
                            //                            }
                            calculeTotal();
                            //                            var solde_debiteur=Intl.NumberFormat('en-US').format(parseFloat(solde_debit).toFixed(3));
                            $('#solde_debit_ancien').val((parseFloat(solde_debit).toLocaleString()));
                            $('#solde_credit_ancien').val((parseFloat(solde_credit).toLocaleString()));
                            $('#solde_debit_ancien_hidden').val(parseFloat(solde_debit).toFixed(3));
                            $('#solde_credit_ancien_hidden').val(parseFloat(solde_credit).toFixed(3));
                            $('#solde_debit_nouveau').val((parseFloat(solde_debit).toLocaleString()));
                            $('#sold_credit_nouveau').val((parseFloat(solde_credit).toLocaleString()));
                            $('#compte_comptable').val(data.numerocompte);
                        }
                    });
                }
            } else {
                $('#solde_debit_ancien').val('');
                $('#solde_credit_ancien').val('');
                $('#sold_credit_nouveau_hidden').val('');
                $('#solde_debit_ancien_hidden').val('');
                $('#solde_credit_nouveau').val('');
                $('#solde_debit_nouveau').val('');
                $('#solde_debit').val('');
                $('#solde_cerdit').val('');
                $('#compte_comptable').val('');
            }


        });
    }
    //    function calculeTotal() {
    //        var total_credit = 0;
    //        $('[name="ligne_credit"]').each(function () {
    //            var credit = $(this).val();
    //            credit = eval(credit.replace(/,/g, '.'));
    //            credit = Math.abs(credit);
    //            if (isNaN(credit))
    //                credit = 0;
    //            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
    //            index_tr++;
    //            if (credit != '' && credit != 0) {
    //                total_credit = parseFloat(total_credit) + parseFloat(credit);
    //                $(this).val(parseFloat(credit).toFixed(3));
    //                $('#ligne_debit_' + index_tr).attr('readonly', 'readonly');
    //                $('#button_debit_' + index_tr).attr('disabled', 'true');
    //            } else {
    //                $('#ligne_debit_' + index_tr).removeAttr('readonly');
    //                $('#button_debit_' + index_tr).removeAttr('disabled');
    //                $(this).val('');
    //            }
    //        });
    //        var total_debit = 0;
    //        $('[name="ligne_debit"]').each(function () {
    //            var debit = $(this).val();
    //            debit = eval(debit.replace(/,/g, '.'));
    //            debit = Math.abs(debit);
    //            if (isNaN(debit))
    //                debit = 0;
    //            var index_tr = $(this).parent('div').parent('td').parent('tr').attr('index_ligne');
    //            index_tr++;
    //            if (debit != '' && debit != 0) {
    //                total_debit = parseFloat(total_debit) + parseFloat(debit);
    //                $(this).val(parseFloat(debit).toFixed(3));
    //                $('#ligne_credit_' + index_tr).attr('readonly', 'readonly');
    //                $('#button_credit_' + index_tr).attr('disabled', 'true');
    //            } else {
    //                $('#ligne_credit_' + index_tr).removeAttr('readonly');
    //                $('#button_credit_' + index_tr).removeAttr('disabled');
    //                $(this).val('');
    //            }
    //        });
    //        var total_solde = parseFloat(total_debit) - parseFloat(total_credit);
    //        $('#total_credit').val(parseFloat(total_credit).toFixed(3));
    //        $('#total_debit').val(parseFloat(total_debit).toFixed(3));
    //        $('#total_solde').val(parseFloat(total_solde).toFixed(3));
    //        $('#detail_total_solde').html(parseFloat(total_solde).toFixed(3));
    //        if (total_solde > 0)
    //            $('#nature_solde').html('Débiteur');
    //        else if (total_solde < 0)
    //            $('#nature_solde').html('Créditeur');
    //        else
    //            $('#nature_solde').html('Soldé');
    //    }
    function setTypePieceShow() {
        var libelle_type_journal = $('#journal option:selected').attr('libelle_type_journal');
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

        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }

    function getSerieEdit() {


        //        setTypePieceShow();
        //        alert('de' + $('#journal').val() + 'fr' + $('#date').val());
        if ($('#journal_id').val() > -1 && $('#date').val() != '') {
            //            alert('de');
            var date_saisie = $('#date').val();
            var d1 = new Date(<?php echo date('Y') ?>, <?php echo date('m') ?>, <?php echo date('d') ?>);
            var date_s = date_saisie.split("-");
            var d2 = new Date(date_s[0], date_s[1], date_s[2]);
            if (d1 >= d2) {
                goGetSerieEdit(0);
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
                            goGetSerieEdit();

                        } else {
                            $('#date').focus();
                        }
                    }
                });
            }
        }
    }

    function solderPieceSelectionne() {
        console.log('selectionne=');
        //var count_ligne = 0;
        $('[name="checkk"]').each(function() {
            var id = $(this).attr("id");
            console.log('selectionne=' + id);
            if ($('#' + id).prop("checked") == true) {
                console.log('selectionnechched=' + id);
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
                        console.log('debit' + debit + 'index_ligne=' + index_ligne_chek);
                        $('#ligne_debit_' + index_ligne_chek).val(parseFloat(debit).toFixed(3));
                    }
                    if (credit != 0) {
                        console.log('crdit=' + credit + 'index_ligne=' + index_ligne_chek);
                        $('#ligne_credit_' + index_ligne_chek).val(parseFloat(credit).toFixed(3));

                    }
                }
            }
        });

        // ligneNumber();
        calculeTotal();
        // formatLigne(0);
    }

    function goGetSerieEdit() {
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
    $('.chosen-container').attr('style', 'width:100%');
    $('.chosen-container').trigger("chosen:updated");
    //    function ChoisirnaturepieceEdit(id1, id2) {
    ////        if ($(id2).val() != '') {
    //        $.ajax({
    //            url: '<?php // echo url_for('saisie_pieces/NaturePieceParCodeEdit')              
                        ?>',
    //            data: 'numero=' + $(id1).val(),
    //            success: function (data) {
    ////                data = response.data;
    ////                alert(response);
    ////                alert(response+'id='+id+'id_hiden'+id_hidden);
    ////                AjoutHtmlAfter(data, id, id_hidden);
    //                var data = JSON.parse(data);
    //                $(".testul ul").css('width', $(id1).width());
    //                htmlins = '';
    //                table = data;
    //                $(".testul").remove();
    //                if (data.length > 0) {
    //                    htmlins = '<div class="testul">' +
    //                            '<ul id="ul_compte" style="z-index: 9;">';
    //                    for (i = 0; i < data.length; i++) {
    //                        if (i == 0)
    //                            htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
    //                        else
    //                            htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
    //                    }
    //                    htmlins += '</ul></div>';
    //                }
    //                $(id1).after(htmlins);
    //
    //            }
    //        });
    //
    //    }
    //    function ChoisirJournalEdit(id1, id2) {
    //        if ($(id1).val() != '') {
    //            $.ajax({
    //                url: '<?php // echo url_for('saisie_pieces/JournalParCodeEdit')              
                            ?>',
    //                data: 'numero=' + $(id1).val(),
    //                success: function (data) {
    ////                data = response.data;
    ////                alert(response);
    ////                alert(response+'id='+id+'id_hiden'+id_hidden);
    ////                AjoutHtmlAfter(data, id, id_hidden);
    //                    var data = JSON.parse(data);
    //                    $(".testul ul").css('width', $(id1).width());
    //                    htmlins = '';
    //                    table = data;
    //                    $(".testul").remove();
    //                    if (data.length > 0) {
    //                        htmlins = '<div class="testul">' +
    //                                '<ul id="ul_compte" style="z-index: 9;">';
    //                        for (i = 0; i < data.length; i++) {
    //                            if (i == 0)
    //                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
    //                            else
    //                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
    //                        }
    //                        htmlins += '</ul></div>';
    //                    }
    //                    $(id1).after(htmlins);
    //
    //
    //                }
    //            });
    //        } else {
    //            $(id2).val('');
    //        }
    //    }
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

    function numStr1(a, b) {
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
</script>
<style>
    .display_none {
        display: none;
    }

    .text_align_right {
        text-align: right;
    }
</style>