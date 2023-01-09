<tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumerocompte(); ?>" data_class="<?php echo $compte->getIdClasse(); ?>">
    <td><b><?php echo $compte->getNumeroCompte(); ?></b>
        <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
    </td>
    <td><?php echo $compte->getLibelle(); ?></td>
    <td style="text-align: center" id="standard_<?php echo $compte->getId() ?>">
        <input type="checkbox" <?php if ($compte->getStandard()): ?>checked="true"<?php endif; ?> onchange="checkStandard('<?php echo $compte->getId() ?>', '<?php echo $compte->getStandard() ?>')" /> 
    </td>
    <td><?php echo $compte->getClassecompte()->getLibelle(); ?></td>
    <td>
        <?php if ($compte->getDate() != '' && $compte->getDate() != null): ?>
            <?php echo date('d/m/Y', strtotime($compte->getDate())); ?>
        <?php endif; ?>
    </td>
</tr>