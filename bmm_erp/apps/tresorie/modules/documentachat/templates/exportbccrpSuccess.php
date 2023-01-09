<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat() ?><?php endforeach; ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $resultat = 0;
    $quitance = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($idbdcp, 2);
    if (sizeof($quitance) >= 1) {
        $mnt_quitance = 0;
        foreach ($quitance as $q):
            $mnt_quitance+= $q->getMntoperation()+ floatval($q->getRetenuetva())+floatval($q->getRetenueirrp());
        endforeach;
    }
    ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>
<!--<li class="<?php // if ($tab == "") echo 'active'  ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>-->
                <li class="<?php if ($tab != "3") echo 'active' ?>"><a href="#profilep" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserBDCPS();">Fiche B. D. aux Comptant Regroupé Provisoire</a></li>
                <li class="<?php if ($tab == "3") echo 'active' ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserBDCPS();
                            AfficheDoc('<?php echo $ids; ?>')">Fiche B. D. aux Comptant Regroupe</a></li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bons de Dépenses aux Comptant Regroupes</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="tab-pane <?php if ($tab != "3") echo 'fade active in' ?>" id="profilep" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE1('<?php echo $ids ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de dépenses aux Comptant Provisoire
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Bon de dépenses aux comptant Provisoire N°: <?php echo $numerodemande ?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                           ?></td>
                                        </tr>-->
                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr><td>Bon de commande Interne N°:</td></tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($liste_document_achats as $document_achat): ?>
                                                        <tr><td><?php echo $document_achat->getNumerodocachat() ?></td></tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d-m-Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Lieu de livraison</td>
                                            <td>
                                                <select id="id_lieup">
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
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value="" ng-model="reffournisseur1.text" id="reffournisseur1" class="form-control" ng-change="AfficheFournisseur1()">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur1.text" id="fournisseur1" class="form-control" ng-change="AfficheFournisseur1()">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table style="list-style: none; margin-top: 169px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Montant Total TTC :</td>
                                            <td><input class="align_right" type="text" id="txt_mnttotal" value="" /></td>
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
                                    <th style="text-align:center">DESIGNATION<br>
                                        (indiquer, s'il y a lieu, les références au catalogue du fournisseur)
                                    </th>
                                    <th style="width: 80px">Quantité<br> à livrer </th>
                                    <th style="width: 80px" >P.Unit.<br></th>
                                    <th style="width: 80px" class="disabledbutton">Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignedoc in lignedocsdeponse1" >
                                    <td ><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="1qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="1puht_{{lignedoc.norgdre}}" value="{{lignedoc.puht|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)"></p></td>
                                    <td >
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="1tva_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva == tva.id" selected="selected" value="{{tva.id}}">{{tva.libelle}}</option>
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva != tva.id" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
<!--                                            <select id="1tva_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>-->
                                        </p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="1desc_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)"></textarea>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne1(lignedoc.norgdre)"> 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne1(lignedoc.norgdre)">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" style="padding-left: 70%">
                                        <input ng-click="ValiderTousBDCP()" type="button" value="Valider tous les quantitées des articles">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="padding: 1%; width: 100%; text-align: right;">
                            <input id="btn_validation" type="button" value="Enregistrer" class="btn btn-primary1" ng-click="ValiderBondedeponseProvisoire('<?php echo $ids; ?>')"> 
                            <!--<input id="btn_validation" type="button" value="Enregistrer En serie" class="btn btn-primary1" ng-click="ValiderBondedeponseProvisoireEnSerie('<?php // echo $ids; ?>')">--> 
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE('<?php echo $ids; ?>', '')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de dépenses aux comptant
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Bon de dépenses aux comptant N°: <?php echo $numerodemande_defi ?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                          ?></td>
                                        </tr>-->
                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr><td>Bon de commande Interne N°:</td></tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($liste_document_achats as $document_achat): ?>
                                                        <tr><td><?php echo $document_achat->getNumerodocachat() ?></td></tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d-m-Y') ?></td>
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
                        <table style="list-style: none;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;" ><!--ng-init="AfficheDocBDCR('<?php // echo $ids; ?>')"-->
                                        <input id="id_fils" value="<?php echo $idbdcp;  ?>" type="hidden">
                                       
                                       
<!--                                      <tr>
                                            <td colspan="5"> 
                                                <select id="listesbdcp" style="width: 100%">
                                                    <option id="0">==>Sélectionnez BDCP</option>
                                                    
                                                   
                                                    <option ng-repeat="demandeprix in docDemandePrix" 
                                                            ng-if="demandeprix.idtypedoc === 21 && demandeprix.id ===<?php // echo $idbdcp  ?>"
                                                            selected="selected" value="{{demandeprix.id}}" 
                                                            ng-init="EtatBDCP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}>
                                                 </option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 21 && demandeprix.id !=<?php // echo $idbdcp ?>" 
                                                            value="{{demandeprix.id}}" ng-click="EtatBDCP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                </select>
                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté  </td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value="" ng-model="reffournisseur.text" id="reffournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur"  class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                        <table style="list-style: none; margin-top: 5px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Montant Quitance :</td>
                                            <td><input class="align_right" type="hidden" id="quitance_def_ttc_bdcr" 
                                                       value="<?php
                                                       if (sizeof($quitance) >= 1) {
                                                           echo $mnt_quitance;
                                                       }
                                                       ?>"  readonly="true" />
                                                <input class="align_right" type="text" id="quitance_def_bdcr" 
                                                       value="<?php
                                                       if (sizeof($quitance) >= 1) {
                                                           echo number_format($mnt_quitance, 3, ',', ' ');
                                                       }
                                                       ?>"  readonly="true" /></td>
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
                                    <th style="text-align:center">DESIGNATION<br>
                                        (indiquer,s'il y a lieu, les références au catalogue du fournisseur)
                                    </th>
                                    <th style="width: 80px">Quantité<br>à livrer</th>
<!--                                    <th style="width: 80px">P.Unit.<br>H.T</th>
                                    <th style="width: 80px">Taux<br>T.V.A</th>-->
                                    <th>Observations</th>
                                    <!--<th></th>-->
                                </tr>
                            </thead>
                            <tbody>

                                <tr ng-repeat="lignedoc in lignedocsdeponse">
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p></td>
                                    <!--<td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.mntht|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)"></p></td>-->
<!--                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>-->
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)"></textarea>
                                        </p>
                                    </td>
<!--                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, '')" > 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                    </td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div id="btnvalider_bdcdregr" style="padding: 1%; width: 100%; text-align: right;">
                            <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary1" ng-click="ValiderBondedeponseRegrouppeDef('<?php echo $ids; ?>')"> 
                        </div>
                    </div>
                </div><!---AfficheMontantTotal('<?php // echo $ids; ?>')--->
                <div class="tab-pane" style="height: 1200px" id="listesdemandeprix" ng-controller="CtrlListesBondeponse" 
                     ng-init="AfficheDocBDCRegroupe('<?php echo $ids; ?>');">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des bons de dépenses aux comptant
                        </p>
                    </h4>
                    <div class="col-xs-12 col-lg-6" >
                        <table>
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Type</th>
                                    <!--<th>Fournisseur</th>-->
                                    <th>M.TTC</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="demandeprix in docDemandePrixBDCRS   ">
                                    <td>{{demandeprix.numero}}</td>
                                    <td>{{demandeprix.typedoc}}</td>
                                    <!--<td>{{demandeprix.id}}</td>--> 
                                    <td > {{demandeprix.montant}}</td>
                                    <td><input type="button" ng-model="btndetail" class="btn btn-primary1" ng-click="DetailLignedocBDCR(demandeprix.id)" value="+ Détail"></td>
                                    <td><a href="<?php echo url_for('Documents/ImprimerbondeponseRegrouppe?iddoc=') ?>{{demandeprix.id}}" class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a></td>
                                </tr>
                            </tbody>
                        </table>
