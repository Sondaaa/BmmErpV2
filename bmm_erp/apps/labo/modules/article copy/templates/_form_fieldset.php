<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset) : ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

</fieldset>
<fieldset ng-init="Initialiser(<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)">
    <legend>Données fiche</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Numéro Fiche</label></td>
                <td style="">
                    <?php echo $form['numero']->renderError() ?>
                    <?php
                    if ($form->getObject()->isNew())
                        $numero = $article->getNumeroseqfiche();
                    else
                        $numero = $form->getObject()->getNumero();
                    ?>
                    <?php echo $form['numero']->render(array('class' => 'disabledbutton', 'value' => $numero)) ?>
                </td>
                <td><label>Date création</label></td>
                <td>
                    <?php echo $form['datecreation']->renderError() ?>
                    <?php echo $form['datecreation']->render(array('value' => date('Y-m-d'), 'min' => date('Y-m-d'), 'max' => date('Y-m-d'))) ?>
                </td>
                <td>
                    <label>Emetteur </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['id_user']->renderError() ?>
                    <?php echo $form['id_user'] ?>
                </td>
                <?php $user = UtilisateurTable::getInstance()->find($sf_user->getAttribute('userB2m')->getId()); ?>
                <input type="hidden" id="article_stocable" name="article[stocable]" value="true">
                <!-- <input type="hidden" id="article_id_emplacement" name="article[id_emplacement]" value="<?php //if ($user && $user->getLaboName()) echo $user->getLaboName()->getId(); ?>"> -->
            </tr>

        </tbody>
    </table>
