<div ng-controller="CtrlMouvement">
<div id="general" class="row"    
<fieldset>
                <?php 
                $liste_piecemonnaie =   Doctrine_Query::create()
                ->select("id,libelle,valeur")
                ->from('piecemonnaie')
                ->orderBy('libelle')->execute();
                ?>
                
     <legend>Données fiche</legend>
                <table id="liste_ligne" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center">Piece Monnaie<br> </th>
                                    <th style="width: 80px">Quantité</th>                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="disabledbutton"> <input type="text" id="nordre"></td>
                                    <td>
                                    <input type="hidden" id="idpiecemonnaie">
                                    <select id="piecemonnaie" class="chosen-select form-control">
                                    <?php foreach ($liste_piecemonnaie as $tau) : ?>
                                        <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getValeur() ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    </td>
                                    <td><input type="text" class="form-control" style="" id="qte"></td>
                                  <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailPiecemonaie()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsPiecemonnaie()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocspiecemonnaie">
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                                    </td>
                                    <td>
                                        {{lignedoc.piecemonnaie}}
                                    </td>
                                    <td style="text-align: center;">
                                        {{lignedoc.qte}}                                      
                                    </td>                                                                     
                                    <td style="text-align: center;">
                                        <a class="btn btn-xs btn-primary" ng-click="UpdateDetailPiecemonnaie(lignedoc.norgdre)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" ng-click="DeleteLignePiecemonnaie(lignedoc.norgdre)">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                        <?php ?>
                                    </td>                                   
                                </tr>
                               
                            </tbody>
                        </table>  
                        <table style="margin-bottom: 0px;margin-left: 1400px;width: 15%" class="pull-rigth table table-bordered table-hover">
                                        <tr>
                                            <td>
                                            <input class="align_right" type="text" id="total_monnaie"   readonly="true"/>
                                            </td>
                                        </tr>
                        </table>
                        <div></div>
                        
                </fieldset>  
                                    </div>
                <fieldset style="margin-left: 50%">
        <legend>Action Fiche D.I.</legend>      
        <!-- <a id="btn_retour" type="button" style="width: 25%;"   
        class="btn btn-white btn-default pull-left" style="margin-right: 2px;"
         href="<?php //echo url_for('mouvementbanciare/journalCaisse') ?>">
                Retour à la liste</a>  -->
        <button class="btn btn-sm btn-success center" data-dismiss="modal"                        
        ng-click="Validerdetailmonnaie()" style="margin-left: 3px;" >
            <i class="ace-icon fa fa-save"></i>
            Valider Détail
        </button>                     
    </fieldset>
                
            
</div>         