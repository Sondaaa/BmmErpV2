<script  type="text/javascript">

<?php foreach ($services as $service): ?>
        $("#ser_vice_<?php echo strtoupper(trim(preg_replace('/[^a-zA-Z0-9]/', '', html_entity_decode($service->getLibelle(), ENT_QUOTES)))); ?>").remove();
<?php endforeach; ?>

    $("#count_service").html('<hr style="margin-top: 10px; margin-bottom: 10px;">' + $('#verif_zone_service table tbody tr').length + ' Nouveau(x) Service(s).');

</script>