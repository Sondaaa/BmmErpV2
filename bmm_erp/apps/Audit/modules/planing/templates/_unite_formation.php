<div style="overflow: auto; width: 100%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des unités</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 20%">Numéro</th>
                                <th>Libellé</th> 
                                <th style="display: none">Code Unité</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('unite')
                                    ->execute();
                            $ag = new Unite();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chUniteFormation('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <td style="width: 20%"><?php echo $i; ?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAllliste') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermeruniteFormation()" >
                        Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table table-bordered table-hover");
    function chUniteFormation(id, libelle){
        $('#my-modalUnite-formation').removeClass('in');
        $('#my-modalUnite-formation').css('display', 'none');
        $('#idunite-formation').val(id);
        $('#unite-formation').val(libelle);
        $('#idfonction-formation').val(id);
        $('#liebllefonction-formation').val(libelle);
    }
    function fermeruniteFormation(){
        $('#my-modalUnite-formation').removeClass('in');
        $('#my-modalUnite-formation').css('display', 'none');
    }

</script>