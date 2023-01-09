<?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$aviss = Doctrine_Core::getTable('avis')
                ->createQuery('a')->where('id_poste=5')
                ->orderBy('id asc')->execute(); //Liste des avis par unité budget
?>
<div style="position: absolute;float: right;margin-left: 80%;" class="disabledbutton">
    <table>
        <thead>
            <tr>
                <th colspan="2" style="font-size: 16px;">Avis de l'unité budget</th>
            </tr>
        </thead>
        <?php foreach ($aviss as $avis) { ?>
            <tr>
                <td>
                    <?php
                    if (strpos($avis->getLibelle(), ":") == 0)
                        echo $avis->getLibelle();
                    else
                        echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                    ?>
                </td>
                <td>
                    <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                        <?php
                        if ($documentachat->getId())
                            $lgdoc = LigavisdocTable::getInstance()->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                        else
                            $lgdoc = NULL;
                        ?>
                        <input type="checkbox" <?php if ($lgdoc): ?> checked="true"<?php endif; ?>>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="width: 80%;font-size: 16px">
    <table style="list-style: none; margin-bottom: 10px;">
        <tr>
            <td style="width: 200px; vertical-align: middle;">
                <p><strong><?php echo strtoupper($societe); ?></strong></p>  
            </td>
            <td>
                <?php
                $numero = strtoupper($documentachat->getTypedoc());
                $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                ?>
                <table style="margin-bottom: 0px;">
                    <tr>
                        <td colspan="4"><?php echo $numero; ?></td>
                    </tr>
                    <tr>
                        <td>Numéro :</td>
                        <td><?php echo $documentachat->getNumerodocachat() ?></td>
                        <td>Date création :</td>
                        <td>
                            <?php echo $form['datecreation']->renderError() ?>
                            <?php echo $form['datecreation']->render(array("value" => $documentachat->getDatecreation())) ?>
                            <?php // echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nature : </td> 
                        <td colspan="3">
                            <?php echo $form['id_objet']->renderError() ?>
                            <?php echo $form['id_objet'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Montant Estimatif : </td>
                        <td colspan="3">
                            <?php echo $form['montantestimatif']->renderError() ?>
                            <?php echo $form['montantestimatif'] ?>
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
                <td style="width: 25%">Nom et Prénom du demandeur</td>
                <td style="width: 50%">
                    <?php echo $form['id_demandeur']->renderError() ?>
                    <?php echo $form['id_demandeur'] ?>
                </td>
                <td style="width: 10%">Référence</td>
                <td style="width: 15%">
                    <?php echo $form['reference']->renderError() ?>
                    <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<?php
$liste_unite = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('unitemarche')
                ->orderBy('libelle')->execute();

$liste_projet = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('projet')
                ->orderBy('libelle')->execute();
?>
<div class="row" ng-init="AfficheLignedocumentBCI('<?php echo $documentachat->getId(); ?>')">
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
                            <?php foreach ($liste_unite as $unite): ?>
                                <option value="<?php echo $unite->getId() ?>"><?php echo $unite->getLibelle() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 18%">
                        <input type="hidden" id="idprojet">
                        <input type="hidden" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()" ng-keydown="goToList($event)">
                        <select id="id_projet" onchange="selectProject()">
                            <option id="0"></option>
                            <?php foreach ($liste_projet as $projet): ?>
                                <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="width: 17%">
                        <textarea ng-model="observation.text" id="observation" class="form-control"></textarea>
                    </td>
                    <td style="width: 9%; text-align: center;">
                        <button type="button" class="btn btn-primary" ng-click="AjouterLigne()"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger" ng-click="ViderChamps()"><i class="fa fa-minus"></i></button>
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
    </fieldset>
</div>
<fieldset style="margin-left: 50%">
    <legend>Action Fiche BCI</legend>
    <div>
        <input id="btnvalider" ng-click="AjouterBCIAchat('<?php echo $documentachat->getId(); ?>')" type="button" value="Valider BCI... " class="btn btn-outline btn-danger" />
    </div>
</fieldset>

<script  type="text/javascript">

    function selectUnite() {
        if ($('#id_unite').val() != '0') {
            $('#idunitemarche').val($('#id_unite').val());
            $('#unitedemander').val($('#id_unite option:selected').text());
        } else {
            $('#idunitemarche').val('');
            $('#unitedemander').val('');
        }
    }

    function selectProject() {
        if ($('#id_projet').val() != '0') {
            $('#idprojet').val($('#id_projet').val());
            $('#projetsid').val($('#id_projet option:selected').text());
        } else {
            $('#idprojet').val('');
            $('#projetsid').val('');
        }
    }

</script>

<style>

    #ul_compte{min-width: 130px;}

</style>