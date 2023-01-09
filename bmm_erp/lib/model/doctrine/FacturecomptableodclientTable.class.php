<?php

/**
 * FacturecomptableodclientTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FacturecomptableodclientTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object FacturecomptableodclientTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Facturecomptableodclient');
    }

    public function findByPeriodeandNonSaisie($datedebut = '', $datefin = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("date <= '" . $datefin . "'");

        $q = $q->Andwhere("a.saisie = 0");

        $q = $q->orderby('id asc');
        return $q->execute();
    }

    public function getByIdPiece($id_piece = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->andWhere("a.id_dossier = ?", $_SESSION['dossier_id']);



        if ($id_piece != '')
            $q = $q->Andwhere("a.id_piececomptable = ?", $id_piece);

        $q = $q->orderby('id desc');
        return $q->execute();
    }

    public function findByPeriode($datedebut = '', $datefin = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("date <= '" . $datefin . "'");

        $q = $q->Andwhere("a.saisie = 0");

        $q = $q->orderby('id asc');
        return $q->execute();
    }

    public function loadByInterval($facture_min = '', $facture_max = '', $datedebut = '', $datefin = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("date <= '" . $datefin . "'");
        if ($facture_min != "")
            $q = $q->AndWhere('a.id >=' . $facture_min);

        if ($facture_max != '')
            $q->andWhere('a.id <= ' . $facture_max);
        $q = $q->Andwhere("a.saisie = 0");

        $q = $q->orderby('id desc');
        return $q->execute();
    }

    public function load($datedebut = '', $datefin = '', $reference = '', $fournisseur = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($fournisseur && $fournisseur != "")
            $q = $q->leftJoin('a.Client f')
                    ->Andwhere("f.rs LIKE '%" . $fournisseur . "%'");

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("date <= '" . $datefin . "'");

        if ($reference && $reference != "")
            $q = $q->Andwhere("reference LIKE '%" . $reference . "%'");

        $q = $q->Andwhere("a.saisie = 0");

        $q = $q->orderby('id asc');
        return $q;
    }

    public function loadSaisie($datedebut = '', $datefin = '', $reference = '', $fournisseur = '') {
        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($fournisseur && $fournisseur != "")
            $q = $q->leftJoin('a.Client f')
                    ->Andwhere("UPPER( f.rs) LIKE '%" . strtoupper($fournisseur) . "%'");

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("date <= '" . $datefin . "'");

        if ($reference && $reference != "")
            $q = $q->Andwhere("trim(a.reference)  LIKE '%" . trim($reference) . "%'");

        $q = $q->Andwhere("a.saisie = 1");

        $q = $q->orderby('id asc');
        return $q;
    }

    public function findByPeriodeAndType($datedebut = '', $datefin = '', $reference = '', $fournisseur = '') {

        $q = Doctrine_Core::getTable('Facturecomptableodclient')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id']);

        if ($fournisseur && $fournisseur != "")
            $q = $q->leftJoin('a.Client f')
                    ->Andwhere("f.rs LIKE '%" . $fournisseur . "%'");

        if ($reference && $reference != "")
            $q = $q->Andwhere("UPPER(a.reference)  LIKE '%" . $reference . "%'");

        if ($datedebut && $datedebut != "")
            $q = $q->Andwhere("a.date >= '" . $datedebut . "'");

        if ($datefin && $datefin != "")
            $q = $q->Andwhere("a.date <= '" . $datefin . "'");

        $q = $q->Andwhere("a.saisie = 0");

        $q = $q->orderby('id asc');

        return $q->execute();
    }

}