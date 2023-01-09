<option value=""></option>
<?php foreach ($liste as $jurid): ?>
    <option value="<?php echo $jurid->getId() ?>"><?php echo $jurid->getLibelle() ?></option>
<?php endforeach; ?>