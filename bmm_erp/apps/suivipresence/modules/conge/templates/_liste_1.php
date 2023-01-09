<?php
$conge = Doctrine_Core::getTable('conge')->findOneByIdAgents($iddoc);
?>
<div class="table-header">
    <?php $type = TypecongeTable::getInstance()->find($id); ?>
    Type Congé : <?php echo $type->getLibelle(); ?>
</div>
<table class="table table-bordered table-hover" style="margin-bottom: 10px;width: 100%">
    <thead>
        <tr>
            <th>Année</th>
            <th>Date Début</th>
            <th>Date Fin  </th>
            <th>Droit <?php echo date("Y"); ?></th>
            <th >Report <?php echo date("Y") - 1; ?></th>
            <th >Congé Consommé</th>
            <th>Nbr.Jour.Congé </th>
            <th>Nbr.J.Congé<br>Prolongé</th>
            <th>Nbr Jour Restant</th>
            <th style="width: 15%">Type Congé</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($liste as $l): ?>
            <?php if ($l['idtype'] == '1'): ?>

                <tr id="standar" >
                    <td><?php echo $l['annee'] ?></td>
                    <td><?php echo $l['datedebut'] ?></td>
                    <td><?php echo $l['datefin'] ?></td>
                    <td>
                        <input type="text" value="<?php echo $l['nbjcongeannuelle'] ?>" style="text-align: center;width: 100px" readonly="true" id="congeanuelle">
                    </td>
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
                            . " group by conge.id_type ";
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $liste_annee_precedent = $conn->fetchAssoc($query);
                    ?>
                    <?php
                    if ($liste_annee_precedent != null) {
                        $i = 0;
                        $jouprecanne = 30 - $liste_annee_precedent[$i]['nbrcongeralise'];
                    } else {
                        $jouprecanne = 30;
                    }
                    ?> 
                    <td><input type="text" value="<?php echo $jouprecanne ?>" style="text-align: center;width: 100px" readonly="true" id="jourparanneprecedant" >
                    </td> 
                    <!--<td><input type="text" value="<?php // echo ($jouprecanne + $l['nbjcongeannuelle'])                              ?>" style="text-align: center;" readonly="true" id="total"></td>-->
                    <td><input type="text" value="<?php echo $l['congerealise']; ?>" style="text-align: center;width: 100px" readonly="true" id="congeprise">
                    </td>
                    <td><input type="text" value="<?php echo $l['nbrjourrealise'] ?>" style="text-align: center;width: 100px" readonly="true" id="relaise"></td>
                    <td><input type="text" value="<?php echo $l['nbrjourprolonge'] ?>" style="text-align: center;width: 100px" readonly="true" id="prolonge"></td>
                    <td><input type="text" value="<?php echo $l['nbrcongerestant']; ?>" style="text-align: center;width: 100px" readonly="true" id="restant"></td>
                    <td><input type="text" value="<?php echo $l['typeconge'] ?>" style="text-align: center;" readonly="true" id="type"></td>
                </tr>

            <?php endif; ?>  
        <?php endforeach; ?> 
    </tbody>
</table>