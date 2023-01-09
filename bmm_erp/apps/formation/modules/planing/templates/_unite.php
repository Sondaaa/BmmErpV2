
<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des unités</h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr>
                                <th style="width: 5%">Numéro</th>
                                <th style="width: 95%">Libelle</th> 

                                <th style="display: none">Code Unite</th> 

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
                                <tr style="cursor: pointer;" ondblclick="chUnite('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">

                                    <td style="width: 5%;text-align: center"><?php echo $i; ?> </td>

                                    <td style="width: 95%"><?php echo $ag->getLibelle(); ?> </td>
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
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAllliste') ?>" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerunite()" >

                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
<script>
    $("table").addClass("table  table-bordered table-hover");
    function chUnite(id, libelle)
    {
        $('#my-modalUnite').removeClass('in');
        $('#my-modalUnite').css('display', 'none');
        $('#idunite').val(id);
        $('#unite').val(libelle);


    }
    function fermerunite()
    {
        $('#my-modalUnite').removeClass('in');
        $('#my-modalUnite').css('display', 'none');
    }

</script>


