<?php

/**
 * TvaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TvaTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object TvaTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Tva');
    }

    public function getAllTva($libelle = '') {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.libelle) like ?', '%' . $libelle . '%');
        }

        return $q;
    }

    public function getForExiste($libelle, $id) {
        $q = $this->createQuery('a')
                ->where('a.id <> ' . $id)
                ->andWhere('a.libelle = ?', $libelle);

        return $q->execute();
    }

    public function getBaseTvaByDocs($ids) {
        $query = $this->createQuery('l');
        $query->select('SUM(l.mntht * q.qtelivrefrs) as mntht, SUM(l.mnttva * qtelivrefrs) as mnttva, SUM(l.mntttc * qtelivrefrs) as mntttc, t.id id_tva as, t.valeurtva as valeurtva')
                ->from('Tva t')
                ->leftJoin('t.Lignedocachat l')
                ->leftJoin('l.Qtelignedoc q')
                ->whereIn("l.id_doc", (array) $ids)
                ->groupBy('t.id')
                ->orderBy('t.id');
        return $query->execute();
    }
public function getBaseTvaByDocsContrat($ids) {
//        die( $ids[0] . 'iii');
        $query = $this->createQuery('l');
        $query->select('l.mntht  as mntht, l.mnttva as mnttva, l.mntttc  as mntttc, t.id as id_tva  , t.valeurtva as valeurtva')
                ->from('Tva t')
                ->leftJoin('t.Lignedocachat l')
                ->leftJoin('l.Qtelignedoc q')
//                ->whereIn("l.id_doc", (array) $ids)
                ->where('l.id_doc=' . $ids[0])
                ->groupBy('t.id , l.id')
                ->orderBy('t.id');
//        die($query);
        return $query->execute();
    }
    
    public function getBaseTvaByDocsContratBDCREG($ids) {
//        die( $ids[0] . 'iii');
        $query = $this->createQuery('l');
        $query->select('l.mntht  as mntht, l.mnttva as mnttva, l.mntttc  as mntttc, t.id as id_tva  , t.valeurtva as valeurtva')
                ->from('Tva t')
                ->leftJoin('t.Lignedocachat l')
                ->leftJoin('l.Qtelignedoc q')
//                ->whereIn("l.id_doc", (array) $ids)
                ->where('l.id_doc=' . $ids)
                ->groupBy('t.id , l.id')
                ->orderBy('t.id');
//        die($query);
        return $query->execute();
    }
}
