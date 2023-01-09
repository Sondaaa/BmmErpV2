<option value="-1"></option>
<?php foreach ($villes as $ville): ?>
    <option value="<?php echo $ville->getId() ?>"><?php echo $ville->getGouvernera() ?></option>
<?php endforeach; ?>