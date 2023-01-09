<div id="sf_admin_container">
    <h1>Mise à jour Fiche Demande D'Avance</h1>
</div>
<div class="row"  ng-controller="CtrlAffairesociale">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Fiche Demande D'Avance</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">
                    <form>
                        <fieldset id="sf_fieldset_none">

                            <div class="col-lg-1"></div>
                            <div class="form-group" id="zone_choix_demandeur">


                                <?php
                                $id = $demandeavance->getId();
                                $demandeavance = Doctrine_Core::getTable('demandeavance')->findOneById($id);
                                ?>
                                <input type="hidden" value="<?php echo $demandeavance->getId(); ?>" id="id_demande">
                                <fieldset class="col-lg-12">  
                                    <table class="table  table-bordered table-hover">
                                        <tr>
                                            <td><label>Agents:</label></td>
                                            <td><label>  <?php echo $demandeavance->getAgents()->getNomComplet(); ?></label></td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </div>
                        </fieldset>
                    </form>
                    <fieldset>
                        <table>
                            <tr>
                                <td>Type Avance</td>
                                <td>
                                    <?php echo $form['id_typeavance']->renderError() ?>
                                    <?php echo $form['id_typeavance'] ?>
                                </td><td>Remboursé sur</td>
                                <td>
                                    <input type="text" id='detailavance' placeholder="Remboursé sur" width="500px">
                                </td>
                                <td>Montant</td>
                                <td >
                                    <?php echo $form['montanttotal']->renderError() ?>
                                    <?php echo $form['montanttotal'] ?>
                                </td></tr><tr>
                                <td>Montant Mensielle</td>
                                <td>
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
                                        <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">juin</option>
                                        <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                                        <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                                        <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                                        <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                        <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                        <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                                    </select>
                                </td>
                                <td>Anée</td>
                                <td>
                                    <select name="demandeavance[annee]" id="demandeavance_annee">
                                        <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                            <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Date debut de Retenue</td>
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
                </div>
                <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                    <a href="<?php echo url_for('@demandeavance') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                    <button type="button" class="btn btn-sm btn-success" ng-click="ModifierDemande('<?php echo $demandeavance->getId(); ?>', '<?php echo $demandeavance->getAgents()->getId() ?>')">
                        Enregistrer
                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                    </button>

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