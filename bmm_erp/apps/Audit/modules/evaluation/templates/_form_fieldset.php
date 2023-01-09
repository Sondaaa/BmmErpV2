<fieldset <?php if (!$form->getObject()->isNew()) { ?> ng-init="initiliserevaluation(<?php echo $evaluation->getId() ?>)" <?php } ?>>
    <table>
        <tbody>
            <tr>
                <td><label>Agents</label></td>
                <td <?php if (!$form->getObject()->isNew()): ?>class="disabledbutton"<?php endif; ?>>
                    <?php echo $form['id_agents']->renderError() ?>
                    <?php echo $form['id_agents'] ?>
                </td>
                <td>Formation</td>
                <td <?php if (!$form->getObject()->isNew()): ?>class="disabledbutton"<?php endif; ?>>
                    <input type="hidden" id="libelle_besoins" value="<?php echo $evaluation->getBesoinsdeformation()->getBesoins() ?>">
                    <?php $mags = Doctrine_Core::getTable('besoinsdeformation')->findAll(); ?>
                    <input type="hidden" id="idbesoins" value="<?php
                    if (!$form->getObject()->isNew()): echo $evaluation->getBesoinsdeformation()->getId();
                    endif;
                    ?>">
                    <select id="magFormation">
                        <option></option>
                        <?php foreach ($mags as $magFormation) { ?>
                            <option <?php if ($magFormation->getId() == $evaluation->getIdFormation()): ?>selected="true"<?php endif; ?> value="<?php echo $magFormation->getId() ?>"><?php echo $magFormation ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr class="disabledbutton">                
                <td>
                    <input type="text" ng-model="grade.text" id="grade" placeholder="Grade" class="form-control">
                    <input type="text" ng-model="directionEval.text" id="directionEval" placeholder="Direction" class="form-control">
                </td>
                <td>
                    <input type="text" ng-model="lieu.text" id="lieu" placeholder="Lieu de Travail" class="form-control">
                    <input type="text" ng-model="poste.text" id="poste" placeholder="Poste" class="form-control">
                </td>
                <td colspan="2">
                    <input type="text" ng-model="sousrubirque.text" id="sousrubirque" placeholder="Sous Rubirque" class="form-control">
                    <input type="text" ng-model="theme.text" id="theme" placeholder="Thème de Formation" onfocus="this.select();" class="form-control">
                </td>
            </tr>
            <tr class="disabledbutton">
                <td></td>
                <td>
                    <input type="text" ng-model="formateur.text" id="formateur_evaluation" placeholder="Formateur" class="form-control">
                    <input type="text" ng-model="organisme.text" id="organisme_evaluation" placeholder="Organisme de Formation" class="form-control">
                </td>
                <td>
                    <input type="text" ng-model="dated.text" id="dated" placeholder="Date deubut de Formation" class="form-control">
                    <input type="text" ng-model="datef.text" id="datef" placeholder="Date Fin de Formation" class="form-control">
                </td>
                <td>
                    <input data='fixed' style="height: 50px" type="text" ng-model="durre.text" id="durre" placeholder="Durée (Nbre Jour)" class="form-control">
                </td>
            </tr>
            <tr>
                <td><label> Évaluat°.Condit°. d'Hébérgement et de restauration</label></td>
                <td onfocus="this.select();">
                    <?php if (!$form->getObject()->isNew()): ?> 
                        <input type="hidden" id="conditionheberegement">
                        <select name="evaluation[conditionslogement]" id="evaluation_conditionslogement" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option <?php if ($form->getObject()->getConditionslogement() == 0): ?>selected="true"<?php endif; ?> value="0">0</option>
                            <option <?php if ($form->getObject()->getConditionslogement() == 1): ?>selected="true"<?php endif; ?> value="1">1</option>
                            <option <?php if ($form->getObject()->getConditionslogement() == 2): ?>selected="true"<?php endif; ?> value="2">2</option>
                            <option <?php if ($form->getObject()->getConditionslogement() == 3): ?>selected="true"<?php endif; ?> value="3">3</option>
                        </select>
                    <?php else: ?>
                        <select name="evaluation[conditionslogement]" id="evaluation_conditionslogement" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    <?php endif; ?>
                    <?php //echo $form['conditionslogement']->renderError() ?>
                    <?php //echo $form['conditionslogement']    ?>
                </td>
                <td><label>Évaluat°. Conditi°. matériellles  </label></td>
                <td>
                    <?php if (!$form->getObject()->isNew()): ?>  
                        <input type="hidden" id="noteorganise">
                        <select name="evaluation[notecomposant]" id="evaluation_notecomposant" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option <?php if ($form->getObject()->getNotecomposant() == 0): ?>selected="true"<?php endif; ?> value="0">0</option>
                            <option <?php if ($form->getObject()->getNotecomposant() == 1): ?>selected="true"<?php endif; ?> value="1">1</option>
                            <option <?php if ($form->getObject()->getNotecomposant() == 2): ?>selected="true"<?php endif; ?> value="2">2</option>
                            <option <?php if ($form->getObject()->getNotecomposant() == 3): ?>selected="true"<?php endif; ?> value="3">3</option>
                        </select>
                    <?php else: ?>
                        <select name="evaluation[notecomposant]" id="evaluation_notecomposant" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    <?php endif; ?>
                    <?php //echo $form['notecomposant']->renderError() ?>
                    <?php //echo $form['notecomposant']    ?>
                </td>
            </tr>
            <tr>
                <td><label>Évaluation de la performance du Formateur </label></td>
                <td>
                    <?php if (!$form->getObject()->isNew()): ?>  
                        <input type="hidden" id="notefor">
                        <select name="evaluation[noteformateur]" id="evaluation_noteformateur" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option <?php if ($form->getObject()->getNoteformateur() == 0): ?>selected="true"<?php endif; ?> value="0">0</option>
                            <option <?php if ($form->getObject()->getNoteformateur() == 1): ?>selected="true"<?php endif; ?> value="1">1</option>
                            <option <?php if ($form->getObject()->getNoteformateur() == 2): ?>selected="true"<?php endif; ?> value="2">2</option>
                            <option <?php if ($form->getObject()->getNoteformateur() == 3): ?>selected="true"<?php endif; ?> value="3">3</option>
                        </select>
                    <?php else: ?>
                        <select name="evaluation[noteformateur]" id="evaluation_noteformateur" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    <?php endif; ?>
                    <?php //echo $form['noteformateur']->renderError() ?>
                    <?php //echo $form['noteformateur']    ?>
                </td>
                <td><label>Degré d'atteinte de l'objectif </label></td>
                <td>
                    <?php if (!$form->getObject()->isNew()): ?>  
                        <input type="hidden" id="degre">
                        <select name="evaluation[evaluation[degreobjectif]]" id="evaluation_degreobjectif" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option <?php if ($form->getObject()->getDegreobjectif() == 0): ?>selected="true"<?php endif; ?> value="0">0</option>
                            <option <?php if ($form->getObject()->getDegreobjectif() == 1): ?>selected="true"<?php endif; ?> value="1">1</option>
                            <option <?php if ($form->getObject()->getDegreobjectif() == 2): ?>selected="true"<?php endif; ?> value="2">2</option>
                            <option <?php if ($form->getObject()->getDegreobjectif() == 3): ?>selected="true"<?php endif; ?> value="3">3</option>
                        </select>
                    <?php else: ?>
                        <select name="evaluation[degreobjectif]" id="evaluation_degreobjectif" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    <?php endif; ?>

                    <?php //echo $form['degreobjectif']->renderError() ?>
                    <?php //echo $form['degreobjectif'] ?>

                </td>
            </tr>
            <tr>
                <td><label>Structure et Contenue du Programme </label></td>
                <td>
                    <?php if (!$form->getObject()->isNew()): ?>  
                        <input type="hidden" id="structure">
                        <select name="evaluation[evaluation[structureprog]]" id="evaluation_structureprog" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option <?php if ($form->getObject()->getStructureprog() == 0): ?>selected="true"<?php endif; ?> value="0">0</option>
                            <option <?php if ($form->getObject()->getStructureprog() == 1): ?>selected="true"<?php endif; ?> value="1">1</option>
                            <option <?php if ($form->getObject()->getStructureprog() == 2): ?>selected="true"<?php endif; ?> value="2">2</option>
                            <option <?php if ($form->getObject()->getStructureprog() == 3): ?>selected="true"<?php endif; ?> value="3">3</option>
                        </select>
                    <?php else: ?>
                        <select name="evaluation[structureprog]" id="evaluation_structureprog" class="chosen-select form-control" style="display: none;">
                            <option value=""></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    <?php endif; ?>
                    <?php //echo $form['structureprog']->renderError() ?>
                    <?php //echo $form['structureprog'] ?>

                </td>
            </tr>
            <tr>
                <td><label> Les Connaissances générales acquises</label></td>
                <td>
                    <?php echo $form['connaissanceaquise']->renderError() ?>
                    <?php echo $form['connaissanceaquise'] ?>
                </td>
                <td><label>Les Nouvelles compétences acquises </label></td>
                <td>
                    <?php echo $form['competance']->renderError() ?>
                    <?php echo $form['competance'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Observation et Recommandation</label></td>
                <td colspan="3">
                    <?php echo $form['observation']->renderError() ?>
                    <?php echo $form['observation'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<div>
    0: Faible  <label></label>
    1: Moyen <label></label>
    2: Bon <label></label>
    3: Exellent <label></label>
</div>