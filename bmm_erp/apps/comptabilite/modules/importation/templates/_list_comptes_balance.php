
<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 10%;">Numéro</th>
            <th style="width: 44%;">Intitulé du Compte Comptable</th>
            <th style="width: 7%; text-align: center;">Type Solde</th>
            <th style="width: 7%; text-align: center;">Solde</th>
            <th style="width: 19%;">Classe</th>
            <th style="width: 13%; text-align: center;">Opérations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comptes as $compte): ?>
            <tr class="ligne_compte" data_libelle="<?php echo trim($compte->getLibelle()); ?>" data_number="<?php echo trim($compte->getNumerocompte()); ?>" data_class="<?php echo $compte->getPlancomptable()->getIdClasse(); ?>">
                <td><?php echo $compte->getNumerocompte(); ?></td>
                <td><a style="cursor: pointer" href="<?php echo url_for('plan_comptable/extraitCompte?id=' . $compte->getId()) ?>" target="_blank" ><?php echo $compte->getLibelle(); ?></a></td>
                <td style="text-align: center" id="typesolde_<?php echo $compte->getId() ?>">
                    <?php if ($compte->getTypesolde() == 1): ?>
                        <?php echo 'Débit'; ?>
                    <?php elseif ($compte->getTypesolde() == 2): ?>
                        <?php echo 'Crédit'; ?>
                    <?php else: ?>
                        <?php echo ''; ?>
                    <?php endif; ?>
                </td>
                <td style="text-align: center" id="solde_<?php echo $compte->getId() ?>">                  
                    <?php 
echo abs($compte['solde']);
                    ?>
                </td>
                <td><?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?></td>
                <td style="text-align: center;">

                    <button value="Suprimer Solde du compte" type="button" class="btn btn-white btn-danger btn-sm" onclick="supprimer('<?php echo $compte->getId() ?>', '<?php echo $compte->getNumerocompte(); ?>')">
                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                    </button>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>