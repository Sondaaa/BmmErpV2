<div id="sf_admin_container">
    <h1>Fiche BCI N°:<?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>
                <li class=""><a ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" href="#profile" data-toggle="tab" aria-expanded="false">Fiche Demande de Prix</a></li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste des Demandes de prix</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $documentachat->getNumerodocachat() ?></h3>
                    <a href="<?php echo url_for('documentachat/etapefinal?etapedoc=9&iddoc=') . $documentachat->getId() ?>" style="float: right;" type="button" class="btn btn-primary">
                        Valider et passer à l'étape suivante
                    </a>
                    <div style="margin-top: 10px;">
                        <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                            <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                        </object>
                    </div>
                </div>
                <div class="tab-pane" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCI(<?php echo $documentachat->getId() ?>);" >
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Demande de prix
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">
                                                DEMANDE DE PRIX N°:
                                                <input type="text" id="numero_dossier" value="<?php echo date('y', strtotime($documentachat->getDatecreation())) . '/' . $numerodemande ?>" >
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
                                        <tr>
                                            <td colspan="2" class="disabledbutton">
                                                DPS N°:
                                                <input type="text" id="numero_dp" value="<?php echo $refernece ?>" >
                                            </td>
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
                                            <td>Référence</td>
                                            <td><input type="text" id="ref" class="form-control" value=""></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label> Objet</label>
                                                <input type="text" id="objet"  class="form-control" value="">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="width: 150%; float: left;border-right: solid 2px black">
                            <p>
                                J'ai l'honneur de vous prier vouloir me faire connaitre vos meilleurs conditions pour la fourniture éventuelle des marchandises désignées ci-dessous,
                                qui seraient à livrer à l'etablisement,<br> dans un délai de <input type="text"  id="delai" style="width: 100px">jour(s) 
                                à partir de la date de notification de la commande ferme.
                                A cet effet, vous voudrez bien completer la présente formule et me la renvoyer pour le <input min="<?php echo date('Y-m-d') ?>" type="date" id="datemax" style="width: 300px">
                                au plus tard 
                            </p>
                            <p style="text-align: center">
                                Sce.Appro
                            </p>
                        </div>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: left"  >
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value=""  ng-model="reffournisseur.text" id="reffournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="button" value="+"  class="btn btn-primary" data-toggle="modal" ng-click="AjouterFournisseur('')" >
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="button" value="-"  class="btn btn-danger" data-toggle="modal" ng-click="ViderFournisseur('')" >
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                        <div style="width: 70%; float: right;">
                            <p>
                                Je m'engage à livrer aux conditions demandées les marchandises cotées 
                                par moi ci-dessous<br> Le .......................
                            </p>
                            <p style="text-align: center">
                                Signature et Cachet du Fournisseur
                            </p>
                        </div>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center" >DESIGNATION<br>
                                        (indiquer,s'il y a lieu, les référence au catalogue du fournisseur)
                                    </th>
                                    <th>Quantité<br> à livrer </th>
                                    <th>Unité</th>
                                    <th>P.Unit.<br>H.T</th>
                                    <th>Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                <tr>
                                    <td><input type="text" class="form-control disabledbutton" style="" id="nordre"  > </td>
                                    <td>
                                        <input type="hidden" id="qtemax" >
                                        <input type="text" class="form-control" ng-model="designation.text" id="designation" ng-click="ChoisArticle(<?php echo $documentachat->getId() ?>)" ng-change="ChoisArticle(<?php echo $documentachat->getId() ?>)"></td>
                                    <td style="width: 80px"><input type="text" ng-model="qte_txt" class="form-control" id="qte_txt" > </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="button" value="+"  class="btn btn-primary"  ng-click="AjouterLignedoc()" > 
                                        <input type="button" value="-"  class="btn btn-danger" ng-click="ViderLignedoc()" >
                                    </td>
                                </tr>-->
                                <tr ng-repeat="lignedoc in lignedocs" >
                                    <td ><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important;width: 100px"> <input id="qte_{{lignedoc.norgdre}}" type="text" value="{{lignedoc.qte|integer}}"></p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCInterne(lignedoc.norgdre)" > 
                                        <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCInterne(lignedoc.norgdre)" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider"  class="btn btn-primary1"  ng-click="ValiderDocumentdeprix(<?php echo $documentachat->getId() ?>)" > 
                    </div>
                </div>
                <div class="tab-pane" style="height:  1200px" id="listesdemandeprix" ng-controller="CtrlListesDemandeprix" ng-init="AfficheDoc(<?php echo $documentachat->getId() ?>)">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Demande de prix
                        </p> 
                    </h4>
                    <div class="col-xs-12 col-lg-12" >
                        <div class="col-xs-12 col-lg-6">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Fournisseur</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="demandeprix in docDemandePrix">
                                        <td>{{demandeprix.numero}}</td>
                                        <td>{{demandeprix.rs}}</td> 
                                        <td>
                                            <input type="button" ng-model="btndetail" ng-click="DetailLignedoc(demandeprix.id)" value="+ Détail">
                                        </td>
                                        <td> <a href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') ?>{{demandeprix.id}}"  ng-model="BtnExporter"  target="_blanc">Exporter PDF</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="divdetail" class="col-xs-12 col-lg-6">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center">Fournisseur sélectionné</th>
                                    </tr>
                                </thead>
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
                                            <thead>
                                                <tr>
                                                    <th>N°ordre</th>
                                                    <th>Designation d'article</th>
                                                    <th>Qte à livrée</th>
                                                </tr>
                                            </thead>
                                            <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                                <td>{{ligne.nordre}}</td>
                                                <td>{{ligne.designationarticle}}</td>
                                                <td>{{ligne.qteaachat|integer}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="documentscan" class="col-md-12">
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
</div>