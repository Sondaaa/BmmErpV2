<?php if ($sf_user &&  $sf_user->getAttribute('exercice_id')): ?>
    <?php foreach ($exercice_anterieurs as $exercice_anterieur): ?>
        <option <?php if ($_SESSION['exercice_id'] == $exercice_anterieur->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $exercice_anterieur->getId() ?>"><?php echo $exercice_anterieur->getLibelle() ?></option>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($exercice_anterieurs as $exercice_anterieur): ?>
        <option value="<?php echo $exercice_anterieur->getId() ?>"><?php echo $exercice_anterieur->getLibelle() ?></option>
    <?php endforeach; ?>
<?php endif; ?>