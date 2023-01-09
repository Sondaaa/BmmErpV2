<div id="sf_admin_content">
  <div class="panel-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a id="enteteplan" href="#entete" data-toggle="tab" aria-expanded="true">
          <i class="green ace-icon fa fa-usb bigger-120"></i>En Tête</a>
      </li>
      <?php if (!$form->getObject()->isNew()) { ?>
        <li  style="display: none"><a id="donne" href="#home" data-toggle="tab" aria-expanded="false" ng-click="intilaiserChamps();">
            <i class="green ace-icon fa fa-money bigger-120"></i>Pièce Joint</a>
        </li>
      <?php } ?>
      <?php if (!$form->getObject()->isNew()) { ?>
        <li><a id="donne" href="#scan" data-toggle="tab" aria-expanded="false" ng-click="intilaiserChamps();">
            <i class="green ace-icon fa fa-money bigger-120"></i>Pièce Joint & Scan</a>
        </li>
      <?php } ?>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade active in" id="entete">
        <fieldset>
          <table>
            <tr>
              <td>Name Dossier</td>
              <td>
                <?php echo $form['name']->renderError() ?>
                <?php echo $form['name'] ?>
              </td>
              <td>Date Création </td>
              <td>
                <?php echo $form['datecreation']->renderError() ?>
                <?php echo $form['datecreation'] ?>
              </td>
              <td>Fournisseur </td>
              <td colspan="2">
                <?php echo $form['id_frs']->renderError() ?>
                <?php echo $form['id_frs'] ?>
              </td>
            </tr>

          </table>
        </fieldset>
      </div>
      <?php if (!$form->getObject()->isNew()) { ?>
        <div style="display: none" class="tab-pane fade " id="home" ng-init="ListePiecejoint(<?php echo $form->getObject()->getId() ?>)">
          <fieldset>
            <legend>liste des Pièces Joints </legend>
            <div class="col-lg-12">
              <input type="hidden" id="dossier_id" value="<?php
                                                          if (!$form->getObject()->isNew())
                                                            echo $form->getObject()->getId();
                                                          else
                                                            echo "";
                                                          ?> ">
              <table style="width: 100%">
                <thead>
                  <tr>
                    <th style="width: 1%">N°ordre</th>
                    <th style="width: 12%">Piecejoint</th>
                    <th style="width: 12%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="formligne">
                    <td>
                      <input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control disabledbutton align_center">
                    </td>

                    <td><input type="file" value="" ng-model="piecejoint.text" id="piecejoint" autocomplete="off" class="form-control "></td>
                    <td style="text-align: center;">
                      <button type="button" class="btn btn-info btn-circle  btn-xs" ng-click="AjouterLigneDossier()"><b>+</b></button>
                      <button type="button" class="btn btn-warning btn-circle  btn-xs" ng-click="InaliserLigneDossier()"><b>-</b></button>
                    </td>
                  </tr>
                  <tr ng-repeat="lignedocDossier in listedocsDossier">
                    <td style="text-align: center">{{lignedocDossier.norgdre}}</td>
                    <td>
                      <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . '' ?> {{lignedocDossier.piecejoint}}">
                        {{lignedocDossier.piecejoint}}
                      </a>
                    </td>

                    <td style="text-align: center;">
                      <button type="button" class="btn btn-info btn-circle btn-xs" ng-click="MisAJourDossier(lignedocDossier)">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-xs btn-danger btn-circle btn-xs" ng-click="DeleteDossier(lignedocDossier)">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

          </fieldset>
          <fieldset style="margin-top: 10px;">
            <div class="col-lg-12">
              <button type="button" id="btnvaliderDossier" class="btn btn-info pull-right" ng-click="ValidersaveDossier()"><i class="ace-icon fa fa-save bigger-110"></i>valider</button>
            </div>
          </fieldset>
        <?php } ?>
        </div>



        
  <?php if (!$form->isNew()) {
    $dossierfourniseur = $form->getObject();
    $id = $dossierfourniseur->getId(); ?>
    <div class="tab-pane" style="height: 670px;" id="scan">

      <?php
     
     
      include_partial('dossierfourniseur/formscan', array('id' => $id, 'dossierfourniseur' => $dossierfourniseur));
      ?>
    </div>
  </div><?php } ?>
</div>
</div>

<style>
  .max_width {
    max-width: 100px;
  }

  .chosen-container,
  .chosen-container-single {
    max-width: 500px;
  }
</style>