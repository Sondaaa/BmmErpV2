<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <div class="mws-panel-header"><span>Paramétrage du Résultat</span></div>
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
                            <td style="padding-left: 2%;" colspan="4">PRODUITS D'EXPLOITATION</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Revenus</td>
                            <td style="text-align: center;">
                                5-1
                                <input value="5-1" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Autres produits d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Production immobilisée</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Total des produits d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 2%;" colspan="4">CHARGES D'EXPLOITATION</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Variation des produits en cours</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Achats d'approvisionnements consommés</td>
                            <td style="text-align: center;">
                                5-2
                                <input value="5-2" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Charges de personnel</td>
                            <td style="text-align: center;">
                                5-3
                                <input value="5-3" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Dotations aux amortissements et provisions</td>
                            <td style="text-align: center;">
                                5-4
                                <input value="5-4" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Autres charges d'exploitation</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Total des charges d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">Résultat d'exploitation</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>


                        <tr>
                            <td style="padding-left: 8%;">Charges financières nettes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Produits des placements</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Autres gains ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 8%;">Autres pertes ordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                               
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">Résultat des activités ordinaires avant impôt</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 8%;">Impôt sur les bénéfices</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;">Résultat des activités ordinaires après impôt</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 8%;">Eléments extraordinaires</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Résultat net de l'exercice</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 8%;">Effets des modifications comptables</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_2">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Résultat après modifications comptables</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>