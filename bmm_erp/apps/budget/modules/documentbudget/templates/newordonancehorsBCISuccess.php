<div id="sf_admin_container">
    <h1 id="replacediv">Fiche d'ordonnance de paiement</h1>
    <div id="sf_admin_content">
        <div class="col-sm-6" ng-controller="CtrlFormOrdonnance" ng-init="InialiserOrdonnance()">
            <div class=" tab-content">

                <p>
                    <i class="green ace-icon fa fa-user bigger-120"></i>
                    IMPUTATION BUDGETAIRE
                </p>
                <?php $document_budget = DocumentbudgetTable::getInstance()->find($id); ?>
                <div>
                    <fieldset>

                        <table border="1" style="padding:1%">
                            <tbody>
                                <tr class="disabledbutton">
                                    <td><label>Type</label></td>
                                    <td colspan="5">
                                        <?php echo $form['id_type']->renderError() ?>
                                        <?php echo $form['id_type'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Date Création</label></td>
                                    <td>
                                        <?php echo $form['datecreation']->renderError() ?>
                                        <?php echo $form['datecreation'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Numéro</label></td>
                                    <td colspan="5" class="disabledbutton">
                                        <?php echo $form['numero']->renderError() ?>
                                        <?php
                                        if ($form->getObject()->isNew())
                                            echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(2)));
                                        else
                                            echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="1" style="padding:1%">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;"><label>Exercice</label></td>
                                    <td style="width: 70%;"><?php
                                                            echo $_SESSION['exercice_budget'];
                                                            ?>
                                    </td>
                                </tr>


                                <?php
                                $ligne = new Ligprotitrub();
                                $annees = $_SESSION['exercice_budget'];
                                $budgets = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('titrebudjet')
                                    ->where("Etatbudget=2")
                                    ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                    ->andwhere("trim(typebudget)  like trim('Exercice:" . $annees . "')  ")
                                    ->orderBy('id asc')->execute();
                                //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
                                if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) {
                                    $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdBudget());
                                    if ($l)
                                        $ligne = $l;
                                }
                                ?>
                                <tr>
                                    <td><label>Titre Budget</label></td>
                                    <td><?php echo $document_budget->getLigprotitrub()->getTitrebudjet()->getLibelle(); ?></td>
                                </tr>
                                <?php
                                $sous_rubrique = $document_budget->getLigprotitrub()->getRubrique();
                                if ($sous_rubrique->getIdRubrique()) {
                                    $id_rubrique = $sous_rubrique->getIdRubrique();
                                    $rubrique = RubriqueTable::getInstance()->find($id_rubrique);
                                } else
                                    $rubrique = $sous_rubrique;
                                ?>
                                <?php if (!$sous_rubrique->getIdRubrique()) { ?>
                                    <tr>
                                        <td><label>Rubrique</label></td>
                                        <td><?php echo $document_budget->getLigprotitrub()->getRubrique()->getLibelle(); ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td><label>Rubrique</label></td>
                                        <td><?php echo $rubrique; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Sous Rubrique</label></td>
                                        <td><?php echo $sous_rubrique; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php // $sous_rubrique = Doctrine_Core::getTable('rubrique')->findOneByIdRubrique($document_budget->getLigprotitrub()->getIdRubrique()); 
                                ?>
                                <?php
                                if ($sous_rubrique) :
                                ?>

                                    <tr>
                                        <td><label>Mnt.</label></td>
                                        <td colspan="3"><?php echo number_format($document_budget->getMnt(), 3, ".", " "); ?> TND</td>
                                    </tr>
                                    <tr>
                                        <td><label>Mnt Engagé</label></td>
                                        <td colspan="3"><?php echo number_format($document_budget->getMntengage(), 3, ".", " "); ?> TND</td>
                                    </tr>
                                    <tr>
                                        <td><label>Reliquat Engagé</label></td>
                                        <td><?php echo number_format($document_budget->getMntrelicat(), 3, ".", " "); ?> TND</td>
                                    </tr>
                                <?php endif; ?>


                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>

                   
                        <button class="btn btn-success btn-sm"  id="valide_button_horsbci" onclick="AjouterOrdonnaceHorsBCI()">
                                        <i class="fa fa-save"></i> Valider Ordonnancement
                         </button>
                   
                </div>
            </div>
        </div>
        <div class="col-sm-6">
           
                <div class=" tab-content">
                    <p>
                        <i class="green ace-icon fa fa-eye bigger-120"></i>
                        Detail Fiche d'engagement
                    </p>

                    <a class="btn btn-blue btn-sm" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire') . '?idfiche=' . $id ?>">Exporter Pdf & Impression Fiche</a>
                    <?php echo html_entity_decode( $documentbudgetdefinitif->ReadHtmlDoc($documentachat)) ?>                    
                    
                </div>
            
        </div>

    </div>
</div>
<script>
    function AjouterOrdonnaceHorsBCI() {
        $.ajax({
            url: '<?php echo url_for('documentbudget/validerOrdonnanceHorsBCI') ?>',
            data: 'idbudget=<?php echo $document_budget->getLigprotitrub()->getId(); ?>' +
                '&idtype=2' +
                '&idpreengagement=<?php echo $document_budget->getId(); ?>' +
                '&mnttc=<?php echo $document_budget->getMnt(); ?>',
            success: function(data) {
                //                $('#valide_button_horsbci').hide();
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#15b365;'>Ordonnacement validé avec succès !</span>",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        });
    }
</script>