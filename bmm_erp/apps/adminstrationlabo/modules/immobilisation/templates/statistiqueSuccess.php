<?php use_helper('I18N', 'Date')?>
<?php include_partial('immobilisation/assets')?>
<script language="javascript" type="text/javascript" src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/flot/jquery.flot.pie.js"></script>
<style type="text/css">

    .demo-container {
        position: relative;

    }



    #menu {
        position: absolute;
        top: 20px;
        left: 625px;
        bottom: 20px;
        right: 20px;
        width: 200px;
    }

    #menu button {
        display: inline-block;
        width: 500px;
        padding: 3px 0 2px 0;
        margin-bottom: 4px;
        background: #eee;
        border: 1px solid #999;
        border-radius: 2px;
        margin-left: 150%;
        font-size: 16px;
        -o-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        -ms-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        cursor: pointer;
    }

    #description {
        margin: 15px 10px 20px 10px;
    }

    #code {
        display: block;
        width: 870px;
        padding: 15px;
        margin: 10px auto;
        border: 1px dashed #999;
        background-color: #f8f8f8;
        font-size: 16px;
        line-height: 20px;
        color: #666;
    }

    ul {
        font-size: 10pt;
    }

    ul li {
        margin-bottom: 0.5em;
    }

    ul.options li {
        list-style: none;
        margin-bottom: 1em;
    }

    ul li i {
        color: #999;
    }

</style>
<?php if ($stat == "cat") {?>
    <?php
$nb_ligne = count($categories) - 1;
    $i = 0;
    $chaine = "";
    foreach ($categories as $cat) {
        $chaine .= '{';
        $chaine .= "label: " . '"' . $cat->getCategorie() . '",';

        $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt  FROM immobilisation  WHERE id_categorie is not null and  id_categorie=' . $cat->getId();
        $connection = Doctrine_Manager::connection();
        $query = $req;
        $statement = $connection->execute($query);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_OBJ);
        $chaine .= "label: " . '"' . $cat->getCategorie() . "<br>" . $resultset->mnt . ' DT",';
        if ($i < $nb_ligne) {
            $chaine .= ' data: ' . $resultset->mnt . '},';
        } else {
            $chaine .= ' data: ' . $resultset->mnt . '}';
        }

        $i++;
    }
//echo $chaine;
    ?>

    <script type="text/javascript">

        $(function () {

            // Example Data

            var data = [
    <?php echo $chaine; ?>
            ];

            var placeholder = $("#placeholder");
            $("#example-10").click(function () {

                placeholder.unbind();
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 1,
                            label: {
                                show: true,
                                radius: 1,
                                formatter: labelFormatter,
                            },
                            combine: {
                                color: "#000",
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });


            });



            // Show the initial default chart

            $("#example-10").click();

            // Add the Flot version string to the footer


        });

        // A custom label formatter used by several of the plots

        function labelFormatter(label, series) {
            return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }

        //



    </script>


    <div id="content">


        <div class="demo-container" style="width: 100%;height:500px ">
            <div id="placeholder" class="demo-placeholder" style="width: 80%"></div>

            <div id="menu">
                <button id="example-10">Statistique par Catégorie d'immobilisation</button>

            </div>
        </div>






    </div>
<?php }?>
<?php if ($stat == "fam") {?>



    <?php
$chaineresult = "";
    foreach ($categories as $cat) {
        $connection = Doctrine_Manager::connection();
        $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,famille.famille
        FROM immobilisation,famille
        WHERE immobilisation.id_categorie is not null '
        . 'and  immobilisation.id_categorie=' . $cat->getId()
            . ' and immobilisation.id_famille=famille.id
         GROUP BY (famille.famille)';
        $statement = $connection->execute($req);
        $statement->execute();
        $chaine = "var data" . $cat->getId() . " = [";

        while ($resultset = $statement->fetch()) {
            $chaine .= '{';
            $chaine .= "label: " . '"' . $resultset['famille'] . "<br>" . $resultset['mnt'] . ' DT",';
            $chaine .= ' data: ' . $resultset['mnt'] . '},';
        }

        $chaine = substr($chaine, 0, -1);
        $chaine .= " ];";
        $chaineresult .= $chaine;
    }
    // echo $chaineresult;
    ?>
    <script type="text/javascript">

        $(function () {

            // Example Data


    <?php echo $chaineresult; ?>
            var placeholder = $("#placeholder");
    <?php foreach ($categories as $cat) {?>

                $("#example<?php echo $cat->getId() ?>-10").click(function () {

                    placeholder.unbind();
                    $.plot(placeholder, data<?php echo $cat->getId() ?>, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                tilt: 1,
                                label: {
                                    show: true,
                                    radius: 1,
                                    formatter: labelFormatter,
                                },
                                combine: {
                                    color: "#999",
                                    threshold: 0.1
                                }
                            }
                        },
                        legend: {
                            show: false
                        }
                    });


                });

    <?php }?>

            // Show the initial default chart

            $("#example<?php echo $categories[0]->getId() ?>-10").click();

            // Add the Flot version string to the footer


        });

        // A custom label formatter used by several of the plots

        function labelFormatter(label, series) {
            return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }

        //



    </script>



    <div id="content">


        <div class="demo-container" style="width: 100%;height:500px ">

            <div id="placeholder" class="demo-placeholder" style="width: 80%"></div>

            <div id="menu">
    <?php foreach ($categories as $cat) {?>
                    <button id="example<?php echo $cat->getId() ?>-10">Statistique par Famille  & Catégorie(<?php echo $cat->getCategorie() ?>) d'immobilisation</button>
    <?php }?>
            </div>
        </div>






    </div>
    <?php }
