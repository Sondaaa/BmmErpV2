<diV ng-controller="CtrlRessourcehumaine">
    <fieldset>

        <center> <legend><i> أمـر بمـهـمــة </i></legend></center>
        <div class="row">
            <div class="row col-md-10 col-md-offset-1">
                <table>
                    <tr>
                        <td style="width: 15%;">Agents / Ouvrier</td>
                        <td style="width: 70%;">
                            <?php echo $form['id_agents'] ?> 
                            <?php echo $form['id_ouvrier'] ?>
                        </td>
                        <td style="width: 15%;" class="align_right">(عامل) عيــن السيد</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center"><input type="text" data="fixed" id="matricule" placeholder="Matriculeرقم  "></td>
                        <td></td>
                    <tr>
                        <td colspan="3" style="text-align: center; font-size: 16px;">
                            التــابع لـديوان تنمية رجيم معتوق 
                        </td>
                    </tr>
                    <tr><td>Pour aller à</td>
                        <td><?php echo $form['id_lieu'] ?></td>
                        <td colspan="2" class="align_right"> للذهـاب إلى </td>
                    </tr>
                    <tr><td>Nombre de jour </td>
                        <td><?php echo $form['duree'] ?></td>
                        <td colspan="2" class="align_right"> يـوم</td>
                    </tr>
                    <tr>
                        <td>Date Sortie</td> 
                        <td><?php echo $form['datesortie'] ?></td>
                        <td colspan="2" class="align_right">تاريخ الخروج   </td>     
                    <tr>
                        <td>Par</td>
                        <td><?php echo $form['moyentransport'] ?></td>
                        <td colspan="2" class="align_right">بواسطــة       </span></td> 
                    </tr>
                    <tr>
                        <td><span>Pour effectuer une tâche</span></td>
                        <td><?php echo $form['mission'] ?></td> 
                        <td colspan="2" class="align_right">للقيــام بمهمـة </td>
                    </tr>
                    <tr>
                        <td><span>Référence</span></td>
                        <td><?php echo $form['reference'] ?></td> 
                        <td colspan="2" class="align_right"> المرجع </td>
                    </tr>
                    <tr>
                        <td><span>profiter le logement</span></td>
                        <td>  <?php echo $form['logenment'] ?></td> 
                        <td colspan="2" class="align_right"> يتمتع بالإقامة </td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-1"> 
                <table>
                    <tr>
                        <td  style="text-align: center; font-size: 16px"> العميد الحسين عبيدلي 
                            المكلف بتسيير ديوان تنمية رجيم معتوق
                        </td> 
                    </tr>
                    <tr>
                        <td><?php echo $form['cheminsignadaf'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <table>
                    <tr>
                        <td style="text-align: center; font-size: 16px">إمضاء وختم الرئيس المباشر     </td> 
                    </tr>
                    <tr>
                        <td><?php echo $form['cheminsigndirecteur'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">  
            <div class="row col-md-10 col-md-offset-1">
                <table>
                    <tr>
                        <td>Date & Heure Sortie </td>
                        <td>
                            <?php echo $form['datesortie'] ?>
                            <?php echo $form['heuresortie'] ?>
                        </td>
                        <td class="align_right">  تاريخ الخروج وساعة </td>
                    </tr>
                    <tr>
                        <td>Date & Heure Arrivé </td>
                        <td>
                            <?php echo $form['datearrive'] ?>
                            <?php echo $form['heurearrive'] ?>
                        </td>
                        <td class="align_right">  تاريخ العودة وساعة  </td>
                    </tr>
                </table>
            </div>
        </div> 
        <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <table>
                    <tr><td style="text-align: center ; font-size: 16px">إمضاء وختم الرئيس المباشر</td></tr>
                    <tr>
                        <td><?php echo $form['cheminsigndirecteur'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <table>
                    <tr><td style="text-align: center; font-size: 16px">إمضاء العون</td></tr>
                    <tr>
                        <td><?php echo $form['cheminsignagents'] ?></td>
                    </tr>
                </table> 
            </div>
        </div>
    </fieldset>        
</diV>
<?php if (!$form->getObject()->isNew()) { ?>
    <input type="hidden" id="moyendetransport" value="<?php echo trim($mission->getMoyentransport()) ?>">
    <input type="hidden" id="logenment" value="<?php echo trim($mission->getLogenment()) ?>">
<?php } ?>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }

</style>
<?php if (!$form->getObject()->isNew()): ?>
<script  type="text/javascript">
    $(document).ready(function () {
    $('#mission_moyentransport option').each(function () {
        if($(this).text().trim() == $('#moyendetransport').val().trim()){
            $(thi s).attr('selected', 'selected');
            }
        });

        $('#mission_logenment option[value=' + $('#logenment').val() + ']').attr('selected', 'selected');
        $('#mission_logenment').trigger("chosen:updated");
    })

</script>
<?php endif; ?>