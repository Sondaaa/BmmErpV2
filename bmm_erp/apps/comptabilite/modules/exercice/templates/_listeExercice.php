<?php foreach ($exercices as $exercice): ?>
    <option value="<?php echo $exercice->getId() ?>" annee="<?php echo date('Y', strtotime($exercice->getDateDebut())) ?>"><?php echo $exercice->getLibelle() ?></option>
<?php endforeach; ?>