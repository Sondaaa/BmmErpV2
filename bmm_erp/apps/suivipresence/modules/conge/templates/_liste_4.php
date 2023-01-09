<?php
$conge = Doctrine_Core::getTable('conge')->findOneByIdAgents($iddoc);
?>
<div class="table-header">
    <?php $type = TypecongeTable::getInstance()->find($id); ?>
    Type Congé : <?php echo $type->getLibelle(); ?>
</div>
<table class="table table-bordered table-hover" style="margin-bottom: 10px">
    <thead>
        <tr>
            <th>Année</th>
            <th>Date Début</th>
            <th>Date Fin  </th>
            <th>Droit <?php echo date("Y"); ?></th>
            <th >Congé Consommé</th>
            <th>Nbr.Jour.Congé </th>
            <th>Nbr.J.Congé<br>Prolongé</th>
            <th>Nbr Jour Restant</th>
            <th style="width: 15%">Type Congé</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($liste as $l): ?>
            <?php if ($l['idtype'] == '4'): ?>
                <tr id="standar" >
                    <td><?php echo $l['annee'] ?></td>
                    <td><?php echo $l['datedebut'] ?></td>
                    <td><?php echo $l['datefin'] ?></td>
                    <td>
                        <input type="text" value="<?php echo $l['nbjcongeannuelle'] ?>" style="text-align: center;width: 100px" readonly="true" id="congeanuelle">
                    </td>
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