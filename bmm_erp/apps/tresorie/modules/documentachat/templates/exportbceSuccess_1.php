<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat()
   ?><?php endforeach; ?>
        <?php
        $docparent = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 7);
        $docparentbcebdc = DocumentachatTable::getInstance()->getBybceBdc($document_achat->getId());
        $liste_tauxfodec = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('tauxfodec')
                ->orderBy('id')
                ->execute();
        ?>
    </h1>
    <input type="hidden" id="iddoc" value="<?php echo $documentachat->getId(); ?>">
    <input type="hidden" id="idbdcp" value="<?php echo $idbdcp; ?>">
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $documentachatBCE = DocumentachatTable::getInstance()->find($ids);
    ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>
<!--<li class="<?php // if ($tab == "") echo 'active'                                       ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>-->
                <li class="<?php if ($tab != "3") echo 'active' ?>"><a href="#profilep" data-toggle="tab" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" aria-expanded="false">Fiche B. C. Externe Provisoire</a></li>
                <li class="<?php if ($tab == "3") echo 'active' ?>"><a href="#profile" data-toggle="tab" aria-expanded="false" ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix();
                            AfficheDocBCEP('<?php echo $ids; ?>')">Fiche B. C. Externe Défifinitf</a></li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste Bons de Commandes Externes</a></li>
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
<!--                <div class="tab-pane <?php // if ($tab == "") echo 'fade active in'                                       ?>" id="home">
<h4>Bon de commande Interne N°:<?php // echo $documentachat->getNumerodocachat()                                       ?></h4> 
<div>  <a href="<?php //echo url_for('documentachat/etapefinal?etapedoc=11&iddoc=') . $documentachat->getId()                                                ?>" style="margin-left: 40%" type="button"    class="btn btn-primary"  >
Valider et passer à l'étape suivante
</a>
<a  href="<?php //echo url_for('documentachat/index')                                                ?>" class="btn btn-primary">Annuler </a>
</div>
<div style="margin-top: 10px;">
<object style="width: 100%;height: 900px;" data="<?php // echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId())                                       ?>" type="application/pdf">
<embed src="<?php // echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId())                                       ?>" type="application/pdf" />
</object>
</div>
</div>-->
                <div class="tab-pane <?php if ($tab != "3") echo 'fade active in' ?>" id="profilep" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE('<?php echo $ids ?>', 'p')">
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
<!--                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                                      ?></td>
                                        </tr>-->
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
                                                    <?php foreach ($liste_document_achats as $document_achat): ?>
                                                        <?php $fournisseurs = FournisseurTable::getInstance()->getByDemandePrix($document_achat->getId()); ?>
                                                        <?php foreach ($fournisseurs as $fournisseur): ?>
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

                        <table style="list-style: none; margin-top: 36px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Montant Total TTC :</td>
                                            <td><input class="align_right" type="text" id="total_ttc_provisoire" value="" readonly="true" /></td>
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
                                    <th style="width: 80px">Quantité</th>
                                    <th style="width: 80px">P.Unit.<br>H.T</th>                                    
                                    <th style="width: 6%">T.H.T<br></th>
                                    <th style="width: 7%" >Taux<br>Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                    <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                                    <th style="width: 80px">Taux<br>T.V.A</th>
                                    <th style="width: 8%" class="disabledbutton">T.TTC</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="lignedoc in lignedocsdeponsep">
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td style="text-align: center;" ><p style="border-bottom: #000 dashed 1px !important" >
                                            <input type="text" class="form-control align_center" style="" id="qte_p_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p></td>
                                    <td ><p style="border-bottom: #000 dashed 1px !important">
                                            <input type="text" class="form-control align_center" style="" id="puht_p_{{lignedoc.norgdre}}" value="{{lignedoc.puht}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)"></p></td>

                                    <td><input type="text" class="form-control" style="" id="totalhax_p_{{lignedoc.norgdre}}"  readonly="true"></td>
                                    <td>

                                        <input type="hidden" id="idtaufodec_p_{{lignedoc.norgdre}}">

                                        <select id="taufodec"  >
                                            <option id="0"></option>
                                            <?php foreach ($liste_tauxfodec as $tau): ?>
                                                <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td> <td><input type="text" class="form-control" style="" id="fodec"   readonly="true"></td>
                                    <td><input type="text" class="form-control" style="" id="totalhtva"  readonly="true" ></td>

                                    <td >
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <select id="tva_p_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" 
                                                    onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="totalttc" readonly="true" ></td><!--disabled="true"-->

                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)"></textarea>
                                        </p>
                                    </td>
                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, 'p_')"> 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, 'p_')">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary" ng-click="ValiderBondexterne('<?php echo $ids; ?>', '_p')">
                    </div>
                </div>
                <div class="tab-pane <?php if ($tab == "3") echo 'fade active in' ?>" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersBCE('<?php echo $ids ?>', '')">
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
<!--                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                                     ?></td>
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
                                        <tr><?php
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneById($document_achat->getId());
                                            $contrat = $bci->getContratachat();
                                            if (sizeof($contrat) >= 1):
                                                $montantcontrat = $contrat->getMontantcontrat();
                                            endif;
                                            ?>

                                            <?php
                                            $total = 0;
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneById($document_achat->getId());
                                            $montant_final = $bci->getMontantestimatif();

                                            $bces = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdEtatdoc($document_achat->getId(), 7, 27);
