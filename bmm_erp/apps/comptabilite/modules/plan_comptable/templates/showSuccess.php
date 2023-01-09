<span class="titre_tiers_modal">Compte : <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle(); ?></span>

<table id="form_compte">
    <tr>
        <td>
            <label class="mws-form-label" style="width: 100%">Numéro du Compte :</label>
        </td>
        <td colspan="2">
            <label class="mws-form-label" style="width: 100%">Intitulé :</label>
        </td>
    </tr>
    <tr>
        <td>
            <input class="large" readonly="readonly" value="<?php echo $compte->getNumerocompte(); ?>" type="text">
        </td>
        <td colspan="2">
            <input class="large" readonly="readonly" type="text" value="<?php echo $compte->getLibelle(); ?>">
        </td>
    </tr>
    <tr>
        <td>
            <label class="mws-form-label" style="width: 100%">Date de Création :</label>
        </td>
        <td colspan="2">
            <label class="mws-form-label" style="width: 100%">Classe :</label>
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" readonly="readonly" value="<?php echo date('d/m/Y', strtotime($compte->getDate())); ?>">
        </td>
        <td colspan="2">
            <input type="text" readonly="readonly" value="<?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?>">

    </tr>
    <tr>
        <td colspan="3">
            <label style="width: 100%">Dossiers comptables : </label>
            <ul> 
                <?php // foreach ($compte as $plan_dossier): ?>
                    <li>
                        <a href="<?php echo url_for('@showDossier?id=' . $compte->getDossiercomptable()->getId()); ?>"
                         target="_blank">
                          <?php  echo $compte->getDossiercomptable()->getCode() . ' - ' . $compte->getDossiercomptable()->getRaisonSociale(); ?></a>
                    </li>
                <?php // endforeach; ?>
            </ul>
        </td>
    </tr>
</table>

<script  type="text/javascript">

    $('input:text').attr('style', 'width: 100%;');

</script>

<style>

    .titre_tiers_modal{font-size: 16px; color: #2679b5;}
    #form_compte{width: 90%; margin: 5% 5% 0% 5%;}
    #form_compte tbody tr td{padding: 5px;}
    .modal-dialog { width: 800px !important;}

</style>