<li <?php if ($form->getObject()->isNew()) echo "style='display:none'" ?>>
    <a data-toggle="tab" href="#messages" ng-click="InialiserPieceJoint()" >
        <i class="green ace-icon fa fa-money bigger-120"></i>
        Piéce Jointes
    </a>
</li> 
<fieldset>
    <legend>Fiche d'engagement</legend>
    <table>
        <tbody>
            <tr class="disabledbutton">
                <td><label>Type</label></td>
                <td colspan="4">
                    <?php echo $form['id_type']->renderError() ?>
                    <?php echo $form['id_type'] ?>
                </td>
            </tr>
            <tr class="disabledbutton">
                <td><label>Numéro</label></td>
                <td colspan="4">
                    <?php echo $form['numero']->renderError() ?>
                    <?php
                    if ($form->getObject()->isNew())
                        echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(1)));
                    else
                        echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                    ?>
                </td>
            </tr>
            <tr>
                <td><label>Date Création</label></td>
                <td>
                    <?php echo $form['datecreation']->renderError() ?>
                    <?php echo $form['datecreation'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset>
    <legend>Informations sur le Budget</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Exercice</label></td>
                <td>
                    <?php
                    $date = $_SESSION['exercice_budget'];
                    if (!$form->getObject()->isNew() && $form->getObject()->getDatecreation()) {
                        $date = date('Y', strtotime($form->getObject()->getDatecreation()));
                    }
                    echo $date;
                    ?>
                </td>
            </tr>
            <tr>
                <td><label>Budget</label></td>
                <td colspan="2">
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
                            <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                <?php echo $budget->getLibelle() ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
                <td ><label>N°D'engagement</label></td>
                <td colspan="2" >
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
    <legend>Action</legend>
    <input type="submit" value="Mettre à jour">
</fieldset>
<div id="messages" class="tab-pane fade"   >
    <fieldset>
        <legend>Fiche Pièces Jointes</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Référence</label></td>
                    <td colspan="3">
                        <input type="text" class="form-control" id="ref">
                    </td>
                </tr>
                <tr>
                    <td><label>Type</label></td>
                    <td style="width: 100%">
                        <?php
                        $type = new Typepiecejointbudget();
                        $types = Doctrine_Core::getTable('typepiecejointbudget')->findAll();
                        ?>
                        <select id="typepiece">
                            <option value="0">Sélectionnez</option>
                            <?php
                            foreach ($types as $t) {
                                $type = $t;
                                ?>
                                <option  value="<?php echo $type->getId() ?>"  >
                                    <?php echo $type->getLibelle() ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Pièces-Jointes</label></td>
                    <td>
                        <select id="piece">

                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <legend>Action</legend>
        <input type="button" value="Ajouter" ng-click="AjouterLignePiece()">
    </fieldset>
    <fieldset>
        <legend>Liste des Pièces Jointes</legend>
        <table>
            <thead>
                <tr>
                    <td>Référence</td>
                    <td>Type</td>
                    <td>Document</td> 
                    <td>TTC net</td> 
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="ligne in listespieces">
                    <td>{{ligne.ref}}</td>
                    <td>{{ligne.type}}</td>
                    <td>{{ligne.doc}}</td>
                    <td>{{ligne.mnt}}</td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <p style="font-size: 18px;float: right">Total: {{total}}</p>
        <input type="button" value="Valider" ng-click="AjouterPieceJoint(<?php echo $form->getObject()->getIdBudget() ?>,<?php echo $form->getObject()->getId() ?>)">
        </tr>
        </tfoot>
    </fieldset>
</div>