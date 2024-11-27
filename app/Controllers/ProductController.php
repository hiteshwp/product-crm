<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductMasterModel;
use App\Models\CategoryMasterModel;
use App\Models\ComponentMasterModel;
use App\Models\ProductSpecificationModel;
use App\Models\ProductBOMModel;
use App\Models\ProductDocumentsModel;

class ProductController extends BaseController
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
        $productMasterModel         = new ProductMasterModel();

        $productMaster_data = $productMasterModel->select("tbl_product_master.*, tbl_category_master.category_master_name")
                                                ->join("tbl_category_master", "tbl_category_master.category_master_id=tbl_product_master.product_category_id")
                                                ->where("tbl_product_master.product_status", "1")
                                                ->findAll();

        $pageData   =   array(
            "title"                 =>  "Product Listing | ".SITE_TITLE,
            "main_content"          =>  "product/list",
            "loginData"             =>  $session->get('sessionData'),
            "product_master_data"   =>  $productMaster_data
        );
        return view('/innerpages/template', $pageData);
    }

    public function get_product_list()
    {
        $session            = session();
        $loginData          = $session->get('userdata');
        $request            = service('request');
        $postData           = $request->getPost();
        $productMasterModel = new ProductMasterModel();
        $data               = array();
        $search             = "";
        $order              = "tbl_product_master.product_id";
        $orderBy            = "desc";
        $start              = $postData["start"];
        $draw               = $postData["draw"];
        $rowperpage         = $postData["length"];

        if( isset($_POST["order"][0]["column"]) && $_POST["order"][0]["column"] != "" )
        {
            $case = $_POST["order"][0]["column"];
            switch ($case) {
                case 0:
                    $order = "tbl_product_master.product_id";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;
                case 1:
                    $order = "tbl_category_master.category_master_name";
                    $orderBy = $_POST["order"][0]["dir"];
                    break; 
                case 2:
                    $order = "tbl_product_master.product_model";
                    $orderBy = $_POST["order"][0]["dir"];
                    break; 
                case 3:
                    $order = "tbl_product_master.product_total_amount";
                    $orderBy = $_POST["order"][0]["dir"];
                    break; 
                case 4:
                    $order = "tbl_product_master.created_at";
                    $orderBy = $_POST["order"][0]["dir"];
                    break;           
                default:
                    $order = "tbl_product_master.product_id";
                    $orderBy = "DESC";
            }
        }
        //echo $order."-".$orderBy."-".$rowperpage."-".$start; die;
        $productMasterModelTotalData = $productMasterModel->findAll();
        $productMasterModelData      = $productMasterModel->select("tbl_product_master.*, tbl_category_master.category_master_name")
                                                            ->join("tbl_category_master", "tbl_category_master.category_master_id=tbl_product_master.product_category_id")
                                                            ->orderBy($order, $orderBy)
                                                            ->findAll($rowperpage, $start);

        if( isset($_POST["search"]["value"]) && $_POST["search"]["value"] != "" )
        {
            $search = $_POST["search"]["value"];

            $productMasterModelData = $productMasterModel->select("tbl_product_master.*, tbl_category_master.category_master_name")
                                                        ->join("tbl_category_master", "tbl_category_master.category_master_id=tbl_product_master.product_category_id")
                                                        ->like("tbl_product_master.product_model", $search)
                                                        ->orLike("tbl_category_master.category_master_name", $search,'after')
                                                        ->orLike("tbl_product_master.product_total_amount", $search,'after')
                                                        ->orLike("tbl_product_master.created_at", $search,'after')
                                                        ->orderBy($order, $orderBy)
                                                        ->findAll($rowperpage, $start);
        }
        if($productMasterModelData)
        {
            foreach($productMasterModelData as $productMasterModelDataList )
            {
                $status = "";
                if($productMasterModelDataList["product_status"] == 1)
                { 
                    $status = '<span class="badge bg-success font-size-14 me-1">Active</span>'; 
                }
                else if($productMasterModelDataList["product_status"] == 2)
                { 
                    $status = '<span class="badge bg-warning font-size-14 me-1">Inactive</span>';
                }
                else
                { 
                     $status = '<span class="badge bg-danger font-size-14 me-1">Delete</span>'; 
                }
                $thisArr = array(
                    "product_id"            =>  $productMasterModelDataList["product_id"],
                    "product_model"         =>  $productMasterModelDataList["product_model"],
                    "product_category_name" =>  $productMasterModelDataList["category_master_name"],
                    "product_total_amount"  =>  $productMasterModelDataList["product_total_amount"],
                    "product_created"       =>  date("d-m-Y", strtotime($productMasterModelDataList["created_at"])),
                    "product_status"        =>  $status,
                );

                $thisArr["Action"] = '<a class="btn btn-sm btn-primary custom-action-btn" href="'.site_url("product/edit").'/'.$productMasterModelDataList["product_id"].'"><i class="fa fa-edit"></i> Edit</a>';
                $thisArr["Action"] .= '&nbsp;<a class="btn btn-sm btn-dark custom-action-btn" href="'.site_url("product/upload-documents").'/'.$productMasterModelDataList["product_id"].'"><i class="fa fa-upload"></i> Upload Documents</a>';
                if($productMasterModelDataList["product_document_upload"] == 1 )
                { 
                    $thisArr["Action"] .= '&nbsp;<a class="btn btn-sm btn-success custom-action-btn" href="'.site_url("product/download-documents").'/'.$productMasterModelDataList["product_id"].'"><i class="fa fa-download"></i> Download Documents</a>';
                }
                
                if($productMasterModelDataList["product_status"] != 3 )
                { 
                    $thisArr["Action"] .= '&nbsp;<a class="btn btn-sm btn-danger custom-action-btn deletecomponent" data-product-id="'.$productMasterModelDataList["product_id"].'"  href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>'; 
                }
                    
                array_push($data, $thisArr);
            }
        }

        $output = array(  
            "draw"              =>  intval($draw), 
            "recordsTotal"      =>  count($productMasterModelData),  
            "recordsFiltered"   =>  count($productMasterModelTotalData),  
            "data"              =>  $data  
        );  
        echo json_encode($output);
    }

    public function new_product()
    {
        $session = session();
        $categoryMasterModel = new CategoryMasterModel();
        $componentMasterModel = new ComponentMasterModel();

        $categoryMasterModelData = $categoryMasterModel->where("category_master_status", "1")
                                                    ->findAll();

        $componentMasterModelData = $componentMasterModel->where("component_master_status", "1")
                                                    ->findAll();
        $pageData   =   array(
            "title"         =>  "New Product Detail | ".SITE_TITLE,
            "main_content"  =>  "product/new",
            "loginData"     =>  $session->get('sessionData'),
            "categoryData"  =>  $categoryMasterModelData,
            "componentData" =>  $componentMasterModelData,
        );
        return view('/innerpages/template', $pageData);
    }

    public function store_product_data()
    {
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $productMasterModel         = new ProductMasterModel();
        $productBOMModel            = new ProductBOMModel();
        $productSpecificationModel  = new ProductSpecificationModel();

        $request  = service('request');
        $postData = $request->getPost();
        $totalQty = 0;
        $cur_date = date("Y-m-d H:i:s");

        if( $postData["action_type"] == "act_store_product_data" && $postData["txtproductmodel"] != "" && $postData["txtproductcategory"] != "" && $postData["bomtotalprice"] != "" )
        {
            $productMasterModelCheck = $productMasterModel->where("product_model",$postData["txtproductmodel"])
                                                            ->first();
            if($productMasterModelCheck)
            {
                echo 3; die;
            }

            $insertdata = [
                'product_category_id'       =>  $postData["txtproductcategory"],
                'product_model'             =>  $postData["txtproductmodel"],
                'product_total_amount'      =>  $postData["bomtotalprice"],
                'product_document_upload'   =>  "2",
                'created_at'                =>  $cur_date,
                'updated_at'                =>  $cur_date,
                'product_status'            =>  "1",
            ];

            if($productMasterModel->insert($insertdata))
            {
                $lastInsertId = $productMasterModel->getInsertID();

                if( $postData["txtcomponentdetail"] )
                {
                    for( $i=0; $i < count($postData["txtcomponentdetail"]); $i++ )
                    {
                        $product_bom_data = [
                            "product_bom_product_id"        =>  $lastInsertId,
                            "product_bom_component_id"      =>  $postData["txtcomponentdetail"][$i],
                            "product_bom_specifications"    =>  $postData["txtproductspecification"][$i],
                            "product_bom_value"             =>  $postData["txtproductvalue"][$i],
                            "product_bom_price"             =>  $postData["txtproductprice"][$i],
                            "product_bom_qty"               =>  $postData["txtproductqty"][$i],
                            "product_bom_total_price"       =>  $postData["txtproducttotalprice"][$i],
                            "created_at"                    =>  $cur_date,
                            "updated_at"                    =>  $cur_date,
                            "product_bom_status"            =>  "1",
                        ];

                        $productBOMModel->insert($product_bom_data);
                    }
                }

                if( $postData["txtspecificationtype"] && $postData["txtspecificationvalue"] )
                {
                    for( $i=0; $i < count($postData["txtspecificationtype"]); $i++ )
                    {
                        $product_specification_data = [
                            "product_master_id"             =>  $lastInsertId,
                            "product_specification_type"    =>  $postData["txtspecificationtype"][$i],
                            "product_specification_value"   =>  $postData["txtspecificationvalue"][$i],
                            "created_at"                    =>  $cur_date,
                            "updated_at"                    =>  $cur_date,
                            "product_specification_status"  =>  "1",
                        ];

                        $productSpecificationModel->insert($product_specification_data);
                    }
                }

                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }

    public function edit_product($id = 0)
    {
        $session = session();
        $categoryMasterModel        = new CategoryMasterModel();
        $componentMasterModel       = new ComponentMasterModel();
        $productMasterModel         = new ProductMasterModel();
        $productBOMModel            = new ProductBOMModel();
        $productSpecificationModel  = new ProductSpecificationModel();

        $categoryMasterModelData        = $categoryMasterModel->where("category_master_status", "1")->findAll();
        $componentMasterModelData       = $componentMasterModel->where("component_master_status", "1")->findAll();
        $productData                    = $productMasterModel->where("product_id", $id)->first();
        $productBOMModelData            = $productBOMModel->where("product_bom_product_id", $id)->where("product_bom_status", "1")->findAll();
        $productSpecificationModelData  = $productSpecificationModel->where("product_master_id", $id)->where("product_specification_status", "1")->findAll();

        if( ! $productData )
        {
            $session->setFlashdata("error-message", " Invalid Product Id");
            return redirect()->to('/product/list');
        }

        $pageData   =   array(
            "title"                         =>  "Edit Product Detail | ".SITE_TITLE,
            "main_content"                  =>  "product/edit",
            "loginData"                     =>  $session->get('sessionData'),
            "product_id"                    =>  $id,
            "categoryData"                  =>  $categoryMasterModelData,
            "componentData"                 =>  $componentMasterModelData,
            "productData"                   =>  $productData,
            "productBOMModelData"           =>  $productBOMModelData,
            "productSpecificationModelData" =>  $productSpecificationModelData,
        );

        return view('/innerpages/template', $pageData);
    }

    public function upload_documents($id = 0)
    {
        $session = session();
        $pageData   =   array(
            "title"         =>  "Upload Product Documents | ".SITE_TITLE,
            "main_content"  =>  "product/upload-documents",
            "loginData"     =>  $session->get('sessionData'),
            "product_id"    =>  $id,
        );
        return view('/innerpages/template', $pageData);
    }

    public function store_upload_product_documents()
    {
        $session    = session();
        $loginData  = $session->get('sessionData');
        $request    = service('request');
        $postData   = $request->getPost();
        $upload_data= $request->getFiles();
        $productDocumentsModel = new ProductDocumentsModel();
        $productMasterModel    = new ProductMasterModel();

        $product_id = $postData["product_id"];

        //echo "<pre>"; print_r($postData); print_r($upload_data); die;

        $baseUploadPath = 'uploads/documents/';
        if (!is_dir($baseUploadPath)) {
            mkdir($baseUploadPath, 0777, TRUE); // Create base directory if it doesn't exist
        }

        // Document types and respective subdirectories
        $document_directories = [
            'design_documents'  => 'design',
            'randd_documents'   => 'r&d',
            'customer_documents'=> 'customer',
        ];

        $data_to_insert = [];

        foreach ($document_directories as $inputName => $subdirectory) 
        {
            $files = $request->getFileMultiple($inputName); // Get multiple files for this input
            
            if ($files) {
                $uploadPath = $baseUploadPath . $subdirectory . '/';

                // Ensure subdirectory exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                foreach ($files as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // Generate unique file name
                        $newName = $file->getRandomName();
                        $ext     = $file->getClientExtension();
                        $name    = str_replace(".".$ext, "", $file->getName());

                        // Move file to the correct directory
                        if ($file->move($uploadPath, $newName)) {
                            // Prepare document data
                            $documents[] = [
                                'product_documents_product_id'  => $product_id,
                                'product_documents_type'        => $subdirectory,
                                'product_documents_path'        => $subdirectory . '/' . $newName,
                                'product_documents_title'       => $name,
                                'product_documents_extension'   => $ext,
                                'created_at'                    => date('Y-m-d H:i:s'),
                                'updated_at'                    => date('Y-m-d H:i:s'),
                                'product_documents_status'      => "1",
                            ];
                        }
                    }
                }
            }
        }

        if (!empty($documents)) {
            $productDocumentsModel->insertBatch($documents); // Use model's batch insert method
            $update_data = array(
                "product_document_upload" => "1"
            );
            $productMasterModel->update($product_id, $update_data);
            echo 1; die;
        } else {
            echo 2; die;
        }
    }

    public function download_documents($id = 0)
    {
        $session = session();
        $productDocumentsModel = new ProductDocumentsModel();

        $design_data = $productDocumentsModel->where("product_documents_status", "1")
                                                ->where("product_documents_type", "design")
                                                ->where("product_documents_product_id", $id)
                                                ->findAll();  

        $randd_data = $productDocumentsModel->where("product_documents_status", "1")
                                                ->where("product_documents_type", "r&d")
                                                ->where("product_documents_product_id", $id)
                                                ->findAll();   

        $customer_data = $productDocumentsModel->where("product_documents_status", "1")
                                                ->where("product_documents_type", "customer")
                                                ->where("product_documents_product_id", $id)
                                                ->findAll();                                    

        $pageData   =   array(
            "title"         =>  "Download Product Documents | ".SITE_TITLE,
            "main_content"  =>  "product/download-documents",
            "loginData"     =>  $session->get('sessionData'),
            "product_id"    =>  $id,
            "design_data"   =>  $design_data,
            "randd_data"    =>  $randd_data,
            "customer_data" =>  $customer_data,
        );
        return view('/innerpages/template', $pageData);
    }

    public function delete_product_documents()
    {
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $productDocumentsModel = new ProductDocumentsModel();
        $request      = service('request');
        $postData     = $request->getPost();

        if( $postData["action_type"] == "act_delete_product_document_data" && $postData["deletedocumenttid"] != "" )
        {
            $requestUpdateId = $postData["deletedocumenttid"];
            $productDocumentsModelCheck = $productDocumentsModel->where("product_documents_id",$requestUpdateId)
                                                    ->first();
            if(!$productDocumentsModelCheck)
            {
                echo 3; die;
            }


            /*$delete_file = ROOTPATH."uploads/documentS/".$productDocumentsModelCheck["product_documents_path"];

            if( unlink($delete_file) )
            {*/
                $updatedata = [
                        'deleted_at'                =>  date("Y-m-d H:i:s"),
                        'product_documents_status'  =>  "3",
                ];
                if($productDocumentsModel->update($requestUpdateId, $updatedata))
                {
                    echo 1; die;
                }
                else
                {
                    echo 2; die;
                }
            /*}
            else
            {
                echo 2; die;
            }*/
        }
    }

    public function update_product_data()
    {
        $session    = session();
        $loginData  = $session->get('sessionData');
        
        $productMasterModel         = new ProductMasterModel();
        $productBOMModel            = new ProductBOMModel();
        $productSpecificationModel  = new ProductSpecificationModel();

        $request  = service('request');
        $postData = $request->getPost();
        //echo "<pre>"; print_r($postData); die;
        $totalQty = 0;
        $cur_date = date("Y-m-d H:i:s");

        if( $postData["action_type"] == "act_update_product_data" && $postData["txtproductmodel"] != "" && $postData["txtproductcategory"] != "" && $postData["bomtotalprice"] != "" && $postData["product_id"] != "" && $postData["txtproductstatus"] != "")
        {
            $product_id = $postData["product_id"];
            $productMasterModelCheck = $productMasterModel->where("product_model",$postData["txtproductmodel"])
                                                            ->where("product_id !=", $product_id)
                                                            ->first();
            if($productMasterModelCheck)
            {
                echo 3; die;
            }

            $updatedata = [
                'product_category_id'       =>  $postData["txtproductcategory"],
                'product_model'             =>  $postData["txtproductmodel"],
                'product_total_amount'      =>  $postData["bomtotalprice"],
                'updated_at'                =>  $cur_date,
                'product_status'            =>  $postData["txtproductstatus"],
            ];

            if($productMasterModel->update($product_id, $updatedata))
            {
                $productBOMModel->where("product_bom_product_id", $product_id)->delete();
                $productSpecificationModel->where("product_master_id", $product_id)->delete();

                if( $postData["txtcomponentdetail"] )
                {
                    for( $i=0; $i < count($postData["txtcomponentdetail"]); $i++ )
                    {
                        $product_bom_data = [
                            "product_bom_product_id"        =>  $product_id,
                            "product_bom_component_id"      =>  $postData["txtcomponentdetail"][$i],
                            "product_bom_specifications"    =>  $postData["txtproductspecification"][$i],
                            "product_bom_value"             =>  $postData["txtproductvalue"][$i],
                            "product_bom_price"             =>  $postData["txtproductprice"][$i],
                            "product_bom_qty"               =>  $postData["txtproductqty"][$i],
                            "product_bom_total_price"       =>  $postData["txtproducttotalprice"][$i],
                            "created_at"                    =>  $cur_date,
                            "updated_at"                    =>  $cur_date,
                            "product_bom_status"            =>  "1",
                        ];

                        $productBOMModel->insert($product_bom_data);
                    }
                }

                if( $postData["txtspecificationtype"] && $postData["txtspecificationvalue"] )
                {
                    for( $i=0; $i < count($postData["txtspecificationtype"]); $i++ )
                    {
                        $product_specification_data = [
                            "product_master_id"             =>  $product_id,
                            "product_specification_type"    =>  $postData["txtspecificationtype"][$i],
                            "product_specification_value"   =>  $postData["txtspecificationvalue"][$i],
                            "created_at"                    =>  $cur_date,
                            "updated_at"                    =>  $cur_date,
                            "product_specification_status"  =>  "1",
                        ];

                        $productSpecificationModel->insert($product_specification_data);
                    }
                }

                echo 1; die;
            }
            else
            {
                echo 2; die;
            }
        }
    }
}
