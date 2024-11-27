<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header d-flex align-items-start">
                  <h4 class="card-title mb-0 flex-grow-1">Download Product Documents</h4>
                  <a href="<?php echo base_url("product/list"); ?>" class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0">Product Listing</a>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12" id="uploaddocumentlistwrapper" data-tn="<?php echo csrf_token(); ?>" data-tnv="<?php echo csrf_hash(); ?>">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-4">
                                    <h6>Design Documents</h6>
                                 </div>
                                 <div class="col-md-4">
                                    <h6>R&D Documents</h6>
                                 </div>
                                 <div class="col-md-4">
                                    <h6>Customer Documents</h6>
                                 </div>   
                              </div>
                           </div>
                           <div class="col-md-12">
                              <hr>
                           </div>
                        </div>     
                        <div class="row mb-3">
                           <?php
                              $design = $randd = $customer = 1;
                              $types = array(
                                 "jpg"    => "fas fa-file-image",
                                 "docx"   => "far fa-file-word",
                                 "doc"   => "far fa-file-word",
                                 "png"    => "fas fa-file-image",
                                 "pdf"    => "fas fa-file-pdf",
                                 "PDF"    => "fas fa-file-pdf",
                              );
                           ?>
                           <div class="col-md-4">
                              <?php
                                 if( $design_data )
                                 {
                                    ?>
                                       <div class="table-responsive">
                                         <table class="table mb-0">
                                             <thead class="table-light">
                                                 <tr>
                                                     <th>#</th>
                                                     <th>Document Title</th>
                                                     <th class="text-center">Download</th>
                                                     <th class="text-center">Delete</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                foreach( $design_data as $design_data_list )
                                                {
                                                   ?>
                                                      <tr>
                                                         <th scope="row"><?php echo $design; ?></th>
                                                         <td><?php echo $design_data_list["product_documents_title"]; ?></td>
                                                         <td class="text-center"><a href="<?php echo base_url()."/uploads/documents/".$design_data_list["product_documents_path"]; ?>" target="_blank" alt="<?php echo $design_data_list["product_documents_extension"]; ?>" title="<?php echo $design_data_list["product_documents_extension"]; ?>" class="btn btn-primary btn-sm waves-effect btn-label waves-light"><i class="<?php echo strtolower($types[$design_data_list["product_documents_extension"]]); ?> label-icon"></i></a></td>
                                                         <td class="text-center"><a class="btn btn-sm btn-danger custom-action-btn btndeletedocument" data-document-id="<?php echo $design_data_list["product_documents_id"]; ?>"  href="javascript:void(0);"><i class="fa fa-trash"></i></a></td>
                                                      </tr>
                                                   <?php
                                                   $design++;
                                                }
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    <?php
                                 }
                              ?>
                           </div>
                           <div class="col-md-4">
                              <?php
                                 if( $randd_data )
                                 {
                                    ?>
                                       <div class="table-responsive">
                                         <table class="table mb-0">
                                             <thead class="table-light">
                                                 <tr>
                                                     <th>#</th>
                                                     <th>Document Title</th>
                                                     <th class="text-center">Download</th>
                                                     <th class="text-center">Delete</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                foreach( $randd_data as $randd_data_list )
                                                {
                                                   ?>
                                                      <tr>
                                                         <th scope="row"><?php echo $randd; ?></th>
                                                         <td><?php echo $randd_data_list["product_documents_title"]; ?></td>
                                                         <td class="text-center"><a href="<?php echo base_url()."/uploads/documents/".$randd_data_list["product_documents_path"]; ?>" target="_blank" alt="<?php echo $randd_data_list["product_documents_extension"]; ?>" title="<?php echo $randd_data_list["product_documents_extension"]; ?>" class="btn btn-primary btn-sm waves-effect btn-label waves-light"><i class="<?php echo strtolower($types[$randd_data_list["product_documents_extension"]]); ?> label-icon"></i></a></td>
                                                         <td class="text-center"><a class="btn btn-sm btn-danger custom-action-btn btndeletedocument" data-document-id="<?php echo $randd_data_list["product_documents_id"]; ?>"  href="javascript:void(0);"><i class="fa fa-trash"></i></a></td>
                                                      </tr>
                                                   <?php
                                                   $randd++;
                                                }
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    <?php
                                 }
                              ?>
                           </div>
                           <div class="col-md-4">
                              <?php
                                 if( $customer_data )
                                 {
                                    ?>
                                       <div class="table-responsive">
                                         <table class="table mb-0">
                                             <thead class="table-light">
                                                 <tr>
                                                     <th>#</th>
                                                     <th>Document Title</th>
                                                     <th class="text-center">Download</th>
                                                     <th class="text-center">Delete</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                foreach( $customer_data as $customer_data_list )
                                                {
                                                   ?>
                                                      <tr>
                                                         <th scope="row"><?php echo $customer; ?></th>
                                                         <td><?php echo $customer_data_list["product_documents_title"]; ?></td>
                                                         <td class="text-center"><a href="<?php echo base_url()."/uploads/documents/".$customer_data_list["product_documents_path"]; ?>" target="_blank" alt="<?php echo $customer_data_list["product_documents_extension"]; ?>" title="<?php echo $customer_data_list["product_documents_extension"]; ?>" class="btn btn-primary btn-sm waves-effect btn-label waves-light"><i class="<?php echo strtolower($types[$customer_data_list["product_documents_extension"]]); ?> label-icon"></i></a></td>
                                                         <td class="text-center"><a class="btn btn-sm btn-danger custom-action-btn btndeletedocument" data-document-id="<?php echo $customer_data_list["product_documents_id"]; ?>"  href="javascript:void(0);"><i class="fa fa-trash"></i></a></td>
                                                      </tr>
                                                   <?php
                                                   $customer++;
                                                }
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    <?php
                                 }
                              ?>
                           </div>                              
                        </div>                     
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>