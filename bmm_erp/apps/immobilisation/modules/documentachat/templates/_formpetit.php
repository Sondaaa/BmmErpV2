<fieldset id="tableajoutarticle" ng-controller="CtrlArticle" ng-init="Initialiser(<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)">
    <legend>Données fiche</legend>
    <table>
        <tbody>
            <tr>
                <td style="width: 15%;"><label>Numéro Fiche</label></td>
                <td style="width: 15%;">
                    <?php echo $form['numero']->renderError() ?>
                    <?php
                    if ($form->getObject()->isNew())
                        $numero = $article->getNumeroseqfiche();
                    else
                        $numero = $form->getObject()->getNumero();
                    ?>
                    <?php echo $form['numero']->render(array('class' => 'disabledbutton', 'value' => $numero)) ?>
                </td>
                <td style="width: 15%;"><label>Date création</label></td>
                <td style="width: 15%;">
                    <?php echo $form['datecreation']->renderError() ?>
                    <?php echo $form['datecreation']->render(array('value' => date('Y-m-d'), 'min' => date('Y-m-d'), 'max' => date('Y-m-d'))) ?>
                </td>
                <td style="width: 10%;">
                    <label>Emetteur</label>
                </td>
                <td style="width: 30%;" class="disabledbutton">
                    <?php echo $form['id_user']->renderError() ?>
                    <?php echo $form['id_user'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="col-lg-6">
        <legend>Données de Classification</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Type de Stock</label></td>
                    <td style="">
                        <?php echo $form['id_typestock']->renderError() ?>
                        <?php echo $form['id_typestock'] ?>
                    </td>

                    <td><label>Fabricant</label></td>
                    <td>
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
                        <label>Code Famille </label>
                    </td>
                    <td>
                        <?php echo $form['codefamille']->renderError() ?>
                        <?php echo $form['codefamille'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Sous Famille</label></td>
                    <td>
                        <div style="display: none" >
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
                    <td>
                        <label>Nature </label>
                    </td>
                    <td>
                        <?php echo $form['id_nature']->renderError() ?>
                        <?php echo $form['id_nature'] ?>
                    </td>
                    <td>
                        <label>Code Nature </label>
                    </td>
                    <td>
                        <?php echo $form['codenature']->renderError() ?>
                        <?php echo $form['codenature'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Méthode de Valorisation de Stock </label></td>
                    <td colspan="2">
                        <?php echo $form['id_methode']->renderError() ?>
                        <?php echo $form['id_methode'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
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
                    <a data-toggle="tab" href="#cara" ng-click="InialiserCarac(<?php echo $form->getObject()->getId() ?>); AfficheCar(<?php echo $form->getObject()->getId() ?>)" >
                        Caractéristique
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <table style="margin-bottom: 0px;">
                    <tbody>
                        <tr>
                            <td><label>Designation</label></td>
                            <td colspan="3">
                                <?php echo $form['designation']->renderError() ?>
                                <?php echo $form['designation'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
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
    </div>
</fieldset>