<!--                        <table>
                            <tr>Genérer BDC Global</tr>
                            <thead>
                                <tr><th>Type</th>s
                                    <th>Montant Global</th>
                                    <th >Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Bon de dépense au comptant Regroupé (Système) provisoire </td>
                                    <td>
                                        <input type="text" id="montant_total" value="">
                                    </td>
                                    <td><input type="button" ng-model="btnregroupper" class="btn btn-primary1" ng-click="ValiderRegrouppementBondedeponseProvisoire('<?php echo $ids; ?>')" value="Génerer BDCG"></td>
                                    <td><a href="<?php // echo url_for('Documents/Imprimerbondeponse?iddoc=')          ?>{{demandeprix.id}}" class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a></td>

                                </tr>
                            </tbody>
                        </table>-->
                    </div>
                    <div class="col-xs-12 col-lg-6" id="divdetail">
                        <table>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <a href="<?php echo url_for('Documents/Imprimertousbondeponse?iddoc=') . $documentachat->getId() . '&idtype=17' ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCP ==> PDF</a>
                                    <a href="<?php echo url_for('Documents/Imprimertousbondeponse?iddoc=') . $documentachat->getId() . '&idtype=2' ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCD ==> PDF</a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <table style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th>N°ordre</th>
                                                <th>Désignation d'article</th>
                                                <th>Qte</th>
                                                <th>Prix<br>U.H.T</th>
                                                <th>Observation</th>
                                            </tr>
                                        </thead>
                                        <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                            <td>{{ligne.nordre}}</td>
                                            <td>{{ligne.designationarticle}}</td>
                                            <td>{{ligne.qte|integer}}</td>
                                            <td>{{ligne.mntht}}</td>
                                            <td>{{ligne.observation}}</td>
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
                                                <legend>Attacher fiche scannée</legend>
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

<script  type="text/javascript">

    function miseAjour(element_input) {
        var norgdre = $('#' + element_input.id).attr('ordre');
        var p = $('#' + element_input.id).attr('provisoire');
//        alert(norgdre);
//        if (p != '')
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne1(norgdre);
//        else
//            angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }

</script>