<option value="0"></option>
<?php foreach ($titre_budgets as $titre_budget): ?>
    <option value="<?php echo $titre_budget->getId(); ?>"><?php echo $titre_budget; ?></option>
<?php endforeach; ?>