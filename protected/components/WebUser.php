<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;

    // This is a function that checks the field 'role'
    // in the User model to be equal to 1, that means it's admin
    // access it by Yii::app()->user->isAdmin()
    function isAdmin() {
        
 
        if(isset(Yii::app()->user->id)){
            
            $pieces = explode("r=", Yii::app()->request->getUrl());
            $pieces = explode("%2", $pieces[1]);
            $pieces = explode("/", $pieces[0]);
            $page = new LsPage;
            $res = $page->findByAttributes(array('page_name'=>$pieces[0]));
            $page = new LsAuth;
            $res = $page->findByAttributes(array('page_id'=>$res['page_id'],'u_id'=>(Yii::app()->user->id)));
            if ($res->auth == 1) {
                return true;
            } else {
                return false;
        }}
        
    }

}

?>
