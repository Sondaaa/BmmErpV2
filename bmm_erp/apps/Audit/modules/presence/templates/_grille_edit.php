<?php
$query = " select  grillepresence.semaine as semaine,grillepresence.heuresupp as heuresupp"
         . ", grillepresence.id_motif as id_motif "
        . " ,CAST(coalesce(grillepresence.jour) AS integer) as jour "
       
//        . ",motif.code as code  "
        . " from grillepresence "
//        . ",motif"
        . " where grillepresence.id_presnece=" . $id
//        ."  and grillepresence.id_motif = motif.id or grillepresence.id_motif IS NULL"
//        . " ORDER BY jour ASC"
        ;
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$liste = $conn->fetchAssoc($query);
//print_r ($liste);
       
?>
<?php
$first_date = $annee . '-' . $mois . '-01';
//$first_date = '2019-04-01';
$jour_1 = date('D', strtotime($first_date));
$index = 0;
switch ($jour_1) {
    case 'Mon':
        $index = 1;
        $before_day = 0;
        $after_day = 0;
        break;

    case 'Tue':
        $index = 2;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    case 'Wed':
        $index = 3;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    case 'Thu':
        $index = 4;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    case 'Fri':
        $index = 5;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    case 'Sat':
        $index = 6;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    case 'Sun':
        $index = 7;
        $before_day = $index - 1;
        $after_day = 8 - $index;
        break;

    default :
        $index = 0;
        break;
}
?>

<div class="col-xs-12" >
    <table class="table table-bordered table-hover">
        <thead>
            <tr style="font-weight: bold; background-color: #ECECEC;">
                <td style="width: 15%;">
                    Mois : <?php
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                    echo strftime('%B', strtotime($first_date)) . ' ' . $annee;
                    ?>
                </td>
                <td style="width: 10%;">Lundi</td>
                <td style="width: 10%;">Mardi</td>
                <td style="width: 10%;">Mercredi</td>
                <td style="width: 10%;">Jeudi</td>
                <td style="width: 10%;">Vendredi</td>
                <td style="width: 10%;">Samedi</td>
                <td style="width: 10%;">Dimanche</td>
                <td style="width: 15%;">T.H.Hebdo.</td>
            </tr>
        </thead>
        <tbody>
            <?php $m = 0; ?>
            <?php $j = 0; ?>
            <?php $id_semaine = 1; ?>
            <?php for ($i = 1; $i <= date('t'); $i++): ?>
                <?php
                $modulo_after = $after_day + 1;
                if ($modulo_after == 7)
                    $modulo_after = 0;
                ?>
                <?php if ($i % 7 == $modulo_after || $i == 1): ?>
                    <?php $m = 0; ?>
                    <tr>
                        <td>
                            <div style="margin-bottom: 7px;"><i class="ace-icon fa fa-calendar bigger-110 green"></i> Jour</div>
                            <div style="margin-bottom: 9px;">Semaine N°<?php echo $id_semaine ?></div>
                            <div>H.Sup.</div>
                        </td>
                        <?php if ($i == 1): ?>
                            <?php for ($k = 0; $k < $before_day; $k++): ?>
                                <td style="background-color: #ececec;"></td>
                            <?php endfor; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <td  style="text-align: center">
                        <span style="float: left;"><i class="ace-icon fa fa-calendar bigger-110 green"></i> <?php echo $i; ?></span>
                        <input name="jour_heure" type="hidden" value="<?php echo $i; ?>">
                        <?php
                        if ($i < 10)
                            $jour_courant = '0' . $i;
                        else
                            $jour_courant = $i;
                        $first_date = $annee . '-' . $mois . '-' . $jour_courant;
                        $nom_jour_courant = date('D', strtotime($first_date));
                        ?>
                        <?php if ($nom_jour_courant == 'Sat' || $nom_jour_courant == 'Sun'): ?>
                            <span    type="text" id="codemotif_<?php echo $i; ?>" >     
                            </span>
                            <input  name='jour_motif' type="hidden" id="idmotif_<?php echo $i; ?>">
                            <input class="grille_presence_input" name="semaine_heure" type="text" id="s_<?php echo $i; ?>" value="" readonly="true"/>
                            <input class="grille_presence_input" name="heur_supp" type="text" id="h_<?php echo $i; ?>" value="" readonly="true"/>
                        <?php else: ?>
                            <span    type="text" id="codemotif_<?php echo $i; ?>" style="cursor: pointer ; color: #0066cc"  onclick="testerabsence('<?php echo $i ?>', '<?php echo $mois ?>', '<?php echo $annee ?>')" >
                                <?php  $id_motif = $liste[$i - 1]['id_motif'] ?>
                            
                                  <?php if($id_motif!=''):
                               $l = Doctrine_Core::getTable('motif')->findOneById($id_motif);?>
                                <?php  echo $l->getCode(); ?>
                                <?php endif; ?>
                            </span>
                          
                            <input  name='jour_motif' type="hidden" id="idmotif_<?php echo $i; ?>">

                            <input class="grille_presence_input" name="semaine_heure" type="text" type_input="heure_<?php echo $id_semaine ?>" semaine="<?php echo $id_semaine ?>" id="s_<?php echo $i; ?>" value="<?php echo trim($liste[$i - 1]['semaine']) ?>" onkeyup="CalculTotal('<?php echo $id_semaine ?>')" onchange="testerabsence('<?php echo $i ?>', '<?php echo $mois ?>', '<?php echo $annee ?>')"/>
                            <input class="grille_presence_input" name="heur_supp" type="text" type_input="supp_<?php echo $id_semaine ?>" semaine="<?php echo $id_semaine ?>" id="h_<?php echo $i; ?>" value="<?php echo trim($liste[$i - 1]['heuresupp']) ?>" onkeyup="CalculTotalHsup('<?php echo $id_semaine ?>')"/>
                        <?php endif; ?>
                    </td>
                    <?php $j++; ?>
                    <?php $m++; ?>
                    <?php if ($i % 7 == $after_day || $j == $after_day): ?>
                        <td>
                            Total Semaine N°<?php echo $id_semaine ?>
                            <input name="total_heure" type="text" id="total_heure_<?php echo $id_semaine ?>" value="" />
                            <input name="total_sup" type="text" id="total_sup_<?php echo $id_semaine ?>" value="" />
                        </td>
                        <?php $id_semaine++; ?>
                    </tr>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($m < 8): ?>  
                <?php while ($m < 7): ?>
                <td style="background-color: #ececec;"></td>
                <?php $m++; ?>
            <?php endwhile; ?>
            <td>
                Total Semaine N°<?php echo $id_semaine ?>
                <input name="total_heure" type="text" id="total_heure_<?php echo $id_semaine ?>" value="" />
                <input name="total_sup" type="text" id="total_sup_<?php echo $id_semaine ?>" value="" />
            </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div>
        <table class="table table-bordered table-hover">
            <tr>
                <td style="width: 50%"></td>
                <td style="width: 35%">
                    <?php
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                    echo strftime('%B', strtotime($first_date)) . ' ' . $annee;
                    ?> : Total d'heures norm.</td>
                <td style="width: 15%">
                    <input type="text" id="total_heure_normal" value="" />
                </td>
            </tr>
            <tr>
                <td style="width: 50%"></td>
                <td style="width: 35%">
                    <?php
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                    echo strftime('%B', strtotime($first_date)) . ' ' . $annee;
                    ?> : Total d'heures supp. 
                </td>
                <td style="width: 15%">
                    <input type="text" id="total_heure_supp" value="" />
                </td>
            </tr>
        </table>
    </div>
