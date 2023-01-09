<?php
$action_cree_ios_comm = "";
$action_c_reprise = "";
$action_c_arret = "";
if (count($OSCOMMTRAVAUX) > 0)
    $action_cree_ios_comm = "disabledbutton";
if (count($OSARRET) > 0 && count($OSARRET) > count($OSREPISE))
    $action_c_arret = "disabledbutton";
if (count($OSREPISE) > 0 && count($OSARRET) == count($OSREPISE))
    $action_c_reprise = "disabledbutton";
if (count($OSCOMMTRAVAUX) <= 0) {
    $action_c_reprise = "disabledbutton";
    $action_c_arret = "disabledbutton";
}
if (count($OSARRET) <= 0 && count($OSREPISE) <= 0)
    $action_c_reprise = "disabledbutton";
?>
<?php if ($type == "ios") { ?>
    <a href="<?php echo url_for('lots/remplirios?id=' . $idlot . '&post=creeiosc&idtype=1') ?>" class="btn <?php echo $action_cree_ios_comm ?> btn-white btn-default" style="margin: 1%; width: 100%;">Crée OS <br>Commencement du Travaux</a>
    <a href="<?php echo url_for('lots/remplirios?id=' . $idlot . '&post=creeiosc&idtype=4') ?>" class="btn <?php echo $action_c_arret ?> btn-white btn-danger" style="margin: 1%; width: 100%;">Crée OS Arrêt</a> 
    <a href="<?php echo url_for('lots/remplirios?id=' . $idlot . '&post=creeiosc&idtype=5') ?>" class="btn <?php echo $action_c_reprise ?> btn-white btn-success" style="margin: 1%; width: 100%;">Crée OS Reprise</a> 
    <a href="<?php echo url_for('lots/remplirios?id=' . $idlot . '&post=creeiosc&idtype=6') ?>" class="btn  btn-white btn-primary" style="margin: 1%; width: 100%;">Crée OS Divers</a> 
<?php } ?>
<?php if ($type == "date") { ?>
    <a href="<?php echo url_for('lots/rempliravenant?id=' . $idlot . '&post=creeavenanttypedate') ?>" class="btn <?php echo $action_cree_ios_comm ?> btn-white btn-default" style="margin: 1%; width: 100%;">Créer Avenant Type date</a> 
<?php } ?>
<?php if ($type == "type2") { ?>
    <a href="<?php echo url_for('lots/rempliravenanttype2?id=' . $idlot . '&post=creeavenanttype2') ?>" class="btn <?php echo $action_cree_ios_comm ?> btn-white btn-default" style="margin: 1%; width: 100%;">Créer Avenant<br>Type Sous Détail de prix</a> 
<?php } ?>
    <a target="_blank" href="<?php echo url_for('lots/ImprimerTableOs') . '?id=' . $idlot ?>" class="btn btn-white btn-warning" style="width: 100%; margin-top: 5px;">Imprimer & Exporter PDF</a>