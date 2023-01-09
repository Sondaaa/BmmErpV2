<option value=""></option>
<?php foreach ($Secteuractivivte as $secteur_activite): ?>
    <option value="<?php echo $secteur_activite->getId() ?>"><?php echo $secteur_activite->getLibelle() ?></option>
<?php endforeach; ?>