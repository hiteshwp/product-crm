$(document).ready(function() {
	let baseUrl = $(".baseurlcls").data('baseurl');
    alertify.set('notifier','position', 'top-right');

	// Category Master Start
    let categoryajaxurl = baseUrl+"master/get-category-list";
    let categoryCsrfName = jQuery(".category-master").data('tn');
    let categoryCsrfHash = jQuery(".category-master").data('tnv');
    var categorytable = $("#category-master").DataTable({
        buttons: [ 'excel', 'pdf' ],
        //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        scrollX: "100%",
        columnDefs: [{ width: '10%', targets: 0 }, { width: '70%', targets: 1 }, { width: '10%', targets: 2 }, { width: '10%', targets: 3 }],
        order: [[ 0, "desc" ]],
        responsive: false,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            loadingRecords: '&nbsp;',
            processing: 'Loading....'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url:categoryajaxurl,
            type: 'POST',
            deferRender: true,
            error: function() 
            { // if error occured
                /*notif({
                    msg: "<b>Oops! </b> Session Expired!.",
                    type: "error"
                });

                setTimeout(function() {
                    window.location.href=baseUrl;
                }, 2000);*/
            }
        },
        columns: [
            { data: 'category_master_id' },
            { data: 'category_master_name' },
            { data: 'category_master_status' },
            { data: 'Action' },
        ],
    });

    categorytable.buttons().container()
    .appendTo( '#category-master_wrapper .col-md-6:eq(0)' );

    jQuery('#frmsavecategory').parsley();
    jQuery('#frmupdatecategory').parsley();

    jQuery("body").on('submit', '#frmsavecategory', function(event) {
        event.preventDefault();

        if(jQuery('#frmsavecategory').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/store-category-data",  
                dataType: "json",
                data: jQuery('#frmsavecategory').serialize(),
                beforeSend: function(data){  
                    jQuery('#btnsavecategory').attr('disabled',true);
                    jQuery('#btnsavecategory').text('Wait..');
                },
                success:function(data){  
                    jQuery('#btnsavecategory').attr('disabled',false);
                    jQuery('#btnsavecategory').text('Save Category');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Category data added successfully!");
                        categorytable.ajax.reload();
                        setTimeout(function() {
                            jQuery(".btncancelcategory").trigger('click');
                        }, 3000);
                        jQuery("#txtcategoryname").val("");
                        jQuery("#txtcategorystatus").val("");
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Category Name already stored!'); 
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });

    jQuery("body").on('click', '.updatecategory', function(event) {
        event.preventDefault();
        jQuery("#txtupdatecategoryname").val(jQuery(this).data('category-name'));
        jQuery("#txtupdatecategorystatus").val(jQuery(this).data('category-status'));
        jQuery("#txtcategoryid").val(jQuery(this).data('category-id'));
    });

    jQuery("body").on('submit', '#frmupdatecategory', function(event) {
        event.preventDefault();

        if(jQuery('#frmupdatecategory').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/update-category-data",  
                dataType: "json",
                data: jQuery('#frmupdatecategory').serialize(),
                beforeSend: function(data){  
                    jQuery('#btnupdatecategory').attr('disabled',true);
                    jQuery('#btnupdatecategory').text('Wait...');
                },
                success:function(data){  
                    jQuery('#btnupdatecategory').attr('disabled',false);
                    jQuery('#btnupdatecategory').text('Update Category');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Category data updated successfully!");
                        categorytable.ajax.reload();
                        setTimeout(function() {
                            jQuery(".btncancelupdatecategory").trigger('click');
                        }, 3000);
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Category Name already stored!');
                    }
                    else if( data == 4 )
                    {
                        alertify.error("You can't deactive due to use somewhere!.");
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });

    jQuery("body").on('click', '.deletecategory', function(event) {
        event.preventDefault();
        let deletecategoryid   = jQuery(this).data('category-id');
        let thisData           = jQuery(this);

        if (confirm('Are you sure?')) 
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/delete-category-data",  
                dataType: "json",
                data:{action_type:"act_delete_category_data", deletecategoryid:deletecategoryid, [categoryCsrfName]:categoryCsrfHash },  
                beforeSend: function(data){  
                    thisData.text('Wait...');
                },
                success:function(data){  
                    thisData.html('<i class="fa fa-trash"></i>');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Category data deleted successfully!");
                        categorytable.ajax.reload();
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Invalid category ID!');
                    }
                    else if( data == 4 )
                    {
                        alertify.error("This category can't delete due to used somewhere!.");
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });




    // Component Master Start
    let componentajaxurl = baseUrl+"master/get-component-list";
    let componentCsrfName = jQuery(".component-master").data('tn');
    let componentCsrfHash = jQuery(".component-master").data('tnv');
    var componenttable = $("#component-master").DataTable({
        buttons: [ 'excel', 'pdf' ],
        //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        scrollX: "100%",
        order: [[ 0, "desc" ]],
        responsive: false,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            loadingRecords: '&nbsp;',
            processing: 'Loading....'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url:componentajaxurl,
            type: 'POST',
            deferRender: true,
            error: function() 
            { // if error occured
                /*notif({
                    msg: "<b>Oops! </b> Session Expired!.",
                    type: "error"
                });

                setTimeout(function() {
                    window.location.href=baseUrl;
                }, 2000);*/
            }
        },
        columns: [
            { data: 'component_master_id' },
            { data: 'component_master_category' },
            { data: 'component_master_specification' },
            { data: 'component_master_value' },
            { data: 'component_master_price' },
            { data: 'component_master_status' },
            { data: 'Action' },
        ],
    });

    componenttable.buttons().container()
    .appendTo( '#component-master_wrapper .col-md-6:eq(0)' );


    jQuery('#frmsavecomponentcategory').parsley();
    jQuery('#frmupdatecomponentcategory').parsley();

    jQuery("body").on('submit', '#frmsavecomponentcategory', function(event) {
        event.preventDefault();

        if(jQuery('#frmsavecomponentcategory').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/store-component-category-data",  
                dataType: "json",
                data: jQuery('#frmsavecomponentcategory').serialize(),
                beforeSend: function(data){  
                    jQuery('#btnsavecomponentcategory').attr('disabled',true);
                    jQuery('#btnsavecomponentcategory').text('Wait..');
                },
                success:function(data){  
                    jQuery('#btnsavecomponentcategory').attr('disabled',false);
                    jQuery('#btnsavecomponentcategory').text('Save Component');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Component added successfully!");
                        componenttable.ajax.reload();
                        setTimeout(function() {
                            jQuery(".btncancelcomponentcategory").trigger('click');
                        }, 3000);
                        jQuery('#frmsavecomponentcategory')[0].reset();
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Component Name already stored!'); 
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });


    jQuery("body").on('click', '.updatecomponentcategory', function(event) {
        event.preventDefault();
        jQuery("#txtupdatecomponentcategory").val(jQuery(this).data('component-name'));
        jQuery("#txtupdatecomponentcategoryspecification").val(jQuery(this).data('component-specification'));
        jQuery("#txtupdatecomponentvalue").val(jQuery(this).data('component-value'));
        jQuery("#txtupdatecomponentprice").val(jQuery(this).data('component-price'));
        jQuery("#txtupdatecomponentstatus").val(jQuery(this).data('component-status'));
        jQuery("#componentcategoryid").val(jQuery(this).data('component-id'));
    });

    jQuery("body").on('submit', '#frmupdatecomponentcategory', function(event) {
        event.preventDefault();

        if(jQuery('#frmupdatecomponentcategory').parsley().isValid())
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/update-component-category-data",  
                dataType: "json",
                data: jQuery('#frmupdatecomponentcategory').serialize(),
                beforeSend: function(data){  
                    jQuery('#btnupdatecomponentcategory').attr('disabled',true);
                    jQuery('#btnupdatecomponentcategory').text('Wait...');
                },
                success:function(data){  
                    jQuery('#btnupdatecomponentcategory').attr('disabled',false);
                    jQuery('#btnupdatecomponentcategory').text('Update Component');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Component updated successfully!");
                        componenttable.ajax.reload();
                        setTimeout(function() {
                            jQuery(".btncancelupdatecomponentcategory").trigger('click');
                        }, 3000);
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Component Name already stored!');
                    }
                    else if( data == 4 )
                    {
                        alertify.error("You can't deactive due to use somewhere!.");
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });

    jQuery("body").on('click', '.deletecomponent', function(event) {
        event.preventDefault();
        let deletecomponentid   = jQuery(this).data('component-id');
        let thisData           = jQuery(this);

        if (confirm('Are you sure?')) 
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/master/delete-component-category-data",  
                dataType: "json",
                data:{action_type:"act_delete_component_data", deletecomponentid:deletecomponentid, [componentCsrfName]:componentCsrfHash },  
                beforeSend: function(data){  
                    thisData.text('Deleting...');
                },
                success:function(data){  
                    thisData.html('<i class="fa fa-trash"></i> Delete');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Component data deleted successfully!");
                        componenttable.ajax.reload();
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Invalid component ID!');
                    }
                    else if( data == 4 )
                    {
                        alertify.error("This Component can't delete due to used somewhere!.");
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });


    // Product Master Start
    let productajaxurl = baseUrl+"product/get-product-list";
    let productCsrfName = jQuery(".product-master").data('tn');
    let productCsrfHash = jQuery(".product-master").data('tnv');
    var producttable = $("#product-master").DataTable({
        buttons: [ 'excel', 'pdf' ],
        //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        scrollX: "100%",
        columnDefs: [{ width: '5%', targets: 0 }, { width: '15%', targets: 1 }, { width: '15%', targets: 2 }, { width: '10%', targets: 3 }, { width: '10%', targets: 4 }, { width: '10%', targets: 5 }, { width: '30%', targets: 6 }],
        order: [[ 0, "desc" ]],
        responsive: false,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            loadingRecords: '&nbsp;',
            processing: 'Loading....'
        },
        processing: true,
        serverSide: true,
        ajax: {
            url:productajaxurl,
            type: 'POST',
            deferRender: true,
            error: function() 
            { // if error occured
                /*notif({
                    msg: "<b>Oops! </b> Session Expired!.",
                    type: "error"
                });

                setTimeout(function() {
                    window.location.href=baseUrl;
                }, 2000);*/
            }
        },
        columns: [
            { data: 'product_id' },
            { data: 'product_model' },
            { data: 'product_category_name' },
            { data: 'product_total_amount' },
            { data: 'product_created' },
            { data: 'product_status' },
            { data: 'Action' },
        ],
    });

    producttable.buttons().container()
    .appendTo( '#product-master_wrapper .col-md-6:eq(0)' );


    jQuery("body").on('click', '.addnewspecifcation', function(event) {
        event.preventDefault();
        jQuery(".productspecificationlisting").append('<div class="row"> <div class="col-md-6"> <div class="form-group mb-3"> <input type="text" name="txtspecificationtype[]" class="form-control" data-parsley-required-message="Specification type field is required" placeholder="Enter Specification type" required /> </div> </div> <div class="col-md-5"> <div class="form-group mb-3"> <input type="text" name="txtspecificationvalue[]" class="form-control" data-parsley-required-message="Specification value field is required" placeholder="Enter Specification value" required /> </div> </div> <div class="col-md-1"> <div class="form-group mb-3"><button type="button" class="btn btn-danger btn-sm waves-effect waves-light deletespecifcation">Delete</button></div> </div></div>');
    });

    jQuery("body").on('click', '.deletespecifcation', function(event) {
        event.preventDefault();
        jQuery(this).parent().parent().parent().remove();
    });

    jQuery("body").on('click', '.addnewproductinfo', function(event) {
        event.preventDefault();
        let component_listing = jQuery(".componentmainlisting").html();
        jQuery(".productbomlisting").append('<div class="row componentwrapper"> <div class="col-md-3 componentlistingwrapper"> <div class="form-group mb-3"> <select class="form-select componentrepeaterlisting componentlistingwithdetail" name="txtcomponentdetail[]" required> '+component_listing+'</select> </div> </div> <div class="col-md-3 componenetspecificationwrapper"> <div class="form-group mb-3"> <input type="text" name="txtproductspecification[]" class="form-control" data-parsley-required-message="Specification field is required" placeholder="Specification" required> </div> </div> <div class="col-md-2 componentvaluewrapper"> <div class="form-group mb-3"> <input type="text" name="txtproductvalue[]" class="form-control" data-parsley-required-message="Value field is required" placeholder="Value" required> </div> </div> <div class="col-md-1 componentpricewrapper"> <div class="form-group mb-3"> <input type="text" name="txtproductprice[]" class="form-control"  data-parsley-type="number" data-parsley-required-message="Price field is required" placeholder="000.00" required> </div> </div> <div class="col-md-1 componentqtywrapper"> <div class="form-group mb-3"> <input type="text" name="txtproductqty[]" class="form-control" data-parsley-required-message="Qty field is required" placeholder="0" required> </div> </div> <div class="col-md-1 componenttotalpricewrapper"> <div class="form-group mb-3"> <input type="text" name="txtproducttotalprice[]" class="form-control" data-parsley-required-message="Total field is required" placeholder="000.00" required readonly> </div> </div> <div class="col-md-1"> <div class="form-group mb-3"> <button type="button" class="btn btn-danger btn-sm waves-effect waves-light deletenewproductinfo">Delete</button> </div> </div> </div> </div>');
    });

    jQuery("body").on('click', '.deletenewproductinfo', function(event) {
        event.preventDefault();
        jQuery(this).parent().parent().parent().remove();
        total_calculation()
    });


    jQuery("body").on('change', '.componentlistingwithdetail', function(event) {
        event.preventDefault();
        let specification       = jQuery(this).find('option:selected').attr("data-specification"),
            specification_value = jQuery(this).find('option:selected').attr("data-value"),
            specification_price = jQuery(this).find('option:selected').attr("data-price");
        jQuery(this).parents(".componentwrapper").find(".componenetspecificationwrapper").find("input").val(specification);
        jQuery(this).parents(".componentwrapper").find(".componentvaluewrapper").find("input").val(specification_value);
        jQuery(this).parents(".componentwrapper").find(".componentpricewrapper").find("input").val(specification_price);
        total_calculation();
    });

    function total_calculation()
    {
        let total_amount = 0;
        jQuery('[name="txtproducttotalprice[]"]').each(function() {
            let value = jQuery(this).val(); // Get the value
            let numericValue = parseFloat(value) || 0; // Convert to integer or use 0 if invalid
            total_amount += numericValue; // Add to total
        });
        jQuery("[name='bomtotalprice']").val(total_amount.toFixed(2)); // Set the total value
    }

    jQuery("body").on('keyup', '[name="txtproductqty[]"]', function(event) {
        event.preventDefault();
        let price = jQuery(this).parents(".componentwrapper").find(".componentpricewrapper").find("input").val(),
            qty = jQuery(this).val(),
            total = 0;

        total = price * qty;

        jQuery(this).parents(".componentwrapper").find(".componenttotalpricewrapper").find("input").val(total);
        total_calculation();
    });


    jQuery("#frmnewproductdetail").parsley();

    jQuery("body").on('submit', '#frmnewproductdetail', function(event) {
        event.preventDefault();

        jQuery.ajax({  
            type:"POST",  
            url:baseUrl+"/product/store-product-data",  
            dataType: "json",
            data: jQuery('#frmnewproductdetail').serialize(),
            beforeSend: function(data){  
                jQuery('#btnsaveproductinfo').attr('disabled',true);
                jQuery('#btnsaveproductinfo').text('Saving...........');
            },
            success:function(data){  
                jQuery('#btnsaveproductinfo').attr('disabled',false);
                jQuery('#btnsaveproductinfo').text('Save Product Info');
                console.log(data);
                if( data == 1 )
                {
                    alertify.success("Product data added successfully!");
                    setTimeout(function() {
                        window.location.href=baseUrl+"/product/list";
                    }, 3000);
                }
                else if( data == 3 )
                {
                    alertify.warning('Product Model already stored!');
                }
                else
                {
                    alertify.error("Something went wrong!");
                }
            }
        });
    });


    // Code for upload documents
    /*jQuery("body").on('click', '#btnappenduploaddocumentlist', function(event) {
        event.preventDefault();
        let component_listing = jQuery(".componentmainlisting").html();
        jQuery("#uploaddocumentlistwrapper").append('<div class="row mb-2"> <div class="col-md-11"> <div class="row"> <div class="col-md-4 text-center"> <input type="file" class="form-control file-validate" name="design_documents[]" required> </div> <div class="col-md-4 text-center"> <input type="file" class="form-control file-validate" name="randd_documents[]" required> </div> <div class="col-md-4 text-center"> <input type="file" class="form-control file-validate" name="customer_documents[]" required> </div> </div> </div> <div class="col-md-1"><a href="javascript:void(0);" class="btn btn-sm btn-danger document-list-delete-btn"><i class="fa fa-trash"></i> Delete</a></div> </div>');

        jQuery('.file-validate').attr({
            'data-parsley-filetype': 'doc,docx,pdf,jpeg,jpg,png',
            'data-parsley-maxfilesize': '2', // Max size in MB
            'data-parsley-trigger': 'change',
        });

    });*/

    jQuery("body").on('click', '#btnappenduploaddesigndocumentlist', function(event) {
        event.preventDefault();
        let component_listing = jQuery(".componentmainlisting").html();
        jQuery(".uploaddesigndocumentlistwrapper").append('<div class="row mb-2"> <div class="col-md-12 text-center d-flex justify-content-center gap-2"> <input type="file" class="form-control file-validate" name="design_documents[]" required> <a href="javascript:void(0);" class="btn btn-danger btndeleteuploaddesigndocument"><i class="fa fa-trash"></i></a> </div> </div>');

        jQuery('.file-validate').attr({
            'data-parsley-filetype': 'doc,docx,pdf,jpeg,jpg,png',
            'data-parsley-maxfilesize': '2', // Max size in MB
            'data-parsley-trigger': 'change',
        });

    });

    jQuery("body").on('click', '#btnappenduploadrandddocumentlist', function(event) {
        event.preventDefault();
        let component_listing = jQuery(".componentmainlisting").html();
        jQuery(".uploadrandddocumentlistwrapper").append('<div class="row mb-2"> <div class="col-md-12 text-center d-flex justify-content-center gap-2"> <input type="file" class="form-control file-validate" name="randd_documents[]" required> <a href="javascript:void(0);" class="btn btn-danger btndeleteuploadrandddocument"><i class="fa fa-trash"></i></a> </div> </div>');

        jQuery('.file-validate').attr({
            'data-parsley-filetype': 'doc,docx,pdf,jpeg,jpg,png',
            'data-parsley-maxfilesize': '2', // Max size in MB
            'data-parsley-trigger': 'change',
        });

    });

    jQuery("body").on('click', '#btnappenduploadcustomerdocumentlist', function(event) {
        event.preventDefault();
        let component_listing = jQuery(".componentmainlisting").html();
        jQuery(".uploadcustomerdocumentlistwrapper").append('<div class="row mb-2"> <div class="col-md-12 text-center d-flex justify-content-center gap-2"> <input type="file" class="form-control file-validate" name="customer_documents[]" required> <a href="javascript:void(0);" class="btn btn-danger btndeleteuploadcustomerdocument"><i class="fa fa-trash"></i></a> </div> </div>');

        jQuery('.file-validate').attr({
            'data-parsley-filetype': 'doc,docx,pdf,jpeg,jpg,png',
            'data-parsley-maxfilesize': '2', // Max size in MB
            'data-parsley-trigger': 'change',
        });

    });

    jQuery("body").on('click', '.btndeleteuploaddesigndocument', function(event) {
        event.preventDefault();
        jQuery(this).parent().parent().remove();
        total_calculation()
    });

     Parsley.addValidator('filetype', {
      requirementType: 'string',
      validateString: function (value, requirement, parsleyInstance) {
        const file = parsleyInstance.$element[0].files[0];
        if (!file) return true; // No file to validate
        const allowedExtensions = requirement.split(',');
        const fileExtension = file.name.split('.').pop().toLowerCase();
        return allowedExtensions.includes(fileExtension);
      },
      messages: {
        en: 'Invalid file type. Allowed types are: %s.',
      },
    });

    // Custom validator for file size
    Parsley.addValidator('maxfilesize', {
      requirementType: 'number',
      validateString: function (value, maxSizeMb, parsleyInstance) {
        const file = parsleyInstance.$element[0].files[0];
        if (!file) return true; // No file to validate
        const maxSizeBytes = maxSizeMb * 1024 * 1024;
        return file.size <= maxSizeBytes;
      },
      messages: {
        en: 'File size must be less than %s MB.',
      },
    });


    jQuery("#frmuploadproductdocument").parsley();

    jQuery('.file-validate').attr({
        'data-parsley-filetype': 'doc,docx,pdf,jpeg,jpg,png',
        'data-parsley-maxfilesize': '2', // Max size in MB
        'data-parsley-trigger': 'change',
    });

    jQuery("body").on('submit', '#frmuploadproductdocument', function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        jQuery.ajax({  
            type:"POST",  
            url:baseUrl+"/product/store-upload-doccuments",  
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(data){  
                jQuery('#btnuploadproductdocument').attr('disabled',true).text('Uploading...........')
            },
            success:function(data){  
                console.log(data);
                if( data == 1 )
                {
                    alertify.success("Product documents uploaded successfully!");
                    setTimeout(function() {
                        window.location.href=baseUrl+"/product/list";
                    }, 3000);
                }
                else if( data == 3 )
                {
                    alertify.warning('Product documents already stored!');
                }
                else
                {
                    alertify.error("Something went wrong!");
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                alert('An error occurred: ' + error);
            },
            complete: function () {
                    // Re-enable the button and reset the text
                jQuery('#btnsaveproductinfo').attr('disabled',false).text('Upload Product Documents');
            }
        });
    });

    jQuery("body").on('click', '.btndeletedocument', function(event) {
        event.preventDefault();
        let productDocumentCsrfName = jQuery("uploaddocumentlistwrapper").data('tn');
        let productDocumentCsrfHash = jQuery("uploaddocumentlistwrapper").data('tnv');
        let deletedocumenttid   = jQuery(this).data('document-id');
        let thisData           = jQuery(this);

        if (confirm('Are you sure?')) 
        {
            jQuery.ajax({  
                type:"POST",  
                url:baseUrl+"/product/delete-product-document",  
                dataType: "json",
                data:{action_type:"act_delete_product_document_data", deletedocumenttid:deletedocumenttid, [productDocumentCsrfName]:productDocumentCsrfHash },  
                beforeSend: function(data){  
                    thisData.html('<i class="bx bx-loader bx-spin font-size-12 align-middle"></i>');
                },
                success:function(data){  
                    thisData.html('<i class="fa fa-trash"></i>');
                    console.log(data);
                    if( data == 1 )
                    {
                        alertify.success("Document deleted successfully!");
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                        
                    }
                    else if( data == 3 )
                    {
                        alertify.warning('Invalid Document ID!');
                    }
                    else
                    {
                        alertify.error("Something went wrong!");
                    }
                }
            });
        }
    });


    // Update Product details
    jQuery("#frmupdateproductdetail").parsley();

    jQuery("body").on('submit', '#frmupdateproductdetail', function(event) {
        event.preventDefault();

        jQuery.ajax({  
            type:"POST",  
            url:baseUrl+"/product/update-product-data",
            dataType: "json",
            data: jQuery('#frmupdateproductdetail').serialize(),
            beforeSend: function(data){  
                jQuery('#btnupdateproductinfo').attr('disabled',true);
                jQuery('#btnupdateproductinfo').text('Updating...........');
            },
            success:function(data){  
                jQuery('#btnupdateproductinfo').attr('disabled',false);
                jQuery('#btnupdateproductinfo').text('Update Product Info');
                console.log(data);
                if( data == 1 )
                {
                    alertify.success("Product data updated successfully!");
                    setTimeout(function() {
                        window.location.href=baseUrl+"/product/list";
                    }, 3000);
                }
                else if( data == 3 )
                {
                    alertify.warning('Product Model already stored!');
                }
                else
                {
                    alertify.error("Something went wrong!");
                }
            }
        });
    });

});