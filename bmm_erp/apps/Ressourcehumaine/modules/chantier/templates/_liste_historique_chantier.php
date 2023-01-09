<table id="dynamic-table-chantier" class="dynamic-table table table-bordered table-hover" style="width: 100%">
    <thead>
        <tr> 
            <th style="width: 5%">#</th>  
            <th style="width: 20%">Matricule</th>  
            <th style="width: 40%">Ouvrier</th> 
            <th style="width: 20%">C.I.N</th>
            <th style="width: 15%">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $listes = Doctrine_Query::create()
                ->select("o.*")
                ->from('Ouvrier o')
                ->leftJoin('o.Contratouvrier c')
                ->leftJoin('c.Historiquecontratouvrier h')
                ->where('h.id_chantier = ' . $chantier->getId());

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        if ($id_ouvrier != '0'):
            $listes = $listes->andWhere('o.id = ' . $id_ouvrier);
        endif;
        
        $listes = $listes->execute();

        $ouvrier = new Ouvrier();
        $i = 1;
        foreach ($listes as $l) {
            $ouvrier = $l;
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo $ouvrier->getMatricule(); ?></td>
                <td><?php echo $ouvrier->getNom() . ' ' . $ouvrier->getPrenom(); ?></td>
                <td style="text-align: center;"><?php echo $ouvrier->getCin(); ?></td>
                <td style="text-align: center;">
                    <a target="_blanc" href="<?php echo url_for('chantier/ImprimerHistorique') . '?id_chantier=' . $chantier->getId() . '&id_ouvrier=' . $ouvrier->getId() . '&annee=' . $annee ?>" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-clock-o"></i> Historique</a>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var myTable =
                $('#dynamic-table-chantier')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({});
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        new $.fn.dataTable.Buttons(myTable, {
            buttons: [
                {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": 'pdfHtml5',
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    message: ''
                }
            ]
        });
        myTable.buttons().container().appendTo($('.tableTools-container'));
    });

    var url = "<?php echo url_for('chantier/ImprimerListe') . '?id=' . $chantier->getId() . '&id_ouvrier=' . $ouvrier->getId() . '&annee=' . $annee ?>";
    $('#btn_imprime_chantier').attr('href', url);
</script>