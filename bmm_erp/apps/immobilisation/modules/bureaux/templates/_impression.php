
<?php
if(isset($bureauximprimer)) {?>

  
<table>





        <?php


     $brnew=new Bureaux();

        foreach($bureauximprimer as $bureau) {

         $brnew=$bureau;
         $codebarre="2017".$brnew->getCode();
                ?>
   
<ul>
            <li style="font-size: 7px;font-weight: bold;font-family: calibri light;">

              <?php echo $brnew->getCode().' '.$brnew->getBureau(); ?>
            </li>
            <li >
                <?php echo '<img src="'. sfconfig::get('sf_appdir').'/codebarre/'.$codebarre.'.png">';?>  </li>
            <li style="font-size: 7px;font-weight: bold;font-family: calibri light;">
             <?php echo "E:".$brnew->getEtage()." Empl:".$brnew->getTypebureaux(); ?> </li>



        </ul>

                    <?php 
            }
            ?>

   


        <?php } ?>

</table>

<style>
    ul {
        list-style-type: none;
        margin-left:-30px;
    }

    ul li a {
        color: green;
        text-decoration: none;
        padding: 3px;
        display: block;

    }

    @media screen and (max-width: 699px) and (min-width: 520px) {
        ul li a {


        }
    }

    @media screen and (max-width: 1000px) and (min-width: 700px) {
        ul li a:before {


            color: #666666;
        }
    }
</style>
<style>


    img {
        /*  margin-top: 5px;*/
        width: 133px;
        height: 20px;

        margin-left: -3mm;

    }



</style>
<script src="<?php echo sfconfig::get('sf_appdir')  ?>bower_components/jquery/dist/jquery.min.js"></script>
<script  type="text/javascript">

    window.print();

    var myVar = setInterval(function(){ chargement() },1);

    var x = 1;
    function chargement() {
        if(document.readyState=="complete"){
            if(x==1){

             document.location="<?php echo url_for(array('module'=>'bureaux','action'=>'imprimercb')) ?>";
            }
            x++;
        }
    }

</script>
