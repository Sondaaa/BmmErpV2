<option value="0"></option>
<?php foreach ($sous_rubriques as $sous_rubrique): ?>
    <option value="<?php echo $sous_rubrique->getId() ?>"><?php echo $sous_rubrique->getNordre() . ' : ' . $sous_rubrique->getRubrique()->getLibelle(); ?></option>
<?php endforeach; ?>