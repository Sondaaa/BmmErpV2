<?php
$conge = Doctrine_Core::getTable('conge')->findOneById($iddoc);
?>
<div id="sf_admin_container">
    <h1>Suivi  <?php echo $conge->getTypeconge()->getLibelle() ?></h1>
</div>
<!-- Congé type1 Congé annuelle   -->
<?php if ($conge->getTypeconge()->getId() == 1): ?>
    <fieldset ng-controller="CtrlPresence">

        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype_1'>
            <tbody>
                <tr>
                    <th style="width: 10%">Matricule</th>
                    <th style="width: 10%">Nom & Prénom </th>
                    <th style="width: 10%">Droit <?php echo date("Y"); ?></th>
                    <th style="width: 10%">Report <?php echo date("Y") - 1; ?></th>
                    <th style="width: 10%">Congé consommé</th>
                    <th style="width: 5%">Total Congé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>
                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 10%">Solde Congé Restant</th>
                    <th>Valide</th>


                </tr>
                <tr>

                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td><input type="text" readonly="true" id="droit" value="<?php echo date("m") * 2.5; ?>"></td>

                    <?php
                    $anne = date("Y") - 1;
                    ?>

                    <?php
                    $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                            . " from conge "
                            . " where CAST(coalesce(conge.annee) AS integer)=" . $anne
                            . " and conge.id_agents=" . $conge->getAgents()->getId()
                            . "and conge.id_type=1"
                    ;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $liste = $conn->fetchAssoc($query);
                    ?>
                    <?php
                    $i = 0;
                    $jouprecanne = 30 - $liste[$i]['nbrcongeralise'];
                    $i++;
                    ?> 
                    <td>  <input type="text" value="<?php echo $jouprecanne ?>" style="text-align: center;" readonly="true" id="jourparanneprecedant">
                    </td> 

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
                    $jouprix = $liste2[$i]['nbrcongeralise'] - $conge->getNbrcongeralise();
                    $i++;
                    ?> 
                    <td>
                        <input type="text" value="<?php echo $jouprix; ?>" style="text-align: center;" readonly="true" id="congeprise">
                    </td>
                    <td>
                        <?php
                        $i = 0;
                        $jouprecanne = 30 - $liste[$i]['nbrcongeralise'];
                        $i++;
                        ?> 
                        <input type="text" value="<?php
                        $i = 0;
                        $total = date("m") * 2.5 + $jouprecanne - $jouprix;
                        echo $total;
                        $i++;
                        ?>" readonly="true" id="totalconge"></td>
                    <td><input type="text" value="<?php echo $conge->getNbrjvalide(); ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>
                    <td > <input type="text" value="<?php
//                    echo $conge->getNbrcongerestant()
                        echo $total - $conge->getNbrjvalide()
                        ?>" id="nbrjrestant" readonly="true"></td>
                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide" 
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>> </td>

                </tr>
                <tr>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V
                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés Prolongement</th>
                    <th colspan="2" style="text-align: center">Action</th>
                </tr>
                <tr>
                    <td> <input type="date" id='datedebutV' value="<?php echo $conge->getDaterealise() ?>"></td>
                    <td>  <input type="date" id='datefinV'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjv' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValide" readonly="true" placeholder="Nbr.j.Restant.Validé"
                                value="<?php // echo ( $conge->getNbjcongeannuelle() + $jouprecanne - $conge->getNbrcongeralise())       ?>" ></td>

                    <td style="text-align: center"><input type="checkbox" id="extension" name="check_extension"
                                                          <?php if ($conge->getExtension() == "true"): ?> checked="true" <?php endif; ?>></td>

                    <td><input type="date" id='datedebutextension' class="disabledbutton" value="<?php echo $conge->getDatedenutprologement() ?>"></td>
                    <td> <input type="date" id='datefinextension' class="disabledbutton" value="<?php echo $conge->getDatefinprolongement() ?>"></td>
                    <td>  <input type="text" id='nbrjex' readonly="true" value="<?php echo $conge->getNbrjourprolonge() ?>" ></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php // echo $conge->getNbrcongerestant();  ?>"></td>

                    <td colspan="2" style="text-align: center"> <button type="button" class="btn btn-sm btn-success" ng-click="Valider()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>

                            Valider</button></td>
                <tr><td colspan="6"></td><td  ><input type="text" value="Congé.T.Réalisé"></td>
                    <td colspan="2">
                        <input type="text" id="nbrcongetot" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>
