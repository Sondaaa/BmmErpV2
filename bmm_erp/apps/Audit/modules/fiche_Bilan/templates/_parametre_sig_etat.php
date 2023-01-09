<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <div class="mws-panel-header"><span>Paramétrage du Solde Intermediaire de Gestion (SIG)</span></div>
                <table class="mws-table" id="liste_ligne" style="font-weight: bold;">
                    <thead>
                        <tr>
                            <th style="width: 30%;"></th>
                            <th style="width: 10%; text-align: center;">Notes</th>
                            <th style="width: 30%; text-align: center;">31/12/<?php echo $_SESSION['exercice']; ?></th>
                            <th style="width: 30%; text-align: center;">31/12/<?php echo $_SESSION['exercice'] - 1; ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td style="width: 100%;padding: 0" colspan="4">
                                <div id="list_bilan_pager" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left"></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>

                        <tr>
                            <td style="padding-left: 5%;">Produits d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Production Immobilisée</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">Production</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Coût des matières consommées</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">Production</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Déstokage de production</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Production immobilisée</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">PRODUCTION DE L'EXERCICE</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Achats consommés</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">ACTIVITE TOTALE</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Marge brute totale</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Subvention d'éxploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Autres charges externes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">VALEUR AJOUTEE BRUTE</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Cessions d'immobilisations Impôts et taxes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Charges de personnel</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">EXCEDENT BRUT D'EXLOITATION</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Produits financièrs nets</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Produits des placements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Autres gains ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Autres pertes ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Transfert et reprise de charges</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Dotation aux amortissements et aux provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Impôt sur le résultat ordinaire</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">RESULTAT DES ACTIVITES ORDINAIRES</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Eléments extraordinaires net d'impôt</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Effets des modifications comptables net d'impôt</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_4">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Résultat net après modifications comptables</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>