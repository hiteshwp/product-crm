<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminMasterModel;

class LoginController extends BaseController
{
    public function index()
    {
        $admin_master_model = new AdminMasterModel();
        $admin_data = $admin_master_model->countAll();
        if( $admin_data == 0 )
        {
            $pageData = array(
                "pageTitle" =>  "New Company Registration | ".SITE_TITLE,
            );
            return view("registration", $pageData);
        }
        else
        {
            $pageData = array(
                "pageTitle" =>  "Login | ".SITE_TITLE,
            );
            return view("login", $pageData);
        }
        
    }

    public function company_registration()
    {
        $encrypter          = \Config\Services::encrypter();
        $admin_master_model = new AdminMasterModel();

        if( isset($_POST) && isset($_POST["action"]) && $_POST["action"] == "act_new_company_registratopm" && isset($_POST["txtcompanyname"]) && isset($_POST["txtownername"]) && isset($_POST["txtemailaddress"]) && isset($_POST["txtpassword"]) )
        {
            $login_password = $encrypter->encrypt($_POST["txtpassword"]);


            $store_data = array(
                "admin_master_owner_name"   =>  trim($_POST["txtownername"]),
                "admin_master_company_name" =>  trim($_POST["txtcompanyname"]),
                "admin_master_email_address"=>  trim($_POST["txtemailaddress"]),
                "admin_master_password"     =>  $login_password,
                "created_at"                =>  date("Y-m-d H:i:s"),
            );

            if( $admin_master_model->insert($store_data) )
            {
                $response = array(
                    "status"    =>  "Success",
                    "msg"       =>  "Company created successfully!.",
                );
            }
            else
            {
                $response = array(
                    "status"    =>  "Fail",
                    "msg"       =>  "Something went wrong!.",
                );
            }
        }
        else
        {
            $response = array(
                "status"    =>  "Fail",
                "msg"       =>  "Perameters is missing!.",
            );
        }

        echo json_encode($response); die;
    }

    public function login()
    {
        $session            = session();
        $encrypter          = \Config\Services::encrypter();
        $admin_master_model = new AdminMasterModel();
        $response = "";

        if( isset($_POST) && isset($_POST["action"]) && $_POST["action"] == "act_login" && isset($_POST["txtemailaddress"]) && isset($_POST["txtpassword"]) )
        {
            $loginData = $admin_master_model->select("admin_master_id, admin_master_owner_name, admin_master_company_name, admin_master_email_address, admin_master_password")
                                            ->where("admin_master_email_address", trim($_POST["txtemailaddress"]))
                                            ->where("admin_master_status", "1")
                                            ->first();
            if( $loginData )
            {
                if( trim($_POST["txtpassword"]) == $encrypter->decrypt($loginData["admin_master_password"]) )
                {
                    $sessionData = [
                        'login_id'              => $loginData['admin_master_id'],
                        'login_full_name'       => $loginData['admin_master_owner_name'],  
                        'login_company_name'    => $loginData['admin_master_company_name'],
                        'login_email_address'   => $loginData['admin_master_email_address'],
                        'isLoggedIn'            => TRUE,
                        'login_type'            => "Super Admin",
                    ];
                    $session->set("sessionData", $sessionData);

                    $session->setFlashdata('login-success', 'Welcomes to Niks Entertainment Portal!.');

                    $response = array(
                        "status"    =>  "Success",
                        "msg"       =>  "You have Successfully Login!.",
                    );
                }
                else
                {
                    $response = array(
                        "status"    =>  "Fail",
                        "msg"       =>  "Invalid Login Credentials!.",
                    );
                }
            }
            /*else
            {
                $branchLoginData = $branchUserModel->select("tbl_branch_user.*, tbl_branch.branch_name")
                                                    ->join("tbl_branch", "tbl_branch.branch_id=tbl_branch_user.branch_id")
                                                    ->where("tbl_branch_user.branch_user_email_address", trim($_POST["loginemailaddress"]))
                                                    ->where("tbl_branch_user.branch_user_status", "1")
                                                    ->first();
                //echo "<pre>"; print_r($branchLoginData); die;
                if( $branchLoginData )
                {
                    if( trim($_POST["loginpassword"]) == $encrypter->decrypt($branchLoginData["branch_user_password"]) )
                    {
                        //echo "<pre>"; print_r($branchLoginData); die;

                        $sessionData = [
                            'login_id'              => $branchLoginData['branch_user_id'],
                            'login_full_name'       => $branchLoginData['branch_user_full_name'],
                            'admin_email_address'   => $branchLoginData['branch_user_email_address'],
                            'access_list'           => $branchLoginData['branch_user_access_control'],
                            'isLoggedIn'            => TRUE,
                            'login_type'            => "Branch User",
                            'login_branch'          => $branchLoginData['branch_name'],
                            'login_branch_id'       => $branchLoginData['branch_id']
                        ];
                        $session->set("sessionData", $sessionData);

                        $session->setFlashdata('login-success', 'Welcomes to Niks Entertainment Portal!.');

                        $response = array(
                            "status"    =>  "Success",
                            "msg"       =>  "Yo have Successfully Login!.",
                        );
                    }
                    else
                    {
                        $response = array(
                            "status"    =>  "Fail",
                            "msg"       =>  "Invalid Login Credentials !.",
                        );
                    }
                }
                else
                {
                    $response = array(
                        "status"    =>  "Fail",
                        "msg"       =>  "Invalid Login Credentials !.",
                    );
                }
            }*/
        }
        else
        {
            $response = array(
                "status"    =>  "Fail",
                "msg"       =>  "Perameters is missing!.",
            );
        }

        echo json_encode($response); die;
    }

}
