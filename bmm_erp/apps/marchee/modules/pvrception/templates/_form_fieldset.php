<?php
$user = UtilisateurTable::getInstance()->findAll();
if ($pvrception) {
    if ($pvrception->getIdUser() != null && $pvrception->getIdUser() != '') {
        $ids_user = $pvrception->getIdUser();
        $list_usre = explode(';', $ids_user);

        $liste = json_encode($ids_user);
        if (sizeof($ids_user) >= 1) {
            $user_nn_affecter = UtilisateurTable::getInstance()->getByUsrNonaffecter($list_usre);
        }
    }
}
?>

<div class="tabbable">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#home">
                <i class="green ace-icon fa fa-user bigger-120"></i>
                Fiche P.V Réception
            </a>
        </li>
        <?php if (!$form->getObject()->isNew()) { ?>  <li >
                <input type="hidden" id="id" value="<?php echo $form->getObject()->getId() ?>">
                <a data-toggle="tab" href="#messages">
                    <i class="green ace-icon fa fa-money bigger-120"></i>
                    Scan 
                </a>
            </li>
            <li class=""><a href="#listespvreception" data-toggle="tab" aria-expanded="false">Liste P.V Réception</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">

            <div style="margin-bottom: 25px;">
                <table style="margin-bottom: 20px;width: 100%;">
                    <?php if ($form->getObject()->isNew()) { ?>     
                        <tr><input type="hidden" value="<?php echo $type; ?>" id="type">
                        <input type="hidden" value="<?php echo $id; ?>" id="id_lot">
                    <?php } ?>
                    <?php $lots = LotsTable::getInstance()->find($id); ?>
                    <tr>  <?php if ($form->getObject()->isNew()) { ?>     
                            <td colspan="2">Marché<input readonly="true" value="
                                                         <?php echo $lots->getMarches(); ?>" style="text-align: center"> </td>
                            <td colspan="2">Bénificiaire<input readonly="true" value="
                                                               <?php echo $lots->getFournisseur(); ?>"> </td></tr>
                        <?php } ?>
                        <?php if (!$form->getObject()->isNew()) { ?>    
                        <input type="hidden" value="<?php echo $pvrception->getTypepv(); ?>" id="type">
                        <input type="hidden" value="<?php echo $pvrception->getLots()->getId(); ?>" id="id_lot">
                        <td colspan="2">Marché<input readonly="true" value="
                                                     <?php echo $pvrception->getLots()->getMarches(); ?>" style="text-align: center"> </td>
                        <td colspan="2">Bénificiaire<input readonly="true" value="
                                                           <?php echo $pvrception->getLots()->getFournisseur(); ?>"> </td></tr>
                        <?php } ?>
                    <td><label>Date De Réception</label></td>
                    <?php // if ($type == 'pro') : ?>
                    <td>
                        <?php echo $form['datepvrecptionprovisoire']->renderError() ?>
                        <?php echo $form['datepvrecptionprovisoire'] ?>
                    </td>
                    <?php //elseif ($type == 'def') : ?>
<!--                        <td>
                        <input type="date" value="<?php ?>" id="lots_datepvrecptionprovisoire">
                        
                    </td>-->
                    <?php // endif; ?>
                    <td><label>Observations</label></td>
                    <td style="width: 30%">
                        <?php echo $form['observation']->renderError() ?>
                        <?php echo $form['observation'] ?>
                    </td>
                    </tr>
                    <tr><td colspan="2"><label>Réserves</label></td>
                        <td colspan="2">
                            <?php echo $form['reserve']->renderError() ?>
                            <?php echo $form['reserve'] ?>
                        </td></tr>
                    <tr>
                        <td colspan="6">
                    <legend> Commission de Réception</legend>
                    <div class="col-lg-12">
                        <select id="exp" multiple="multiple">
                            <option value="0"></option>

                            <?php
                            if ($form->getObject()->isNew()) :
                                foreach ($user as $a) :
                                    ?>
                                    <?php if (!in_array($a->getId(), array($pvrception->getIdUser()))) :
                                        ?>
                                        <option value="<?php echo $a->getId(); ?>" mode="0"><?php
                                            echo $a->getAgents();
                                            ;
                                            ?></option>
                                    <?php endif; ?>
                                    <?php
                                endforeach;
                            else :
                                ?>
                                <?php
                                if ($pvrception) {
                                    if ($pvrception->getIdUser() != null && $pvrception->getIdUser() != '') {
                                        $ids_user = $pvrception->getIdUser();
                                        $list_usre = explode(';', $ids_user);
                                        $liste = json_encode($ids_user);
                                        if (sizeof($ids_user) >= 1) {
                                            $user_affecter = UtilisateurTable::getInstance()->getByUsr($list_usre);
                                            $user_nn_affecter = UtilisateurTable::getInstance()->getByUsrNonaffecter($list_usre);
                                            foreach ($user_affecter as $a) :
                                                ?>
                                                <option value="<?php echo $a->getId(); ?>" mode="1" selected="selected">
                                                    <?php echo $a->getAgents(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <?php foreach ($user_nn_affecter as $a) : ?>
                                                <option value="<?php echo $a->getId(); ?>" mode="0">
                                                    <?php echo $a->getAgents(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <?php
                                        }
                                    } else {
                                        foreach ($user as $a) :
                                            ?>
                                            <?php if (!in_array($a->getId(), array($pvrception->getIdUser()))) :
                                                ?>
                                                <option value="<?php echo $a->getId(); ?>" mode="0"><?php
                                                    echo $a->getAgents();
                                                    ;
                                                    ?></option>
                                            <?php endif; ?>
                                            <?php
                                        endforeach;
                                    }
                                }
                            endif;
                            ?>

                        </select>
                    </div>
                    </td>
                    </tr>

                </table>
            </div>
        </div>
        <?php if (!$form->getObject()->isNew()) { ?>
            <div id="messages" class="tab-pane fade" >
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body" id="imgmodel" style="height: 650px">
                        <div id="dbscan" style="padding: 0%;">
                            <?php
                            include_partial('Scan/formscan', array('id' => $form->getObject()->getId(), 'pvrception' => $pvrception));
                            ?>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        <?php } ?>
        <?php if (!$form->getObject()->isNew()) { ?>
            <div class="tab-pane" style="height: 350px" id="listespvreception" ng-controller="CtrlTransfer" ng-init="AfficheDoc('<?php echo $pvrception->getIdLots(); ?>');">

                <div class="col-xs-12 col-lg-6" >
                    <table>
                        <thead>
                            <tr>
                                <th>Date P.V</th>
                                <th>Type</th>                                   
                                <th>Observation</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="pvrec in docPv">
                                <td>{{pvrec.date}}</td>
                                <td>{{pvrec.type}}</td>
                                <td>{{pvrec.observation}}</td> 
                                <td><a href="<?php echo url_for('pvrception/ImprimerFiche') . '?id=' ?>{{pvrec.id}}" class="btn btn-primary1" ng-model="BtnExporter" target="_blanc">Exporter PDF</a></td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>
        <?php } ?>

    </div>
</div>

