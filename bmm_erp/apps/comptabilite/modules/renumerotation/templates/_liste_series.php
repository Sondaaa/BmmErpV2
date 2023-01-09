<select id="serie" style="width: 100%" onchange="getPieces()">
    <option value=""></option>
    <?php foreach ($series as $serie): ?>
        <option value="<?php echo $serie->getId() ?>"><?php echo trim($serie->getPrefixe()); ?> (<?php echo $serie->getPiececomptable()->count(); ?> pièces)</option>
    <?php endforeach; ?>
</select>

<script  type="text/javascript">
    $('#serie').chosen({allow_single_deselect: true});
</script>