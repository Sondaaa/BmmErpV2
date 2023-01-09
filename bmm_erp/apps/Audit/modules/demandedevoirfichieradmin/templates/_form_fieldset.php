
    <div id="sf_admin_content">  
        <div  class="panel-body">

            <div class="tab-content">  
                <ul class="nav nav-tabs">
                    <li><a href="#home" data-toggle="tab" aria-expanded="true" ng-click="initialChampsDonnedebase();">
                            <i class="green ace-icon fa fa-usb bigger-120"></i>Données de base </a>
                    </li>


                    <?php if (!$form->getObject()->isNew()) { ?>
                        <li><a id="tabdossier" href="#dossier" data-toggle="tab" aria-expanded="false" ng-click="initialChampsOuvrier();" >
                                <i class="green ace-icon fa fa-money bigger-120"></i>
                                Copie des dossiers </a>
                        <?php } ?>
                    </li>

                </ul>
                <div class="tab-pane fade active in" id="home"  ng-init="();">
                    <fieldset>
                        <center> <legend><i> طلب الإطلاع على ملف إداري  </i></legend></center>
                        <table style="width: 80%"><tr>

                            <tr>
                                <td>Service</td>
                                <td > <?php echo $form['id_service'] ?>   
                                </td>
                                <td class="align_right"> المصلحـة
                                </td>
                            </tr>
                            <tr>
                                <td>Agents</td>
                                <td> <?php echo $form['id_agents'] ?>   
                                </td>
                                <td class="align_right"> إسم الطالب
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Dossier administratif  des l'Agent</td>
                                <td> <?php echo $form['personne'] ?>   
                                </td>
                                 <td class="align_right"> الملف الإداري للعون 
                                </td>
                            </tr>
                            <tr>
                                <td>Matricule </td>
                                <td> <input id='matricule' data="fixed" placeholder="Matricule">
                                </td>
                                <td class="align_right">  الرقم بالديوان
                                </td>
                            </tr>
                            <tr>
                                <td>Documents à visualiser </td>
                                <td> <?php echo $form['document'] ?>   
                                </td>
                                <td class="align_right"> الوثائق المراد للإطلاع عليها 
                                </td>
                            </tr>
                            
                              <tr>
                                <td> Date de  visualiser </td>
                                <td> <?php echo $form['datedevue'] ?>   
                                </td>
                                <td class="align_right"> تاريخ الإطلاع
                                </td>
                            </tr>
                             <tr>
                                <td> Signature agents  </td>
                                <td> <?php echo $form['signatureagents'] ?>   
                                </td>
                                <td class="align_right"> إمضاء الطالب
                                </td>
                            </tr>
                             <tr>
                                <td> Signature Directeur  </td>
                                <td> <?php echo $form['signaturedirecteur'] ?>   
                                </td>
                                <td class="align_right"> رئيس مصلحة التصرف في الموارد البشرية 
                                </td>
                            </tr>
                            
                        </table>
                    </fieldset>
                </div>

                <input type="hidden" id="demandedevoirfichieradmin_id"  value="<?php
                if (!$form->getObject()->isNew())
                    echo $form->getObject()->getId();
                else
                    echo "";
                ?> ">
                       <?php if (!$form->getObject()->isNew()) { ?>
               <div class="tab-pane  fade " id="dossier" ng-init="AfficheLignedocCopie(<?php echo $demandedevoirfichieradmin->getId() ?>);" >   
                   <!--ng-init="AfficheLignedocCopie(<?php //echo $demandedevoirfichieradmin->getId() ?>);" -->
                        <fieldset>
                            <h1>Liste des Copies des dossiers (النسخ المتحصل عليها  )</h1>
                            <table>
                                <thead>
                                    <tr> <th style="width: 5%">N°ordre<br>(الرقم )</th>
                                        <th style="width: 15%">N°inscrit<br> ( رقم التسجيل)</th>
                                        <th style="width: 15%">Type Document<br> (نوعية الوثيقة )</th>
                                        <th style="width: 15%">Le Contenu <br>(المحتوى)</th>
                                           <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="formligne">
                                        <td style="width: 5px !important">
                                            <input type="text" value="" ng-model="norgdre.text" id="nordre"  class="form-control disabledbutton" ></td>

                                      
                                        <td style="width: 15px"> 
                                            <input type="text" value="" ng-model="num.text" id="num" autocomplete="off"  placeholder="N°Inscrit"></td>

                                        <td style="width: 15px">
                                            <input type="text" value="" ng-model="type.text" id="type" autocomplete="off"   placeholder="Type Document"></td>
                                        <td style="width: 15px" >  
                                            <input type="text" value="" ng-model="contenu.text" id="contenu" autocomplete="off"   placeholder="Contenu "></td>
                                       
                                        <td style="width: 15px">
                                            <button type="button" class="btn btn-info btn-circle" ng-click="AjouterLigneCopie()"><b>+</b></button>
                                            <button type="button" class="btn btn-warning btn-ci" ng-click="InaliserChampsCopie()"><b>-</b></button>
                                        </td>  
                                    </tr>
                                    <tr ng-repeat="lignedocCopie in listedocsCopie">

                                        <td>{{lignedocCopie.norgdre}}</td>
                                        <td >{{lignedocCopie.num}}</td>

                                        <td>{{lignedocCopie.type}}</td>
                                        <td >{{lignedocCopie.contenu}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-circle" ng-click="MisAJourCopie(lignedocCopie)">
                                                <i class="fa fa-hospital-o"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteCopie(lignedocCopie)"><i class="fa fa-times"></i>
                                            </button>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            <table style="width: 18px"  align="right">
                                <tbody><tr> 
                                        <td>  
                                            <button type="button" id="btnvaliderCopie"  class="btn btn-info" ng-click="validerAjoutCopie()">valider</button>
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
