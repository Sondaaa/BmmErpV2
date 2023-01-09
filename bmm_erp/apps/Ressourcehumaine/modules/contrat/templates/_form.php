
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlRessourcehumaine">
  <?php echo form_tag_for($form, '@contrat') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php 
      $resu=null;
      if(isset($resultat))
          $resu=$resultat;
      
      include_partial('contrat/form_fieldset', array('contrat' => $contrat, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'resultat' => $resu,'id_regerouppement' => $id_regerouppement)) ?>
   
  <?php endforeach; ?>

    <?php  include_partial('contrat/form_actions', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'id_regerouppement' => $id_regerouppement)) ?>
  </form>
</div>
