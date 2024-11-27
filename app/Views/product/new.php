<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <form id="frmnewproductdetail" method="post">
                  <div class="card-header d-flex align-items-start">
                     <h4 class="card-title mb-0 flex-grow-1">New Product Details</h4>
                     <a href="<?php echo base_url("product/list"); ?>" class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0">Product Listing</a>
                  </div>
                  <div class="card-body">
                     <?php echo csrf_field(); ?>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="form-group mb-3">
                              <label>Product Model</label>
                              <input type="text" name="txtproductmodel" class="form-control" data-parsley-required-message="Product Name field is required" id="txtproductmodel" placeholder="Enter Product Name" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group mb-3">
                              <label>Product Category</label>
                              <select class="form-select" name="txtproductcategory" id="txtproductcategory" required>
                                 <option value="">Select Category</option> 
                                 <?php
                                    if( $categoryData )
                                    {
                                       foreach( $categoryData as $categoryDataList )
                                       {
                                          ?>
                                             <option value="<?php echo $categoryDataList["category_master_id"] ?>"><?php echo $categoryDataList["category_master_name"] ?></option> 
                                          <?php
                                       }
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div> 
                     <div class="row">
                        <div class="col-md-12 productspecificationlisting">
                           <h5 class="card-title flex-grow-1">Product Spedification Details</h5>
                           <hr class="mb-3">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtspecificationtype[]" class="form-control" data-parsley-required-message="Specification type field is required" placeholder="Enter Specification type" required>
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtspecificationvalue[]" class="form-control" data-parsley-required-message="Specification value field is required" placeholder="Enter Specification value" required>
                                 </div>
                              </div>
                              <div class="col-md-1">
                                 <div class="form-group mb-3">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light addnewspecifcation">Add New</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 productbomlisting">
                           <h5 class="card-title flex-grow-1">BOM Details</h5>
                           <hr class="mb-3">
                           <div class="row componentwrapper">
                              <div class="col-md-3 componentlistingwrapper">
                                 <div class="form-group mb-3">
                                    <select class="form-select componentmainlisting componentlistingwithdetail" name="txtcomponentdetail[]" required>
                                       <option value="">Select Component</option> 
                                       <?php
                                          if( $componentData )
                                          {
                                             foreach( $componentData as $componentDataList )
                                             {
                                                ?>
                                                   <option value="<?php echo $componentDataList["component_master_id"] ?>" data-specification="<?php echo $componentDataList["component_master_specification"] ?>" data-value="<?php echo $componentDataList["component_master_value"] ?>" data-price="<?php echo $componentDataList["component_master_price"] ?>"><?php echo $componentDataList["component_master_category"] ?></option> 
                                                <?php
                                             }
                                          }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3 componenetspecificationwrapper">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtproductspecification[]" class="form-control" data-parsley-required-message="Specification field is required" placeholder="Specification" required>
                                 </div>
                              </div>
                              <div class="col-md-2 componentvaluewrapper">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtproductvalue[]" class="form-control" data-parsley-required-message="Value field is required" placeholder="Value" required>
                                 </div>
                              </div>
                              <div class="col-md-1 componentpricewrapper">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtproductprice[]" class="form-control"  data-parsley-type="number" data-parsley-required-message="Price field is required" placeholder="000.00" required>
                                 </div>
                              </div>
                              <div class="col-md-1 componentqtywrapper">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtproductqty[]" class="form-control" data-parsley-required-message="Qty field is required" placeholder="0" required>
                                 </div>
                              </div>
                              <div class="col-md-1 componenttotalpricewrapper">
                                 <div class="form-group mb-3">
                                    <input type="text" name="txtproducttotalprice[]" class="form-control" data-parsley-required-message="Total field is required" placeholder="000.00" required readonly>
                                 </div>
                              </div>
                              <div class="col-md-1">
                                 <div class="form-group mb-3">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light addnewproductinfo">Add New</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12 productbomtotalwrapper">
                           <div class="row d-flex justify-content-end">
                              <div class="col-md-3 d-flex align-items-center gap-2">
                                 <h3 class="m-0">Total: </h3> <input type="text" name="bomtotalprice" class="form-control" placeholder="000.00">
                              </div>
                              <div class="col-md-1">&nbsp;</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end gap-2">
                     <a class="btn btn-danger waves-effect" href="<?php echo base_url("product/list"); ?>" >Close</a>
                     <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnsaveproductinfo">Save Product Info</button>
                     <input type="hidden" name="action_type" value="act_store_product_data">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>