<div id="my-modalcatparcorps" class="modal fade" tabindex="-1">
    <div id="sf_admin_container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $corps = Doctrine_Core::getTable('corps')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Catégories du Corps des "<?php echo $corps->getLibelle(); ?> "  </h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table" dynamic-table style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Numéro</th>  
                                    <th>Libellé</th> 
                                    <th style="display: none">Code Catégorie</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('categorierh cat , corps c')
                                        ->where('cat.id_corps=c.id')
                                        ->andwhere('c.id=' . $idd)
                                        ->execute();
                                $ag = new CategorieRH();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer" ondblclick="checat2('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('categorierh/ImprimerAlllisteCatparcorps?idcorps=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn pull-left" onclick="fermercat2()">
                            Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function checat2(id, libelle)
    {
        $('#my-modalcatparcorps').removeClass('in');
        $('#my-modalcatparcorps').css('display', 'none');
        $('#idcategorie').val(id);
        $('#categorie').val(libelle);
    }
    function fermercat2()
    {

        $('#my-modalcatparcorps ').removeClass('in');
        $('#my-modalcatparcorps ').css('display', 'none');

    }

</script>