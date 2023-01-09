<?php if ($typeconge != ''): ?>
    <?php
    $query = " select  conge.annee as annee ,typeconge.id as idtype ,"
            . " conge.daterealise as datedebut , conge.datefinrealise as datefin,"
            . " conge.nbrjourrealise as nbrjourrealise"
            . " , conge.nbrjourprolonge as nbrjourprolonge "
            . ", conge.id_agents as idag , conge.nbrcongeralise as congerealise,"
            . " conge.nbjcongeannuelle as nbjcongeannuelle"
            . ", conge.nbrcongerestant as nbrcongerestant,"
            . " typeconge.libelle as typeconge"
            . " from conge,agents ,typeconge"
            . " where conge.id_agents=agents.id "
            . " and conge.valide=true "
            . " and conge.id_type=typeconge.id"
            . " and agents.id=" . $iddoc;

    if ($typeconge != '') {
        $query.= " and conge.id_type=" . $typeconge;
    }
     if ($annee_conge != ''){
         $query.= " and CAST(coalesce(conge.annee) AS integer)=" . $annee_conge; 
     } 
    $query.= " GROUP BY conge.nbrcongeralise, conge.id,conge.annee,typeconge.id,conge.id_agents, agents.nomcomplet,agents.prenom"
    . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  ";
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $liste = $conn->fetchAssoc($query);

    switch ($typeconge) {
    case 1:
    include_partial("liste_1", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 2:
    include_partial("liste_2", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 3:
    include_partial("liste_3", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 4:
    include_partial("liste_4", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 5:
    include_partial("liste_5", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 6:
    include_partial("liste_6", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    case 7:
    include_partial("liste_7", array("liste" => $liste, "iddoc" => $iddoc, "id" => $typeconge));
    break;

    default:
    break;
    }
    ?>
    <?php else: ?>
    <?php
//    $query = " select  conge.annee as annee ,typeconge.id as idtype ,"
//            . " conge.daterealise as datedebut , conge.datefinrealise as datefin,"
//            . " conge.nbrjourrealise as nbrjourrealise"
//            . " , conge.nbrjourprolonge as nbrjourprolonge "
//            . ", conge.id_agents as idag , conge.nbrcongeralise as congerealise,"
//            . " conge.nbjcongeannuelle as nbjcongeannuelle"
//            . ", conge.nbrcongerestant as nbrcongerestant,"
//            . " typeconge.libelle as typeconge"
//            . " from conge,agents ,typeconge"
//            . " where conge.id_agents=agents.id "
//            . " and conge.valide=true "
//            . " and conge.id_type=typeconge.id"
//            . " and agents.id=" . $iddoc
//            . " GROUP BY conge.nbrcongeralise, conge.id,conge.annee,typeconge.id,conge.id_agents, agents.nomcomplet,agents.prenom"
//            . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  ";
//    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//    $liste = $conn->fetchAssoc($query);
    $types = TypecongeTable::getInstance()->findAll();
    foreach ($types as $type) {
    $query = " select  conge.annee as annee ,typeconge.id as idtype ,"
    . " conge.daterealise as datedebut , conge.datefinrealise as datefin,"
    . " conge.nbrjourrealise as nbrjourrealise"
    . " , conge.nbrjourprolonge as nbrjourprolonge "
    . ", conge.id_agents as idag , conge.nbrcongeralise as congerealise,"
    . " conge.nbjcongeannuelle as nbjcongeannuelle"
    . ", conge.nbrcongerestant as nbrcongerestant,"
    . " typeconge.libelle as typeconge"
    . " from conge,agents ,typeconge"
    . " where conge.id_agents=agents.id "
    . " and conge.valide=true "
    . " and conge.id_type=typeconge.id"
    . " and agents.id=" . $iddoc;

    if ($typeconge != '') {
    $query.= " and conge.id_type=" . $type->getId();
}
$query.= " GROUP BY conge.nbrcongeralise, conge.id,conge.annee,typeconge.id,conge.id_agents, agents.nomcomplet,agents.prenom"
        . " ,agents.idrh,conge.nbrjourrealise,conge.nbrrestantannepr,conge.nbjcongeannuelle,conge.nbrcongerestant  ";
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$liste = $conn->fetchAssoc($query);
if (sizeof($liste) != 0)
    switch ($type->getId()) {
        case 1:
            include_partial("liste_1", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 2:
            include_partial("liste_2", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 3:
            include_partial("liste_3", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 4:
            include_partial("liste_4", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 5:
            include_partial("liste_5", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 6:
            include_partial("liste_6", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        case 7:
            include_partial("liste_7", array("liste" => $liste, "iddoc" => $iddoc, "id" => $type->getId()));
            break;

        default:
            break;
    }
}
?>
<?php endif; ?>