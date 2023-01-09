<div style="overflow: auto; width: 100%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Liste des Domaines d'utilisation</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">N°</th>
                                <th style="width: 10%">Code</th>
                                <th style="width: 80%">Libelle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('domaineuntilisation')
                                    ->execute();
                            $ag = new Domaineuntilisation();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="id" ondblclick="ChargerDomaine('<?php echo $ag->getId(); ?>', '<?php echo $ag->getCode(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <td style="width: 10%;text-align: center"><?php echo $i; ?></td>
                                    <td style="width: 10%;text-align: center"><?php echo $ag->getCode(); ?></td>
                                    <td style="width: 80%"><?php echo $ag->getLibelle(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer">
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteDomaine') ?>" class="btn  btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  btn-sm pull-left" onclick="fermerDomaine()">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ChargerDomaine(id, bes, annee){
        $('#my-modalDomaine').removeClass('in');
        $('#my-modalDomaine').css('display', 'none');
        $('#idDomaine').val(id);
        $('#idfonction').val(bes);
        $('#liebllefonction').val(annee);
    }
    function fermerDomaine(){
        $('#my-modalDomaine').removeClass('in');
        $('#my-modalDomaine').css('display', 'none');
    }
</script>