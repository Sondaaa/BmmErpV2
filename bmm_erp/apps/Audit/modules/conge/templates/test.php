<?php 
$conge = Doctrine_Core::getTable('conge')->findOneByIdAgents($iddoc);
?>
<table class="table table-bordered table-hover">
    <thead>

    <th>Année</th>
    <th>Date Debut</th>
    <th>Date Fin  </th>
    <th>Droit <?php echo date("Y"); ?></th>
    <?php if ($conge->getTypeconge()->getId() == 1): ?> 
        <th style="width: 10%">Report <?php echo date("Y") - 1; ?></th>
    <?php endif; ?>
    <th style="width: 10%">Congé Consommé</th>
    <th>Nbr.Jour.Congé </th>
    <th>Nbr.Jour.Conge.Prolongé</th>
    <th>Nbr Jou Restant</th>
    <th>Type Congé</th>
    <?php if (($conge->getTypeconge()->getId() == 2) || ($conge->getTypeconge()->getId() == 7)): ?> 
        <th>Traitement</th>
    <?php endif; ?>
</thead>
<?php foreach ($liste as $l): ?>

    <tbody>
        <tr id="standar"<?php if ($conge->getTypeconge()->getId() == 2): ?> <?php if ($restan < 60): ?>style="background: #ffcccc" <?php endif; ?><?php endif; ?> >
            <td><?php echo $l['annee'] ?></td>
            <td><?php echo $l['datedebut'] ?></td>
            <td><?php echo $l['datefin'] ?></td>
            <td><?php echo $l['nbjcongeannuelle'] ?></td>
            <?php
            $anne = date("Y") - 1;
            ?>
            <?php
            $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                    . ",conge.id_type as type"
                    . " from conge "
                    . " where CAST(coalesce(conge.annee) AS integer)=" . $anne
                    . " and conge.id_agents=" . $conge->getAgents()->getId()
                    . "and conge.id_type=1 "
                    . " group by conge.id_type "
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $liste = $conn->fetchAssoc($query);
            ?>
            <?php
            $i = 0;
            $jouprecanne = 30 - $liste[$i]['nbrcongeralise'];
            $i++;
            ?> 
            <?php // if ($liste[$i]['type'] == 1): ?> 
            <?php if ($conge->getTypeconge()->getId() == 1): ?> 
                <td>  <input type="text" value="<?php echo $jouprecanne ?>" style="text-align: center;" readonly="true" id="jourparanneprecedant">
                </td> 
            <?php // else : ?>
                <!--<td><input type="text" style="background: #ffcccc" value="****"></td>-->
            <?php endif; ?>
            <?php
            $anne3 = $conge->getAnnee();
            ;
            ?>

            <?php
            $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                    . " from conge "
                    . " where CAST(coalesce(conge.annee) AS integer)=" . $anne3
                    . " and conge.id_agents=" . $conge->getAgents()->getId()
                    . "and conge.id_type=1"
            ;
            $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
            $liste2 = $conn->fetchAssoc($query);
            ?>
            <?php
            $i = 0;
            $jouprix = $liste2[$i]['nbrcongeralise'];
            $i++;
            ?> 
            <td>
                <input type="text" value="<?php echo $jouprix; ?>" style="text-align: center;" readonly="true" id="congeprise">
            </td>
            <td><?php echo $l['nbrjourrealise'] ?></td>
            <td><?php echo $l['nbrjourprolonge'] ?></td>

            <td><?php
                if ($conge->getTypeconge()->getId() == 2) {
                    if ($l['nbrcongerestant'] > 60)
                        $restan = $l['nbrcongerestant'] - 60;
                }
                echo $l['nbrcongerestant'];
                ?></td>
            <td><?php echo $l['typeconge'] ?></td>

            <?php if ($conge->getTypeconge()->getId() == 2): ?> 

                <td>

                    <?php if ($l['nbrcongerestant'] > 60) : ?>
                        <?php echo "Traitement Complet"; ?>
                    </td> 
                <?php elseif ($l['nbrcongerestant'] - 60 != 0) : ?>

                <tr>
                    <td><?php echo $l['annee'] ?></td>
                    <td><?php echo $l['datedebut'] ?></td>
                    <td><?php echo $l['datefin'] ?></td>
                    <td><?php echo $l['nbjcongeannuelle'] ?></td>
                    <td><?php echo 60 - $restan; ?></td>
                    <td><?php echo $l['nbrjourprolonge'] ?></td>
                    <td><?php echo $l['nbrcongerestant']; ?></td>
                    <td><?php echo $l['typeconge'] ?></td>
                    <td> <?php echo "Demi Traitement "; ?></td>
                </tr>

                <tr>
                    <td><?php echo $l['annee'] ?></td>
                    <td><?php echo $l['datedebut'] ?></td>
                    <td><?php echo $l['datefin'] ?></td>
                    <td><?php echo $l['nbjcongeannuelle'] ?></td>
                    <td><?php echo $restan; ?></td>
                    <td><?php ?></td>

                    <td><?php ?></td>
                    <td><?php echo $l['typeconge'] ?></td>

                    <td> <?php echo "Traitement Complet"; ?></td>
                </tr>
            <?php elseif ($l['nbrcongerestant'] < 60): ?>
                <?php echo "Demi Traitement"; ?>
            <?php endif; ?>
         
        <?php endif; ?>
        <tr > <td colspan="9" style="background-color: #e5f3e5; height: 2px; min-height: 2px; padding: 5px;"></td></tr>

    <?php endforeach; ?>

    </tr>

</tbody>
</table>

<?php $flag = 0; ?>
//    <?php // foreach ($presences as $pr): ?>
//        <?php if ($flag == 0): ?>
//            <?php 
//            for ($somme = 1; $somme <= sizeof($presences); $somme++):
//                echo $pr->getSemaine();
//            endfor;
            ?>//
//        <?php else: ?>
//                                ,<?php
//            for ($somme = 1; $somme <= sizeof($presences); $somme++):
//                echo $pr->getSemaine();
//            endfor;
            ?>//
//        <?php endif; ?>
//        <?php $flag ++; ?>
//    <?php // endforeach; ?>
//                        ]
//                }]