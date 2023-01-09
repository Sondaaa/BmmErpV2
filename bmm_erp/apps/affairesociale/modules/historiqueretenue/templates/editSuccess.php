<div id="sf_admin_container">
    <h1>Mise à jour Fiche de paiement de Retenue </h1>
</div>

<div class="row" ng-controller="CtrlAffairesociale">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Fiche de Paiement de Retenue

                    <?php if ($historiqueretenue->getIdRetenue() != ""): ?>
                        <?php $id_retenue = $historiqueretenue->getIdRetenue(); ?>
                        <?php echo $historiqueretenue->getRetenuesursalaire()->getFournisseur()->getRs(); ?>
                    <?php elseif ($historiqueretenue->getIdDemandepret() != ""): ?>
                        <?php $id_deamandepret = $historiqueretenue->getIdDemandepret(); ?>
                        <?php echo $historiqueretenue->getDemandepret()->getPret()->getLibelle(); ?>
                    <?php elseif ($historiqueretenue->getIdDemandeavance() != ""): ?>
                        <?php $id_demandeavance = $historiqueretenue->getIdDemandeavance(); ?>
                        <?php echo $historiqueretenue->getDemandeavance()->getAvance()->getLibelle(); ?>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">
                    <fieldset id="sf_fieldset_none">
                        <div class="col-lg-1"></div>
                        <div >
                            <?php
                            $id = $historiqueretenue->getId();
                            $historiqueretenue = Doctrine_Core::getTable('historiqueretenue')->findOneById($id);
                            ?>
                            <input type="hidden" value="<?php echo $historiqueretenue->getId(); ?>" id="id_historiqueretenue">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td style="width: 10%"><label>Agents:</label></td>
                                    <td style="width: 30%">
                                        <label>  
                                            <?php if ($historiqueretenue->getIdRetenue() != ""): ?>
                                                <?php echo $historiqueretenue->getRetenuesursalaire()->getAgents()->getNomComplet() . " " . $historiqueretenue->getRetenuesursalaire()->getAgents()->getPrenom() . "       " . $historiqueretenue->getRetenuesursalaire()->getAgents()->getIdrh() ; ?>
                                            <?php elseif ($historiqueretenue->getIdDemandepret() != ""): ?>
                                                <?php echo $historiqueretenue->getDemandepret()->getAgents()->getNomComplet() . " " . $historiqueretenue->getDemandepret()->getAgents()->getPrenom(). "       ". $historiqueretenue->getDemandepret()->getAgents()->getIdrh() ; ?>
                                            <?php elseif ($historiqueretenue->getIdDemandeavance() != ""): ?>
                                                <?php echo $historiqueretenue->getDemandeavance()->getAgents()->getNomComplet() . " " . $historiqueretenue->getDemandeavance()->getAgents()->getPrenom() . "       ".$historiqueretenue->getDemandeavance()->getAgents()->getIdrh() ; ?>

                                            <?php endif; ?>
                                        </label>
                                    </td>
                                    <td style="width: 10%"><label>Mois:</label></td>
                                    <td class="disabledbutton" style="width: 20%">
                                        <select name="historiqueretenue[mois]" id="historiqueretenue_mois" class="chosen-select form-control" >
                                            <option <?php if ($form->getObject()->getMois() == 1): ?>selected="true"<?php endif; ?> value="1">Janvier</option>
                                            <option <?php if ($form->getObject()->getMois() == 2): ?>selected="true"<?php endif; ?> value="2">Février</option>
                                            <option <?php if ($form->getObject()->getMois() == 3): ?>selected="true"<?php endif; ?> value="3">Mars</option>
                                            <option  <?php if ($form->getObject()->getMois() == 4): ?>selected="true"<?php endif; ?> value="4">April</option>
                                            <option <?php if ($form->getObject()->getMois() == 5): ?>selected="true"<?php endif; ?> value="5">Mai</option>
                                            <option <?php if ($form->getObject()->getMois() == 6): ?>selected="true"<?php endif; ?>  value="6">juin</option>
                                            <option <?php if ($form->getObject()->getMois() == 7): ?>selected="true"<?php endif; ?>   value="7">Juillet</option>
                                            <option <?php if ($form->getObject()->getMois() == 8): ?>selected="true"<?php endif; ?>  value="8">Oaut</option>
                                            <option  <?php if ($form->getObject()->getMois() == 9): ?>selected="true"<?php endif; ?>  value="9">Septembre</option>
                                            <option <?php if ($form->getObject()->getMois() == 10): ?>selected="true"<?php endif; ?>  value="10">October</option>
                                            <option <?php if ($form->getObject()->getMois() == 11): ?>selected="true"<?php endif; ?>  value="11">Nouvembre</option>
                                            <option <?php if ($form->getObject()->getMois() == 12): ?>selected="true"<?php endif; ?>  value="12">Décembre</option>
                                        </select>
                                    </td>
                                    <td style="width: 10%"><label>Année:</label></td>
                                    <td class="disabledbutton" style="width: 20%">
                                        <select name="historiqueretenue[annee]" id="historiqueretenue_annee" class="chosen-select form-control">
                                            <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                                <option <?php if ($i == $historiqueretenue->getAnnee()) : ?>selected="true"<?php endif; ?>value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div ng-init="Afficherdetailpaiement('<?php echo $historiqueretenue->getId(); ?>', '<?php echo $historiqueretenue->getIdDemandeavance(); ?>', '<?php echo $historiqueretenue->getIdDemandepret(); ?>', '<?php echo $historiqueretenue->getIdRetenue(); ?>')">
                                <table>
                                    <thead>
                                        <tr style="background: #DCDCDC">
                                            <th style="width: 20% ;display: none"> Id </th>
                                            <th style="width: 20%"> Type  </th>
                                            <?php if ($historiqueretenue->getIdDemandepret() != ""): ?>
                                                <th style="width: 20%"> Source Pret  </th>
                                            <?php endif; ?>
                                            <th style="width: 10%">Montant Total </th>
                                            <th style="width: 10%">Nbr Mois</th>
                                            <th style="width: 10%">Montant Mensielle</th>
                                            <th style="width: 10%">Date Début Retenue</th>
                                            <th style="width: 10%">Date Fin Retenue</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="ligne_a_p_r in Liste">
                                            <td style="display: none">{{ligne_a_p_r.id}}</td>
                                            <td>{{ligne_a_p_r.typeavance}}</td>
                                            <?php if ($historiqueretenue->getIdDemandepret() != ""): ?>
                                                <td>{{ligne_a_p_r.sourcepret}}</td>
                                            <?php endif; ?>
                                                <td style="text-align: center">{{ligne_a_p_r.montanttotal}}</td>
                                            <td style="text-align: center">{{ligne_a_p_r.nbrmois}} Mois</td>
                                            <td style="text-align: center">{{ligne_a_p_r.montantmensielle}}</td>
                                            <td style="text-align: center">{{ligne_a_p_r.datedebut}}</td>
                                            <td style="text-align: center">{{ligne_a_p_r.datefin}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btn-circle" ng-click="DeleteLigne(ligne_a_p_r,'<?php echo $historiqueretenue->getId()?>')"><i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

        </div>
        <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
            <a href="<?php echo url_for('@historiqueretenue') ?>" class="btn btn-white btn-success">Retour à la liste</a>
<!--            <button type="button" class="btn btn-sm btn-success" ng-click="ModifierDemandepaiement(<?php // echo $historiqueretenue->getId(); ?>)">
                Enregistrer
                <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
            </button>-->

        </div>
    </div>
</div>

