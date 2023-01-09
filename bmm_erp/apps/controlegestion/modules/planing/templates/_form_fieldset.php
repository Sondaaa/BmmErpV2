<div id="sf_admin_content">  
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a id="enteteplan" href="#entete" data-toggle="tab" aria-expanded="true">
                    <i class="green ace-icon fa fa-usb bigger-120"></i>En Tête</a>
            </li>
            <?php if (!$form->getObject()->isNew()) { ?>
                <li><a id="donne" href="#home" data-toggle="tab" aria-expanded="false" ng-click="intilaiserChamps();">
                        <i class="green ace-icon fa fa-money bigger-120"></i>Planning</a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">  
            <div class="tab-pane fade active in" id="entete"><!--AfficheDetailAgents -->
                <fieldset>
<!--                    <legend>Entête de Planning</legend>-->
                    <table>
                        <tr>
                            <td>Année Planning</td>
                            <td>
                                <?php echo $form['annee']->renderError() ?>
                                <?php echo $form['annee'] ?>
                            </td>
                            <td>Objet de planning </td>
                            <td colspan="3">
                                <?php echo $form['objet']->renderError() ?>
                                <?php echo $form['objet'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Eligible TFP </td>
                            <td>
                                <?php echo $form['elignible']->renderError() ?>
                                <?php echo $form['elignible'] ?>
                            </td>
                            <td>Non Eligible TFP </td>
                            <td>
                                <?php echo $form['noneligibletfp']->renderError() ?>
                                <?php echo $form['noneligibletfp'] ?>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <?php if (!$form->getObject()->isNew()) { ?> 
                <div class="tab-pane fade " id="home" ng-init="ListeFormationsPrevu(<?php echo $planing->getId() ?>)" >
                    <fieldset>
                        <legend>Planning Prévisionnel</legend>
                        <div class="col-lg-12" ng-init="affichagemontanttotal(<?php echo $planing->getId() ?>)">
                            <input type="hidden" id="planing_id" value="<?php
                            if (!$form->getObject()->isNew())
                                echo $form->getObject()->getId();
                            else
                                echo "";
                            ?> ">
                            <table style="width: 100%">
                                <thead>
                                    <tr> 
                                        <th style="width: 1%">N°ordre</th>
                                        <th style="width: 12%">Besoins</th>
                                        <th style="width: 8%">Matricule</th>
                                        <th style="width: 10%">Agents</th>
                                        <th style="width: 5%; display: none">N°T</th>
                                        <th style="width: 12%">Thème</th>
                                        <th style="width: 10%">Regr.Thèmes</th>
                                        <th style="width: 18%">S.Rubrique</th>

                                        <th style="width: 8%">M.P.TTC</th>
                                        <th style="width: 5%">Validé</th>
    <!--                               <th style="width: 5">T.TVA </th>
                                       <th style="width: 5">TVA </th>
                                       <th style="width: 5">M.TTC </th>-->
                                        <th style="width: 12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="formligne">
                                        <td>
                                            <input type="text" value="" ng-model="norgdre.text" id="nordre" class="form-control disabledbutton align_center">
                                        </td>
                                        <?php
                                        $plan = Doctrine_Core::getTable('planing')->findOneById($planing->getId());
                                        $annee = $plan->getAnnee();
                                        ?>
                                        <td>
                                            <?php
                                            $mags = Doctrine_Query::create()
                                                    ->select('besoins')
                                                    ->from('besoinsdeformation ')
                                                    ->where('besoinsdeformation.annee=' . $annee)
                                                    ->execute();
                                            ?>
                                            <div>
                                                <select id="magbesoins">
                                                    <option></option>
                                                    <?php foreach ($mags as $magbesoins) { ?>
                                                        <option value="<?php echo $magbesoins->getId() ?>">
                                                            <?php echo $magbesoins ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td> 
                                        <td><input type="text" value="" ng-model="idrh.text" id="idrh" autocomplete="off" class="form-control disabledbutton" placeholder="Matricule"></td>
                                        <td><input type="text" value="" ng-model="nom.text" id="nom" autocomplete="off" class="form-control disabledbutton" placeholder="Nom Agents"></td>
                                        <td style="display: none"><input type="text" value="" ng-model="ntheme.text" id="ntheme" autocomplete="off" placeholder="N°Thème" class="align_center"></td>
                                        <td><input type="text" value="" ng-model="theme.text" id="theme" autocomplete="off" placeholder="Thème"></td>
                                        <td>
                                            <?php $mags = Doctrine_Core::getTable('regroupementtheme')->findAll(); ?>
                                            <div>
                                                <select id="magreg">
                                                    <option></option>
                                                    <?php foreach ($mags as $magreg) { ?>
                                                        <option value="<?php echo $magreg->getId() ?>"><?php echo $magreg ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td> 
                                        <td>
                                            <?php $mags = Doctrine_Core::getTable('sousrubrique')->findAll(); ?>
                                            <div>
                                                <select id="magsousrubrique">
                                                    <option></option>
                                                    <?php foreach ($mags as $magsousrubrique) { ?>
                                                        <option value="<?php echo $magsousrubrique->getId() ?>"><?php echo $magsousrubrique ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td><input type="text" value="" class="max_width align_center" ng-model="montantht.text" id="montantht" autocomplete="off" placeholder="M.P.TTC"></td>
    <!--                                            <td>    <input type="text" value="" ng-model="tauxtva.text" id="tauxtva" autocomplete="off"   placeholder="TAUX TVA"></td>
                                        <td>    <input type="text" value="" ng-model="tva.text" id="tva" autocomplete="off"   placeholder="TVA"></td>
                                        <td>    <input type="text" value="" ng-model="montantttc.text" id="montanttc" autocomplete="off"   placeholder="Montant TTC"></td>-->
                                        <td style="text-align: center;"><input type="checkbox" id="valide" name="check_valide"></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="AjouterLignePlaning()"><b>+</b></button>
                                            <button type="button" class="btn btn-warning btn-circle btn-sm" ng-click="InaliserLignePlaning()"><b>-</b></button>
                                        </td>  
                                    </tr>
                                    <tr ng-repeat="lignedocPlaning in listedocsPlaning">
                                        <td style="text-align: center">{{lignedocPlaning.norgdre}}</td>
                                        <td id="magbesoins{{lignedocPlaning.norgdre}}">{{lignedocPlaning.magbesoins}}</td>
                                        <td>{{lignedocPlaning.idrh}}</td>
                                        <td>{{lignedocPlaning.nom}}</td>
                                        <!--<td style="text-align: center ; dispaly: none">{{lignedocPlaning.ntheme}}</td>-->                                         
                                        <td>{{lignedocPlaning.theme}}</td>
                                        <td>{{lignedocPlaning.magreg}}</td>
                                        <td>{{lignedocPlaning.magsousrubrique}}</td>
                                        <td style="text-align: center">{{lignedocPlaning.montantht}}</td>
                                        <td style="text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocPlaning.valide"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocPlaning.valide == false"></i>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-info btn-circle btn-xs" ng-click="MisAJourPlaningn(lignedocPlaning)">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-circle btn-xs" ng-click="DeletePlaning(lignedocPlaning)">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #F2F2F2;"> 
                                        <td colspan="7"></td>
                                        <td style="text-align: center; font-size: 16px; vertical-align: middle;">Total</td>
                                        <td class="disabledbutton">
                                            <input type="text" id="montanttotal" class="align_center" style="max-width: 100px;" placeholder="M.T.P.HT">
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset style="margin-top: 10px;">
                        <div class="col-lg-12">
                            <button type="button" id="btnvaliderPlan" class="btn btn-info pull-right" ng-click="ValidersavePlanning()"><i class="ace-icon fa fa-save bigger-110"></i>valider</button>
                        </div>
                    </fieldset>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>

    .max_width{max-width: 100px;}
    .chosen-container, .chosen-container-single{max-width: 200px;}

</style>