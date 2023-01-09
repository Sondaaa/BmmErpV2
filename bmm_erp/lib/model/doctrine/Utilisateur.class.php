
<?php

/**
 * Utilisateur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Utilisateur extends BaseUtilisateur
{

    private $userConfig;

    public function __toString()
    {
        return "" . $this->getAgents()->getIdrh() . " " . strtoupper($this->getAgents()->getNomcomplet()) . " " . strtoupper($this->getAgents()->getPrenom());
    }
    public function Administartion()
    {
        if ($this->is_admin)
            return 'true';
        return 'false';
    }
    public function getAdministartionSite()
    {
        if ($this->getIdMagasin()) {
            $labos = json_decode($this->getIdMagasin());
           
            if (count($labos) == 0)
                $labo = EtageTable::getInstance()->findOneByIdMagasin($this->getIdMagasin());
            else {
                $labo = Doctrine_Core::getTable('Etage')->createQuery('a')
                    ->whereIn('id', $labos)
                    ->andWhere("is_administration is not null")
                    ->execute()
                    ->getFirst();
            }
           
            return $labo;
        }
        return null;
    }
    public function getLaboName()
    {
        if ($this->getIdMagasin()) {
            $labos = json_decode($this->getIdMagasin());

            if (count($labos) == 0)
                $labo = EtageTable::getInstance()->findOneByIdMagasin($this->getIdMagasin());
            else {
                $labo = Doctrine_Core::getTable('Etage')->createQuery('a')
                    ->whereIn('id', $labos)->andWhere("is_administration is null")
                    ->execute()
                    ->getFirst();
            }
            return $labo;
        }
        return null;
    }
    public function preSave($event)
    {
        $date = date("Y-m-d H:i:s");
        $this->setUpdatedAt($date);
        if (!$this->getCreatedAt())
            $this->setCreatedAt($date);

        if (!$this->getPassword() &&  $this->getPwd()) :

        endif;
        parent::preSave($event);
    }
    public function SaveHashedPassword($user, $pwd)
    {
        $pepper = 'fnmdcm2010*101*5#mahdi';
        $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        $user->setPassword($pwd_hashed);
        $user->setPwd(null);
        $user->save();
    }
    public function postSave($event)
    {
        parent::postSave($event);
    }
    public function getValidePassword($pwd, $lists, $userSymfony)
    {
        $pepper = 'fnmdcm2010*101*5#mahdi';
        $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
        //        die($pwd_peppered);
        foreach ($lists as $user) :
            //die($pwd_peppered.'<br>'.$user->getPassword());
            if (!$user->getPassword()) :
                $this->SaveHashedPassword($user, $user->getPwd());

            endif;

            if (password_verify($pwd_peppered,   $user->getPassword())) :
                $userSymfony->setAttribute('userB2m', $user);
                // die('ok');
                return true;

            endif;

        endforeach;

        return null;
    }
    public function CheckValidePassword($pwd, $user)
    {
        $pepper = 'fnmdcm2010*101*5#mahdi';
        $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);

        if (password_verify($pwd_peppered,   $user->getPassword())) :

            return true;

        endif;



        return null;
    }
    public function getUserConnected($userSymfony)
    {
        $this->userConfig = $userSymfony;

        return $userSymfony->getAttribute('userB2m');
    }
    public function getUserByConfig()
    {
        return $this->userConfig;
    }

    public function getExpdestinataire()
    {
        $exp_dest = new Expdest();

        // recherche exp_dest

        if ($this->getIdParent()) {
            $agent = AgentsTable::getInstance()->findOneById($this->getIdParent());
            $expdest = Doctrine_Query::create()
                ->select(" e.id,  e.npresponsable")
                ->from('Expdest e')
                ->leftJoin('e.Agents a')

                ->where('a.id=' . $agent->getId())
                ->execute();

            if (count($expdest) > 0) {

                $trouve = Doctrine_Core::getTable('expdest')->findOneById($expdest[0]['id']);
                if ($trouve)
                    return $trouve;
            } else {
                $agent = new Agents();
                if ($this->getIdParent()) {
                    $ag = Doctrine_Core::getTable('agents')->findOneById($this->getIdParent());
                    if ($ag)
                        $agent = $ag;
                    $exp_dest->setNpresponsable($agent->getNomcomplet());

                    $exp_dest->setIdAgent($agent->getId());
                    $exp_dest->setDatecreation(date('Y-m-d'));
                    //            $exp_dest->setRs($agent->getBureaux()->getNombureaux());
                    $exp_dest->setRs($agent->getNomcomplet());
                    $exp_dest->save();
                }
            }
            return $exp_dest;
        }
        return null;
    }

    //_______________________________________________________ get accées nou non par lien 
    public function getAcceesDroit($acceeslogin)
    {
        $accees = false;
        $rolemodules = Doctrine_Core::getTable('rolemodule')->findByIdUser($this->getId());
        $prevelege = Doctrine_Core::getTable('prevelege')->findOneByNomprevelege($acceeslogin);
        // $accees=$prevelege.'hh'.$rolemodule;
        // die($accees);
        foreach ($rolemodules as $rolemodule) {
            if ($rolemodule && $prevelege) {

                $prevelegedroit = Doctrine_Core::getTable('prvelegedroit')->findOneByIdRoleAndIdPrevelege($rolemodule->getIdRole(), $prevelege->getId());
                if ($prevelegedroit)
                    $accees = true;
            }
        }
        return $accees;
    }

    //_____________________________________________Affiche le role du module pour chaque utilisateur
    public function getRolebymodule()
    {
        $rolemodules = Doctrine_Core::getTable('rolemodule')->findByIdUser($this->getId());
        if (count($rolemodules) > 0) {
            $chaine = "";
            foreach ($rolemodules as $rolemodule)
                $chaine .= $rolemodule . '<br>';
            echo $chaine;
        } else
            return null;
    }

    public function getRoleByLibelle($libelle)
    {
        if ($libelle != '')
            return $role = RoleTable::getInstance()->findOneByRole($libelle);
    }

    public function getProfilApplication($libelle)
    {
        if ($this->getIdProfil()) {
           
            $profil_aplication = ProfilapplicationTable::getInstance()
                ->getByIdProfilAndApplication($this->getIdProfil(), $libelle);
               
            return $profil_aplication;
        } else {
            return null;
        }
    }

    public function CanConnect($libelle_app, $libelle_module)
    {


        $profil_module = ApplicationmoduleTable::getInstance()->getByApplicationAndModule($libelle_app, $libelle_module);

        return $profil_module;
    }

    public function getProfilModule($id_application, $libelle)
    {


        $profil_module = ProfilmoduleTable::getInstance()->getByIdApplicationAndModule($id_application, $libelle);

        return $profil_module;
    }

    public function getProfilModuleAction($id_application, $libelle, $action_libelle)
    {
        $profil_module = ProfilmoduleTable::getInstance()->getByIdApplicationAndModule($id_application, $libelle);
        if ($profil_module) {
            $profil_module_action = ProfilmoduleactionTable::getInstance()->findByIdProfilmoduleAndLibelle($profil_module->getId(), $action_libelle);
            return $profil_module_action;
        } else {
            return null;
        }
    }
}