?>
<?php if ($stat == "sfam") {?>



    <?php
$user = sfContext::getInstance()->getUser()->getAttribute('userB2m');

    if ($user->getIdMagasin() || $user->getIdLabo()) {
        $labo_id = json_decode($user->getIdLabo());
        if (!$labo_id) {
            $labo_id = json_decode($user->getIdMagasin());
        }
    }
    $labo_id_projet = [];
    if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
        $projet_ids = json_decode($user->getIdProjet());

        foreach ($projet_ids as $id_pro) {
            $projet = ProjetTable::getInstance()->find($id_pro);
            array_push($labo_id_projet, $projet->getIdSoussite());
        }
    }
    $chaineresult = "";
    foreach ($familles as $fam) {

        $connection = Doctrine_Manager::connection();
        $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,sousfamille.sousfamille '
        . 'FROM immobilisation,sousfamille  '
        . 'WHERE immobilisation.id_famille is not null '
        . 'and  immobilisation.id_famille=' . $fam->getId() . ' ';
        if ($labo_id) {
            $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")";
        }
        if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
            $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id_projet)) . ")";
        }
        $req .= 'and immobilisation.id_sousfamille=sousfamille.id '
            . 'GROUP BY (sousfamille.sousfamille)';

        $statement = $connection->execute($req);
        $statement->execute();

        $chaine = "var data" . $fam->getId() . " = [";

        while ($resultset = $statement->fetch()) {
            $chaine .= '{';
            $chaine .= "label: " . '"' . $resultset['sousfamille'] . "<br>" . $resultset['mnt'] . ' DT",';
            $chaine .= ' data: ' . $resultset['mnt'] . '},';
        }

        $chaine = substr($chaine, 0, -1);
        $chaine .= " ];";
        $chaineresult .= $chaine;

        // echo $chaineresult;
        ?>
        <script type="text/javascript">

            $(function () {

                // Example Data


        <?php echo $chaineresult; ?>
                var placeholder = $("#placeholder");


                $("#example<?php echo $fam->getId() ?>-10").click(function () {

                    placeholder.unbind();
                    $.plot(placeholder, data<?php echo $fam->getId() ?>, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                tilt: 1,
                                label: {
                                    show: true,
                                    radius: 1,
                                    formatter: labelFormatter,
                                },
                                combine: {
                                    color: "#999",
                                    threshold: 0.1
                                }
                            }
                        },
                        legend: {
                            show: false
                        }
                    });


                });



                // Show the initial default chart

                $("#example<?php echo $fam->getId() ?>-10").click();

                // Add the Flot version string to the footer


            });

            // A custom label formatter used by several of the plots

            function labelFormatter(label, series) {
                return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }

            //



        </script>

    <?php }?>

    <div id="content">
        <style type="text/CSS">
            #menu {
                height:500px;
                margin-left: 10%;
            }
            #menu ul {

                list-style-type:none;
                text-align:center;
            }
            #menu li {
                float:left;
                margin:auto;
                padding:0;
                background-color:black;
            }
            #menu li a {
                display:block;
                width:500px;
                color:white;
                text-decoration:none;
                padding:5px;
            }
            #menu li a:hover {
                color:#FFD700;
            }
            #menu ul li ul {
                display:none;
            }
            #menu ul li:hover ul {
                display:block;
            }
            #menu li:hover ul li {
                float:none;
            }

        </style>

        <div class="demo-container" style="width: 100%;height:500px ">

            <div id="placeholder" class="demo-placeholder" style="width: 80%"></div>

            <div id="menu">
                <ul>

                    <li><a href="#">Statistique par Sous Famille  & Famille d'immobilisation</a>
                        <ul>
    <?php foreach ($familles as $fam) {?>
                                <li id="example<?php echo $fam->getId() ?>-10"><a href="#"> <?php echo $fam ?></a> </li>
    <?php }?>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>




    </div>

    <?php }
