<script>
    $('#clendrier_zone').html(calendrier(<?php echo $mois ?>, <?php echo $annee ?>));
<?php
for ($i = 0; $i < sizeof($listedocs); $i++):
    $j = $i + 1;
    $nbrjr = 0;
    ?>
        $('#nbrheur_' + <?php echo $j; ?>).html('<?php echo $listedocs[$i]['nbrheuret'] ?>');
    <?php if ($listedocs[$i]['jourrepos'] == "true"): ?>
            $('#jr_<?php echo $j; ?>').prop('checked', 'true');
        <?php $nbrjr++; ?>
    <?php endif; ?>
<?php endfor; ?>
<?php if (sizeof($listejourferie) > 0): ?>
    <?php for ($i = 0; $i < sizeof($listejourferie); $i++): ?>
            $('#jour_ferier').val('<?php echo $listejourferie[$i]['nbrjourferier']; ?>');
            $("#m_<?php echo date('j', strtotime($listejourferie[$i]['jourf'])) ?>").attr('bgcolor', '#FFA500');
        <?php
        $first_date = $listejourferie[$i]['jourf'];
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
            var nbrh = $('#nbrheur_' + <?php echo $index; ?>).html();
            var nbrjourfe = $('#jour_ferier').val();
            var nbrheureferier = parseFloat(parseFloat(nbrjourfe) * parseFloat(nbrh));
            $('#heure_ferie').val(nbrheureferier);
        <?php $nbrjTottalmois = date('t', strtotime($annee . '-' . $mois . '-01')); ?>
            var nbrjmois = '<?php echo $nbrjTottalmois; ?>';
            var nbrjtravalille = parseFloat(parseFloat(nbrjmois) - parseFloat(nbrjourfe));
            $('#jour_travail').val(nbrjtravalille);


        <?php
        $nbr = 0;
        $nbrjlundi = 0;
        $nbrjmardi = 0;
        $nbrjmercredi = 0;
        $nbrjjeudi = 0;
        $nbrjvendredi = 0;
        $nbrjsamedi = 0;
        ?>
        <?php
        for ($i = 1; $i <= $nbrjTottalmois; $i++) {
            if ($i < 10)
                $jour_courant = '0' . $i;
            else
                $jour_courant = $i;
            $first_date = $annee . '-' . $mois . '-' . $jour_courant;
            $nom_jour_courant = date('D', strtotime($first_date));

            if ($nbrjr == 1) {
                if ($nom_jour_courant == 'Sun') {
                    $nbr = $nbr + 1;
                }
            } elseif ($nbrjr == 2) {
                if ($nom_jour_courant == 'Sat' || $nom_jour_courant == 'Sun') {
                    $nbr = $nbr + 1;
                }
            }
            //nbr jour de lundi 
            if ($nom_jour_courant == 'Mon') {
                $nbrjlundi = $nbrjlundi + 1;
            }
            if ($nom_jour_courant == 'Tue') {
                $nbrjmardi = $nbrjmardi + 1;
            }
            if ($nom_jour_courant == 'Wed') {
                $nbrjmercredi = $nbrjmercredi + 1;
            }
            if ($nom_jour_courant == 'Thu') {
                $nbrjjeudi = $nbrjjeudi + 1;
            }
            if ($nom_jour_courant == 'Fri') {
                $nbrjvendredi = $nbrjvendredi + 1;
            }
            if ($nom_jour_courant == 'Sat') {
                $nbrjsamedi = $nbrjsamedi + 1;
            }
        }
        ?>
            var nbrjtravalille = nbrjtravalille - parseFloat('<?php echo $nbr; ?>');
            $('#jour_travail').val(nbrjtravalille);
            $('#jour_moyen').val(nbrjtravalille);
            var nbrjlundi = '<?php echo $nbrjlundi; ?>';
            var nbrhlundi = $('#nbrheur_1').html();
            var nbrjmardi = '<?php echo $nbrjmardi; ?>';
            var nbrhmardi = $('#nbrheur_2').html();
            var nbrjmercredi = '<?php echo $nbrjmercredi; ?>';
            var nbrhmercredi = $('#nbrheur_3').html();
            var nbrjjeudi = '<?php echo $nbrjjeudi; ?>';
            var nbrhjeudi = $('#nbrheur_4').html();
            var nbrjvendredi = '<?php echo $nbrjvendredi; ?>';
            var nbrhvendredi = $('#nbrheur_5').html();
            var nbrjsamedi = '<?php echo $nbrjsamedi; ?>';
            var nbrhsamdi = $('#nbrheur_6').html();
            var nbrheurelundi = parseFloat(nbrjlundi * nbrhlundi);
            var nbrheuremardi = parseFloat(nbrjmardi * nbrhmardi);
            var nbrheuremercredi = parseFloat(nbrjmercredi * nbrhmercredi);
            var nbrheurejeudi = parseFloat(nbrjjeudi * nbrhjeudi);
            var nbrheurevendredi = parseFloat(nbrjvendredi * nbrhvendredi);
            var nbrheuresamdi = parseFloat(nbrjsamedi * nbrhsamdi);
            var nbrtotal = parseFloat(nbrheurelundi + nbrheuremardi + nbrheuremercredi + nbrheurejeudi + nbrheurevendredi + nbrheuresamdi - nbrheureferier);
            $('#heure_travail').val(nbrtotal);
            var nbrheure = parseFloat(parseFloat(nbrhlundi) + parseFloat(nbrhmardi) + parseFloat(nbrhmercredi) + parseFloat(nbrhjeudi) + parseFloat(nbrhvendredi) + parseFloat(nbrhsamdi));
            var nbr_moyen = parseFloat(parseFloat(nbrheure) / parseFloat(6)).toFixed(3);
            var nbrtotal_moyen = parseFloat(parseFloat(nbr_moyen) * parseFloat(nbrjtravalille)).toFixed(3);
            $('#heure_moyen').val(nbrtotal_moyen);


    <?php endfor; ?>
