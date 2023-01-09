<diV ng-controller="CtrlRessourcehumaine">
    <fieldset class="col-lg-12">
        <center><legend><i>استمــارة فــرديـة للإرتقــاء إلـى رتبــة  </i></legend></center>
        <?php if (!$form->getObject()->isNew()) { ?>
            <input type="hidden" id="etat" value="<?php echo trim($formulaire->getEtat()) ?>">
        <?php } ?>
        <table>
            <tr>
                <td>
                    Agents
                    <?php echo $form['id_agents'] ?>   
                </td>
                <td>
                    <input data="fixed" type="text" id="prenom" placeholder="Prénom">   
                    <input data="fixed" type="text" id="nom" placeholder="Nom">   
                </td>
                <td class="align_right"> الاسم واللقب </td>
                <td>Date naissance et lieu </td>
                <td>
                    <input data="fixed" type="text" id="date" placeholder="Date de naissance">   
                    <input data="fixed" type="text" id="lieunais" placeholder="Lieu de naissance">   
                </td>
                <td class="align_right"> تاريخ الولادة و مكانها </td>
            </tr>
            <tr>
                <td>Identifiant unique</td> 
                <td><input data="fixed" type="text" id="identifiantunique" placeholder="Identifiant Unique"></td>
                <td class="align_right">المعرف الوحيد </span>  </td>     
                <td> Grade Actuelle</td>
                <td><input data="fixed" type="text" id="gradea" placeholder="Grade Actuelle"></td>
                <td class="align_right">الرتبة الحالية </span></td>
            </tr>
            <tr>
                <td><span>Echelon</span></td>
                <td><input data="fixed" type="text" id="echelon_2" placeholder="Echelon">   
                </td>  
                <td class="align_right"> الدرجة </td>
                <td><span>Corps</span></td>
                <td><input data="fixed" type="text" id="corps_2" placeholder="Corps"></td>  
                <td class="align_right"> السلم </td>
            </tr>
            <tr>
                <td>Lieu d'Affectation</td>
                <td><input data="fixed" type="text" id="lieutravail" placeholder="Lieu de Travail"></td>
                <td>مكان التعيين </td>
                <td>Ancienneté dans l'echelon</td>
                <td><input data="fixed" type="text" id="anciente" placeholder="Ancienneté dans le grade"></td>
                <td>الأقدمية بالدرجة </td>
            </tr>
            <tr>
                <td>
                    Ancienneté dans le grade actuelle <input data="fixed" type="hidden" id="dategrade">
                </td>
                <td><input data="fixed" type="text" id="ancientegradea" placeholder="Ancienneté dans le grade actuelle"></td>
                <td> الأقدمية بالرتبة الحالية </td>
                <td>Date d'entré dans l'administration </td>
                <td><input data="fixed" type="text" id="dateen" placeholder="Date d'entré dans l'administration"></td>
                <td> تاريخ الدخول إلى الإدارة </td>
            </tr>
            <tr>
                <td>Etat </td>
                <td><?php echo $form['etat'] ?></td>
                <td> الحالات  </td>
            </tr>
        </table>
        <div style="margin-right: 10%; padding-top: 7px; padding-bottom: 7px; font-size: 14px; text-align: right;">   (1) الأعداد المهنية للثلاث سنوات الأخيرة السابقة للسنة التي أعدت بعنوان قائمة الكفاءة  (I</div>
        <table>
            <tr><th class="align_right">المعــدل</th>
                <th class="align_right">المجمــوع</th>
                <th class="align_right">19</th>
                <th class="align_right">19</th>
                <th class="align_right">19</th>
            </tr>
            <tr> <td class="align_right"><?php echo $form['mayen'] ?></td>
                <td class="align_right"><?php echo $form['total'] ?></td>
                <td class="align_right"><?php echo $form['note3'] ?></td>
                <td class="align_right"><?php echo $form['note2'] ?></td>
                <td class="align_right"><?php echo $form['note1'] ?></td>
            </tr>
        </table>

        <div style="margin-right: 10%; padding-top: 7px; padding-bottom: 7px; font-size: 14px; text-align: right;">   (1) مراحل التكوين التي تابعها الموظف في الرتبة التي دون رتبة الإرتقاء مباشرة    (II </div>
        <table>
            <tr>
                <th class="align_right">م1+م2 II المجموع</th> 
                <th class="align_right">(م2)النقاط المطابقة لعدد الأيام </th>
                <th class="align_right">(م1)النقاط المطابقة لعدد الأشهر</th> 
                <th class="align_right">مدة المرحلة</th> 
            </tr>
            <tr><td class="align_right" ><?php echo $form['totalpoint'] ?></td>
                <td class="align_right">X نقطة1/300<?php echo $form['nbrponitsjour'] ?></td>
                <td class="align_right">
                    Xنقطة 0.1 <?php echo $form['nbpointmois'] ?></td>
                <td class="align_right">
                    عدد الأشهر 
                    <?php echo $form['dureemois'] ?> 
                    عدد الأيام
                    <?php echo $form['dureejou'] ?>
                </td>
            </tr>
        </table>
        <span style="margin-left: 850px;font-size: 14px">   (1) الأقدمية في الرتبة (III</span>
        <table>
            <tr>
                <th class="align_right"> IIIالمجمــوع</th>
                <th class="align_right">النقاط المطابقة لعدد الأيام </th>
                <th class="align_right">النقاط المطابقة لعدد الأشهر </th>
                <th class="align_right" >دون رتبة الإرتقاء الأقدمية في الرتبة</th> 
            </tr>
            <tr>
                <td class="align_right"><?php echo $form['totalponitanci'] ?></td>
                <td class="align_right">  <?php echo $form['ancienete'] ?></td>
                <td class="align_right">X نقطة1/300<?php echo $form['nbrpointjouranci'] ?></td>
                <td class="align_right">Xنقطة 0.1 <?php echo $form['nbrpointsancien'] ?></td>
            </tr>
        </table>
        <div class="align_right">المجموع العام (I) + ( I I) + ( I I I)  </div>
        <div class="align_right">   ملاحظة                          : (*)
            يشطب على العبارة الزائدة
        </div>
        <div class="align_right" style="font-size: 14px">
            (1)
            يجب أن تكون هذه الإستمارة مصحوبة بالوثائق اللازمة لـ             (1)
            I +  I I+ I I
        </div>
        <div class="col-md-4">
            <table>
                <tr>
                    <td style=" text-align: center; font-size: 18px">رئيـس الإدارة</td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form['cheminsignature']->renderError() ?>
                        <?php echo $form['cheminsignature'] ?>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>  
</diV>

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
            $('#formulaire_etat option').each(function () {
                if ($(this).text().trim() == $('#etat').val().trim()) {
                    $(this).attr('selected', 'selected');
                }
            });
        })
    </script>
<?php endif; ?>