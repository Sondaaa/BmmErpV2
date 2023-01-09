<div id="sf_admin_container">
    <h1>Fiche :<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat() ?><?php endforeach; ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>
<!--<li class="<?php // if ($tab == "") echo 'active'                                    ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>-->
                <li class="<?php if ($tab != "3") echo 'active' ?>"><a href="#profilep" data-toggle="tab" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" aria-expanded="false">Fiche Contrat Provisoire</a></li>
                <li class="<?php if ($tab == "3") echo 'active' ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix();
                            AfficheDocBCEP('<?php echo $ids; ?>')">Fiche Contrat  </a></li>
                <!--<li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bons de Commandes Externes</a></li>-->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachatcontrat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachatcontrat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="tab-pane <?php if ($tab != "3") echo 'fade active in' ?>" 
                     id="profilep" ng-controller="CtrlDemandeprix" 
                     ng-init="AfficheLignedocBCIVersContrat('<?php echo $ids ?>', 'p',<?php echo $contrat->getId() ?>);
                     ">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Contrat Provisoire
                        </p>
                    </h4>
                    <div style="padding: 1%; width: 40%; font-size: 16px; float: left;">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2"> Contrat: <?php echo $contrat->getReference(); ?>.P N°: <?php echo $numerocomntrat; ?></td>
                                        </tr>

                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr><td>Bon de commande Interne N° :</td></tr>
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
                                            <td><?php echo date('d/m/Y', strtotime($contrat->getDatecreation())); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de Signature</td>
                                            <td><?php echo date('d/m/Y', strtotime($contrat->getDatesigntaure())); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>
                                                <input type="text" value="<?php
                                                if ($contrat->getType() == 0)
                                                    echo 'Livraison Total ';
                                                else
                                                    echo 'Livraison Partiel';
                                                ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Type Paiement</td>
                                            <td>
                                                <?php
                                                if ($contrat->getTypepaiment() == 0)
                                                    echo 'Sans Décompte';
                                                else
                                                    echo 'Avec Décompte';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date Fin</td>
                                            <td>
                                                <input style="text-align: center" type="text" readonly="true" value="<?php if ($contrat->getDatefin() != '')  ?>
                                                       <?php echo date('d/m/Y', strtotime($contrat->getDatefin())); ?>">
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
                                            <td>Fournisseur</td>
                                            <td style="width: 10%">
                                                <input type="text" readonly="true" value="<?php echo $contrat->getFournisseur()->getReference() ?>"  id="reffournisseur1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" value="<?php echo $contrat->getFournisseur()->getRs() ?>"  id="fournisseur1" class="form-control" >
                                                <input type="hidden" value="<?php echo $contrat->getIdFrs() ?>"  id="fournisseur_id" class="form-control" >

                                            </td>

                                        </tr>

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

                        <table style="list-style: none; margin-top: 36px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Montant Total TTC :</td>
                                            <td style="text-align: right"><b><?php echo $contrat->getMontantcontrat(); ?></b></td>
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
                                    <th style="width: 1%">N°Ordre</th>
                                    <th style="text-align:center;width: 18%">DESIGNATION</th>
                                    <th style="width:5%">Unité</th>
                                    <th style="width: 5%">Quantité</th>
                                    <th style="width: 6%">P.Unit.<br></th>
                                    <th style="width: 6%">T.H.T<br></th>
                                    <th style="width: 7%" >Taux<br>Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                                    <th style="width: 7%" class="disabledbutton">Taux<br>T.V.A</th>
                                    <th style="width: 8%" class="disabledbutton">T.TTC</th>
                                    <th style="width: 8%">Projet</th>
                                    <th style="width: 8%">Observations</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignedoc in lignedocscontratp">
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                                    <td>{{lignedoc.unite}}</td>
                                    <td>{{lignedoc.qte}}</td>
                                    <td>{{lignedoc.puht}}</td>
                                    <td>{{lignedoc.totalhax}}</td>
                                    <td>{{lignedoc.taufodec}}</td>
                                    <td>{{lignedoc.fodec}}</td>
                                    <td>{{lignedoc.totalhtva}}</td>
                                    <td>{{lignedoc.tva}}</td>
                                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                                    <td>{{lignedoc.totalttc}}</td>
                                    <td>{{lignedoc.projet}}</td>
                                    <td>{{lignedoc.observation}}</td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix" 
                     ng-init="AfficheLignedocBCIVersContrat('<?php echo $ids ?>', '',<?php echo $contrat->getId() ?>);
                                     Afficherlignelignecontrat('<?php echo $contrat->getId() ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire du Contrat Définitif
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td class="disabledbutton">
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2"> Contrat: <?php echo $contrat->getReference(); ?>.P N°: <?php echo $numerocomntrat; ?></td>
                                        </tr>

                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr><td>Bon de commande Interne N° :</td></tr>
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
                                            <td><?php echo date('d/m/Y', strtotime($contrat->getDatecreation())); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de Signature</td>
                                            <td><?php echo date('d/m/Y', strtotime($contrat->getDatesigntaure())); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>
                                                <?php
                                                if ($contrat->getType() == 0)
                                                    echo 'Livraison Total ';
                                                else
                                                    echo 'Livraison Partiel';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Type Paiement</td>
                                            <td>
                                                <?php
                                                if ($contrat->getTypepaiment() == 0)
                                                    echo 'Sans Décompte';
                                                else
                                                    echo 'Avec Décompte';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date Fin</td>
                                            <td>
                                                <input type="date" id="contratachat_datefin" value="<?php echo $contrat->getDatefin(); ?>">
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
                                                    AfficheLignedocBCIVersBCE('<?php echo $ids; ?>')">
                                        <tr class="disabledbutton">
                                            <td colspan="5">
                                                <select id="listescontrat" style="width: 100%">
                                                    <option value="0">-->Sélectionnez Contrat Provisoire</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id ===<?php echo $idbdcp ?>" selected="selected" value="{{demandeprix.id}}" fournisseuridbce="{{demandeprix.id_fournisseur}}" ng-init="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id !=<?php echo $idbdcp ?>"  value="{{demandeprix.id}}" fournisseuridbce="{{demandeprix.id_fournisseur}}" ng-click="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr class="disabledbutton">

                                            <td>Fournisseur</td>
                                            <td style="width: 10%">
                                                <input type="text" readonly="true" value="<?php echo $contrat->getFournisseur()->getReference() ?>"  id="reffournisseur1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" value="<?php echo $contrat->getFournisseur()->getRs() ?>"  id="fournisseur1" class="form-control" >


                                            </td>
                <!--                                            <td style="width: 100px">
                                                                <input type="text" value="" ng-model="reffournisseur.text" id="reffournisseur" class="form-control" ng-change="AfficheFournisseur('')">
                                                            </td>
                                                            <td>
                                                                <input type="text" value="" ng-model="fournisseur.text" id="fournisseur" class="form-control" ng-change="AfficheFournisseur('')">
                                                            </td>-->
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

                        <table style="list-style: none; margin-top: 80px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td colspan="4"> Montant Total TTC :</td>
                                <td colspan="4"><input class="align_right" type="text" id="total_ttc" value="<?php echo $contrat->getMontantcontrat(); ?>" readonly="true" /></td>
                            </tr>
                            <tr>
                                <td><label>Cautionnement définitif%</label></td>
                                <td><input type="text" id="contratachat_cautionement" value="<?php echo $contrat->getCautionement(); ?>" /></td>
                                <td><label>Retenue de garantie%</label></td>
                                <td><input   type="text" id="contratachat_retenuegaraentie" value="<?php echo $contrat->getRetenuegaraentie(); ?>" /></td>
                                <td><label>Avance%</label></td>                              
                                <td><input  type="text" id="contratachat_avance" value="<?php echo $contrat->getAvance(); ?>" /></td>                               
                                <td><label>Pénalité de RETARD%/Jour</label></td>
                                <td><input   type="text" id="contratachat_penalite" value="<?php echo $contrat->getpenalite(); ?>" /></td>                      
                            </tr>

                        </table>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°Ordre</th>
                                    <th style="text-align:center;width: 25%">DESIGNATION</th>

                                    <th style="width: 8%">Quantité</th>
                                    <th style="width: 10%">P.Unit.<br></th>
                                    <!--<th style="width: 6%">T.H.T<br></th>-->
                                    <th style="width: 10%" >Taux<br>Fodec</th>
<!--                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>-->
                                    <th style="width: 8%" class="disabledbutton">Taux<br>T.V.A</th>
                                    <!--<th style="width: 8%" class="disabledbutton">T.TTC</th>-->
                                    <th style="width: 10%">Projet</th>
                                    <th style="width: 14%">Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr ng-repeat="lignedoc in lignedocscontratp" >
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>

                                    <td><p style="border-bottom: #000 dashed 1px !important">
                                            <input type="text" class="form-control" style=""
                                                   id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}"
                                                   ordre="{{lignedoc.norgdre}}"
                                                   provisoire="" onchange="miseAjour(this)">{{lignedoc.unite}}</p></td>


                                    <td><p style="border-bottom: #000 dashed 1px !important"><input type="text" 
                                                                                                    class="form-control" style="" 
                                                                                                    id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.puht}}" 
                                                                                                    ordre="{{lignedoc.norgdre}}" provisoire=""
                                                                                                    onchange="miseAjour(this)">
                                        </p></td>
                                    <td style="display: none">{{lignedoc.totalhax}}</td>
                                    <td style="display: none">{{lignedoc.taufodec}}</td>
