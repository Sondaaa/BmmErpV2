<?php if ($agents->count() != 0): ?>
    <script type="text/javascript">
        $('#container_souscorps').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Statistique des Agents Par Sous Corps  :'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}% ({point.y} agents)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Statistique Par Sous Corps',
                    data: [
    <?php for ($i = 0; $i < sizeof($agents); $i++): ?>
                            ['Sous Corps :<?php echo $agents[$i]['souscorps'] ?>', <?php echo $agents[$i]['nbragents'] ?>],
    <?php endfor; ?>
                    ]
                }]
        });</script>
<?php else: ?>
    <table class="table table-bordered table-hover" id="tableBodyScroll">
        <tbody>
            <tr>
                <td  style="text-align: center; width: 100%; font-size: 16px; vertical-align: middle; padding-top: 37px; padding-bottom: 38px;">Pas d'enregistrement </td>
            </tr>
        </tbody>
    </table>
    <script  type="text/javascript">
        $('#container_souscorps').html('');
    </script>
<?php endif; ?>