

    <?php

$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
?>

<?php if ($user->getAcceesDroit("immobilisation.php/immobilisation/new")) { ?>
<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<?php } ?>