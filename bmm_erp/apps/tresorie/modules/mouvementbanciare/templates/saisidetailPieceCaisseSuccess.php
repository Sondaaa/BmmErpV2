<div  style="width: 100%">
<input type="hidden" id="id_mvt" value="<?php echo $id_mvt ;?> ">
<input id='val_credit' value="<?php echo $mvt->getCredit() ?>" type="hidden">
<input id='val_debit' value="<?php echo $mvt->getDebit() ?>" type="hidden">
                <div >
                    <div >
                        <h3 class="smaller lighter blue no-margin">Détail Monnaie</h3>
                    </div>
                    <div class="modal-body" >
                        <?php
                        $formapiece = new CaiseepiecemonnaieForm();
                        $caissepiecemon = new Caiseepiecemonnaie();
                        ?>
                        <?php include_partial('mouvementbanciare/formpetit', array('caissepiecemon' => $caissepiecemon, 'form' => $formapiece)) ?>
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
 </div>