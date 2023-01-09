<div <?php if ($form->getObject()->isNew()) { ?> ng-init="Initialiserannee()" <?php }?>>
<fieldset class="col-lg-12">
    <legend>Formulaire Pour le demandeur</legend>
    <table>
        <tbody>
            <tr>
        <input type="hidden" id="id_conge" value="<?php if (!$form->getObject()->isNew()) { ?> <?php
            echo $conge->getId();
        }
        ?>">
        <td style="width: 10%"><label>Agents</label></td>
        <td style="width: 30%">
            <?php echo $form['id_agents']->renderError() ?>
            <?php echo $form['id_agents'] ?>
        </td>
        <td colspan="2" style="width: 30%">
            <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control">
            <input type="text" ng-model="nom.text" id="nom" placeholder="Nom & Prénom"   class="form-control">
        </td>
        <td colspan="2" style="width: 30%">
            <input type="text" ng-model="grade.text" id="grade" placeholder="Grade"  class="form-control">
            <input type="text" ng-model="poste.text" id="poste" placeholder="Poste"   class="form-control">
        </td>
        </tr>
        <tr>
            <td><label>  Type Congé  </label></td>
            <td>
                <?php echo $form['id_type']->renderError() ?>
                <?php echo $form['id_type'] ?>
            </td>
            <td colspan="2">
                <input type="text" ng-model="nbrjour.text" id="nbrjour" placeholder="Droit"  class="form-control">
                <input type="text" ng-model="paye.text" id="paye" placeholder="Payé"  class="form-control">
            </td>
            <td colspan="2"> 
                <textarea id="modalitecalcul" ng-model="modalitecalcul.text" placeholder="Modalité de Calcul"></textarea>
                <!--<input type="text" ng-model="nbrjour.text" id="nbrjour" placeholder="Droit"  class="form-control">-->
            </td>
        </tr>
        <tr>
            <td><label>  Date Début  </label></td>
            <td>
                <?php echo $form['datedebut']->renderError() ?>
                <?php echo $form['datedebut'] ?>
            </td>
            <td> <label>  Date Fin  </label></td>
            <td>
                <?php echo $form['datefin']->renderError() ?>
                <?php echo $form['datefin'] ?>
            </td>
            <!--<td >    <label> Nombre de Jour  </label></td>-->
            <td class="disabledbutton" colspan="2">
                <?php echo $form['nbrjour']->renderError() ?>
                <?php echo $form['nbrjour'] ?>
            </td>
        </tr>
        <tr>
            <td><label> Le Lieu de repos</label></td>
            <td>
                <?php echo $form['lieu']->renderError() ?>
                <?php echo $form['lieu'] ?>
            </td>
            <td><label>Signature</label></td>
            <td>
                <?php echo $form['signature']->renderError() ?>
                <?php echo $form['signature'] ?>
            </td>
            <td><label>Année</label></td>
            <td>
                <!--<input type="text" name="conge[annee]" id="conge_annee" class="class" <?php // if ($form->getObject()->isNew()) { ?> value="<?php // $conge->getDate(); ?>" <?php // } ?>>-->
                <?php echo $form['annee']->renderError() ?>
                <?php echo $form['annee'] ?>
            </td>
        </tr>
        </tbody>
    </table>

</fieldset>
<fieldset class="col-lg-12">
    <legend>Formulaire Pour le Responsable</legend>
    <table>
        <tbody>
            <tr>
                <td><label>  Sans objection  </label></td>
                <td>
                    <?php echo $form['objection']->renderError() ?>
                    <?php echo $form['objection'] ?>
                </td>
            </tr>
            <tr>
                <td><label> Date Début Validé  </label></td>
                <td>
                    <?php echo $form['datedebutvalide']->renderError() ?>
                    <?php echo $form['datedebutvalide'] ?>
                </td>
                <td><label> Date Fin Validé </label></td>
                <td>
                    <?php echo $form['datefinvalide']->renderError() ?>
                    <?php echo $form['datefinvalide'] ?>
                </td>
                <td><label> Nombre de Jour Validé </label></td>
                <td class="disabledbutton">
                    <?php echo $form['nbrjvalide']->renderError() ?>
                    <?php echo $form['nbrjvalide'] ?>
                </td>
            </tr>
            <tr>
                <td><label> Responsable</label></td>
                <td>
                    <?php echo $form['responsable']->renderError() ?>
                    <?php echo $form['responsable'] ?>
                </td>
                <td><label>Signature</label></td>
                <td colspan="3">
                    <?php echo $form['signatureresponsable']->renderError() ?>
                    <?php echo $form['signatureresponsable'] ?>
                </td>
            </tr>
        </tbody>
    </table>

</fieldset>
</div>