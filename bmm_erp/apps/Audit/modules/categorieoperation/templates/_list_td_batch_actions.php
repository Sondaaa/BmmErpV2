<td>
    <?php if ($categorieoperation->getId() > 2): ?>
        <input type="checkbox" name="ids[]" value="<?php echo $categorieoperation->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
    <?php endif; ?>
</td>
