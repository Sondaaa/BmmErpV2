<?php
$taux_tva = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('tva')
  ->orderBy('libelle')->execute();
$labo_id = 25;
$user = $sf_user->UserConnected();
$check = false;
$etage = null;

if ($user && $user->getIsAdmin()) {
  $etage = $user->getAdministartionSite();
  $labo_id = $etage->getId();
  $check = true;
} else {
  if (!$user->getIdMagasin()) {
    $etage = EtageTable::getInstance()->find(25);
    $labo_id = $etage->getId();
    $check = true;
  } else {
    $etage = $user->getLaboName();
    $labo_id = $etage->getId();
    $check = true;
  }
}
$liste_projet = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('projet')
  ->where('id_soussite=' . $labo_id)
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
$demanedeurs = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('demandeur')
  ->orderBy('id')
  ->execute();

$acces_stock = $user->getProfilApplication("Unité Gestion des Stocks");
$acces_magasin = $user->getProfilApplication("ADMINISTRATEUR MAGASIN");
?>
<input type="hidden" id="user_stock" value="<?php echo $acces_stock ?>">
<input type="hidden" id="user_magasin" value="<?php echo $acces_magasin ?>">
<input type="hidden" id="documentachat_id_emplacement" name="documentachat[id_emplacement]" value='<?php echo $labo_id ?>'>
<input type="hidden" id="etage_id" value="<?php echo $labo_id ?>">
<input type="hidden" ng-model="typedocid.text" id="idtypedoc" value="<?php echo $idtype; ?>">
<input type="hidden" id="id_typedoc" value="<?php echo $idtype; ?>">
<div class="row">
  <div <?php if ($form->isNew()) : echo 'class="col-md-12"';
        elseif ($form->getObject()->getIdNaturedoc() != '1') : echo 'class="col-md-8"';
        else : echo 'class="col-md-12"';
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
          <td>Montant Estimatif (TND):<span id="required_mnt" class="required">*</span> </td>
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
                Demandeur<span class="required">*</span>
                <div class="col-md-12 disabledbutton ">
                  <select id="documentachat_id_demandeur" name="documentachat[id_demandeur]">
                    <option id="0"></option>
                    <?php foreach ($demanedeurs as $deman) : ?>
                      <option value="<?php echo $deman->getId() ?>" <?php if ($form->getObject()->isNew() && $deman->getIdAgent() == $user->getIdParent()) : ?> selected="true" <?php elseif (!$form->getObject()->isNew() && $deman->getId() == $form->getObject()->getIdDemandeur()) : echo 'selected="true"';
                                                                                                                                                                              endif; ?>>
                        <?php echo $deman->getAgents() ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <?php if ($user->getIsAdmin()) : ?>
                <div class="col-md-4" id="div_date_signature">
                  Date Signature
                  <?php echo $form['datesignaturebci']->renderError() ?>
                  <?php echo $form['datesignaturebci']->render(array('class' => 'form-control', 'max' => date('Y-m-d'))) ?>
                </div>
              <?php endif; ?>
              <div class="col-md-4" id="div_id_projet">


                <div class="row">

                  <div class="col-md-12">
                    Projet:<span class="required">*</span>
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

              </div>



            </div>
          </td>

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
                        <td colspan="3">
                          <div class="col-md-12">



                            <i class="ace-icon fa fa-check-square-o " ng-if="lignedoc.is_sps=='is_stockable'">Article Stock</i>
                            <i class="ace-icon fa fa-square-o " ng-if="lignedoc.is_sps!='is_stockable' "> Article Stock</i>

                          </div>


                          <div class="col-md-12">


                            <i class="ace-icon fa fa-check-square-o " ng-if="lignedoc.is_sps=='is_patrimoine'">Article Patrimoine</i>
                            <i class="ace-icon fa fa-square-o " ng-if="lignedoc.is_sps!='is_patrimoine'">Article Patrimoine</i>

                          </div>
                          <div class="col-md-12">


                            <i class="ace-icon fa fa-check-square-o " ng-if="lignedoc.is_sps=='is_service'">Service ou Autre</i>
                            <i class="ace-icon fa fa-square-o " ng-if="lignedoc.is_sps!='is_service'">Service ou Autre</i>

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
                <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('documentachat/index?idtype=' . $idtype) ?>">Retour à la liste</a>
                <?php

                if (!$form->isNew()) {
                  $idtype = $form->getObject()->getIdTypedoc();
                }
                if ($idtype == 4) :
                ?>
                  <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchatAcceuil('<?php echo $documentachat->getId(); ?>', '<?php echo $check ?>','<?php echo $idtype ?>')" type="button" value="Enregistrer D.I. & Envoyer  " class="btn btn-xs btn-success" />
                <?php elseif ($idtype == 6) : ?>
                  <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchatAcceuil('<?php echo $documentachat->getId(); ?>', true,'<?php echo $idtype ?>')" type="button" value="Enregistrer D.I. & Envoyer " class="btn btn-xs btn-success" />
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
  <?php if (!$form->isNew() && $form->getObject()->getIdNaturedoc() != 1) { ?>
    <div class="col-md-4" id="documentscan">
      <?php
      $id = $form->getObject()->getId();
      $docuementachat = $form->getObject();
      include_partial('documentachat/formscan', array('id' => $id, 'documentachat' => $documentachat));
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
  function SelectMagasinByUser() {

    var user_magasin = $('#user_magasin').val();
    var user_stock = $('#user_stock').val();
    var id_typedoc = $('#id_typedoc').val();
    if (user_magasin) {
      //$("#documentachat_id_naturedoc").val(1);
      $('#documentachat_id_naturedoc option[value!=1][value!=7]').prop('disabled', 'true');
      //$('#documentachat_id_naturedoc option[value!=7]').prop('disabled', 'true');
      $('#documentachat_id_demandeur').parent().removeClass('disabledbutton');
    } else {

      if ($('#documentachat_id_naturedoc').val() == '') {
        $('#documentachat_id_naturedoc option[value=1]').prop('disabled', 'true');
        $('#documentachat_id_naturedoc option[value=7]').prop('disabled', 'true');
      }

    }
    if (user_stock) {
      if ($('#documentachat_id_naturedoc').val() == 1) {

        $('#formligne').attr('style', 'display:none');
        $('#sans_stockable td button').attr('style', 'display:none');
      }
    }

    if (id_typedoc == 6) {
      $('#documentachat_id_naturedoc option[value!=2]').prop('disabled', 'true');
    }

  }
  SelectMagasinByUser();

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

  function affichageChekbox() {
    // if ($('#service').val()=='on'){
    //  // alert($('#service').val()+'rrrrrrrr');
    //     $('#stockable').removeAttr('checked');
    //     $('#stockable').removeAttr('checked');
    //   }
  }
  //patrimoine service

  // $('.list_checbox_type').change(function() {

  //   if ($('#stockable').is(':checked') == true && $('#patrimoine').is(':checked')) {
  //     $('#patrimoine').prop('checked', true);
  //     $('#service').prop('checked', false);
  //     $('#stockable').prop('checked', false);
  //   }

  //   if ($('#stockable').is(':checked') == true && $('#service').is(':checked')) {
  //     $('#patrimoine').prop('checked', false);
  //     $('#service').prop('checked', true);
  //     $('#stockable').prop('checked', false);
  //   }
  //   if ($('#patrimoine').is(':checked') == true && $('#service').is(':checked') == true) {

  //     $('#patrimoine').prop('checked', false);
  //     $('#service').prop('checked', true);
  //     $('#stockable').prop('checked', false);
  //   }

  // });

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