?>
<?php if ($stat == "famg") {?>

    <form action="<?php echo url_for('immobilisation/statistique?famillegeneral=1') ?>" method="get" >

        <table>
            <tr>
                <th>
                    <label>Type Famille:</label>
                </th>
    <?php if ($id_type != "-1") {?>
    <?php }?>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="famillegeneral" value="1">
                    <select name="idtype" style="height: 30px">
                        <option value="-1">SELLECTIONNEZ TYPE FAMILLE</option>
                <?php
$typefas = Doctrine_Core::getTable('typefamille')->findAll();
    foreach ($typefas as $ty) {
        ?>
                            <option <?php if ($ty->getId() == $id_type) {
            echo "selected";
        }
        ?>  value="<?php echo $ty->getId(); ?>"><?php echo $ty->getLibelle(); ?></option>

    <?php }?>
                    </select>


                </td>

                <td> <input type="submit" value="Consulter" style="height: 30px"></td>
            </tr>
        </table>
    </form>


                        <?php
                        $user = sfContext::getInstance()->getUser()->getAttribute('userB2m');
if ($user->getIdMagasin() || $user->getIdLabo()) {
        $labo_id = json_decode($user->getIdLabo());
        if (!$labo_id) {
            $labo_id = json_decode($user->getIdMagasin());
        }
    }
    $labo_id_projet = [];
    if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
        $projet_ids = json_decode($user->getIdProjet());

        foreach ($projet_ids as $id_pro) {
            $projet = ProjetTable::getInstance()->find($id_pro);
            array_push($labo_id_projet, $projet->getIdSoussite());
        }
    }
    $chaineresult = "";
    foreach ($typefamilles as $type) {

        $connection = Doctrine_Manager::connection();
        $req = 'SELECT sum(COALESCE(mntttc,0)) as mnt ,famille.famille '
        . 'FROM immobilisation,famille,typefamille  '
        . 'WHERE typefamille.id=' . $type->getId() ;
        if ($user->getIdMagasin() || $user->getIdLabo()) {
            $labo_id = json_decode($user->getIdLabo());
            if (!$labo_id) {
                $labo_id = json_decode($user->getIdMagasin());
            }
        }
    
     if ($labo_id) {
            $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")";
        }
        $req .= ' and immobilisation.id_famille=famille.id and '
            . 'famille.id_typefamille=typefamille.id and '
            . 'famille.id_typefamille is not null group BY (famille.famille) ';
//die($req);
        $statement = $connection->execute($req);
        $statement->execute();

        $chaine = "var data" . $type->getId() . " = [";

        while ($resultset = $statement->fetch()) {
            $chaine .= '{';
            $chaine .= "label: " . '"' . $resultset['famille'] . "<br>" . $resultset['mnt'] . ' DT",';
            $chaine .= ' data: ' . $resultset['mnt'] . '},';
        }

        $chaine = substr($chaine, 0, -1);
        $chaine .= " ];";
        $chaineresult .= $chaine;

        //   die($chaineresult);
        ?>
        <script type="text/javascript">

            $(function () {

                // Example Data


        <?php echo $chaineresult; ?>
                var placeholder = $("#placeholder");


                $("#example<?php echo $type->getId() ?>-10").click(function () {

                    placeholder.unbind();
                    $.plot(placeholder, data<?php echo $type->getId() ?>, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                tilt: 1,
                                label: {
                                    show: true,
                                    radius: 1,
                                    formatter: labelFormatter
                                },
                                combine: {
                                    color: "#999",
                                    threshold: 0.1
                                }
                            }
                        },
                        legend: {
                            show: false
                        }
                    });


                });



                // Show the initial default chart

                $("#example<?php echo $type->getId() ?>-10").click();

                // Add the Flot version string to the footer


            });

            // A custom label formatter used by several of the plots

            function labelFormatter(label, series) {
                return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }

            //



        </script>



    <?php }?>


    <div id="content">
        <div class="demo-container" style="width: 100%;height: 550px;">

            <div id="placeholder" class="demo-placeholder" ></div>

            <div id="menu">
    <?php foreach ($typefamilles as $type) {?>
                    <button  id="example<?php echo $type->getId() ?>-10"><?php echo $type ?></button>
    <?php }?>
            </div>



        </div>

    </div>








    <?php if (isset($id_type)) {?>
        <div id="content">
            <div class="demo-container" style="width: 100%;height: 550px;">

        <?php
$chaineresult1 = "";

        $connection = Doctrine_Manager::connection();
        $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,site.site FROM immobilisation,famille,typefamille,site WHERE typefamille.id=' . $id_type . ' and immobilisation.id_famille=famille.id and famille.id_typefamille=typefamille.id and famille.id_typefamille is not null and site.id=immobilisation.id_site GROUP BY(site.site) ';

        $statement = $connection->execute($req);
        $statement->execute();

        $chaine = "var datas = [";

        while ($resultset = $statement->fetch()) {
            $chaine .= '{';
            $chaine .= "label: " . '"' . $resultset['site'] . "<br>" . $resultset['mnt'] . ' DT",';
            $chaine .= ' data: ' . $resultset['mnt'] . '},';
        }

        $chaine = substr($chaine, 0, -1);
        $chaine .= " ];";
        $chaineresult1 .= $chaine;

        //   die($chaineresult);
        ?>
                <script type="text/javascript">

                    $(function () {

                        // Example Data


                <?php echo $chaineresult1; ?>
                        var placeholders = $("#placeholders");


                        $("#examples-10").click(function () {

                            placeholders.unbind();
                            $.plot(placeholders, datas, {
                                series: {
                                    pie: {
                                        show: true,
                                        radius: 1,
                                        tilt: 1,
                                        label: {
                                            show: true,
                                            radius: 1,
                                            formatter: labelFormatters
                                        },
                                        combine: {
                                            color: "#999",
                                            threshold: 0.1
                                        }
                                    }
                                },
                                legend: {
                                    show: false
                                }
                            });


                        });



                        // Show the initial default chart

                        $("#examples-10").click();

                        // Add the Flot version string to the footer


                    });

                    // A custom label formatter used by several of the plots

                    function labelFormatters(label, series) {
                        return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
                    }

                    //



                </script>








                <div id="placeholders" class="demo-placeholder" ></div>

                <div id="menu">

                    <button style="" id="examples-10">REPARTITION PAR SITES</button>

                </div>




            </div>
        </div>


    <?php }?>




