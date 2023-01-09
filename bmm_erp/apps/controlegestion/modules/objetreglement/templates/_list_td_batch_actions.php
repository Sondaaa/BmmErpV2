<td>
    <?php if ($objetreglement->getId() > 4): ?>
        <input type="checkbox" name="ids[]" value="<?php echo $objetreglement->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
    <?php endif; ?>
</td>
