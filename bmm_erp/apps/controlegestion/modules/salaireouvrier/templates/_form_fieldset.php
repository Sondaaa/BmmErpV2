<div class="col-lg-10" ng-controller="CtrlRessourcehumaine">
    <fieldset >

        <table>
            <tbody>
                <tr>
                    <td><label>Choisir l'Ouvrier </label></td>
                    <td>
                        <?php echo $form['id_contratouvrier']->renderError() ?>
                        <?php echo $form['id_contratouvrier'] ?>
                    </td>

<!--                    <td><label>Chantier </label></td>
                    <td> 
                        <input type="text" value="" ng-model="chantier.text" id="chantier" autocomplete="off"  class="form-control disabledbutton" placeholder="Chantier">
                    </td>
                </tr> 
                <tr>
                    <td><label>Situation adminstratif </label></td>
                    <td> 
                        <input type="text" value="" ng-model="situation.text" id="situation" autocomplete="off"  class="form-control disabledbutton" placeholder="Situation Adminstrative">
                    </td>
                    <td><label>Montant/Jour  </label></td>
                    <td> 
                        <input type="text" value="" ng-model="montantjour.text" id="montantjour" autocomplete="off"  class="form-control disabledbutton" placeholder="Montant/Jour ">
                    </td>-->
                </tr>

            </tbody>
        </table>

        <table>
            <thead>
            <legend>Historique des contrats</legend>
            <tr>   
                <!--<th>Date de recrutement<span class="align2">(تاريخ الإنتداب )</span></th>--> 
                <th>Date debut contrat <span class="align2">(بداية العقد )</span></th>
                <th>date  fin contrat <span class="align2">(نهاية العقد)</span></th>
                <th>Nbr Jour <span class="align2">(عددالأيام )</span> </th>
                <th>Montant <span class="align2"> (الأجر اليومي)</span></th>

                <th>Spécilaité <span class="align2">(الاختصاص) </span></th>
                <th>Lieu d'affectation <span class="align2">(مكان العمل)</span></th>
                <th>Situation administrative <span class="align2">(الوضع الاداري  )</span></th>
                <th>Chantier <span class="align2">(الحضيرة)</span> </th> 
                <th>Montant Total<span class="align2"> (الأجر )</span></th>

            </tr>
            </thead>
            <tbody>
                <tr ng-repeat="ligne in listesHistorique">
                    <!--<td>{{ligne.datere}}</td>-->
                    <td>{{ligne.dated}}</td>
                    <td>{{ligne.datef}}</td>
                    <td>{{ligne.nbrj}}</td>
                    <td>{{ligne.montant}}</td>
                    <td>{{ligne.specialite}}</td>
                    <td>{{ligne.lieu}}</td>
                    <td>{{ligne.situation}}</td>
                    <td>{{ligne.chantier}}</td>
                    <td>{{ligne.montantotal}}</td>

                </tr>
            </tbody>
        </table>

    </fieldset>
    <fieldset style="margin-left: 90%;">
        <table style="width: 250px"><tr><td>
        
            <!--<input data="fixed" type="text" id="montanttotal" placeholder="Montant Total " style="width: 40px">-->
            <?php echo $form['salaire']->renderError() ?>
            <?php echo $form['salaire'] ?>
       </td></tr></table>
    </fieldset>
</div>
<style>

    .align2{
        float: right;
        /*        margin-right: 10px;*/

    }

</style>