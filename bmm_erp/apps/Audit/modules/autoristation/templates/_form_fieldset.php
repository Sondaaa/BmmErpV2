<diV ng-controller="CtrlRessourcehumaine">
    <fieldset >

        <center> <legend><i> ترخيـص<br>
                    للقيام بعيادة طبية
                </i></legend></center>

        <table style="width: 80%; margin-left: 40px">
            <tr><td>Agents</td>
                <td> <?php echo $form['id_agents'] ?>   
                </td> <td><input type="text" data="fixed" id="idrh" placeholder="Matricule"></td>
                <td class="align_right"> يرخص للسيد(ة)،الآنسة
                </td>

            </tr>

            <tr><td>Hopital</td>
                <td> <?php echo $form['hopital'] ?>   
                </td>
                <td class="align_right" colspan="2"> للذهـاب إلـى 
                </td>

            </tr>
            <tr><td>Date</td>
                <td> <?php echo $form['date'] ?>   
                </td>
                <td class="align_right" colspan="2"> يـوم
                </td>

            </tr>

            <tr> <td>Par</td> 

                <td>   <?php echo $form['moyen'] ?> </td>
                <td class="align_right" colspan="2">بواسطــة  </td>     

            <tr><td>
                    <span>Pour Faire</span> </td>
                <td>  <?php echo $form['causedevisite'] ?></td> 
                <td class="align_right" colspan="2">للقيام بـ</td>
            </tr>
            <tr><td>
                    <span> Référence</span> </td>
                <td>  <?php echo $form['reference'] ?></td> 
                <td class="align_right" colspan="2"> المرجع</td>
            </tr>

        </table><br><br><br>
        <table style="width: 10%" class="pull-right" >
            <tr>
                <td colspan="2">إمضاء العون</td>
                <td><?php echo $form['signatureagents'] ?>
                </td>
            </tr>
        </table>




        <table style="width: 30%;"class="pull-left">
            <tr>
                <td colspan="2">إمضاء و ختم الرئيس المباشر</td>
                <td><?php echo $form['signatureagents'] ?>
                </td>
            </tr>

        </table><br>
        <center>
        <table style="width: 30%" >
            <tr>
                <td colspan="2">تأشيرة طبيب الفيلق الثاني <br>الترابي الصحراوي </td>
            </tr>
            <tr>
                <td><?php echo $form['visamedecin'] ?>
                </td>
            </tr>
        </table>
            </center>
        <br><br>
        <center>
            <table style="width: 60%" >
                <tr>
                    <td class="align_right"> قرار السيد المدير العام<br>
                        لديوان تنمية رجيم معتوق

                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['decision'] ?></td>
                </tr>
            </table>
        </center>
    </fieldset>        
</diV>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }

</style>
