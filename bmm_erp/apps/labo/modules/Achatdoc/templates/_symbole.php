<a href="#my-symbol_" role="button" data-toggle="modal">
    Symbole
</a>
<div id="my-symbol_" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 25%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Liste des Symboles </h3>
            </div>
            <div class="modal-body">
                <?php
                $symbole = new Symbole();
                $symboles = Doctrine_Core::getTable('symbole')->findAll();
                foreach ($symboles as $s) {
                    $symbole = $s;
                    ?>
                    <label class="btn btn-sm btn-white btn-info" ng-click="AjoutSymbolecaracteristique('<?php echo $symbole->getCode() ?>')">
                        <i class="icon-only ace-icon fa "><?php echo $symbole->getCode() ?></i>
                    </label>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>