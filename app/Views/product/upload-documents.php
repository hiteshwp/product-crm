<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <form id="frmuploadproductdocument" method="post" enctype="multipart/form-data">
                  <div class="card-header d-flex align-items-start">
                     <h4 class="card-title mb-0 flex-grow-1">Upload Product Documents</h4>
                     <a href="<?php echo base_url("product/list"); ?>" class="btn btn-primary w-md waves-effect waves-light float-end flex-shrink-0">Product Listing</a>
                  </div>
                  <div class="card-body">
                     <?php echo csrf_field(); ?>
                     <div class="row">
                        <div class="col-md-12" id="uploaddocumentlistwrapper">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-4 text-center">
                                       <h6>Design Documents</h6>
                                    </div>
                                    <div class="col-md-4 text-center">
                                       <h6>R&D Documents</h6>
                                    </div>
                                    <div class="col-md-4 text-center">
                                       <h6>Customer Documents</h6>
                                    </div>   
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                           <div class="row mb-2">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-4 uploaddesigndocumentlistwrapper">
                                       <div class="row mb-2">
                                          <div class="col-md-12 text-center d-flex justify-content-center gap-2">
                                             <input type="file" class="form-control file-validate" name="design_documents[]">
                                             <a href="javascript:void(0);" class="btn  btn-dark" id="btnappenduploaddesigndocumentlist"><i class="fa fa-plus"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                     <div class="col-md-4 uploadrandddocumentlistwrapper">
                                       <div class="row mb-2">
                                          <div class="col-md-12 text-center d-flex justify-content-center gap-2">
                                             <input type="file" class="form-control file-validate" name="randd_documents[]">
                                             <a href="javascript:void(0);" class="btn  btn-dark" id="btnappenduploadrandddocumentlist"><i class="fa fa-plus"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-4 uploadcustomerdocumentlistwrapper">
                                       <div class="row mb-2">
                                          <div class="col-md-12 text-center d-flex justify-content-center gap-2">
                                             <input type="file" class="form-control file-validate" name="customer_documents[]">
                                             <a href="javascript:void(0);" class="btn  btn-dark" id="btnappenduploadcustomerdocumentlist"><i class="fa fa-plus"></i></a>
                                          </div>   
                                       </div>
                                    </div>   
                                 </div>
                              </div>
                           </div>                           
                        </div>
                     </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end gap-2">
                     <a class="btn btn-danger waves-effect" href="<?php echo base_url("product/list"); ?>" >Close</a>
                     <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnuploadproductdocument">Upload Product Documents</button>
                     <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>