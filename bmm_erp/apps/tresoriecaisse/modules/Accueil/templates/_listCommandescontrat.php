<?php
foreach ($documentachats as $documentachat): ?>
    <tr class="ligne_compte">
        <td style="text-align: center;min-width: 150px;">
            <b>
                <a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $documentachat->getId()); ?>">
                    <?php
                    echo $documentachat->getNumerodocachat();
                    ?>
                </a>
            </b>
        </td>
        <td style="text-align: center"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
        <td><?php
            if (($documentachat->getIdDemandeur() != '' && $documentachat->getIdDemandeur() != null))
                echo $documentachat->getDemandeur();
            ?>
        </td>
        <td>
            <?php echo $documentachat->getEtatdocument()->getEtatdocachat(); ?>
        </td>
        <td style="text-align: center">
            <?php
            $document_achat_externe_Provisoire = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 21);
            foreach ($document_achat_externe_Provisoire as $prevesoire) : ?>
                <a target="_blank" href="<?php echo $prevesoire->getLinkDocument(); ?>">
                    <?php
                    echo '<p>' . $prevesoire->getNumerodocachat() . '</p>';
                    ?>
                </a>
            <?php endforeach; ?>
        </td>
        <td style="text-align: center" colspan="2">
            <?php
            $document_achat_externe_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getId(), 22);
            foreach ($document_achat_externe_difinitif as $definitif) : ?>
                <a target="_blank" href="<?php echo $definitif->getLinkDocument(); ?>">
                    <?php
                    echo '<p>';
                    echo $definitif->getNumerodocachat();
                    echo ' - ' . number_format($definitif->getMntttc(), 3, ".", " ");
                    echo  '</p>';
                    ?>
                </a>
            <?php endforeach; ?>
        </td>




        <td colspan="2">
            <?php
            foreach ($document_achat_externe_Provisoire as $prevesoire) :
                $piece_budget_porvisoire = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($prevesoire->getId());
                if ($piece_budget_porvisoire && $piece_budget_porvisoire->getDocumentbudget()) :
            ?>

                <?php
                    echo '<p>' . date('d/m/Y', strtotime($piece_budget_porvisoire->getDocumentbudget()->getDatecreation()));
                    if ($piece_budget_porvisoire->getDocumentbudget()->getMnt())
                        echo ' - ' . $piece_budget_porvisoire->getDocumentbudget()->getMnt() . '';
                    echo '</p>';
                endif;
                ?>

            <?php endforeach; ?>

        </td>

        <td colspan="2">
            <?php
            foreach ($document_achat_externe_difinitif as $definitif) {

                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
                if ($piecejoint) {
                    $document_udget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($piecejoint->getIdDocumentbudget());
                    if ($document_udget_ordanancemet) {
                        $piece_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdDocumentbudget($definitif->getId(), $document_udget_ordanancemet->getId());
                        if ($piece_budget) {
                            echo date('d/m/Y', strtotime($piece_budget->getDocumentbudget()->getDatecreation()));
                            if ($piece_budget->getDocumentbudget()->getMnt())
                                echo ' - ' . $piece_budget->getDocumentbudget()->getMnt();
                        }
                    }
                }
            }
            ?>
        </td>
        <td style="text-align: center" colspan="3">
            <?php
            foreach ($document_achat_externe_difinitif as $definitif) {
                $docparent_parent = DocumentachatTable::getInstance()->findOneByIdDocparent($definitif->getId());
                if ($docparent_parent) {
                    echo '<p>' . $docparent_parent->getNumerodocachat();
                    if ($definitif->getLignemouvementfacturation()->getFirst() && $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture())
                        echo ' - ' . $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture();
                    echo ' - ' . number_format($docparent_parent->getMntttc(), 3, ".", " ");
                    echo '</p>';
                }
            }
            ?>
        </td>
        <td style="text-align: center" colspan="2">
            <?php
            foreach ($document_achat_externe_difinitif as $definitif) {

                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
                if ($piecejoint) {
                    $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
                    $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
                    if ($document_budget_ordanancemet) {
                        $id_docbudget = $document_budget_ordanancemet->getId();
                        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);

                        if (sizeof($mvts) >= 1 && $mvts->getFirst()->getId() != null) {

                            echo '<p>';

                            echo date('d/m/Y', strtotime($mvts->getFirst()->getDateoperation()));
                            if ($mvts->getFirst()->getDebit() != null)
                                echo ' - ' . number_format($mvts->getFirst()->getDebit(), 3, ".", " ");
                            else if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getCredit() != null)
                                echo ' - ' . number_format($mvts->getFirst()->getCredit(), 3, ".", " ");

                            echo '</p>';
                        }
                    }
                }
            }
            ?>
        </td>
        <td style="text-align: center" colspan="3">
            <?php
            foreach ($document_achat_externe_difinitif as $definitif) {
                $id_docparent = $definitif->getId();
                $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_docparent);
                if ($piecejoint)
                    $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
                $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
                if ($document_budget_ordanancemet) {

                    $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($document_budget_ordanancemet->getId());
                    if (sizeof($mvts) >= 1) {
                        echo '<p>';
                        echo $mvts->getFirst()->getCaissesbanques();
                        echo ' - ' . $mvts->getFirst()->getInstrumentpaiment();
                        echo ' - ' . $mvts->getFirst()->getDebit();
                        echo '</p>';
                    }
                }
            }
            ?>
        </td>


    </tr>
<?php
endforeach;
?>