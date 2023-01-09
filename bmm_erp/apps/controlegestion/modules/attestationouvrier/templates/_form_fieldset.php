
    <div id="sf_admin_content">  
        <div  class="panel-body">

            <div class="tab-content">  
                <ul class="nav nav-tabs">
                    <li><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsDonnedebase();">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>Données de base </a>
                    </li>


                    <?php if (!$form->getObject()->isNew()) { ?>
                        <li><a id="tabouvrier" href="#ouvrier" data-toggle="tab" aria-expanded="false" ng-click="initialChampsOuvrier();" >
                                <i class="green ace-icon fa fa-money bigger-120"></i>
                                Ouvrier</a>
                        <?php } ?>
                    </li>

                </ul>
                <div class="tab-pane fade active in" id="home"  ng-init="();">
                    <fieldset>
                        <center> <legend><i>         بطــــاقة تشغيل  </i></legend></center>
                        <table style="width: 80%"><tr>

                            <tr>
                                <td>Chantier</td>
                                <td colspan="4"> <?php echo $form['id_chantier'] ?>   
                                </td>
                                <td class="align_right"> الحظيرة
                                </td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td> <?php echo $form['id_service'] ?>   
                                </td>
                                <td class="align_right"> المصلحة
                                </td>
                                <td>Direction</td>
                                <td> <?php echo $form['id_direction'] ?>   
                                </td>
                                <td class="align_right"> الإدارة
                                </td>
                            </tr>
                            <tr>
                                <td>Budget</td>
                                <td> <?php echo $form['budget'] ?>   
                                </td>
                                <td class="align_right"> الميزانية
                                </td>
                                <td>Porte</td>
                                <td> <?php echo $form['porte'] ?>   
                                </td>
                                <td class="align_right"> الباب
                                </td>
                            </tr>
                            <tr>
                                <td>Date debut</td>
                                <td> <?php echo $form['datedebut'] ?>   
                                </td>
                                <td class="align_right"> المدة من 
                                </td>
                                <td>Date fin</td>
                                <td> <?php echo $form['datefin'] ?>   
                                </td>
                                <td class="align_right"> إلى
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <input type="hidden" id="attestationouvrier_id"  value="<?php
                if (!$form->getObject()->isNew())
                    echo $form->getObject()->getId();
                else
                    echo "";
                ?> ">
                       <?php if (!$form->getObject()->isNew()) { ?>
               <div class="tab-pane  fade " id="ouvrier" ng-init="AfficheLignedocOuvrier(<?php echo $attestationouvrier->getId() ?>);" >   
                        <fieldset>
                            <h1>Liste des Ouvriers</h1>
                            <table>
                                <thead>
                                    <tr> <th style="width: 5%">N°ordre<br>(الرقم )</th>
                                        <th style="width: 25%">Nom & Prenom (الاسم واللقب)</th>
                                        <th style="width: 15%">CIN (رقم ب ت و)</th>
                                        <th style="width: 20%">N°inscrit(رقم التسجيل) </th>
                                        <th style="width: 20%">Situation adminstrative<br>(الوضعية الإدارية)</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="formligne">
                                        <td style="width: 5px !important">
                                            <input type="text" value="" ng-model="norgdre.text" id="nordre"  class="form-control disabledbutton" ></td>

                                        <td style="width: 20px">
                                            <?php
                                            $mags = Doctrine_Core::getTable('ouvrier')->findAll();
                                            ?>
                                            <select id="magouvrier">
                                                <option></option>
                                                <?php foreach ($mags as $magouvrier) { ?>
                                                    <option value="<?php echo $magouvrier->getId() ?>"><?php echo $magouvrier ?></option>
                                                <?php } ?>
                                            </select>
                                        </td> 
                                        <td style="width: 15px">  <input type="text" value="" ng-model="cin.text" id="cin" autocomplete="off"  class="form-control disabledbutton" placeholder="CIN"></td>

                                        <td style="width: 15px">
                                            <input type="text" value="" ng-model="ninscrit.text" id="ninscrit" autocomplete="off"  class="form-control disabledbutton" placeholder="N° Inscrit "></td>
                                        <td style="width: 15px" >  
                                            <input type="tsxt" value="" ng-model="situation.text" id="situation" autocomplete="off"  class="form-control disabledbutton" placeholder="Situation adminstrative"></td>
                                        <td style="display : none" >    <input type="tsxt" value="" ng-model="idouvrier.text" id="idouvrier" autocomplete="off"  class="form-control disabledbutton" placeholder="Id ouvrier"></td>
                                        <!-- style="display : none"-->
                                        <td style="width: 15px">
                                            <button type="button" class="btn btn-info btn-circle" ng-click="AjouterLigneOuvrier()"><b>+</b></button>
                                            <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsOuvrier()"><b>-</b></button>
                                        </td>  
                                    </tr>
                                    <tr ng-repeat="lignedocOuvrier in listedocsOuvrier">

                                        <td>{{lignedocOuvrier.norgdre}}</td>
                                        <td id="magouvrier_{{lignedocOuvrier.norgdre}}">
                                            {{lignedocOuvrier.magouvrier}}</td>

                                        <td>{{lignedocOuvrier.cin}}</td>
                                        <td >{{lignedocOuvrier.ninscrit}}</td>
                                        <td >{{lignedocOuvrier.situation}}</td>
                                        <td style="display : none">{{lignedocOuvrier.idouvrier}}</td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourOuvrier(lignedocOuvrier)">
                                                <i class="fa fa-hospital-o"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteOuvrier(lignedocOuvrier)"><i class="fa fa-times"></i>
                                            </button>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            <table style="width: 18px"  align="right">
                                <tbody><tr> 
                                        <td>  
                                            <button type="button" id="btnvaliderouvrier"  class="btn btn-info" ng-click="validerAjout()">valider</button>
                                        </td> 
                                    </tr> 
                                </tbody>  
                            </table>
                        </fieldset>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>  
