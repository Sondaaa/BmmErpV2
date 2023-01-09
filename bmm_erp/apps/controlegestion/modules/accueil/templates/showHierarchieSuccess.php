<?php $societe = SocieteTable::getInstance()->find(1); ?>

<div id="sf_admin_container">
    <h1>Hiérarchies : <?php echo $societe; ?></h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
            <?php if ($_SESSION['statistique'] == 1): ?>
            <div class="col-sm-9">
                <div class="widget-box widget-color-green2">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            Hiérarchie Structurelle :
                            <span class="smaller-80"> <?php echo $societe; ?></span>
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <i class="icon-folder red ace-icon fa fa-folder"></i> Direction / 
                            <i class="icon-folder orange ace-icon fa fa-folder"></i> Sous Direction / 
                            <i class="icon-folder blue ace-icon fa fa-folder"></i> Service / 
                            <i class="icon-folder green ace-icon fa fa-folder"></i> Unité / 
                            <i class="icon-folder grey ace-icon fa fa-folder"></i> Poste / 
                            <i class="ace-icon fa fa-file-text grey"></i> Tâche
                        </div>
                        <div class="widget-main padding-12">
                            <span style="font-size: 14px; margin-left: -4px;"><?php echo $societe; ?></span>
                            <ul id="tree2"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif($_SESSION['statistique'] == 0): ?>
            <div class="col-sm-9">
                <div class="widget-box widget-color-blue">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            Hiérarchie des Budgets Définitifs :
                            <span class="smaller-80"> <?php echo $societe; ?></span>
                        </h4>
                    </div>
                    <?php $titre_budgets = TitrebudjetTable::getInstance()->getByType('Final', $_SESSION['exercice_budget']); ?>
                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <i class="icon-folder red ace-icon fa fa-folder"></i> Budget / 
                            <i class="icon-folder orange ace-icon fa fa-folder"></i> Rubrique B. / 
                            <i class="icon-folder blue ace-icon fa fa-folder"></i> Sous Rubrique B. / 
                            <i class="icon-folder green ace-icon fa fa-folder"></i> Engagement / 
                            <i class="ace-icon fa fa-file-text grey"></i> Document Finance
                        </div>
                        <?php foreach ($titre_budgets as $titre_budget): ?>
                            <div class="widget-main padding-12">
                                <span style="font-size: 14px; margin-left: -4px;">Budgets Définitifs</span>
                                <ul id="tree1_<?php echo $titre_budget->getId(); ?>"></ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>

<?php $directions = DirectionTable::getInstance()->getAllOrderByLibelle(); ?>

