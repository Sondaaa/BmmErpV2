<?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$aviss = Doctrine_Core::getTable('avis')
                ->createQuery('a')->where('id_poste=5')
                ->orderBy('id asc')->execute(); //Liste des avis par unité budget
?>
<div style="position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
    <table>
        <tr>
            <td colspan="2" style="font-size: 16px;">Avis de l'unité budget</td>
        </tr>
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
<div style="padding: 1%;width: 80%;font-size: 16px">
    <table style="list-style: none; margin-bottom: 0px;">
        <tr>
            <td style="width: 200px; vertical-align: middle;">
                <p style="margin-bottom: 0px;"><strong><?php echo strtoupper($societe); ?></strong></p>  
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
                        <td>N° : <?php echo $documentachat->getNumero() ?></td>
                        <td>
                            Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Montant Estimatif: </td>
                        <td>
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
                <td style="width: 30%"><label>Service Demandeur</label></td>
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
                <th>N° Ordre</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Projet</th>
                <th>Observation</th>               
                <th>Action</th>
            </tr>             
        </thead>
        <tbody>
            <tr id="formligne">
                <td style="width: 5%;"><input type="text" value="" ng-model="nordre.text" id="nordreid"  class="form-control disabledbutton" ></td>
                <td style="width: 44%">
                    <textarea ng-model="designation.text" id="designation" class="form-control"></textarea>
                </td>
                <td style="width: 5%"><input type="text" value="" ng-model="quantite.text" id="quantite" class="form-control align_center"></td>
                <td style="width: 10%">
                    <input type="hidden" id="idunitemarche">
                    <input type="hidden" value="" ng-model="unitedemander.text" id="unitedemander"  class="form-control">
                    <select id="id_unite" onchange="selectUnite()">
                        <option id="0"></option>
                        <?php foreach ($liste_unite as $unite): ?>
                            <option value="<?php echo $unite->getId() ?>"><?php echo $unite->getLibelle() ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 12%">
                    <input type="hidden" id="idprojet">
                    <input type="hidden" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()"  class="form-control">
                    <select id="id_projet" onchange="selectProject()">
                        <option id="0"></option>
                        <?php foreach ($liste_projet as $projet): ?>
                            <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 16%">
                    <input type="hidden" ng-model="mid" id="mid">
                    <textarea ng-model="motifs.text" id="motifsid" class="form-control"></textarea>
                </td>
                <td style="width: 8%; text-align: center;">
                    <button type="button" class="btn btn-primary" ng-click="AjouterLigneMP()">+</button>
                    <button type="button" class="btn btn-danger" ng-click="ViderChamps()">-</button>
                </td>
            </tr>
            <tr ng-repeat="lignedoc in listedocs">
                <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                <!--<td>{{lignedoc.designation}}</td>-->
                <td ng-bind-html="lignedoc.designation | trustAsHtml"></td>
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
    <legend>Action Fiche B.C.I Marchés Public</legend>
    <div>
        <input id="btnvalider" ng-click="AjouterBCIMPAchat('<?php echo $documentachat->getId(); ?>')" type="button" value="Valider B.C.I.M.P" class="btn btn-outline btn-danger" />
    </div>
</fieldset>

<script>

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