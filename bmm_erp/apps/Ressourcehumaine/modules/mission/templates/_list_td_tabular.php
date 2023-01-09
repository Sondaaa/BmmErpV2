<td class="sf_admin_text sf_admin_list_td_mission">
    <?php echo $mission->getMission() ?>
</td>
<?php if ($mission->getIdAgents() != ""): ?>
    <td class="sf_admin_text sf_admin_list_td_agents">
        <?php echo $mission->getAgents() ?>
    </td>
<?php else: ?>
    <td class="sf_admin_text sf_admin_list_td_ouvrier">
        <?php echo $mission->getOuvrier() ?>
    </td>

<?php endif; ?>
<td class="sf_admin_text sf_admin_list_td_lieutravail">
  <?php echo $mission->getLieutravail() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datesortie">
  <?php echo false !== strtotime($mission->getDatesortie()) ? format_date($mission->getDatesortie(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_duree">
  <?php echo $mission->getDuree(). " Jour " ?>
</td>