//                                                   die(sizeof($bces).'mp');
                                            foreach ($bces as $bce):
                                                $total = $total + $bce->getMntttc();
                                            endforeach;
                                            ?>

                                            <td>Date de création
                                                <input type="hidden" value="<?php echo $total ?>" id="total">
                                                <input type="hidden" value="<?php echo $montant_final ?>" id="mnt_estimatif"></td>
                                            <td><?php echo date('d/m/Y') ?></td>
                                            <td>
                                                <input type="hidden" value="<?php
                                                if (sizeof($contrat) >= 1): echo $montantcontrat;
                                                endif;
                                                ?>" id="montant_contrat">
                                            </td>
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
                                    <table ng-init="InialiserDemandePrix();
                                                    AfficheDocBCEP('<?php echo $ids; ?>')">
                                        <tr class="disabledbutton">
                                            <td colspan="5">
                                                <select id="listesbdcp" style="width: 100%">
                                                    <option value="0">-->Sélectionnez BCEP</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id ===<?php echo $idbdcp ?>" selected="selected" value="{{demandeprix.id}}" fournisseuridbce="{{demandeprix.id_fournisseur}}" 
                                                            ng-init="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
                                                    <option ng-repeat="demandeprix in docDemandePrix" ng-if="demandeprix.idtypedoc === 18 && demandeprix.id !=<?php echo $idbdcp ?>"  value="{{demandeprix.id}}"
                                                            fournisseuridbce="{{demandeprix.id_fournisseur}}" ng-click="EtatBCEP_dans_budget(demandeprix.id)">{{demandeprix.numero}} - {{demandeprix.rs}}</option>
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

                        <table style="list-style: none; margin-top: 67px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td>Montant Total TTC :</td>
                                            <td><input class="align_right" type="text" id="total_ttc" 
                                                <?php
                                                if (sizeof($docparentbcebdc) >= 1) {
                                                    if (sizeof($documentachatBCE) >= 1) {
                                                        if ($documentachatBCE->getIdTypedoc() != 6) {
                                                            ?> 
                                                                   value="<?php echo $documentachatBCE->getMntttc() ?>"

                                                                   <?php
                                                               }
                                                           }
                                                       }
                                                       ?> readonly="true" /></td>
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
                                    <th style="width: 80px">Quantité</th>
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
                                        <input type="text" class="form-control" ng-model="designation.text" id="designation" ng-click="ChoisArticle(<?php //echo $documentachat->getId()                      ?>)" ng-change="ChoisArticle(<?php //echo $documentachat->getId()                      ?>)"></td>
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
                                        <input type="button" value="-"  class="btn btn-xs btn-danger" ng-click="ViderLignedocBondeponse()" >
                                    </td>
                                </tr>-->
                                <tr ng-repeat="lignedoc in lignedocsdeponse" >
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important" class="disabledbutton">
                                            <input type="text" class="form-control" style="" id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important" class="disabledbutton">
                                            <input type="text" class="form-control" style="" id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.mntht}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)"></p></td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important" class="disabledbutton">
                                            <select id="tva_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva == tva.id" selected="selected" value="{{tva.id}}">{{tva.libelle}}</option>
                                                <option ng-repeat="tva in tvalistes" ng-if="lignedoc.id_tva != tva.id" value="{{tva.id}}">{{tva.libelle}}</option>
                                            </select>
                                        </p>
                                    </td>
                                    <td class="disabledbutton">
                                        <p style="border-bottom: #000 dashed 1px !important">
                                            <textarea id="desc_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="" onchange="miseAjour(this)">{{lignedoc.observation}}</textarea>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCommandeExterne(lignedoc.norgdre, '')" > 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCExterne(lignedoc.norgdre, '')" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="btnvalider_bdcd" class="disabledbutton">
                            <input type="button" value="Enregistrer" id="btnvalider_bce" 
                                   ng-model="btnvalider" 
                                   <?php if (sizeof($docparent) >= 1): ?>  class="btn btn-primary disabledbutton"    
                                   <?php else: ?>
                                       class="btn btn-primary" 
                                   <?php endif; ?>
                                   ng-click="ValiderBondexterne('<?php echo $ids; ?>', '')"

                                   > 
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
                                            <tr id="atr_{{demandeprix.id}}"  ng-if="demandeprix.idtypedoc === 7">
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
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }

</script>