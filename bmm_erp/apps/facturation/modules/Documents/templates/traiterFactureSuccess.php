<div id="sf_admin_container">
    <h1>Fiche BCI N°:<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat() ?><?php endforeach; ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $resultat_facture_total = 0;
    $resultat_quitance = 0;
    $liste_tauxfodec = Doctrine_Query::create()
            ->select("id,libelle")
            ->from('tauxfodec')
            ->orderBy('id')
            ->execute();
    $taux_tva = Doctrine_Query::create()
                    ->select("id,libelle")
                    ->from('tva')
                    ->orderBy('libelle')->execute();
    $docachat_bdcrsysteme = DocumentachatTable::getInstance()->find($ids);
    $id_docparent = $docachat_bdcrsysteme->getIdDocparent();
    $documentachatBDCP = DocumentachatTable::getInstance()->getBybceBdcAndType($id_docparent, 21);
    $documentachatFacture = DocumentachatTable::getInstance()->getBybceBdcAndType($ids, 15);

    foreach ($documentachatFacture as $Facture):
        $resultat_facture_total+=$Facture->getMntttc();
    endforeach;
// die(sizeof($documentachatFacture).'fesd'.$documentachatBDCP->getLast()->getId()) ;  
    ?>
    <div id="sf_admin_content">  
        <div class="panel-body" >
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo 'active' ?>">
                    <a href="#profile" data-toggle="tab" 
                       aria-expanded="true" ng-controller="Ctrlfacturation" 
                       ng-init="InialiserChamps()" >
                        Fiche Facture</a>
                </li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" 
                 aria-expanded="false"  ng-controller="Ctrlfacturation" ng-init="IntialiserBoutonCloture()" >
                Liste Des Factures</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content ">
                <div class="tab-pane <?php echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix"  ng-init="AfficheLignedocBCIVersBCE1('<?php echo $ids ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire De Facture (BDC)
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Bon de dépenses aux comptant Regroupé Definitif N°: <?php echo $numerodemande ?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                                                    ?></td>
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
                                            <td><?php echo date('d/m/Y') ?></td>
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
                                        <?php $fournisseurs = FournisseurTable::getInstance()->getAllFournisseurByMouvement($id); ?>


                                        <tr>

                                            <td>Fournisseur</td>
                                            <td>
                                                <select id="reffournisseur1">
                                                    <option value=""></option>
                                                    <?php foreach ($fournisseurs as $fournisseur): ?>
                                                        <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                                                    <?php endforeach; ?>
                                                </select></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div >
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:left">DESIGNATION </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignedoc in lignedocsdeponse1" >
                                    <td ><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: right">
                        <!---selected="true" if (sizeof($documentachatBDCP) >= 1) {
 //                                                        if ($documentachatBDCP->getLast()->getDroittimbre() == '1'):
                                                             
 //                                                                endif;
 //                                                            }-->

                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td> <label>Droit de Timbre: </label>
                                    <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbreFacture()" class="pull-right">
                                    <input type="text" id="valeurdroit_societe" readonly="true">
                                </td>
<!--                                <td>
                                    <select id="droit_timbre_bdc_fac_sys" >
                                        <option value=""></option>
                                        <option value="1"><?php // echo 'Avec' ?></option>      
                                        <option value="0"><?php // echo 'Sans' ?></option>
                                    </select>
                                </td>-->
                                <td>Montant Total TTC :</td>
                                <td><input class="align_right" type="text" id="txt_mnttotal" value="" />
                                    <input type="hidden" id="txt_mnttotal_hidden" ></td>
                            </tr>
                        </table>

                    </div>
                    <div ng-controller="myCtrldoc">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 8%">N°Ordre</th>
                                    <th style="text-align:center">DESIGNATION</th>
                                    <th style="width: 8%">Qte<br>à livrer</th>
                                    <th style="width: 8%">P.Unit.<br>H.T</th>  
                                    <th style="width: 8%">T.H.T<br></th>
                                    <th style="width: 8%" >Taux<br>Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                                    <th style="width: 8%">Taux<br>T.V.A</th>
                                    <th style="width: 10%" class="disabledbutton">T.TTC</th>
                                    <th>Observations</th>
                                    <th style="width: 10%" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="formligne">
                                    <td style="width: 6%"><input type="text" value="" ng-model="nordreFac.text" id="nordreFac" class="form-control align_center disabledbutton"></td>
                                    <td style="width: 15%;">
                                        <input type="text" ng-value="" ng-model="codearticleFac.text" id="codearticleFac" autocomplete="off" placeholder="CODE" readonly="true">                   
                                        <input type="text" value="" ng-model="designationsysBDCFac.text" id="designationsysBDCFac" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationFac()" ng-keydown="goToListFac($event)">
                                        <?php include_partial('symbole', array()) ?>
                                    </td>
                                    <td><input type="text" class="form-control" style="" id="qtesysBDCFac"></td>
                                    <td><input type="text" class="form-control" style="" id="puhtsysBDCFac"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhaxsysBDCFac"  readonly="true"></td>
                                    <td>  <select id="taufodecsysBDCFac"  >
                                            <option id="0"></option>
                                            <?php foreach ($liste_tauxfodec as $tau): ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="fodecsysBDCFac"   readonly="true"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhtvasysBDCFac"  readonly="true" ></td>
                                    <td>                   
                                        <input type="hidden" id="idtvaBDC">

                                        <select id="tvasysBDCFac">
                                            <option id="0"></option>
                                            <?php foreach ($taux_tva as $tva): ?>
                                                <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" style="" id="totalttcsysBDCFac" readonly="true" ></td>

                                    <td>
                                        <textarea id="observationsysBDCFac" class="form-control" ></textarea>
                                    </td>
                                    <td style="width: 9%; text-align: center;">
                                        <button type="button" class="btn btn-primary" ng-click="AddDetailBDCSFacture()" ><i class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger" ng-click="ViderChampsBDCSFacture()" ><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>

                                <tr ng-repeat="lignedoc in lignedocsdeponse">
                                    <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                                    <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" style="" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p></td>
                                    <td>{{lignedoc.puht}}</td>
                                    <td>{{lignedoc.totalhax}}</td>
                                    <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                                    <td>{{lignedoc.fodec}}</td>
                                    <td>{{lignedoc.totalhtva}}</td>
                                    <!--<td>{{lignedoc.tva}} </td>-->

                                    <td>{{lignedoc.tva}} </td>

                                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                                    <td>{{lignedoc.totalttc}}</td>
                                    <td class="disabledbutton">
                                        <textarea >{{lignedoc.observation}}</textarea>
                                        </p>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-circle" ng-click="UpdateDetailBDCFacture(lignedoc.norgdre)"><i class="fa fa-hospital-o"></i></button>
                                        <button type="button" class="btn btn-warning btn-circle" ng-click="DeleteFacture(lignedoc.norgdre)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="padding: 1%; width: 100%; text-align: right;">
                            <input id="btn_validation" type="button" value="Enregistrer" class="btn btn-primary1" ng-click="ValiderFacture('<?php echo $ids; ?>')"> 
                            <!--<input id="btn_validation" type="button" value="Enregistrer En serie" class="btn btn-primary1" ng-click="ValiderBondedeponseProvisoireEnSerie('<?php // echo $ids;                                ?>')">--> 
                        </div>
                    </div>
                </div>
              
            <div class="tab-pane" style="height: 1200px" id="listesdemandeprix" ng-controller="Ctrlfacturation" ng-init="AfficheDoc('<?php echo $ids; ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des Factures
                        </p>
                    </h4>
                    <div class="col-xs-12 col-lg-6" >
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>
                                    <th style="width: 10%">Type</th>
                                    <th style="width: 20%">Fournisseur</th>
                                    <th style="width: 15%">M.TTC</th>
                                    <th style="width: 30%" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="docfacture in docfacturesbdcregroupe">
                                    <td>{{docfacture.numero}}</td>
                                    <td>{{docfacture.typedoc}}</td>
                                    <td>{{docfacture.rs}}</td> 
                                    <td style="text-align: right"> {{docfacture.montant}}</td>
                                    <td colspan="2">
                                        <button ng-model="btndetail" class="btn btn-white btn-success dropdown-toggle " 
                                                ng-click="DetailLignedoc(docfacture.id)" value="Détail">
                                            <i class="ace-icon fa fa-eye bigger-110"></i>Détail
                                        </button>                                      
                                        <a href="<?php echo url_for('Documents/ImprimerFacture?iddoc=') ?>
                                           {{docfacture.id}}" class="btn btn-white btn-primary dropdown-toggle " ng-model="BtnExporter" 
                                           target="_blanc">
                                            <i class="ace-icon fa fa-print bigger-110"></i>Exporter PDF</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr style="background: #EFEFEF">
                                    <td colspan="3">Total </td>
                                    <td style="text-align: right"><input style="text-align: center" readonly="true" type="hidden" id="total_facture" value="<?php echo $resultat_facture_total; ?>"><?php echo number_format($resultat_facture_total, 3, ',', ' '); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div>
                            <?php
                            $liste_quitance = LigneoperationcaisseTable::getInstance()->getByDocAchatAndCategorie($documentachatBDCP->getLast()->getId(), 2);
                            foreach ($liste_quitance as $quitance) {
                                $resultat_quitance+=$quitance->getMntoperation() + floatval($quitance->getRetenueirrp()) + floatval($quitance->getRetenuetva());
                            }
                            ?>
                            <table>
                                <table>
                                    <thead>
                                        <tr>
                                            <td><b>Total des Quitance</b></td>
                                            <td style="text-align: right"><b><input type="hidden" id="total_quitance_bdcr" value="<?php echo $resultat_quitance; ?>">
                                                    <?php echo number_format($resultat_quitance, 3, ',', ' ') ?></b></td>
                                        </tr> 
                                    </thead>

                                </table>

                                <tbody>
                                <div style="padding: 1%; width: 100%; text-align: right;">
                                    <input id="btn_cloture" type="button" 

                                           value="Clôturer Document Achat" class="btn btn-primary1 " ng-click="CloturerFacture('<?php echo $ids; ?>')">                                  
                                </div>
                                </tbody>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-6" id="divdetail">
                        <table>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <a href="<?php echo url_for('Documents/Imprimertousbondeponseregroupe') . '?iddoc=' . $documentachat->getIdDocparent() . '&idtype=' . 21 ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCP ==> PDF</a>
                                    <a href="<?php echo url_for('Documents/Imprimertousbondeponseregroupe') . '?iddoc=' . $documentachat->getIdDocparent() . '&idtype=' . 22 ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCD ==> PDF</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2" style="text-align: center">Fournisseur sélectionné</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>Raison sociale</td>
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
                                    </table>
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
                                                <th >Taux<br>Fodec</th>
                                                <th >Taux<br>TVA</th>
                                                <th>M.TTC</th>
                                                <th>Observation</th>
                                            </tr>
                                        </thead>
                                        <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                            <td>{{ligne.nordre}}</td>
                                            <td>{{ligne.designationarticle}}</td>
                                            <td>{{ligne.qte|integer}}</td>
                                            <td>{{ligne.mntht}}</td>
                                            <td>{{ligne.fodec}}</td>
                                            <td>{{ligne.tva}} </td>
                                            <td>{{ligne.mnttc}}</td>
                                            <td>{{ligne.observation}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
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
<style>

    #ul_compte{min-width: 130px;}

</style>