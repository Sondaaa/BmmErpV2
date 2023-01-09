<fieldset>
    <table class="disabledbutton">
        <tr>
            <td>
                <label>TOTAL H.TVA</label>
                <input type="text" id="detail_totalhtva">
            </td>
            <td>
                <label>Rabais, Remises ou Ristournes</label>
                <input type="text" id="detail_rrr" value="<?php echo $formlot->getObject()->getRrr() ?>">
            </td>
            <td>
                <label>TOTAL H.TVA APRES RRR</label>
                <input type="text" id="detail_totalaprrr">
            </td>
            <td style="width: 90px">
                <label>T.V.A</label>
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
        <tr>
            <th style="width: 80px">N° du prix</th>
            <th>DESIGNATION DES TRAVAUX</th>
            <th>UNITE</th>
            <th>QUANTITE</th>
            <th>Prix unitaire<br>HTVA</th>
            <th>Prix Total<br>HTVA</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $form['nordre']//->render(array('class' => 'disabledbutton'))    ?></td>
            <td><?php echo $form['designation'] ?></td>
            <td><?php echo $form['id_unite'] ?></td>
            <td><?php echo $form['quetiteant']->render(array('ng-model' => "ligne_qte", 'ng-change' => 'CalculerTotal()')) ?></td>
            <td><?php echo $form['prixunitaire']->render(array('ng-model' => "uht", 'ng-change' => 'CalculerTotal()')) ?></td>
            <td><?php echo $form['prixthtva'] ?></td>
            <td style="text-align: center;"><input type="button" value="+" ng-click="AjouterSousdetailPrix()"></td>
        </tr>
        <tr ng-repeat="ligne in sousdetails| orderBy :'nordre'">
            <td style="text-align: center;">{{ligne.nordre}}</td>
            <td>{{ligne.designation}}</td>
            <td>{{ligne.unite}}</td>
            <td style="text-align: center;">{{ligne.qte}}</td>
            <td style="text-align: right;">{{ligne.puht}}</td>
            <td style="text-align: right;">{{ligne.totalht}}</td>
            <td style="text-align: center;">
                <button class="btn btn-warning btn-xs" ng-click="UpdateSousDetail(ligne.nordre)">
                    <i class="ace-icon fa fa-wrench  bigger-110 icon-only"></i>
                </button>
                <button class="btn btn-warning btn-xs" ng-click="DeletesousDetail(ligne.nordre)">
                    <i class="ace-icon fa fa-remove  bigger-110 icon-only"></i>
                </button>
            </td>
        </tr>
    </table>
    <input type="button" value="Valider le sous détail" ng-click="ValiderSousDetail(<?php echo $formlot->getObject()->getId() ?>, 1)">
    <input type="button" value="Valider le sous détail & fermer" ng-click="ValiderSousDetail(<?php echo $formlot->getObject()->getId() ?>, 2)">
</fieldset>
