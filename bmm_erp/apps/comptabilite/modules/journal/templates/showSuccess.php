<span class="titre_tiers_modal">Journal Comptable : <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?></span>

<div class="row" style="margin-top: 20px;">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal comptable</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Code :</label>
                            <input type="text" readonly="true" value="<?php echo $journal->getCode() ?>" />
                        </fieldset>
                        <fieldset>
                            <label>Intitulé :</label>
                            <input type="text" readonly="true" value="<?php echo $journal->getLibelle() ?>" />
                        </fieldset>
                        <fieldset>
                            <label>Date créatioin :</label>
                            <input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($journal->getDate())) ?>" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Paramètres</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Type :</label>
                            <input value="<?php echo $journal->getTypejournal()->getLibelle() ?>" readonly="true" type="text">
                        </fieldset>
                        <fieldset style="padding-top: 4px;">
                            <label>Contre Partie :</label>
                            <textarea readonly="true" style="width: 100%; height: 96px; max-height: 96px; max-width: 100%;"><?php echo $journal->getPlancomptable()->getLibelle() ?></textarea>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal et numérotation</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Période :</label>
                            <input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($journal->getDatedebutcloture())); ?>" style="width: 48% !important;" />
                            <input type="text" readonly="true" value="<?php echo date('d/m/Y', strtotime($journal->getDatefincloture())); ?>" style="width: 48% !important; float: right;" />
                        </fieldset>
                        <fieldset>
                            <label>Type Numérotation :</label>
                            <input type="text" readonly="true" value="<?php
                            switch ($journal->getNumerotation()):

                                case 1:
                                    echo 'Annuel';
                                    break;

                                case 2:
                                    echo 'Mensuel';
                                    break;

                                case 3:
                                    echo 'Journalier';
                                    break;
                            endswitch;
                            ?>" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Avancés</h4>
            </div>

            <div class="widget-body" style="height: 149px;">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <label>Dossier Comptable :</label>
                            <input value="<?php echo $journal->getDossiercomptable()->getCode() . ' - ' . $journal->getDossiercomptable()->getRaisonSociale(); ?>" type="text">
                        </fieldset>
                        <fieldset style="padding-top: 20px;">
                            <label>Comptes Comptables : <b><?php echo $journal->getSouscomptejournal()->count(); ?></b></label>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    label, input{width: 100%;}
    .modal-dialog {width: 820px;}
    .titre_tiers_modal{font-size: 16px; color: #146bbf !important;}

</style>