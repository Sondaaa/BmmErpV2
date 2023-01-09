<fieldset>
    <div class="row">
        <div class="col-xs-12" ng-controller="CtrlRessourcehumaine">
            <div class="widget-box">

                <div class="widget-body">
                    <div class="widget-main" style="min-height: 200px;">
                        <form>
                            <fieldset id="sf_fieldset_none">
                                <div class="col-lg-1"></div>
                                <div class="form-group" id="zone_choix_demandeur">
                                </div>
                                <div class="hr hr-16 hr-dotted"></div>
                            </fieldset>
                        </form>
                        <!--********************************************************-->
                        <fieldset>
                            <input id="id_regime" value="<?php echo $regimehoraire->getId(); ?>"type="hidden">

                            <fieldset id="grille_regime">
                                <?php include_partial('grille_regime',array('regimehoraire' => $regimehoraire)); ?>
                            </fieldset>
                        </fieldset>
                        <!--********************************************************-->

                    </div>
                    <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
                        <a href="<?php echo url_for('@regimehoraire') ?>" class="btn btn-white btn-success">Retour à la liste</a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="ModifierRegime('<?php echo $regimehoraire->getId(); ?>')">
                            Enregistrer
                            <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>