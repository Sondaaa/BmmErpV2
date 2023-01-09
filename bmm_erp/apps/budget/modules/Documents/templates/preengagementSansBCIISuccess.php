<div id="sf_admin_container">
    <h1 id="replacediv">
        Fiche d'engagement définitif
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <div class="tab-content" ng-controller="myCtrlbudget" <?php if (!$form->getObject()->isNew()) { ?> ng-init="InitialiseSelectedValue()" <?php } ?>>
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="disabledbutton">
                                <td><label>Type</label></td>
                                <td colspan="4">
                                    <input type="hidden" id="typeenga" value="<?php
                                    $typebudget = 1;
                                    if ($form->getObject()->isNew())
                                        echo '1';
                                    else
                                        echo $form->getObject()->getIdType();
                                    $type_budgets = TypedocbudgetTable::getInstance()->findAll();
                                    ?>">
                                    <select id="documentbudget_id_type">
                                        <option value="0">Sélectionnez</option>
                                        <?php foreach ($type_budgets as $type_budget) { ?>
                                            <option value="<?php echo $type_budget->getId() ?>" <?php if ($type_budget->getId() == $typebudget) echo 'selected="selected"' ?>>
                                                <?php echo $type_budget->getLibelle() ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="disabledbutton">
                                <td><label>Numéro</label></td>
                                <td colspan="4">
                                    <?php echo $form['numero']->renderError() ?>
                                    <?php
                                    if ($form->getObject()->isNew())
                                        echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(3)));
                                    else
                                        echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Date Création</label></td>
                                <td>
                                    <?php echo $form['datecreation']->renderError() ?>
                                    <?php echo $form['datecreation']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Description</label></td>
                                <td>
                                    <?php echo $form['description']->renderError() ?>
                                    <?php echo $form['description']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-8">
                    <fieldset>
                        <legend>Informations sur le Budget </legend>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Exercice</td>
                                    <td colspan="5">
                                        <?php
                                        $date = $_SESSION['exercice_budget'];
                                        echo $date;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Budget</td>
                                    <td>
                                        <?php
                                        $annees = $_SESSION['exercice_budget'];
                                        $budgets = Doctrine_Query::create()
                                                ->select("*")
                                                ->from('titrebudjet')
                                                ->where("Etatbudget=2")
                                                ->andwhere("trim(typebudget) not like trim('Prototype') ")
                                                ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                                                ->orderBy('id asc')
                                                ->execute();
                                        ?>

                                        <select id="budget">
                                            <option value="0">Sélectionnez</option>
                                            <?php foreach ($budgets as $budget) { ?>
                                                <option value="<?php echo $budget->getId() ?>" <?php
                                                if (!$form->getObject()->isNew()) :
                                                    if ($documentbudget->getLigprotitrub()->getIdTitre() == $budget->getId()) {
                                                        ?> selected="selected" <?php }
                                            endif;
                                                ?>>
                                                <?php echo $budget->getLibelle() ?>
                                                </option>
<?php } ?>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Rubrique</td>
                                    <td>
                                        <div id="div_select"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sous Rubrique</td>
                                    <td>
                                        <input type="hidden" id="numeroengaement">
                                        <input type="text" class="form-control" readonly="true" id="rubrique" value="">
                                    </td>
                                    <td>Montant</td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php
                                        if (!$form->getObject()->isNew()) {
                                            if ($documentbudget)
                                                echo $documentbudget->getMnt();
                                        }
                                        ?>" id="mntttc_horsbci">
                                    </td>
                                </tr>

                                <tr class="disabledbutton">

                                    <td colspan="2">
                                        <div class="bg bg-info"><h4>Crédit Réservé</h4></div>
                                        <ul>
                                            <li>Alloué: <input type="text" class="form-control" value="<?php // if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, ',', ' ');               
                                        ?>" id="mnt"></li>
                                            <li>Bloqué: <input type="text" class="form-control" value="<?php // if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntencaisse(), 3, ',', ' ');               
                                        ?>" id="mntencaisser"></li>
                                        </ul>
                                        <div class="bg bg-danger"><h4>Crédit Engagé</h4></div>
                                        <ul>

                                            <li>Définitive: <input type="text" class="form-control" value="<?php // if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage()) echo number_format($ligne->getMntengage(), 3, ',', ' ');               
                                        ?>" id="credit"></li>
                                            <li>Provisoire: <input type="text" class="form-control" value="<?php // if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntprovisoire(), 3, ',', ' ');           
                                        ?>" id="creaditporv"></li>

                                            <li>Total: <input type="text" class="form-control" value="<?php // if ($ligne && $ligne->getIdTitre()) echo number_format($total, 3, ',', ' ');               
                                        ?>" id="total_engage"></li>
                                        </ul>
                                    </td>



                                    <td colspan="2">
                                        <div class="bg bg-warning"><h4>Reliquat</h4></div>
                                        <?php
                                        $mntengager = 0;
                                        $relicat = 0;
                                        $mntprovisoire = 0;
                                        $relicatprovisoire = 0;
                                        ?>
                                        <ul>
                                            <li>Définitive: <input type="text" class="form-control" value="<?php echo number_format($relicat, 3, ",", " "); ?>" id="reliq"></li>
                                            <?php
                                            $mntengager = 0;
                                            $relicat = 0;
                                            $mntprovisoire = 0;
                                            $relicatprovisoire = 0;
                                            ?>
                                            <li>Provisoire+Définitive: <input type="text" class="form-control" value="<?php echo number_format($relicatprovisoire, 3, ',', ' ') ?>" id="reliqprovisoire"></li>
                                        </ul>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Action</legend>
                        <input type="button" value="Mettre à ajour" ng-controller="myCtrldoc" ng-click="ValiderEngagementDefSansBCI(<?php
                                            if (!$form->getObject()->isNew()) {
                                                if ($documentbudget)
                                                    echo $documentbudget->getId();
                                            }
                                            ?>)">
                        <a href="<?php echo url_for('documentbudget_DocumentDef') ?>" class="btn btn-white btn-primary1">
                            <i class="ace-icon fa fa-undo bigger-110"></i>Retour à la liste</a>
                        <?php if ($id) { ?>
                            <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire') . '?idfiche=' . $form->getObject()->getId() ?>">
                                Exporter Pdf & Impression <?php echo $form->getObject()->getTypedocbudget() ?>
                            </a>
                        <?php } ?>

                    </fieldset>
                </div>
            </div>



        </div>
    </div>
</div>