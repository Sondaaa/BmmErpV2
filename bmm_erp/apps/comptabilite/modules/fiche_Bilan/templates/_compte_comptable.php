<option value="-1"></option>
<?php foreach ($comptes as $compte): ?>
<option <?php if($compte_id == $compte->getId()): ?> selected="selected" <?php endif; ?> value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumerocompte(); ?></option>
<?php endforeach; ?>