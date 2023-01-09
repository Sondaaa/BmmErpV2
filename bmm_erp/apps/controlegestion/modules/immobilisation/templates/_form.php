<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
      <?php include_partial('Immob/form', array('immobilisation' => $immobilisation, 'form' => $form)) ?>
  </form>
</div>