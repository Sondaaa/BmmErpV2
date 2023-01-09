<div class="row" >
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Demande d'Avance </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">

                    <fieldset>
                        <table>
                            <tr>
                                <td>Type Avance</td>
                                <td>
                                    <?php echo $form['id_typeavance']->renderError() ?>
                                    <?php echo $form['id_typeavance'] ?>
                                </td>
                                <td>Remboursé sur</td>
                                <td class="disabledbutton">
                                    <input type="text" id='detailavance' placeholder="Remboursé sur" width="500px">
                                </td>
                                <td>Montant</td>
                                <td >
                                    <?php echo $form['montanttotal']->renderError() ?>
                                    <?php echo $form['montanttotal'] ?>
                                </td></tr><tr>
                                <td>Montant Mensuel</td>
                                <td class="disabledbutton">
                                    <?php echo $form['montantmensielle']->renderError() ?>
                                    <?php echo $form['montantmensielle'] ?>
                                </td><td>Mois</td>
                                <td>
                                    <select name="demandeavance[mois]" id="demandeavance_mois" >
                                        <option <?php if (date('m') == '1'): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                        <option <?php if (date('m') == '2'): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                        <option <?php if (date('m') == '3'): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                        <option <?php if (date('m') == '4'): ?>selected="true"<?php endif; ?> value="04">Avril</option>
                                        <option <?php if (date('m') == '5'): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                        <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">Juin</option>
                                        <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                                        <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                                        <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                                        <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                        <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                        <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                                    </select>
                                </td>
                                <td>Année</td>
                                <td>
                                    <select name="demandeavance[annee]" id="demandeavance_annee">
                                        <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                            <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Date Début de Retenue</td>
                                <td> 
                                    <?php echo $form['datedebutretenue']->renderError() ?>
                                    <?php echo $form['datedebutretenue'] ?>
                                </td>
                                <td>Date Fin de Retenue</td>
                               <td> 
                                    <?php echo $form['datefinretenue']->renderError() ?>
                                    <?php echo $form['datefinretenue'] ?>
                                </td>
                            </tr>

                        </table>
                    </fieldset>
                    <form>
                        <fieldset id="sf_fieldset_none">

                            <div class="col-lg-1"></div>
                            <div class="form-group" id="zone_choix_demandeur">
                                <div class="col-sm-12" id="zone_agent" >
                                    <legend class="control-label no-padding-top">Liste des Agents </legend>
                                    <?php $agents = AgentsTable::getInstance()->getAllCivileOrderByNomComplet(); ?>
                                    <select multiple="multiple" size="10" name="demandeavance[id_agent]" id="demandeavance_id_agent">
                                        <?php foreach ($agents as $a): ?>
                                            <option  value="<?php echo $a->getId(); ?>"><?php echo $a->getIdrh() . "    " . $a->getNomcomplet() . "  " . $a->getPrenom(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>
                            </div>

                            </div>
                        </fieldset>
                    </form>


                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@demandeavance') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button id="save_button" type="button" class="btn btn-sm btn-success" ng-click="AjouterDemandeAvance()">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>
                    <a id="print_button" style="display: none;" target="_blank" href="" type="button" class="btn btn-sm btn-primary">
                        Imprimer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>