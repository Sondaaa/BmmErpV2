<?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
<?php $liste_document_achats = DocumentachatTable::getInstance()->getByIds($iddocachat); ?>
<div id="sf_admin_container">
    <h1><?php echo 'Mise à jour fiche Contrat'; ?></h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="myCtrlioscontrat">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">

                    <?php foreach ($liste_document_achats as $document_achat): ?>
                        <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                    <?php endforeach; ?>
<!--<li class="<?php // if ($tab == "") echo 'active'                                                ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>-->
                    <li><a href="#profilep" data-toggle="tab" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" aria-expanded="false">Fiche Contrat Provisoire</a></li>
                    <li ><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix();
                                        AfficheDocBCEP('<?php echo $ids; ?>')">Fiche Contrat Définitif </a></li>

                    <li class="active">
                        <a data-toggle="tab" href="#home_misjour">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Mis à jour Fiche Contrat 
                        </a>
                    </li>
                </ul>
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
                    <div class="tab-pane "  id="profilep" ng-controller="CtrlDemandeprix" 
                         ng-init="AfficheLignedocBCIVersContrat('<?php echo $ids ?>', 'p',<?php echo $contratachat->getId() ?>);
                                                 Afficherlignelignecontrat('<?php echo $contratachat->getId() ?>')"

                         >
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
                                                <td colspan="2"> Contrat: <?php echo $contratachat->getReference(); ?>.P N°: <?php echo $contratachat->getNumero(); ?></td>
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
                                                <td><?php echo date('d/m/Y', strtotime($contratachat->getDatecreation())); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date de Signature</td>
                                                <td><?php echo date('d/m/Y', strtotime($contratachat->getDatesigntaure())); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>
                                                    <input type="text" value="<?php
                                                    if ($contratachat->getType() == 0)
                                                        echo 'Livraison Total ';
                                                    else
                                                        echo 'Livraison Partiel';
                                                    ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Date Fin</td>
                                                <td>
                                                    <?php echo date('d/m/Y', strtotime($contratachat->getDatefin())); ?>
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
                                                    <input type="text" readonly="true" value="<?php echo $contratachat->getFournisseur()->getReference() ?>"  id="reffournisseur1" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $contratachat->getFournisseur()->getRs() ?>"  id="fournisseur1" class="form-control" >
                                                    <input type="hidden" value="<?php echo $contratachat->getIdFrs() ?>"  id="fournisseur_id" class="form-control" >

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
                                                <td style="text-align: right"><b><?php echo $contratachat->getMontantcontrat(); ?></b></td>
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
                            <table>
                                <legend>Sous Détail des lignes du contrat</legend>
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
                                            <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneligneContrar(lignelignedoc.norgdre, '')" >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="profile" ng-controller="CtrlDemandeprix" 
                         ng-init="AfficheLignedocBCIVersContrat('<?php echo $ids ?>', '',<?php echo $contratachat->getId() ?>);
                                         Afficherlignelignecontrat('<?php echo $contratachat->getId() ?>')">
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
                                                <td colspan="2"> Contrat: <?php echo $contratachat->getReference(); ?>.P N°: <?php echo $numerocomntrat; ?></td>
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
                                                <td><?php echo date('d/m/Y', strtotime($contratachat->getDatecreation())); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date de Signature</td>
                                                <td><?php echo date('d/m/Y', strtotime($contratachat->getDatesigntaure())); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>
                                                    <?php
                                                    if ($contratachat->getType() == 0)
                                                        echo 'Livraison Total ';
                                                    else
                                                        echo 'Livraison Partiel';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Date Fin</td>
                                                <td>
                                                    <input type="date" id="contratachat_datefin" value="<?php echo date('d/m/Y', strtotime($contratachat->getDatefin())); ?>">
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

                                            <tr>
                                                <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                            </tr>
                                            <tr class="disabledbutton">

                                                <td>Fournisseur</td>
                                                <td style="width: 10%">
                                                    <input type="text" readonly="true" value="<?php echo $contratachat->getFournisseur()->getReference() ?>"  id="reffournisseur1" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $contratachat->getFournisseur()->getRs() ?>"  id="fournisseur1" class="form-control" >


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
                                    <td colspan="4"><input class="align_right" type="text" id="total_ttc" value="<?php echo $contratachat->getMontantcontrat(); ?>" readonly="true" /></td>
                                </tr>
                                <tr>
                                    <td><label>Cautionnement définitif%</label></td>
                                    <td><input class="align_right" type="text"  value="<?php echo $contratachat->getCautionement(); ?>" /></td>
                                    <td><label>Retenue de garantie%</label></td>
                                    <td><input class="align_right" type="text" value="<?php echo $contratachat->getRetenuegaraentie(); ?>" /></td>
                                    <td><label>Avance%</label></td>                              
                                    <td><input class="align_right" type="text"  value="<?php echo $contratachat->getAvance(); ?>" /></td>                               
                                    <td><label>Pénalité de RETARD%/Jour</label></td>
                                    <td><input class="align_right" type="text"  value="<?php echo $contratachat->getpenalite(); ?>" /></td>                      
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
                                            <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php //                            if (sizeof(lignedocslignecontratp) >= 1): ?>
                            <table>
                                <legend>Sous Détail des lignes du contrat</legend>
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
                                            <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneligneContrar(lignelignedoc.norgdre, '')" >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php // endif; ?>

                        </div>
                    </div>
                    <div id="home_misjour" class="tab-pane fade in active">
                        <fieldset>
                            <div class="col-lg-12">
                                <fieldset >
                                    <legend>Information <?php echo "Contrat "; ?></legend>
                                    <table >
                                        <tbody>
                                            <tr>
                                                <td>Fournisseur</td>
                                                <td ><?php echo $form->getObject()->getFournisseur() ?></td>
                                                <td>Contrat </td>
                                                <td>
                                                    <?php echo $form->getObject()->getReference() . '   N°: ' . $form->getObject()->getNumero() ?>
                                                </td>
                                                <td>Type</td>
                                                <td >
                                                    <?php
                                                    if ($form->getObject()->getType() == 0)
                                                        echo 'Livraison Total ';
                                                    else
                                                        echo 'Livraison Partiel';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>Document achat </td>
                                                <td >
                                                    <?php echo $form->getObject()->getDocumentachat()->getFirst()->getNumerodocumentachat() ?>
                                                </td>

                                                <td>Date de création</td>
                                                <td style="text-align: center"><?php echo date('d/m/Y', strtotime($form->getObject()->getDatecreation())); ?></td>

                                        <input type="hidden" id="date_creation" value="<?php echo date('d/m/Y', strtotime($form->getObject()->getDatecreation())); ?>">
                                        <td>Date de Signature</td>

                                        <input type="hidden" id="date_signature" value="<?php if ($form->getObject()->getDatesigntaure() != '') echo date('d/m/Y', strtotime($form->getObject()->getDatesigntaure())); ?>">
                                        <td style="text-align: center">
                                            <?php if ($form->getObject()->getDatesigntaure()): ?>
                                                <?php
                                                echo date('d/m/Y', strtotime($form->getObject()->getDatesigntaure()));
                                            endif;
                                            ?>
                                        </td>
                                        </tr>
                                        <?php
                                        $os_commencement = OrdredeservicecontratachatTable::getInstance()->findByIdContratAndIdType($form->getObject()->getId(), 1);
                                        if (sizeof($os_commencement) >= 1)
                                            $dateos = $os_commencement->getFirst()->getDateios();