<script type="text/javascript">

    jQuery(function ($) {
    var sampleData = initiateDemoData(); //see below

            $('#tree2').ace_tree({
    dataSource: sampleData['dataSource2'],
            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
            'open-icon': 'ace-icon fa fa-folder-open',
            'close-icon': 'ace-icon fa fa-folder',
            'itemSelect': true,
            'folderSelect': true,
            'multiSelect': true,
            'selected-icon': null,
            'unselected-icon': null,
            'folder-open-icon': 'ace-icon tree-plus',
            'folder-close-icon': 'ace-icon tree-minus'
    });
<?php foreach ($titre_budgets as $titre_budget): ?>
        $('#tree1_<?php echo $titre_budget->getId(); ?>').ace_tree({
        dataSource: sampleData['dataSource1_<?php echo $titre_budget->getId(); ?>'],
                loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
                'open-icon': 'ace-icon fa fa-folder-open',
                'close-icon': 'ace-icon fa fa-folder',
                'itemSelect': true,
                'folderSelect': true,
                'multiSelect': true,
                'selected-icon': null,
                'unselected-icon': null,
                'folder-open-icon': 'ace-icon tree-plus',
                'folder-close-icon': 'ace-icon tree-minus'
        });
<?php endforeach; ?>

    function initiateDemoData() {
    var tree_data_2 = {
<?php foreach ($directions as $direction): ?>
        '<?php echo $direction->getId() ?>': {text: "<?php echo trim($direction) ?>", type: 'folder', 'icon-class': 'red'},
<?php endforeach; ?>
    }

<?php foreach ($directions as $direction): ?>
        tree_data_2['<?php echo $direction->getId() ?>']['additionalParameters'] = {
        'children': {
    <?php foreach ($direction->getSousdirection() as $sous_direction): ?>
            '<?php echo $sous_direction->getId() ?>': {text: "<?php echo trim($sous_direction->getLibelle()) ?>", type: 'folder', 'icon-class': 'orange'},
    <?php endforeach; ?>
        }
        }
<?php endforeach; ?>

<?php foreach ($directions as $direction): ?>
    <?php foreach ($direction->getSousdirection() as $sous_direction): ?>
            tree_data_2['<?php echo $direction->getId() ?>']['additionalParameters']['children']['<?php echo $sous_direction->getId() ?>']['additionalParameters'] = {
            'children': {
        <?php foreach ($sous_direction->getServicerh() as $service): ?>
                '<?php echo $service->getId() ?>': {text: "<?php echo trim($service->getLibelle()) ?>", type: 'folder', 'icon-class': 'blue'},
        <?php endforeach; ?>
            }
            }
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($directions as $direction): ?>
    <?php foreach ($direction->getSousdirection() as $sous_direction): ?>
        <?php foreach ($sous_direction->getServicerh() as $service): ?>
                tree_data_2['<?php echo $direction->getId() ?>']['additionalParameters']['children']['<?php echo $sous_direction->getId() ?>']['additionalParameters']['children']['<?php echo $service->getId() ?>']['additionalParameters'] = {
                'children': {
            <?php foreach ($service->getUnite() as $unite): ?>
                    '<?php echo $unite->getId() ?>': {text: "<?php echo trim($unite->getLibelle()) ?>", type: 'folder', 'icon-class': 'green'},
            <?php endforeach; ?>
                }
                }
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($directions as $direction): ?>
    <?php foreach ($direction->getSousdirection() as $sous_direction): ?>
        <?php foreach ($sous_direction->getServicerh() as $service): ?>
            <?php foreach ($service->getUnite() as $unite): ?>
                    tree_data_2['<?php echo $direction->getId() ?>']['additionalParameters']['children']['<?php echo $sous_direction->getId() ?>']['additionalParameters']['children']['<?php echo $service->getId() ?>']['additionalParameters']['children']['<?php echo $unite->getId() ?>']['additionalParameters'] = {
                    'children': {
                <?php foreach ($unite->getPosterh() as $poste): ?>
                        '<?php echo $poste->getId() ?>': {text: "<?php echo trim($poste->getLibelle()) ?>", type: 'folder'},
                <?php endforeach; ?>
                    }
                    }
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($directions as $direction): ?>
    <?php foreach ($direction->getSousdirection() as $sous_direction): ?>
        <?php foreach ($sous_direction->getServicerh() as $service): ?>
            <?php foreach ($service->getUnite() as $unite): ?>
                <?php foreach ($unite->getPosterh() as $poste): ?>
                        tree_data_2['<?php echo $direction->getId() ?>']['additionalParameters']['children']['<?php echo $sous_direction->getId() ?>']['additionalParameters']['children']['<?php echo $service->getId() ?>']['additionalParameters']['children']['<?php echo $unite->getId() ?>']['additionalParameters']['children']['<?php echo $poste->getId() ?>']['additionalParameters'] = {
                        'children': {
                    <?php foreach ($poste->getTaches() as $tache): ?>
                            '<?php echo $tache->getId() ?>': {text: "<i class='ace-icon fa fa-file-text grey'></i> <?php echo trim($tache->getLibelle()) ?>", type: 'item'},
                    <?php endforeach; ?>
                        }
                        }
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

    var dataSource2 = function (options, callback) {
    var $data = null
            if (!("text" in options) && !("type" in options)) {
    $data = tree_data_2; //the root tree
            callback({data: $data});
            return;
    }
    else if ("type" in options && options.type == "folder") {
    if ("additionalParameters" in options && "children" in options.additionalParameters)
            $data = options.additionalParameters.children || {};
            else
            $data = {}//no data
    }

    if ($data != null)//this setTimeout is only for mimicking some random delay
            setTimeout(function () {
            callback({data: $data});
            }, parseInt(Math.random() * 500) + 200);
    }


<?php foreach ($titre_budgets as $titre_budget): ?>

        var tree_data_1_<?php echo $titre_budget->getId(); ?> = {
        '<?php echo $titre_budget->getId() ?>': {text: "<?php echo trim($titre_budget) ?>", type: 'folder', 'icon-class': 'red'},
        }

        //Rubriques
    <?php
    $ligne_detail_budgets = Doctrine_Query::create()
                    ->select("*")
                    ->from('ligprotitrub')
                    ->where("id_titre=" . $titre_budget->getId())
                    ->orderBy('length(trim(nordre)),trim(nordre)')->execute();
    ?>
        tree_data_1_<?php echo $titre_budget->getId(); ?>['<?php echo $titre_budget->getId() ?>']['additionalParameters'] = {
        'children': {
    <?php foreach ($ligne_detail_budgets as $ligprotitrub): ?>
        <?php if (!$ligprotitrub->getRubrique()->getIdRubrique()): ?>
                '<?php echo trim($ligprotitrub->getNordre()) ?>': {text: "<?php echo trim($ligprotitrub->getCode()) . ' : ' . trim($ligprotitrub->getRubrique()->getLibelle()) ?>", type: 'folder', 'icon-class': 'orange'},
        <?php endif; ?>
    <?php endforeach; ?>
        }
        }

        //Sous Rubriques
    <?php foreach ($ligne_detail_budgets as $ligprotitrub): ?>
        <?php if (!$ligprotitrub->getRubrique()->getIdRubrique()): ?>
                tree_data_1_<?php echo $titre_budget->getId(); ?>['<?php echo $titre_budget->getId() ?>']['additionalParameters']['children']['<?php echo trim($ligprotitrub->getNordre()) ?>']['additionalParameters'] = {
                'children': {
            <?php $sousrubriques = RubriqueTable::getInstance()->findByIdRubrique($ligprotitrub->getIdRubrique()); ?>
            <?php foreach ($sousrubriques as $sousrubrique): ?>
                <?php $ligne_rubrique = LigprotitrubTable::getInstance()->findOneByIdRubriqueAndIdTitre($sousrubrique->getId(), $titre_budget->getId()); ?>
                <?php if ($ligne_rubrique): ?>
                        '<?php echo trim($ligne_rubrique->getNordre()) ?>': {text: "<?php echo trim($ligne_rubrique->getCode()) . " : " . trim($ligne_rubrique->getRubrique()->getLibelle()) ?>", type: 'folder', 'icon-class': 'blue'},
                <?php endif; ?>
            <?php endforeach; ?>
            //Documents Budget pour les rubriques qui n'ont pas des sous rubriques
            <?php foreach ($ligprotitrub->getDocumentbudget() as $document_budget): ?>
                    '<?php echo trim($document_budget->getNumero()) ?>': {text: "<?php echo trim($document_budget->getNumerodocachat()) . " : " . trim($document_budget->getTypedocbudget()) ?>", type: 'folder', 'icon-class': 'green'},
            <?php endforeach; ?>

                }
                }
        <?php endif; ?>
    <?php endforeach; ?>

        //Documents Achats pour les Documents Budget des rubriques qui n'ont pas des sous rubriques
    <?php foreach ($ligne_detail_budgets as $ligprotitrub): ?>
        <?php if (!$ligprotitrub->getRubrique()->getIdRubrique()): ?>
            <?php if ($ligprotitrub->getDocumentbudget()->count() != 0): ?>
                <?php foreach ($ligprotitrub->getDocumentbudget() as $document_budget): ?>
                    <?php if ($document_budget->getDocumentachat() != null): ?>
                            tree_data_1_<?php echo $titre_budget->getId(); ?>['<?php echo $titre_budget->getId() ?>']['additionalParameters']['children']['<?php echo trim($ligprotitrub->getNordre()) ?>']['additionalParameters']['children']['<?php echo trim($document_budget->getNumero()) ?>']['additionalParameters'] = {
                            'children': {
                        <?php
                        if ($document_budget->getDocumentachat()->getIdDocparent() != null):
                            $documentachat_parent = DocumentachatTable::getInstance()->find($document_budget->getDocumentachat()->getIdDocparent());
                            ?>
                                '<?php echo trim($document_budget->getDocumentachat()) ?>': {text: "<i class='ace-icon fa fa-file-text grey'></i> <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $document_budget->getDocumentachat()->getId() ?>'><?php echo trim($document_budget->getDocumentachat()) ?></a> ( <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat_parent->getId() ?>'><?php echo trim($documentachat_parent) ?></a> ) ==> <?php echo trim($document_budget->getDocumentachat()->getFournisseur()->getRs()) ?>", type: 'item'},
                        <?php else: ?>
                                '<?php echo trim($document_budget->getDocumentachat()) ?>': {text: "<i class='ace-icon fa fa-file-text grey'></i> <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $document_budget->getDocumentachat()->getId() ?>'><?php echo trim($document_budget->getDocumentachat()) ?></a> ==> <?php echo trim($document_budget->getDocumentachat()->getFournisseur()->getRs()) ?>", type: 'item'},
                        <?php endif; ?>
                            }
                            }
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

        //Documents Budget pour les sous rubriques
    <?php foreach ($ligne_detail_budgets as $ligprotitrub): ?>
        <?php if (!$ligprotitrub->getRubrique()->getIdRubrique()): ?>
            <?php $sousrubriques = RubriqueTable::getInstance()->findByIdRubrique($ligprotitrub->getIdRubrique()); ?>
            <?php foreach ($sousrubriques as $sousrubrique): ?>
                <?php $ligne_rubrique = LigprotitrubTable::getInstance()->findOneByIdRubriqueAndIdTitre($sousrubrique->getId(), $titre_budget->getId()); ?>
                <?php if ($ligne_rubrique): ?>
                        tree_data_1_<?php echo $titre_budget->getId(); ?>['<?php echo $titre_budget->getId() ?>']['additionalParameters']['children']['<?php echo trim($ligprotitrub->getNordre()) ?>']['additionalParameters']['children']['<?php echo trim($ligne_rubrique->getNordre()) ?>']['additionalParameters'] = {
                        'children': {
                    <?php foreach ($ligne_rubrique->getDocumentbudget() as $document_budget): ?>
                            '<?php echo trim($document_budget->getNumero()) ?>': {text: "<?php echo trim($document_budget->getNumerodocachat()) . " : " . trim($document_budget->getTypedocbudget()) ?>", type: 'folder', 'icon-class': 'green'},
                    <?php endforeach; ?>
                        }
                        }
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>

        //Documents Achats pour les Documents Budget des sous rubriques
    <?php foreach ($ligne_detail_budgets as $ligprotitrub): ?>
        <?php if (!$ligprotitrub->getRubrique()->getIdRubrique()): ?>
            <?php $sousrubriques = RubriqueTable::getInstance()->findByIdRubrique($ligprotitrub->getIdRubrique()); ?>
            <?php foreach ($sousrubriques as $sousrubrique): ?>
                <?php $ligne_rubrique = LigprotitrubTable::getInstance()->findOneByIdRubriqueAndIdTitre($sousrubrique->getId(), $titre_budget->getId()); ?>
                <?php if ($ligne_rubrique): ?>
                    <?php foreach ($ligne_rubrique->getDocumentbudget() as $document_budget): ?>
                        <?php if ($document_budget->getDocumentachat() != null): ?>
                                tree_data_1_<?php echo $titre_budget->getId(); ?>['<?php echo $titre_budget->getId() ?>']['additionalParameters']['children']['<?php echo trim($ligprotitrub->getNordre()) ?>']['additionalParameters']['children']['<?php echo trim($ligne_rubrique->getNordre()) ?>']['additionalParameters']['children']['<?php echo trim($document_budget->getNumero()) ?>']['additionalParameters'] = {
                                'children': {
                            <?php
                            if ($document_budget->getDocumentachat()->getIdDocparent() != null):
                                $documentachat_parent = DocumentachatTable::getInstance()->find($document_budget->getDocumentachat()->getIdDocparent());
                                ?>
                                    '<?php echo trim($document_budget->getDocumentachat()) ?>': {text: "<i class='ace-icon fa fa-file-text grey'></i> <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $document_budget->getDocumentachat()->getId() ?>'><?php echo trim($document_budget->getDocumentachat()) ?></a> ( <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat_parent->getId() ?>'><?php echo trim($documentachat_parent) ?></a> ) ==> <?php echo trim($document_budget->getDocumentachat()->getFournisseur()->getRs()) ?>", type: 'item'},
                            <?php else: ?>
                                    '<?php echo trim($document_budget->getDocumentachat()) ?>': {text: "<i class='ace-icon fa fa-file-text grey'></i> <a target='_blank' href='<?php echo url_for('documentachat/showdocument?iddoc=') . $document_budget->getDocumentachat()->getId() ?>'><?php echo trim($document_budget->getDocumentachat()) ?></a> ==> <?php echo trim($document_budget->getDocumentachat()->getFournisseur()->getRs()) ?>", type: 'item'},
                            <?php endif; ?>
                                }
                                }
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>

        var dataSource1_<?php echo $titre_budget->getId(); ?> = function (options, callback) {
        var $data = null
                if (!("text" in options) && !("type" in options)) {
        $data = tree_data_1_<?php echo $titre_budget->getId(); ?>; //the root tree
                callback({data: $data});
                return;
        }
        else if ("type" in options && options.type == "folder") {
        if ("additionalParameters" in options && "children" in options.additionalParameters)
                $data = options.additionalParameters.children || {};
                else
                $data = {}//no data
        }

        if ($data != null)//this setTimeout is only for mimicking some random delay
                setTimeout(function () {
                callback({data: $data});
                }, parseInt(Math.random() * 500) + 200);
        }
<?php endforeach; ?>

    return {'dataSource2': dataSource2<?php foreach ($titre_budgets as $titre_budget): ?>, 'dataSource1_<?php echo $titre_budget->getId(); ?>': dataSource1_<?php echo $titre_budget->getId(); ?><?php endforeach; ?>}
    }
    });

</script>