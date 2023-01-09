<td class="sf_admin_text sf_admin_list_td_libelle" style="width: 40%">
    <?php echo $typeconge->getLibelle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbrjour" style="width: 10%">
    <?php echo $typeconge->getNbrjour() . " Jour" ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modalitecalcul" style="width: 45%">
    <?php echo $typeconge->getModalitecalcul() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_paye" style="width: 5%">
    <?php echo get_partial('typeconge/list_field_boolean', array('value' => $typeconge->getPaye())) ?>
</td>
