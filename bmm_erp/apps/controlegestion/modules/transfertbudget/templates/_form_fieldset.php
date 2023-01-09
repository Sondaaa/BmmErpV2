<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="col-sm-12" >
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>
                            Fiche de transfert
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#scan">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Documents justificatif de transfert
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" ng-init="InitialiseSelectedValue()">
                        <fieldset>
                            <legend>Données de transfert</legend>
                            <?php if ('NONE' != $fieldset): ?>
                                <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
                            <?php endif; ?>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;"><label>Date de Création</label></td>
                                        <td>
                                            <?php echo $form['datecreation']->renderError() ?>
                                            <?php echo $form['datecreation']; ?>
                                        </td>
                                        <td style="vertical-align: middle;"><label>Type de transfert</label></td>
                                        <td>
                                            <?php echo $form['id_typetransfert']->renderError() ?>
                                            <?php echo $form['id_typetransfert'] ?>
                                        </td>
                                    </tr>
                            </table>
                            <?php
                             $annees = $_SESSION['exercice_budget'];
//                            $annees = date('Y');
                            $budgets = Doctrine_Query::create()
                                            ->select("*")
                                            ->from('titrebudjet')
//                                            ->where("Etatbudget=2")
                                            ->andwhere("trim(typebudget) not like trim('Prototype')")
                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                                            ->orderBy('id asc')->execute();
                            ?>
                            <table>
                                <tr>
                                    <td style="width: 50%"> 
                                        <fieldset>
                                            <legend>Budget Source</legend>
                                            <table>
                                                <tr id="row_budget">
                                                    <td style="width: 40%">
                                                        <input type="hidden" id="maxtransfert">
                                                        <label>Budget</label>
                                                        <?php
                                                        $ligne = new Ligprotitrub();
                                                        if (!$form->getObject()->isNew() && $form->getObject()->getIdSource()) {
                                                            $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdSource());
                                                            if ($l)
                                                                $ligne = $l;
                                                        }
                                                        ?>
                                                        <select id="budget">
                                                            <option value="0">Sélectionnez</option>
                                                            <?php foreach ($budgets as $budget) { ?>
                                                            <option value="<?php echo $budget->getId() ?>">
                                                                <!--<option value="<?php // echo $budget->getId() ?>" <?php // if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >-->
                                                                    <?php echo $budget->getLibelle() ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" id="budget_source_value" value="<?php if ($ligne) echo $ligne->getIdTitre(); ?>">
                                                    </td>
                                                    <td colspan="2" >
                                                        <label>N° D'engagement</label>
                                                        <input type="hidden" id="id_budget" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdSource()) echo $form->getObject()->getIdSource(); ?>">
                                                        <select id="numeroengaement" name="numeroengaement">

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <label id="label_source">Source Externe</label>
                                                        <?php echo $form['sourcebudget']->renderError() ?>
                                                        <?php echo $form['sourcebudget']->render(array('ng-keydown' => 'AfficheSourceExterne()')) ?>
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #87B87F;color: white">
                                                    <td colspan="3">
                                                        <label>Montant transféré </label>
                                                        <?php echo $form['mnttransfert']->renderError() ?>
                                                        <?php echo $form['mnttransfert']->render(array("ng-keydown" => "VerifierMontant()")) ?>
                                                    </td>
                                                </tr>
                                                <tr id="detail_source" style="background-color: #366b43;color: #fff;font-size: 18px">

                                                </tr>
                                            </table>
                                        </fieldset>
                                    </td>
                                    <td style="width: 50%">
                                        <fieldset>
                                            <legend>Budget Destination</legend>
                                            <table>
                                                <tr>
                                                    <td style="width: 40%" id="zone_budgetdestination">
                                                        <label>Budget</label>
                                                        <?php
                                                        $ligne = new Ligprotitrub();
                                                        if (!$form->getObject()->isNew() && $form->getObject()->getIdDestination()) {
                                                            $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdDestination());
                                                            if ($l)
                                                                $ligne = $l;
                                                        }
                                                        ?>
                                                        <select id="budgetdestination">
                                                            <option value="0">Sélectionnez</option>
                                                            <?php foreach ($budgets as $budget) { ?>
                                                            <option value="<?php echo $budget->getId() ?>">
                                                                <!--<option value="<?php // echo $budget->getId() ?>" <?php // if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >-->
                                                                    <?php echo $budget->getLibelle() ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        
                                                        <input type="hidden" id="budget_destination_value" value="<?php if ($ligne) echo $ligne->getIdTitre(); ?>">
                                                    </td>
                                                    <td colspan="2">
                                                        <label>N° D'engagement</label>
                                                        <input type="hidden" id="id_budget_destination" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdDestination()) echo $form->getObject()->getIdDestination(); ?>">
                                                        <select id="numeroengaementdestination" name="numeroengaementdestination">

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="detail_dest" style="background-color: #366b43;color: #fff;font-size: 18px">

                                                </tr>
                                            </table>
                                        </fieldset>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td colspan="2" style="display: none">
                                        <label id="label_sourceinterne">Source Interne </label>
                                        <?php echo $form['id_source']->renderError() ?>
                                        <?php echo $form['id_source'] ?>
                                    </td>
                                    <td style="display: none">
                                        <label>Destination</label>
                                        <?php echo $form['id_destination']->renderError() ?>
                                        <?php echo $form['id_destination'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label>Objectif </label>
                                        <?php echo $form['objectif']->renderError() ?>
                                        <?php echo $form['objectif'] ?>
                                    </td>
                                    <td colspan="2"><label>Description</label>
                                        <?php echo $form['description']->renderError() ?>
                                        <?php echo $form['description'] ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php include_partial('transfertbudget/form_actions', array('transfertbudget' => $transfertbudget, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
                        </fieldset>
                    </div>                    
                    <div id="scan" class="tab-pane fade">
                        <?php
                        if (!$form->getObject()->isNew()) {
                            $id = $form->getObject()->getId();
                            $transfert = $form->getObject();
                            include_partial('Scan/formscantransfert', array('id' => $id, 'transfert' => $transfert));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>
</div>

<style>
    
    label{font-weight: bold;}
    
</style>