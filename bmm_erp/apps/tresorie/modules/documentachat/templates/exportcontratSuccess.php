<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php if ($tab == "") echo 'active' ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a>
                </li>
                <li class=""><a href="#profilep" data-toggle="tab" aria-expanded="false" ng-controller="CtrlContrat" ng-click=" ListesTva();
                            InialiserCombo();
                            InialiserLigneBCI(<?php echo $documentachat->getId(); ?>);">Fiche Contrat</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane <?php if ($tab == "") echo 'fade active in' ?>" id="home">
                    <h4>Bon de Commande Interne N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 
<!--                    <a href="<?php //echo url_for('documentachat/etapefinal?etapedoc=10&iddoc=') . $documentachat->getId()                 ?>" style="margin-left: 70%" type="button"    class="btn btn-primary1"  >
                        Valider et passer à l'étape suivante
                    </a>
                    <a  href="<?php //echo url_for('documentachat/index')                 ?>">Annuler </a>-->
                    <div style="margin-top: 10px;">
                        <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                            <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                        </object>
                    </div>
                </div>
                <div class="tab-pane" id="profilep" ng-controller="CtrlContrat" ng-init="ListesTva();
                                    InialiserCombo();
                                    InialiserLigneBCI(<?php echo $documentachat->getId(); ?>);">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Contrat
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">contrat N°: <?php echo $numerodemande ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bon de commande Interne N°:</td>
                                            <td><?php echo $documentachat->getNumerodocachat() ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d/m/Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de Signature</td>
                                            <td><input type="date" value="<?php echo date('d/m/Y') ?>" id="datesigntaure"></td>
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
                                                <input type="text" readonly="true" value="" ng-model="reffournisseur1.text" id="reffournisseur1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" value="" ng-model="fournisseur1.text" id="fournisseur1" class="form-control" ng-change="AfficheFournisseur1('#reffournisseur1', '#fournisseur1', '#fournisseur_id')">
                                                <input type="hidden" id="fournisseur_id" value="" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table> 
                    </div>
                    <div>
                        <div class="row">
                            <!--<div class="col-lg-10"></div>-->
                            <div class="col-lg-2" style="float: right;">
                                <table>
                                    <tr>
                                        <td>
                                            <label>Montant Total</label>
                                            <input type="number" id="txt_mnttotal" class="align_right">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-2" style="float: right;">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="font-weight: bold;">Total TTC</label>
                                            <input type="text" id="mnttotal" readonly="true" class="align_right">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center">DESIGNATION</th>
                                    <th style="width:80px">Unité</th>
                                    <th style="width: 80px">Quantité</th>
                                    <th style="width: 80px">P.Unit.<br></th>
                                    <th style="width: 80px" class="disabledbutton">Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #EDEDED;">
                                    <td class="disabledbutton">
                                        <input type="text" id="nordre"></td>
                                    <td>
                                        <textarea id="designation" style="height: 32px;"></textarea>
                                    </td>
                                    <td>
                                        <select id="unite">
                                            <option></option>
                                            <option value="Piéce">Piéce</option>
                                            <option value="Lot">Lot</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="" id="qte">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="" id="puht"></td>
                                    <td>
                                        <select id="tva">
                                            <option></option>
                                            <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea id="observation" class="form-control" style="height: 32px;"></textarea>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-primary" ng-click="AddDetail()">
                                            <i class="fa fa-plus"></i>
                                        </a> 
                                    </td>
                                </tr>
                                <tr ng-repeat="item in detailscontrats">
                                    <td>{{item.norgdre}}</td>
                                    <td>{{item.designation}}</td>
                                    <td>{{item.unite}}</td>
                                    <td>{{item.qte}}</td>
                                    <td>{{item.puht}}</td>
                                    <td>{{item.tva}}</td>
                                    <td style="display: none;">{{item.prixttc}}</td>
                                    <td>{{item.observation}}</td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-xs btn-primary" ng-click="UpdateDetail(item.norgdre)" > 
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" ng-click="DeleteLigneContrat(item.norgdre)" >
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row" style="width: 100%; text-align: right;">
                            <input id="btn_validation" type="button" value="Enregistrer" class="btn btn-primary1 " ng-click="ValiderContrat(<?php echo $documentachat->getId() ?>)" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>

    .align_right{text-align: right;}

</style>