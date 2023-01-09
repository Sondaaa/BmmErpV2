<td>
    <?php if ($typecaisse->getId() > 2): ?>
        <input type="checkbox" name="ids[]" value="<?php echo $typecaisse->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
    <?php endif; ?>
</td>
