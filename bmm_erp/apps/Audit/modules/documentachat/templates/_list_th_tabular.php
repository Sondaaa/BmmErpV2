<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_datecreationachat">
    <?php echo __('Date création', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_reference">
    <?php if ('reference' == $sort[0]): ?>
        <?php echo link_to(__('Référence', array(), 'messages'), '@documentachat', array('query_string' => 'sort=reference&sort_type=' . ($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
        <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/' . $sort[1] . '.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
        <?php echo link_to(__('Référence', array(), 'messages'), '@documentachat', array('query_string' => 'sort=reference&sort_type=asc')) ?>
    <?php endif; ?>
</th>
<?php end_slot(); ?>
<th>Numéro</th>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_agents">
    <?php echo __('Agents', array(), 'messages') ?>
</th>
<?php if ($idtype != 15): ?>
    <th>Numéro Doc. Suivant</th>
<?php else: ?>
    <th>Numéro Doc. Précédant</th>
<?php endif; ?>
<th>Imputation Budgétaire</th>
<th>Engagement</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>