<table class="table table-bordered table-hover">
    <?php foreach ($liste as $l): ?>
        <thead>

        <th>Année</th>
        <th>Matricule</th>
        <th>Nom & Prénom </th>
        <th>Type Congé </th>
        <th>Droit <?php echo date("Y"); ?></th>
        <th>Report <?php echo date("Y") - 1; ?></th>

        <th>Congé Réalisé</th>
    <!--  <th>D.Debut</th>
            <th>D.Fin</th>-->

        <th>Nbr Jour Restant</th>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;"><?php echo $l['annee'] ?></td>
            <td><?php echo $l['idrh'] ?></td>
            <td><?php echo $l['nom'] ?></td>
            <td><?php echo $l['type'] ?></td>
            <td style="text-align: center;"><?php echo $l['nbjcongeannuelle'] ?></td>
            <td style="text-align: center;"><?php echo $l['nbrrestantannepr'] ?></td>   

            <td style="text-align: center;"><?php echo $l['nbrcongeralise'] ?></td> 

            <td style="text-align: center;"><?php echo $l['nbrcongerestant'] ?></td>
        </tr>
        <tr><td colspan="9" style="background-color: #e5f3e5; height: 2px; min-height: 2px; padding: 5px;"></td></tr>
    </tbody>
<?php endforeach; ?>
</table>