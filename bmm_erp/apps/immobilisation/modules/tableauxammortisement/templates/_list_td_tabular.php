<td class="sf_admin_text sf_admin_list_td_immobilisation">
    <?php echo $tableauxammortisement->getImmobilisation() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_dateaquisition1">
    <?php echo $tableauxammortisement->getDateaquisition1() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_vorigine">
    <?php echo $tableauxammortisement->getVorigine() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_taux">
    <?php echo $tableauxammortisement->getTaux() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_dotation1">
    <?php echo $tableauxammortisement->getDotation1() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_amrtinterieur1">
    <?php echo $tableauxammortisement->getAmrtinterieur1() ?>
    <div style="display: none" id="div_<?php echo $tableauxammortisement->getId(); ?>">
        <input type="hidden" id="idimmob_<?php echo $tableauxammortisement->getId(); ?>" value="<?php echo $tableauxammortisement->getIdImmobilisation(); ?>">
        <input type="text" id="amrtint_<?php echo $tableauxammortisement->getId(); ?>" class="form-control">
        <input style="margin-top: 5px; width: 100%;" type="button" ng-click="Renialisertable('<?php echo $tableauxammortisement->getId(); ?>')" value="Réinitialiser" class="form-control">
    </div>
</td>
<td class="sf_admin_text sf_admin_list_td_amrtcumile1">
    <?php echo $tableauxammortisement->getAmrtcumile1() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_vcn1">
    <?php echo $tableauxammortisement->getVcn1() ?>
</td>
