<td style="text-align: center;">
    <a title="Modifier agent" style="cursor: pointer;" class="ui-pg-div ui-inline-edit" onclick="setAgent('<?php echo $agent->getId(); ?>')">
        <i class="ace-icon fa fa-pencil bigger-130 blue"></i>
    </a>
</td>
<td class="sf_admin_list_td_idrh" style="text-align: center;">
    <?php echo $agent->getIdrh() ?>
</td>
<td class="sf_admin_list_td_cin" style="text-align: center;">
    <?php echo $agent->getCin() ?>
</td>
<td class="sf_admin_list_td_nomcomplet">
    <?php echo $agent->getNomcomplet() ?>
</td>
<td class="sf_admin_list_td_prenom">
    <?php echo $agent->getPrenom() ?>
</td>
<td class="sf_admin_list_td_date_naissance" style="text-align: center;">
    <?php
    if ($agent->getDatenaissance() != null):
        echo date('d/m/Y', strtotime($agent->getDatenaissance())) . " (" . $agent->getAge() . ")";
    endif;
    ?>
</td>
<td class="sf_admin_list_td_lieu_naissance" style="text-align: center;">
    <?php if ($agent->getLieun() != null) echo $agent->getGouvernera_10() ?>
</td>
<td class="sf_admin_list_td_sexe" style="text-align: center;">
    <?php echo $agent->getSexe() ?>
</td>
<td class="sf_admin_list_td_regroupementagents" style="text-align: center;">
    <?php echo $agent->getRegroupementagents() ?>
</td>
<td class="sf_admin_list_td_adresse" style="text-align: center;">
    <?php
    if ($agent->getAdresse() != null && trim($agent->getAdresse()) != ''):
        echo $agent->getAdresse() . ' / ';
    endif;
    if ($agent->getIdGouvn() != null):
        echo $agent->getGouvernera();
    endif;
    ?>
</td>
<td class="sf_admin_list_td_situation" style="text-align: center;">
    <?php echo $agent->getEtatcivil()->getLibelle() ?>
</td>