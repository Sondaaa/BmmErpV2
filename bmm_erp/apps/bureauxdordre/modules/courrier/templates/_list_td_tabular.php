<td class="sf_admin_text sf_admin_list_td_numerocourrierstring">
    <?php echo $courrier->getNumerocourrierstring() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_famillecourrier">
    <?php echo $courrier->getFamillecourrier() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_datecreation">
    <?php echo false !== strtotime($courrier->getDatecreation()) ? date('d/m/Y', strtotime($courrier->getDatecreation())) : '&nbsp;' ?>
</td>

<td class="sf_admin_text sf_admin_list_td_titre"<?php if(preg_match($rtl_chars_pattern, trim($courrier->getTitre()))): ?> style="text-align: right;"<?php endif; ?>>
    <?php echo $courrier->getTitre() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_typecourrier">
    <?php echo $courrier->getTypecourrier() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_expediteursource">
    <?php if ($_REQUEST['idtype'] != 4): ?>
        <?php echo $courrier->getExpediteursource($sf_user->getAttribute('userB2m')) ?>
    <?php else: ?>
        <?php
        $q = Doctrine_Query::create()
                ->select("trim(ex.npresponsable) as name")
                ->from('Expdest ex')
                ->leftJoin("ex.Parcourcourier p")
                ->where('p.id_courier = ' . $courrier->getId());
        $tiers = $q->fetchArray();
        ?>
        <?php if (sizeof($tiers) > 0): ?>
    <ul class="list_destinateur">
                <?php for ($i = 0; $i < sizeof($tiers); $i++): ?>
                    <li><?php echo $tiers[$i]['name']; ?></li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_courriersource">
    <?php echo $courrier->getCourriersource() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_datemaxdereponse">
    <?php echo $courrier->getDatemaxdereponse($sf_user->getAttribute('userB2m')) ?>
</td>
