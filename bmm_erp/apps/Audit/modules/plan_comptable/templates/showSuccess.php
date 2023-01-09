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
<!--    <tr>
        <td style="width: 20%">
            <label class="mws-form-label" style="width: 100%">Nature du Solde :</label>
        </td>
        <td style="width: 60%">
            <label class="mws-form-label" style="width: 100%">Devise :</label>
        </td>
        <td style="width: 20%">
            <label class="mws-form-label" style="width: 100%">Lettrage :</label>
        </td>
    </tr>-->
<!--    <tr>
        <td>
            <div class="mws-form-row">
                <input type="text" readonly="readonly" value="<?php
//                switch ($compte->getTypeSolde()) {
//                    case '0':
//                        echo 'Débiteur';
//                        break;
//
//                    case '1':
//                        echo 'Créditeur';
//                        break;
//
//                    case '2':
//                        echo 'Soldé';
//                        break;
//
//                    case '3':
//                        echo 'Libre';
//                        break;
//
//                    default:
//                        echo 'Libre';
//                        break;
//                }
                ?>
                       ">
            </div>
        </td>
        <td>
            <input type="text" readonly="readonly" value="<?php // echo $compte->getDevise()->getLibelle(); ?>" style="text-align: left;">
        </td>
        <td>
            <input type="text" readonly="readonly" value="<?php
//            switch ($compte->getLettrage()) {
//                case '0':
//                    echo 'Libre';
//                    break;
//
//                case '1':
//                    echo 'Lettrable';
//                    break;
//
//                case '2':
//                    echo 'Rapprochable';
//                    break;
//
//                default:
//                    echo 'Libre';
//                    break;
//            }
            ?>
                   ">
        </td>
    </tr>-->
    <tr>
        <td colspan="3">
            <label style="width: 100%">Dossiers comptables : </label>
            <ul> 
                <?php foreach ($compte as $plan_dossier): ?>
                    <li>
                        <a href="<?php echo url_for('@showDossier?id=' . $plan_dossier->getDossiercomptable()->getId()); ?>" target="_blank"> <?php echo $plan_dossier->getDossiercomptable()->getCode() . ' - ' . $plan_dossier->getDossiercomptable()->getRaisonSociale(); ?></a>
                    </li>
                <?php endforeach; ?>
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