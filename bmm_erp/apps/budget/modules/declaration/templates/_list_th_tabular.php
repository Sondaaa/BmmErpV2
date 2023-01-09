<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datecreation" style="text-align: center;">
  <?php if ('datecreation' == $sort[0]): ?>
    <?php echo link_to(__('Date Création', array(), 'messages'), '@declaration', array('query_string' => 'sort=datecreation&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Création', array(), 'messages'), '@declaration', array('query_string' => 'sort=datecreation&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_libelle" style="text-align: center;">
  <?php if ('libelle' == $sort[0]): ?>
    <?php echo link_to(__('Libellé', array(), 'messages'), '@declaration', array('query_string' => 'sort=libelle&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Libellé', array(), 'messages'), '@declaration', array('query_string' => 'sort=libelle&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datedebut" style="text-align: center;">
  <?php if ('datedebut' == $sort[0]): ?>
    <?php echo link_to(__('Date Début', array(), 'messages'), '@declaration', array('query_string' => 'sort=datedebut&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Début', array(), 'messages'), '@declaration', array('query_string' => 'sort=datedebut&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datefin" style="text-align: center;">
  <?php if ('datefin' == $sort[0]): ?>
    <?php echo link_to(__('Date Fin', array(), 'messages'), '@declaration', array('query_string' => 'sort=datefin&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Fin', array(), 'messages'), '@declaration', array('query_string' => 'sort=datefin&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_montant" style="text-align: center;">
  <?php if ('montant' == $sort[0]): ?>
    <?php echo link_to(__('Montant', array(), 'messages'), '@declaration', array('query_string' => 'sort=montant&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Montant', array(), 'messages'), '@declaration', array('query_string' => 'sort=montant&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_caissesbanques">
  <?php echo __('Compte Bancaire / CCP', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_etat" style="text-align: center;">
  <?php if ('etat' == $sort[0]): ?>
    <?php echo link_to(__('Etat', array(), 'messages'), '@declaration', array('query_string' => 'sort=etat&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Etat', array(), 'messages'), '@declaration', array('query_string' => 'sort=etat&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>