</div>


<script>
    function testerabsence(i, mois, annee) {

        if (($("#s_" + i).val() == '') || ($("#s_" + i).val() == '0')) {
            $('#h_' + i).addClass("disabledbutton");

            $.ajax({
                url: '<?php echo url_for('presence/choisirmotif') ?>',
                data: 'id=' + i + '&mois=' + mois + '&annee=' + annee,
                success: function (data) {
                    bootbox.confirm({
                        message: data,
                        buttons: {
                            cancel: {
                                label: "Annuler",
                                className: "btn-sm",
                            },
                            confirm: {
                                label: "Valider",
                                className: "btn-primary btn-sm",
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                chargerCodeMotif(i);
                            }
                        }
                    });
                }
            });
        }
        else {

            $('#h_' + i).removeClass("disabledbutton");
        }

    }
    //affiche code 
    function chargerCodeMotif(id) {
        var code = $('#motif_absence option:selected').attr('value_code');
        $('#codemotif_' + id).html(code);
        $('#idmotif_' + id).val($('#motif_absence').val());
    }


//    
    function CalculTotal(i) {
        var total = 0;
        var type_input = "heure_" + i;
        $('[type_input="' + type_input + '"]').each(function () {
            if ($(this).val() != '') {
                var value = $(this).val();
            } else {
                var value = 0;
            }
            total = parseInt(total) + parseInt(value);
        });
        $('#total_heure_' + i).val(parseInt(total));
        calcultotalhmois();
    }
    function CalculTotalHsup(i) {
        var total = 0;
        var type_input = "supp_" + i;
        $('[type_input="' + type_input + '"]').each(function () {
            if ($(this).val() != '') {
                var value = $(this).val();
            } else {
                value = 0;
            }
            total = parseInt(total) + parseInt(value);
        });
        $('#total_sup_' + i).val(parseInt(total));
//       
        calcultotalheuresuppmois();
    }
    function calcultotalhmois() {
        var tot = 0;
        for (var j = 1; j <= 5; j++)
        {
            var nbrh = $("#total_heure_" + j).val();
            tot = parseFloat(tot) + parseFloat(nbrh);
        }
        $('#total_heure_normal').val(tot);
    }
    function calcultotalheuresuppmois() {
        var tot = 0;
        for (var j = 1; j <= 5; j++)
        {
            if ($("#total_sup_" + j).val() != "")
            {
                var nbrh = $("#total_sup_" + j).val();
            }
            else
                nbrh = 0;
            tot = parseFloat(tot) + parseFloat(nbrh);
        }
        $('#total_heure_supp').val(tot);
    }
    function IntitialiserGrille() {
        if ($('#presence_mois').val() != '' && $('#presence_annee').val() != '') {
            $.ajax({
                url: '<?php echo url_for('presence/affichegrilleedit') ?>',
                data: 'idpresence_mois=' + $('#presence_mois').val() + '&idpresence_annee=' + $('#presence_annee').val() + '&id=' + $('#id').val(),
                success: function (data) {
                    $('#grille_edit').html(data);
                }
            });
        }

    }

    for (var i = 1; i <= 5; i++)
    {
        CalculTotal(i);
//        CalculTotalHsup(i);
    }
    for (var i = 1; i <= 5; i++)
    {
        CalculTotalHsup(i);
    }
</script>

<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

    .grille_presence_input{max-width: 100px;}
    .grille_input{max-width: 50px;}

</style>