<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header d-flex align-items-start">
                  <h4 class="card-title mb-0 flex-grow-1">Category Master Details</h4>
                  <button class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0" data-bs-toggle="modal" data-bs-target="#newCategoryModal">Add New Category</button>
               </div>
               <div class="card-body">
                  <div class="table-responsive export-table category-master" data-tn="<?php echo csrf_token(); ?>" data-tnv="<?php echo csrf_hash(); ?>">
                    <table id="category-master" class="table table-bordered text-nowrap key-buttons border-bottom  w-100 table-striped">
                      <thead>
                        <tr>
                          <th class="border-bottom-0">#ID</th>
                          <th class="border-bottom-0">Category Name</th>
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
            <form id="frmsavecategory" method="post">
               <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">New Category Master Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <?php echo csrf_field(); ?>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="form-group mb-3">
                              <label>Category Name</label>
                              <input type="text" name="txtcategoryname" class="form-control" data-parsley-required-message="Category Name field is required" id="txtcategoryname" placeholder="Enter Category Name" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group mb-3">
                              <label>Status</label>
                              <select class="form-select" name="txtcategorystatus" data-parsley-required-message="Category Status field is required" id="txtcategorystatus" required>
                                 <option value="">Select Status</option>
                                 <option value="1">Active</option>
                                 <option value="2">Deactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger waves-effect btncancelcategory" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnsavecategory">Save Category</button>
                  <input type="hidden" name="action_type" value="act_store_category_data">
               </div>
            </form>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>

<div id="updateCategoryModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <form id="frmupdatecategory" method="post">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Update Category Master Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group mb-3">
                           <label>Category Name</label>
                           <input type="text" name="txtupdatecategoryname" class="form-control" data-parsley-required-message="Category Name field is required" id="txtupdatecategoryname" placeholder="Enter Category Name" required>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label>Status</label>
                           <select class="form-select" name="txtupdatecategorystatus" data-parsley-required-message="Category Status field is required" id="txtupdatecategorystatus" required>
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
                  <button type="button" class="btn btn-danger waves-effect btncancelupdatecategory" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnupdatecategory">Update Category</button>
                  <input type="hidden" name="action_type" value="act_update_category_data">
                  <input type="hidden" name="txtcategoryid" id="txtcategoryid" value="">
              </div>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>