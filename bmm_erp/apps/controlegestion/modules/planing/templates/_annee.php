<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Besoins de Formation</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N° </th> 
                                <th style="width: 10%">Besoins</th>  
                                <th style="width: 30%">Année</th>  

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('besoinsdeformation')
                                    ->execute();
                            $ag = new Besoinsdeformation();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="id" ondblclick="ChargerBesoins('<?php echo $ag->getId(); ?>', '<?php echo $ag->getBesoins(); ?>','<?php echo $ag->getAnnee(); ?>')">
                                    <!-- '', -->
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getBesoins(); ?></td>
                                    <td style="width: 30%"><?php echo $ag->getAnnee(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteAnee?') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerBesoins()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function ChargerBesoins(id,bes, annee)
    {

        $('#my-modalBesoins').removeClass('in');
        $('#my-modalBesoins').css('display', 'none');
        $('#idBe').val(id);
        $('#besoins').val(bes);
        $('#idbesoins').val(annee);

    }
    function fermerBesoins()
    {
        $('#my-modalBesoins').removeClass('in');
        $('#my-modalBesoins').css('display', 'none');
    }

</script>


