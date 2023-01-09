<option value=""></option>
<?php foreach ($activites as $activite): ?>
    <option value="<?php echo $activite->getId() ?>"><?php echo $activite->getLibelle() ?></option>
<?php endforeach; ?>
