<?php

class myUser extends sfBasicSecurityUser {

    public function UserConnected() {
        $user = $this;
        
        return $user->getAttribute('userB2m');
    }

    public function resetUserConnected() {
        $this->getAttributeHolder()->remove('userB2m');
    }

    public function ClearUserConnected() {
        $this->getAttributeHolder()->clear();
    }

}
