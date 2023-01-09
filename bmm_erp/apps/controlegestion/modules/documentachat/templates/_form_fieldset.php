<?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$aviss = Doctrine_Core::getTable('avis')
                ->createQuery('a')->where('id_poste=5')
                ->orderBy('id asc')->execute(); //Liste des avis par unité budget
?>
<div style="position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
    <table>
        <tr>
            <td colspan="2">Avis de l'unité budget</td>
        </tr>
        <?php foreach ($aviss as $avis) { ?>
            <tr>
                <td><?php
                    if (strpos($avis->getLibelle(), ":") == 0)
                        echo $avis->getLibelle();
                    else
                        echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                    ?></td>
                <td>
                    <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                        <input type="checkbox">
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="padding: 1%;width: 80%;font-size: 16px">
    <table style="list-style: none; margin-bottom: 20px;">
        <tr>
            <td style="width: 200px; vertical-align: middle;">
                <p>
                    <strong><?php echo strtoupper($societe); ?></strong>
                </p>  
            </td>
            <td>
                <?php
                $numero = strtoupper($documentachat->getTypedoc());
                $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                ?>
                <table style="margin-bottom: 0px;">
                    <tr>
                        <td colspan="2"><?php echo $numero; ?></td>
                    </tr>
                    <tr>
                        <td>
                            N°:<?php echo $documentachat->getNumerodocachat() ?>
                        </td>
                        <td>
                            Date création: <?php echo $documentachat->getDatecreation(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nature: </td> 
                        <td>
                            <?php echo $form['id_objet']->renderError() ?>
                            <?php echo $form['id_objet'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> 
</div>

<fieldset style="width: 80%">
    <legend>Données de base</legend>
    <table>
        <tbody>
            <tr>
                <td style="width: 30%"><label>Nom et Prénom du demandeur</label></td>
                <td>
                    <?php echo $form['id_demandeur']->renderError() ?>
                    <?php echo $form['id_demandeur'] ?>
                </td>
                <td><label>Référence</label></td>
                <td>
                    <?php echo $form['reference']->renderError() ?>
                    <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<div class="row">
    <fieldset>
        <legend>Liste des articles</legend>
        <table>
            <thead>
                <tr>
                    <th>N°ordre</th>
                    <th>Code & Désignation</th>
                    <th>Quantité</th>
                    <th>Unité</th>
                    <th>Projet</th>
                    <th>Observation</th>               
                    <th>Action</th>
                </tr>             
            </thead>
            <tbody>
                <tr id="formligne">
                    <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid" class="form-control disabledbutton"></td>
                    <td style="width: 35%;">
                        <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">                   
                        <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignation()" ng-keydown="goToList($event)">
                        <?php include_partial('symbole', array()) ?>
                    </td>
                    <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite" class="form-control"></td>
                    <td style="width: 5%"><input type="text" value="" ng-model="unitedemander.text" id="unitedemander" class="form-control"></td>
                    <td>
                        <input type="hidden" id="idprojet">
                        <input type="text" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()" ng-keydown="goToList($event)">
                    </td>
                    <td>
                        <textarea ng-model="observation.text" id="observation" class="form-control"></textarea>
                    </td>
                    <td style="width: 100px">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigne()">+</button>
                        <button type="button" class="btn btn-danger" ng-click="ViderChamps()">-</button>
                    </td>
                </tr>

                <tr ng-repeat="lignedoc in listedocs">
                    <td>{{lignedoc.norgdre}}</td>
                    <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                    <td>{{lignedoc.quantite}}</td>
                    <td>{{lignedoc.unitedemander}}</td>
                    <td>{{lignedoc.projet}}</td>
                    <td>{{lignedoc.observation}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </fieldset>
</div>
<fieldset style="margin-left: 50%">
    <legend>Action Fiche BCI</legend>
    <div>
        <input id="btnvalider" ng-click="AjouterBCIAchat()" type="button" value="Valider BCI... " class="btn btn-outline btn-danger" />
    </div>
</fieldset>