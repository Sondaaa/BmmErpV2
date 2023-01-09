<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_retenuesursalaire">
  <?php echo __('Retenue', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_demandepret">
  <?php echo __('Nature', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_demandeavance">
  <?php echo __('Type', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_mois">
  <?php if ('mois' == $sort[0]): ?>
    <?php echo link_to(__('Mois', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=mois&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Mois', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=mois&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_annee">
  <?php if ('annee' == $sort[0]): ?>
    <?php echo link_to(__('Année', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=annee&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Année', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=annee&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_montantsoustre">
  <?php if ('montantsoustre' == $sort[0]): ?>
    <?php echo link_to(__('Montant Mensuel', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=montantsoustre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Montant Mensuel', array(), 'messages'), '@historiqueretenue', array('query_string' => 'sort=montantsoustre&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>