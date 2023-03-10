<?php

/**
 * PresenceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PresenceTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object PresenceTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Presence');
    }

    public function getByIdAgentsAndMoisAndAnnee($id_agent, $mois, $annee) {
        $query = $this->createQuery('l');
        $query->select('l.*')
                ->from('Presence l')
                ->where('l.id_agents =' . $id_agent)
                ->andWhere("trim(l.mois) =trim('" . $mois . "')")
                ->andWhere("trim(l.annee) =trim('" . $annee . "')");

        return $query->execute()->getFirst();
    }

    public function getByIdAgentsAndMois($id_agent, $mois) {
        $query = $this->createQuery('l');
        $query->select('l.*')
                ->from('Presence l')
                ->where('l.id_agents =' . $id_agent)
                ->andWhere("trim(l.mois) =trim('" . $mois . "')")
        ;

        return $query->execute()->getFirst();
    }
   public function getByIdAgentsAndAnnee($id_agent, $annee) {
        $query = $this->createQuery('l');
        $query->select('l.*')
                ->from('Presence l')
                ->where('l.id_agents =' . $id_agent)
                ->andWhere("trim(l.annee) =trim('" . $annee . "')")
        ;

        return $query->execute();
    }
}
