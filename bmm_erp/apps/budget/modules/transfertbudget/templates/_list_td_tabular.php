<td class="sf_admin_date sf_admin_list_td_datecreation">
    <?php echo false !== strtotime($transfertbudget->getDatecreation()) ? date('d/m/Y', strtotime($transfertbudget->getDatecreation())) : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typetransfert">
    <?php echo $transfertbudget->getTypetransfert() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_objectif">
    <?php echo $transfertbudget->getObjectif() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sourcedubudget">
    <?php echo $transfertbudget->getLigprotitrub_2()->getTitrebudjet()->getLibelle() . ' - ' . $transfertbudget->getSourcedubudget();?>
</td>
<td class="sf_admin_text sf_admin_list_td_sourcebudget">
    <?php echo $transfertbudget->getSourcebudget() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_destination">
    <?php echo $transfertbudget->getLigprotitrub()->getTitrebudjet()->getLibelle() . ' - ' . $transfertbudget->getDestination();?>
</td>
<td class="sf_admin_text sf_admin_list_td_mnttransfert">
    <?php echo number_format($transfertbudget->getMnttransfert(), 3, '.', ' '); ?>
</td>
