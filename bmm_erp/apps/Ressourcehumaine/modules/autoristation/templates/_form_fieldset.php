<div ng-controller="CtrlRessourcehumaine">
    <fieldset>
        <center><legend style="font-size: 24px"><i> ترخيـص<br> للقيام بعيادة طبية</i></legend></center>
        <?php if (!$form->getObject()->isNew()) { ?>
            <input type="hidden" id="moyendetransport" value="<?php echo trim($autoristation->getMoyen()) ?>">
        <?php } ?> 
        <div class="row col-md-12">
            <table>
                <tr>
                    <td>Agents</td>
                    <td><?php echo $form['id_agents'] ?></td>
                    <td><input type="text" data="fixed" id="idrh" placeholder="Matricule" readonly="true"></td>
                    <td class="align_right"> يرخص للسيد(ة)،الآنسة</td>
                </tr>
                <tr>
                    <td>Hopital</td>
                    <td> <?php echo $form['id_hopital'] ?></td>
                    <td class="align_right" colspan="2"> للذهـاب إلـى </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td> <?php echo $form['date'] ?></td>
                    <td class="align_right" colspan="2"> يـوم</td>
                </tr>
                <tr>
                    <td>Par</td> 
                    <td><?php echo $form['moyen'] ?> </td>
                    <td class="align_right" colspan="2">بواسطــة  </td>
                </tr>
                <tr>
                    <td><span>Pour Faire</span></td>
                    <td><?php echo $form['causedevisite'] ?></td> 
                    <td class="align_right" colspan="2">للقيام بـ</td>
                </tr>
                <tr>
                    <td><span> Référence</span> </td>
                    <td><?php echo $form['reference'] ?></td> 
                    <td class="align_right" colspan="2"> المرجع</td>
                </tr>
            </table>
            </br></br>
        </div>

        <div class="row col-md-12">
            <div class="col-md-4">
                <table>
                    <tr><td style="text-align: center; font-size: 20px">إمضاء العون</td></tr>
                    <tr><td><?php echo $form['cheminsignagents'] ?></td></tr>
                </table>
            </div>
            <div class="col-md-4">
                <table>
                    <tr>
                        <td style="text-align: center; font-size: 20px">تأشيرة طبيب الفيلق الثاني الترابي الصحراوي </td>
                    </tr>
                    <tr><td><?php echo $form['cheminmedecin'] ?></td></tr>
                </table>
            </div>
            <div class="col-md-4">
                <table>
                    <tr>
                        <td style="text-align: center; font-size: 20px">إمضاء و ختم الرئيس المباشر</td></tr>
                    <tr><td><?php echo $form['cheminsigndirecteur'] ?></td></tr>
                </table>
                <br><br>
            </div>
        </div>
        <div class="row col-md-12">
            <table>
                <tr>
                    <td style="text-align: center ;font-size: 20px"> قرار السيد المدير العام
                        لديوان تنمية رجيم معتوق
                    </td>
                </tr>
                <tr><td class="align_right"><?php echo $form['decision'] ?></td></tr>
            </table>
        </div>
    </fieldset>        
</div>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 16px;
    }

</style>

<script  type="text/javascript">
    $('#autoristation_decision').addClass('align_right');
</script>
<?php if (!$form->getObject()->isNew()): ?>
<script  type="text/javascript">
    
    $(document).ready(function () {
        $('#autoristation_moyen option').each(function () {
            if ($(this).text().trim() == $('#moyendetransport').val().trim()) {
                $(this).attr('selected', 'selected');
            }
        });
    })

</script>
<?php endif; ?>