<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Fonctions</h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr>  <th style="width: 20%">Numéro</th> 
                                 
                                <th>Libellé</th> 
                                
                                <th style="display: none">Code Fonction</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('fonction')
                                    ->execute();
                            $ag = new Fonction();
                            $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr ondblclick="chfonction('<?php echo $ag->getId(); ?>','<?php echo $ag->getDescription(); ?>')">

                                  <td style="width: 20%"><?php echo $i; ?> </td>
                                    <td><?php echo $ag->getDescription(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                         $i++;   }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                   <a id="button_print" target="_blanc" href="<?php echo url_for('fonction/ImprimerAllliste') ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                  </a>
                    <button class="btn btn-sm  pull-left" onclick="fermerfonction()" >

                        Fermer
                    </button>

                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
      $("table").addClass("table  table-bordered table-hover");
    function chfonction(id,libelle)
    {  $('#my-modalfonction').removeClass('in');
         $('#my-modalfonction').css('display','none');
         $('#idfonction').val(id);
        $('#liebllefonction').val(libelle);
       

    }
    
function fermerfonction()
    {
         $('#my-modalfonction').removeClass('in');
         $('#my-modalfonction').css('display','none');
    }
</script>


