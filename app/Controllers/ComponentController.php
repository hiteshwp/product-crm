<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComponentMasterModel;

class ComponentController extends BaseController
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
            "title"         =>  "Component Master | ".SITE_TITLE,
            "main_content"  =>  "master/component-master",
            "loginData"     =>  $session->get('sessionData'),
        );
        return view('/innerpages/template', $pageData);
    }

    public function get_component_list()
    {
        $session            = session();
        $loginData          = $session->get('userdata');
        $request            = service('request');
        $postData           = $request->getPost();
        $componentMasterModel= new ComponentMasterModel();
        $data               = array();
        $search             = "";
        $order              = "tbl_component_master.component_master_id";
        $orderBy            = "desc";
        $start              = $postData["start"];
        $draw               = $postData["draw"];
        $rowperpage         = $postData["length"];

        if( isset($_POST["order"][0]["column"]) && $_POST["order"][0]["column"] != "" )
        {
            $case = $_POST["order"][0]["column"];
            switch ($case) {
                case 0:
                    $order = "tbl_component_master.component_master_id";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;
                case 1:
                    $order = "tbl_component_master.component_master_category";
                    $orderBy = $_POST["order"][0]["dir"];
                    break; 
                case 2:
                    $order = "tbl_component_master.component_master_specification";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;
                case 3:
                    $order = "tbl_component_master.component_master_value";
                    $orderBy = $_POST["order"][0]["dir"];
                    break; 
                case 4:
                    $order = "tbl_component_master.component_master_price";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;               
                default:
                    $order = "tbl_component_master.component_master_id";
                    $orderBy = "DESC";
            }
        }
        //echo $order."-".$orderBy."-".$rowperpage."-".$start; die;
        $componentMasterModelTotalData = $componentMasterModel->findAll();
        $componentMasterModelData      = $componentMasterModel->orderBy($order, $orderBy)
                                                ->findAll($rowperpage, $start);

        if( isset($_POST["search"]["value"]) && $_POST["search"]["value"] != "" )
        {
            $search = $_POST["search"]["value"];

            $componentMasterModelData = $componentMasterModel->like("component_master_category", $search)
                                                            ->orLike("component_master_specification", $search,'after')
                                                            ->orLike("component_master_value", $search,'after')
                                                            ->orLike("component_master_price", $search,'after')
                                                            ->orderBy($order, $orderBy)
                                                            ->findAll($rowperpage, $start);
        }
        if($componentMasterModelData)
        {
            foreach($componentMasterModelData as $componentMasterModelDataList )
            {
                $status = "";
                if($componentMasterModelDataList["component_master_status"] == 1)
                { 
                    $status = '<span class="badge bg-success font-size-14 me-1">Active</span>'; 
                }
                else if($componentMasterModelDataList["component_master_status"] == 2)
                { 
                    $status = '<span class="badge bg-warning font-size-14 me-1">Inactive</span>';
                }
                else
                { 
                     $status = '<span class="badge bg-danger font-size-14 me-1">Delete</span>'; 
                }
                $thisArr = array(
                    "component_master_id"           =>  $componentMasterModelDataList["component_master_id"],
                    "component_master_category"     =>  $componentMasterModelDataList["component_master_category"],
                    "component_master_specification"=>  $componentMasterModelDataList["component_master_specification"],
                    "component_master_value"        =>  $componentMasterModelDataList["component_master_value"],
                    "component_master_price"        =>  $componentMasterModelDataList["component_master_price"],
                    "component_master_status"       =>  $status,
                );

                $session    = session();
                $loginData  = $session->get('userdata');
                $thisArr["Action"] = '<a class="btn btn-sm btn-primary custom-action-btn updatecomponentcategory" data-component-id="'.$componentMasterModelDataList["component_master_id"].'" data-component-name="'.$componentMasterModelDataList["component_master_category"].'" data-component-specification="'.$componentMasterModelDataList["component_master_specification"].'" data-component-value="'.$componentMasterModelDataList["component_master_value"].'" data-component-price="'.$componentMasterModelDataList["component_master_price"].'" data-component-status="'.$componentMasterModelDataList["component_master_status"].'" data-bs-toggle="modal" data-bs-target="#updateCategoryModal" href="javascript:void(0);"><i class="fa fa-edit"></i> Edit</a>';
                if($componentMasterModelDataList["component_master_status"] != 3 )
                { 
                    $thisArr["Action"] .= '&nbsp;<a class="btn btn-sm btn-danger custom-action-btn deletecomponent" data-component-id="'.$componentMasterModelDataList["component_master_id"].'"  href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>'; 
                }
                    
                array_push($data, $thisArr);
            }
        }

        $output = array(  
            "draw"              =>  intval($draw), 
            "recordsTotal"      =>  count($componentMasterModelData),  
            "recordsFiltered"   =>  count($componentMasterModelTotalData),  
            "data"              =>  $data  
        );  
        echo json_encode($output);
    }

    public function store_component_category_data()
    {
        $session            = session();
        $loginData          = $session->get('sessionData');
        $request            = service('request');
        $postData           = $request->getPost();
        $componentMasterModel= new ComponentMasterModel();

        if( $postData["action_type"] == "act_store_component_category_data" && $postData["txtcomponentcategory"] != "" && $postData["txtcomponentcategoryspecification"] != "" && $postData["txtcomponentvalue"] != "" && $postData["txtcomponentprice"] != "" && $postData["txtcomponentstatus"] != "" )
        {
            $componentMasterModelCheck = $componentMasterModel->where("component_master_category",$postData["txtcomponentcategory"])
                                                    ->first();
            if($componentMasterModelCheck)
            {
                echo 3; die;
            }

            $insertdata = [
                    'component_master_category'     =>  $postData["txtcomponentcategory"],
                    'component_master_specification'=>  $postData["txtcomponentcategoryspecification"],
                    'component_master_value'        =>  $postData["txtcomponentvalue"],
                    'component_master_price'        =>  $postData["txtcomponentprice"],
                    'created_at'                    =>  date("Y-m-d H:i:s"),
                    'updated_at'                    =>  date("Y-m-d H:i:s"),
                    'component_master_status'       =>  $postData["txtcomponentstatus"],
            ];

            if($componentMasterModel->insert($insertdata))
            {
                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }

    public function update_component_category_data()
    {
        //echo "<pre>"; print_r($_POST); die;
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $componentMasterModel = new ComponentMasterModel();
        $request      = service('request');
        $postData     = $request->getPost();

        if( $postData["action_type"] == "act_update_component_category_data" && $postData["txtupdatecomponentcategory"] != "" && $postData["txtupdatecomponentcategoryspecification"] != "" && $postData["txtupdatecomponentvalue"] != "" && $postData["txtupdatecomponentprice"] != "" && $postData["txtupdatecomponentstatus"] != "" && $postData["componentcategoryid"] != "" )
        {
            $requestUpdateId = $postData["componentcategoryid"];
            $componentMasterModelCheck = $componentMasterModel->where("component_master_category",$postData["txtupdatecomponentcategory"])
                                            ->where("component_master_id !=",$requestUpdateId)
                                            ->first();
            if($componentMasterModelCheck)
            {
                echo 3; die;
            }

            $updatedata = [
                'component_master_category'     =>  $postData["txtupdatecomponentcategory"],
                'component_master_specification'=>  $postData["txtupdatecomponentcategoryspecification"],
                'component_master_value'        =>  $postData["txtupdatecomponentvalue"],
                'component_master_price'        =>  $postData["txtupdatecomponentprice"],
                'updated_at'                    =>  date("Y-m-d H:i:s"),
                'component_master_status'       =>  $postData["txtupdatecomponentstatus"],
            ];

            if($componentMasterModel->update($requestUpdateId, $updatedata))
            {
                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }

    public function delete_component_category_data()
    {
        //echo "<pre>"; print_r($_POST); die;
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $componentMasterModel = new ComponentMasterModel();
        $request      = service('request');
        $postData     = $request->getPost();

        if( $postData["action_type"] == "act_delete_component_data" && $postData["deletecomponentid"] != "" )
        {
            $requestUpdateId = $postData["deletecomponentid"];
            $componentMasterModelCheck = $componentMasterModel->where("component_master_id",$requestUpdateId)
                                                                ->first();
            if(!$componentMasterModelCheck)
            {
                echo 3; die;
            }

            $updatedata = [
                    'deleted_at'                =>  date("Y-m-d H:i:s"),
                    'component_master_status'   =>  "3",
            ];
            if($componentMasterModel->update($requestUpdateId, $updatedata))
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
