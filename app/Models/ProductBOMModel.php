<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductBOMModel extends Model
{
    protected $table            = 'tbl_product_bom_details';
    protected $primaryKey       = 'product_bom_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["product_bom_id", "product_bom_product_id", "product_bom_component_id", "product_bom_specifications", "product_bom_value", "product_bom_price", "product_bom_qty", "product_bom_total_price", "created_at", "updated_at", "deleted_at", "product_bom_status"];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
