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
$magasins = EtageTable::getInstance()->getByadmin();
$array_code = array();
$i = 0;
foreach ($magasins as $j_i) {
  $array_code[$i] = $j_i->getId();
  $i++;
}
$arrayMagasin = [];
$idmagasins = [];
if ($user->getIdMagasin()) {

  $arrayMagasin = json_decode($user->getIdMagasin());

  for ($i = 0; $i <= sizeof($arrayMagasin) - 1; $i++) :
    if (in_array($arrayMagasin[$i], $array_code)) :
      if (sizeof($idmagasins) == 0)
        $idmagasins = $arrayMagasin[$i];
      else
        $idmagasins = $idmagasins . ',,' . $arrayMagasin[$i];
    endif;
  endfor;

  // foreach ($magasins as $a) :
  //   if (in_array($a->getId(), $arrayMagasin)) :
  //     $idmagasin = $a->getId() . ',';
  //   endif;
  // endforeach;

} ?>
<input type="hidden" id="documentachat_id_emplacement" name="documentachat[id_emplacement]" value='<?php if ($user) echo $idmagasins; ?>'>

<input type="hidden" ng-value="<?php echo "4" ?>" ng-model="typedocid.text" id="idtypedoc" value="<?php echo "4" ?>">
<div id="sf_admin_container">
  <div id="sf_admin_content">
    <div class="panel-body">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>
        <?php if (!$form->isNew()) { ?>
          <li class=""><a href="#documentscan" data-toggle="tab" aria-expanded="false">Document Attachés</a></li>
        <?php } ?>

      </ul>
      <div class="tab-content">
        <div class="tab-pane fade active in" id="home">

          <div style="width: 100%;font-size: 16px" ng-init="Initisaliercontrat()">
            <table style="list-style: none; margin-bottom: 10px;">
              <tr style="background-color: #F0F0F0;">
                <td style="width: 200px; vertical-align: middle; text-align: center;">
                  <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
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
                      <td colspan="5"><?php echo $numero; ?></td>
                    </tr>
                    <tr>
                      <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                      <td colspan="3">Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                    </tr>
                    <tr>
                      <td>Nature : </td>
                      <td>
                        <?php echo $form['id_naturedoc']->renderError() ?>
                        <?php echo $form['id_naturedoc'] ?>
                      </td>




                    </tr>
                    <tr>
                      <td>Montant Estimatif (TND): </td>
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

          <fieldset style="width: 100%">
            <legend>Données de base</legend>
            <table>
              <tbody>
                <tr>
                  <td style="width: 10%; vertical-align: middle;">Référence</td>
                  <td style="width: 10%">
                    <?php echo $form['reference']->renderError() ?>
                    <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                  </td>
                  <td style="width: 20%; vertical-align: middle;">Nom et Prénom du demandeur</td>
                  <td style="width: 40%">
                    <?php echo $form['id_demandeur']->renderError() ?>
                    <?php echo $form['id_demandeur'] ?>
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
            $user=$sf_user->UserConnected();
           if($user && !$user->getIsAdmin()){
            $labo=$user->getLaboName();
           }
          $liste_projet = Doctrine_Query::create()
            ->select("id,libelle")
            ->from('projet')
            //->where('id_soussite='.$labo->getId())
            ->orderBy('libelle')->execute();
          ?>
          <div id="general" class="row" ng-init="AfficheLignedocumentBCI('<?php echo $documentachat->getId(); ?>')">
            <div>
              <fieldset>
                <legend>Liste des articles</legend>
                <div id="sans_stockable">
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
                          <input type="text" value="" ng-model="designation.text" id="designation" style="width: 100%;" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignation()" style="width: 100%;height: 30px;" >
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
                          <button type="button" class="btn btn-primary btn-xs" ng-click="AjouterLigne()"><i class="fa fa-plus"></i></button>
                          <button type="button" class="btn btn-xs btn-danger btn-xs" ng-click="ViderChamps()"><i class="fa fa-minus"></i></button>
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
                          <button type="button" class="btn btn-info btn-xs btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                          <button type="button" class="btn btn-warning btn-xs btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="avec_stockable" style="display: none">
                  <table>
                    <thead>
                      <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation</th>
                        <th>Article stockable</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th>Projet</th>
                        <th>Observation</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="formligne">
                        <td style="width: 6%"><input type="text" value="" ng-model="nordre.text" id="nordreid_stockable" class="form-control align_center disabledbutton"></td>
                        <td style="width: 32%;">
                          <input type="text" ng-value="" ng-model="code.text" id="code_stockable" autocomplete="off" placeholder="CODE" readonly="true">
                          <input type="text" value="" ng-model="designation.text" id="designation_stockable" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationStoc()" ng-keydown="goToList($event)">
                          <?php include_partial('symbole', array()) ?>
                        </td>
                        <td style="text-align: center"> <input type="checkbox" id="stockable" ng-model="check_valide"></td>
                        <td style="width: 6%"><input type="text" value="" ng-model="quantite_stockable.text" id="quantite_stockable" class="align_center"></td>
                        <td style="width: 12%">
                          <input type="hidden" id="idunitemarche_stockable">
                          <input type="hidden" value="" ng-model="unitedemander_stockable.text" id="unitedemander_stockable" class="form-control" autocomplete="off" ng-change="UniteMarcheStockable()" ng-click="UniteMarcheStockable()" ng-keyup="UniteMarcheStockable()">
                          <select id="id_unite_stockable" onchange="selectUniteStocakble()">
                            <option id="0"></option>
                            <?php foreach ($liste_unite as $unite) : ?>
                              <option value="<?php echo $unite->getId() ?>"><?php echo $unite->getLibelle() ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td style="width: 18%">
                          <input type="hidden" id="idprojet_stockable">
                          <input type="hidden" value="" ng-model="projetsid_stockable.text" id="projetsid_stockable" autocomplete="off" ng-change="ProjetParMotifStockable()" ng-click="ProjetParMotifStockable()" ng-keyup="ProjetParMotifStockable()" ng-keydown="goToList($event)">
                          <select id="id_projet_stockable" onchange="selectProjectStocakble()">
                            <option id="0"></option>
                            <?php foreach ($liste_projet as $projet) : ?>
                              <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td style="width: 17%">
                          <textarea ng-model="observation_stockable.text" id="observation_stockable" class="form-control"></textarea>
                        </td>
                        <td style="width: 9%; text-align: center;">
                          <button type="button" class="btn btn-xs btn-primary " ng-click="AjouterLignestockable()"><i class="fa fa-plus"></i></button>
                          <button type="button" class="btn btn-xs btn-danger " ng-click="ViderChampsstockable()"><i class="fa fa-minus"></i></button>
                        </td>
                      </tr>

                      <tr ng-repeat="lignedoc in listedocs">
                        <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>

                        <td style="text-align: center">
                          <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedoc.stockable"></i>
                          <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedoc.stockable == false"></i>
                        </td>
                        <td style="text-align: center;">{{lignedoc.quantite}}</td>
                        <td>{{lignedoc.unitedemander}}</td>
                        <td>{{lignedoc.projet}}</td>
                        <td>{{lignedoc.observation}}</td>
                        <td>
                          <button type="button" class="btn btn-info btn-xs btn-circle" ng-click="MisAJourstockable(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                          <button type="button" class="btn btn-warning btn-xs btn-circle" ng-click="Deletestockable(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </fieldset>

            </div>
            <fieldset style="margin-left: 35%">
              <legend>Action Fiche BCI</legend>
              <div>
                <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('Achatdoc/index') ?>">Retour à la liste</a>
                <?php // if (!$documentachat->getValide()) : 
                ?>
                <!-- <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php // echo $documentachat->getId(); 
                                                                                          ?>', false)" type="button" value="Enregistrer D.I. ... " class="btn btn-xs btn-success" /> -->
                <?php
                //endif;
                // if (!$documentachat->getValide()) :
                ?>
                <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer D.I. & Envoyer a l'unité Achat " class="btn btn-xs btn-success" />
                <?php //endif; 
                ?>

              </div>
            </fieldset>
          </div>
        </div>
        <?php if (!$form->isNew()) { ?>
          <div class="tab-pane" style="height: 670px;" id="documentscan">

            <?php
            $id = $form->getObject()->getId();
            $docuementachat = $form->getObject();
            include_partial('Scan/formscan', array('id' => $id, 'documentachat' => $documentachat));
            ?>
          </div>
      </div><?php } ?>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  function selectUnite() {
    if ($('#id_unite').val() != '0') {
      $('#idunitemarche').val($('#id_unite').val());
      $('#unitedemander').val($('#id_unite option:selected').text());
    } else {
      $('#idunitemarche').val('');
      $('#unitedemander').val('');
    }
  }

  function selectUniteStocakble() {
    if ($('#id_unite_stockable').val() != '0') {
      $('#idunitemarche_stockable').val($('#id_unite_stockable').val());
      $('#unitedemander_stockable').val($('#id_unite_stockable option:selected').text());
    } else {
      $('#idunitemarche_stockable').val('');
      $('#unitedemander_stockable').val('');
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

  function selectProjectStocakble() {
    if ($('#id_projet_stockable').val() != '0') {
      $('#idprojet_stockable').val($('#id_projet_stockable').val());
      $('#projetsid_stockable').val($('#id_projet_stockable option:selected').text());
    } else {
      $('#idprojet_stockable').val('');
      $('#projetsid_stockable').val('');
    }
  }

  //    function AffichageLigneContrat() {
  //        if ($('#documentachat_id_contrat').val() != '0') {
  //            $('#contratpartiel').attr('style', 'width:100%');
  //            $('#contratpartiel').attr('style', 'display: block');
  //            $('#general').attr('style', 'display: none');
  //        } else {
  //            $('#general').attr('style', 'display: block');
  //            $('#general').attr('style', 'width:100%');
  //            $('#contratpartiel').attr('style', 'display: none');
  //
  //        }
  //
  //    }
</script>

<style>
  #ul_compte {
    min-width: 130px;
  }
</style>