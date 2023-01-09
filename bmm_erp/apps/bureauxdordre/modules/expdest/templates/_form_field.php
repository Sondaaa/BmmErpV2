<?php if ($field->isPartial()): ?>
    <?php include_partial('expdest/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('expdest', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>
        <div>
            <?php
            $nomlabel = $form[$name]->renderLabel($label);
            echo $nomlabel;
            ?>
            <div class="content"  <?php if ($label == "Annuaire" || $label == "Adresse") { ?> style="width: 93%" <?php } ?>>
                <?php if ($label == "Annuaire" || $label == "Adresse") { ?>
                    <input type="button" value="+" style="margin-left: 65%;position: absolute;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="<?php
                    if ($label == "Annuaire")
                        echo "#myModalan";
                    else
                        echo "#myModalad";
                    ?>">

                <?php } ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
            </div>
            <?php if ($label == "Annuaire" || $label == "Adresse") { ?>
                <div class="panel-body">
                    <!-- Modal -->
                    <div class="modal fade" id="<?php
                    if ($label == "Annuaire")
                        echo "myModalan";
                    else
                        echo "myModalad";
                    ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        <?php
                                        if ($label == "Annuaire")
                                            echo "Nouveaux Contact";
                                        else
                                            echo "Nouveaux Adresse";
                                        ?>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <?php if ($label == "Annuaire") { ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tél:</label>
                                                    <input ng-model="tel.text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Fax:</label>
                                                    <input ng-model="fax.text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Gsm:</label>
                                                    <input ng-model="gsm.text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mail:</label>
                                                    <input ng-model="mail.text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($label == "Adresse") { ?>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Adresse:</label>
                                                    <input ng-model="adr.text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Code Postal:</label>
                                                    <input ng-model="cp.text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Gouvernorat:</label>
                                                    <input ng-model="gouv.text" class="form-control" ng-change="Chargergouvernera()">
                                                    <div class="btn-group bootstrap-select form-control open" id="sltdesc" >
                                                        <div class="dropdown-menu open" >
                                                            <ul class="dropdown-menu inner">
                                                                <li ng-repeat="d in listesgouvs| filter : gouv.text" ng-mousedown="SelectedGouv(d.gouvernera)">
                                                                    {{d.gouvernera}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Pays:</label>
                                                    <input ng-model="pays.text" class="form-control" ng-change="ChargerPays()">
                                                    <div class="btn-group bootstrap-select form-control open" id="sltpays" >
                                                        <div class="dropdown-menu open" >
                                                            <ul class="dropdown-menu inner">
                                                                <li ng-repeat="d in listespays| filter : pays.text" ng-mousedown="SelectedPays(d.pays)">
                                                                    {{d.pays}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" ng-click="<?php if ($label == "Annuaire") { ?>AjoutContact('<?php echo url_for('expdest/Ajoutcontact') ?>')<?php } else { ?> AjoutAdresse('<?php echo url_for('expdest/Ajoutadresse') ?>')<?php } ?>">Valider & Affecter</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                <?php } ?>
                <?php if ($help): ?>
                    <div class="help"><?php echo __($help, array(), 'messages') ?></div>
                <?php elseif ($help = $form[$name]->renderHelp()): ?>
                    <div class="help"><?php echo $help ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>