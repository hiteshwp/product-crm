<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header d-flex align-items-start">
                  <h4 class="card-title mb-0 flex-grow-1">Component Master Details</h4>
                  <button class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0" data-bs-toggle="modal" data-bs-target="#newCategoryModal">Add New Component</button>
               </div>
               <div class="card-body">
                  <div class="table-responsive export-table component-master" data-tn="<?php echo csrf_token(); ?>" data-tnv="<?php echo csrf_hash(); ?>">
                    <table id="component-master" class="table table-bordered text-nowrap key-buttons border-bottom  w-100 table-striped">
                      <thead>
                        <tr>
                          <th class="border-bottom-0">#ID</th>
                          <th class="border-bottom-0">Component Category</th>
                          <th class="border-bottom-0">Component Specification</th>
                          <th class="border-bottom-0">Component Value</th>
                          <th class="border-bottom-0">Component Price</th>
                          <th class="border-bottom-0">Status</th>
                          <th class="border-bottom-0">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="newCategoryModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
            <form id="frmsavecomponentcategory" method="post">
               <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">New Component Master Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group mb-3">
                           <label>Component Name</label>
                           <input type="text" name="txtcomponentcategory" class="form-control" data-parsley-required-message="Component Name field is required" id="txtcomponentcategory" placeholder="Enter Component Name" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group mb-3">
                           <label>Component Specification</label>
                           <textarea name="txtcomponentcategoryspecification" class="form-control" data-parsley-required-message="Component Specification field is required" id="txtcomponentcategoryspecification" placeholder="Enter Component Specification" required></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group mb-3">
                           <label>Component Value</label>
                           <input type="text" name="txtcomponentvalue" class="form-control" data-parsley-required-message="Component Value field is required" id="txtcomponentvalue" placeholder="Enter Component Value" required>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label>Component Price</label>
                           <input type="text" name="txtcomponentprice" class="form-control" data-parsley-type="number" data-parsley-required-message="Component Price field is required" id="txtcomponentprice" placeholder="Enter Component Price" required>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group mb-3">
                           <label>Status</label>
                           <select class="form-select" name="txtcomponentstatus" required>
                              <option value="">Select Status</option>
                              <option value="1">Active</option>
                              <option value="2">Deactive</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger waves-effect btncancelcomponentcategory" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnsavecomponentcategory">Save Component</button>
                  <input type="hidden" name="action_type" value="act_store_component_category_data">
               </div> 
            </form>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>

<div id="updateCategoryModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
            <form id="frmupdatecomponentcategory" method="post">
               <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Update Component Master Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group mb-3">
                           <label>Component Category Name</label>
                           <input type="text" name="txtupdatecomponentcategory" class="form-control" data-parsley-required-message="Component Category Name field is required" id="txtupdatecomponentcategory" placeholder="Enter Component Category Name" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group mb-3">
                           <label>Component Category Specification</label>
                           <textarea name="txtupdatecomponentcategoryspecification" class="form-control" data-parsley-required-message="Component Category Specification field is required" id="txtupdatecomponentcategoryspecification" placeholder="Enter Category Component Specification" required></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group mb-3">
                           <label>Component Value</label>
                           <input type="text" name="txtupdatecomponentvalue" class="form-control" data-parsley-required-message="Component Value field is required" id="txtupdatecomponentvalue" placeholder="Enter Component Value" required>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label>Component Price</label>
                           <input type="text" name="txtupdatecomponentprice" class="form-control" data-parsley-type="number" data-parsley-required-message="Component Price field is required" id="txtupdatecomponentprice" placeholder="Enter Component Price" required>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group mb-3">
                           <label>Status</label>
                           <select class="form-select" name="txtupdatecomponentstatus" id="txtupdatecomponentstatus" required>
                              <option value="">Select Status</option>
                              <option value="1">Active</option>
                              <option value="2">Deactive</option>
                              <option value="3">Delete</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger waves-effect btncancelupdatecomponentcategory" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnupdatecomponentcategory">Update Component</button>
                  <input type="hidden" name="action_type" value="act_update_component_category_data">
                  <input type="hidden" name="componentcategoryid" id="componentcategoryid" value="">
               </div>
            </form>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>