<?php if (count($pager) == 0): ?>
    <tr>
        <td style=" vertical-align: middle; text-align:center; font-weight: bold; font-size: 18px !important; height: 150px;" colspan="11">Liste des agents Vide</td>
    </tr>
<?php else: ?>
    <?php foreach ($pager->getResults() as $agents): ?>
        <tr id="tr_<?php echo $agents->getId(); ?>">
            <td style="text-align: center;">
                <?php if ($agents->getActive() != 'false' && $agents->getIdMotifabsence() == null): ?>
                    <a title="Modifier agent" style="cursor: pointer;" class="ui-pg-div ui-inline-edit" onclick="setAgent('<?php echo $agents->getId(); ?>')">
                        <i class="ace-icon fa fa-pencil bigger-130 blue"></i>
                    </a>
                    <?php
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $query = "SELECT agents.id, "
                            . " (SELECT COUNT(*) FROM visaachat WHERE visaachat.id_agent = agents.id) AS t_visa, "
                            . " (SELECT COUNT(*) FROM immobilisation WHERE immobilisation.id_agent = agents.id) AS t_immo, "
                            . " (SELECT COUNT(*) FROM demandederemboursement WHERE demandederemboursement.id_agents = agents.id) AS t_remb, "
                            . " (SELECT COUNT(*) FROM autoristation WHERE autoristation.id_agents = agents.id) AS t_remb, "
                            . " (SELECT COUNT(*) FROM conge WHERE conge.id_agents = agents.id) AS t_conge, "
                            . " (SELECT COUNT(*) FROM accidents WHERE accidents.id_agents = agents.id) AS t_acci, "
                            . " (SELECT COUNT(*) FROM recomposediscipline WHERE recomposediscipline.id_agents = agents.id) AS t_desc, "
                            . " (SELECT COUNT(*) FROM demandeur WHERE demandeur.id_agent = agents.id) AS t_dem, "
                            . " (SELECT COUNT(*) FROM demandedevoirfichieradmin WHERE demandedevoirfichieradmin.id_agents = agents.id) AS t_dva, "
                            . " (SELECT COUNT(*) FROM presence WHERE presence.id_agents = agents.id) AS t_pre "
                            . "FROM agents "
                            . "WHERE agents.id=" . $agents->getId();

                    $listevisadoc = $conn->fetchAssoc($query);
                    ?>
                    <?php if ($listevisadoc[0]['t_visa'] == 0 && $listevisadoc[0]['t_immo'] == 0 && $listevisadoc[0]['t_remb'] == 0 && $listevisadoc[0]['t_conge'] == 0 && $listevisadoc[0]['t_acci'] == 0 && $listevisadoc[0]['t_desc'] == 0 && $listevisadoc[0]['t_dem'] == 0 && $listevisadoc[0]['t_dva'] == 0 && $listevisadoc[0]['t_pre'] == 0): ?>
                        <a title="Supprimer agent" style="cursor: pointer; color: #b73333;" class="ui-pg-div ui-inline-edit" onclick="deleteAgent('<?php echo $agents->getId(); ?>')">
                            <i class="ace-icon fa fa-trash bigger-130 danger"></i>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td class="sf_admin_list_td_idrh" style="text-align: center;">
                <?php echo $agents->getIdrh() ?>
            </td>
            <td class="sf_admin_list_td_cin" style="text-align: center;">
                <?php echo $agents->getCin() ?>
            </td>
            <td class="sf_admin_list_td_nomcomplet">
                <?php echo $agents->getNomcomplet() ?>
            </td>
            <td class="sf_admin_list_td_prenom">
                <?php echo $agents->getPrenom() ?>
            </td>
            <td class="sf_admin_list_td_date_naissance" style="text-align: center;">
                <?php
                if ($agents->getDatenaissance() != null):
                    echo date('d/m/Y', strtotime($agents->getDatenaissance())) . " (" . $agents->getAge() . ")";
                endif;
                ?>
            </td>
            <td class="sf_admin_list_td_lieu_naissance" style="text-align: center;">
                <?php if ($agents->getLieun() != null) echo $agents->getGouvernera_10() ?>
            </td>
            <td class="sf_admin_list_td_sexe" style="text-align: center;">
                <?php echo $agents->getSexe() ?>
            </td>
            <td class="sf_admin_list_td_regroupementagents" style="text-align: center;">
                <?php echo $agents->getRegroupementagents() ?>
            </td>
            <td class="sf_admin_list_td_adresse" style="text-align: center;">
                <?php
                if ($agents->getAdresse() != null && trim($agents->getAdresse()) != ''): echo $agents->getAdresse() . ' / ';
                endif;
                ?><?php
                if ($agents->getIdGouvn() != null): echo $agents->getGouvernera();
                endif;
                ?>
            </td>
            <td class="sf_admin_list_td_situation" style="text-align: center;">
                <?php echo $agents->getEtatcivil()->getLibelle() ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>