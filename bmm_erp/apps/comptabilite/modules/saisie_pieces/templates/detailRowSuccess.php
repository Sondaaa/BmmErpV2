<tr class="detail-row">
    <td colspan="10">
        <?php $lignes = LignepiececomptableTable::getInstance()->getByPieceInOrderSaisie($piece->getId()); ?>
        <table style="width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
            <tr>
                <td colspan="2" style="vertical-align: middle; font-weight: bold;">Libellé : 
                    <?php echo $piece->getLibelle(); ?>
                </td>
                <td style="vertical-align: middle; font-weight: bold; width: 19%;">Solde : 
                    <?php
                    $solde = $piece->getTotaldebit() - $piece->getTotalcredit();
                    if ($solde > 0)
                        $nature_solde = 'Débiteur';
                    else if ($solde < 0)
                        $nature_solde = 'Créditeur';
                    else
                        $nature_solde = 'Soldé';
                    ?>
                    <span style="float: right; <?php if ($solde == 0): ?>color: #167416;<?php else: ?>color: #761c19;<?php endif; ?>"><?php echo number_format($solde, 3, '.', ' '); ?></span>
                </td>
                <td style="vertical-align: middle; font-weight: bold; width: 25%;">Nature Solde : 
                    <span style="float: right; <?php if ($solde == 0): ?>color: #167416;<?php else: ?>color: #761c19;<?php endif; ?>"><?php echo $nature_solde; ?></span>
                </td>
            </tr>
            <?php if ($lignes->count() != 0): ?>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold; width: 28%;">Date Création (de saisie) : 
                        <?php echo date('d/m/Y', strtotime($piece->getDatecreation())) ?>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 28%;">Type Pièce : 
                        <span style="color: #0069A2;"><?php echo $lignes[0]->getNaturepiece()->getLibelle(); ?></span>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold;">N° Externe : 
                        <?php echo $lignes[0]->getNumeroexterne(); ?>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold;">Référence : 
                        <?php echo $lignes[0]->getReference(); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>

        <?php if ($lignes->count() != 0): ?>
            <table style="width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 4%; text-align: center;">N°</th>
                        <th style="width: 30%;">Numéro du Compte</th>
                        <th style="width: 13%; text-align: center;">Débit</th>
                        <th style="width: 13%; text-align: center;">Crédit</th>
                        <th style="width: 15%;">Contre Partie</th>
                        <th style="width: 30%;">Libellé</th>
                        <th style="display: none;">Nature id</th>
                        <th style="display: none;">Type Pièce</th>
                        <th style="display: none;">N° Externe</th>
                        <th style="display: none;">Référence</th>
                        <th style="display: none;">document</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($lignes as $ligne): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $i + 1; ?></td>
                            <td style="text-align: justify;">
                                <div class="mws-form-row">
                                    <a style="cursor: pointer" href="<?php echo url_for('plan_comptable/extraitCompte?id=' . $ligne->getPlandossiercomptable()->getId()) ?>" target="_blank">
                                        <?php echo $ligne->getPlandossiercomptable()->getNumerocompte() . " : " . $ligne->getPlandossiercomptable()->getLibelle(); ?>
                                    </a>
                                </div>
                            </td>
                            <td style="text-align:right;"><?php if ($ligne->getMontantdebit() != 0): ?><?php echo number_format($ligne->getMontantdebit(), 3, '.', ' '); ?><?php endif; ?></td>
                            <td style="text-align:right;"><?php if ($ligne->getMontantcredit() != 0): ?><?php echo number_format($ligne->getMontantcredit(), 3, '.', ' '); ?><?php endif; ?></td>
                            <td>
                                <div class="mws-form-row">
                                    <?php if ($ligne->getIdContrepartie() != null): ?>
                                        <?php echo $ligne->getPlandossiercomptablecontre()->getNumerocompte(); ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="text-align: justify;"><?php echo $ligne->getLibelle(); ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2" style="text-align: center;"> Total </td>
                        <td style="text-align:right;"><?php echo number_format($piece->getTotaldebit(), 3, '.', ' ') ?></td>
                        <td style="text-align:right;"><?php echo number_format($piece->getTotalcredit(), 3, '.', ' ') ?></td>
                        <td><span style="float: right; <?php if ($solde == 0): ?>color: #167416;<?php else: ?>color: #761c19;<?php endif; ?>"><?php echo number_format($solde, 3, '.', ' '); ?></span></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </td>
</tr>