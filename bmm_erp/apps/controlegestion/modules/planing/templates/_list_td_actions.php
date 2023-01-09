<td style="text-align: center;">
    <!--<div class="btn-toolbar">-->
        <!--<div class="btn-group" id="btnaction">-->
<!--            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>-->
<!--            <ul class="dropdown-menu" role="menu">
                <li>-->
                    <a style="width: 170px" target="_blanc" class="btn btn-xs btn-outline btn-warning width-fixed" href="<?php echo url_for('planing/imprimerConsultation?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Edition Consultation</a>
<!--                </li>
                <li>-->
                    <a style="width: 170px" target="_blanc" class="btn btn-xs btn-outline btn-success width-fixed" href="<?php echo url_for('planing/imprimerPlannigprevisionnel?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Panning Prévisionnel</a>
<!--                </li>
                <li>-->
                    <a style="width: 170px" target="_blanc" class="btn btn-xs btn-outline btn-primary width-fixed" href="<?php echo url_for('planing/showPlan?iddoc=' . $planing->getId()) ?>">
                        <i class="fa fa-eye"></i> Voir T.B Execut° P. Défi</a>
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    <!--</div>-->
</td>

<style>

    .width-fixed{
        min-width: 172px;
    }

</style>