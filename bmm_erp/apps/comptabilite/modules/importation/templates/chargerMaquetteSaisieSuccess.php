<?php
if ($type_facture == 'achat') {
    $montant[1] = $facture->getTotalht() + $facture->getTimbre();
    $montant[2] = $facture->getTotaltva();
    $montant[3] = $facture->getTotalttc();
} else {
    $montant[1] = $facture->getTotalht();
    $montant[2] = $facture->getTotaltva();
    $montant[3] = $facture->getTimbre();
    $montant[4] = $facture->getTotalttc();
}
?>

<?php $i = 1; ?>
<?php foreach ($maquette->getLignemaquette() as $ligne): ?>
    <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>">
        <td>
            <?php if ($ligne->getTiers() == 1): ?>
                <?php if ($type_facture == "achat"): ?>
                    <?php if ($facture->getFournisseur()->getPlancomptable()): ?>
                        <?php $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($facture->getFournisseur()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst(); ?>
                        <input type="text" value="<?php echo $plan_dossier_comptable; ?>" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" readonly="true" onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
                        <input type="hidden" value="<?php echo $plan_dossier_comptable->getId(); ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                        <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                            <?php echo $plan_dossier_comptable; ?>
                        </div>
                    <?php else: ?>
                        <input type="text" value="" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')"/>
                        <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                        <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($facture->getClient()->getPlancomptable()): ?>
                        <?php $plan_dossier_comptable = PlandossiercomptableTable::getInstance()->findByIdPlanAndIdDossierAndIdExercice($facture->getClient()->getPlancomptable()->getId(), $_SESSION['dossier_id'], $_SESSION['exercice_id'])->getFirst(); ?>
                        <input type="text" value="<?php echo $plan_dossier_comptable; ?>" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" readonly="true" onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
                        <input type="hidden" value="<?php echo $plan_dossier_comptable->getId(); ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                        <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                            <?php echo $plan_dossier_comptable; ?>
                        </div>
                    <?php else: ?>
                        <input type="text" value="" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')"/>
                        <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                        <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if (trim($ligne->getSpecificationcompte()) == 'sans'): ?>
                    <input type="text" value="" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')"/>
                    <input type="hidden" value="" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                    <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                    </div>
                <?php else: ?>
                    <input type="text" value="<?php echo $ligne->getPlandossiercomptable(); ?>" name="ligne_compte" id="ligne_compte_<?php echo $i ?>" <?php if (trim($ligne->getSpecificationcompte()) == 'fixe'): ?>readonly="true"<?php endif; ?> onfocus="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_compte_<?php echo $i ?>', '#hidden_ligne_compte_<?php echo $i ?>', '#ligne_compte_libelle_<?php echo $i ?>')" onkeydown="moveToNext(event, 'ligne_compte', 1)"/>
                    <input type="hidden" value="<?php echo $ligne->getPlandossiercomptable()->getId(); ?>" name="hidden_ligne_compte" id="hidden_ligne_compte_<?php echo $i ?>" />
                    <div name="ligne_compte_libelle" id="ligne_compte_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                        <?php echo $ligne->getPlandossiercomptable(); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <td style="width: 12%;">
            <?php if (trim($ligne->getType()) == 'credit'): ?>
                <input type="text" style="width: 100%;" value="" name="ligne_debit" id="credit_<?php echo $i ?>" readonly="true"/>
            <?php else: ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'fixe'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_debit" id="debit_<?php echo $i ?>" value="<?php echo number_format($ligne->getMontant(), 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'copie'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_debit" id="debit_<?php echo $i ?>" value="<?php echo number_format($montant[$ligne->getNumerolignemontant()], 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'taux'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_debit" id="debit_<?php echo $i ?>" value="<?php echo number_format($montant[$ligne->getNumerolignemontant()] * $ligne->getTaux(), 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <td style="width: 15%;">
            <?php if (trim($ligne->getType()) == 'debit'): ?>
                <input type="text" style="width: 100%;" value="" name="ligne_credit" id="debit_<?php echo $i ?>" readonly="true"/>
            <?php else: ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'fixe'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_credit" id="credit_<?php echo $i ?>" value="<?php echo number_format($ligne->getMontant(), 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'copie'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_credit" id="credit_<?php echo $i ?>" value="<?php echo number_format($montant[$ligne->getNumerolignemontant()], 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
                <?php if (trim($ligne->getSpecificationmontant()) == 'taux'): ?>
                    <input class="align_right" style="width: 100%;" type="text" name="ligne_credit" id="credit_<?php echo $i ?>" value="<?php echo number_format($montant[$ligne->getNumerolignemontant()] * $ligne->getTaux(), 3, '.', ' ') ?>" readonly="true"/>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if (trim($ligne->getSpecificationcontre()) == 'sans'): ?>
                <input type="text" value="" name="ligne_contre" id="ligne_contre_<?php echo $i ?>" onfocus="chargerCompte('#ligne_contre_<?php echo $i ?>', '#hidden_ligne_contre_<?php echo $i ?>', '#ligne_contre_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_contre_<?php echo $i ?>', '#hidden_ligne_contre_<?php echo $i ?>', '#ligne_contre_libelle_<?php echo $i ?>')"/>
                <input type="hidden" value="" name="hidden_ligne_contre" id="hidden_ligne_contre_<?php echo $i ?>" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">

                </div>
            <?php else: ?>
                <input type="text" value="<?php echo $ligne->getPlandossiercomptable_3(); ?>" name="ligne_contre" id="ligne_contre_<?php echo $i ?>" <?php if (trim($ligne->getSpecificationcontre()) == 'fixe'): ?>readonly="true"<?php endif; ?> onfocus="chargerCompte('#ligne_contre_<?php echo $i ?>', '#hidden_ligne_contre_<?php echo $i ?>', '#ligne_contre_libelle_<?php echo $i ?>')" onkeyup="chargerCompte('#ligne_contre_<?php echo $i ?>', '#hidden_ligne_contre_<?php echo $i ?>', '#ligne_contre_libelle_<?php echo $i ?>')"/>
                <input type="hidden" value="<?php echo $ligne->getPlandossiercomptable_3()->getId(); ?>" name="hidden_ligne_contre" id="hidden_ligne_contre_<?php echo $i ?>" />
                <div name="ligne_contre_libelle" id="ligne_contre_libelle_<?php echo $i ?>" class="mws-form-row" style="text-align: justify; margin-left: 2%;">
                    <?php echo $ligne->getPlandossiercomptable_3(); ?>
                </div>
            <?php endif; ?>
        </td>
    </tr>
    <?php $i++; ?>
<?php endforeach; ?>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');

</script>