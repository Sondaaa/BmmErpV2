<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat) : ?> - <?php echo $document_achat->getNumerodocachat() ?><?php endforeach; ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $resultat = 0;
    $liste_tauxfodec = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('tauxfodec')
        ->orderBy('id')
        ->execute();
    $taux_tva = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('tva')
        ->orderBy('libelle')->execute();
    ?>

    <?php
    $documentachatBDCS = DocumentachatTable::getInstance()->find($ids);
    $documentachatBDCP = DocumentachatTable::getInstance()->getBybceBdcAndType($ids, 17);
    $documentachatBDC_Sys = DocumentachatTable::getInstance()->findOneByIdDocparent($ids);
    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat) : ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>
                <!--<li class="<?php // if ($tab == "") echo 'active'                                           
                                ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>-->
                <li class="<?php if ($tab != "3" && $tab != "4") {
                                echo 'active';
                            }
                            ?>"><a href="#profilep" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserBDCPS();">Fiche B. D. aux Comptant Provisoire</a></li>
                <li class="<?php if ($tab == "3") {
                                echo 'active';
                            }
                            ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserBDCPS();
                            AfficheDoc('<?php echo $ids; ?>')">Fiche B. D. aux Comptant</a></li>
                <li class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>">
                    <a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bons de Dépenses aux Comptant</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat) : ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('docachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('docachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="tab-pane <?php if ($tab != "3" && $tab != "4") echo 'fade active in'
                                        ?>" id="profilep" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE1('<?php echo $ids ?>')">
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
                                            <td><?php // echo $documentachat->getNumerodocachat()                                           
                                                ?></td>
                                        </tr>-->
                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <td>Bon de commande Interne N°:</td>
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
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d-m-Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Montant Estimatif DA</td>
                                            <td><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', '') ?></td>
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
                                        <tr>
                                            <td>Type BDC</td>
                                            <td>
                                                <select id="bdc_type">
                                                    <option value="">--Sélectionnez--</option>
                                                    <!-- <option value="1" ><?php //echo 'Regroupe' 
                                                                            ?></option>       -->
                                                    <option value="0" selected="true"><?php echo 'Normal' ?></option>
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
                                    <p class="btn btn-sm btn-primary" ng-click="CalculerApresremise('p')">Appliquer</p>
                                </td>
                                <td> <label>Droit de Timbre: </label>
                                    <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbre('p')" class="pull-right">
                                    <input type="text" id="valeurdroit_societe" readonly="true">
                                </td>


                                <input type="hidden" value="0.000" id="timbre" style="text-align: right">

                                <td> <label>Total H.TAX : </label>
                                    <input class="align_right" type="text" id="total_htax" value="" readonly="true" />
                                    <input class="align_right" type="hidden" id="total_htax_provisoire" value="<?php ?>" />
                                    <!--readonly="true"--->

                                </td>
                                <td> <label>Montant Total TTC : </label>


                                    <input class="align_right" type="hidden" id="total_htax_net" value="" />
                                    <input class="align_right" type="hidden" id="total_ttc_provisoire_bcehidden" value="<?php
                                                                                                                        if ($documentachatBDCS->getMntttc() != null) {
                                                                                                                            $mntttc = $documentachatBDCS->getMntttc();
                                                                                                                            echo $mntttc;
                                                                                                                        }
                                                                                                                        ?>" />
                                    <!--readonly="true"--->
                                    <input class="align_right" type="hidden" id="total_ttc_provisoire_bce" value="<?php
                                                                                                                    if ($documentachatBDCS->getMntttc() != null) {
                                                                                                                        $mntttc = $documentachatBDCS->getMntttc();
                                                                                                                        echo $mntttc;
                                                                                                                    }
                                                                                                                    ?>" readonly="true" />
                                    <!--readonly="true"--->
                                    <input class="align_right" type="text" id="txt_mnttotal_bdc" value="<?php
                                                                                                        if ($documentachatBDCS->getMntttc() != null) {
                                                                                                            $mntttc = $documentachatBDCS->getMntttc();
                                                                                                            echo $mntttc;
                                                                                                        }
                                                                                                        ?>" readonly="true" />
                                    <!--readonly="true"--->
                                </td>

                            </tr>
                        </table>
                    </div>
                    <!--                        <table style="list-style: none; margin-top: 169px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Droit de Timbre</td>
                                            <td>
                                                <select id="bdc_droittimbre" ng-model="bdc_droittimbre" ng-change="claculerDroittimberbdc()" >
                                                    <option value="1"><?php // echo 'Avec'            
                                                                        ?></option>
                                                    <option value="0"><?php // echo 'Sans'            
                                                                        ?></option>
                                                </select>
                                            </td>
                                            <td>Montant Total TTC :</td>
                                            <td><input class="align_right" type="text" id="txt_mnttotal_bdc" value="" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>-->
                    <!--</div>-->
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center">DESIGNATION</th>
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

                                    <td><input type="text" class="form-control" id="qte"></td>
                                    <td><input type="text" class="form-control" id="puht"></td>
                                    <td><input type="text" class="form-control" id="totalhTax" readonly="true"></td>
                                    <td> <input type="text" id="remise" ng-model="remise"></td>
                                    <td><input type="text" class="form-control" id="totalhax" readonly="true"></td>
                                    <td> <input type="hidden" id="idtaufodec" value='0'>
                                        <input type="hidden" id="id_emplacement" value='0'>
                                        <select id="taufodec">

                                            <?php foreach ($liste_tauxfodec as $tau) : ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" id="fodec" readonly="true"></td>
                                    <td><input type="text" class="form-control" id="totalhtva" readonly="true"></td>

                                    <td>
                                        <input type="hidden" id="idtva">
                                        <input type="hidden" value="" ng-model="tvacontrat.text" id="tvacontrat" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                        <select id="tva">
                                            <option id="0"></option>
                                            <?php foreach ($taux_tva as $tva) : ?>
                                                <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="totalttc" readonly="true"></td>

                                    <td>
                                        <textarea id="observation" class="form-control"></textarea>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailBDC()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBDC()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocsdeponse1">
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                                    </td>
                                    <td><input type="text" class="form-control" id="1qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_"></td>
                                    <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">

                                    <td>{{lignedoc.puht}}</td>
                                    <td>{{lignedoc.totalhTax}}</td>
                                    <td>{{(lignedoc.tauxremise * 100).toFixed(3)}}%</td>
                                    <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">
                                    <td>{{lignedoc.totalhax}}</td>
                                    <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                                    <td>{{lignedoc.fodec}}</td>
                                    <td>{{lignedoc.totalhtva}}</td>
                                    <td>{{lignedoc.tva}} </td>
                                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                                    <td>{{lignedoc.totalttc}}</td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_"> {{lignedoc.observation}}
                                            </textarea>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBDC(lignedoc.norgdre, 'p_')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" ng-click="DeleteLignebDC(lignedoc.norgdre, 'p_')">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                        <!--                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne1(lignedoc.norgdre)">
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne1(lignedoc.norgdre)">
                                    </td>-->
                                </tr>
                                <!--                                <tr>
                                    <td colspan="9" style="padding-left: 70%">
                                        <input ng-click="ValiderTousBDCP()" type="button" value="Valider tous les quantitées des articles">
                                    </td>
                                </tr>-->
                            </tbody>
                        </table>
                        <div style="padding: 1%; width: 100%; text-align: right;">
                            <input id="btn_validation" type="button" value="Enregistrer" class="btn btn-primary1" ng-click="ValiderBondedeponseProvisoire('<?php echo $ids; ?>')">
                            <!--<input id="btn_validation" type="button" value="Enregistrer En serie" class="btn btn-primary1" ng-click="ValiderBondedeponseProvisoireEnSerie('<?php // echo $ids;                       
                                                                                                                                                                                ?>')">-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") {
                                            echo 'fade active in';
                                        }
                                        ?>" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE('<?php echo $ids; ?>', '')">
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
                                            <td><?php // echo $documentachat->getNumerodocachat()                                          
                                                ?></td>
                                        </tr>-->
                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <td>Bon de commande Interne N°:</td>
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
                                    <table style="margin-bottom: 0px;" ng-init="AfficheDoc('<?php echo $ids; ?>')">
                                        <tr>
                                            <td colspan="5">
                                                <select id="listesbdcp" style="width: 100%">
                                                    <option id="0">-->Sélectionnez BDCP</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 17 && demandeprix.id ===<?php echo $idbdcp ?>" selected="selected" value="{{demandeprix.id}}" ng-init="EtatBDCP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 17 && demandeprix.id !=<?php echo $idbdcp ?>" value="{{demandeprix.id}}" ng-click="EtatBDCP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value="" ng-model="reffournisseur.text" id="reffournisseur" class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur" class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="padding: 1%;width: 100%;">
                        <table style="list-style: none; margin-top: 67px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td><?php ?>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>
                                                <label>Remise en Val. HT</label>
                                                <input type="text" id="remisetotalvaleurHTSys">
                                            </td>
                                            <td><br>OU</td>
                                            <td>
                                                <label>Remise en % HT</label>
                                                <input type="text" id="remisetotalpourcentageHTSys">
                                            </td>
                                            <td><label>&emsp;</label>
                                                <p class="btn btn-sm btn-primary" ng-click="CalculerApresremiseSys('bdcs')">Appliquer</p>
                                            </td>
                                            <td> <label>Droit de Timbre: </label>
                                                <input type="checkbox" id="droit_timbre_sys_bdc" ng-click="ValiderDroitTimbreSysBDC('bdcs')" class="pull-right">
                                                <input type="text" id="valeurdroit_societe_sys" readonly="true">
                                            </td>

                                            <input type="hidden" value="0.000" id="timbre" style="text-align: right">

                                            <td> <label>Total H.TAX : </label>
                                                <input class="align_right" type="text" id="total_htax_sys" value="" readonly="true" />
                                                <input class="align_right" type="hidden" id="total_htax_sys_hidden" value="<?php ?>" />
                                                <!--readonly="true"--->

                                            </td>
                                            <td> <label>Montant Total TTC : </label>


                                                <input class="align_right" type="hidden" id="total_htax_net" value="" />
                                                <input class="align_right" type="hidden" id="total_ttc_sys_bdchidden" value="<?php
                                                                                                                                if ($documentachatBDCS->getMntttc() != null) {
                                                                                                                                    $mntttc = $documentachatBDCS->getMntttc();
                                                                                                                                    echo $mntttc;
                                                                                                                                }
                                                                                                                                ?>" />
                                                <!--readonly="true"--->
                                                <input class="align_right" type="hidden" id="total_ttc_provisoire_bdc" value="<?php
                                                                                                                                if ($documentachatBDCS->getMntttc() != null) {
                                                                                                                                    $mntttc = $documentachatBDCS->getMntttc();
                                                                                                                                    echo $mntttc;
                                                                                                                                }
                                                                                                                                ?>" readonly="true" />
                                                <!--readonly="true"--->
                                                <input class="align_right" type="text" id="total_ttc_bdc" value="<?php
                                                                                                                    if ($documentachatBDCS->getMntttc() != null) {
                                                                                                                        $mntttc = $documentachatBDCS->getMntttc();
                                                                                                                        echo $mntttc;
                                                                                                                    }
                                                                                                                    ?>" readonly="true" />
                                                <!--readonly="true"--->
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
                                    <th style="text-align:center">DESIGNATION<br>
                                        (indiquer,s'il y a lieu, les références au catalogue du fournisseur)
                                    </th>
                                    <th style="width: 80px">Quantité<br>à livrer</th>
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
                                <tr id="ligne_bdc">
                                    <td class="disabledbutton"> <input type="text" id="nordresysBDC"></td>
                                    <td>
                                        <input type="text" ng-value="" ng-model="codearticlesysBDC.text" id="codearticlesysBDC" autocomplete="off" placeholder="CODE" readonly="true">
                                        <input type="text" value="" ng-model="designationsysBDC.text" id="designationsysBDC" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                        <?php include_partial('symbole', array()) ?>
                                    </td>

                                    <td><input type="text" class="form-control" id="qtesysBDC"></td>
                                    <td><input type="text" class="form-control" id="puhtsysBDC"></td>
                                    <td><input type="text" class="form-control" id="totalhTaxsys" readonly="true"></td>
                                    <td> <input type="text" id="remisesys" ng-model="remisesys"></td>
                                    <td><input type="text" class="form-control" id="totalhaxsysBDC" readonly="true"></td>
                                    <td>

                                        <input type="hidden" id="id_emplacement_bdc">

                                        <select id="taufodecsysBDC">
                                            <option id="0"></option>
                                            <?php foreach ($liste_tauxfodec as $tau) : ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" id="fodecsysBDC" readonly="true"></td>
                                    <td><input type="text" class="form-control" id="totalhtvasysBDC" readonly="true"></td>
                                    <td>
                                        <input type="hidden" id="idtvaBDC">
                                        <input type="hidden" value="" ng-model="tvacontratsysBDC.text" id="tvacontratsysBDC" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                        <select id="tvasysBDC">
                                            <option id="0"></option>
                                            <?php foreach ($taux_tva as $tva) : ?>
                                                <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="totalttcsysBDC" readonly="true"></td>

                                    <td>
                                        <textarea id="observationsysBDC" class="form-control"></textarea>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailBDCS()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBDCS()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocsdeponse">
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important"><input type="text" class="form-control" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p>
                                    </td>
                                    <!--                                    <td><p style="border-bottom: #000 dashed 1px !important">
                                            <input type="text" class="form-control"  id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.puht|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)"></p></td>-->
                                    <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">
                                    <td>{{lignedoc.puht}} </td>
                                    <td>{{lignedoc.totalhtax}}</td>
                                    <td>{{(lignedoc.tauxremise * 100).toFixed(2)}}%</td>
                                    <td>{{lignedoc.totalhax}}</td>
                                    <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                                    <td>{{lignedoc.fodec}}</td>
                                    <td>{{lignedoc.totalhtva}}</td>
                                    <!--<td>{{lignedoc.tva}} </td>-->

                                    <td>{{lignedoc.tva}} </td>

                                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                                    <td>{{lignedoc.totalttc}}</td>
                                    <td class="disabledbutton">
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.observation}}</textarea>
                                        </p>
                                    </td>
                                    <?php ?>



                                    <td style="text-align: center;">
                                        <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBDCS(lignedoc.norgdre, 'p_')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" ng-click="DeleteLigneBDCS(lignedoc.norgdre, 'p_')">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </td>
                                    <!--                                    <td>
                                    <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, '')" >
                                    <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                </td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div id="btnvalider_bdcd" style="padding: 1%; width: 100%; text-align: right;">
                            <!--class="disabledbutton"-->
                            <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary1" ng-click="ValiderBondedeponse('<?php echo $ids; ?>', '<?php echo $idbdcp; ?>')">
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>" style="height: 1200px" id="listesdemandeprix" ng-controller="CtrlListesBondeponse" ng-init="AfficheDoc('<?php echo $ids; ?>');
                                AfficheMontantTotal('<?php echo $ids; ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des bons de dépenses aux comptant
                        </p>
                    </h4>
                    <div class="col-xs-12 col-lg-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Type</th>
                                    <th>Fournisseur</th>
                                    <th>M.TTC</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="demandeprix in docDemandePrix">
                                    <td>{{demandeprix.numero}}</td>

                                    <td style="display: none">{{demandeprix.idtypedoc}}</td>
                                    <td>{{demandeprix.typedoc}}</td>
                                    <td>{{demandeprix.rs}}</td>
                                    <td> {{demandeprix.montant}}</td>
                                    <td><input type="button" ng-model="btndetail" class="btn btn-primary1" ng-click="DetailLignedoc(demandeprix.id)" value="+ Détail"></td>
                                    <?php ?>
                                    <td>
                                        <a ng-if="demandeprix.idtypedoc == 17" href="<?php echo url_for('docachat/imprimerBDCProvisoire?iddoc=') ?>{{demandeprix.id}}  " class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a>
                                        <a ng-if="demandeprix.idtypedoc == 2" href="<?php echo url_for('docachat/imprimerBDCDefinitf?iddoc=') ?>{{demandeprix.id}}  " class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a>
                                    </td>

                                </tr>
                            </tbody>

                        </table>
                        <!--                        <table>

                            <tr>Genérer BDC Global</tr>
                            <thead>
                                <tr><th>Type</th>

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
                                    <td><a href="<?php // echo url_for('Documents/Imprimerbondeponse?iddoc=')                          
                                                    ?>{{demandeprix.id}}" class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a></td>

                                </tr>
                            </tbody>
                        </table>-->
                    </div>
                    <div class="col-xs-12 col-lg-6" id="divdetail">
                        <table>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <a href="<?php echo url_for('docachat/Imprimertousbondeponse') . '?iddoc=' . $documentachat->getId() . '&idtype=17' ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCP ==> PDF</a>
                                    <a href="<?php echo url_for('docachat/Imprimertousbondeponse') . '?iddoc=' . $documentachat->getId() . '&idtype=2' ?>" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter BDCD ==> PDF</a>
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
        //        alert(norgdre);
        //        if (p != '')
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne1(norgdre);
        //        else
        //            angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }
</script>