<select id="serie" onchange="getPieces()" style="width: 100%">
    <option value=""></option>
    <?php foreach ($series as $serie): ?>
        <option value="<?php echo $serie->getId() ?>"> <?php echo $serie->getPrefixe(); ?> </option>
    <?php endforeach; ?>
</select>

<script  type="text/javascript">
    $('#serie').chosen({allow_single_deselect: true});
</script>