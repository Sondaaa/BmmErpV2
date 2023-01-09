
<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 10%;">Numéro</th>
            <th style="width: 40%;">Intitulé du Compte Comptable</th>
            <th style="width: 10%; text-align: center;">Type Solde</th>
            <th style="width: 15%; text-align: center;">Solde</th>
            <th style="width: 25%;">Classe</th>

        </tr>
    </thead>
    <tbody>
        <?php if (sizeof($comptes) == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="5">Liste des comptes comptables avec solde ouvertures est vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($comptes as $compte): ?>
            <tr class="ligne_compte" data_libelle="<?php echo trim($compte->getLibelle()); ?>" data_number="<?php echo trim($compte->getNumerocompte()); ?>" data_class="<?php if($compte->getPlancomptable()):echo $compte->getPlancomptable()->getIdClasse(); endif; ?>">
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
                    if ($compte->getSolde() != 0):
                        echo number_format($compte->getSolde(), 3, '.', '');
                    endif;
                    ?>
                </td  >
                <td><?php if($compte->getPlancomptable()):echo $compte->getPlancomptable()->getClassecompte()->getLibelle();endif; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script  type="text/javascript">

    $("table").addClass("table table-bordered table-hover");

</script>