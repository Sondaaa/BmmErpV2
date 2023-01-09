<div id="sf_admin_container">
    <h1 id="replacediv">Fiche Déclaration</h1>
</div>
<?php $entete = SocieteTable::getInstance()->find(1)->getRs(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="widget-box" >
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Informations sur la Société</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <h4 style="text-align: center; font-weight: bold;"><?php echo $entete ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="details_declaration">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête Déclaration</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <table style="margin-bottom: 12px;">
                        <tr>
                            <td style="width: 30%;">
                                <label>Libellé</label>
                                <input type="text" class="disabledbutton" value="<?php echo $declaration->getLibelle(); ?>">
                            </td>
                            <td style="width: 20%;">
                                <label>Date Début</label><br>
                                <input type="text" class="disabledbutton" value="<?php echo date('d/m/Y', strtotime($declaration->getDatedebut())) ?>">
                            </td>
                            <td style="width: 20%;">
                                <label>Date Fin</label><br>
                                <input type="text" class="disabledbutton" value="<?php echo date('d/m/Y', strtotime($declaration->getDatefin())) ?>">
                            </td>
                            <td style="width: 15%;">
                                <label>Montant Total</label>
                                <input type="text" id="declaration_montant" class="align_right disabledbutton" value="<?php echo number_format($declaration->getMontant(), 3, '.', ' ') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label>Compte Bancaire / CCP</label>
                                <input type="text" class="disabledbutton" value="<?php echo $declaration->getCaissesbanques(); ?>">
                            </td>
                            <td>
                                <label>Date Création</label><br>
                                <input type="text" class="disabledbutton" value="<?php echo date('d/m/Y', strtotime($declaration->getDatecreation())) ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="ligne_declaration">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ordonnances de Paiement</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="padding-bottom: 0px;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                <th style="width: 10%; text-align: center;">Ordonnance</th>
                                <th style="width: 10%; text-align: center;">date</th>
                                <th style="width: 10%; text-align: center;">Montant</th>
                                <th style="width: 25%; text-align: center;">Compte Bancaire / CCP</th>
                                <th style="width: 10%; text-align: center;">Ordonnance sujet R.S</th>
                                <th style="width: 10%; text-align: center;">Retenue à la Source</th>
                                <th style="width: 5%; text-align: center;">Taux R.S</th>
                                <th style="width: 20%; text-align: center;">Fournisseur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($declaration->getDocumentbudget() as $ordonnance): ?>
                                <?php
                                $ordonnance_parent = DocumentbudgetTable::getInstance()->find($ordonnance->getIdDocumentbudget());
                                $certificat = $ordonnance_parent->getCertificatretenue()->getFirst();
                                $budget_id = $ordonnance->getLigprotitrub()->getId();
                                $lignebanquecaisse = LignebanquecaisseTable::getInstance()->findByIdBudget($budget_id)->getFirst();
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $ordonnance->getNumero(); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($ordonnance->getDatecreation())); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($ordonnance->getMntnet(), 3, ".", " "); ?></td>
                                    <td>
                                        <?php
                                        if ($lignebanquecaisse != null)
                                            echo $lignebanquecaisse->getCaissesbanques();
                                        ?>
                                    </td>
                                    <td style="text-align: center;"><?php echo $ordonnance_parent->getNumero(); ?></td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($certificat->getDatecreation())); ?></td>
                                    <td style="text-align: center;"><?php echo $certificat->getRetenuesource()->getValeurretenue(); ?>%</td>
                                    <td><?php echo $certificat->getFournisseur(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix col-xs-5" style="font-size: 16px;">
            <span id="nombre_ordonnance" style="margin-left: 20px;"><?php echo $declaration->getDocumentbudget()->count() ?> </span> Ordonnance(s) de Paiement
        </div>

        <a class="btn btn-xs btn-primary" target="_blank" href="<?php echo url_for('declaration/imprimer?id=' . $declaration->getId()) ?>" style="float: right; margin-bottom: 12px; padding-top: 4px; padding-bottom: 4px; border-width: 4px;">
            <i class="ace-icon fa fa-print bigger-110"></i>
            Imprimer
        </a>
        <a class="btn btn-white btn-success" href="<?php echo url_for('declaration') ?>" style="float: right; margin-bottom: 12px; margin-right: 15px;">
            <i class="ace-icon fa fa-file-text bigger-110"></i>
            Retour à la liste
        </a>
    </div>
</div>