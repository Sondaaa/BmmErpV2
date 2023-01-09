<fieldset>
    <table class="disabledbutton">
        <tr>
            <td>
        <lable>TOTAL H.TVA</lable>
        <input type="text" id="detail_totalhtva">
        </td>
        <td style="width: 200px">
        <lable>Rabais, Remises ou Ristourne</lable>
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
            <th></th>
            <th></th>
            <th>Prix unitaire<br>
                HTVA</th>
            <th>Prix Total<br> 
                HTVA</th>


        </tr>

        <tr ng-repeat="ligne in sousdetails| orderBy :'nordre'">
            <td>{{ligne.nordre}}</td>
            <td>{{ligne.designation}}</td>
            <td>{{ligne.unite}}</td>
            <td>{{ligne.qte}}<br><p ng-if="ligne.ancienqte>0" style="background-color: red;color: white;">{{ligne.ancienqte}}</p></td>
            <td style="width: 120px;"  ><input ng-if="ligne.qte>0" type="text" id="qte{{ligne.idsousdetail}}" ></td>
            <td><input type="button" ng-if="ligne.qte>0" ng-click="ValiderVarite(ligne.idsousdetail)" value="OK"></td>
            <td>{{ligne.puht}}</td>
            <td>{{ligne.totalht}}</td>

        </tr>
    </table>

</fieldset>
