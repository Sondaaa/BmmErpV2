<?php use_helper('I18N', 'Date') ?>
<?php include_partial('dossierexerciceutilisateur/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nouvelle Affectation Agent / Dossier & Exercice', array(), 'messages') ?></h1>

  <?php include_partial('dossierexerciceutilisateur/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('dossierexerciceutilisateur/form_header', array('dossierexerciceutilisateur' => $dossierexerciceutilisateur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('dossierexerciceutilisateur/form', array('dossierexerciceutilisateur' => $dossierexerciceutilisateur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('dossierexerciceutilisateur/form_footer', array('dossierexerciceutilisateur' => $dossierexerciceutilisateur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
