<td class="sf_admin_text sf_admin_list_td_agents">
    <?php echo $presence->getAgents() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mois">
    <?php
    $array = array("01" => "Janvier",
        "02" => "Février", "03" => "Mars",
        "04" => "Avril", "05" => "Mai",
        "06" => "Juin", "07" => "Juillet",
        "08" => "Août", "09" => "Septembre",
        "10" => "Octobre", "11" => "Nouvembre",
        "12" => "Décembre");
    ?>
    <?php
    echo $array[trim($presence->getMois())];
    ?>
</td>
<td class="sf_admin_text sf_admin_list_td_annee">
    <?php echo $presence->getAnnee() ?>
</td>
