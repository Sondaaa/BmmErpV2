<div id="sf_admin_container">
    <h1>Fiche BCI N°:<?php foreach ($liste_document_achats as $document_achat) : ?> - <?php echo $document_achat->getNumerodocachat()
   ?><?php endforeach; ?>
        <?php
        $docparent = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 7);
        $docparentbcebdc = DocumentachatTable::getInstance()->getBybceBdc($document_achat->getId());
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
                <!--<li class="<?php // if ($tab == "") echo 'active'                                                               
                ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>-->
                <li class="<?php if ($tab != "3" && $tab != "4") echo 'active' ?>"><a href="#profilep" data-toggle="tab" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" aria-expanded="false">Fiche B. C. Externe Provisoire</a></li>
                <li class="<?php if ($tab == "3") echo 'active' ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix();
                            AfficheDocBCEP('<?php echo $ids; ?>')">Fiche B. C. Externe Défifinitf</a></li>
                <li class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>"><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bons de Commandes Externes</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat) : ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="tab-pane <?php if ($tab != "3" && $tab != "4") echo 'fade active in' ?>" id="profilep" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE('<?php echo $ids ?>', 'p')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de Commande Externe Provisoire
                        </p>
                    </h4>
                    <div style="padding: 1%; width: 40%; font-size: 16px; float: left;">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">B.C.E.S.P N°: <?php echo $numerobcep ?></td>
                                        </tr>

                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <td>Bon de commande Interne N° :</td>
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
                                            <td><?php echo date('d/m/Y') ?></td>
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
                                        <tr>
                                            <td>Référence</td>
                                            <td>
                                               
                                                 <input id="reference_p"  type="text">
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
                                    <table>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">Fournisseur</td>
                                            <td style="width: 80%;">
                                                <select id="fournisseur_p">
                                                    <option value=""></option>
                                                    <?php foreach ($liste_document_achats as $document_achat) : ?>
                                                        <?php $fournisseurs = FournisseurTable::getInstance()->getByDemandePrix($document_achat->getId()); ?>
                                                        <?php foreach ($fournisseurs as $fournisseur) : ?>
                                                            <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <!--                                            <td style="width: 20%;">
                                                <input type="text" value="" ng-model="reffournisseur_p.text" id="reffournisseur_p" class="form-control" ng-change="AfficheFournisseur('_p')">
                                            </td>
                                            <td style="width: 60%;">
                                                <input type="text" value="" ng-model="fournisseur_p.text" id="fournisseur_p" class="form-control" ng-change="AfficheFournisseur('_p')">
                                            </td>-->
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
                                    <p class="btn btn-sm btn-primary" ng-click="CalculerApresremise('bcep')">Appliquer</p>
                                </td>                               
                                <td> <label>Droit de Timbre: </label>
                                    <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbre()" class="pull-right">
                                    <input type="text" id="valeurdroit_societe" readonly="true">
                                </td>
                                <td style="display: none"> <label>Droit de Timbre: </label>
                                    <input type="hidden" id="valeurdroit"  >
                                    <select id="id_droit_timbre_p">
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
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailBCE()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBCE()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocsdeponsep">
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
                            <td>
                                <p style="border-bottom: #000 dashed 1px !important">
                                    <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_"> {{lignedoc.observation}}</textarea>
                                </p>
                            </td>
                            <td style="text-align: center;">
                                <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBcE(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" ng-click="DeleteLignebce(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <?php ?>

                            </td>
                            <!--                                    <td>
                                <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, 'p_')"> 
                                <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, 'p_')">
                            </td>-->
                            </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" ng-disabled="disableBtn" class="btn btn-primary" ng-click="ValiderBondexterne('<?php echo $ids; ?>', '_p')">
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix" <?php if ($documentachatBCEP) : ?> ng-init="AfficheLignedocBCIVersBCE('<?php echo $documentachatBCEP->getId() ?>', '')" <?php endif; ?>>
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Bon de commande externe
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td >
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Bon de commande externe N°: <?php echo $numerodemande ?></td>
                                        </tr>

                                        <td colspan="2" class="disabledbutton">
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
                                        <tr><?php
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneById($document_achat->getId());
                                            $contrat = $bci->getContratachat();
                                            if (sizeof($contrat) >= 1) :
                                                $montantcontrat = $contrat->getMontantcontrat();
                                            endif;
                                            ?>

                                            <?php
                                            $total = 0;
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneById($document_achat->getId());
                                            $montant_final = $bci->getMontantestimatif();

                                            $bces = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdEtatdoc($document_achat->getId(), 7, 27);
                                            //                                                   die(sizeof($bces).'mp');
                                            foreach ($bces as $bce) :
                                                $total = $total + $bce->getMntttc();
                                            endforeach;
                                            ?>

                                            <td class="disabledbutton">Date de création
                                                <input type="hidden" value="<?php echo $total ?>" id="total">
                                                <input type="hidden" value="<?php echo $montant_final ?>" id="mnt_estimatif">
                                            </td >
                                            <td class="disabledbutton"><?php echo date('d/m/Y') ?></td>
                                            <td class="disabledbutton">
                                                <input type="hidden" value="<?php
                                                if (sizeof($contrat) >= 1) : echo $montantcontrat;
                                                endif;
                                                ?>" id="montant_contrat">
                                            </td>
                                        </tr>
                                        <tr class="disabledbutton">
                                            <td>Max Date de réponse</td>
                                            <td><input id="maxreponse" min="<?php echo date('Y-m-d') ?>" type="date"></td>
                                        </tr>
                                        <tr class="disabledbutton">
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
                                        <tr class="disabledbutton">
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
                                            <td>Référence</td>
                                            <td>
                                               
                                                 <input id="reference"  type="text">
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
                                    <table ng-init="InialiserDemandePrix();
                                                    AfficheDocBCEP('<?php echo $ids; ?>')">
                                        <tr class="disabledbutton">
                                            <td colspan="5">
                                                <select id="listesbdcp" style="width: 100%">
                                                    <option value="0">-->Sélectionnez BCEP</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id ===<?php echo $idbdcp ?>" selected="selected" value="{{demandeprix.id}}" fournisseuridbce="{{demandeprix.id_fournisseur}}" <?php if ($tab == "3") : ?> ng-init="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}} <?php endif; ?></option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id !=<?php echo $idbdcp ?>" value="{{demandeprix.id}}" fournisseuridbce="{{demandeprix.id_fournisseur}}" ng-click="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr class="disabledbutton">
                                            <td>Fournisseur</td>
                                            <td style="width: 100px">
                                                <input type="text" value="" ng-model="reffournisseur.text" id="reffournisseur" class="form-control" ng-change="AfficheFournisseur('')">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur" class="form-control" ng-change="AfficheFournisseur('')">
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

                    <div style="padding: 1%;width: 100%;">

                        <table style="list-style: none; margin-top: 67px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td><?php ?>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>
                                                <label>Remise en Val. HT</label>
                                                <input type="text" id="remisetotalvaleurHTSys" >
                                            </td>
                                            <td><br>OU</td>
                                            <td>
                                                <label>Remise en % HT</label>
                                                <input type="text" id="remisetotalpourcentageHTSys">
                                            </td>
                                            <td><label>&emsp;</label>
                                                <p class="btn btn-sm btn-primary" ng-click="CalculerApresremiseSys()">Appliquer</p>
                                            </td>                               
                                            <td> <label>Droit de Timbre: </label>

                                                <input type="checkbox" id="droit_timbre_sys" ng-click="ValiderDroitTimbreSys()" class="pull-right">
                                                <input type="text" id="valeurdroit_societe_sys" readonly="true">
                                            </td>
                                            <td style="display: none"> <label>Droit de Timbre: </label>
                                                <input type="hidden" id="valeurdroitsys">
                                                <select id="droit_timbre_sys">
                                                    <option value="0">--Sélectionnez--</option>
                                                    <?php foreach ($droitTimbre as $dtTimbre) { ?>
                                                        <option value="<?php echo $dtTimbre->getId() ?>"><?php echo $dtTimbre->getValeur() ?></option>
                                                    <?php } ?>
                                                </select>

                                            </td>

                                        <input type="hidden" value="0.000" id="timbre" style="text-align: right">

                                        <td> <label>Total H.TAX : </label>
                                            <input class="align_right" type="text" id="total_htax_sys" value="" readonly="true"  />
                                            <input class="align_right" type="hidden" id="total_htax_sys_hidden" value="<?php ?>"  /><!--readonly="true"--->

                                        </td>
                                        <td> <label>Montant Total TTC : </label>


                                            <input class="align_right" type="hidden" id="total_htax_net" value=""  />
                                            <input class="align_right" type="hidden" id="total_ttc_sys_bcehidden" value="<?php
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
                                            <input class="align_right" type="text" id="total_ttc" value="<?php
                                            if ($documentachatBCE->getMntttc() != null) {
                                                $mntttc = $documentachatBCE->getMntttc();
                                                echo $mntttc;
                                            }
                                            ?>"  readonly="true"/><!--readonly="true"--->
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
                                    <th style="width: 50px">N°</th>
                                    <th style="text-align:center">DESIGNATION<br>

                                    </th>
                                    <th style="width: 80px">Quantité</th>
                                    <th style="width: 70px">P.Unit.<br>H.T</th>
                                    <th style="width: 6%">T.H.T<br></th>
                                    <th style="width: 70px">Remise en %</th>
                                    <th style="width: 6%">T.H.T.Net<br></th>
                                    <th style="width: 7%">Taux<br>Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                                    <th style="width: 8%">Taux<br>T.V.A</th>
                                    <th style="width: 10%" class="disabledbutton">T.TTC</th>
                                    <th>Observations</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="disabledbutton"> <input type="text" id="nordresys"></td>
                                    <td>
                                        <input type="text" ng-value="" ng-model="codearticlesys.text" id="codearticlesys" autocomplete="off" placeholder="CODE" readonly="true">
                                        <input type="text" value="" ng-model="designationsys.text" id="designationsys" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                        <?php include_partial('symbole', array()) ?>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="qtesys"></td>
                                    <td><input type="text" class="form-control" style="" id="puhtsys"></td>

                                    <td><input type="text" class="form-control" style="" id="totalhTaxsys" readonly="true"></td>
                                    <td> <input type="text" id="remisesys" ng-model="remisesys"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhaxsys" readonly="true"></td>

                                    <td>

                                        <!--<input type="hidden" id="idtaufodec">-->

                                        <select id="taufodecsys">
                                            <option id="0"></option>
                                            <?php foreach ($liste_tauxfodec as $tau) : ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="fodecsys" readonly="true"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhtvasys" readonly="true"></td>
                                    <td>
                                        <input type="hidden" id="idtva">
                                        <input type="hidden" value="" ng-model="tvacontratsys.text" id="tvacontratsys" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                        <select id="tvasys">

                                            <?php foreach ($taux_tva as $tva) : ?>
                                                <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" style="" id="totalttcsys" readonly="true"></td>

                                    <td>
                                        <textarea id="observationsys" class="form-control"></textarea>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailBCES()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBCES()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

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
                                        <p style="border-bottom: #000 dashed 1px !important" class="disabledbutton">
                                            <input type="text" class="form-control" style="" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.unitedemander}}
                                        </p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important" class="disabledbutton">
                                            <input type="text" class="form-control" style="" id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.puht}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">
                                        </p>
                                    </td>
                            <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">


                            <td>{{lignedoc.totalhtax}}</td>
                            <td>{{(lignedoc.tauxremise * 100).toFixed(2)}}%</td>
                            <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">
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
                                <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBcES(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" ng-click="DeleteLignebceS(lignedoc.norgdre, 'p_')">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <!--                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, '')" > 
                                <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >-->
                            </td>
                            </tr>
                            </tbody>
                        </table>
                        <div id="btnvalider_bdcd" class="disabledbutton">
                            <input type="button" value="Enregistrer" id="btnvalider_bce" ng-model="btnvalider" <?php if (sizeof($docparent) >= 1) : ?> class="btn btn-primary disabledbutton" <?php else : ?> class="btn btn-primary" <?php endif; ?> ng-click="ValiderBondexterne('<?php echo $ids; ?>', '')">
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>" style="height: 1200px" id="listesdemandeprix" ng-controller="CtrlListesBonexterne" ng-init="AfficheDoc('<?php echo $ids; ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Liste des bons de commandes externes
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
                                <tr ng-repeat="demandeprix in docDemandePrix">
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

                                                <td colspan="2">
                                                    Date Signature:<input type="date" min="<?php echo date('Y-m-d') ?>" id="datesignature{{demandeprix.id}}">
                                                    <input type="button" style="width: 65px;" class="btn btn-xs btn-primary" value="Valider" ng-click="ValiderSignature(demandeprix.id)">
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
                                    <table ng-if="atrubition != ''" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th>Attribution budgetaire</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                                <div ng-bind-html=" atrubition | trusted"></div>
                                            </td>
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
</script>