<?php }?>
<?php if ($stat == "tous") {?>




    <?php
$chaineresult = "";
    $mnttotal = 0;
    $connection = Doctrine_Manager::connection();
    $user = sfContext::getInstance()->getUser()->getAttribute('userB2m');

    if ($user->getIdMagasin() || $user->getIdLabo()) {
        $labo_id = json_decode($user->getIdLabo());
        if (!$labo_id) {
            $labo_id = json_decode($user->getIdMagasin());
        }
    }
    $labo_id_projet = [];
    if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
        $projet_ids = json_decode($user->getIdProjet());

        foreach ($projet_ids as $id_pro) {
            $projet = ProjetTable::getInstance()->find($id_pro);
            array_push($labo_id_projet, $projet->getIdSoussite());
        }
    }
    $req = 'SELECT sum(COALESCE (mntttc,0)) as mnt ,typefamille.libelle
     FROM immobilisation,famille,typefamille
     WHERE   immobilisation.id_famille=famille.id
     and famille.id_typefamille=typefamille.id
     and famille.id_typefamille is not null';
    if ($labo_id) {
        $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")";
    }
    if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
        $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id_projet)) . ")";
    }
    $req .= ' group BY (typefamille.id) ';
    //die($req);
    $statement = $connection->execute($req);
    $statement->execute();

    $chaine = "var data = [";

    while ($resultset = $statement->fetch()) {
        $chaine .= '{';
        $chaine .= "label: " . '"' . $resultset['libelle'] . "<br>" . $resultset['mnt'] . ' DT",';
        $chaine .= ' data: ' . $resultset['mnt'] . '},';
        $mnttotal += $resultset['mnt'];
    }

    $chaine = substr($chaine, 0, -1);
    $chaine .= " ];";
    $chaineresult .= $chaine;

    //   die($chaineresult);
    ?>
    <script type="text/javascript">

        $(function () {

            // Example Data


    <?php echo $chaineresult; ?>
            var placeholder = $("#placeholder");


            $("#example-10").click(function () {

                placeholder.unbind();
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 1,
                            label: {
                                show: true,
                                radius: 3 / 4,
                                formatter: function (label, series) {
                                    return '<div style="font-size:14pt;text-align:center;padding:2px;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {opacity: 0.5}
                            },
                            combine: {
                                color: "#999",
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });


            });



            // Show the initial default chart

            $("#example-10").click();

            // Add the Flot version string to the footer


        });

        // A custom label formatter used by several of the plots

        function labelFormatter(label, series) {
            return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }

        //



    </script>





    <button  id="example-10"><?php echo "MONTANT TOTAL EST " . $mnttotal . " DT" ?></button>
    <div id="content">
        <div class="demo-container" style="float: left;width: 50%">

            <div id="placeholder" class="demo-placeholder" style="width:  65%" ></div>
        </div>
    <?php
