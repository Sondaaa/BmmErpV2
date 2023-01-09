<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Fiche Suivi Solde Caisse</h4>
            </div>
            <?php $caisses = CaissesbanquesTable::getInstance()->getAllCaisse(); ?>
            <div class="widget-body" ng-controller="CtrlMouvement" >
                <div class="widget-main" style="padding-bottom: 0px;" ng-init="InitiliserCaisseanque('<?php // echo $id;      ?>')">
                    <fieldset>
                        <table class="table  table-bordered table-hover" >
                            <tbody>
                                <tr>
                                    <td>Caisse</td>
                                    <td >
                                        <select  id="id_caisse" class="chosen-select form-control" >
                                            <option value="0"></option>
                                            <?php foreach ($caisses as $caisse):
                                                ?>

                                                <option value="<?php echo $caisse->getId() ?>">
                                                    <?php echo $caisse->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>Solde Départ</td>
                                    <td class="disabledbutton">
                                        <input type="text" id="sold_depart" ng-model="soldedepart.text" ng-value="{{soldedepart.text}}" >
                                        <input type="hidden" id="sold_depart_hidden" >
                                    </td>

                                    <td>Nouveau Solde</td>
                                    <td class="disabledbutton"> 
                                        <input type="text" id="nsolde" ng-model="soldefinal.text" ng-value="{{soldefinal.text}}" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Informations sur Caisse</legend>
                        <table style="margin-bottom: 0px;width: 100%" class="table  table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="margin-bottom: 0px;" class="table  table-bordered table-hover" >
                                            <thead>
                                                <tr style="background-color: #F2F2F2">
                                                    <th style="width: 10%;">Exercice</th>
                                                    <th style="width: 30%;">Caisse</th>
                                                    <th style="width: 30%;">Code</th>
                                                    <th>Solde</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $date = date('Y');
                                                        echo $date;
                                                        ?>
                                                    </td>
                                                    <td class="disabledbutton">
                                                        <input type="text" id="caisse" style="width: 100%"  ng-model="caisse.text" ng-value="{{caisse.text}}">
                                                    </td>
                                                    <td class="disabledbutton">
                                                        <input type="text" id="code"  style="width: 100%" ng-model="code.text" ng-value="{{code.text}}">
                                                    </td>

                                                    <td class="disabledbutton">
                                                        <input type="text" id="sold_final"    ng-model="soldefinal.text" ng-value="{{soldefinal.text}}">
                                                        <input type="hidden" id="solde_final_hidden"    ng-model="sold_final_hidden.text" ng-value="{{sold_final_hidden.text}}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>
                                        <table style="margin-bottom: 0px;" class="table  table-bordered table-hover" >
                                            <thead>
                                                <tr style="background-color: #F2F2F2">
                                                    <th >Quitances</th>
                                                    <th>Solde Mvts Caisse</th>
                                                    <th>Solde  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="disabledbutton">
                                                    <td>  
                                                        <ul>
                                                            <li>Définitif: <input type="text" class="form-control align_right" value="" id="mntquitanceP" >
                                                                <input type="hidden" class="form-control align_right" value="" id="mntquitanceP_hidden" ></li>
                                                            <li>Provisoire: <input type="text" class="form-control align_right" value="" id="mntquitanceD" >
                                                                <input type="hidden" class="form-control align_right" value="" id="mntquitanceD_hidden" ></li>

                                                            <li>Total: <input type="text" class="form-control align_right" value="" id="total_quitance" >
                                                                <input type="hidden" class="form-control align_right" value="" id="total_quitance_hidden" ></li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>Recettes: <input type="text" class="form-control align_right" value="" id="recete">
                                                                <input type="hidden" class="form-control align_right" value="" id="recete_hidden"></li>
                                                            <li>Dépenses: <input type="text" class="form-control align_right" value="" id="depense" >
                                                                <input type="hidden" class="form-control align_right" value="" id="depense_hidden" ></li>
                                                            <!--recette-depense -->
                                                            <li>Solde: <input type="text" class="form-control align_right" value="" id="total_caisse" ></li>
                                                             <input type="hidden" class="form-control align_right" value="" id="total_caisse_hidden" >
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <!--solde(recette-depense)+total+solde depard -->
                                                            <li>Solde Avec Quitance : <input type="text" class="form-control align_right" value="<?php // echo $relicat          ?>" id="solde_avecquitance"></li>
                                                            <li>Solde Sans Quitance : <input type="text" class="form-control align_right" value="<?php // echo number_format($relicatprvisoire_defi, 3, ',', ' ');          ?>" id="solde_sansquitance"></li>
                                                            <!--<li>Total: <input type="text" class="form-control align_right" value="<?php // echo number_format($total, 3, ',', ' ');         ?>" id="total_solde_quitance" ></li>-->
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