</fieldset>
<div class="col-lg-6">
    <fieldset>
        <legend>Données de Classification</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Type de stock</label></td>
                    <td style="">
                        <?php echo $form['id_typestock']->renderError() ?>
                        <?php echo $form['id_typestock'] ?>
                    </td>

                    <td><label>Fabricant</label></td>
                    <td style="">
                        <?php echo $form['id_fabriquant']->renderError() ?>
                        <?php echo $form['id_fabriquant'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Famille</label></td>
                    <td>
                        <?php echo $form['id_famille']->renderError() ?>
                        <?php echo $form['id_famille'] ?>
                    </td>
                    <td>
                        <label>Code famille </label>
                    </td>
                    <td>
                        <?php echo $form['codefamille']->renderError() ?>
                        <?php echo $form['codefamille'] ?>
                    </td>

                </tr>
                <tr>
                    <td><label>Sous Famille</label></td>
                    <td>
                        <div style="display: none">
                            <?php echo $form['id_sousfamille']->renderError() ?>
                            <?php echo $form['id_sousfamille'] ?>
                        </div>
                        <select id="sfamille" ng-model="sfamille">
                            <option ng-repeat="sf in sousfamille" value="{{sf.id}}">
                                Code:{{sf.code}}/ {{sf.libelle}}
                            </option>
                        </select>

                    </td>
                    <td>
                        <label>Code Sous Famille </label>
                    </td>
                    <td>
                        <?php echo $form['codesf']->renderError() ?>
                        <?php echo $form['codesf'] ?>
                    </td>

                </tr>
                <tr>

                    <!-- <td>
                        <label>Nature </label>
                    </td>
                    <td>
                        <?php //echo $form['id_nature']->renderError() ?>
                        <?php //echo $form['id_nature'] ?>
                    </td> -->
                    <!-- <td>
                        <label>Code Nature </label>
                    </td>
                    <td>
                        <?php // echo $form['codenature']->renderError() ?>
                        <?php //echo $form['codenature'] ?>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>
<div class="col-lg-6">
    <fieldset>
        <legend>Données de base</legend>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#home" ng-click="InialiserArticle()">
                    <i class="green ace-icon fa fa-home bigger-120"></i>
                    Article
                </a>
            </li>
            <?php if (!$form->getObject()->isNew()) { ?>
                <li>
                    <a data-toggle="tab" href="#cara" ng-click="InialiserCarac(<?php echo $form->getObject()->getId() ?>); AfficheCar(<?php echo $form->getObject()->getId() ?>)">
                        Caractéristique
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <table>
                    <tbody>
                        <tr>
                        <td>
                                <label>Ancien Code d'Article</label>
                                <?php echo $form['anciencode']->renderError() ?>
                                <?php echo $form['anciencode'] ?>
                            </td>
                            
                            <td colspan="3">
                            <label>Désignation</label>
                                <?php echo $form['designation']->renderError() ?>
                                <?php echo $form['designation'] ?>
                            </td>
                        </tr>
                        <tr>
                       
                            <td class="disabledbutton">
                                <label>Code d'Article</label>
                                <?php echo $form['codeart']->renderError() ?>
                                <?php echo $form['codeart']->render() ?>
                            </td>
                            <td>
                                <label>Unité </label>
                                <?php echo $form['id_unite']->renderError() ?>
                                <?php echo $form['id_unite'] ?>
                            </td>
                            <td>
                                <label>T.V.A </label>
                                <?php echo $form['id_tva']->renderError() ?>
                                <?php echo $form['id_tva'] ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <?php if (!$form->getObject()->isNew()) { ?>
                <div id="cara" class="tab-pane fade">
                    <?php
                    $formcra = new LignecararticleForm();
                    $lignecararticle = new Lignecararticle();
                    include_partial('lignecararticle/formligne', array('lignecararticle' => $lignecararticle, 'form' => $formcra));
                    ?>
                </div>
            <?php } ?>
        </div>
    </fieldset>
</div>

<div class="col-lg-12">
    <fieldset>
        <legend>Données de Planification</legend>
        <div class="col-lg-4">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#stock">
                        Stock Total
                    </a>
                </li>
                <?php
                if (!$form->getObject()->isNew()) {
                    $stockmag = Doctrine_Core::getTable('stock')->findByIdArticle($form->getObject()->getId());
                    foreach ($stockmag as $stock) {
                ?>
                        <li>
                            <a data-toggle="tab" href="#stock_<?php echo $stock->getId(); ?>">
                                <?php echo $stock->getMagasin(); ?>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>

            <div class="tab-content">
                <div id="stock" class="tab-pane fade in active">
                    <table class="disabledbutton">
                        <tbody>
                            <tr>
                                <td><label>Prix Unitaire HT </label></td>
                                <td>
                                    <?php echo $form['aht']->renderError() ?>
                                    <?php echo $form['aht'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>PAMP </label></td>
                                <td>
                                    <?php echo $form['pamp']->renderError() ?>
                                    <?php echo $form['pamp'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Stock Réel en Qte </label></td>
                                <td>
                                    <?php echo $form['stockreel']->renderError() ?>
                                    <?php echo $form['stockreel'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Stock Théorique </label></td>
                                <td>
                                    <?php echo $form['qtetheorique']->renderError() ?>
                                    <?php echo $form['qtetheorique'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Stock Réel en Valeur </label></td>
                                <td>
                                    <?php echo $form['stockreelvaleur']->renderError() ?>
                                    <?php echo $form['stockreelvaleur'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Enlèvements en Instance</label></td>
                                <td style="">
                                    <?php echo $form['enlinstance']->renderError() ?>
                                    <?php echo $form['enlinstance'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Stock en Qte & Enlèvements en Instance</label></td>
                                <td>
                                    <?php echo $form['senqteenle']->renderError() ?>
                                    <?php echo $form['senqteenle'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                if (!$form->getObject()->isNew()) {
                    foreach ($stockmag as $stock) {
                        $formstock = new StockForm($stock);
                ?>
                        <div id="stock_<?php echo $stock->getId(); ?>" class="tab-pane fade">
                            <table class="disabledbutton">
                                <tbody>
                                    <tr>
                                        <td><label>Prix Unitaire HT </label></td>
                                        <td>
                                            <?php echo $formstock['puht']->renderError() ?>
                                            <?php echo $formstock['puht'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Stock Réel en Qte </label></td>
                                        <td>
                                            <?php echo $formstock['qtereel']->renderError() ?>
                                            <?php echo $formstock['qtereel'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Stock Théorique </label></td>
                                        <td>
                                            <?php echo $formstock['qtetheorique']->renderError() ?>
                                            <?php echo $formstock['qtetheorique'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-4">
            <table>
                <tbody>
                    <tr>
                        <td><label>Stock Min</label></td>
                        <td style="">
                            <?php echo $form['stockmin']->renderError() ?>
                            <?php echo $form['stockmin'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Stock de Sécurité </label></td>
                        <td>
                            <?php echo $form['stocksecurite']->renderError() ?>
                            <?php echo $form['stocksecurite'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Stock Alert </label>
                        </td>
                        <td>
                            <?php echo $form['stockalert']->renderError() ?>
                            <?php echo $form['stockalert'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Stock Max </label>
                        </td>
                        <td>
                            <?php echo $form['stockmax']->renderError() ?>
                            <?php echo $form['stockmax'] ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <table>
                <tbody>
                    <tr>
                        <td><label>Code ABC</label></td>
                        <td style="">
                            <?php echo $form['codeabc']->renderError() ?>
                            <?php echo $form['codeabc'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Modèle d'Approvisionnement </label></td>
                        <td>
                            <?php echo $form['id_modele']->renderError() ?>
                            <?php echo $form['id_modele'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Délais d'Approvisionnement </label>
                        </td>
                        <td>
                            <?php echo $form['delai']->renderError() ?>
                            <?php echo $form['delai'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Bloc Appro. </label>
                        </td>
                        <td>
                            <?php echo $form['blocappro']->renderError() ?>
                            <?php echo $form['blocappro'] ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset>
        <legend>Données Comptables</legend>
        <div class="col-lg-6">
            <table>
                <tbody>
                    <tr>
                        <td><label>Compte géneral</label></td>
                        <td style="">
                            <?php echo $form['comptegenerale']->renderError() ?>
                            <?php echo $form['comptegenerale'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Méthode de valorisation de stock </label></td>
                        <td>
                            <?php echo $form['id_methode']->renderError() ?>
                            <?php echo $form['id_methode'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>