$req = 'SELECT typefamille.libelle,typefamille.id FROM immobilisation,famille,typefamille  WHERE   immobilisation.id_famille=famille.id and famille.id_typefamille=typefamille.id and famille.id_typefamille is not null group BY (typefamille.id) ';

    $statement = $connection->execute($req);
    $statement->execute();

    $dataset = ' var datasets = {';

    while ($resultset = $statement->fetch()) {
        $dataset .= '"' . $resultset['libelle'] . '": {';
        $dataset .= 'label: "' . $resultset['libelle'] . '",';
        $req1 = 'SELECT sum(COALESCE(mntttc,0)) as mnt ,EXTRACT(YEAR FROM immobilisation.dateacquisition) as datea FROM immobilisation,famille,typefamille WHERE immobilisation.id_famille=famille.id and famille.id_typefamille=typefamille.id  and typefamille.id=' . $resultset['id'] . ' group BY EXTRACT(YEAR FROM immobilisation.dateacquisition)';
        //die($req1);
        $statement1 = $connection->execute($req1);
        $statement1->execute();
        $data = 'data :[';
        while ($resultset1 = $statement1->fetch()) {
            $data .= '[' . $resultset1['datea'] . ', ' . $resultset1['mnt'] . '],';
        }

        $data = substr($data, 0, -1);
        $data .= " ]";
        $dataset .= $data . '},';
    }

    $dataset = substr($dataset, 0, -1);
    $dataset .= " };";

    //   die($dataset);
    ?>
        <script type="text/javascript">

            $(function () {


        <?php echo $dataset; //die($dataset);        ?>
                var i = 0;
                $.each(datasets, function (key, val) {
                    val.color = i;
                    ++i;
                });

                // insert checkboxes
                var choiceContainer = $("#choices");
                $.each(datasets, function (key, val) {
                    choiceContainer.append("<br/><input type='checkbox' name='" + key +
                            "' checked='checked' id='id" + key + "'></input>" +
                            "<label for='id" + key + "'>"
                            + val.label + "</label>");
                });

                choiceContainer.find("input").click(plotAccordingToChoices);

                function plotAccordingToChoices() {

                    var data = [];

                    choiceContainer.find("input:checked").each(function () {
                        var key = $(this).attr("name");
                        if (key && datasets[key]) {
                            data.push(datasets[key]);
                        }
                    });

                    if (data.length > 0) {
                        $.plot("#placeholder1", data, {
                            yaxis: {
                                min: 0
                            },
                            xaxis: {
                                tickDecimals: 0
                            }
                        });
                    }
                }

                plotAccordingToChoices();

                // Add the Flot version string to the footer

                $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");


    //        $(function() {
    //
    //
    //     var datasets = {"DIVERS": {label: "DIVERS",data :[[1994, 1250.472],[2014, 8988.964],[1992, 18700.477],[2004, 20397.679],[1970, 285648.705],[1999, 998.175],[1993, 4663.924],[1989, 6988.105],[1997, 4888.883],[2003, 5229.327],[1991, 11694.870],[1998, 1953.636],[2015, 6698.556],[1995, 5610.342],[1996, 5380.625],[2001, 5371.161],[2012, 2636.550],[2013, 2650.600],[2006, 10444.703],[1990, 9103.025],[2008, 4060.152],[2011, 8478.297],[2009, 2849.974],[2002, 10749.806],[2000, 4214.338],[2007, 996.765],[2010, 9058.837],[2005, 22682.684] ]},"213LOGICIELS": {label: "213 LOGICIELS",data :[[1970, 240.997],[1999, 1.870],[1997, 5.840],[1998, 1694.880],[1995, 1454.178],[2001, 2503.488] ]} };
    //var i = 0;
    //            $.each(datasets, function(key, val) {
    //                val.color = i;
    //                ++i;
    //            });
    //
    //            // insert checkboxes
    //            var choiceContainer = $("#choices");
    //            $.each(datasets, function(key, val) {
    //                choiceContainer.append("<br/><input type='checkbox' name='" + key +
    //                    "' checked='checked' id='id" + key + "'></input>" +
    //                    "<label for='id" + key + "'>"
    //                    + val.label + "</label>");
    //            });
    //
    //            choiceContainer.find("input").click(plotAccordingToChoices);
    //
    //            function plotAccordingToChoices() {
    //
    //                var data = [];
    //
    //                choiceContainer.find("input:checked").each(function () {
    //                    var key = $(this).attr("name");
    //                    if (key && datasets[key]) {
    //                        data.push(datasets[key]);
    //                    }
    //                });
    //
    //                if (data.length > 0) {
    //                    $.plot("#placeholder1", data, {
    //                        yaxis: {
    //                            min: 0
    //                        },
    //                        xaxis: {
    //                            tickDecimals: 0
    //                        }
    //                    });
    //                }
    //            }
    //
    //            plotAccordingToChoices();
    //
    //            // Add the Flot version string to the footer
    //
    //            $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
    //
    //
    //
            });

        </script>
        <div class="demo-container" style="float: left;width: 100%">
            <p id="choices" style="float: right" ></p>
            <div id="placeholder1" class="demo-placeholder" style="width:  80%"></div>

        </div>


    </div>













