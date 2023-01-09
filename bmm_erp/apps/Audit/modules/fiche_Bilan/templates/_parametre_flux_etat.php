<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <div class="mws-panel-header"><span>Paramétrage des Flux MA</span></div>
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
                            <td style="padding-left: 2%;" colspan="4">Flux de trésorerie liés à l'exploitation</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Résultat net</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Ajustements pour</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Amortissements et provisions</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Variation des :</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 11%;">- Stocks</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 11%;">- Créances</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 11%;">- Fournisseurs et autres dettes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Plus ou moins values de cession</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 8%;">Transfert de charges</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
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
                            <td style="padding-left: 5%;">Acquisitions d'immobilisations</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Cessions d'immobilisations</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Acquisitions d'immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Cessions d'immobilisations financières</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
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
                            <td style="padding-left: 5%;">Encaissements suite à l'émission de parts sociales</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Distribution dividendes</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Encaissements provenant des emprunts</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Remboursements d'emprunts</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Flux de trésorerie liés aux activités de financement</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Incidence des variations des taux de change sur les</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">liquidités et équivalents de liquidités</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Variation de trésorerie</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>

                        <tr>
                            <td style="padding-left: 5%;">Trésorerie au début de l'exercice</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 5%;">Trésorerie à la clôture de l'exercice</td>
                            <td style="text-align: center;">
                                <input value="" type="hidden" name="note_3">
                            </td>
                            <td style="text-align: center;">
                               
                            </td>
                            <td style="text-align: center;">
                                
                            </td>
                        </tr>

                        <tr style="background-color: #D5D5D5;">
                            <td style="padding-left: 2%;" colspan="2">Variation de trésorerie</td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>