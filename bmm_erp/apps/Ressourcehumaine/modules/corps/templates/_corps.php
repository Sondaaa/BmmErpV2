<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Corps </h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr>
                                   <th style="width: 20%">Numéro</th> 
                                  <th>Libellé</th> 
                                
                                <th style="display: none">Code Corps</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('corps')
                                    ->execute();
                            $ag = new Corps();
                            $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                            <tr style="cursor: pointer" ondblclick="chcorps('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

                                  <td style="width: 20%"><?php echo $i;?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                          $i++;  }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                     <a id="button_print" target="_blanc" href="<?php echo url_for('corps/ImprimerAlllistecorps') ?>" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermercorps()" >
                        Fermer</button>

                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chcorps(id,libelle)
    {    $('#my-modalcorps').removeClass('in');
         $('#my-modalcorps').css('display','none');
         $('#idcorps').val(id);
         $('#corps').val(libelle);
    }
     function fermercorps()
    {   $('#my-modalcorps').removeClass('in');
        $('#my-modalcorps').css('display', 'none');
    }
</script>


