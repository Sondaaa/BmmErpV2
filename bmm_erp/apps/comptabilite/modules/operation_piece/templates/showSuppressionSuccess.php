<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" >
                <div class="mws-panel-header">
                    <span> Pièce n°: <?php echo $piece->getNumero() ?></span>
                </div>
                <table style="width: 90%; margin-left: 2%">
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
                                    <label class="mws-form-label" style="width: 100%">Date : (jj/mm/aaaa)</label>
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

                        <td style="width: 15%">
                            <!--                            <div class="mws-form-row">
                                                            <label class="mws-form-label" style="width: 100%">Nature Pièce :</label>
                                                        </div>-->
                        </td>

                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <label class="mws-form-label" style="width: 100%">N° Externe:</label>
                                                        </div>-->
                        </td>
                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <label class="mws-form-label" style="width: 100%">Référence:</label>
                                                        </div>-->
                        </td>
                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <label class="mws-form-label" style="width: 100%">Par Maquette:</label>
                                                        </div>-->
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%">
                            <div class="mws-form-row">
                                <input id="" type="text" value="<?php echo $piece->getJournalcomptable()->getLibelle() ?>" style="width: 85%" readonly="readonly">
                            </div>
                        </td>
                        <td style="width: 10%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="width: 100%">
                                    <input id="date" value="<?php echo date('d/m/Y', strtotime($piece->getDate())) ?>" type="text" style="width: 85%" >
                                </div>
                            </div>
                        </td>
                        <td style="width: 10%">
                            <div class="mws-form-row">
                                <input type="text" id="serie" value="<?php echo $piece->getNumeroseriejournal()->getPrefixe() ?>" class="large" style="width: 85%" readonly="readonly">
                            </div>
                        </td>
                        <td style="width: 10%">
                            <div class="mws-form-row" style="width: 100%">
                                <input type="text" id="numero" value="<?php echo $piece->getNumero() ?>" class="large" style="width: 85%" readonly="readonly" onchange="chargerPiece()" onblur="validerNumero()" ondblclick="activerNumero()">
                            </div>
                        </td>

                        <td style="width: 95%; display: none;" id="td_attendu">
                            <div class="mws-form-row" style="width: 100%">
                                <input type="text" id="attendu" class="large" style="width: 85%" readonly="readonly">
                            </div>
                        </td>

                        <td style="width: 15%">
                            <!--                            <div class="mws-form-row" style="width: 85%">
                                                            <select id="nature_piece" class="mws-select2 large" style="width: 100%">
                                                                <option value="-1"></option>
                                                                
                                                            </select>
                                                        </div>-->
                        </td>

                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <input id="numero_externe" onchange="verifierNumeroExterne()" class="large" type="text" style="width: 85%">
                                                        </div>-->
                        </td>
                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <input onkeyup="getPieceForLigne()" id="reference" class="large" type="text" style="width: 85%">
                                                        </div>-->
                        </td>
                        <td style="width: 10%">
                            <!--                            <div class="mws-form-row">
                                                            <select id="maquette" class="mws-select2 large" style="width: 85%">
                                                                <option></option>
                                                            </select>
                                                        </div>-->
                        </td>
                    </tr>
                </table>


                <div id="details_document" style="display: none;">

                </div>

                <div class="mws-panel-header">
                    <span>Détails Pièce</span>
                </div>
                <!--                <div style="width: 100%">
                                    <table style="margin-top: 2%">
                                        <tr>
                                            <td style="width: 50%">
                                                <div class="mws-form-row">
                                                    <label class="mws-form-label">Libellé :</label>
                                                    <div class="mws-form-item">
                                                        <input class="large" type="text" disabled="disabled">
                                                        <input class="large" type="text" disabled="disabled" style="display: none;">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <label class="mws-form-label">Solde :</label>
                                                    <div class="mws-form-item">
                                                        <input class="large" type="text" disabled="disabled" style="width: 95%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <label class="mws-form-label">Nature Solde :</label>
                                                    <div class="mws-form-item">
                                                        <input class="large" type="text" disabled="disabled" style="width: 95%">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>-->
                <!--                <div class="mws-panel-toolbar">
                                    <div class="btn-toolbar">
                                        <div class="btn-group" style="width: 100%">
                                            <a onclick="nouveauSaisiePieces()" class="btn" style="float: left"><i class="icol-add"></i> Nouvelle</a>
                                            <a href="#" class="btn" style="float: left"><i class="icol-lock"></i> Bloquer</a>
                                            <a href="#" class="btn" style="float: left"><i class="icol-cross"></i> Annuler</a>
                                            <a href="#" class="btn" style="float: left"><i class="icol-cross-shield"></i> Supprimer</a>
                                            <a onclick="validerPiece()" class="btn" style="float: left"><i class="icol-accept"></i> Valider</a>
                                            <a onclick="brouillonPiece()" class="btn" style="float: left"><i class="icol-page-white-text-width"></i> Brouillon</a>
                                            <a onclick="insererLigne()" class="btn" style="float: right"><i class="icol-arrow-right"></i> Inserer Ligne</a>
                                            <a onclick="supprimerLigne()" class="btn" style="float: right"><i class="icol-cross-shield"></i> Supprimer Ligne</a>
                                            <a onclick="ajouterLigne()" class="btn" style="float: right"><i class="icol-add"></i> Ajouter Ligne</a>
                                        </div>
                                    </div>
                                </div>-->
                <div class="mws-panel-body no-padding">
                    <table class="mws-table" id="liste_ligne">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Numéro du Compte</th>
                                <th>Débit</th>
                                <th>Crédit</th>
                                <th>Libellé</th>
                                <th>Contre Partie</th>
                                <th style="display: none;">Nature id</th>
                                <th>Nature</th>
                                <th>N° Externe</th>
                                <th style="display: none;">Référence</th>
                                <th style="display: none;">document</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 10px;">
                    <table>
                        <tr>
                            <td style="width: 33%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Total Débit :</label>
                                    <div class="mws-form-item">
                                        <input class="large" id="total_debit" type="text" disabled="disabled" value="<?php echo $piece->getTotalDebit() ?>">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 33%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Total Crédit :</label>
                                    <div class="mws-form-item">
                                        <input class="large" id="total_credit" type="text" disabled="disabled" value="<?php echo $piece->getTotalCredit() ?>">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 33%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Total Solde : </label>
                                    <div class="mws-form-item">
                                        <input class="large" id="total_solde" type="text" disabled="disabled" value="<?php echo number_format($piece->getTotalDebit() - $piece->getTotalCredit(), 3, '.', ' ') ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>

    </div> 
</div>
<div class="mws-panel grid_8" style="float: left">
    <div class="mws-panel-body no-padding">
        <table style="width: 100%">
            <tr>
                <td>
                    <a class="btn btn-primary" style="float: right; margin-right: 3%; cursor:pointer;" href="<?php echo url_for('saisie_pieces/listePiece') ?>"><i class="icol-cross"></i> Fermer</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<script  type="text/javascript">

    function fermer() {
        $('#form_show_piece').fadeOut();
        $('#form_liste_piece').delay(500).fadeIn();
    }

</script>