<?php 
$mnt_reste=0;
if($form->getObject()->getMntRestant())
$mnt_reste=$form->getObject()->getMntRestant();
else
    $mnt_reste=$form->getObject()->getMntglobal();

?>
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Formulaire tranche </h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                <div class="col-md-6">
                        <label>Montant global</label>
                        <input  type="hidden" value="<?php echo $form->getObject()->getMntglobal()?>" id="mnt">
                        <input  type="text"  readonly class="form-control" value="<?php echo number_format($form->getObject()->getMntglobal(),3) ?>" >
                    </div>
                    <div class="col-md-6">
                        <label>Montant reste</label>
                        <input  type="hidden" value="<?php echo $mnt_reste?>" id="mntrestedestranches">
                        <input id="mnt_reste" type="text" readonly class="form-control" value="<?php echo number_format($mnt_reste,3)?>" >
                    </div>
                    <div class="col-md-6">
                        <label>Date overture</label>
                        <input  type="date" id="date_tran_1" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label>Libelle</label>
                        <input  type="text" id="libelle_tran_1" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label>Montant</label>
                        <input  type="text" id="mnt_tr_1" ng-model="mnt_tr_1" class="form-control" ng-change="CalculPourcentage(1)">
                    </div>
                    <div class="col-md-6">
                        <label>Montant en %</label>
                        <input  type="text" id="mnt_pour_ence_1" ng-model="mnt_pour_ence_1" class="form-control" ng-change="CalculMntParPourcentage(1)">
                    </div>
                </div>
               
                
            </div>
            <div class="modal-footer">
            <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left" onclick="Inialiserhamps()">
                        Initialiser</button>
                    <button type="button" value="Imprimer" id="bntimp" class="btn btn-sm pull-right" ng-click="ValiderTrancheBudget('<?php echo $form->getObject()->getId() ?>',1)">
                        Valider tranche</button>
                    <button id="btnfermer" class="btn btn-sm btn-success pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->