<?php

/**
 * Categoerie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Categoerie extends BaseCategoerie
{
    public function   __toString(){
        return "".$this->getCategorie();
    }
    public function  getNombreLigne(){
        $nb_ligne=0;
        $connection = Doctrine_Manager::connection();
        $req='SELECT ifnull(sum(`mntttc`),0) as mnt ,famille.famille FROM `immobilisation`,famille  WHERE immobilisation.id_categorie is not null and  immobilisation.id_categorie='.$this->getId().' and immobilisation.id_famille=famille.id GROUP BY (id_famille)';

        $statement = $connection->execute($req);
        $statement->execute();
        $nb_ligne=count($statement->fetch())-1;
        return $nb_ligne;
    }
    public function  getStatementquery(){
       
        $connection = Doctrine_Manager::connection();
        $req='SELECT ifnull(sum(`mntttc`),0) as mnt ,famille.famille FROM `immobilisation`,famille  WHERE immobilisation.id_categorie is not null and  immobilisation.id_categorie='.$this->getId().' and immobilisation.id_famille=famille.id GROUP BY (id_famille)';

        $statement = $connection->execute($req);
        $statement->execute();
       
        return $statement->fetch();
    }
}