<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat) : ?> - <?php echo $document_achat->getNumerodocachat()
   ?><?php endforeach; ?>
        <?php 
        $docparent = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 24);
        $docparentbcebdc = DocumentachatTable::getInstance()->getByOffresdeprix($document_achat->getId(),24);
        $liste_tauxfodec = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('tauxfodec')
                ->orderBy('id')
                ->execute();
        $taux_tva = Doctrine_Query::create()
                        ->select("id,libelle")
                        ->from('tva')
                        ->where('libelle is not null')
                        ->orderBy('libelle')->execute();
        ?>
    </h1>
    <input type="hidden" id="iddoc" value="<?php echo $documentachat->getId(); ?>">
    <input type="hidden" id="idbdcp" value="<?php echo $idbdcp; ?>">
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $documentachatBCE = DocumentachatTable::getInstance()->find($ids);
    $documentachatBCEP = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($ids, 18);
    $documentachatBCE_Sys = DocumentachatTable::getInstance()->findOneByIdDocparent($ids);
    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat) : ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>               
                <li class="<?php if ($tab != "3" && $tab != "4") echo 'active' ?>"><a href="#profilep" data-toggle="tab"  aria-expanded="false">Offre de Prix</a></li>                
                <li class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>">
                <a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Offres de Prix</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat) : ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Demande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="tab-pane <?php if ($tab != "3" && $tab != "4") echo 'fade active in' ?>" id="profilep" ng-controller="CtrlDemandeprix"  ng-init="AfficheLignedocBCIVersoffreprix('<?php echo $ids ?>', 'p')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Offre de Prix
                        </p>
                    </h4>
                    <div style="padding: 1%; width: 40%; font-size: 16px; float: left;">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Offre Prix S. N°: <?php echo $numerobcep ?></td>
                                        </tr>

                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <td>Demande Interne N° :</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($liste_document_achats as $document_achat) : ?>
                                                        <tr>
                                                            <td><?php echo $document_achat->getNumerodocachat() ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <tr rowspan="2">
                                            <td>Date de création</td>
                                            <td><input type="text" value="<?php echo date('d/m/Y') ?>" readonly="true" id="datecreation"></td>
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
                                    <table>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">Fournisseur</td>
                                            <td style="width: 80%;">
                                                <select id="fournisseur">
                                                    <option value=""></option>
                                                    <?php foreach ($liste_document_achats as $document_achat) : ?>
                                                        <?php $fournisseurs = FournisseurTable::getInstance()->getByDemandePrix($document_achat->getId()); ?>
                                                        <?php foreach ($fournisseurs as $fournisseur) : ?>
                                                            <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                           
                                        </tr>
                                    </table>
                                    <table style="margin-bottom: 0px;">
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
                    <div style="padding: 1%;width: 100%;">
                        <table style="list-style: none; margin-top: 36px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <label>Remise en Val. HT</label>
                                    <input type="text" id="remisetotalvaleurHT">
                                </td>
                                <td><br>OU</td>
                                <td>
                                    <label>Remise en % HT</label>
                                    <input type="text" id="remisetotalpourcentageHT">
                                    <input type="hidden" id="remisetotalpourcentageHT_Hidden">
                                    
                                </td>
                                <td><label>&emsp;</label>
                                    <p class="btn btn-sm btn-primary" ng-click="CalculerApresremise('offre')">Appliquer</p>
                                </td>                               
                                <td> <label>Droit de Timbre: </label>
                                    <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbre()" class="pull-right">
                                    <input type="text" id="valeurdroit_societe" readonly="true">
                                </td>
                                <td style="display: none"> <label>Droit de Timbre: </label>
                                    <input type="hidden" id="valeurdroit"  >
                                    <select id="id_droit_timbre">
                                        <option value="0">--Sélectionnez--</option>
                                        <?php foreach ($droitTimbre as $dtTimbre) { ?>
                                            <option value="<?php echo $dtTimbre->getId() ?>"><?php echo $dtTimbre->getValeur() ?></option>
                                        <?php } ?>
                                    </select>

                                </td>

                            <input type="hidden" value="0.000" id="timbre" style="text-align: right">

                            <td> <label>Total H.TAX : </label>
                                <input class="align_right" type="text" id="total_htax" value="" readonly="true"  />
                                <input class="align_right" type="hidden" id="total_htax_provisoire" value="<?php ?>"  /><!--readonly="true"--->

                            </td>
                            <td> <label>Montant Total TTC : </label>


                                <input class="align_right" type="hidden" id="total_htax_net" value=""  />
                                <input class="align_right" type="hidden" id="total_ttc_provisoire_bcehidden" value="<?php
                                if ($documentachatBCE->getMntttc() != null) {
                                    $mntttc = $documentachatBCE->getMntttc();
                                    echo $mntttc;
                                }
                                ?>"  /><!--readonly="true"--->    
                                <input class="align_right" type="hidden" id="total_ttc_provisoire_bce" value="<?php
                                if ($documentachatBCE->getMntttc() != null) {
                                    $mntttc = $documentachatBCE->getMntttc();
                                    echo $mntttc;
                                }
                                ?>"  readonly="true"/><!--readonly="true"--->    
                                <input class="align_right" type="text" id="total_ttc_provisoire" value="<?php
                                if ($documentachatBCE->getMntttc() != null) {
                                    $mntttc = $documentachatBCE->getMntttc();
                                    echo $mntttc;
                                }
                                ?>"  readonly="true"/><!--readonly="true"--->
                            </td>

                            </tr>
                        </table>
                    </div>

                    <div>
                        <table id="liste_ligne">
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center">DESIGNATION<br> </th>
                                    <th style="width: 80px">Quantité</th>
                                    <th style="width: 70px">P.Unit.<br>H.T</th>
                                    <th style="width: 6%">T.H.T<br></th>
                                    <th style="width: 70px">Remise en %</th>
                                    <th style="width: 6%">T.H.T.Net<br></th>
                                    <th style="width: 7%">Taux<br>Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>

                                    <th style="width: 70px">Taux<br>T.V.A</th>

                                    <th style="width: 10%" class="disabledbutton">T.TTC</th>
                                    <th>Observations</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="disabledbutton"> <input type="text" id="nordre"></td>
                                    <td>
                                        <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">
                                        <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                        <?php include_partial('symbole', array()) ?>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="qte"></td>
                                    <td><input type="text" class="form-control" style="" id="puht"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhTax" readonly="true"></td>
                                    <td> <input type="text" id="remise" ng-model="remise"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhax" readonly="true"></td>
                                    <td>

                                        <input type="hidden" id="idtaufodec" value='0'>

                                        <select id="taufodec">

                                            <?php foreach ($liste_tauxfodec as $tau) : ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="fodec" readonly="true"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhtva" readonly="true"></td>

                                    <td>
                                        <input type="hidden" id="idtva">
                                        <input type="hidden" value="" ng-model="tvacontrat.text" id="tvacontrat" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                        <select id="tva">

                                            <?php foreach ($taux_tva as $tva) : ?>
                                                <option value="<?php echo $tva->getId() ?>" ><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="totalttc" readonly="true"></td>

                                    <td>
                                        <textarea id="observation" class="form-control"></textarea>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailOffre()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBCE()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocsoffre">
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                                    </td>
                                    <td style="text-align: center;">
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <input type="text" class="form-control align_center" style="" id="qte_p_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)">{{lignedoc.unitedemander}}
                                        </p>
                                    </td>
                                    <td>{{lignedoc.puht}}</td>
                                    <td>{{lignedoc.totalhTax}}</td>
                                    <td>{{(lignedoc.tauxremise * 100).toFixed(2)}}%</td>
                            <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">

                            <td>{{lignedoc.totalhax}}</td>
                            <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                            <td>{{lignedoc.fodec}}</td>
                            <td>{{lignedoc.totalhtva}}</td>
                            <td>{{lignedoc.tva}} </td>
                            <td style="display: none;">{{lignedoc.prixttc}}</td>
                            <td>{{lignedoc.totalttc}}</td>
                            <td style="display: none">{{lignedoc.id_emplacement}}</td>
                            <td>
                                <p style="border-bottom: #000 dashed 1px !important">
                                    <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_"> {{lignedoc.observation}}</textarea>
                                </p>
                            </td>
                            <td style="text-align: center;">
                                <a class="btn btn-xs btn-primary" ng-click="UpdateDetailOffreprix(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" ng-click="DeleteLigneoffre(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <?php ?>

                            </td>
                            <!--                                    <td>
                                <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, 'p_')"> 
                                <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, 'p_')">
                            </td>-->
                            </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" ng-disabled="disableBtn" class="btn btn-primary" ng-click="ValiderOffreprix('<?php echo $ids; ?>')">
                    </div>
                </div>
             <!-- -->
                <div class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>" style="height: 1200px" id="listesdemandeprix" 
                ng-controller="CtrlDemandeprix" ng-init="AfficheDocOffre('<?php echo $ids; ?>')" >
                <!-- <button style="float: right; padding: 5px 12px;margin-left: 4px"
                    target="_blanc"
                    onclick="setExportExcelId()"
                    class="btn btn-sm btn-default">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Excel
            </button>   -->
             
            <button style="float: right; padding: 5px 12px;margin-left: 4px"
                    target="_blanc"
                    onclick="setExportExcelIdReg()"
                    class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Excel Par Article
            </button>  
                <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des Offres de Prix
                        </p>
                    </h4>
                    <div class="col-xs-12 col-lg-6">
                        <table>
                            <thead>
                                <tr>
                                    <th style="text-align: center;">N°</th>
                                    <th>Type</th>
                                    <th>Fournisseur</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="demandeprix in docDemandePrixOffre">
                                    <td style="text-align: center;">{{demandeprix.numero}}</td>
                                    <td>{{demandeprix.libelletypedoc}}</td>
                                    <td>{{demandeprix.rs}}</td>
                                    <td>
                                        <table style="margin-bottom: 0px;">
                                            <tr>
                                                <td><input type="button" ng-model="btndetail" class="btn btn-primary1" ng-click="DetailLignedoc(demandeprix.id);
                                                                TestAjouterSignature(demandeprix.id)" value="+ Détail">
                                                </td>
                                                <td ng-if="demandeprix.idtypedoc === 18">
                                                    <a href="<?php echo url_for('documentachat/imprimerBCEProvisoire?iddoc=') ?>{{demandeprix.id}}" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter PDF</a>
                                                </td>
                                                <td ng-if="demandeprix.idtypedoc === 7" >
                                                    <a href="<?php echo url_for('documentachat/imprimerBCEDefinitf?iddoc=') ?>{{demandeprix.id}}" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter PDF</a>
                                                </td>
                                                <td> <a href="<?php echo url_for('Documents/ImprimerAnnexBCEP?iddoc=') ?>{{demandeprix.id}}" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter Annexe PDF</a>
                                                </td>
                                            </tr>
                                            <tr id="atr_{{demandeprix.id}}" ng-if="demandeprix.idtypedoc === 7">

                                                <td colspan="3">
                                                  <table>
                                                  <tr> 
                                                    <td> Date Signature:</td>
                                                    <td>  <input type="date" min="<?php echo date('Y-m-d') ?>" 
                                                    id="datesignature{{demandeprix.id}}" value='{{demandeprix.datesignature}}'>
                            </td> 
                            </tr>
                            <tr><td>Date Execution :</td>
                                                  <td>  <input type="date" min="<?php echo date('Y-m-d') ?>" 
                                                    id="dateexecution{{demandeprix.id}}" value='{{demandeprix.dateexecution}}'>
                            </td> 
                            </tr><tr><td> Date Notification :</td>
                                              <td>      <input type="date" min="<?php echo date('Y-m-d') ?>" 
                                                    id="dateNotification{{demandeprix.id}}" value='{{demandeprix.datenotification}}'>
                                                  
                            </td> </tr>     </table>
                              <input type="button" style="width: 85px;text-align: center;margin-left: 65%;" class="btn btn-xs btn-primary pull-right"
                               value="Valider" ng-click="ValiderSignature(demandeprix.id)">  </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <a type="button" target="_blanc"
                        style="margin-top: 50px; width: 255px;text-align: center;margin-left: 65%;" 
                       href="<?php //echo url_for('documentachat/comparaisonoffres') . '?iddoc=' . $document_achat->getId() ?>"
                        class="btn btn-xs btn-primary pull-right"
                        value="Comparer offres " > Comparer offres de Prix</a> -->
                      
                    </div>
                    <div class="col-xs-12 col-lg-6" id="divdetail">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center;">Fournisseur sélectionné</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Raison sociale</td>
                                <td>{{detailfrs.rs}}</td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td>{{detailfrs.adrs}}</td>
                            </tr>
                            <tr>
                                <td>Annuaire</td>
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
                                                <th>Désignation d'article</th>
                                                <th>Qte</th>
                                                <th>Unité</th>
                                                <th>Prix<br>U.H.T</th>
                                                <th>Observation</th>
                                            </tr>
                                        </thead>
                                        <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                            <td style="text-align: center;">{{ligne.nordre}}</td>
                                            <td>{{ligne.designationarticle}}</td>
                                            <td style="text-align: center;">{{ligne.qte|integer}}</td>
                                            <td style="text-align: center;">{{ligne.unitedemander}}</td>
                                            <td style="text-align: right;">{{ligne.mntht}}</td>
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
                                <div class="col-md-6">
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
                                                        <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();" class="btn btn-info">
                                                        <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset style="padding: 10px;">
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="AFFICHE LES ATTACHEMENTS" ng-click="AfficheDemandedeprix(detailfrs.demandedeprixid);" class="btn btn-info"><br>
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

<script type="text/javascript">



    function miseAjour(element_input) {
        var norgdre = $('#' + element_input.id).attr('ordre');
        var p = $('#' + element_input.id).attr('provisoire');
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }
    function setExportExcelId() {
        var url = '';
        if ($('#iddoc').val() != '') {
            if (url == '')
                url = '?iddoc=' + $('#iddoc').val();
            else
                url = url + '&iddoc=' + $('#iddoc').val();
        }
       
        url = '<?php echo url_for('documentachat/exporterexceloffrepri') ?>' + url;
    
        window.open(url, '_blank');
        win.focus();
    }
    function setExportExcelIdReg() {
        var url = '';
        if ($('#iddoc').val() != '') {
            if (url == '')
                url = '?iddoc=' + $('#iddoc').val();
            else
                url = url + '&iddoc=' + $('#iddoc').val();
        }
       
        // url = '<?php //echo url_for('documentachat/exporterexceloffrepri') ?>' + url;
      url = '<?php echo url_for('documentachat/exporterexceloffrepriReg') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>