<fieldset ng-controller="CtrlFormation"  >
    <legend><i>Tableau de Bord de Formation (Liste des Formations)</i></legend>
    <table class="table table-bordered table-hover" style="width: 100%">
        <!--<input type="text" ng-model="test" id="test" >-->
        <?php
        $lg = new Ligneplaning();
        foreach ($listesdocuments as $lignedoc) {
            $lg = $lignedoc;
            ?>
            <?php if ($lg->getPlaning()->getElignible() == "1") { ?>
                <?php if ($lg->getValide() == "1") { ?>
                    <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                        <th style="widows: 1%">N°</th>
                        <th>Poste</th>
                        <th>Nom & Prénom</th>
                        <th>Organisme de Formation</th>
                        <th>Formateur</th>
                        <th colspan="2">Sous Rubrique</th>
                        <th colspan="2">Modalité de Calcul</th>
                    </tr>
                    <tr>
                        <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                        <td><?php echo $lg->getBesoinsdeformation()->getAgents()->getContrat()->getLast()->getPosterh()->getLibelle() ?></td>
                        <td><?php echo $lg->getBesoinsdeformation()->getAgents()->getNomcomplet() . " " . $lg->getBesoinsdeformation()->getAgents()->getPrenom() ?></td>
                        <td><?php echo $lg->getOrganisme()->getLibelle() ?></td>
                        <td><?php echo $lg->getFormateur()->getNom() . " " . $lg->getFormateur()->getPrenom() ?></td>
                        <td colspan="2"><?php echo $lg->getSousrubrique()->getLibelle() ?></td>
                        <td colspan="2">
                            <?php echo $lg->getSousrubrique()->getModalitedecalcul()->getLast()->getLibelle() ?>
                        </td>
                    </tr>

                    <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                        <th style="width: 5%">%Ristourne<br>Base Ristourne</th>

                        <th style="width: 8%"> M.T.HT </th>
                        <th style="width: 8%"> M.T.TTC </th>

                        <th style="width: 5%">Nbr Jours</th>
                        <th style="width: 5%">Nbr Heures </th>
                        <th style="width: 5%">M.Ristourne </th>
                        <th style="width: 8%">M.Supproté par la société </th>
                        <th style="width: 8%">TVA </th>
                        <th style="width: 8%">Action</th>
                    </tr>

                    <tr>
                        <td class="align_right">
                            <input type="text" id="ris_<?php echo $lg->getId(); ?>" value="<?php echo $lg->getSousrubrique()->getRistourne()->getLast()->getLibelle() ?>" class="disabledbutton">
                            <input type="text" id="base_<?php echo $lg->getId(); ?>" value="<?php echo $lg->getSousrubrique()->getBaserustourne()->getLast()->getLibelle() ?>" class="disabledbutton">
                        </td>
                        <td class="align_right">
                            <input  type="text" id="montantht_<?php echo $lg->getId(); ?>"  value=" <?php echo $lg->getMontantht() ?>" class="disabledbutton">
                        </td>
                        <td class="align_right"><?php echo $lg->getMontantttc() ?></td>
                        <td class="align_right"><input class="align_right" ng-model="nbrj"   id="nbrj_<?php echo $lg->getId(); ?>" type="text" placeholder="<?php echo $lg->getNbrjour() ?>" ng-change="Calculmontantristourne(<?php echo $lg->getId() ?>)" ></td> 
                        <td class="align_right"><input class="align_right" name="nbheure_<?php echo $lg->getId(); ?>" ng-model="nbheure_<?php echo $lg->getId(); ?>" id="nbheure_<?php echo $lg->getId(); ?>"  type="text" placeholder="<?php echo $lg->getNbrheure() ?>" ng-change="Calculmontantristourne(<?php echo $lg->getId() ?>)"></td>
                        <td class="align_right"><input class="disabledbutton" name="mristourne_<?php echo $lg->getId(); ?>"  id="mristourne_<?php echo $lg->getId(); ?>" type="text" value="<?php echo $lg->getMontantristourne() ?>"></td> 
                        <td class="align_right"><input class="disabledbutton" name="msociete_<?php echo $lg->getId(); ?>" id="msociete_<?php echo $lg->getId(); ?>" type="text" value="<?php echo $lg->getMontantsociete() ?>"></td>
                        <td class="align_right">
                            <!--<input id="mtva" type="text" placeholder=" TVA ">-->
                            <?php echo $lg->getMontantttc() - $lg->getMontantht() ?>
                        </td>
                        <td style="text-align: center">
                            <button type="button" id="btnvalidTab_<?php echo $lg->getId() ?>" class="btn btn-outline btn-success" ng-click="ValiderLigneTableua(<?php echo $lg->getId() ?>)">
                                valider
                            </button>
                        </td>
                    </tr>
                    <tr > <td colspan="9" style="background-color: #e5f3e5; height: 2px; min-height: 2px; padding: 5px;"></td></tr>
                <?php } ?>     
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</fieldset>
<!--<br><br><br>-->
<!--<fieldset>-->
    <!--    <div>
            <input type="text" id="montanttotal" placeholder="M.T.TTC" style="width: 90px">
        </div>-->
<!--</fieldset>-->

<style>

    input{max-width: 100px;}
    .align_right
    {
        text-align: right;
    }

</style>