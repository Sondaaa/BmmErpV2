<td>
    <?php if ($naturebanque->getId() > 2): ?>
        <input type="checkbox" name="ids[]" value="<?php echo $naturebanque->getPrimaryKey() ?>" class="sf_admin_batch_checkbox" />
    <?php endif; ?>
</td>
