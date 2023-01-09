<fieldset>
    <table class="disabledbutton">
        <tr>
            <td>
                <label><br>TOTAL H.TVA</label>
                <input type="text" id="detail_totalhtva">
            </td>
            <td style="width: 200px">
                <label>Rabais, Remises ou Ristournes</label>
                <input type="text" id="detail_rrr" value="<?php echo $formlot->getObject()->getRrr() ?>">
            </td>
            <td>
                <label><br>TOTAL H.TVA APRES RRR</label>
                <input type="text" id="detail_totalaprrr">
            </td>
            <td style="width: 90px">
                <label><br>T.V.A</label>
                <input type="hidden" id="detail_id_tva" value="<?php echo $formlot->getObject()->getIdTva() ?>">
                <input type="text" id="detail_tva" value="<?php echo $formlot->getObject()->getTva() ?>">
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <label>TOTAL T.T.C</label>
                <input type="text" id="detail_ttcnet">
            </td>
            <td colspan="4">
                <label>Reste T.T.C</label>
                <input type="text" id="detail_resteTtcnet" value="<?php echo $formlot->getObject()->getTtcnet() ?>">
            </td>
            <td colspan="4">
                <label>Reste H.TAX</label>
                <input type="text" id="detail_resteHtax" value="<?php echo $formlot->getObject()->getTotalapresrrr() ?>">
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 7%;">N° du prix</th>
                <th style="width: 30%;">DESIGNATION DES TRAVAUX</th>
                <th style="width: 15%;">UNITE</th>
                <th style="width: 11%;">QUANTITE</th>
                <th style="width: 14%;">Prix unitaire<br>HTVA</th>
                <th style="width: 14%;">Prix Total<br>HTVA</th>
                <th style="width: 9%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $form['nordre']//->render(array('class' => 'disabledbutton'))       ?></td>
                <td><?php echo $form['designation'] ?></td>
                <td><?php echo $form['id_unite'] ?></td>
                <td><?php echo $form['quetiteant'] ?></td>
                <td><?php echo $form['prixunitaire']->render(array('ng-model' => "uht", 'ng-change' => 'CalculerTotal()')) ?></td>
                <td><?php echo $form['prixthtva'] ?></td>
                <td style="text-align: center;"><input type="button" value="+" ng-click="AjouterSousdetailPrix_1()"></td>
            </tr>
            <tr ng-repeat="ligne in sousdetails| orderBy :'nordre'">
                <td>{{ligne.nordre}}</td>
                <td>{{ligne.designation}}</td>
                <td>{{ligne.unite}}</td>
                <td>{{ligne.qte}}</td>
                <td>{{ligne.puht}}</td>
                <td>{{ligne.totalht}}</td>
                <td style="text-align: center;" ng-if="ligne.idsousdetail === ''">
                    <button class="btn btn-warning btn-xs" ng-click="UpdateSousDetail(ligne.nordre)">
                        <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
                    </button>
                    <button class="btn btn-warning btn-xs" ng-click="DeletesousDetail(ligne.nordre)">
                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                    </button>
                </td>
                <td style="text-align: center;" ng-if="ligne.idsousdetail != ''">
                    <button class="btn btn-warning btn-xs" ng-click="DeletesousDetail(ligne.nordre)">
                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <input type="button" style="float: right;" value="Valider le sous détail" ng-click="ValiderSousDetail(<?php echo $formlot->getObject()->getId() ?>, 2)">
</fieldset>
