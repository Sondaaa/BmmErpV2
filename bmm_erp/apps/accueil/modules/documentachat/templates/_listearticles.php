<?php
$taux_tva = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('tva')
  ->orderBy('libelle')->execute();

$liste_projet = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('projet')
  ->orderBy('libelle')->execute();

$liste_unite = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('unitemarche')
  ->orderBy('id')
  ->execute();
$liste_tauxfodec = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('tauxfodec')
  ->orderBy('id')
  ->execute();
?>
<?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
<?php
$user = UtilisateurTable::getInstance()->find($sf_user->getAttribute('userB2m')->getId());
$magasins = EtageTable::getInstance()->findAll();
$arrayMagasin = [];
if ($user->getIdMagasin()) {
  $arrayMagasin = json_decode($user->getIdMagasin());
  foreach ($magasins as $a) :
    if (in_array($a->getId(), $arrayMagasin)) :
      $idmagasin = $a->getId();
    endif;
  endforeach;
} ?>
<div id="contenu" ng-controller="myCtrlLabo">
    <fieldset>
        <legend>Liste des articles</legend>
        <div id="sans_stockable">
            <table class="table table-bordered table-hover">
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
                        <td style="width: 6%"><input type="text" value="" ng-model="nordre.text" id="nordreid" class="form-control align_center disabledbutton"></td>
                        <td style="width: 32%;">
                            <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">
                            <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignation()" ng-keydown="goToList($event)">
                            <?php include_partial('symbole', array()) ?>
                        </td>
                        <td style="width: 6%"><input type="text" value="" ng-model="quantite.text" id="quantite" class="align_center"></td>
                        <td style="width: 12%">
                            <input type="hidden" id="idunitemarche">
                            <input type="hidden" value="" ng-model="unitedemander.text" id="unitedemander" class="form-control" autocomplete="off" ng-change="UniteMarche()" ng-click="UniteMarche()" ng-keyup="UniteMarche()">
                            <select id="id_unite" onchange="selectUnite()">
                                <option id="0"></option>
                                <?php foreach ($liste_unite as $unite) : ?>
                                    <option value="<?php echo $unite->getId() ?>"><?php echo $unite->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 18%">
                            <input type="hidden" id="idprojet">
                            <input type="hidden" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()" ng-keydown="goToList($event)">
                            <select id="id_projet" onchange="selectProject()">
                                <option id="0"></option>
                                <?php foreach ($liste_projet as $projet) : ?>
                                    <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 17%">
                            <textarea ng-model="observation.text" id="observation" class="form-control"></textarea>
                        </td>
                        <td style="width: 9%; text-align: center;">
                            <button type="button" class="btn btn-primary" ng-click="AjouterLigne()"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-xs btn-danger" ng-click="ViderChamps()"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>

                    <tr ng-repeat="lignedoc in listedocs">
                        <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                        <td style="text-align: center;">{{lignedoc.quantite}}</td>
                        <td>{{lignedoc.unitedemander}}</td>
                        <td>{{lignedoc.projet}}</td>
                        <td>{{lignedoc.observation}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                            <button type="button" class="btn btn-warning btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
       
    </fieldset>
</div>