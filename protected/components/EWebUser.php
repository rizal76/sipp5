<?php
class EWebUser extends CWebUser{
 
    protected $_model;
 
    function isAdmin(){
        $user = $this->loadUser();
        if ($user)
           return $user->level_id==LevelLookUp::ADMIN;
        return false;
    }
 	
 	 function isSuperAdmin(){
        $user = $this->loadUser();
        if ($user)
           return $user->level_id==LevelLookUp::SUPERADMIN;
        return false;
    }
     function isMember(){
        $user = $this->loadUser();
        if ($user)
           return $user->level_id==LevelLookUp::MEMBER;
        return false;
    }
    // Load user model.
    protected function loadUser()
    {
        if ( $this->_model === null ) {
                $this->_model = User::model()->findByPk( $this->id );
        }
        return $this->_model;
    }
}