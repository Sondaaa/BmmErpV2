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
$demanedeurs = Doctrine_Query::create()
  ->select("id,libelle")
  ->from('demandeur')
  ->orderBy('id')
  ->execute();
?>
<?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
<?php
$user = UtilisateurTable::getInstance()->find($sf_user->getAttribute('userB2m')->getId());

if ($user->getIdMagasin()) {
  if ($user->getIsAdmin()) {
    $labo = $user->getAdministartionSite();
  } else {
    $labo = $user->getLaboName();
  }

  if ($labo) {
    $idmagasins = $labo->getId();
  }
} ?>
<input type="hidden" id="documentachat_id_emplacement" name="documentachat[id_emplacement]" value='<?php if ($user && $idmagasins) {
                                                                                                      echo $idmagasins;
                                                                                                    }
                                                                                                    ?>'>
<input type="hidden" ng-model="typedocid.text" id="idtypedoc" value="<?php echo $idtype; ?>">
<input type="hidden" id="id_typedoc" value="<?php echo $idtype; ?>">
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
                      <td><?php echo $numero; ?></td>
                    </tr>
                    <tr>
                      <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                      <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
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

          <fieldset style="width: 100%">
            <legend>Données de base</legend>
            <table>
              <div class="row">


                <tbody>
                  <tr>
                    <td>
                      <label>Référence</label>

                      <?php echo $form['reference']->renderError() ?>
                      <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                    </td>
                    <td>

                      <label>Demandeur</label>

                      <div class="col-md-12 disabledbutton ">
                        <select id="documentachat_id_demandeur" name="documentachat[id_demandeur]">
                          <option id="0"></option>
                          <?php foreach ($demanedeurs as $deman) : ?>
                            <option value="<?php echo $deman->getId() ?>" <?php if ($deman->getIdAgent() == $user->getIdParent()) : ?> selected="true" <?php endif; ?>>
                              <?php echo $deman->getAgents() ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>


                    <td>
                      <div id="div_id_projet">
                        <label>Projet</label>


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

                    </td>
                    <td>
                      <label>Date Signature</label>
                      <?php echo $form['datesignaturebci']->renderError() ?>
                      <?php echo $form['datesignaturebci']->render(array('class' => 'form-control')) ?>
                    </td>
            </table>
          </fieldset>
          <hr>
          <?php
          $liste_unite = Doctrine_Query::create()
            ->select("id,libelle")
            ->from('unitemarche')
            ->orderBy('libelle')->execute();
          $user = $sf_user->UserConnected();
          $etage = null;
          if ($user && $user->getIsAdmin()) {
            $etage = $user->getAdministartionSite();
          } else {
            $etage = EtageTable::getInstance()->find(25);
          }

          $liste_projet = Doctrine_Query::create()
            ->select("id,libelle")
            ->from('projet')
            ->orderBy('libelle')->execute();
          ?>
          <input type="hidden" id="etage_id" value="<?php echo $etage->getId() ?>">
          <div id="my-carac" class="modal fade" tabindex="-1" style="width: 1200px">
            <?php include_partial('caracteristique', array()); ?>
          </div>

          <div id="my-carac_stockable" class="modal fade" tabindex="-1" style="width: 1200px">
            <?php include_partial('caracteristique_stockable', array()); ?>
          </div>
          <div id="general" class="row" ng-init="AfficheLignedocumentBCI('<?php echo $documentachat->getId(); ?>')">
            <div class="col-md-12">
              <fieldset>
                <legend>Liste des articles</legend>
                <div id="sans_stockable">
                  <table>
                    <thead>
                      <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation</th>
                        <th>Quantité</th>
                        <th>Unité/Conditionnement</th>
                        <!-- <th>Projet</th> -->
                        <!-- <th>Observation</th> -->
                        <th>Caracteristique Article</th>
                        <th>Action</th>
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


                          <?php //include_partial('caracteristique', array())
                          ?>


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
                        <!-- <td>{{lignedoc.caracteristique}}</td> -->
                        <td>
                          <button type="button" class="btn btn-info btn-xs btn-circle" ng-click="MisAJourAcc(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                          <button type="button" class="btn btn-warning btn-xs btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="avec_stockable" style="display: none" ng-init="AfficheLignedocumentBCIDA('<?php echo $documentachat->getId(); ?>')">
                  <table>
                    <thead>
                      <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation</th>
                        <th>Article stockable</th>
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

                        <td style="width: 27%">
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

                        <td style="text-align: center">
                          <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedoc.stockable"></i>
                          <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedoc.stockable == false"></i>
                        </td>
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
              </fieldset>

            </div>
            <div class="col-md-12">
              <fieldset style="margin-left: 35%">
                <legend>Action Fiche BCI</legend>
                <div>
                  <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('documentachat/index?idtype=' . $idtype) ?>">Retour à la liste</a>
                  <?php

                  if (!$form->isNew()) {
                    $idtype = $form->getObject()->getIdTypedoc();
                  }
                  if ($idtype == 4) :
                  ?>
                    <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchatAcceuil('<?php echo $documentachat->getId(); ?>', true,'<?php echo $idtype ?>')" type="button" value="Enregistrer D.I. & Envoyer  " class="btn btn-xs btn-success" />
                  <?php elseif ($idtype == 6) : ?>
                    <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchatAcceuil('<?php echo $documentachat->getId(); ?>', true,'<?php echo $idtype ?>')" type="button" value="Enregistrer D.I. & Envoyer " class="btn btn-xs btn-success" />
                  <?php endif; ?>

                </div>
              </fieldset>
            </div>

          </div>
        </div>
        <?php if (!$form->isNew()) { ?>
          <div class="tab-pane" style="height: 670px;" id="documentscan">
            <?php
            $id = $form->getObject()->getId();
            $docuementachat = $form->getObject();
            include_partial('documentachat/formscan', array('id' => $id, 'documentachat' => $documentachat));
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
</script>
<script type="text/javascript">
  function showErrorAlert(reason, detail) {
    var msg = '';
    if (reason === 'unsupported-file-type') {
      msg = "Unsupported format " + detail;
    } else { //console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' + '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
  }

  //but we want to change a few buttons colors for the third style
  $('#editor1').ace_wysiwyg({
    toolbar: ['font',
      null,
      'fontSize',
      null,
      {
        name: 'bold',
        className: 'btn-info'
      },
      {
        name: 'italic',
        className: 'btn-info'
      },
      {
        name: 'strikethrough',
        className: 'btn-info'
      },
      {
        name: 'underline',
        className: 'btn-info'
      },
      null,
      {
        name: 'insertunorderedlist',
        className: 'btn-success'
      },
      {
        name: 'insertorderedlist',
        className: 'btn-success'
      },
      {
        name: 'outdent',
        className: 'btn-purple'
      },
      {
        name: 'indent',
        className: 'btn-purple'
      },
      null,
      {
        name: 'justifyleft',
        className: 'btn-primary'
      },
      {
        name: 'justifycenter',
        className: 'btn-primary'
      },
      {
        name: 'justifyright',
        className: 'btn-primary'
      },
      {
        name: 'justifyfull',
        className: 'btn-inverse'
      },
      null,
      {
        name: 'createLink',
        className: 'btn-pink'
      },
      {
        name: 'unlink',
        className: 'btn-pink'
      },
      null,
      {
        name: 'insertImage',
        className: 'btn-success'
      },
      null,
      'foreColor',
      null,
      {
        name: 'undo',
        className: 'btn-grey'
      },
      {
        name: 'redo',
        className: 'btn-grey'
      }
    ],
    'wysiwyg': {
      fileUploadError: showErrorAlert
    }
  }).prev().addClass('wysiwyg-style2');

  function setFormat(which) {
    var toolbar = $('#editor1').prev().get(0);
    if (which >= 1 && which <= 4) {
      toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g, '');
      if (which == 1)
        $(toolbar).addClass('wysiwyg-style1');
      else if (which == 2)
        $(toolbar).addClass('wysiwyg-style2');
      if (which == 4) {
        $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
      } else
        $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
    }
  }

  setFormat(4);

  //RESIZE IMAGE

  //Add Image Resize Functionality to Chrome and Safari
  //webkit browsers don't have image resize functionality when content is editable
  //so let's add something using jQuery UI resizable
  //another option would be opening a dialog for user to enter dimensions.
  if (typeof jQuery.ui !== 'undefined' && ace.vars['webkit']) {
    var lastResizableImg = null;

    function destroyResizable() {
      if (lastResizableImg == null)
        return;
      lastResizableImg.resizable("destroy");
      lastResizableImg.removeData('resizable');
      lastResizableImg = null;
    }

    var enableImageResize = function() {
      $('.wysiwyg-editor')
        .on('mousedown', function(e) {
          var target = $(e.target);
          if (e.target instanceof HTMLImageElement) {
            if (!target.data('resizable')) {
              target.resizable({
                aspectRatio: e.target.width / e.target.height,
              });
              target.data('resizable', true);

              if (lastResizableImg != null) { //disable previous resizable image
                lastResizableImg.resizable("destroy");
                lastResizableImg.removeData('resizable');
              }
              lastResizableImg = target;
            }
          }
        })
        .on('click', function(e) {
          if (lastResizableImg != null && !(e.target instanceof HTMLImageElement)) {
            destroyResizable();
          }
        })
        .on('keydown', function() {
          destroyResizable();
        });
    }

    enableImageResize();

    /**
     //or we can load the jQuery UI dynamically only if needed
     if (typeof jQuery.ui !== 'undefined') enableImageResize();
     else {//load jQuery UI if not loaded
     //in Ace demo ./components will be replaced by correct components path
     $.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
     enableImageResize()
     });
     }
     */
  }
</script>
<style>
  #ul_compte {
    min-width: 130px;
  }
</style>
<style>
  .wysiwyg-editor {
    max-height: 250px;
    height: 250px;
  }
</style>