<div id="sf_admin_container"> 
    <div id="sf_admin_content">
        <div class="col-sm-12" >
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Avenant qui touche le Contrat & Modalite de Paiement
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active"
                         ng-controller="CtrlDemandeprix" 
                         ng-init="AfficheLignedocBCIVersContrat('<?php echo $ids ?>', '',<?php echo $contrat->getId() ?>);
                                         Afficherlignelignecontrat('<?php echo $contrat->getId() ?>')"
                         >
                        <fieldset>
                            <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                                <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td>
                                            <table style="margin-bottom: 0px;">

                                                <tr>
                                                    <td>N° Contrat : </td> 
                                                    <td><input type="text" value="<?php echo $contrat->getNumero(); ?>" id="numero_contrat">
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <td>Bon de commande Interne N°:</td>
                                                    <td><?php echo $documentachat->getNumerodocachat() ?></td>
                                                </tr>                                                
                                                <tr>
                                                    <td>Nom du Contrat: </td>
                                                    <td><input type="text" value="<?php echo $contrat->getReference(); ?>" id="reference">
                                                       
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Date de création</td>
                                                    <td> <?php echo date('d/m/Y') ?> 
                                                    </td>
                                                </tr>
                                                <tr>  
                                                   <td>Date de Signature</td>
                                                    <td><input type="date" value="<?php echo $contrat->getDatesigntaure() ?>"
                                                               id="datesigntaure">
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
                                            <table ng-init="InialiserDemandePrix();
                                                            AfficheLignedocBCIVersBCE('<?php echo $ids; ?>')" class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                                </tr>
                                                <tr >
                                                    <td>Fournisseur</td>
                                                    <td style="width: 100px">
                                                        <input type="text" readonly="true" value="<?php echo $contrat->getFournisseur()->getReference() ?>" id="reffournisseur1" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input readonly="true" type="text" value="<?php echo $contrat->getFournisseur()->getRs() ?>" id="fournisseur1" class="form-control" 
                                                               >
                                                        <input type="hidden" id="fournisseur_id" value="<?php echo $contrat->getIdFrs() ?>" />
                                                    </td>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                            <div>

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">N°Ordre</th>
                                            <th style="text-align:center;width: 25%">DESIGNATION</th>

                                            <th style="width: 10%">Quantité</th>
                                            <th style="width: 10%">P.Unit.<br></th>
                                            <!--<th style="width: 6%">T.H.T<br></th>-->
                                            <th style="width: 10%" >Taux<br>Fodec</th>
        <!--                                    <th style="width: 8%" class="disabledbutton">Fodec</th>
                                            <th style="width: 8%" class="disabledbutton">T.H.TVA</th>-->
                                            <th style="width: 10%" class="disabledbutton">Taux<br>T.V.A</th>
                                            <!--<th style="width: 8%" class="disabledbutton">T.TTC</th>-->
                                            <th style="width: 10%">Projet</th>
                                            <th style="width: 15%">Observations</th>
                                            <!--<th></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr ng-repeat="lignedoc in lignedocscontratp" >
                                            <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                            <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>

                                            <td class="disabledbutton"><p style="border-bottom: #000 dashed 1px !important">
                                                    <input type="text" class="form-control" style=""
                                                           id="qte_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}"
                                                           ordre="{{lignedoc.norgdre}}"
                                                           provisoire="" onchange="miseAjour(this)">{{lignedoc.unite}}</p></td>


                                            <td class="disabledbutton"><p style="border-bottom: #000 dashed 1px !important"><input type="text" 
                                                                                                                                   class="form-control" style="" 
                                                                                                                                   id="puht_{{lignedoc.norgdre}}" value="{{lignedoc.puht}}" 
                                                                                                                                   ordre="{{lignedoc.norgdre}}" provisoire=""
                                                                                                                                   onchange="miseAjour(this)">
                                                </p></td>
                                            <td style="display: none">{{lignedoc.totalhax}}</td>
                                            <td style="display: none">{{lignedoc.taufodec}}</td>
                                            <td class="disabledbutton">
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
                                            <td class="disabledbutton">
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
                                            <td>{{lignedoc.projet}}</td>
                                            <td>{{lignedoc.observation}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php ?>
                                <table class="table table-striped table-bordered table-hover">
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
                                            <td><input type="text" value="{{lignelignedoc.designation}}"
                                                       id="design_{{lignelignedoc.norgdre}}"></td>
                                            <td style="display: none">{{lignelignedoc.idtypepiece}}</td>
                                            <td>{{lignelignedoc.typepiece}}</td>
                                            <td style="text-align: right">
                                                <input style="text-align: right" type="text"
                                                       value="{{lignelignedoc.tauxpourcentage}}" 
                                                       id="taupourc_{{lignelignedoc.norgdre}}">


                                            </td>
                                            <td style="text-align: center;">  
                                                <input type="button" value="V" class="btn btn-primary" ng-click="MisAjourLigneligneDocContrat(lignelignedoc.norgdre)" > 
                                                <input type="button" value="-" class="btn btn-danger" ng-click="DeleteLigneligneContrar(lignelignedoc.norgdre, '')" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php // endif;?>
                                <div class="row">

                                    <div class="col-lg-2" style="float: right;">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td>
                                                    <label style="font-weight: bold;">Montant Total TTC</label>
                                                    <input type="text" id="mnttotal" readonly="true" class="align_right" value="<?php echo $contrat->getMontantcontrat(); ?>">
                                                </td>
                                            </tr>
                                            <table style="margin-bottom: 0px;">

                                            </table>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="width: 100%; text-align: right;">
                                    <input id="btn_validation" type="button" value="Enregistrer" class="btn btn-primary1 " ng-click="ValiderContratAvenantTypeDate('<?php echo $documentachat->getId(); ?>', '<?php echo $contrat->getId(); ?>')" >
                                </div>
                            </div>
                        </fieldset></div>
                </div>
            </div>
        </div>
    </div><!--/.col -->
</div>