<!--                                     <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tauxfodec_p_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" 
                                                    provisoire="p_" onchange="miseAjour(this)">
                                                <option ng-repeat="fodec in fodeclistes" value="{{fodec.id}}">{{fodec.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>-->
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="taufodec_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" 
                                                    provisoire="" onchange="miseAjour(this)">
                                                <option ng-repeat="taufodec in fodeclistes" ng-if="lignedoc.idtaufodec == taufodec.id" 
                                                        selected="selected" value="{{taufodec.id}}">{{taufodec.libelle}}</option>
                                                <option ng-repeat="taufodec in fodeclistes" ng-if="lignedoc.idtaufodec != taufodec.id" 
                                                        value="{{taufodec.id}}">{{taufodec.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>
<!--                                    <td>{{lignedoc.fodec}}</td>
                                    <td>{{lignedoc.totalhtva}}</td>-->
<!--                                     <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_p_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}"
                                                    provisoire="p_" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>-->
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" 
                                                    provisoire="" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.idtva == tva.id" 
                                                        selected="selected" value="{{tva.id}}">{{tva.libelle}}</option>
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.idtva != tva.id" 
                                                        value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>

                                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                                    <!--<td>{{lignedoc.totalttc}}</td>-->
                                    <td>{{lignedoc.projet}}</td>
                                    <td>{{lignedoc.observation}}</td>
<!--                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.observation}}</textarea>
                                        </p>
                                    </td>-->
                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocContrat(lignedoc.norgdre, '')" > 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php //                            if (sizeof(lignedocslignecontratp) >= 1): ?>
                        <table ng-if="lignedocslignecontratp.length > 0">
                            <legend  ng-if="lignedocslignecontratp.length > 0">Sous Détail des lignes du contrat</legend>
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°Ordre</th>
                                    <th style="text-align:center;width: 25%">DESIGNATION</th>

                                    <th style="width: 8%">Type Pièce</th>
                                    <th style="width: 10%">Pourcentage<br></th>

                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignelignedoc in lignedocslignecontratp" >
                                    <td style="display: none"><input type="text" value="{{lignelignedoc.id}}" id="id_lignecontrat"></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">
                                            {{lignelignedoc.norgdre}}</p></td>
                                    <td>{{lignelignedoc.designation}}</td>
                                    <td style="display: none">{{lignelignedoc.idtypepiece}}</td>
                                    <td>{{lignelignedoc.typepiece}}</td>
                                    <td style="text-align: right"><input style="text-align: right" type="text" value="{{lignelignedoc.tauxpourcentage}}"  id="taupourc_{{lignelignedoc.norgdre}}"></td>
                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneligneDocContrat(lignelignedoc.norgdre, '')" > 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneligneContrar(lignelignedoc.norgdre, '')" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php // endif; ?>
                        <div id="btnvalider_contrat" >
                            <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary" ng-click="ValiderContratdefinitif('<?php echo $ids; ?>', '', '<?php echo $contrat->getId(); ?>')"> 
                        </div>
                    </div>
                </div>
                <div class="tab-pane" style="height: 1200px" id="listesdemandeprix" ng-controller="CtrlListesBonexterne" ng-init="AfficheDoc('<?php echo $ids; ?>')">
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
                                    <th style="text-align: center;">Numéro</th>
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
                                                <td>
                                                    <a href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') ?>{{demandeprix.id}}" class="btn btn-xs btn-primary" ng-model="BtnExporter" target="_blanc">Exporter PDF</a>
                                                </td>    
                                            </tr>
                                            <tr id="atr_{{demandeprix.id}}" class="disabledbutton" ng-if="demandeprix.idtypedoc === 7">
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
                                                <legend>Attacher fiche scannée</legend>
                                                <div class="col-lg-12">
                                                    <div class="content">
                                                        <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();" class="btn btn-info">
                                                        <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click="" class="btn btn-info">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset style="padding: 10px;">
                                                <div class="col-lg-12" >
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

<script  type="text/javascript">

//    function miseAjour_() {
//        $('[name="miseAjour"]').each(function () {
//            var norgdre = $(this).attr('ordre');
//            var p = $(this).attr('provisoire');
//
//            angular.element($(this)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
//        });
//    }

    function miseAjour(element_input) {
        var norgdre = $('#' + element_input.id).attr('ordre');
        var p = $('#' + element_input.id).attr('provisoire');
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocContrat(norgdre, p);
    }

</script>