<?php
$user = $sf_user->getAttribute('userB2m');

$user = Doctrine_Core::getTable('utilisateur')->findOneById($user->getId());
$labo = $user->getLaboName();
$labo_id = $labo->getId();
$taux_tva = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('tva')
  ->orderBy('libelle')->execute();

$liste_projet = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('projet')
  ->whereIn('id_soussite', json_decode($user->getIdMagasin(), true))

  ->andwhere('id_soussite is not null')
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


<?php
$user = UtilisateurTable::getInstance()->find($sf_user->getAttribute('userB2m')->getId());
$arrayMagasin = [];
if ($user->getIdMagasin()) {
  $arrayMagasin = json_decode($user->getIdMagasin());
} ?>
<input type="hidden" id="documentachat_id_emplacement" name="documentachat[id_emplacement]" value='<?php if ($user) {
                                                                                                      echo json_encode($arrayMagasin);
                                                                                                    }
                                                                                                    ?>'>
<input type="hidden" id="etage_id" value="<?php echo $labo_id ?>">

<input type="hidden" id="idtypedoc" value="<?php
                                            if ($idtype) {
                                              echo $idtype;
                                            } else if (!$form->isNew()) {
                                              echo $form->getObject()->getIdTypedoc();
                                            } ?>">


<div class="row">
  <div <?php if ($form->isNew()) :
          echo 'class="col-md-12"';
        else : echo 'class="col-md-8"';
        endif ?>>
    <div>

      <?php
      $numero = strtoupper($documentachat->getTypedoc());
      $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
      ?>
      <table class="table table-bordred" ng-init="Initisaliercontrat()">
        <tr>
          <th colspan="2" style="background-color: #e2e2e2;"><?php echo $numero; ?></th>
        </tr>
        <tr>
          <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
          <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
        </tr>

        <tr>
          <td style="width:300px ;">Nature :<span class="required">*</span> </td>
          <td>
            <?php echo $form['id_naturedoc']->renderError() ?>
            <?php echo $form['id_naturedoc'] ?>
          </td>
        </tr>

        <tr id="div_mnt_estimatif">
          <td>Montant Estimatif (TND):<span class="required">*</span> </td>
          <td>
            <?php echo $form['montantestimatif']->renderError() ?>
            <?php echo $form['montantestimatif'] ?>
          </td>
        </tr>
      </table>
      <table class="table table-bordred">

        <tr>
          <td colspan="5" style="background-color: #e2e2e2;">
            Données de base
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <div class="row">
              <div class="col-md-4">
                Référence
                <?php echo $form['reference']->renderError() ?>
                <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
              </div>
              <div class="col-md-4">
                Demandeur<span class="required">*</span>
                <?php $demandeur_labo = DemandeurTable::getInstance()->loadDemandeurByLabo($labo_id, $user->getId()); ?>
                <select id="documentachat_id_demandeur">
                  <option value=""></option>
                  <?php foreach ($demandeur_labo as $a) : ?>
                    <option value="<?php echo $a->getId(); ?>" <?php if (!$form->isNew()) {
                                                                  if ($a->getId() == $form->getObject()->getIdDemandeur()) : ?> selected="selected" <?php endif;
                                                                                  } ?>>
                      <?php echo $a->getAgents(); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>



              <div class="col-md-4">
                Date Signature
                <?php echo $form['datesignaturebci']->renderError() ?>
                <?php echo $form['datesignaturebci']->render(array('class' => 'form-control', 'max' => date('Y-m-d'))) ?>
              </div>
            </div>
          </td>

        </tr>
        <tr id="div_id_projet">
          <td>Projet:<span class="required">*</span></td>
          <td>
            <div class="row">

              <div class="col-md-12">
                <select id="id_projet" onchange="selectProject()">
                  <option id="0"></option>
                  <?php foreach ($liste_projet as $projet) : ?>
                    <option value="<?php echo $projet->getId() ?>" <?php if (!$form->isNew()) {
                                                                      if ($projet->getId() == $form->getObject()->getIdProjet()) : ?> selected="selected" <?php endif;
                                                                                    } ?>>
                      <?php echo $projet->getLibelle() ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </td>


        </tr>
        <?php if ($idtype == 6) : ?>
          <tr>
            <td style=" vertical-align: middle;">Obsevation</td>
            <td colspan="5">
              <?php echo $form['observation']->renderError() ?>
              <?php echo $form['observation']->render(array('class' => 'form-control')) ?>
            </td>
          </tr>
        <?php endif; ?>
        </tr>
      </table>
      <table class="table table-bordred">
        <tr>
          <td colspan="2" style="background-color: #e2e2e2;">Liste des articles</td>

        </tr>
        <tr>
          <td colspan="2">
            <div id="general" class="row" ng-init="AfficheLignedocumentBCILabo('<?php echo $documentachat->getId(); ?>')">
              <div class="col-md-12">

                <div id="sans_stockable">
                  <table>
                    <thead>
                      <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation<span class="required">*</span></th>
                        <th>Quantité<span class="required">*</span></th>
                        <th>Unité/Conditionnement</th>
                        <!-- <th>Projet</th> -->
                        <!-- <th>Observation</th> -->
                        <th>Caracteristique Article</th>
                        <th>Action<span class="required">*</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="formligne">
                        <td style="width: 6%"><input type="text" value="" ng-model="nordre.text" id="nordreid" class="form-control align_center disabledbutton"></td>
                        <td style="width: 22%;">
                          <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">
                          <input type="text" value="" ng-model="designation.text" id="designation" style="width: 100%;" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignation()" style="width: 100%;height: 30px;">
                          <?php //include_partial('symbole', array())
                          ?>
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

                        <td style="width: 17%">
                          <a href="#my-carac" role="button" data-toggle="modal">Ajouter Carateristique</a>
                          <textarea ng-model="observation.text" id="observation" class="form-control"></textarea>





                        </td>

                        <td style="width: 9%; text-align: center;">
                          <button type="button" class="btn btn-primary btn-xs" ng-click="AjouterLigneBCInnDA()"><i class="fa fa-plus"></i></button>
                          <button type="button" class="btn btn-xs btn-danger btn-xs" ng-click="ViderChamps()"><i class="fa fa-minus"></i></button>
                        </td>
                      </tr>

                      <tr ng-repeat="lignedoc in listedocs">
                        <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                        <td style="text-align: center;">{{lignedoc.quantite}}</td>
                        <td>{{lignedoc.unitedemander}}</td>
                        <!-- <td>{{lignedoc.projet}}</td> -->
                        <td>{{lignedoc.observation}}</td>
                        <td>
                          <button type="button" class="btn btn-info btn-xs btn-circle" ng-click="MisAJourBCI(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                          <button type="button" class="btn btn-warning btn-xs btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--  ng-init="AfficheLignedocumentBCIDA('<?php //echo $documentachat->getId(); 
                                                          ?>')" -->
                <div id="avec_stockable" style="display: none">
                  <table>
                    <thead>
                      <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation</th>
                        <th style="width: 20%" colspan="3">Art. Stock/Patrimoine/Service</th>
                        <th>Quantité</th>
                        <th>Unité/Conditionnement</th>
                        <th>Caracteristique Article</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="formligne">
                        <td style="width: 6%"><input type="text" value="" ng-model="nordre.text" id="nordreid_stockable" class="form-control align_center disabledbutton"></td>
                        <td style="width: 32%;">
                          <input type="text" ng-value="" ng-model="code.text" id="code_stockable" autocomplete="off" placeholder="CODE" readonly="true">
                          <input type="text" value="" ng-model="designation.text" id="designation_stockable" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationStoc()" ng-keydown="goToList($event)">
                          <?php //include_partial('symbole', array())
                          ?>
                        </td>
                        <td style="width: 20%" colspan="3">
                          <div class="col-md-12" id="div_stockable">
                            <!-- <input type="checkbox"  id="stockable" ng-model="check_stock" class="list_checbox_type">  -->
                            <input type="checkbox" id="stockable" ng-model="check_stock" name="myradio" value="service" onclick="CheckRadio(this);" />Article Stock
                          </div>
                          <div class="col-md-12" id="div_patrimoine">
                            <!-- <input type="checkbox"   class="list_checbox_type">  -->
                            <input type="checkbox" id="patrimoine" ng-model="check_patrimoine" name="myradio" value="patrimoine" onclick="CheckRadio(this);" />Article Patrimoine

                          </div>
                          <div class="col-md-12" id="div_service">
                            <!-- <input type="checkbox"   class="list_checbox_type">  -->
                            <input type="checkbox" id="service" ng-model="check_service" name="myradio" value="service" onclick="CheckRadio(this);" />Services et Autres
                          </div>
                        </td>
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

                        <td style="width: 17%">
                          <a href="#my-carac_stockable" role="button" data-toggle="modal">Ajouter Carateristique</a>
                          <textarea ng-model="observation_stockable.text" id="observation_stockable" class="form-control"></textarea>

                          <!-- <textarea ng-model="observation_stockable.text" id="observation_stockable" class="form-control"></textarea> -->
                        </td>


                        <td style="width: 9%; text-align: center;">
                          <button type="button" class="btn btn-xs btn-primary " ng-click="AjouterLignestockable()"><i class="fa fa-plus"></i></button>
                          <button type="button" class="btn btn-xs btn-danger " ng-click="ViderChampsstockable()"><i class="fa fa-minus"></i></button>
                        </td>
                      </tr>

                      <tr ng-repeat="lignedoc in listedocs">
                        <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>

                        <div>
                          <!-- ng-if="lignedoc.stockable == true" style="display: none"> -->
                          <td style="text-align: center">
                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedoc.stockable">Article Stock</i>
                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedoc.stockable == false"></i>

                          </td>
                        </div>


                        <div>
                          <!-- ng-if="lignedoc.patrimoine == 'is_patrimoine'" style="display: none"> -->
                          <td style="text-align: center">
                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedoc.patrimoine">Article Patrimoine</i>
                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedoc.patrimoine == false"></i>
                          </td>
                        </div>
                        <div>
                          <!-- ng-if="lignedoc.patrimoine == 'is_service'" style="display: none"> -->
                          <td style="text-align: center">
                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedoc.service">Service ou Autre</i>
                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedoc.service == false"></i>
                          </td>
                        </div>
                        <td style="text-align: center;">{{lignedoc.quantite}}</td>
                        <td>{{lignedoc.unitedemander}}</td>

                        <td>{{lignedoc.observation}}</td>
                        <td>
                          <button type="button" class="btn btn-info btn-xs btn-circle" ng-click="MisAJourstockable(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                          <button type="button" class="btn btn-warning btn-xs btn-circle" ng-click="Deletestockable(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>




            </div>
          </td>
        <tr>
          <td colspan="2" style="background-color: #e2e2e2;"> Action Fiche BCI</td>
        </tr>
        <tr>
          <td colspan="2">

            <div class="row">
              <div class="col-md-12">
                <?php
                if (!$form->isNew()) {
                  if (!$idtype) :
                    $idtype = $form->getObject()->getIdTypedoc();
                  endif;
                }  ?>
                <?php if ($idtype == 4) : ?>
                  <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('Achatdoc/index') . '?idtype=' . $idtype ?>">Retour à la liste</a>
                  <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer D.I. & Envoyer " class="btn btn-xs btn-success" />
                  <!-- <input id="btnonvalider" style="margin-rigth: 2px" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php //echo $documentachat->getId(); 
                                                                                                                        ?>', false)" type="button" value="Enregistrer D.I. & Envoyer au Chef Projet  " class="btn btn-xs btn-success" /> -->
                <?php endif; ?>
                <?php if ($idtype == 6) : ?>
                  <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('Achatdoc/index') . '?idtype=' . $idtype ?>">Retour à la liste</a>

                  <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer && Envoyer  " class="btn btn-xs btn-success" />
                  <!-- <input id="btnonvalider" style="margin-rigth: 2px" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php //echo $documentachat->getId(); 
                                                                                                                        ?>', false)" type="button" value="Enregistrer && Envoyer au Chef Projet  " class="btn btn-xs btn-success" /> -->
                <?php endif; ?>

              </div>
            </div>

          </td>
        </tr>
        </tr>
        </tbody>
      </table>
      </td>

    </div>






  </div>
  <?php if (!$form->isNew()) { ?>
    <div class="col-md-4" id="documentscan">
      <?php
      $id = $form->getObject()->getId();
      $docuementachat = $form->getObject();
      include_partial('Scan/formscan', array('id' => $id, 'documentachat' => $documentachat));
      ?>
    </div>
  <?php } ?>
</div>

<div class="col-md-12">
  <div id="my-carac" class="modal fade" tabindex="-1" style="width: 1200px">
    <?php include_partial('caracteristique', array()); ?>
  </div>

  <div id="my-carac_stockable" class="modal fade" tabindex="-1" style="width: 1200px">
    <?php include_partial('caracteristique_stockable', array()); ?>
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

  // $('.list_checbox_type').change(function() {
  //CheckSpotoffcielEclaire();
  //  if ( $('#patrimoine').is(':checked') ) {
  //          $('#patrimoine').prop('checked', true);
  //          $('#service').prop('checked', false);
  //          $('#stockable').prop('checked', false);
  //      }

  //      if ($('#stockable').is(':checked') == true && $('#service').is(':checked') ) {
  //          $('#patrimoine').prop('checked', false);
  //          $('#service').prop('checked', true);
  //          $('#stockable').prop('checked', false);
  //      }
  //      if ($('#patrimoine').is(':checked') == true && $('#service').is(':checked') ) {
  //        $('#patrimoine').prop('checked', false);
  //          $('#service').prop('checked', true);
  //          $('#stockable').prop('checked', false);
  //      }

  //  });



  function CheckRadio(obj) {
    var tab = document.getElementsByTagName('input');
    var cnt = tab.length;
    for (x = 0; x < cnt; x++)
      if (tab[x].name == 'myradio')
        if (tab[x] != obj) tab[x].checked = '';
        else tab[x].checked = 'checked';
  }
</script>

<style>
  #ul_compte {
    min-width: 130px;
  }
</style>