<?php }?>



<?php if ($stat == "toussite") {?>
    <?php
$chaineresult = "";
    $mnttotal = 0;
    $user = sfContext::getInstance()->getUser()->getAttribute('userB2m');

    if ($user->getIdMagasin() || $user->getIdLabo()) {
        $labo_id = json_decode($user->getIdLabo());
        if (!$labo_id) {
            $labo_id = json_decode($user->getIdMagasin());
        }
    }
    $labo_id_projet = [];
    if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
        $projet_ids = json_decode($user->getIdProjet());

        foreach ($projet_ids as $id_pro) {
            $projet = ProjetTable::getInstance()->find($id_pro);
            array_push($labo_id_projet, $projet->getIdSoussite());
        }
    }

    $connection = Doctrine_Manager::connection();
    $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,etage.etage
    FROM immobilisation,etage
     WHERE   immobilisation.id_etage=etage.id
    ';
    if ($labo_id) {
        $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")";
    }
    if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
        $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id_projet)) . ")";
    }
    $req .= ' group BY (etage.etage) ';

// if ($labo_id) {
    //     $q = $q->whereIn('id_etage ', $labo_id);
    // }
    $statement = $connection->execute($req);
    $statement->execute();

    $chaine = "var data = [";

    while ($resultset = $statement->fetch()) {
        $chaine .= '{';
        $chaine .= "label: " . '"' . $resultset['etage'] . "<br>" . $resultset['mnt'] . ' DT",';
        $chaine .= ' data: ' . $resultset['mnt'] . '},';
        $mnttotal += $resultset['mnt'];
    }

    $chaine = substr($chaine, 0, -1);
    $chaine .= " ];";
    $chaineresult .= $chaine;

    //   die($chaineresult);
    ?>
    <script type="text/javascript">

        $(function () {

            // Example Data


    <?php echo $chaineresult; ?>
            var placeholder = $("#placeholder");


            $("#example-10").click(function () {

                placeholder.unbind();
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 1,
                            label: {
                                show: true,
                                radius: 1,
                                formatter: labelFormatter
                            },
                            combine: {
                                color: "#999",
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });


            });



            // Show the initial default chart

            $("#example-10").click();

            // Add the Flot version string to the footer


        });

        // A custom label formatter used by several of the plots

        function labelFormatter(label, series) {
            return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }

        //



    </script>



    <button  id="example-10"><?php echo "MONTANT TOTAL EST " . $mnttotal . " DT" ?></button>

    <div id="content">

        <div class="demo-container" style="float: left;width: 30%">





            <div id="placeholder" class="demo-placeholder"  style="height: 70%"></div>





        </div>
    <?php
