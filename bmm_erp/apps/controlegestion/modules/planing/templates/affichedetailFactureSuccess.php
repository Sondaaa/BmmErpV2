
<?php
if ($ordonencement) {
    $numeroo = $ordonencement->getNumeroo();

    $dateop = $ordonencement->getDateoperation();
}
//certificat
else {
    $numeroo = 'vide';
}
if ($certificat) {
    $mnet = $certificat->getMontantordonnancenet();
    $retenue = $certificat->getMontantretenue();
} else {
    $mnet = "vide";
    $retenue = "vide";
}
?>
<script  type="text/javascript">

    $('#montantfacturenet_<?php echo $idligne ?>').val('<?php echo $mnet ?>');

    $('#montantfactureras_<?php echo $idligne ?>').val('<?php echo $retenue ?>');

    $('#numbce_<?php echo $idligne ?>').val('<?php echo $bce->getNumerodocachat() ?>');
    $('#numbci_<?php echo $idligne ?>').val('<?php echo $bci->getNumerodocachat() ?>');
    $('#nordenoncement_<?php echo $idligne ?>').val('<?php echo $numeroo ?>');
    $('#datepaieement_<?php echo $idligne ?>').val('<?php echo $dateop ?>');

</script>