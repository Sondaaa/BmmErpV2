<?php

/**
 * LignepiececomptableTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LignepiececomptableTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object LignepiececomptableTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Lignepiececomptable');
    }

    public function getByPieceInOrderSaisie($id_piece)
    {
        $query = $this->createQuery('l');
        $query->select('l.*')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->where('l.id_piececomptable =' . $id_piece)
            ->andWhere('l.montantdebit != 0 or l.montantcredit != 0')
            ->orderBy('l.montantcredit ');
        return $query->execute();
    }

    public function loadEtatExtraitCompte($compte = '', $date_debut = '', $date_fin = '', $journal = '', $order = '', $lettre = '', $non_lettre = '', $debit = '', $credit = '')
    {
        //die('deddddd');
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');

        if ($compte != '')
            $q->andWhere('c.id = ?', $compte);

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);

        if ($journal != '')
            $q->andWhere('p.id_journalcomptable = ?', $journal);

        if ($order != '') {
            if ($order == 'date')
                $q->orderBy('p.date asc , p.numero asc ');
            if ($order == 'lettre') {
                $q->orderBy('l.lettrelettrage desc');
                //          die($order.'ordre'.$q);
            }
        }

        if ($lettre == 'true' && $non_lettre == 'false') {
            $q->andWhere('l.lettrelettrage IS NOT NULL and l.lettrelettrage != ' . "''");
            $q->orderBy('l.lettrelettrage desc');
        }
        if ($non_lettre == 'true' && $lettre == 'false')
            $q->andWhere('l.lettrelettrage IS NULL or l.lettrelettrage = ' . "''");

        if ($lettre == 'true' && $non_lettre == 'true')
            $q = $q->andWhere('l.lettrelettrage IS NOT NULL or l.lettrelettrage is null or l.lettrelettrage =' . "''");


        if ($non_lettre == 'true' && $lettre == 'true') {
            $q = $q->andWhere(
                'l.lettrelettrage IS NOT NULL or l.lettrelettrage is null '
                    . 'or l.lettrelettrage =' . "''"
            );
            $q->orderBy('l.lettrelettrage desc');
        }

        if ($credit == 'true' && $debit == '0')
            $q->andWhere('l.montantcredit != ' . 0.000);
        if ($debit == '1' && $credit == 'false')
            $q->andWhere('l.montantdebit != ' . 0.000);
        if ($debit == '1' && $credit == 'true')
            $q = $q->andWhere('l.montantdebit !=' . 0.000 . ' or l.montantcredit !=' . 0.000);

        if ($debit == '0' && $credit == 'false')
            $q = $q->andWhere('l.montantdebit != ' . 0.000 . ' or l.montantcredit !=' . 0.000);
        //die($debit.$credit);
        return $q->execute();
    }

    /* recherche par code frs */

    public function loadEtatExtraitCompteFournisseur($id_frs = '', $date_debut = '', $date_fin = '', $journal = '', $order = '', $credit = '', $debit = '')
    {
        //        die('debit=' . $debit . 'credit=' . $credit);
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');
        //die($id_frs.'id');
        if ($id_frs != '' && $journal == '') {
            $q->leftJoin('l.Facturecomptableachat achat')
                ->leftJoin('achat.Fournisseur frs')
                ->leftJoin('l.Facturecomptableod od')
                ->leftJoin('od.Fournisseur frsod');
            $q->andWhere('frs.id = ?', $id_frs)
                ->orWhere('frsod.id=' . $id_frs);
        }


        if ($date_debut != '' && $date_fin == '') {
            die($date_debut . ' ' . $date_fin);
            $q->andWhere("p.date >= '" . $date_debut . "'");
        }
        if ($date_fin != '' && $date_debut == '') {
            $q->andWhere("p.date <= '" . $date_fin . "'");
        }
        if ($date_fin != '' && $date_debut != '') {
            $q->andWhere("p.date >= '" . $date_debut . "'");
            $q->andWhere("p.date <= '" . $date_fin . "'");
        }

        if ($journal != '' && $id_frs != '') {
            $q->andWhere('p.id_journalcomptable = ?', $journal);
            $id_type_journal = JournalcomptableTable::getInstance()->findOneById($journal)->getIdTypeJournal();

            if ($id_type_journal == 2) {
                $q->leftJoin('l.Facturecomptableachat achat')
                    ->leftJoin('achat.Fournisseur frs')
                    ->andWhere('frs.id = ?', $id_frs);
            }
            if ($id_type_journal == 5) {
                $q->leftJoin('l.Facturecomptableod od')
                    ->leftJoin('od.Fournisseur frsod')
                    ->andWhere('frsod.id = ?', $id_frs);
            }
        }
        if ($order != '') {
            if ($order == 'date')
                $q->orderBy('p.date asc , p.numero asc ');
        }

        if ($credit == 'false' && $debit == '1')
            $q->andWhere('l.montantdebit != ' . 0.000);
        if ($credit == 'true' && $debit == '0')
            $q->andWhere('l.montantcredit != ' . 0.000);
        if ($debit == '1' && $credit == 'false') {
            $q->andWhere('l.montantdebit != ' . 0.000);
        }
        if ($debit == '1' && $credit == 'true')
            $q = $q->andWhere('l.montantdebit !=' . 0.000 . ' or l.montantcredit !=' . 0.000);


        return $q->execute();
    }

    public function loadEtatExtraitCompteClient($id_client = '', $date_debut = '', $date_fin = '', $journal = '', $order = '', $debit = '', $credit = '')
    {

        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');

        if ($id_client != '' && $journal == '') {
            $q->leftJoin('l.Facturecomptablevente vent')
                ->leftJoin('vent.Client cl')
                ->Where('cl.id = ?', $id_client);
        }
        if ($date_debut != '') {
            $q->andWhere("p.date >= '" . $date_debut . "'");
        }
        if ($date_fin != '') {
            $q->andWhere("p.date <= '" . $date_fin . "'");
        }

        if ($journal != '' && $id_client != '') {
            $q->andWhere('p.id_journalcomptable = ?', $journal);
            $id_type_journal = JournalcomptableTable::getInstance()->findOneById($journal)->getIdTypeJournal();

            if ($id_type_journal == 1) {
                $q->leftJoin('l.Facturecomptablevente vent')
                    ->leftJoin('vent.Client cl')
                    ->andWhere('cl.id = ?', $id_client);
            }
        }
        if ($order != '') {
            if ($order == 'date')
                $q->orderBy('p.date asc , p.numero asc ');
        }
        if ($credit == 'false' && $debit == '1')
            $q->andWhere('l.montantdebit != ' . 0.000);
        if ($credit == 'true' && $debit == '0')
            $q->andWhere('l.montantcredit != ' . 0.000);
        if ($debit == '1' && $credit == 'false')
            $q->andWhere('l.montantdebit != ' . 0.000);
        if ($debit == '1' && $credit == 'true')
            $q = $q->andWhere('l.montantdebit !=' . 0.000 . ' or l.montantcredit !=' . 0.000);



        return $q->execute();
    }

    public function loadEtatJournalSeulFormsaisie($journal_id = '', $date_debut = '', $date_fin = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Lignepiececomptable pl')
            ->leftJoin('p.Journalcomptable j');

        $q->where('j.id = ?', $journal_id)
            ->andWhere('l.montantdebit != 0 or l.montantcredit != 0');

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
         $q->orderBy('p.id desc,l.id ');
      //  $q->orderBy('l.montantcredit ');
        return $q->execute();
    }
    public function loadEtatJournalSeul($journal_id = '', $date_debut = '', $date_fin = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Lignepiececomptable pl')
            ->leftJoin('p.Journalcomptable j');
        $q->where('j.id = ?', $journal_id)
            ->andWhere('l.montantdebit != 0 or l.montantcredit != 0');
        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
        $q->orderBy('p.id desc,l.id');
        return $q->execute();
    }

    public function loadEtatJournalSeulPrecedent($journal_id = '', $date_debut = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Lignepiececomptable pl')
            ->leftJoin('p.Journalcomptable j');
        $q->where('j.id = ?', $journal_id)
            ->andWhere('l.montantdebit != 0 or l.montantcredit != 0');
        if ($date_debut != '')
            $q->andWhere('p.date < ?', $date_debut);
        $q->orderBy('p.date asc ,p.id asc ');
        return $q->execute();
    }

    /* reimputer */

    public function getExistanceNumexeterne($numeroexterne = '', $journal_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Lignepiececomptable pl')
            ->leftJoin('p.Journalcomptable j');
        $q->where('j.id = ?', $journal_id);
        if ($numeroexterne != '')
            $q->andWhere("l.numeroexterne = '" . $numeroexterne . "'");

        $q->orderBy('p.id asc ');
        return $q->execute();
    }

    public function loadEtatJournalSeulParCommte($compte_id = '', $journal_id = '', $date_debut = '', $date_fin = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Lignepiececomptable pl')
            ->leftJoin('p.Journalcomptable j')
            ->where('l.id_comptecomptable = ?', $compte_id);

        if ($journal_id != '' && $compte_id != '')
            $q->where('j.id = ?', $journal_id)
                ->andWhere('l.montantdebit != 0 or l.montantcredit != 0')
                ->andWhere('l.id_comptecomptable = ' . $compte_id);
        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
        $q->orderBy('p.date asc');
        return $q->execute();
    }

    public function loadEtatJournal($date_debut = '', $date_fin = '', $date_debut_journal = '', $date_fin_journal = '', $journal_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Journalcomptable j');

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);

        if ($date_debut_journal != '')
            $q->andWhere('j.datedebutcloture <= ?', $date_debut_journal);
        if ($date_fin_journal != '')
            $q->andWhere('j.datefincloture >= ?', $date_fin_journal);

        if ($journal_id != '')
            $q->andWhere('j.id = ?', $journal_id);

        $q->orderBy('j.id');

        return $q->execute();
    }

    public function loadEtatJournalCentralisateur($date_debut = '', $date_fin = '', $journal_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Piececomptable p')
            ->leftJoin('p.Journalcomptable j');

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);

        if ($journal_id != '')
            $q->andWhere('j.id = ?', $journal_id);

        $q->orderBy('j.id');

        return $q->execute();
    }

    public function calculDebitMoisJournal($journal_id, $date_debut = '', $date_fin = '')
    {
        $query = $this->createQuery('p')
            ->select('SUM(l.montantdebit) AS totaldebit, SUM(l.montantcredit) AS totalcredit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->where('pc.id_journalcomptable = ?', $journal_id)
            ->andWhere('pc.date >= ?', $date_debut)
            ->andWhere('pc.date <= ?', $date_fin);
        return $query->execute();
    }

    public function calculAllDebitMoisJournal($date_debut = '', $date_fin = '')
    {
        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS totaldebit, coalesce(SUM(l.montantcredit),0) AS totalcredit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->andWhere('pc.date >= ?', $date_debut)
            ->andWhere('pc.date <= ?', $date_fin);
        return $query->execute();
    }

    public function calculDebitMois($compte_id, $date_debut = '', $date_fin = '')
    {
        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit, coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where('l.id_comptecomptable = ?', $compte_id)
            ->andWhere('j.id_type_journal <> ?', 4)
            ->andWhere('pc.date >= ?', $date_debut)
            ->andWhere('pc.date <= ?', $date_fin);
        return $query->execute()->getFirst();
    }

    public function calculDebitOuv($compte_id)
    {
        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit, coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where('l.id_comptecomptable = ?', $compte_id)
            ->andWhere('j.id_type_journal = ?', 4);

        return $query->execute()->getFirst();
    }

    public function calculDebitMoisClasse6_7($compte, $exercice_id = '')
    {
        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit,'
                . ' coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Plandossiercomptable pldc')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where("trim(pldc.numerocompte) = '" . $compte . "'")
            ->andWhere('pldc.id_exercice =' . $exercice_id)
            ->andWhere('j.id_type_journal <> ?', 4);
        return $query->execute()->getFirst();
    }

    public function calculDebitMoisClasse($compte, $date_debut = '', $date_fin = '', $exercice_id = '', $dossier_id = '')
    {

        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit,'
                . ' coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Plandossiercomptable pldc')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where("trim(pldc.numerocompte) = '" . $compte . "'")
            ->andWhere('pldc.id_exercice =' . $exercice_id)
            ->andWhere('pldc.id_dossier =' . $dossier_id)
            ->andWhere('j.id_type_journal <> ?', 4)
            ->andWhere('pc.date >= ?', $date_debut)
            ->andWhere('pc.date <= ?', $date_fin);
        return $query->execute()->getFirst();
    }

    public function calculDebitMoisClasseE($compte, $date_debut = '', $date_fin = '', $exercice_id = '')
    {
        $query = $this->createQuery('p')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit,'
                . ' coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Plandossiercomptable pldc')
            ->leftJoin('pldc.Plancomptable pl')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where("trim(pldc.numerocompte) = '" . $compte . "'")
            ->andWhere('pldc.id_exercice =' . $exercice_id)
            ->andWhere('j.id_type_journal <> ?', 4)
            ->andWhere('pc.date >= ?', $date_debut)
            ->andWhere('pc.date <= ?', $date_fin)
            ->andWhere('pl.id_classe not in (6,7)');
        return $query->execute()->getFirst();
    }

    public function calculDebitOuvClasse($compte)
    {
        $query = $this->createQuery('l')
            ->select('coalesce(SUM(l.montantdebit),0) AS total_debit, coalesce(SUM(l.montantcredit),0) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Plandossiercomptable pldc')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where("trim(pldc.numerocompte) = '" . $compte . "'")
            ->andWhere('pldc.id_exercice =' . $_SESSION['exercice_id'])
            ->andWhere('pldc.id_dossier =' . $_SESSION['dossier_id'])
            ->andWhere('j.id_type_journal = ?', 4);
        return $query->execute()->getFirst();
    }

    public function loadEtatFicheCompte($compte_min = '', $compte_max = '', $date_debut = '', $date_fin = '', $crediteur = '', $debiteur = '', $solde = '', $dossier_id = '', $exercice_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');

        if ($compte_min != '')
            $q->andWhere('trim(c.numerocompte) >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('trim(c.numerocompte) <= ?', $compte_max);

        $q->andWhere('c.id_dossier = ?', $dossier_id);
        $q->andWhere('c.id_exercice = ?', $exercice_id);

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
        if ($crediteur == 'true')
            $q->andWhere('c.solde < ?', 0);
        if ($debiteur == 'true')
            $q->andWhere('c.solde > ?', 0);
        if ($solde == 'true')
            $q->andWhere('c.solde = ?', 0);

        $q->orderBy('trim(c.numerocompte)');

        return $q->execute();
    }

    public function loadEtatFicheSeulCompte($compte_id, $date_debut = '', $date_fin = '', $crediteur = '', $debiteur = '', $solde = '')
    {

        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p')
            ->where('l.id_comptecomptable = ?', $compte_id);

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);

        if ($crediteur == 'true')
            $q->andWhere('c.solde > ?', 0);
        if ($debiteur == 'true')
            $q->andWhere('c.solde < ?', 0);
        if ($solde == 'true')
            $q->andWhere('c.solde = ?', 0);

        $q->orderBy('p.date');

        return $q->execute();
    }

    public function loadEtatLivre($compte_min = '', $compte_max = '', $date_debut = '', $date_fin = '', $order = '', $dossier_id = '', $exercice_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');
        if ($dossier_id != '')
            $q->andWhere('c.id_dossier = ?', $dossier_id);
        if ($exercice_id != '')
            $q->andWhere('c.id_exercice = ?', $exercice_id);

        if ($compte_min != '')
            $q->andWhere('trim(c.numerocompte) >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('trim(c.numerocompte) <= ?', $compte_max);

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
        if ($order != '') {
            if ($order == 'chronologique')
                $q->orderBy('p.date asc');
            if ($order == 'lettrage')
                $q->orderBy('l.lettrelettrage');
        }

        $q->orderBy('trim(c.numerocompte) ASC , p.date ASC');

        return $q;
    }

    public function loadEtatLivrePrece($compte_min = '', $compte_max = '', $date_debut = '', $order = '', $dossier_id = '', $exercice_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p');
        if ($dossier_id != '')
            $q->andWhere('c.id_dossier = ?', $dossier_id);
        if ($exercice_id != '')
            $q->andWhere('c.id_exercice = ?', $exercice_id);
        if ($compte_min != '')
            $q->andWhere('trim(c.numerocompte) >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('trim(c.numerocompte) <= ?', $compte_max);
        if ($date_debut != '')
            $q->andWhere('p.date < ?', $date_debut);
        if ($order != '') {
            if ($order == 'chronologique')
                $q->orderBy('p.date asc');
            if ($order == 'lettrage')
                $q->orderBy('l.lettrelettrage');
        }
        $q->orderBy('trim(c.numerocompte) ASC , p.date ASC');

        return $q;
    }

    public function loadEtatLivre2($compte_min = '', $compte_max = '', $date_debut = '', $date_fin = '', $order = '', $dossier_id = '', $exercice_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p')
            //  ->Where('c.id_dossier = ?', $dossier_id)
        ;
        if ($dossier_id != '')
            $q->andWhere('c.id_dossier = ?', $dossier_id);
        if ($exercice_id)
            $q->andWhere('c.id_exercice = ?', $exercice_id);
        if ($compte_min != '')
            $q->andWhere('trim(c.numerocompte) >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('trim(c.numerocompte) <= ?', $compte_max);

        if ($date_debut != '')
            $q->andWhere('p.date >= ?', $date_debut);
        if ($date_fin != '')
            $q->andWhere('p.date <= ?', $date_fin);
        if ($order != '') {
            if ($order == 'chronologique')
                $q->orderBy('p.date asc');
            if ($order == 'lettrage')
                $q->orderBy('l.lettrelettrage');
        }

        $q->orderBy('trim(c.numerocompte), p.date asc');

        return $q->execute();
    }
    public function loadEtatLivre2Pre($compte_min = '', $compte_max = '', $date_debut = '',  $order = '', $dossier_id = '', $exercice_id = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p')
            //  ->Where('c.id_dossier = ?', $dossier_id)
        ;
        if ($dossier_id != '')
            $q->andWhere('c.id_dossier = ?', $dossier_id);
        if ($exercice_id)
            $q->andWhere('c.id_exercice = ?', $exercice_id);
        if ($compte_min != '')
            $q->andWhere('trim(c.numerocompte) >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('trim(c.numerocompte) <= ?', $compte_max);

        if ($date_debut != '')
            $q->andWhere('p.date < ?', $date_debut);

        if ($order != '') {
            if ($order == 'chronologique')
                $q->orderBy('p.date asc');
            if ($order == 'lettrage')
                $q->orderBy('l.lettrelettrage');
        }

        $q->orderBy('trim(c.numerocompte), p.date asc');

        return $q->execute();
    }

    public function calculSoldeParametreBilan($compte_debut, $compte_fin, $index, $type, $year)
    {
        $query = $this->createQuery('p')
            ->select('SUM(l.montantdebit) AS total_debit, SUM(l.montantcredit) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->leftJoin('l.Plandossiercomptable c')
            ->where('trim(c.numerocompte) >= ?', $compte_debut)
            ->andWhere('trim(c.numerocompte) <= ?', $compte_fin);

        $query->andWhere("l.id_comptecomptable NOT IN (SELECT b.id_compte FROM Parametrebilancompte b WHERE b.note LIKE '%" . $index . "%' AND b.type = '" . $type . "')");

        $query->andWhere('j.id_type_journal <> ?', 4)
            ->andwhere("(TO_CHAR(pc.date, 'yyyy')) = '" . $year . "'");
        return $query->execute();
    }

    public function calculSoldeReportNouveau($compte_id)
    {
        $query = $this->createQuery('p')
            ->select('SUM(l.montantdebit) AS total_debit, SUM(l.montantcredit) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->where('l.id_comptecomptable = ?', $compte_id)
            ->andWhere('j.id_type_journal <> ?', 4)
            ->having('SUM(l.montantdebit) != SUM(l.montantcredit)');

        return $query->execute();
    }

    public function getSoldeOuverture($param_id, $journal_id)
    {
        $query = $this->createQuery('p')
            ->select('SUM(l.montantdebit) AS total_debit, SUM(l.montantcredit) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->leftJoin('pdc.Parametrebilancompte pbc')
            ->where('pbc.id_parametrebilan = ?', $param_id)
            ->andWhere('j.id = ?', $journal_id)
            ->having('SUM(l.montantdebit) != SUM(l.montantcredit)');

        return $query->execute();
    }

    public function getSoldeOuvertureByCompte($compte_id, $journal_id)
    {
        $query = $this->createQuery('p')
            ->select('SUM(l.montantdebit) AS total_debit, SUM(l.montantcredit) AS total_credit')
            ->from('Lignepiececomptable l')
            ->leftJoin('l.Piececomptable pc')
            ->leftJoin('pc.Journalcomptable j')
            ->leftJoin('l.Plandossiercomptable pdc')
            ->where('pdc.id = ?', $compte_id)
            ->andWhere('j.id = ?', $journal_id)
            ->having('SUM(l.montantdebit) != SUM(l.montantcredit)');

        return $query->execute();
    }

    public function findLettre()
    {
        $query = $this->createQuery('p')
            ->select('l.lettrelettrage as lettre')
            ->from('Lignepiececomptable l,Piececomptable p ')
            //                ->leftJoin('l.Piececomptable p')
            ->where("l.id_piececomptable = p.id")
            ->andWhere("trim(l.lettrelettrage) !='' and l.lettrelettrage is not null ")
            ->andWhere('p.id_exercice = ' . $_SESSION['exercice_id']);
        //                ->andWhere('p.id_journalcomptable in (select id from journalcomptable where id_dossier=' . $_SESSION['dossier_id'] . ')');
        //                 ->orwhere("l.lettrelettrage IS NOT NULL")

        $query = $query->groupBy('l.lettrelettrage , l.id')
            ->orderBy('length(l.lettrelettrage) desc, l.lettrelettrage desc  ');
        //         die($query);
        return $query->execute();
        //        die(count($query).'size');
    }

    public function DeleteLettrage($lettre)
    {
        //        $q = Doctrine_Query::create()
        //                ->update('Lignepiececomptable')
        //                ->set('lettrelettrage', '?', NULL )
        //                ->where("trim(lettrelettrage)='" . $lettre . "'");
        ////        die($q);
        //        return $q->execute();
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query_etat = "UPDATE Lignepiececomptable SET lettrelettrage = NULL WHERE "
            . "trim(lettrelettrage)='" . $lettre . "'";
        $resultat_etat = $conn->fetchAssoc($query_etat);
        return $resultat_etat;
    }

    public function loadByIntervalNumero($compte_min = '', $compte_max = '')
    {
        $q = $this->createQuery('l')
            ->leftJoin('l.Plandossiercomptable c')
            ->leftJoin('l.Piececomptable p')
            ->Where('c.id_dossier = ?', $_SESSION['dossier_id'])
            ->Where('p.id_exercice = ?', $_SESSION['exercice_id']);
        if ($compte_min != '')
            $q->andWhere('l.id_piececomptable >= ?', $compte_min);
        if ($compte_max != '')
            $q->andWhere('l.id_piececomptable <= ?', $compte_max);



        $q->orderBy('l.id  asc');

        return $q->execute();
    }
}
