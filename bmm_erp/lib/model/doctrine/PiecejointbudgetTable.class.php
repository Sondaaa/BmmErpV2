<?php

/**
 * PiecejointbudgetTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PiecejointbudgetTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object PiecejointbudgetTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Piecejointbudget');
    }

    public function getByIdDocAchat($id_doc) {
//        die($id_doc.'fe');
        $q = $this->createQuery('piece.* ')
                ->from('Piecejointbudget piece, documentachat  ')
                ->where('piece.id_docachat=documentachat.id')
                ->andWhere('piece.id_docachat=' . $id_doc);
        $q->orderBy('piece.id desc');
//        die($q);
        $resultat = $q->execute();
//        die(sizeof($resultat).'cd');
        return $resultat;
    }

    public function getbyDocAchatAndLig($id_doc, $id_type, $id_ligne) {
        $q = 'select piecejointbudget.id as id, piecejointbudget.id_documentbudget  as id_documentbudget from '
                . ' piecejointbudget , documentachat  doc '
                . ' where piecejointbudget.id_docachat =doc.id'
                . ' and  piecejointbudget.id_docachat =' . $id_doc
                . ' and piecejointbudget.id_type =' . $id_type
//                . ' and piecejointbudget.id_documentbudget in'
//                . ' (select id from documentbudget where id_budget= ' . $id_ligne
//                . ' and piecejointbudget.id_documentbudget=documentbudget.id)'
//                . '  (select id from documentbudget '
//                . '   id_budget= ' . $id_ligne . ' and  piecejointbudget.id_documentbudget = documentbudget.id)'
        ;
//        die($q);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        return $conn->fetchAssoc($q);
//        $q->orderBy('piecejointbudget.id desc');  
//        die($q);
//        $resultat = $q->execute();
////         return $resultat;
//        die(count($resultat) . 'fff');
    }

    public function getBudget($id_doc, $id_budget) {
        $q = $this->createQuery('piece.* ,d.id as id,titre.libelle  as libelle')
                ->from('Piecejointbudget piece,documentbudget ,ligprotitrub budget,titrebudjet ')
                ->where('piece.id_documentbudget=documentbudget.id')
                ->andWhere('documentbudget.id_budget=budget.id')
                ->andWhere('budget.id_titre=titrebudjet.id')
                ->andWhere('documentbudget.id_documentbudget is not null')
//                ->andWhere('documentbudget.id_documentbudget=certificatretenue.id')

        ;
        if ($id_doc != '' && $id_budget != '')
            $q->andWhere("piece.id_docachat= " . $id_doc . " and piece.id_documentbudget=" . $id_budget);
        $q->orderBy('piece.id desc');
//        die($q);
        $resultat = $q->execute();
        die(json_encode($resultat));
    }

    public function getByDocachat($id_doc) {
        $q = $this->createQuery('piece.* ')
                ->from('Piecejointbudget piece, documentachat  ')
                ->where('piece.id_documentachat=documentachat.id')
                ->andWhere('documentbudget.id_documentachat=' . $id_doc)

        ;
        $q->orderBy('piece.id desc');
        //die($q);
        $resultat = $q->execute();
        return $resultat;
    }

    public function getByIdDoucmentachat($id_doc) {
        $q = $this->createQuery('p')
                ->leftJoin('p.Documentachat d')
                ->andWhere('p.id_docachat=' . $id_doc)

        ;
        $q->orderBy('p.id desc');
        //die($q);
        $resultat = $q->execute();
        return $resultat;
    }

}
