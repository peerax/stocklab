<?php

class UserIdentity extends CUserIdentity
{

   private $_id;
   public function authenticate()
   {
       $record=LsUser::model()->findByAttributes(array('u_name'=>$this->username));  // here I use Email as user name which comes from database
       if($record===null)
               {
                       $this->_id='user Null';
                                   $this->errorCode=self::ERROR_USERNAME_INVALID;
               }
       else if($record->u_pass!==$this->password)            // here I compare db password with passwod field
               {        $this->_id=$this->username;
                       $this->errorCode=self::ERROR_PASSWORD_INVALID;
               }
        
       else
       {  
           $this->_id=$record->u_id;
           $this->setState('id', $record->u_id);
           $this->setState('name', $record->u_fname);
           $this->errorCode=self::ERROR_NONE;

       }
       return !$this->errorCode;
   }

   public function getId()       //  override Id
   {
       return $this->_id;
   }

}