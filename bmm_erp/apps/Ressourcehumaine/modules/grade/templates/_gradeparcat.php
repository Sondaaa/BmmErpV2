<div id="my-modalgradeparcat" class="modal fade" tabindex="-1" >

<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
  <?php $cat = Doctrine_Core::getTable('categorierh')->findOneById($idd); ?>
                <h4 class="smaller lighter blue no-margin"> Liste des Grade relié au catégorie "<?php echo $cat->getLibelle(); ?>" </h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr>
                                   <th style="width: 20%">Numéro</th> 
                                <th>Libellé</th> 
                                
                                <th style="display: none">Code Grade</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('grade g , categorierh cat')
                                    ->where('g.id_categorie=cat.id')
                                    ->andWhere('cat.id='.$idd)
                                    ->execute();
                            $ag = new Grade();
                            $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                            <tr style="cursor: pointer" ondblclick="chgrade1('<?php echo $ag->getId(); ?>','<?php echo $ag->getLibelle(); ?>')">

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
                     <a id="button_print" target="_blanc" href="<?php echo url_for('grade/ImprimerAlllistegradeparcategorie?idcategorie=' .$idd) ?>" class="btn  btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermergrade1()" >
                        Fermer</button>

                </div>
            </div>


        </div>
    </div>
</div></div>
<script  type="text/javascript">$("table").addClass("table  table-bordered table-hover");
    function chgrade1(id,libelle)
    {    $('#my-modalgradeparcat').removeClass('in');
         $('#my-modalgradeparcat').css('display','none');
         $('#idgrade').val(id);
         $('#grade').val(libelle);
    }
     function fermergrade1()
    {  $('#my-modalgradeparcat').removeClass('in');
        $('#my-modalgradeparcat').css('display', 'none');
    }
</script>


