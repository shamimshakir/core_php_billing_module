<?php

class Auth{

    protected $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function authenticateUser($username, $password){

        $statement = $this->pdo->prepare("SELECT *
        FROM _nisl_mas_member
        LEFT JOIN _nisl_mas_user ON _nisl_mas_member.User_ID = _nisl_mas_user.User_ID
        WHERE _nisl_mas_member.User_Name = ? AND _nisl_mas_member.Password = ? 
        AND _nisl_mas_user.user_status = ? LIMIT 1 ");

        $statement->execute(array($username, $password, 1));

        $findedRow = $statement->rowCount();

        if($findedRow > 0){

            $userInfos = $statement->fetch(PDO::FETCH_OBJ);            
            
            if($userInfos){

                // Set User Data in Session

                Session::init();

                Session::set('login', true);

                Session::set('SUserID', $userInfos->User_ID);

                Session::set('SUserName', $userInfos->User_Name);

                Session::set('Ssuboffice_id', $userInfos->suboffice_id);

                Session::set('SDesignation', $userInfos->Designation);

                Session::set('SType', $userInfos->Type);

                Session::set('reseller_id', $userInfos->reseller_id);

            }

            header("Location: index.php");

        }else{

            return 'Invalid username or password';

        }

    }

}