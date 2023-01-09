<span class="titre_ordre_modal">Valider bordereau postal</span>
<?php if ($ordre_virement != null): ?>
<table id="form_ordre" class="table table-bordered table-hover">
        <tr>
            <td>
                <label>Ordre postal N° :</label>
                <input type="text" value="<?php echo $ordre_virement->getRepapier(); ?>" readonly="true" style="width: 100%;"/>
                <input type="hidden" id="id_papierordre" value="<?php echo $ordre_virement->getId(); ?>"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Cible :</label>
                <textarea id="cible_ordre" type="text" value="" maxlength="100" style="width: 100%; height: 55px;"/></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label>Objet :</label>
                <textarea id="objet_ordre" type="text" value="" maxlength="200" style="width: 100%; height: 95px;"/></textarea>
            </td>
        </tr>
    </table>
<?php else: ?>
<table id="form_ordre" class="table table-bordered table-hover">
        <tr>
            <td>
                <label>Pas d'ordre de virement disponible pour ce compte postal ! Veuillez vérifier le <a href="<?php echo url_for('@carnetordrepostal') ?>">carnet des virements postaux <i class="ace-icon fa fa-hand-o-left"></i></a>.</label>
                <script>$('.modal-footer').css('display', 'none');</script>
            </td>
        </tr>
    </table>
<?php endif; ?>

<script>

    $('input:text').addClass("class", "input-sm");

</script>

<style>

    .modal-dialog {width: 600px;}
    td > label{font-size: 18px;}
    .titre_ordre_modal{font-size: 16px; color: #2679b5;}
    #form_ordre{width: 90%; margin: 5% 5% 0% 5%;}
    #form_ordre tbody tr td{padding: 5px;}

</style>