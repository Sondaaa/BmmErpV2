<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_agents">
  <?php echo __('Agents', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_fournisseur">
  <?php echo __('Fournisseur', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_mois">
  <?php if ('mois' == $sort[0]): ?>
    <?php echo link_to(__('Mois', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=mois&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Mois', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=mois&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_annee">
  <?php if ('annee' == $sort[0]): ?>
    <?php echo link_to(__('Année', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=annee&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Année', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=annee&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_montantpret">
  <?php if ('montantpret' == $sort[0]): ?>
    <?php echo link_to(__('Montant Total', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=montantpret&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Montant Total', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=montantpret&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nbrmois">
  <?php if ('nbrmois' == $sort[0]): ?>
    <?php echo link_to(__('Nbre Mois', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=nbrmois&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nbre Mois', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=nbrmois&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_retenuesursalaire">
  <?php if ('retenuesursalaire' == $sort[0]): ?>
    <?php echo link_to(__('Montant Mensielle', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=retenuesursalaire&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Montant Mensielle', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=retenuesursalaire&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datedebut">
  <?php if ('datedebut' == $sort[0]): ?>
    <?php echo link_to(__('Date Début', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=datedebut&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Début', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=datedebut&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_datefin">
  <?php if ('datefin' == $sort[0]): ?>
    <?php echo link_to(__('Date Fin', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=datefin&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date Fin', array(), 'messages'), '@retenuesursalaire', array('query_string' => 'sort=datefin&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>