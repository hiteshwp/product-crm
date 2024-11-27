<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $session = session();
        //echo "<pre>"; print_r($session); die;
        if( !$session->has('sessionData') )
        {
            $session = session();
            header("Location: ".base_url("/"));
            die;
            
        }
    }

    public function index()
    {
        $session = session();
        $pageData   =   array(
            "title"         =>  "Dashboard | ".SITE_TITLE,
            "main_content"  =>  "dashboard",
            "loginData"     =>  $session->get('sessionData'),
        );
        return view('/innerpages/template', $pageData);
    }

    public function logout()
    {
        $session = session();
        unset($_SESSION['sessionData']);
        $session->setFlashdata('logout-success', 'You have successfully Logout!.');
        return redirect()->to('/');
    }
}
