<?php

$documentbudget = Doctrine_Core::getTable('documentbudget')->findOneById($form->getObject()->getId());

$piecejointbudget = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocumentbudget($documentbudget->getId());
if ($piecejointbudget != null)
    $id = $piecejointbudget->getIdDocachat();


?>
<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="col-sm-4">
           <div class="tab-content">


                    <p>
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        IMPUTATION BUDGETAIRE
                    </p>
                    <?php if ($documentbudget->getIdType() != 2) : ?>
                        <?php if ($documentbudget->getIdType() == 3 || $documentbudget->getIdType() == 1) : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $documentbudget->getHtmlDocProvisoire($id, $documentbudget->getIdType()) ?>
                                    <a class="btn btn-success btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire') . '?idfiche=' . $documentbudget->getId() . '&iddoc=' . $id ?>">
                                        <i class="fa fa-file-pdf-o"></i> Impression Fiche engagement </a>
                                </div>
                               
                            </div>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
           
        </div>
        <?php if($id):?>
        <div class="col-sm-8">
           <div class="tab-content">


                    
                    <?php if ($documentbudget->getIdType() != 2) : ?>
                        <?php if ($documentbudget->getIdType() == 3 || $documentbudget->getIdType() == 1) :
                             $documentachat=DocumentachatTable::getInstance()->findOneById($id);
                              ?>
                            <div class="row">
                               
                                <div class="col-md-12">
                                <a class="btn btn-success btn-default" target="__blanc" href="<?php echo url_for('documentachat/Imprimerdocachat') . '?iddoc=' . $documentachat->getIdDocparent() ?>">
                                        <i class="fa fa-file-pdf-o"></i> Detail BCI </a>
                                        <a class="btn btn-blue btn-default" target="__blanc" href="<?php echo $documentachat->getLinkDocument() ?>">
                                        <i class="fa fa-file-pdf-o"></i> <?php echo $documentachat->getTypeDocumentTitle();?> </a>
                                    <?php
                                       
                                        if($documentachat){
                                           echo $documentachat->HtmlByType();
                                        }

                                    ?>
                                 
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
           
        </div>
        <?php endif;?>
        <!--/.col -->
    </div>
</div>

<?php if ($documentbudget->getIdType() == 2) : ?>
    <script type="text/javascript">
        $("#sf_admin_container>h1").html('Ordonnance de paiement N° <?php echo $documentbudget->getNumerodocachat(); ?>');
    </script>
<?php endif; ?>