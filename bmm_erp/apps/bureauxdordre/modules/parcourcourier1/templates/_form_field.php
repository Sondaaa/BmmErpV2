
<?php if ($field->isPartial()): ?>
    <?php include_partial('parcourcourier/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('parcourcourier', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else:   ?>
    <div  class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>
        <div >
            <?php echo $form[$name]->renderLabel($label) ?>

            <div class="content" <?php if ($label == "Action") { ?> style="width: 93%" <?php } ?>>
                <?php if ($label == "Action") { ?>
                    <input type="button" value="+" style="margin-left: 90%;position: absolute;" class="btn btn-primary" data-toggle="modal" data-target="<?php
                    if ($label == "Action")
                        echo "#myModalmode";
                    ?>">

                <?php } ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
            </div>
            <?php if ($label == "Action") { ?>

                <div class="panel-body">
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="<?php
                    if ($label == "Action")
                        echo "myModalmode";
                   
                    ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        <?php
                                        if ($label == "Action")
                                            echo "Nouveaux Action";
                                        ?>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <?php if ($label == "Action") { ?>
                                        <div class="row">
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Action:</label>
                                                    <input ng-model="action.text" class="form-control">

                                                </div>
                                            </div>
                                            
                                             
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Remarque:</label>
                                                   
                                                    <textarea ng-model="remarque.text" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    <?php } ?>
                                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" ng-click="AjoutAction('<?php echo url_for('parcourcourier/AjoutAction') ?>')">Valider & Affecter</button>
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
