<div id="sf_admin_container">
    <h1>Planning (Liste des Formations)</h1>
</div>
<div id="sf_admin_content">  
    <div class="panel-body">
        <div class="tab-content">  
            <div id="plnning"><!--AfficheDetailAgents -->
                <fieldset ng-controller="CtrlFormation">
                    <table class="table table-bordered table-hover" style="width: 100%" id="table1">
                        <?php
                        $lg = new Ligneplaning();
                        foreach ($listesdocuments as $lignedoc) {
                            $lg = $lignedoc;
                            ?>
                            <?php if ($lg->getValide() == "1") { ?>
                                <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                    <th style="width: 1%">N°</th>
                                    <th style="width: 1%">Unité</th>
                                    <th style="width: 1%" colspan="2">Organisme (Fournisseur)</th>
                                    <th style="width: 1%">Formateur</th>
                                    <th style="width: 1%">Thème</th>
                                    <th style="width: 1%">Agents</th>
                                    <th style="width: 1%">Regroup.</th>
                                </tr>
                                <tr>
                                    <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                    <td>
                                        <?php if ($lg->getBesoinsdeformation()->getAgents()->getContrat()->getId() != ""): ?>    <?php echo $lg->getBesoinsdeformation()->getAgents()->getContrat()->getLast()->getPosterh()->getUnite()->getLibelle() ?><?php endif; ?>
                                    </td>
                                    <td colspan="2">
                                        <?php $mags = Doctrine_Core::getTable('fournisseur')->findAll(); ?>
                                        <select id="organisme_<?php echo $lg->getId() ?>">
                                            <option></option>
                                            <?php foreach ($mags as $magOrganisme) { ?>
                                                <option <?php if ($lg->getIdFournisseur() == $magOrganisme->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magOrganisme->getId() ?>"><?php echo $magOrganisme ?></option>
                                            <?php } ?>
                                        </select>
                                    </td> 
                                    <td id="form">  
                                        <?php $mags = Doctrine_Core::getTable('formateur')->findAll(); ?>
                                        <select id="formateur_<?php echo $lg->getId() ?>">
                                            <option></option>
                                            <?php foreach ($mags as $magformateur) { ?>
                                                <option <?php if ($lg->getIdFormateur() == $magformateur->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magformateur->getId() ?>"><?php echo $magformateur ?></option>
                                            <?php } ?>
                                        </select>
                                    </td> 
                                    <td><?php echo $lg->getTheme() ?></td>
                                    <td><?php echo $lg->getBesoinsdeformation()->getAgents()->getNomcomplet() ?></td>
                                    <td><?php echo $lg->getRegroupementtheme()->getLibelle() ?></td>
                                </tr>
                                <tr style="background: repeat-x #F2F2F2;background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                    <th style="width: 1%">Date Début Prévu</th>
                                    <th style="width: 1%">Date Fin Prévu</th>
                                    <th style="width: 1%" colspan="2">M.HT</th>
                                    <th style="width: 1%">TVA </th>
                                    <th style="width: 1%">M.TVA</th>
                                    <th style="width: 1%">M.TTC</th>
                                    <th style="width: 1%">Action</th>
                                </tr>
                                <tr>
                                    <td style="width: 1%"><input type="date" value="<?php echo $lg->getDatedebutprevu() ?>" id="input_datedprevu_<?php echo $lg->getId() ?>" class="form-control"></td>
                                    <td style="width: 1%"><input type="date" value="<?php echo $lg->getDatefinprevu() ?>" id="input_datefinprevu_<?php echo $lg->getId() ?>" class="form-control"></td>
                                    <td><?php echo "M.P.TTC : " . trim($lg->getMontant()) ?></td>
                                    <td>
                                        <!--<input type="text" style="width: 290px" placeholder="M.H.T" ng-model="input_montant_<?php // echo $lg->getId()                ?>" id="input_montant_<?php // echo $lg->getId()                ?>" ng-change="calculMotnatttC(<?php // echo $lg->getId()                ?>)">-->
                                        <input type="text" value="<?php echo trim($lg->getMontantht()) ?>" style="width: 290px" placeholder="M.H.T" id="input_montant_<?php echo $lg->getId() ?>" onkeyup="calculMotnatttC(<?php echo $lg->getId() ?>)">
                                    </td>
                                    <td>
                                        <?php $mags = Doctrine_Core::getTable('tva')->findAll(); ?>
                                        <select name="select_tva" id="tva_<?php echo $lg->getId() ?>" onchange="calculMotnatttC(<?php echo $lg->getId() ?>)">
                                            <?php foreach ($mags as $magTva) { ?>
                                                <option <?php if ($lg->getIdTva() == $magTva->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magTva->getId() ?>"><?php echo $magTva ?></option>
                                            <?php } ?>
                                        </select>
                                    </td> 
                                    <td style="width: 1%">
                                        <input name="ligne_montanttva" type="text" value="<?php echo trim($lg->getMtva()) ?>" id="input_montanttva_<?php echo $lg->getId() ?>" autocomplete="off" class="form-control " placeholder="M.TVA">
                                    </td>
                                    <td style="width: 1%">
                                        <input name="ligne_montant" type="text" value="<?php echo trim($lg->getMontantttc()) ?>" id="input_montantttc_<?php echo $lg->getId() ?>" autocomplete="off" class="form-control " placeholder="M.TTC">
                                    </td>
                                    <td style="width: 1%; text-align: center">
                                        <button style="text-align: center" type="button" id="btnvaliderealisation_<?php echo $lg->getId() ?>" class="btn btn-white btn-success" ng-click="ValiderLigneRealisation(<?php echo $lg->getId() ?>)">
                                            valider
                                        </button>
                                    </td>
                                </tr>
                                <tr><td colspan="8" style="background-color: #e5f0e5; height: 2px; min-height: 2px; padding: 5px;"></td></tr>
                            <?php } ?>     
                        <?php } ?>
                    </table>
                </fieldset>
                <br>
                <fieldset style="width: 100%; margin-bottom: 10px;">
                    <div class="col-md-3 pull-right" style="text-align: right;">
                <!--        <input type="text" value="M.P.TTC : <?php //echo $lg->getMontantttc();                                     ?>">-->
                        <input type="text" id="montanttotal" placeholder="M.T.TTC" class="align_center" readonly="true">
                    </div>
                </fieldset>
                <fieldset>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('planing/showdocument') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success pull-right">
                        <i class="fa fa-long-arrow-right bigger-110"></i>Réalisation</button>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script>

    calculM();
    function calculMotnatttC(id) {
        if ($('#input_montant_' + id).val() != "" && $('#tva_' + id).val() != "") {
            var mont = $('#input_montant_' + id).val();
            var tva = $('#tva_' + id + ' option:selected').text().replace("%", "");
            if (tva == '')
                tva = 0;
            var montanttc = 0;
            montanttc = parseFloat(parseFloat(mont) + (parseFloat(tva) * parseFloat(mont) / 100));
            $('#input_montantttc_' + id).val(parseFloat(montanttc).toFixed(3));
            var mtva = 0;
            mtva = parseFloat(parseFloat(tva) * parseFloat(mont) / 100);
            $('#input_montanttva_' + id).val(parseFloat(mtva).toFixed(3));
            if ($('#input_datefin_' + id).val() != "") {
                var mris = $('#mris_' + id).val();
                var monsociete = 0;
                monsociete = parseFloat(mont) - parseFloat(mris);
                $('#msoc_' + id).val(parseFloat(monsociete));
            }
        }
        calculM();
    }
    function  calculM() {
        var totalHTT = 0;
        $('[name="ligne_montant"]').each(function () {
            var ligne_montant = 0;
            if ($(this).val() != '')
                ligne_montant = parseFloat($(this).val());
            totalHTT = parseFloat(totalHTT) + parseFloat(ligne_montant);
        });
        $('#montanttotal').val(parseFloat(totalHTT).toFixed(3));
    }
</script>

<style>

    .chosen-container .chosen-container-single .chosen-container-active .chosen-with-drop {
        max-width : 100px !important;
    }

</style>