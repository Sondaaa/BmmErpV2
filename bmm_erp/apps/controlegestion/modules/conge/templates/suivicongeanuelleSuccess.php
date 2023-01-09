<div id="sf_admin_container">
    <h1>Suivi Consommation Congé Annuelle</h1>
</div>
<fieldset ng-controller="CtrlPresence">
    <?php
    $conge = Doctrine_Core::getTable('conge')->findById($iddoc);
    ?>
    <table>
        <input type="hidden" value="<?php echo $iddoc ?>" id='id'>
        <tbody>
            <tr>
                <th>Matricule</th>
                <th>Nom & Prénom </th>
                <th>Droit <?php echo date("Y"); ?></th>
                <th>Report <?php echo date("Y") - 1; ?></th>
                <th>Solde Congé</th>
                <th>Nbr.<br>Congé</th>
                <th>D.Debut</th>
                <th>D.Fin</th>
                <th>Nbr Jou Restant</th>
            </tr>
            <tr>

                <td><input type="text" readonly="true" value="<?php// echo $conge->getAgents()->getidrh(); ?>"></td>
                <td><input type="text" readonly="true" value="<?php //echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                <td><input type="text" readonly="true"  value="<?php //echo $conge->getNbjcongeannuelle() ?>"></td>

                <?php
                $anne = date("Y") - 1;
                ?>

                <?php
//                $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
//                        . " from conge "
//                        . " where CAST(coalesce(conge.annee) AS integer)=" . $anne
//                        . " and conge.id_agents=" . $conge->getAgents()->getId()
//                        . "and conge.id_type=1"
                ;
//                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//                $liste = $conn->fetchAssoc($query);
                ?>
                <?php
                $i = 0;
//                $jouprecanne = 30 - $liste[$i]['nbrcongeralise'];
                $i++;
                ?> 
                <td  >  <input type="text" value="<?php echo $jouprecanne ?>" style="text-align: center;" readonly="true" id="jourparanneprecedant">
                </td> 
                <td><input type="text" value="<?php
                    $i = 0;
                    $total = 30 + $liste[$i]['nbrcongeralise'];
                    echo $total;
                    $i++;
                    ?>" readonly="true" id="totalconge"></td>
                <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                <td><input type="text" readonly="true" value="<?php // echo $conge->getDatedebutvalide() ?>"></td>
                <td><input type="text" readonly="true" value="<?php // echo $conge->getDatefinvalide() ?>"></td>
                <td> <input type="text" value="<?php // echo $total - $conge->getNbrjvalide() ?>" id="nbrjrestant" readonly="true"></td>

            </tr>
            <tr>


                <th>D.Debut.V</th>
                <th>D.Fin.V</th>
                <th>Nbr.V</th>
                <th>Valide</th>
                <th>Extension</th>
                <th>D.Debut</th>
                <th>D.Fin</th>
                <th>Nbr.Jour</th>
                <th>Action</th>
            </tr>
            <tr>
                <td> <input type="date" id='datedebutV'></td>
                <td>  <input type="date" id='datefinV'></td>
                <td>  <input type="text" id='nbrjv' placeholder="Nbr.Jour.V"></td>
                <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide"></td>
                <td style="text-align: center"><input type="checkbox" id="extension" name="check_extension"></td>

                <td><input type="date" id='datedebutextension' class="disabledbutton"></td>
                <td> <input type="date" id='datefinextension' class="disabledbutton"></td>
                <td>  <input type="text" id='nbrjex' placeholder="Nbr.Jour.E"></td>
                <td> <button type="button" class="btn btn-sm btn-success" ng-click="Valider()">
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>

                        Valider</button></td>
            </tr>
        </tbody>
    </table>
</fieldset>

