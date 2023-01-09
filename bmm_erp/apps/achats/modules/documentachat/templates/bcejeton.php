                         <tr>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getNordre() ?>
                                    </p>
                                </td>
                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getDesignationarticle() ?>
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="qte_<?php echo $lignedoc->getId() ?>"                                              
                                               ng-value="<?php echo $qte ?>" 
                                               >
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht_<?php echo $lignedoc->getId() ?>" value="<?php echo $lignedoc->getMntht() ?>" class="align_right">
                                    </p>
                                </td>
                                <td>

                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" readonly="true" id="totalhTax_<?php echo $lignedoc->getId() ?>" value="<?php echo ($qte * $lignedoc->getMntht()) ?>" class="align_right">
                                    </p>
                                </td>
                                <td>
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="remise_<?php echo $lignedoc->getId() ?>"
                                               value="<?php echo $lignedoc->getMntremise(); ?>" class="align_right">
                                    </p>
                                </td>

                                <td>
                                    <input type="hidden" id="idtaufodec" value='0'>
                                    <select id="taufodec_<?php echo $lignedoc->getId() ?>">
                                        <?php foreach ($liste_tauxfodec as $tau): ?>
                                            <option <?php if ($tau->getId() == $lignedoc->getIdTauxfodec()) { ?>selected="true"<?php } ?>
                                                                                                               value="<?php echo $tau->getId() ?>">
                                                <?php echo $tau->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </td>

                                <td><input type="text" class="form-control" style="" id="fodec"
                                           value="<?php echo $lignedoc->getMntfodec(); ?>" readonly="true"></td>
                                <td><input type="text" class="form-control" style=""
                                           value="<?php echo $lignedoc->getMntthtva(); ?>" id="totalhtva" readonly="true"></td>

                                <td>
                                    <input type="hidden" id="idtva">
                                    <input type="hidden" value="" ng-model="tvacontrat.text" id="tvacontrat" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                    <select id="tva_<?php echo $lignedoc->getId() ?>">

                                        <?php foreach ($taux_tva as $tva): ?>
                                            <option
                                                <?php if ($tva->getId() == $lignedoc->getIdTva()) { ?>selected="true"<?php } ?>
                                                value="<?php echo $tva->getId() ?>" ><?php echo $tva->getLibelle() ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </td>

                                <td><input type="text" class="form-control" 
                                           value="<?php echo $lignedoc->getMntttc(); ?>" style="" id="totalttc" readonly="true"></td>

                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getObservation() ?>
                                    </p>
                                </td>

                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-xs" ng-click="MisAjour(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs" ng-click="Supprimer(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                                    </button>
                                </td>
                            </tr>