<diV ng-controller="CtrlRessourcehumaine">
    <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
        <?php if ('NONE' != $fieldset): ?>
            <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
        <?php endif; ?>

        <center> <legend><i> مطلب إسترجاع مصاريف النقل إثر القيام بعيادة طبية </i></legend></center>
        
        <table style="width: 80%; margin-left: 40px">
            <tr><td>Agents</td>
                <td> <?php echo $form['id_agents'] ?>   
                </td>
                <td class="align_right"> إني الممضي أسفله 
                </td>
               
            </tr>
            
            <tr><td>Poste</td>
                <td> <?php echo $form['id_posterh'] ?>   
                </td>
                <td class="align_right"> الخطة 
                </td>
               
            </tr>
             <tr><td>Unite</td>
                <td> <?php echo $form['id_unite'] ?>   
                </td>
                <td class="align_right"> الادارة أو المصلحة أو الوحدة  
                </td>
               
            </tr>
       
            <tr> <td >
                   J'avoue que j'ai eu une clinique sur</td> 
             
                <td>   <?php echo $form['date']?> </td>
                <td class="align_right">أقر أني قمت بعيادة طبية يوم</span>  </td>     
           <tr>
            <td> Département</td>
            <td>     <?php echo $form['bloc']?></td>
            <td class="align_right">بقسم</span></td>
           
           </tr>
                <tr><td>
                <span>De</span> </td>
                    <td>  <?php echo $form['hopital'] ?></td> 
                    <td class="align_right"> ب</span></td>
            </tr>
            <tr>
                <td style="margin-left: 100px" colspan="3">ولم أتحصل على شهادة حضور تثبت قيامي بالعيادة</td> </tr>
        </table><br><br><br>
        <table style="width: 10%" class="pull-right" ><tr><td>الإمضاء</td><td><?php echo $form['signature'] ?></td></tr></table>
        <div></div><br><br>
        <table style="width: 60%;margin-left: 100px">
            <tr>
                <td rowspan="5">   
            <legend>
                <center>قرار السيد المدير العام  </cenetr>
            </legend>
       
        <br><br>
          
            <?php echo $form['observation'] ?>
        
        </td>
        </tr>
        </table>
    </fieldset>        
</diV>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }

</style>
<script  type="text/javascript">
 $('#demandederemboursement_bloc').attr('style', 'width: 50px;');
 $('#demandederemboursement_signature').attr('style', 'width: 50px;');
</script>