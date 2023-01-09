<div id="sf_admin_container">
    <h1>Fiche BCI N°:<?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php if ($tab == "") echo 'active' ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>
                <li class=""><a href="#profilep" data-toggle="tab" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" aria-expanded="false">Fiche Bon de Commande Externe (système) Provisoire</a></li>
                <li class="<?php if ($tab == "3") echo 'active' ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix(); AfficheDocBCEP(<?php echo $documentachat->getId() ?>)">Fiche Bon de Commande Externe</a></li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bon de Commandes Externe</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane <?php if ($tab == "") echo 'fade active in' ?>" id="home">
                    <h4>Bon de commande Interne N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 
<!--                    <div>  <a href="<?php //echo url_for('documentachat/etapefinal?etapedoc=11&iddoc=') . $documentachat->getId()          ?>" style="margin-left: 40%" type="button"    class="btn btn-primary"  >
                            Valider et passer à l'étape suivante
                        </a>
                        <a  href="<?php //echo url_for('documentachat/index')          ?>" class="btn btn-primary">Annuler </a>
                    </div>-->
                    <div style="margin-top: 10px;">
                        <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                            <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                        </object>
                    </div>
                </div>
                <div class="tab-pane" id="profilep" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE(<?php echo $documentachat->getId() ?>, 'p')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de commande externe (Système) provisoire
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td colspan="2">B.C.E.S.P N°:  <?php echo $numerobcep ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php echo $documentachat->getNumerodocachat() ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d-m-Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Max Date de réponse</td>
                                            <td>
                                                <input id="maxreponse_p" min="<?php echo date('Y-m-d') ?>" type="date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Note</td>
                                            <td>
                                                <?php $notes = Doctrine_Core::getTable('notesbce')->findAll(); ?>
                                                <select id="idnote_p">
                                                    <option value="0"></option>
                                                    <?php foreach ($notes as $note) { ?>
                                                        <option value="<?php echo $note->getId() ?>"><?php echo $note ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lieu de livraison</td>
                                            <td>
                                                <select id="id_lieu_p">
                                                    <option value="0">--Sélectionnez--</option>
                                                    <?php foreach ($lieuxlivraisons as $lieu) { ?>
                                                        <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getLibelle() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: left"  >
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value=""  ng-model="reffournisseur_p.text" id="reffournisseur_p" class="form-control" ng-change="AfficheFournisseur('_p')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur_p.text" id="fournisseur_p" class="form-control" ng-change="AfficheFournisseur('_p')">
                                            </td>
                                            <td>
                                                <input type="button" value="+" class="btn btn-primary" data-toggle="modal" ng-click="AjouterFournisseur('_p')" >
                                            </td>
                                            <td>
                                                <input type="button" value="-" class="btn btn-danger" data-toggle="modal" ng-click="ViderFournisseur('_p')" >
                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                DESIGNATION DE LA COMMANDE<textarea id="descriptionbce_p"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center" >DESIGNATION<br>
                                        (indiquer,s'il y a lieu, les références au catalogue du fournisseur)
                                    </th>
                                    <th style="width: 80px">Quantité<br> à livrer </th>
                                    <th style="width: 80px">P.Unit.<br>H.T</th>
                                    <th style="width: 80px">Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignedoc in lignedocsdeponsep" >
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="qte_p_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" >{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="puht_p_{{lignedoc.norgdre}}" value="{{lignedoc.puht}}"  ></p></td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_p_{{lignedoc.norgdre}}" >
                                                <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control"></textarea>
                                        </p>
                                    </td>
                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, 'p_')" > 
                                        <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, 'p_')" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary" ng-click="ValiderBondexterne(<?php echo $documentachat->getId() ?>, '_p')" > 
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE(<?php echo $documentachat->getId() ?>, '')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de commande externe
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td class="disabledbutton">
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Bon de commande externe N°: <?php echo $numerodemande ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php echo $documentachat->getNumerodocachat() ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d/m/Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Max Date de réponse</td>
                                            <td><input id="maxreponse" min="<?php echo date('Y-m-d') ?>" type="date"></td>
                                        </tr>
                                        <tr>
                                            <td>Note</td>
                                            <td>
                                                <?php
                                                $notes = Doctrine_Core::getTable('notesbce')->findAll();
                                                ?>
                                                <select id="idnote">
                                                    <option value="0"></option>
                                                    <?php foreach ($notes as $note) { ?>
                                                        <option value="<?php echo $note->getId() ?>"><?php echo $note ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lieu de livraison</td>
                                            <td>
                                                <select id="id_lieu">
                                                    <option value="0">--Sélectionnez--</option>
                                                    <?php foreach ($lieuxlivraisons as $lieu) { ?>
                                                        <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getLibelle() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table ng-init="InialiserDemandePrix(); AfficheDocBCEP(<?php echo $documentachat->getId() ?>)" >
                                        <tr class="disabledbutton">
                                            <td colspan="5">
                                                <select id="listesbdcp" style="width: 100%">
                                                    <option value="0">-->Sélectionnez BCEP</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id ===<?php echo $idbdcp ?>" selected="selected" value="{{demandeprix.id}}" ng-init="EtatBCEP_dans_budget(demandeprix.id)" >{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id !=<?php echo $idbdcp ?>"  value="{{demandeprix.id}}" ng-click="EtatBCEP_dans_budget(demandeprix.id)" >{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr class="disabledbutton">
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value="" ng-model="reffournisseur.text" id="reffournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="button" value="+" class="btn btn-primary" data-toggle="modal" ng-click="AjouterFournisseur('')" >
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="button" value="-" class="btn btn-danger" data-toggle="modal" ng-click="ViderFournisseur('')" >
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="margin-bottom: 0px;">
                                        <tr class="disabledbutton">
                                            <td colspan="2">
                                                DESIGNATION DE LA COMMANDE<textarea id="descriptionbce"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center" >DESIGNATION<br>
                                        (indiquer, s'il y a lieu, les références au catalogue du fournisseur)
                                    </th>
                                    <th style="width: 80px">Quantité<br> à livrer </th>
                                    <th style="width: 80px">P.Unit.<br>H.T</th>
                                    <th style="width: 80px">Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                <tr>
                                    <td><input type="text" class="form-control disabledbutton" style="" id="nordre"  > </td>
                                    <td>
                                        <input type="hidden" id="qtemax">
                                        <input type="text" class="form-control" ng-model="designation.text" id="designation" ng-click="ChoisArticle(<?php echo $documentachat->getId() ?>)" ng-change="ChoisArticle(<?php echo $documentachat->getId() ?>)"></td>
                                    <td><input type="text" class="form-control" style="" id="qte"  ></td>
                                    <td><input type="text" class="form-control" style="" id="puht"  ></td>
                                    <td>
                                        <select id="tva" >
                                            <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea id="desc" class="form-control"></textarea>
                                    </td>
                                    <td style="width: 120px">
                                        <input type="button" value="+"  class="btn btn-primary"  ng-click="AjouterLignedocBondeponse()" > 
                                        <input type="button" value="-"  class="btn btn-danger" ng-click="ViderLignedocBondeponse()" >
                                    </td>
                                </tr>-->
                                <tr ng-repeat="lignedoc in lignedocsdeponse" >
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" >{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.mntht}}" ></p></td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_{{lignedoc.norgdre}}" >
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva == tva.id" selected="selected" value="{{tva.id}}">{{tva.libelle}}</option>
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva != tva.id" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_{{lignedoc.norgdre}}" class="form-control">{{lignedoc.observation}}</textarea>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, '')" > 
                                        <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="btnvalider_bdcd" class="disabledbutton">
                            <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary" ng-click="ValiderBondexterne(<?php echo $documentachat->getId() ?>, '')" > 
                        </div>
                    </div>
                </div>
                <div class="tab-pane" style="height:  1200px" id="listesdemandeprix" ng-controller="CtrlListesBonexterne" ng-init="AfficheDoc(<?php echo $documentachat->getId() ?>)">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des bons de commandes externes
                        </p>
                    </h4>
                    <div class="col-xs-12 col-lg-6">
                        <table >
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Type</th>
                                    <th>Fournisseur</th>                                
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="demandeprix in docDemandePrix">
                                    <td>{{demandeprix.numero}}</td>
                                    <td>{{demandeprix.libelletypedoc}}</td>
                                    <td>{{demandeprix.rs}}</td> 
                                    <td>
                                        <table>
                                            <tr>
                                                <td><input type="button" ng-model="btndetail" class="btn btn-primary1" ng-click="DetailLignedoc(demandeprix.id); TestAjouterSignature(demandeprix.id)" value="+ Détail">
                                                </td>
                                                <td>
                                                    <a href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') ?>{{demandeprix.id}}" class="btn btn-primary1" ng-model="BtnExporter"  target="_blanc">Exporter PDF</a>
                                                </td>    
                                            </tr>
                                            <tr id="atr_{{demandeprix.id}}" class="disabledbutton" ng-if="demandeprix.idtypedoc === 7">
                                                <td colspan="2">
                                                    Date Signature:<input type="date" id="datesignature{{demandeprix.id}}">
                                                    <input type="button" value="Valider" ng-click="ValiderSignature(demandeprix.id)">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-lg-6" id="divdetail">
                        <table>
                            <tr>
                                <th colspan="2" style="text-align: center;">Fournisseur sélectionné</th>
                            </tr>
                            <tr>
                                <td>Raison social</td>
                                <td>{{detailfrs.rs}}</td>
                            </tr>
                            <tr>
                                <td>Adresse fournisseur</td>
                                <td>{{detailfrs.adrs}}</td>
                            </tr>
                            <tr>
                                <td>Annuaire fournisseur</td>
                                <td>{{detailfrs.annuaire}}</td>
                            </tr>
                            <tr>
                                <td>Activité</td>
                                <td>{{detailfrs.description}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <th>N°ordre</th>
                                            <th>Designation d'article</th>
                                            <th>Qte</th>
                                            <th>Prix<br>U.H.T</th>
                                            <th>Observation</th>
                                        </tr>
                                        <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                            <td>{{ligne.nordre}}</td>
                                            <td>{{ligne.designationarticle}}</td>
                                            <td>{{ligne.qte|integer}}</td>
                                            <td>{{ligne.mntht}}</td>
                                            <td>{{ligne.observation}}</td>
                                        </tr>
                                    </table>
                                    <table ng-if="atrubition != ''">
                                        <tr>
                                            <th >Attribution budgetaire</th>
                                        </tr>
                                        <tr>
                                            <td><div ng-bind-html=" atrubition | trusted"></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div id="documentscan" class="col-xs-12 col-lg-12">
                        <div id="sf_admin_content" ng-controller="CtrlScan">
                            <div class="row ">
                                <div  class="col-md-6">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" id="imgmodel" style="height: 600px">

                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <fieldset style="padding: 10px">
                                                <legend>Attacher fiche scanner</legend>
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();"  class="btn btn-info">
                                                        <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click=""  class="btn btn-info">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset style="padding: 10px;">
                                                <div class="col-lg-12" >
                                                    <div class="content">
                                                        <input type="button" value="AFFICHE LES ATTACHEMENTS" ng-click="AfficheDemandedeprix(detailfrs.demandedeprixid);"  class="btn btn-info"><br>
                                                        <table>
                                                            <tr ng-repeat="att in attachements">
                                                                <td>
                                                                    <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}">
                                                                        <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}" style="width: 50px">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>