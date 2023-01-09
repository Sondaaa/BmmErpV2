<?php

/**
 * MotifTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MotifTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object MotifTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Motif');
    }

//    public function findAllSaufConge() {
//
//        $q = Doctrine_Query::create()
//                ->select('m.*')
//                ->from('motif m')
//                
//                ->orderBy(' m.id ASC')
//
//        ;
//
//        return; $q->execute();
//    }
    public function findAllSaufConge() {
        $q = $this->createQuery('m')
                ->select('m.*')
                ->from('Motif m')
                ->where('m.id <> 3')
                ->orderBy('m.id ASC');


        return $q->execute();
    }

}