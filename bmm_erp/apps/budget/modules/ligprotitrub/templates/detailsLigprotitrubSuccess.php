<div id="sf_admin_container">
    <h1 id="replacediv">
        Rapport du Rubrique / Sous Rubrique : <?php echo $rubrique->getRubrique()->getLibelle(); ?> - Exercice <?php echo $_SESSION['exercice_budget'] ?>
    </h1>

    <div id="sf_admin_content">
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                    Détails Rubrique / Sous Rubrique : <?php echo $rubrique->getRubrique()->getLibelle(); ?>
                    <a target="_blank" href="<?php echo url_for('ligprotitrub/ImprimerDetailsRubrique?id=' . $rubrique->getId()) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                </div>
                <div>
                    <form>
                        <div class="sf_admin_list">
                            <table id="list_rubrique" class="table table-bordered table-hover" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 3%">#</th>
                                        <th style="width: 8%">N° Doc.Budget</th>
                                        <th style="width: 8%;">Date</th>
                                        <th style="width: 32%;">Fournisseur</th>
                                        <th style="width: 10%">Montant Eng. Provisoire</th>
                                        <th style="width: 10%;">Montant Eng. Définitif</th>
                                        <th style="width: 9%;">Ecart Engagement</th>
                                        <th style="width: 10%;">Ordonnance de Paiement</th>
                                        <th style="width: 10%;">Montant Payé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php
                                    $total_provisoire = 0;
                                    $total_engage = 0;
                                    $total_paye = 0;
                                    $total_ordonnance = 0;
                                    $document_budgets = $rubrique->getDocumentbudget();
                                    ?>
                                    <?php foreach ($document_budgets as $db): ?>
                                        <?php if ($db->getAnnule() == false || $db->getAnnule() == null): ?>
                                            <?php $piecejointbudget = $db->getPiecejointbudget()->getFirst(); ?>
                                            <?php
                                            if ($piecejointbudget) {
                                                if ($piecejointbudget->getIdDocachat())
                                                    $document_achat = $piecejointbudget->getDocumentachat();
                                            }
                                            ?>
                                            <?php
                                            if ($piecejointbudget) {
                                                if ($piecejointbudget->getIdDocachat()) {
                                                    $document_budget_provisoire = Doctrine_Core::getTable('documentbudget')
                                                                    ->createQuery('db')
                                                                    ->from('Documentbudget db')
                                                                    ->leftJoin('db.Piecejointbudget pjb')
                                                                    ->leftJoin('pjb.Documentachat da')
                                                                    ->leftJoin('da.Fournisseur frs')
                                                                    ->where('db.id_type=' . 3)
                                                                    ->where('db.annule=false')                                                                   
                                                                    ->andWhere('da.id = ' . $document_achat->getId())
                                                            
                                                                    ->execute()->getFirst();
                                                    $document_budget_engage = Doctrine_Core::getTable('documentbudget')
                                                                    ->createQuery('db')
                                                                    ->from('Documentbudget db')
                                                                    ->leftJoin('db.Piecejointbudget pjb')
                                                                    ->leftJoin('pjb.Documentachat da')
                                                                    ->where('db.id_type=' . 1)
                                                                    ->where('db.annule=false')
                                                                    ->andWhere('da.id = ' . $document_achat->getId())
                                                                    ->execute()->getFirst();
                                                }
                                            
                                            ?>
                                            <tr <?php if (!($document_budget_provisoire) && !($document_budget_engage)): ?>style="background-color: #ffdcdc"<?php endif; ?>>
                                                <?php
                                                $mnt_provisoire = 0;
                                                $mnt_engage = 0;
                                                if ($document_budget_provisoire)
                                                    $mnt_provisoire = $document_budget_provisoire->getMnt();
                                                if ($document_budget_engage)
                                                    $mnt_engage = $document_budget_engage->getMnt();
                                                $ecart = $mnt_provisoire - $mnt_engage;
                                                ?>
                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                <td style="text-align: center; color: #006ea6;"><?php echo $db->getNumero(); ?></td>
                                                <td style="text-align: center; color: #006ea6;"><?php echo date('d/m/Y', strtotime($db->getDatecreation())); ?></td>
                                                <td style="padding-left: 20px; color: #006ea6;"><?php
                                                    if ($piecejointbudget) {
                                                        if ($piecejointbudget->getIdDocachat())
                                                            echo $document_achat->getFournisseur();
                                                    }
                                                    ?></td>
                                                <td style="text-align: right;"><?php if ($db->getIdType() == 3 && $piecejointbudget) echo  number_format($mnt_provisoire, 3, '.', ' '); ?></td>
                                                <td style="text-align: right;"><?php if ($db->getIdType() == 1 && $piecejointbudget) echo number_format($mnt_engage, 3, '.', ' '); ?></td>
                                                <td style="text-align: right;"><?php if ($db->getIdType() != 2 ) echo number_format($ecart, 3, '.', ' '); ?></td>
                                                <td style="text-align: right;"><?php if ($db->getIdType() == 2 ) echo number_format($db->getMntnet(), 3, '.', ' '); ?></td>
                                                <td style="text-align: right;"></td>
                                            </tr>
                                            <?php
                                            if ($db->getIdType() == 3 && $piecejointbudget)
                                                $total_provisoire = $total_provisoire + $document_budget_provisoire->getMnt();
                                            if ($db->getIdType() == 1 && $piecejointbudget)
                                                $total_engage = $total_engage + $document_budget_engage->getMnt();
                                            if ($db->getIdType() == 2)
                                                $total_ordonnance = $total_ordonnance + $db->getMntnet();
                                            }  ?>
                                            <?php $i++; ?>

                                            <?php if ($db->getIdType() == 2): ?>
                                                <!--ajout des montants de paiement par banque-->
                                                <?php foreach ($db->getMouvementbanciare() as $mouvement): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                        <td style="text-align: center; color: #006ea6;"><?php echo $mouvement->getReford(); ?></td>
                                                        <td style="text-align: center; color: #006ea6;"><?php echo date('d/m/Y', strtotime($mouvement->getDateoperation())); ?></td>
                                                        <td style="padding-left: 20px; color: #006ea6;"><span style="color: #1da600;">*Compte B. :</span> <?php echo $mouvement->getCaissesbanques(); ?></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"><?php echo number_format($mouvement->getDebit() + $mouvement->getMntenoper() - $mouvement->getCredit(), 3, '.', ' '); ?></td>
                                                    </tr>
                                                    <?php $total_paye = $total_paye + $mouvement->getDebit() + $mouvement->getMntenoper() - $mouvement->getCredit(); ?>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>

                                                <!--ajout des montants de paiement par caisse-->
                                                <?php $ligne_caisses = LigneoperationcaisseTable::getInstance()->findByIdBudget($rubrique->getId()); ?>
                                                <?php foreach ($ligne_caisses as $ligne_caisse): ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                        <td style="text-align: center; color: #006ea6;"><?php echo $ligne_caisse->getNumeroo(); ?></td>
                                                        <td style="text-align: center; color: #006ea6;"><?php echo date('d/m/Y', strtotime($ligne_caisse->getDateoperation())); ?></td>
                                                        <td style="padding-left: 20px; color: #006ea6;"><span style="color: #a65d00;">*Caisse :</span> <?php echo $ligne_caisse->getCaissesbanques(); ?></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"><?php echo number_format($ligne_caisse->getMntoperation(), 3, '.', ' '); ?></td>
                                                    </tr>
                                                    <?php $total_paye = $total_paye + $ligne_caisse->getMntoperation(); ?>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php $total_ecart = $total_provisoire - $total_engage; ?>
                                    <tr style="background-color: #f5f5f5;">
                                        <td colspan="4" style="text-align: center;">Total</td>
                                        <td style="text-align: right;"><?php echo number_format($total_provisoire, 3, '.', ' '); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($total_engage, 3, '.', ' '); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($total_ecart, 3, '.', ' '); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($total_ordonnance, 3, '.', ' '); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($total_paye, 3, '.', ' '); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <span style="color: #1da600;">*Compte B. :</span> Paiement(s) effectué(s) à travers le compte bancaire.
                                <br>
                                <span style="color: #a65d00;">*Caisse :</span> Paiement(s) effectué(s) à travers la caisse.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>

            #list_rubrique > thead > tr > th{text-align: center;}

        </style>
    </div>
</div>

<script  type="text/javascript">
    document.title = ("BMM - Budget : Rapport du Rubrique - Sous Rubrique - Exercice <?php echo $_SESSION['exercice_budget'] ?>");
</script>