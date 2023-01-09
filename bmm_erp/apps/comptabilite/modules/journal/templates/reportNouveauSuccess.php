<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Report à Nouveau 
        </small>
    </h1>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <table>
            <thead>
                <tr>
                    <th style="text-align:left; padding-left: 1%; width: 60%; font-weight: bold;">Report à nouveau dans le Journal Comptable (Exercice : <?php echo $_SESSION['exercice'] + 1; ?>)</th>
                    <th style="text-align:left; padding-left: 1%; width: 15%; font-weight: bold;">Date Pièce Comptable</th>
                    <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;"></th> 
                </tr>
            </thead>
            <tr>
                <td><?php //die($journalRan->count().'ffds');?>
                    <?php if ($journalRan->count() == 0): ?>
                        <select id="journal">
                            <option value=""></option>
                            <?php foreach ($journals as $journal): ?>
                                <option value="<?php echo $journal->getId() ?>"> <?php echo $journal->getCode() . ' - ' . $journal->getLibelle() ?> </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <?php $journalRan = $journalRan->getFirst() ?>
                        <input readonly="readonly" type="text" value="<?php echo $journalRan->getCode() . ' - ' . $journalRan->getLibelle() ?>"/>
                        <input id="journal" type="hidden" value="<?php echo $journalRan->getId() ?>">
                    <?php endif; ?>
                </td>
                <td>
                    <input class="disabledbutton" type="date" id="date" value="<?php echo $_SESSION['exercice'] + 1 . '-01-01'; ?>" /> 
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-xs btn-primary" style="min-width: 120px;" type="button" onclick="afficher()" /><i class="ace-icon fa fa-search"></i> Afficher les Soldes</button>
                </td>
            </tr>
        </table>
        <div class="mws-panel grid_8" id="liste_report" style="margin-top: 5px;">

        </div>
    </div>
</div>

<script  type="text/javascript">

    function afficher() {
        
        $('#liste_report').html('');
        $.ajax({
            url: '<?php echo url_for('journal/afficherReportNouveau') ?>',
            data: '',
            success: function (data) {
                $('#liste_report').html(data);
              
            }
        });
    }

    function saveReport() {
        if (champsObligatoires()) {
            $.ajax({
                url: '<?php echo url_for('journal/saveReportNouveau') ?>',
                data: 'journal=' + $('#journal').val() +
                        '&date=' + $('#date').val() +
                        '&total_debit=' + $('#total_debiteur').html().trim() +
                        '&total_credit=' + $('#total_crediteur').html().trim() +
                        '&compte=' + $('#compte').val(),
                success: function (data) {
                   console.log(data);
//                    
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;'> " + " Clôture avec succès !</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    location.reload();
                }
            });
        } else {
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'><u>Attention</u> !</span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez choisir le journal du pièce comptable contenant les écritures des soldes !</div>",
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
    
    function champsObligatoires() {
        var valide = true;

        if ($('#journal').val() !== '')
            $('#journal_chosen').css('border', '');
        else {
            $('#journal_chosen').css('border', '1px solid red');
            $('#journal_chosen').css('border-radius', '2px');
            valide = false;
        }

        return valide;
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Report à Nouveau");
</script>