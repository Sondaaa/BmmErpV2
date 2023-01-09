<div id="sf_admin_container" ng-controller="CtrlPresence">

    <div id="sf_admin_content">  
        <div  class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li><a href="#home" data-toggle="tab" aria-expanded="true" >
                        <i class="green ace-icon fa fa-usb bigger-120"></i>Type congé   </a>
                </li>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <li><a id="idclassification" href="#classification" data-toggle="tab" aria-expanded="false"  ng-click="Intitialiser();">
                            <i class="green ace-icon fa fa-money bigger-120"></i>
                            Classification Congé</a>
                    <?php } ?>
                </li>

            </ul>
            <div class="tab-content">  
                <div class="tab-pane fade active in" id="home" >

                    <fieldset >
                        <table>
                            <tbody>
                                <tr>
                                    <td ><label>  Type Congé    </label></td>
                                    <td>
                                        <?php echo $form['libelle']->renderError() ?>
                                        <?php echo $form['libelle'] ?>
                                    </td>
                                    <td ><label> Nbr.Jour( Droit de repos )  </label></td>
                                    <td>
                                        <?php echo $form['nbrjour']->renderError() ?>
                                        <?php echo $form['nbrjour'] ?>
                                    </td>

                                    <td ><label> Payé/Non.P    </label></td>
                                    <td>
                                        <?php echo $form['paye']->renderError() ?>
                                        <?php echo $form['paye'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><label> Modalité de Calcul</label></td>
                                    <td  colspan="6">
                                        <?php echo $form['modalitecalcul']->renderError() ?>
                                        <?php echo $form['modalitecalcul'] ?>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <div class="tab-pane  fade  " id="classification" ng-init="affichageligneclassification(<?php echo $form->getObject()->getId(); ?>)" >
                        <fieldset>  
                            <div class="col-lg-8"  > 

                                <h1>Classification des Jours du Congé</h1>
                                <table>
                                    <thead>
                                        <tr> <th style="width: 5%">N°ordre</th>
                                            <th style="width: 15%">Nombre Jour</th>
                                            <th style="width: 35">Type Traitement</th>
                                            <th style="width: 30%">Avec Commission Médicale </th>
                                            <th style="width: 15">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="formligne">

                                    <input type="hidden" id="typeconge_id" value="<?php
                                    if (!$form->getObject()->isNew())
                                        echo $form->getObject()->getId();
                                    else
                                        echo "";
                                    ?> ">
                                    <td style="text-align: center;"><input type="text" value="" ng-model="norgdre.text" id="nordre"  class="form-control disabledbutton align_center" ></td>

                                    <td style="text-align: center;"> <input  type="text" value="" ng-model="nbrj.text" id="nbrj"  class="form-control align_center " ></td>
                                    <td> <select id="typetraitement" name="typetraitement">
                                            <option></option>
                                            <option value="Traitement Complet">Traitement Complet</option>
                                            <option value="Demi Traitement">Demi Traitement</option>
                                        </select>
                                    </td>

                                    <td style="text-align: center;"><input type="checkbox" id="commmsion" name="check_commision"></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-circle btn-sm" ng-click="AjouterLigneClassification()"><b>+</b></button>
                                        <button type="button" class="btn btn-warning btn-ci btn-sm" ng-click="InaliserChampsClassification()"><b>-</b></button>
                                    </td>  
                                    </tr>
                                    <tr ng-repeat="lignedocClassificationConge in listedocsClassificationConge">

                                        <td class="align_center">{{lignedocClassificationConge.norgdre}}</td>
                                        <td  class="align_center">{{lignedocClassificationConge.nbrj}}</td>
                                        <td >{{lignedocClassificationConge.typetraitement}}</td>
                                        <!--<td>{{lignedocClassificationConge.commmsion}}</td>-->

                                        <td style="text-align: center">
                                            <i class="ace-icon fa fa-check-square-o bigger-170" ng-if="lignedocClassificationConge.commmsion"></i>
                                            <i class="ace-icon fa fa-square-o bigger-170" ng-if="lignedocClassificationConge.commmsion == false"></i>
                                        </td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-info btn-circle btn-xs"  ng-click="MisAJourClassification(lignedocClassificationConge)">
                                                <i class="fa fa-hospital-o"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-circle btn-xs" ng-click="DeleteClassification(lignedocClassificationConge)"><i class="fa fa-times"></i>
                                            </button>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                                <table style="width: 18px"  align="right">
                                    <tbody><tr> 
                                            <td>  
                                                <button type="button" id="btnvalideClassification"  class="btn btn-info" ng-click="validerClassification()">valider</button>
                                            </td> 
                                        </tr> 
                                    </tbody>  
                                </table>
                            </div>
                        </fieldset>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
