<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_date sf_admin_list_th_daterecu">
  <?php if ('daterecu' == $sort[0]): ?>
    <?php echo link_to(__('Date reçu du carnet', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=daterecu&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Date reçu du carnet', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=daterecu&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_caissesbanques">
  <?php echo __('Banque / CCP', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_refdepart">
  <?php if ('refdepart' == $sort[0]): ?>
    <?php echo link_to(__('Référence 1èr chèque', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=refdepart&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Référence 1èr chèque', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=refdepart&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_reffin">
  <?php if ('reffin' == $sort[0]): ?>
    <?php echo link_to(__('Référence dernier chèque', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=reffin&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Référence dernier chèque', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=reffin&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_nbrepapier">
  <?php if ('nbrepapier' == $sort[0]): ?>
    <?php echo link_to(__('Nombre de chèques', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=nbrepapier&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Nombre de chèques', array(), 'messages'), '@carnetcheque', array('query_string' => 'sort=nbrepapier&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?>
<th>Chèques Disponibles</th>