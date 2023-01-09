<div id="sf_admin_container" >
    <h1 id="replacediv">Nouvelle fiche d'ordonnance de paiement</h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="CtrlFormOrdonnance" ng-init="InialiserOrdonnance()" >
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home" ng-click="InialiserOrdonnance()">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Ordonnance de paiement
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" >
                        <fieldset>
                            <legend>Imputation Budgetaire </legend>
                            <table>
                                <tbody>
                                    <tr class="disabledbutton">
                                        <td><label>Type</label></td>
                                        <td colspan="5">
                                            <?php echo $form['id_type']->renderError() ?>
                                            <?php echo $form['id_type'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Date Création</label></td>
                                        <td>
                                            <?php echo $form['datecreation']->renderError() ?>
                                            <?php echo $form['datecreation'] ?>
                                        </td>
                                        <td><label>Numéro</label></td>
                                        <td colspan="5" class="disabledbutton">
                                            <?php echo $form['numero']->renderError() ?>
                                            <?php
                                            if ($form->getObject()->isNew())
                                                echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(2)));
                                            else
                                                echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Exercice:</label><?php
                                            $date = $_SESSION['exercice_budget'];
                                            if (!$form->getObject()->isNew() && $form->getObject()->getDatecreation()) {
                                                $date = date('Y', strtotime($form->getObject()->getDatecreation()));
                                            }
                                            echo $date;
                                            ?>
                                        </td>
                                        <td colspan="2">
                                            <label>Budget</label>
                                            <?php
                                            $ligne = new Ligprotitrub();
                                            $annees = $_SESSION['exercice_budget'];
                                            $budgets = Doctrine_Query::create()
                                                            ->select("*")
                                                            ->from('titrebudjet')
                                                            ->where("Etatbudget=2")
                                                            ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                            ->andwhere("trim(typebudget)  like trim('Exercice:" . $annees . "')  ")
                                                            ->orderBy('id asc')->execute();
                                            //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
                                            if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) {
                                                $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdBudget());
                                                if ($l)
                                                    $ligne = $l;
                                            }
                                            ?>
                                            <select id="budget">
                                                <option value="0">Sélectionnez</option>
                                                <?php foreach ($budgets as $budget) { ?>
                                                    <option  value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                                        <?php echo $budget->getLibelle() ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <label>N°D'engagement</label>
                                            <input type="hidden" id="id_budget" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) echo $form->getObject()->getIdBudget(); ?>">
                                            <select id="numeroengaement" name="numeroengaement">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Rubrique</label></td>
                                        <td colspan="6">
                                            <input type="text" class="form-control" id="rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Crédits alloués</label></td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, ',', '.'); ?>" id="mnt" >

                                        </td>
                                        <td><label>Crédits consommés</label></td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre() && $ligne->getMntdeponser()) echo number_format($ligne->getMntdeponser(), 3, ',', '.'); ?>" id="credit">
                                        </td>
                                        <td><label>Reliquat</label></td>
                                        <td>
                                            <input type="text" class="form-control" value="
                                            <?php
                                            $mntdeponser = 0;
                                            if ($ligne->getMntdeponser())
                                                $mntdeponser = $ligne->getMntdeponser();
                                            $relicat = $ligne->getMnt() - $mntdeponser;
                                            if ($ligne && $ligne->getIdTitre())
                                                echo number_format($relicat, 3, ',', '.');
                                            ?>
                                                   " id="reliq">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Pièces Jointes</legend>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Numéro document</th>
                                        <th>Type</th>
                                        <th>Mnt TTC.NET</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="document in listesdocuments">
                                        <td><input id="cheked_id{{document.idpi}}" type="checkbox" ng-click="Valider(document.idpi, document.numero)"></td>
                                        <td>{{document.prefixetype}}{{document.numero}}</td>
                                        <td>{{document.libelle}}</td>
                                        <td>{{document.mntttc}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <fieldset style="width: 30%">
                            <legend >Action</legend>
                            <input type="button" value="Valider" ng-click="AjouterOrdonnace()">
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>