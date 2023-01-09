<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datecreation" style="width: 8%;">
  <?php if ('datecreation' == $sort[0]): ?>
    <?php echo link_to(__('Date de Création', array(), 'messages'), '@documentbudget_DocumentDef', array('query_string' => 'sort=datecreation&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date de Création', array(), 'messages'), '@documentbudget_DocumentDef', array('query_string' => 'sort=datecreation&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_numerodocachat">
  <?php echo __('Numéro doc. budget', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_documentachat">
  <?php echo __('Documents Achat', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_titrebudget">
  <?php echo __('Titre budget', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_rubriqueparent">
  <?php echo __('Rubrique', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_ligprotitrub">
  <?php echo __('Sous Rubrique', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_mnt">
  <?php if ('mnt' == $sort[0]): ?>
    <?php echo link_to(__('Montant d\'engagement ', array(), 'messages'), '@documentbudget_DocumentDef', array('query_string' => 'sort=mnt&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Montant d\'engagement ', array(), 'messages'), '@documentbudget_DocumentDef', array('query_string' => 'sort=mnt&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>