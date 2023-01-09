<table id="myTable01">
    <thead>
        <tr>
            <th style="width: 20;">Numéro</th>
            <th style="width: 60;">Intitulé du Compte Comptable</th>
            <th style="width: 20;">Classe</th>
      </tr>
    </thead>
    <tbody>
             <?php if (sizeof($comptes) == 0): ?>
            <tr>
                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="5">Liste des comptes comptables est vide</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($comptes as $compte): ?>
            <tr class="ligne_compte" 
                data_libelle="<?php echo trim($compte->getLibelle()); ?>" 
                data_number="<?php echo trim($compte->getNumerocompte()); ?>" 
                data_class="<?php echo $compte->getPlancomptable()->getIdClasse(); ?>">
                <td><?php echo $compte->getNumerocompte(); ?></td>
                <td><a style="cursor: pointer" href="<?php echo url_for('plan_comptable/extraitCompte?id=' . $compte->getId()) ?>" target="_blank" ><?php echo $compte->getLibelle(); ?></a></td>
                <td><?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script  type="text/javascript">


    $("table").addClass("table table-bordered table-hover");

</script>