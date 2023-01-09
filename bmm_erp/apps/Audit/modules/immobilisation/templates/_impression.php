
<?php
if(isset($immobilisations)) {

    ?>
    <?php $bureau=Doctrine_Core::getTable('bureaux')->findOneById($bur);
    ?>






        <?php


        $immobilisation_new=new Immobilisation();
        $emplacment_codebarre=new Emplacement();
        //  die("hh".count($immobilisations));
        foreach($immobilisations as $immobilisation) {
            $immobilisation_new=$immobilisation;
            if($immobilisation_new->getDatemiseenrebut()=="" || $immobilisation_new->getDatemiseenrebut()=="0000-00-00") {
                $emplacement= Doctrine_Core::getTable('emplacement')->findOneByIdBureauAndIdImmo($immobilisation_new->getIdBureaux(),$immobilisation_new->getId());
                if($emplacement) {
                    $emplacment_codebarre=$emplacement;
                    $bureau=Doctrine_Core::getTable('bureaux')->findOneById($emplacment_codebarre->getIdBureau());
                    ?>
  
       
 <ul>
            <li style="font-size: 7px;font-weight: bold;font-family: calibri light;">

              <?php echo $immobilisation->getDesignation(); ?>
            </li>
            <li >
                 <?php echo '<img src="'. sfconfig::get('sf_appdir').'codebarre/'.$emplacment_codebarre->getReference().'.png">';?>
            </li>
            <li style="font-size: 7px;font-weight: bold;font-family: calibri light;">
                <?php echo $bureau; ?>  </li>


           
        </ul>


                        <?php }
                }
            }
            ?>

   

        <?php } ?>



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

        margin-left: -5mm;

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

                // document.location="<?php echo url_for(array('module'=>'immobilisation','action'=>'imprimercb')) ?>";
            }
            x++;
        }
    }

</script>
