<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header d-flex align-items-start">
                  <h4 class="card-title mb-0 flex-grow-1">New Product Details</h4>
                  <a href="<?php echo base_url("product/new"); ?>" class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0">New Product Detail</a>
               </div>
               <div class="card-body">
                  <div class="table-responsive export-table product-master" data-tn="<?php echo csrf_token(); ?>" data-tnv="<?php echo csrf_hash(); ?>">
                     <table id="product-master" class="table table-bordered text-nowrap key-buttons border-bottom  w-100 table-striped">
                        <thead>
                           <tr>
                              <th class="border-bottom-0">#ID</th>
                              <th class="border-bottom-0">Model Name</th>
                              <th class="border-bottom-0">Category Name</th>
                              <th class="border-bottom-0">Total Amount</th>
                              <th class="border-bottom-0">Created At</th>
                              <th class="border-bottom-0">Status</th>
                              <th class="border-bottom-0">Action</th>
                           </tr>
                        </thead>
                     <tbody>
                        <?php
                           /*if( $product_master_data )
                           {
                              foreach( $product_master_data as $product_master_data_list )
                              {
                                 ?>
                                    <tr>
                                       <td><?php echo $product_master_data_list["product_id"] ?></td>
                                       <td><?php echo $product_master_data_list["product_model"] ?></td>
                                       <td><?php echo $product_master_data_list["category_master_name"] ?></td>
                                       <td><?php echo date("d-m-Y", strtotime($product_master_data_list["created_at"])); ?></td>
                                       <td>Status</td>
                                       <td>Action</td>
                                    </tr>
                                 <?php
                              } 
                           }*/
                        ?>
                     </tbody>
                    </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>