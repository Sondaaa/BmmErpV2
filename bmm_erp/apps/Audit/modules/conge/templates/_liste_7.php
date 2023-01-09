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
            <th>Date Fin</th>
            <th>Droit <?php echo date("Y"); ?></th>
            <th >Congé Consommé</th>
            <th>Nbr Jour Congé </th>
            <th>Nbr.J.Congé<br>Prolongé</th>
            <th>Nbr Jour Restant</th>
            <th style="width: 15%">Type Congé</th>
            <th style="width: 15%">Traitement</th>
        </tr>
    </thead>
    <tbody>
        <?php $complet = 1095; ?>
        <?php foreach ($liste as $l): ?>
            <?php if ($l['idtype'] == '7'): ?>
                <?php if ($l['congerealise'] <= $complet): ?>
                    <tr>
                        <td><?php echo $l['annee'] ?></td>
                        <td><?php echo $l['datedebut'] ?></td>
                        <td><?php echo $l['datefin'] ?></td>
                        <td><input type="text" value="<?php echo $l['nbjcongeannuelle'] ?>" style="text-align: center;width: 100px" readonly="true" id="congeanuelle"></td>
                        <td><input type="text" value="<?php echo $l['congerealise']; ?>" style="text-align: center;width: 100px" readonly="true" id="congeprise"></td>
                        <td><input type="text" value="<?php echo $l['nbrjourrealise']; ?>" style="text-align: center;width: 100px" readonly="true" id="relaise"></td>
                        <td><input type="text" value="<?php echo $l['nbrjourprolonge'] ?>" style="text-align: center;width: 100px" readonly="true" id="prolonge"></td>
                        <td><input type="text" value="<?php echo $l['nbrcongerestant']; ?>" style="text-align: left;width: 100px" readonly="true" id="restant"></td>
                        <td><input type="text" value="<?php echo $l['typeconge'] ?>" style="text-align: center;" readonly="true" id="type"></td>
                        <td><input type="text" value="<?php echo "Traitement Complet"; ?>"readonly="true" ></td>
                    </tr>
                    <?php $complet = $complet - $l['congerealise']; ?>
                <?php else: ?>
                    <?php $congerealise = $l['congerealise'] - $complet; ?>
                    <?php $nbrjourrealise = $l['nbrjourrealise'] - $complet; ?>
                    <?php $date_fin_complet = date('Y-m-d', strtotime($l['datedebut'] . ' + ' . $complet . ' days')); ?>
                    <?php $backgound_color = "#FFF" ?>
                    <?php if ($complet != 0): ?>
                        <?php $backgound_color = "#E9F3FC" ?>
                        <tr style="background-color: <?php echo $backgound_color; ?>">
                            <td><?php echo $l['annee'] ?></td>
                            <td><?php echo $l['datedebut'] ?></td>
                            <td><?php echo $date_fin_complet ?></td>
                            <td><input type="text" value="<?php echo $l['nbjcongeannuelle'] ?>" style="text-align: center;width: 100px" readonly="true" id="congeanuelle"></td>
                            <td><input type="text" value="<?php echo $complet; ?>" style="text-align: center;width: 100px" readonly="true" id="congeprise"></td>
                            <td><input type="text" value="<?php echo $complet; ?>" style="text-align: center;width: 100px" readonly="true" id="relaise"></td>
                            <td><input type="text" value="0" style="text-align: center;width: 100px" readonly="true" id="prolonge"></td>
                            <td><input type="text" value="<?php echo $l['nbrcongerestant'] + $l['congerealise'] - $complet; ?>" style="text-align: left;width: 100px" readonly="true" id="restant"></td>
                            <td><input type="text" value="<?php echo $l['typeconge'] ?>" style="text-align: center;" readonly="true" id="type"></td>
                            <td><input type="text" value="<?php echo "Traitement Complet"; ?>"readonly="true" ></td>
                        </tr>
                        <?php $complet = 0; ?>
                    <?php endif; ?>

                    <tr style="background-color: <?php echo $backgound_color; ?>">
                         <?php $next_complet = $complet + 1; ?>
                        <?php $date_debut_demi_complet = date('Y-m-d', strtotime($date_fin_complet . ' + ' . $next_complet .  ' days')); ?>
                       
                        <td><?php echo $l['annee'] ?></td>
                        <td><?php echo $date_debut_demi_complet ?></td>
                        <td><?php echo $l['datefin'] ?></td>
                        <td><input type="text" value="<?php echo $l['nbjcongeannuelle'] ?>" style="text-align: center;width: 100px" readonly="true" id="congeanuelle"></td>
                        <td><input type="text" value="<?php echo $congerealise; ?>" style="text-align: center;width: 100px" readonly="true" id="congeprise"></td>
                        <td><input type="text" value="<?php echo $nbrjourrealise; ?>" style="text-align: center;width: 100px" readonly="true" id="relaise"></td>
                        <td><input type="text" value="<?php echo $l['nbrjourprolonge'] ?>" style="text-align: center;width: 100px" readonly="true" id="prolonge"></td>
                        <td><input type="text" value="<?php echo $l['nbrcongerestant']; ?>" style="text-align: center;width: 100px" readonly="true" id="restant"></td>
                        <td><input type="text" value="<?php echo $l['typeconge'] ?>" style="text-align: center;" readonly="true" id="type"></td>
                        <td><input type="text" value="<?php echo "Demi Traitement"; ?>"readonly="true" ></td>
                    </tr>

                <?php endif; ?>
            <?php endif; ?>

        <?php endforeach; ?>
    </tbody>
</table>