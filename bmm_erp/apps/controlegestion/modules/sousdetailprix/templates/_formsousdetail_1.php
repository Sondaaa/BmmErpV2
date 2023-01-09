<fieldset>
    <table class="disabledbutton">
        <tr>
            <td>
        <lable>TOTAL H.TVA</lable>
        <input type="text" id="detail_totalhtva">
        </td>
        <td style="width: 200px">
        <lable>Rabais, Remises ou Ristournes</lable>
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
            <th style="width: 80px">
                N° du prix
            </th>
            <th>DESIGNATION DES TRAVAUX</th>
            <th>UNITE</th>
            <th>QUANTITE</th>
            <th>Prix unitaire<br>
                HTVA</th>
            <th>Prix Total<br> 
                HTVA</th>

            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $form['nordre']//->render(array('class' => 'disabledbutton'))     ?></td>
            <td><?php echo $form['designation'] ?></td>
            <td><?php echo $form['id_unite'] ?></td>
            <td><?php echo $form['quetiteant'] ?></td>
            <td><?php echo $form['prixunitaire']->render(array('ng-model' => "uht", 'ng-change' => 'CalculerTotal()')) ?></td>
            <td><?php echo $form['prixthtva'] ?></td>

            <td><input type="button" value="+" ng-click="AjouterSousdetailPrix_1()"></td>
        </tr>
        <tr ng-repeat="ligne in sousdetails| orderBy :'nordre'">
            <td>{{ligne.nordre}}</td>
            <td>{{ligne.designation}}</td>
            <td>{{ligne.unite}}</td>
            <td>{{ligne.qte}}</td>
            <td>{{ligne.puht}}</td>
            <td>{{ligne.totalht}}</td>
            <td ng-if="ligne.idsousdetail === ''">
                <button class="btn btn-warning btn-xs" ng-click="UpdateSousDetail(ligne.nordre)">
                    <i class="ace-icon fa fa-wrench  bigger-110 icon-only"></i>
                </button>
                <button class="btn btn-warning btn-xs" ng-click="DeletesousDetail(ligne.nordre)">
                    <i class="ace-icon fa fa-remove  bigger-110 icon-only"></i>
                </button>

            </td>
            <td ng-if="ligne.idsousdetail != ''">
                <button class="btn btn-warning btn-xs" ng-click="DeletesousDetail(ligne.nordre)">
                    <i class="ace-icon fa fa-remove  bigger-110 icon-only"></i>
                </button>
            </td>
        </tr>
    </table>

    <input type="button" value="Valider le sous détail " ng-click="ValiderSousDetail(<?php echo $formlot->getObject()->getId() ?>, 2)">
    
</fieldset>