$req = 'SELECT site.site FROM immobilisation,site  WHERE   immobilisation.id_site=site.id  group BY (site.site) ';

    $statement = $connection->execute($req);
    $statement->execute();

    'var datasets = {
			"usa": {
				label: "USA",
				data: [[1988, 483994], [1989, 479060], [1990, 457648], [1991, 401949], [1992, 424705], [1993, 402375], [1994, 377867], [1995, 357382], [1996, 337946], [1997, 336185], [1998, 328611], [1999, 329421], [2000, 342172], [2001, 344932], [2002, 387303], [2003, 440813], [2004, 480451], [2005, 504638], [2006, 528692]]
			}
		};';

    $dataset = ' var datasets = {';

    while ($resultset = $statement->fetch()) {
        $dataset .= '"' . $resultset['site'] . '": {';
        $dataset .= 'label: "' . $resultset['site'] . '",';
        $req1 = "SELECT SUM(COALESCE(mntttc,0)) as mnt ,EXTRACT(YEAR FROM  immobilisation.dateacquisition) as datea "
            . "FROM immobilisation,site WHERE immobilisation.id_site=site.id "
            . "and site.site='" . $resultset['site'] . "' "
            . "group BY EXTRACT(YEAR FROM  immobilisation.dateacquisition)";

        //die($req1);
        $statement1 = $connection->execute($req1);
        $statement1->execute();
        $data = 'data :[';
        while ($resultset1 = $statement1->fetch()) {
            $data .= '[' . $resultset1['datea'] . ', ' . $resultset1['mnt'] . '],';
        }
        $data = substr($data, 0, -1);
        $data .= " ]";
        $dataset .= $data . '},';
    }

    $dataset = substr($dataset, 0, -1);
    $dataset .= " };";
    ?>
        <script type="text/javascript">

            $(function () {


        <?php echo $dataset; ?>
                var i = 0;
                $.each(datasets, function (key, val) {
                    val.color = i;
                    ++i;
                });

                // insert checkboxes
                var choiceContainer = $("#choices");
                $.each(datasets, function (key, val) {
                    choiceContainer.append("<br/><input type='checkbox' name='" + key +
                            "' checked='checked' id='id" + key + "'></input>" +
                            "<label for='id" + key + "'>"
                            + val.label + "</label>");
                });

                choiceContainer.find("input").click(plotAccordingToChoices);

                function plotAccordingToChoices() {

                    var data = [];

                    choiceContainer.find("input:checked").each(function () {
                        var key = $(this).attr("name");
                        if (key && datasets[key]) {
                            data.push(datasets[key]);
                        }
                    });

                    if (data.length > 0) {
                        $.plot("#placeholder1", data, {
                            yaxis: {
                                min: 0
                            },
                            xaxis: {
                                tickDecimals: 0
                            }
                        });
                    }
                }

                plotAccordingToChoices();

                // Add the Flot version string to the footer

                $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
            });

        </script>
        <div class="demo-container" style="float: left;width: 60%;margin-left: 1%">
            <p id="choices" style="float: right" ></p>
            <div id="placeholder1" class="demo-placeholder" style="width:  75%"></div>

        </div>
    </div>
<?php }?>
<?php if ($stat == "touslocal") {?>
    <?php
$chaineresult = "";
    $mnttotal = 0;
    $user = sfContext::getInstance()->getUser()->getAttribute('userB2m');

    if ($user->getIdMagasin() || $user->getIdLabo()) {
        $labo_id = json_decode($user->getIdLabo());
        if (!$labo_id) {
            $labo_id = json_decode($user->getIdMagasin());
        }
    }
    $labo_id_projet = [];
    if ($user->getIdProjet() && $user->getIsChefprojet() == true) {
        $projet_ids = json_decode($user->getIdProjet());

        foreach ($projet_ids as $id_pro) {
            $projet = ProjetTable::getInstance()->find($id_pro);
            array_push($labo_id_projet, $projet->getIdSoussite());
        }
    }

    $connection = Doctrine_Manager::connection();
    $req = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,bureaux.bureau as bureau
     FROM immobilisation,bureaux
    WHERE immobilisation.id_bureaux=bureaux.id
     ';
    if ($labo_id) {
        $req .= " and  immobilisation.id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")"
        . " and  bureaux.id_etage in (" . implode(',', array_map('intval', $labo_id)) . ")";

    }

    if ($user->getIdProjet() && $labo_id_projet && !$labo_id) {
        $req .= " and  id_etage in (" . implode(',', array_map('intval', $labo_id_projet)) . ")";
    }
    $req .= ' group BY (bureaux.id)';
    $statement = $connection->execute($req);
    $statement->execute();

    $chaine = "var data = [";

