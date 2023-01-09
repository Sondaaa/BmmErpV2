<div id="sf_admin_container">
    <h1 id="replacediv"> Listes des documents attachés avec bon commande interne </h1>
</div>
<div id="sf_admin_bar" >

    <div class="sf_admin_filter col-xs-8" ng-controller="Ctrlrecherchedocs">


        <form action="" method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/index') ?>">Effacer</a>
                          
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>

                </tfoot>
                <tbody>
                    <tr>
                        <td>B.C.Interne</td>
                        <td>

                            <input type="hidden" ng-model="tet">
                            <input ng-model="recherche.text" type="text" value="<?php echo $texte ?>"  id="designation" autocomplete="off" class="form-control" ng-click="AfficheDoc()"  ng-change="AfficheDoc()">
                            <input  type="hidden" value="<?php echo $texte ?>"  id="idbci" name="id"  autocomplete="off"   class="form-control">                   

                        </td>
                    </tr>

                </tbody>
            </table>
        </form>

    </div>

    <div class="col-xs-12" >

        <?php if ($documentachat) { ?>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail BCI </a>
                </li>
                <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Demandes des prix</a>
                </li>
                <li class=""><a href="#profile1" data-toggle="tab" aria-expanded="false">Bon des déponse aux comptant </a>
                </li>
                <li class=""><a href="#profile2" data-toggle="tab" aria-expanded="false">Bon des commandes externe </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Bon de commande Interne N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 

                    <div style="margin-top: 10px;">
                        <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                            <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                        </object>
                    </div>
                </div>

                <div class="tab-pane" style="height: 800px" id="profile"  >

                    <div class=" col-xs-12">
                        <div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;" >
                            <div class="widget-header">
                                <h5 class="widget-title">Listes des demandes de prix</h5>
                                <div class="widget-toolbar"> <a href="#" data-action="collapse" class="btn btn-white btn-success"> 
                                        <i class="ace-icon fa fa-chevron-up"></i> </a> 
                                </div>
                            </div> 
                            <div class="widget-body" style="display: block;padding: 2%" >

                                <table id="simple-table" class="table  table-bordered table-hover">

                                    <thead>
                                        <tr>

                                            <th>Numéro</th>
                                            <th>Date de Création</th>
                                            <th>Fournisseur</th>
                                            <th>Détail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $document_achat = new Documentachat();
                                        foreach ($demandesprix as $documentachat):
                                            $document_achat = $documentachat;
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneByIdAndIdTypedoc($document_achat->getIdDocparent(), 6);
                                            ?>
                                            <tr>
                                                <td><?php echo $document_achat->getNumerodocachat() ?></td>

                                                <td><?php echo $document_achat->getDatecreation() ?></td>   
                                                <td><?php echo $document_achat->getFournisseur() ?></td>
                                                <td class="center">
                                                    <div class="action-buttons">
                                                        <p href="#" class="green bigger-140 show-details-btn">
                                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                                            <span class="sr-only">Details</span>
                                                        </p>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr class="detail-row">
                                                <td colspan="5">
                                                    <div class="table-detail">
                                                        <?php echo html_entity_decode($document_achat->getHtmlDemandedeprix()); ?> 
                                                        <a  href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') . $document_achat->getId() ?>"    target="_blanc">Exporter PDF</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>



                    </div>
                </div>

                <div class="tab-pane" style="height: 800px"  id="profile1" >
                    <div class=" col-xs-12">
                        <div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;">
                            <div class="widget-header">
                                <h5 class="widget-title">Listes des Bon de déponse au comptant</h5>
                                <div class="widget-toolbar"> <a href="#" data-action="collapse" class="btn btn-white btn-success"> 
                                        <i class="ace-icon fa fa-chevron-up"></i> </a> 
                                </div>
                            </div> 
                            <div class="widget-body" style="display: block;padding: 2%">

                                <table>
                                    <thead>
                                        <tr>

                                            <th>Numéro</th>
                                            <th>Date de Création</th>
                                            <th>Fournisseur</th>
                                           

                                            <th>Mnt. HT</th>
                                            <th>Mnt. TVA</th>

                                            <th>Détail</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $document_achat = new Documentachat();
                                        foreach ($documentdeponses as $documentachat):
                                            $document_achat = $documentachat;
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneByIdAndIdTypedoc($document_achat->getIdDocparent(), 6);
                                            ?>
                                            <tr>
                                                <td><?php echo $document_achat->getNumerodocachat() ?></td>

                                                <td><?php echo $document_achat->getDatecreation() ?></td>   
                                                <td><?php echo $document_achat->getFournisseur() ?></td>
                                                <td><?php echo $document_achat->getMht() ?></td>
                                                <td><?php echo $document_achat->getMnttva() ?></td>
                                                
                                                <td class="center">
                                                    <div class="action-buttons">
                                                        <p href="#" class="green bigger-140 show-details-btn">
                                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                                            <span class="sr-only">Details</span>
                                                        </p>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr class="detail-row">
                                                <td colspan="7">
                                                    <div class="table-detail">
                                                        <?php echo html_entity_decode($document_achat->ReadHtmlBondeponse()); ?> 
                                                        <a  href="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=') . $document_achat->getId() ?>"    target="_blanc">Exporter PDF</a>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>



                    </div>

                </div>
                <div class="tab-pane" style="height: 800px"  id="profile2" >

                    <div class=" col-xs-12">
                        <div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;">
                            <div class="widget-header">
                                <h5 class="widget-title">Listes des Bon commandes externe</h5>
                                <div class="widget-toolbar"> <a href="#" data-action="collapse" class="btn btn-white btn-success"> 
                                        <i class="ace-icon fa fa-chevron-up"></i> </a> 
                                </div>
                            </div> 
                            <div class="widget-body" style="display: block;padding: 2%">

                                <table>
                                    <thead>
                                        <tr>

                                            <th>Numéro</th>
                                            <th>Date de Création</th>
                                            <th>Fournisseur</th>
                                            <th>Mnt. HT</th>
                                            <th>Mnt. TVA</th>
                                            <th>Mnt.TTC</th>
                                            <th>Détail</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $document_achat = new Documentachat();
                                        foreach ($documentachats as $documentachat):
                                            $document_achat = $documentachat;
                                            $bci = Doctrine_Core::getTable('documentachat')->findOneByIdAndIdTypedoc($document_achat->getIdDocparent(), 6);
                                            ?>
                                            <tr>
                                                <td><?php echo $document_achat->getNumerodocachat() ?></td>

                                                <td><?php echo $document_achat->getDatecreation() ?></td>   
                                                <td><?php echo $document_achat->getFournisseur() ?></td>
                                                <td><?php echo $document_achat->getMht() ?></td>
                                                <td><?php echo $document_achat->getMnttva() ?></td>
                                                <td><?php echo $document_achat->getMntttc() ?></td>
                                                <td class="center">
                                                    <div class="action-buttons">
                                                        <p href="#" class="green bigger-140 show-details-btn">
                                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                                            <span class="sr-only">Details</span>
                                                        </p>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr class="detail-row">
                                                <td colspan="7">
                                                    <div class="table-detail">
                                                        <?php echo html_entity_decode($document_achat->ReadHtmlBonexterne()); ?> 
                                                        <a  href="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=') . $document_achat->getId() ?>"    target="_blanc">Exporter PDF</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>



                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

</div>









