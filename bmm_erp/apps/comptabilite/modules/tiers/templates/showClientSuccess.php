<span class="titre_tiers_modal">Client : <?php echo $client->getRs() ?></span>

<table id="form_tiers">
    <tr>
        <td style="width: 50%;">
            <label>Référence :</label>
            <input disabled="true" type="text" value="<?php echo $client->getReference() ?>">
        </td>
        <td style="width: 50%;">
            <label>Nom & Prénom :</label>
            <input disabled="true" type="text" value="<?php echo $client->getNom(). ' ' . $client->getPrenom() ?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Raison Sociale:</label>
            <input disabled="true" type="text" value="<?php echo $client->getRs() ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Téléphone :</label>
            <input disabled="true" type="text" value="<?php echo $client->getTel() ?>" />
        </td>
        <td>
            <label>G.S.M:</label>
            <input disabled="true" type="text" value="<?php echo $client->getGsm() ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>E-mail:</label>
            <input disabled="true" type="text" value="<?php echo $client->getMail() ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Compte comptable :</label>
            <input disabled="true" type="text" value="<?php echo trim($client->getPlancomptable()->getNumerocompte()) . ' - ' . trim($client->getPlancomptable()->getLibelle()); ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Observation:</label>
            <textarea disabled="true" id="observation"><?php echo $client->getObservation() ?></textarea>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');
    $('textarea').attr('style', 'width: 100%;');

</script>

<style>

    .titre_tiers_modal{font-size: 16px; color: #2679b5;}
    #form_tiers{width: 90%; margin: 2% 5% 0% 5%;}
    #form_tiers tbody tr td{padding: 5px;}

</style>