<?php endif; ?>
<?php if (sizeof($listejourferie) == 0): ?>
    <?php $nbrjTottalmois = date('t', strtotime($annee . '-' . $mois . '-01')); ?>
    <?php
    for ($i = 1; $i <= $nbrjTottalmois; $i++) {
        if ($i < 10)
            $jour_courant = '0' . $i;
        else
            $jour_courant = $i;
        $first_date = $annee . '-' . $mois . '-' . $jour_courant;
        $nom_jour_courant = date('D', strtotime($first_date));

        if ($nbrjr == 1) {
            if ($nom_jour_courant == 'Sun') {
                $nbr = $nbr + 1;
            }
        } elseif ($nbrjr == 2) {
            if ($nom_jour_courant == 'Sat' || $nom_jour_courant == 'Sun') {
                $nbr = $nbr + 1;
            }
        }
        //nbr jour de lundi 
        if ($nom_jour_courant == 'Mon') {
            $nbrjlundi = $nbrjlundi + 1;
        }
        if ($nom_jour_courant == 'Tue') {
            $nbrjmardi = $nbrjmardi + 1;
        }
        if ($nom_jour_courant == 'Wed') {
            $nbrjmercredi = $nbrjmercredi + 1;
        }
        if ($nom_jour_courant == 'Thu') {
            $nbrjjeudi = $nbrjjeudi + 1;
        }
        if ($nom_jour_courant == 'Fri') {
            $nbrjvendredi = $nbrjvendredi + 1;
        }
        if ($nom_jour_courant == 'Sat') {
            $nbrjsamedi = $nbrjsamedi + 1;
        }
    }
    ?>
        $('#nbr').val('<?php echo $nbr; ?>');
        var nbrjourfe = 0;
    <?php $nbrjTottalmois = date('t', strtotime($annee . '-' . $mois . '-01')); ?>
        var nbrjmois = '<?php echo $nbrjTottalmois; ?>';
        var nbrjtravalille = parseFloat(parseFloat(nbrjmois) - parseFloat(nbrjourfe));
        var nbr = $('#nbr').val();
        var nbrjtravalille = nbrjtravalille - parseFloat(nbr);
        $('#jour_travail').val(nbrjtravalille);
        $('#jour_moyen').val(nbrjtravalille);
        var nbrjlundi = '<?php echo $nbrjlundi; ?>';
        var nbrhlundi = $('#nbrheur_1').html();
        var nbrjmardi = '<?php echo $nbrjmardi; ?>';
        var nbrhmardi = $('#nbrheur_2').html();
        var nbrjmercredi = '<?php echo $nbrjmercredi; ?>';
        var nbrhmercredi = $('#nbrheur_3').html();
        var nbrjjeudi = '<?php echo $nbrjjeudi; ?>';
        var nbrhjeudi = $('#nbrheur_4').html();
        var nbrjvendredi = '<?php echo $nbrjvendredi; ?>';
        var nbrhvendredi = $('#nbrheur_5').html();
        var nbrjsamedi = '<?php echo $nbrjsamedi; ?>';
        var nbrhsamdi = $('#nbrheur_6').html();
        var nbrheurelundi = parseFloat(nbrjlundi * nbrhlundi);
        var nbrheuremardi = parseFloat(nbrjmardi * nbrhmardi);
        var nbrheuremercredi = parseFloat(nbrjmercredi * nbrhmercredi);
        var nbrheurejeudi = parseFloat(nbrjjeudi * nbrhjeudi);
        var nbrheurevendredi = parseFloat(nbrjvendredi * nbrhvendredi);
        var nbrheuresamdi = parseFloat(nbrjsamedi * nbrhsamdi);
        var nbrtotal = parseFloat(nbrheurelundi + nbrheuremardi + nbrheuremercredi + nbrheurejeudi + nbrheurevendredi + nbrheuresamdi );
        $('#heure_travail').val(nbrtotal);
        var nbrheure = parseFloat(parseFloat(nbrhlundi) + parseFloat(nbrhmardi) + parseFloat(nbrhmercredi) + parseFloat(nbrhjeudi) + parseFloat(nbrhvendredi) + parseFloat(nbrhsamdi));
        var nbr_moyen = parseFloat(parseFloat(nbrheure) / parseFloat(6)).toFixed(3);
        var nbrtotal_moyen = parseFloat(parseFloat(nbr_moyen) * parseFloat(nbrjtravalille)).toFixed(3);
        $('#heure_moyen').val(nbrtotal_moyen);
        $('#heure_ferie').val('0');
        $('#jour_ferier').val('0');
<?php endif; ?>
</script>