<td style="width:10%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <a target="_blank" id="btnimpexpo"  href="<?php echo url_for('documentachat/Showdocument?iddoc=') . $documentachat->getId() ?>"><i class="ace-icon fa fa-eye bigger-110"></i>Détails N°: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
                <li>
                    <a  target="_blank" id="btnimpexpo"  href="<?php echo url_for('documentachat/imprimerboncomande?iddoc=') . $documentachat->getId() ?>"> <i class="ace-icon fa fa-print bigger-110"></i>Imprimer D.I.: <?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
            <?php if ($documentachat->getIdEtatdoc() == 94) {?>
                    <li>
<a href="#my-modal_<?php echo $documentachat->getIdTypedoc() ?>_<?php echo $documentachat->getId() ?>"
                        role="button"  data-toggle="modal"><i class="fa fa-long-arrow-right"></i>
                        Valider <?php echo $documentachat->getNumerodocachat(); ?>
                            </a>
                    </li>
            <?php }?>
            <?php if ($documentachat->getIdEtatdoc() == 95) {?>
                    <li>

<a href="#my-modal_cheflabo_<?php echo $documentachat->getIdTypedoc() ?>_<?php echo $documentachat->getId() ?>"
                        role="button"  data-toggle="modal"><i class="fa fa-long-arrow-right"></i>Valider <?php echo $documentachat->getNumerodocachat(); ?>
                            </a>
                    </li>
            <?php }?>

<?php if ($id_valide != '1'): ?>
            <li>
                <a 
                onclick="document.location.href = '<?php echo url_for('documentachat/annuler') . '?iddoc=' . $documentachat->getId() ?>'"
                ><i class="fa fa-undo"></i>
                Annuler</button>
            </li>

<?php endif;?>
            </ul>
        </div>
    </div>
</td>
<?php
$numero = strtoupper($documentachat->getTypedoc());
$numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
?>
<div id="my-modal_<?php echo $documentachat->getIdTypedoc() ?>_<?php echo $documentachat->getId() ?>" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin"><?php echo $numero ?> <?php echo $documentachat ?></h3>
            </div>
            <div class="modal-body" style="width: 400px;heigth:200px" >
          Date Validation:  <input type="date" id="datevalidation">
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right"
                 style="margin-left:2px"  data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Fermer
                </button>
                <button class="btn btn-sm btn-success pull-right" data-dismiss="modal"
                 onclick="validerDocachat('<?php echo $documentachat->getId(); ?>')">
                <i class="ace-icon fa fa-save"></i>
                Valider
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div>

<div id="my-modal_cheflabo_<?php echo $documentachat->getIdTypedoc() ?>_<?php echo $documentachat->getId() ?>" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin"><?php echo $numero ?> <?php echo $documentachat ?></h3>
            </div>
            <div class="modal-body" style="width: 400px;heigth:200px" >
          Date Validation: 
           <input type="date" id="datevalidation_cheflabo">
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-right"
                 style="margin-left:2px"  data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Fermer
                </button>
                <button class="btn btn-sm btn-success pull-right" data-dismiss="modal"
                 onclick="validerDocachatCheflabo('<?php echo $documentachat->getId(); ?>')">
                <i class="ace-icon fa fa-save"></i>
                Valider
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div>
<script>

    function validerDocachat(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerbci'); ?>',
            data: 'id=' +id +'&date='+ $('#datevalidation').val() ,
            success: function (data) {
                bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Validation à partir du chef projet avec succées !!!</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
            document.location.reload();
            }
        });
    }


    function validerDocachatCheflabo(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerbcicheflabo'); ?>',
            data: 'id=' +id +'&date='+ $('#datevalidation_cheflabo').val() ,
            success: function (data) {
                bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Validation à partir  chef labo avec succées !!!</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
            document.location.reload();
            }
        });
    }
</script>