<diV ng-controller="CtrlRessourcehumaine">
    <fieldset>
    <center><legend><i> مطلب إسترجاع مصاريف النقل إثر القيام بعيادة طبية </i></legend></center>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-12">
                <table>
                    <tr>
                        <td>Agents</td>
                        <td><?php echo $form['id_agents'] ?></td>
                        <td class="align_right"> إني الممضي أسفله </td>
                    </tr>
                    <tr>
                        <td>Poste</td>
                        <td> <?php echo $form['id_posterh'] ?></td>
                        <td class="align_right"> الخطة </td>
                    </tr>
                    <tr>
                        <td>Unité</td>
                        <td> <?php echo $form['id_unite'] ?></td>
                        <td class="align_right"> الادارة أو المصلحة أو الوحدة  </td>
                    </tr>
                    <tr>
                        <td>J'avoue que j'ai eu une clinique sur</td> 
                        <td><?php echo $form['date'] ?></td>
                        <td class="align_right"><span>أقر أني قمت بعيادة طبية يوم</span></td>     
                    <tr>
                        <td>Département</td>
                        <td><?php echo $form['bloc'] ?></td>
                        <td class="align_right">بقسم</span></td>
                    </tr>
                    <tr>
                        <td><span>De</span></td>
                        <td><?php echo $form['id_hopital'] ?></td> 
                        <td class="align_right"> ب</span></td>
                    </tr>
                    <tr><td style="text-align: center; font-size: 16px;" colspan="3">ولم أتحصل على شهادة حضور تثبت قيامي بالعيادة</td></tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <table>
                    <tr>
                        <td style="text-align: center">   
                            <h3 style="margin-top: 0px; font-weight: bold;">قرار السيد المدير العام  </h3>
                            <?php echo $form['observation'] ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <table class="pull-right">
                  
                     <tr>
                         <td style=" text-align: center;font-size: 14px">الإمضاء</td></tr>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form['chemin']->renderError() ?>
                            <?php echo $form['chemin'] ?>
                        </td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </fieldset>
</diV>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 16px;
    }

</style>
<script  type="text/javascript">
    $('#demandederemboursement_bloc').attr('style', 'width: 50px;');
    $('#demandederemboursement_signature').attr('style', 'width: 50px;');
</script>