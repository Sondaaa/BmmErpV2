<fieldset>
    <table class="disabledbutton">
        <tr>
            <td>
                <label>TOTAL H.TVA</label>
                <input type="text" id="detail_totalhtva"/>
            </td>
            <td>
                <label>Rabais, Remises ou Ristournes</label>
                <input type="text" id="detail_rrr" value="<?php echo $formlot->getObject()->getRrr() ?>"/>
            </td>
            <td>
                <label>TOTAL H.TVA APRES RRR</label>
                <input type="text" id="detail_totalaprrr">
            </td>
            <td>
                <label>T.V.A</label>
                <input type="hidden" id="detail_id_tva" value="<?php echo $formlot->getObject()->getIdTva() ?>">
                <input type="text" id="detail_tva" value="<?php echo $formlot->getObject()->getTva() ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label>TOTAL T.T.C</label>
                <input type="text" id="detail_ttcnet">
            </td>
            <td>
                <label>Reste T.T.C</label>
                <input type="text" id="detail_resteTtcnet" value="<?php echo $formlot->getObject()->getTtcnet() ?>">
            </td>
            <td>
                <label>Reste H.TAX</label>
                <input type="text" id="detail_resteHtax" value="<?php echo $formlot->getObject()->getTotalapresrrr() ?>">
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th></th>
                <th style="width: 80px"> N° du prix</th>
                <th>DESIGNATION DES TRAVAUX</th>
                <th>UNITE</th>
                <th>QUANTITE</th>
                <th>Prix Unitaire<br>HTVA</th>
                <th>Prix Total<br>HTVA</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="ligne in sousdetails| orderBy :'nordre'">
                <td><p ng-if="ligne.typeavenant === 'avenant   '" style="background-color: #ffaeae">Avenant</p></td>
                <td>{{ligne.nordre}}</td>
                <td>{{ligne.designation}}</td>
                <td>{{ligne.unite}}</td>
                <td>{{ligne.qte}}</td>
                <td>{{ligne.puht}}</td>
                <td>{{ligne.totalht}}</td>
            </tr>
        </tbody>
    </table>
</fieldset>