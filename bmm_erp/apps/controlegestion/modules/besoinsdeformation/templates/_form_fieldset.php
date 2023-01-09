<input type="hidden" id="besoinsdeformation_id"  value="<?php
if (!$form->getObject()->isNew())
   
  echo $form->getObject()->getId();
else
    echo "";
?> ">

<div <?php if (!$form->getObject()->isNew()) { ?> ng-init="Afficheanne(<?php  echo $besoinsdeformation->getId() ?>)" <?php } ?>>
    <fieldset >
        <table>
            <tbody>
                <tr>
                    <td ><label> Agents   </label></td>
                    <td ><!-- style="display: none"-->
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
            <input type="hidden" id="id_contrat">
            
            <input type="hidden" id="id_poste">
            
            <input type="hidden" id="id_unite">
            
                    <td colspan="2">
                        <input type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control">


                        <input type="text" ng-model="nom.text" id="nom" placeholder="Nom"   class="form-control">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>

                        <input type="text" ng-model="directionrh.text" id="directionrh" placeholder="Direction" onfocus="this.select();" class="form-control">


                        <input type="text" ng-model="sousdirectionrh.text" id="sousdirectionrh" placeholder="Sous Direction"   class="form-control">

                    </td>


                    <td colspan="2">

                        <input type="text" ng-model="servicerh.text" id="servicerh" placeholder="Service" onfocus="this.select();" class="form-control">


                        <input type="text" ng-model="uniterh"  id="uniterh" placeholder="Unité " onfocus="this.select();" class="form-control">

                    </td>
                </tr>
                <tr><td></td>
                    <td colspan="4">

                        <input type="text" ng-model="poste.text" id="poste" placeholder="Poste "  onfocus="this.select();" class="form-control">

                    </td>
                </tr>
                <tr>
                    <td ><label> Compétance Requises </label></td>
                    <td >
                        <?php echo $form['competance']->renderError() ?>
                        <?php echo $form['competance'] ?>
                    </td>
                    <td ><label> Besoin  en Formation </label></td>
                    <td colspan="2">
                        <?php echo $form['besoins']->renderError() ?>
                        <?php echo $form['besoins'] ?>
                    </td>


                </tr>
                <tr>
                    <td><label>Année</label></td>
                    <td>
                        <input type="text" name="besoinsdeformation[annee]" id="besoinsdeformation_annee" class="class" <?php if ($form->getObject()->isNew()) { ?> value="<?php $besoinsdeformation->getDate(); ?>" <?php } ?>>
                        <?php // echo $form['annee']->renderError() ?>
                        <?php //  echo $form['annee'] ?> 
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
   
</div>