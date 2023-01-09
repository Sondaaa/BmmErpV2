<span class="titre_tiers_modal">Compte / Caisse : <?php echo $compte->getLibelle() ?></span>

<table id="form_tiers">
    <tr>
        <td style="width: 50%;">
            <label>Code :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getCodecb() ?>">
        </td>
        <td style="width: 50%;">
            <label>Référence :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getReferencecb() ?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Libellé :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getLibelle() ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Type :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getTypecaisse() ?>" />
        </td>
        <td>
            <label>Nature :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getNaturebanque() ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Rib :</label>
            <input disabled="true" type="text" value="<?php echo $compte->getRib() ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Compte comptable :</label>
            <input disabled="true" type="text" value="<?php echo trim($compte->getPlancomptable()->getNumerocompte()) . ' - ' . trim($compte->getPlancomptable()->getLibelle()); ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label>Observation :</label>
            <textarea disabled="true" id="observation"><?php echo $compte->getDescription() ?></textarea>
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