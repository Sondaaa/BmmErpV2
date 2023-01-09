<?php foreach ($comptes as $compte): ?>
    <?php include_partial('dossier/ligne_base_standard', array('compte' => $compte)); ?>
<?php endforeach; ?>