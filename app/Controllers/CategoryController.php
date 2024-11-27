<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryMasterModel;

class CategoryController extends BaseController
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
            "title"         =>  "Category Master | ".SITE_TITLE,
            "main_content"  =>  "master/category-master",
            "loginData"     =>  $session->get('sessionData'),
        );
        return view('/innerpages/template', $pageData);
    }

    public function get_category_list()
    {
        $session            = session();
        $loginData          = $session->get('userdata');
        $request            = service('request');
        $postData           = $request->getPost();
        $categoryMasterModel= new CategoryMasterModel();
        $data               = array();
        $search             = "";
        $order              = "tbl_category_master.category_master_id";
        $orderBy            = "desc";
        $start              = $postData["start"];
        $draw               = $postData["draw"];
        $rowperpage         = $postData["length"];

        if( isset($_POST["order"][0]["column"]) && $_POST["order"][0]["column"] != "" )
        {
            $case = $_POST["order"][0]["column"];
            switch ($case) {
                case 0:
                    $order = "tbl_category_master.category_master_id";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;
                case 1:
                    $order = "tbl_category_master.category_master_name";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;                
                default:
                    $order = "tbl_category_master.category_master_id";
                    $orderBy = "DESC";
            }
        }
        //echo $order."-".$orderBy."-".$rowperpage."-".$start; die;
        $categoryMasterModelTotalData = $categoryMasterModel->findAll();
        $categoryMasterModelData      = $categoryMasterModel->orderBy($order, $orderBy)
                                                ->findAll($rowperpage, $start);

        if( isset($_POST["search"]["value"]) && $_POST["search"]["value"] != "" )
        {
            $search = $_POST["search"]["value"];

            $categoryMasterModelData = $categoryMasterModel->like("category_master_name", $search)
                                                ->orderBy($order, $orderBy)
                                                ->findAll($rowperpage, $start);
        }
        if($categoryMasterModelData)
        {
            foreach($categoryMasterModelData as $categoryMasterModelDataList )
            {
                $status = "";
                if($categoryMasterModelDataList["category_master_status"] == 1)
                { 
                    $status = '<span class="badge bg-success font-size-14 me-1">Active</span>'; 
                }
                else if($categoryMasterModelDataList["category_master_status"] == 2)
                { 
                    $status = '<span class="badge bg-warning font-size-14 me-1">Inactive</span>'; 
                }
                else
                { 
                    $status = '<span class="badge bg-danger font-size-14 me-1">Delete</span>'; 
                }
                $thisArr = array(
                    "category_master_id"        =>  $categoryMasterModelDataList["category_master_id"],
                    "category_master_name"      =>  $categoryMasterModelDataList["category_master_name"],
                    "category_master_status"    =>  $status,
                );

                $session    = session();
                $loginData  = $session->get('userdata');
                $thisArr["Action"] = '<a class="btn btn-sm btn-primary custom-action-btn updatecategory" data-category-id="'.$categoryMasterModelDataList["category_master_id"].'" data-category-name="'.$categoryMasterModelDataList["category_master_name"].'" data-category-status="'.$categoryMasterModelDataList["category_master_status"].'" data-bs-toggle="modal" data-bs-target="#updateCategoryModal" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>';
                if($categoryMasterModelDataList["category_master_status"] != 3)
                {
                    $thisArr["Action"] .= '&nbsp;<a class="btn btn-sm btn-danger custom-action-btn deletecategory" data-category-id="'.$categoryMasterModelDataList["category_master_id"].'" href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>';
                }
                array_push($data, $thisArr);
            }
        }

        $output = array(  
            "draw"              =>  intval($draw), 
            "recordsTotal"      =>  count($categoryMasterModelData),  
            "recordsFiltered"   =>  count($categoryMasterModelTotalData),  
            "data"              =>  $data  
        );  
        echo json_encode($output);
    }

    public function store_category_data()
    {
        $session            = session();
        $loginData          = $session->get('sessionData');
        $request            = service('request');
        $postData           = $request->getPost();
        $categoryMasterModel= new CategoryMasterModel();

        if( $postData["action_type"] == "act_store_category_data" && $postData["txtcategoryname"] != "" && $postData["txtcategorystatus"] != "" )
        {
            $categoryModelCheck = $categoryMasterModel->where("category_master_name",$postData["txtcategoryname"])
                                                    ->first();
            if($categoryModelCheck)
            {
                echo 3; die;
            }

            $insertdata = [
                    'category_master_name'  =>  $postData["txtcategoryname"],
                    'created_at'            =>  date("Y-m-d H:i:s"),
                    'updated_at'            =>  date("Y-m-d H:i:s"),
                    'category_master_status'=>  $postData["txtcategorystatus"],
            ];

            if($categoryMasterModel->insert($insertdata))
            {
                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }

    public function update_category_data()
    {
        //echo "<pre>"; print_r($_POST); die;
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $categoryMasterModel= new CategoryMasterModel();
        $request      = service('request');
        $postData     = $request->getPost();

        if( $postData["action_type"] == "act_update_category_data" && $postData["txtupdatecategoryname"] != "" && $postData["txtupdatecategorystatus"] != "" && $postData["txtcategoryid"] != "" )
        {
            $requestUpdateId = $postData["txtcategoryid"];
            $categoryModelCheck = $categoryMasterModel->where("category_master_name",$postData["txtupdatecategoryname"])
                                            ->where("category_master_id !=",$requestUpdateId)
                                            ->first();
            if($categoryModelCheck)
            {
                echo 3; die;
            }

            $updatedata = [
                    'category_master_name'   =>  $postData["txtupdatecategoryname"],
                    'category_master_status' =>  $postData["txtupdatecategorystatus"],
                    'updated_at'            =>  date("Y-m-d H:i:s"),
            ];
            if($categoryMasterModel->update($requestUpdateId, $updatedata))
            {
                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }

    public function delete_category_data()
    {
        //echo "<pre>"; print_r($_POST); die;
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $categoryMasterModel= new CategoryMasterModel();
        $request      = service('request');
        $postData     = $request->getPost();

        if( $postData["action_type"] == "act_delete_category_data" && $postData["deletecategoryid"] != "" )
        {
            $requestUpdateId = $postData["deletecategoryid"];
            $categoryModelCheck = $categoryMasterModel->where("category_master_id",$requestUpdateId)
                                                    ->first();
            if(!$categoryModelCheck)
            {
                echo 3; die;
            }

            $updatedata = [
                    'deleted_at'                =>  date("Y-m-d H:i:s"),
                    'category_master_status'    =>  "3",
            ];
            if($categoryMasterModel->update($requestUpdateId, $updatedata))
            {
                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }
}
