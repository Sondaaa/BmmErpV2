<?php $id_user=  $sf_user->getAttribute('userB2m')->getId();?>
<div id="sf_admin_container">
    <h1 id="replacediv"> Engagements Budget 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Récapitulatif des Dépenses - Fin du Mois
        </small>
    </h1>
    <div class="panel-body">
        <div class="row">
            <table>
                <tr>
                    <td style="vertical-align: middle; font-weight: bold; width: 50%;">Budget : 
                        <?php $titre_budgets = TitrebudjetTable::getInstance()->getByExerciceAndUser($_SESSION['exercice_budget'],$id_user); ?>
                        <select id="titre">
                            <option value="0"></option>
                            <?php foreach ($titre_budgets as $titre_budget): ?>
                                <option value="<?php echo $titre_budget->getId(); ?>"><?php echo $titre_budget; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td style="vertical-align: middle; font-weight: bold; width: 30%;">Jusqu'au Mois :
                        <select id="mois">
                            <option value="0"></option>
                            <option value="1">Janvier ( 31/01/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="2">Février ( <?php echo date('t/m/Y', strtotime($_SESSION['exercice_budget'] . '-02-01')); ?> )</option>
                            <option value="3">Mars ( 31/03/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="4">Avril ( 30/04/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="5">Mai ( 31/05/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="6">Juin ( 30/06/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="7">Juillet ( 31/07/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="8">Août ( 31/01/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="9">Septembre ( 30/09/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="10">Octobre ( 31/10/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="11">Novembre ( 30/11/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                            <option value="12">Décembre ( 31/12/<?php echo $_SESSION['exercice_budget'] ?> )</option>
                        </select>
                    </td>
                    <td style="vertical-align: middle; text-align: center; width: 20%;">
                        <button onclick="afficher()" class="btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-search bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Afficher</span>
                        </button>
                    </td>
                </tr> 
            </table>
        </div>
    </div>
</div>

<div class="row" id="etat_recap">

</div>

<script  type="text/javascript">

    function afficher() {
        if ($('#mois').val() != '0' && $('#titre').val() != '0') {
            $.ajax({
                url: '<?php echo url_for('titrebudjet/afficherEtatRecapDepense') ?>',
                data: 'mois=' + $('#mois').val() +
                        '&titre=' + $('#titre').val() +
                        '&annee=' + "<?php echo $_SESSION['exercice_budget']; ?>",
                success: function (data) {
                    $('#etat_recap').html(data);
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31515;'>Veuillez choisir le budget et/ou le mois !</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

<?php if ($_SESSION['exercice_budget'] >= date('Y')): ?>
        $(document).ready(function () {
            initialise();
        });
<?php endif; ?>

    function initialise() {
        var mois_courant = '<?php echo intval(date('m')); ?>';
        $('#mois > option').each(function () {
            if (parseInt($(this).val()) > parseInt(mois_courant)) {
                $(this).remove();
            }
        });
    }

</script>