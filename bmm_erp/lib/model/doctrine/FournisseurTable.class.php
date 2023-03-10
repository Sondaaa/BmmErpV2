
<?php

/**
 * FournisseurTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FournisseurTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object FournisseurTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Fournisseur');
    }

    
    public function getAllFournisseurByMouvement($id_docachat) {
        $q = $this->createQuery('f')
                ->select('f.id as id, f.rs as rs')
                ->from('Fournisseur f')
                ->leftJoin('f.Lignemouvementfacturation fp')
                ->where('fp.id_documentachat = ?',$id_docachat);
        $q = $q->orderBy('f.rs');
        return $q->execute();
    }
    public function getAllPagerComptabilite($raisonSociale = '', $code = '', $compte = '') {
        $etat = 'Actif';
        $q = $this->createQuery('f')
                ->select('f.id as id, f.reference as reference, f.rs as rs, p.numerocompte as numerocompte, p.libelle as libellecompte')
                ->from('Fournisseur f')
                ->leftJoin('f.Plancomptable p')
//                ->Where('f.id_dossier = ?', $_SESSION['dossier_id'])
//                ->andWhere("f.etatfrs  = 'Actif'")
                ;
//        die($q);
        if ($raisonSociale != '') {
            $q = $q->andWhere('UPPER(f.rs) like ?', '%' . $raisonSociale . '%');
        }
        if ($code != '') {
            $q = $q->andWhere('UPPER(f.reference) like ?', '%' . $code . '%');
        }
        if ($compte != '') {
//            $q=$q ->leftJoin('f.Plancomptable p');
            $q = $q->andWhere("(p.numerocompte LIKE '%" . $compte . "%' Or p.libelle LIKE '%" . $compte . "%')");
        }
        $q = $q->orderBy('f.id');
        return $q;
    }

    public function finByIdPlancomptable($id_plan = '') {
        $q = $this->createQuery('f')
                ->select('f.id as id, f.rs as rs')
                ->from('Fournisseur f')
                ->leftJoin('f.Plancomptable fp')
//                ->andWhere("f.etatfrs  = 'Actif'")
                ->where('f.id_dossier = ?', $_SESSION['dossier_id']);

        if ($id_plan != '') {
            $q = $q->andWhere('f.id_plancomptable' . $id_plan);
        }

        $q = $q->orderBy('f.rs');
        return $q;
    }

    public function getAllOrderByRaisonSociale() {
        $q = $this->createQuery('f')
                ->select('f.id as id, f.rs as rs')
                ->from('Fournisseur f')
//                ->andWhere("f.etatfrs  = 'Actif'")
//                ->where('f.id_dossier = ?', $_SESSION['dossier_id'])
                ->orderBy('f.rs');

        return $q->execute();
    }

    public function getAllFournisseurOrderByRaisonSociale() {
        $q = $this->createQuery('f')
                ->select('f.id as id, f.rs as rs')
                ->from('Fournisseur f')
               
                ->orderBy('f.rs');

        return $q->execute();
    }

    public function getByListeLibelle($libelles) {
        $q = $this->createQuery('f')
                ->whereIn('upper(trim(f.rs))', (array) $libelles)
                ->andWhere('f.id_dossier = ?', $_SESSION['dossier_id'])
                //->andWhere("f.etatfrs  = 'Actif'")
                ;
        return $q->execute();
    }

    public function getAllByLibelle($libelle = '') {
        $q = $this->createQuery('a');
        if ($libelle != '') {
            $q = $q->andWhere('UPPER(a.rs) like ?', '%' . strtoupper($libelle) . '%')
                    //->andWhere("f.etatfrs  = 'Actif'")
                    ;
        }

        return $q->execute();
    }

    public function getByListeCode($codes) {
        $q = $this->createQuery('f')
                ->whereIn('upper(trim(f.codefrs))', (array) $codes)
                ->andWhere('f.id_dossier = ?', $_SESSION['dossier_id'])
               // ->andWhere("f.etatfrs  = 'Actif'")
               ;
        return $q->execute();
    }

    public function getByDemandePrix($id) {
        $q = $this->createQuery('f')
                ->from('Fournisseur f')
                ->leftJoin('f.Documentachat d')
                ->where('d.id_docparent = ?', $id)
                ->andWhere('d.id_typedoc = 8')
//                ->andWhere("f.etatfrs  = 'Actif'")
                ->orderBy('f.rs');
//die($q);
        return $q->execute();
    }

    public function load($id_activite = '', $id_famille = '') {
//        $q = $this->createQuery('f')
//                ->select('f.id as id, f.rs as rs')
//                ->from('Fournisseur f')
//                ->leftJoin('f.activitetiers fa')
//                ->leftJoin('f.familleartfrs farticle');
//        if ($id_activite != '') {
//            $q = $q->andWhere('f.id_activite' . $id_activite);
//        }
//        if ($id_famille != '') {
//            $q = $q->andWhere('f.id_famillearticle' . $id_famille);
//        }
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT  *, activitetiers.libelle as activite, "
                . "familleartfrs.libelle as famille "
                . " FROM fournisseur, activitetiers, familleartfrs "
//                . " WHERE fournisseur.etatfrs = 'Actif' "
                ;
//                . " AND fournisseur.id_famillearticle = familleartfrs.id ";
        $query.= " ORDER BY fournisseur.rs";
        $fournisseurs = $conn->fetchAssoc($query);
        return $fournisseurs;
    }

    public function loadByInterval($founrnisseur_min = '', $founrnisseur_max = '') {
        $q = Doctrine_Core::getTable('Fournisseur')
                ->createQuery('a')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id'])
//                ->andWhere("f.etatfrs  = 'Actif'")
                ;

        if ($founrnisseur_min != "")
            $q = $q->AndWhere('a.id >=' . $founrnisseur_min);

        if ($founrnisseur_max != '')
            $q->andWhere('a.id <= ' . $founrnisseur_max);
        $q = $q->orderby('id asc');
        return $q;
    }

    public function loadByIntervalCompta($founrnisseur_min = '', $founrnisseur_max = '') {
        $q = $this->createQuery('a')
                ->select('a.id as id, a.rs as rs')
                ->from('Fournisseur a,Facturecomptableachat f ')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id'])
                //->andWhere("f.etatfrs  = 'Actif'")
                ->andWhere('a.id  not in (select id_fournisseur from facturecomptableachat where facturecomptableachat.saisie = 1 )')
        ;

        if ($founrnisseur_min != "")
            $q = $q->AndWhere('a.id >=' . $founrnisseur_min);

        if ($founrnisseur_max != '')
            $q->andWhere('a.id <= ' . $founrnisseur_max);
        $q = $q->orderby('id asc');
        return $q->execute();
    }

    public function getAllFournissuer($dossier_id = '') {
        $q = $this->createQuery('a')
                ->select('a.id as id, a.rs as rs')
//                ->from('Fournisseur a ')
                ->where("a.id_dossier = ?", $_SESSION['dossier_id'])
            //    ->andWhere("f.etatfrs  = 'Actif'")
//                ->andWhere('a.id  not in (select id_frs from facturecomptableachat where facturecomptableachat.saisie = 1 )')
//                ->andWhere('a.id  not in (select id_fournisseur from facturecomptableod where facturecomptableod.saisie = 1 )')
        ;


//        $q = $q->orderby('id asc');
        return $q->execute();
    }

     public function getAll() {
        $q = $this->createQuery('a')
                ->select('a.id as id, a.rs as rs')
                ->from('Fournisseur a ')
                  ;
        $q = $q->orderby('id asc');
        return $q->execute();
    }
    public function getActf() {
        $q = $this->createQuery('a')
                ->select('a.id as id, a.rs as rs')
                ->from('Fournisseur a ')
                //->where("a.etatfrs = ?", 'Actif')
                ;
        $q = $q->orderby('id asc');
        return $q;
    }

    public function getActif($code, $rs, $id_activite, $matricule_fiscale,$tel,$mail) {
        $q = $this->createQuery('a')
                ->select('a.id as id, a.rs as rs')
                ->from('Fournisseur a ')
                //->where("a.etatfrs = ?", 'Actif')
                ;
        if ($code != '') {
            $q = $q->andWhere('a.codefrs like ?', '%' . $code . '%');
        }
        if ($rs != '') {
            $q = $q->andWhere('UPPER(a.rs) like ?', '%' . strtoupper($rs) . '%');
        }
        if ($id_activite != '') {
            $q = $q->andWhere('a.id_activite =' . $id_activite);
        }
        if ($matricule_fiscale != '' && $matricule_fiscale != 'undefined') {
            $q = $q->andWhere('UPPER(f.matriculefiscale) like ?', '%' . strtoupper($matricule_fiscale) . '%');
        }
        if ($tel != '' && $tel != 'undefined') {
            $q = $q->andWhere("UPPER(f.tel)  = '" . strtoupper($tel) . "'");
        }
        if ($mail != '' && $mail != 'undefined') {
            $q = $q->andWhere("UPPER(f.mail)  = '" . strtoupper($mail) . "'");
        }
        $q = $q->orderby('id asc');
        return $q;
    }

    public function getComptecomptable($id_compte) {
        $q = $this->createQuery('a')
                ->select('pdc.id as id, a.rs as rs')
                ->from('Fournisseur a ')
                ->leftJoin('a.Plancomptable p')
                ->leftJoin('p.Plandossiercomptable pdc')
                ->where("a.id = " . $id_compte)
//                ->andWhere('pdc.id_dossier='.$_SESSION['dossier_id'])
//                 ->andWhere('pdc.id_exercice='.$_SESSION['exerice_id'])
        ;


        $q = $q->orderby('id asc');
        return $q;
    }

    public function getAllByCodeComptable($code_comptable, $matricule, $code) {
//die($code_comptable);
        $q = Doctrine_Core::getTable('Fournisseur')
                ->createQuery()
                ->leftJoin('Fournisseur.Plancomptable p');
          if ($code_comptable != '') {
            $q = $q->where("p.numerocompte = '" . $code_comptable . "'");
        }      
         if ($matricule != '') {
            $q = $q ->andWhere("trim(matriculefiscale)='" . trim($matricule ). "'");
        }  
        if ($code != '') {
            $q = $q ->andWhere("trim(codefrs)='" . trim($code) . "'");
        } 
//             die($q);  
//        die(json_encode($q->execute()));
        return $q->execute();
    }

}
