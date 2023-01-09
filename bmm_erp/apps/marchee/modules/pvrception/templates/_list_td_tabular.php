<td class="sf_admin_date sf_admin_list_td_datepvrecptionprovisoire">
    <?php echo false !== strtotime($pvrception->getDatepvrecptionprovisoire()) ? format_date($pvrception->getDatepvrecptionprovisoire(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typepv">
    <?php
    if ($pvrception->getTypepv() == 'pro')
        echo 'Provisoire';
    else if ($pvrception->getTypepv() == 'def')
        echo 'Définitif';
    ?>
</td>