//echo json_encode($statement->fetch());
    while ($resultset = $statement->fetch()) {
        $chaine .= '{';
        $chaine .= "label: " . '"' . utf8_encode($resultset['bureau']) . "<br>" . $resultset['mnt'] . ' DT",';
        $chaine .= ' data: ' . $resultset['mnt'] . '},';
        $mnttotal += $resultset['mnt'];
    }

    $chaine = substr($chaine, 0, -1);
    $chaine .= " ];";
    $chaineresult .= $chaine;

    //  die($chaineresult);
    ?>
    <script type="text/javascript">

        $(function () {



    <?php echo $chaineresult; ?>
            var placeholder = $("#placeholder");


            $("#example-10").click(function () {

                placeholder.unbind();
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 1,
                            label: {
                                show: true,
                                radius: 3 / 4,
                                formatter: function (label, series) {
                                    return '<div style="font-size:14pt;text-align:center;padding:2px;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {opacity: 0.5}
                            },
                            combine: {
                                color: "#999",
                                threshold: 0.1
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });


            });





            $("#example-10").click();




        });


        function labelFormatter(label, series) {
            return "<div style='font-size:12pt; text-align:center; padding:2px; color:#000;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }


    </script>





    <button  id="example-10"><?php echo "MONTANT TOTAL EST " . $mnttotal . " DT" ?></button>
    <div id="content">
        <div class="demo-container" style="float: left;width: 50%">

            <div id="placeholder" class="demo-placeholder" style="width:  65%" ></div>
        </div>
    <?php
$req = 'SELECT typebureaux.typebureaux,typebureaux.id FROM immobilisation,bureaux,typebureaux WHERE immobilisation.id_bureaux=bureaux.id and bureaux.id_type=typebureaux.id group BY (typebureaux.id)';

    $statement = $connection->execute($req);
    $statement->execute();

    $dataset = ' var datasets = {';

    while ($resultset = $statement->fetch()) {
        $dataset .= '"' . $resultset['typebureaux'] . '": {';
        $dataset .= 'label: "' . $resultset['typebureaux'] . '",';
        $req1 = 'SELECT SUM(COALESCE(mntttc,0)) as mnt ,EXTRACT(YEAR FROM immobilisation.dateacquisition) as datea FROM immobilisation,bureaux,typebureaux WHERE immobilisation.id_bureaux=bureaux.id and bureaux.id_type=typebureaux.id  and typebureaux.id=' . $resultset['id'] . ' group BY EXTRACT(YEAR FROM immobilisation.dateacquisition)';
        $statement1 = $connection->execute($req1);
        $statement1->execute();
        $data = 'data :[';
        while ($resultset1 = $statement1->fetch()) {
            $data .= '[' . $resultset1['datea'] . ', ' . $resultset1['mnt'] . '],';
        }
        $data = substr($data, 0, -1);
        $data .= " ]";
        $dataset .= $data . '},';
    }

    $dataset = substr($dataset, 0, -1);
    $dataset .= " };";
    ?>
        <script type="text/javascript">

            $(function () {


        <?php echo $dataset; ?>
                var i = 0;
                $.each(datasets, function (key, val) {
                    val.color = i;
                    ++i;
                });

                // insert checkboxes
                var choiceContainer = $("#choices");
                $.each(datasets, function (key, val) {
                    choiceContainer.append("<br/><input type='checkbox' name='" + key +
                            "' checked='checked' id='id" + key + "'></input>" +
                            "<label for='id" + key + "'>"
                            + val.label + "</label>");
                });

                choiceContainer.find("input").click(plotAccordingToChoices);

                function plotAccordingToChoices() {

                    var data = [];

                    choiceContainer.find("input:checked").each(function () {
                        var key = $(this).attr("name");
                        if (key && datasets[key]) {
                            data.push(datasets[key]);
                        }
                    });

                    if (data.length > 0) {
                        $.plot("#placeholder1", data, {
                            yaxis: {
                                min: 0
                            },
                            xaxis: {
                                tickDecimals: 0
                            }
                        });
                    }
                }

                plotAccordingToChoices();

                // Add the Flot version string to the footer

                $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
            });

        </script>
        <div class="demo-container" style="float: left;width: 100%">
            <p id="choices" style="float: right" ></p>
            <div id="placeholder1" class="demo-placeholder" style="width:  75%"></div>

        </div>


    </div>













<?php }?>