<!-- Congé type 2 Maladie ordinaire -->
<?php if ($conge->getTypeconge()->getId() == 2): ?>
    <fieldset ng-controller="CtrlPresence">

        <?php
        $annee = $conge->getAnnee();
        $conge2 = Doctrine_Core::getTable('conge')->findOneByIdAndAnneeAndIdType($iddoc, $annee, 2);
        ?>
        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge_2'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype_2'>
            <tbody>
                <tr>
                    <th style="width: 5%">Matricule</th>
                    <th style="width: 10%" colspan="2">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 10%">Congé consommé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>

                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 5%">Solde Congé Restant</th>
                    <th>Valide</th>


                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td colspan="2"><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo ($conge2->getTypeconge()->getNbrjour()); ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td>     

                    <?php
                    $anne2 = $conge->getAnnee();
                    ?>

                    <?php
                    $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                            . " from conge "
                            . " where CAST(coalesce(conge.annee) AS integer)=" . $anne2
                            . " and conge.id_agents=" . $conge->getAgents()->getId()
                            . " and conge.id_type=2"
                    ;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $liste2 = $conn->fetchAssoc($query);
                    ?>
                    <?php
                    $i = 0;
                    $jouprix = $liste2[$i]['nbrcongeralise'] - $conge->getNbrcongeralise();
                    $i++;
                    ?> 
                    <td>
                        <input type="text" value="<?php echo $jouprix; ?>" id="nbrjourprise" readonly="true"></td>


                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                    <td > <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour() - $conge->getNbrjvalide() - $jouprix; ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide"
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>></td>

                </tr>
                <tr>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V
                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés Prolongement</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td> <input type="date" id='datedebutValidetype2' value="<?php echo $conge->getDaterealise() ?>"></td>

                    <td>  <input type="date" id='datefinValidetype2'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype2' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValidetyp2" readonly="true" placeholder="Nbr.j.Restant.Validé" ></td>
                    <td style="text-align: center"><input type="checkbox" id="extensiontype2" name="check_extension_2"
                                                          <?php if ($conge->getExtension() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td><input type="date" id='datedebutextension2' class="disabledbutton" value="<?php echo $conge->getDatedenutprologement() ?>"></td>
                    <td> <input type="date" id='datefinextension2' class="disabledbutton" value="<?php echo $conge->getDatefinprolongement() ?>"></td>
                    <td>  <input type="text" id='nbrjex2'  readonly="true" value="<?php echo $conge->getNbrjourprolonge() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension2" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php echo $conge->getNbrcongerestant(); ?>"></td>
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype2()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                            Valider</button></td>
                <tr><td colspan="6"></td><td ><input type="text" value="Congé.T.Réalisé"></td><td colspan="2">
                        <input type="text" id="nbrcongetot2" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>

<!-- Congé type 3 Congé Exeptionnel -->
<?php if ($conge->getTypeconge()->getId() == 3): ?>
    <fieldset ng-controller="CtrlPresence">

        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge_3'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype_3'>
            <tbody>
                <tr>
                    <th style="width: 10%">Matricule</th>
                    <th style="width: 10%" colspan="2">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 10%">Congé consommé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>

                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 10%">Solde Congé Restant</th>
                    <th>Valide</th>


                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td colspan="2"><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour(); ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td>  
                    <?php
                    $annetype3 = $conge->getAnnee();
                    ?>

                    <?php
                    $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                            . " from conge "
                            . " where CAST(coalesce(conge.annee) AS integer)=" . $annetype3
                            . " and conge.id_agents=" . $conge->getAgents()->getId()
                            . " and conge.id_type=3"
                    ;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $liste3 = $conn->fetchAssoc($query);
                    ?>
                    <?php
                    $i = 0;
                    $jouprix = $liste3[$i]['nbrcongeralise'] - $conge->getNbrcongeralise();
                    $i++;
                    ?> 
                    <td><input type="text" value="<?php echo $jouprix ?>" id="nbrjourprise" readonly="true"></td>
                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                    <td > <input type="text" value="<?php
                        echo $conge->getTypeconge()->getNbrjour() - $conge->getNbrjvalide()
                        ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide" 
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>></td>
                </tr>
                <tr>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V
                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés Prolongement</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td> <input type="date" id='datedebutValidetype3' value="<?php echo $conge->getDaterealise() ?>"></td>
                    <td>  <input type="date" id='datefinValidetype3'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype3' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValidetyp3" readonly="true" placeholder="Nbr.j.Restant.Validé" ></td>
                    <td style="text-align: center"><input type="checkbox" id="extensiontype3" name="check_extension"
                                                          <?php if ($conge->getExtension() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td><input type="date" id='datedebutextension3' class="disabledbutton" value="<?php echo $conge->getDatedenutprologement() ?>"></td>
                    <td> <input type="date" id='datefinextension3' class="disabledbutton" value="<?php echo $conge->getDatefinprolongement() ?>"></td>
                    <td>  <input type="text" id='nbrjex3'  readonly="true" value="<?php echo $conge->getNbrjourprolonge() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension3" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php echo $conge->getNbrcongerestant(); ?>"></td>
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype3()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>

                            Valider</button></td>
                <tr><td colspan="6"></td><td  ><input type="text" value="Congé.T.Réalisé"></td>
                    <td colspan="1">
                        <input type="text" id="nbrcongetot3" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>

<!-- Congé type 4 sans solde   -->
<?php if ($conge->getTypeconge()->getId() == 4): ?>

    <fieldset ng-controller="CtrlPresence">

        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge_2'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype'>
            <tbody>
                <tr>
                    <th style="width: 10%">Matricule</th>
                    <th style="width: 10%" colspan="2">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 10%">Congé consommé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>

                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 10%">Solde Congé Restant</th>
                    <th>Valide</th>


                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td colspan="2"><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour(); ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td> 
                    <?php
                    $annetype3 = $conge->getAnnee();
                    ?>

                    <?php
                    $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                            . " from conge "
                            . " where CAST(coalesce(conge.annee) AS integer)=" . $annetype3
                            . " and conge.id_agents=" . $conge->getAgents()->getId()
                            . " and conge.id_type=4"
                    ;
                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                    $liste3 = $conn->fetchAssoc($query);
                    ?>
                    <?php
                    $i = 0;
                    $jouprix = $liste3[$i]['nbrcongeralise'] - $conge->getNbrcongeralise();
                    $i++;
                    ?> 
                    <td><input type="text" value="<?php echo $jouprix ?>" id="nbrjourprise" readonly="true"></td>
                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                    <td > <input type="text" value="<?php
                        echo $conge->getTypeconge()->getNbrjour() - $conge->getNbrjvalide() - $jouprix
                        ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide"
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>></td>

                </tr>
                <tr>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V
                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés Prolongement</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td> <input type="date" id='datedebutValidetype2' value="<?php echo $conge->getDaterealise() ?>"></td>
                    <td>  <input type="date" id='datefinValidetype2'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype2' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValidetyp2" readonly="true" placeholder="Nbr.j.Restant.Validé" ></td>
                    <td style="text-align: center"><input type="checkbox" id="extensiontype2" name="check_extension"
                                                          <?php if ($conge->getExtension() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td><input type="date" id='datedebutextension2' class="disabledbutton" value="<?php echo $conge->getDatedenutprologement() ?>"></td>
                    <td> <input type="date" id='datefinextension2' class="disabledbutton" value="<?php echo $conge->getDatefinprolongement() ?>"></td>
                    <td>  <input type="text" id='nbrjex2' readonly="true" value="<?php echo $conge->getNbrjourprolonge() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension2" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php echo $conge->getNbrcongerestant(); ?>"></td>
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype2()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>

                            Valider</button></td>
                <tr><td colspan="6"></td><td  ><input type="text" value="Congé.T.Réalisé"></td>
                    <td colspan="1">
                        <input type="text" id="nbrcongetot2" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>
<!-- Congé type 5 Accouchement  -->
<?php if ($conge->getTypeconge()->getId() == 5): ?>

    <fieldset ng-controller="CtrlPresence">

        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge_2'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype'>
            <tbody>
                <tr>
                    <th style="width: 20%">Matricule</th>
                    <th style="width: 20%">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>

                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>



                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour(); ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td>              
                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                </tr>
                <tr>
                    <th style="width: 10%">Solde Congé Restant</th>
                    <th>Valide</th>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
    <!--                    <th>Nbr.J.Res.V-->
    <!--                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés<br> Prolongement</th>-->
                    <th>Action</th>
                </tr>
                <tr>
                    <td > <input type="text" value="<?php
                        echo $conge->getTypeconge()->getNbrjour() - $conge->getNbrjvalide()
                        ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide"
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td> <input type="date" id='datedebutValidetype5' value="<?php echo $conge->getDaterealise() ?>"></td>

                    <td>  <input type="date" id='datefinValidetype5'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype5' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
    <!--                    <td> <input type="text"  id="nbrjrestantValidetyp2" readonly="true" placeholder="Nbr.j.Restant.Validé"
                    <?php // if ($conge->getExtension() == "true"): ?> checked="true" <?php // endif; ?>></td>
                    <td style="text-align: center"><input type="checkbox" id="extensiontype2" name="check_extension"></td>
                    <td><input type="date" id='datedebutextension2' class="disabledbutton" value="<?php // echo $conge->getDatedenutprologement()    ?>"></td>
                    <td> <input type="date" id='datefinextension2' class="disabledbutton" value="<?php // echo $conge->getDatefinprolongement()    ?>"></td>
                    <td>  <input type="text" id='nbrjex2'  readonly="true" value="<?php // echo $conge->getNbrjourprolonge()    ?>"></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension2" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php // echo $conge->getNbrcongerestant();    ?>"></td>-->
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype5()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>

                            Valider</button></td>
                <tr><td colspan="3"></td><td  ><input type="text" value="Congé.T.Réalisé"></td>
                    <td colspan="1">
                        <input type="text" id="nbrcongetot2" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>
<!-- Congé type 6 repos allaitement   -->
<?php if ($conge->getTypeconge()->getId() == 6): ?>

    <fieldset ng-controller="CtrlPresence">

        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype'>
            <tbody>
                <tr>
                    <th style="width: 10%">Matricule</th>
                    <th style="width: 10%">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 5%">Nbr.J.<br>Congé</th>

                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 10%">Solde Congé Restant</th>
                    <th>Valide</th>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V

                    <th>Action</th>

                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getidrh(); ?>"></td>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour() * 365; ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td>              
                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                    <td > <input type="text" value="<?php
                        echo $conge->getTypeconge()->getNbrjour() * 365 - $conge->getNbrjvalide()
                        ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide" 
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td> <input type="date" id='datedebutValidetype6' value="<?php echo $conge->getDaterealise() ?>"></td>
                    <td>  <input type="date" id='datefinValidetype6'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype6' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValidetyp6" readonly="true" placeholder="Nbr.j.Restant.Validé"  value="<?php echo $conge->getNbrcongerestant() ?>"></td>
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype6()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                            Valider</button></td>
                </tr>

            </tbody>
        </table>
    </fieldset>
<?php endif; ?>

<!-- Congé type 7 Maladie langue durre -->
<?php if ($conge->getTypeconge()->getId() == 7): ?>
    <fieldset ng-controller="CtrlPresence">

        <?php
        $annee = $conge->getAnnee();
        $conge2 = Doctrine_Core::getTable('conge')->findOneByIdAndAnneeAndIdType($iddoc, $annee, 7);
        ?>
        <table class="table  table-bordered table-hover">
            <input type="hidden" value="<?php echo $iddoc ?>" id='id_conge_2'>
            <input type="hidden" value="<?php echo $conge->getTypeconge()->getId() ?>" id='idtype'>
            <tbody>
                <tr>
                    <th style="width: 5%">Matricule</th>
                    <th style="width: 10%" colspan="2">Nom & Prénom </th>
                    <th style="width: 5%">Droit Congé</th>
                    <th style="width: 10%">Congé consommé</th>
                    <th style="width: 5%">Nbr.J.Congé</th>
                    <th style="width: 10%">D.Début</th>
                    <th style="width: 10%">D.Fin</th>
                    <th style="width: 5%">Solde Congé Restant</th>
                    <th>Valide</th>


                </tr>
                <tr>
                    <td><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getIdrh(); ?>"></td>
                    <td colspan="2"><input type="text" readonly="true" value="<?php echo $conge->getAgents()->getNomcomplet() . "  " . $conge->getAgents()->getPrenom() ?>"></td>
                    <td>  <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour(); ?>" style="text-align: center;" readonly="true" id="jourparanne">
                    </td>     

                    <?php
                    $anne2 = $conge->getAnnee();
                    ?>

                    <?php
                    $query = " select SUM( CAST(coalesce(conge.nbrcongeralise) AS integer)) as nbrcongeralise"
                            . " from conge "
                            . " where CAST(coalesce(conge.annee) AS integer)=" . $anne2
                            . " and conge.id_agents=" . $conge->getAgents()->getId()
                            . " and conge.id_type=7"
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
                        <input type="text" value="<?php echo $jouprix; ?>" id="nbrjourprise" readonly="true"></td>


                    <td><input type="text" value="<?php echo $conge->getNbrjvalide() ?>" id="nbrjourdemande" readonly="true"></td>

                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatedebutvalide())) ?> "></td>
                    <td><input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($conge->getDatefinvalide())) ?>"></td>

                    <td > <input type="text" value="<?php echo $conge->getTypeconge()->getNbrjour() - $conge->getNbrjvalide() - $jouprix; ?>" id="nbrjrestant" readonly="true"></td>

                    <td style="text-align: center"><input type="checkbox" id="valide" name="check_valide" 
                                                          <?php if ($conge->getValide() == "true"): ?> checked="true" <?php endif; ?> ></td>

                </tr>
                <tr>
                    <th style="width: 15%">D.Début.V</th>
                    <th>D.Fin.V</th>
                    <th>Nbr.V</th>
                    <th>Nbr.J.Res.V
                    <th>Prolongat°</th>
                    <th>D.Début</th>
                    <th>D.Fin</th>
                    <th>Nbr.Jour Prolongé</th>
                    <th>Nb.J.R Aprés Prolongement</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td> <input type="date" id='datedebutValidetype2' value="<?php echo $conge->getDaterealise() ?>"></td>

                    <td>  <input type="date" id='datefinValidetype2'  value="<?php echo $conge->getDatefinrealise() ?>"></td>
                    <td>  <input type="text" id='nbrjvtype2' placeholder="Nbr.Jour.V" readonly="true" value="<?php echo $conge->getNbrjourrealise() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantValidetyp2" readonly="true" placeholder="Nbr.j.Restant.Validé" ></td>
                    <td style="text-align: center"><input type="checkbox" id="extensiontype2" name="check_extension"
                                                          <?php if ($conge->getExtension() == "true"): ?> checked="true" <?php endif; ?>></td>
                    <td><input type="date" id='datedebutextension2' class="disabledbutton" value="<?php echo $conge->getDatedenutprologement() ?>"></td>
                    <td> <input type="date" id='datefinextension2' class="disabledbutton" value="<?php echo $conge->getDatefinprolongement() ?>"></td>
                    <td>  <input type="text" id='nbrjex2'  readonly="true" value="<?php echo $conge->getNbrjourprolonge() ?>"></td>
                    <td> <input type="text"  id="nbrjrestantApresExtension2" readonly="true" placeholder="Nbr.J.Restant.Apres¨prolongatoin" value="<?php echo $conge->getNbrcongerestant(); ?>"></td>
                    <td> <button type="button" class="btn btn-sm btn-success" ng-click="Validertype2()">
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                            Valider</button></td>
                <tr><td colspan="6"></td><td  ><input type="text" value="Congé.T.Réalisé"></td>
                    <td colspan="1">
                        <input type="text" id="nbrcongetot2" placeholder="NbrTotal Congé réalisé " value='<?php echo $conge->getNbrcongeralise() ?>'>

                    </td> 
                </tr>
            </tbody>
        </table>
    </fieldset>
<?php endif; ?>