//                                        $os_arret = OrdredeservicecontratachatTable::getInstance()->findByIdContratAndIdType($form->getObject()->getId(), 5);
//                                        $os_reprise = OrdredeservicecontratachatTable::getInstance()->findByIdContratAndIdType($form->getObject()->getId(), 4);
//                                        if (sizeof($os_reprise) >= 1)
//                                            $periode_jusfier = $os_commencement->getFirst()->getDateios();
                                        ?>
                                        <tr>
                                            <td >Date OS Comm.Travaux</td>
                                            <td  style="text-align: center">
                                                <?php if (sizeof($os_commencement) >= 1)
                                                {if ($dateos != '')
                                                echo date('d/m/Y', strtotime($dateos));}
                                                ?>
                                                <input type="hidden" style="text-align: center" readonly="true"
                                                       value="<?php if ($dateos != '') echo $dateos; ?>" id="datedebut" />
                                            </td>
                                            <td>Délai d'execution</td>
                                            <td><input id="contratachat_delaicontratcuel" type="text" value="<?php echo $form->getObject()->getDelaicontratcuel(); ?>" placeholder="Delai d'execution" ></td>
                                            <td >Date Fin
                                            </td>

                                            <td  >

                                                <input type="text" readonly="true" value="<?php echo $form->getObject()->getDatefin(); ?>" id="datefin_contrat" />
                                                <label> Période d'arrêt justifié :</label>
                                                <input type="text" id="delaijustifie"
                                                       value="<?php echo $form->getObject()->getPeriodejustifier(); ?>"
                                                       readonly="true" >
                                            </td>

                                        </tr>
                                        <tr>
                                            <td > Montant Total TTC :</td>
                                            <td style="text-align: right">
                                                <input type="text" class="align_right" value=" <?php echo $contratachat->getMontantcontrat(); ?>" 
                                                       id="contratachat_mnttc" readonly="true"/>
                                            </td>
                                            <td>Cautionnement définitif%</td>
                                            <td><input class="align_right"

                                                       type="text" id="contratachat_cautionement" 
                                                       value="<?php echo $contratachat->getCautionement(); ?>" /></td>

                                            <td >Retenue de garantie%</td>
                                            <td><input class="align_right" type="text" id="contratachat_retenuegaraentie" value="<?php echo $contratachat->getRetenuegaraentie(); ?>" /></td>
                                        </tr>
                                        <tr> 

                                            <td>Avance%</td>                              
                                            <td><input class="align_right" type="text" id="contratachat_avance" value="<?php echo $contratachat->getAvance(); ?>" /></td>                               



                                            <td>Pénalité de RETARD%/Jour</td>
                                            <td>
                                                <input class="align_right" type="text" id="contratachat_penalite"
                                                       value="<?php echo $contratachat->getPenalite(); ?>" />
                                            </td>
                                            <td>Max Pénalité de RETARD%</td>
                                            <td>
                                                <input class="align_right" type="text" id="contratachat_maxpinalite"
                                                       value="<?php echo $contratachat->getMaxpinalite(); ?>" />

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <fieldset style="margin-left: 50%">
                                    <legend>Action Fiche Contrat</legend>
                                    <div>
                                        <input id="btnvalider" style="margin-left: 2px" 
                                               ng-click="ValiderPenaliteContratAchat(<?php echo $contratachat->getId(); ?>)" type="button" 
                                               value="Enregistrer Contrat ... " class="btn  btn-success" />
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>    
</div>
<script>

</script>
