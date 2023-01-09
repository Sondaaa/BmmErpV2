<?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$aviss = Doctrine_Core::getTable('avis')->findByIdPoste(5); //Liste des avis par unité budget
?>
<div style="position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
    <table>
        <tr>
            <td colspan="2">Avis de l'unité budget</td>
        </tr>
        <?php foreach ($aviss as $avis) { ?>
            <tr>
                <td><?php echo $avis->getLibelle() ?></td>
                <td><input type="checkbox"></td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="padding: 1%;width: 80%;font-size: 16px">
    <table style="list-style: none">
        <tr>
            <td style="width: 200px">
                <p>
                    <strong><?php echo strtoupper($societe); ?></strong>
                </p>  
            </td>
            <td>
                <table>
                    <tr>
                        <td colspan="2"><?php echo strtoupper($documentachat->getTypedoc()); ?></td>
                    </tr>
                    <tr>
                        <td>
                            N°:<?php echo $documentachat->getNumero() ?>
                        </td>
                        <td>
                            Date création: <?php echo $documentachat->getDatecreation(); ?>
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
                    <?php echo $form['reference']->render(array('class'=>'form-control')) ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset>
    <legend>Liste des articles</legend>
    <table>
        <thead>
            <tr>
                <th>N°ordre</th>
                <th>Code Article</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Projet</th>
                <th>Motif pour Achat</th>               
                <th>P.E.</th>
                <th>P.A.</th>
                <th>Action</th>
            </tr>             
        </thead>
        <tbody>
            <tr id="formligne">
                <td style="width: 40px !important"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control disabledbutton" ></td>
                <td style="width: 80px">
                    <input  type="text" ng-value="" ng-model="code.text" id="codearticle"  autocomplete="off"   class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">                   
                </td>
                <td>
                    <input type="text" value="" ng-model="designation.text" id="designation"  class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">
                </td>
                <td style="width: 50px"><input type="text" value="" ng-model="quantite.text" id="quantite"  class="form-control"></td>
                <td>
                    <input type="hidden" id="idprojet">
                    <input type="text" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()"  class="form-control">
                </td>
                <td>
                    <input type="hidden" ng-model="mid" id="mid">
                    <input type="text" value="" ng-model="motifs.text" id="motifsid" autocomplete="off" ng-change="MotifParProjet()"   class="form-control">
                </td>
                <td></td>
                <td></td>
                <td style="width: 100px">
                    <button type="button" class="btn btn-primary" ng-click="AjouterLigne()">+</button>
                    <button type="button" class="btn  btn-danger" ng-click="ViderChamps()">-</button>
                </td>
            </tr>
            <tr ng-repeat="lignedoc in listedocs">
                <td>{{lignedoc.norgdre}}</td>
                <td>{{lignedoc.codearticle}}</td>
                <td>{{lignedoc.designation}}</td>
                <td>{{lignedoc.quantite}}</td>
                <td>{{lignedoc.projet}}</td>
                <td>{{lignedoc.motif}}</td>
                <td><input type="checkbox" class="disabledbutton"></td>
                <td><input type="checkbox" class="disabledbutton"></td>
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
<fieldset style="margin-left: 50%">
    <legend >Action Fiche BCI</legend>
    <div >
        <input id="btnvalider"  ng-click="AjouterBCI()" type="button" value="Valider BCI... " class="btn btn-outline btn-danger" />
    </div>
</fieldset>