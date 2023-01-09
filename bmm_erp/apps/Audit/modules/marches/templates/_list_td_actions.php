<td style="text-align: center;">
<!--    <ul class="sf_admin_td_actions">
        <?php // echo $helper->linkToEdit($marches, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    </ul>-->
    <a target="_blank" id="lots_print" type="button" class="btn btn-sm btn-white btn-success" href="<?php echo url_for('marches/ImprimerMarches') . '?id=' . $marches->getId() ?>">Imprimer</a>
</td>
