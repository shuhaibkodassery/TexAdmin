var pageURL = window.location.href;
var attachment_url = [];
var attributevalues = [];
$("#uploadBlogImage").on("change", function () {
    // image uploading

    var file_datas = $('#uploadBlogImage').prop('files');
    $('#loader').show();

    for (var x = 0; x < file_datas.length; x++) {
        var sizeInKB = parseFloat(file_datas[x].size / 1024).toFixed(2);

        if (sizeInKB < 2049) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            if (!allowedExtensions.exec(file_datas[x].name)) {
                window.alert('invalid file type');
                $('#loader').hide();

            } else {
                var images = file_datas[x];

                var formDatas = new FormData();
                formDatas.append('file', images);
                formDatas.append('resource_type', 1);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: pageURL.split("/")[0] + "/uploadImage",
                    data: formDatas,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#loader').hide();
                        if (data == 1) {
                            $.alert("File Not Found!");
                        } else if (data == 2) {
                            $.alert("Invalid File!");
                        } else if (data == 3) {
                            $.alert("Something wrong!");
                        } else if (data == 4) {
                            $.alert("Height and Width must not exceed 1024px.!");
                        } else if (data == 5) {
                            $.alert("file size must not exceed 512KB.!");
                        } else if (data == 6) {
                            $.alert("Invalid File Type!");
                        } else {
                            var attachment = {
                                'resource_id': data.resource_id,
                                'url': data.resource_small_path+data.resource_small_name,
                                'resource_name': data.resource_large_name,
                                'resource_path': data.resource_large_path,
                                'original_filename': data.original_filename
                            }
                            attachment_url.push(attachment);
                            BlogImageBindArray();

                        }
                    },
                    error: function (data) {
                        window.alert("Something Wrong");
                        $('#loader').hide();
                    }
                });
            }
        } else {
            window.alert("Please select a file less than 2 MB");
            $('#loader').hide();
        }
    }
});

function BlogImageBindArray() {
    var attachments = '';
    $("#blogImageAttachments").empty(); // not add already exist
    for (let i = 0; i < attachment_url.length; i++) {
        attachments +=
            // '<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">' +
            '   <div class="product-thumbnail" style="width:100px">' +
            '       <img src="' + attachment_url[i].url + '" class="img-thumbnail img-fluid" alt="">' +
            '       <span class="product-remove" title="remove" onclick="deleteBlogImage(' + i + ')"><i class="fa fa-close"></i></span>' +
            // '   </div>' +
            '</div>';

        $('#loader').hide();
    }
    $("#blogImageAttachments").append(attachments);

}

function deleteBlogImage(i) {

    attachment_url.splice(i, 1);

    BlogImageBindArray();
}

$("#CreateBlog").click(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/create_blog",
        method: 'POST',
        data: {
            title: $("#Blog_title").val(),
            blog_text: $("#editor").val(),
            discription: $("#discription").val(),
            date: $("#date").val(),
            author_name: $("#author_name").val(),
            author_email: $("#author_email").val(),
            category_id: $("#category").val(),
            attachments: attachment_url,
        },
        success: function (data) {

            if (data == 3) {
                window.alert("Something went wrong");
            } else {
                window.alert("Data Saved successfully");
                $('#blog_form')[0].reset();
                window.location.reload();
            }
        },
        error: function (data) {
            console.log('something went wrong')
        }
    });
});


function editBlogData(blog_id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/blog_edit",
        method: 'post',
        data: {
            blog_id: blog_id,
        },
        success: function (response) {

            $(window).scrollTop(0);
            blog_id = blog_id;
            document.getElementById('Blog_title').value = response.blog_title;
            document.getElementById('discription').value = response.discription;
            document.getElementById('editor').value = response.blog_text;
            document.getElementById('date').value = response.date;
            document.getElementById('author_name').value = response.author_name;
            document.getElementById('author_email').value = response.author_email;
            document.getElementById('category').value = response.category_id;
            document.getElementById('blog_id').value = blog_id;
            var images = response.images;
            attachment_url = [];
            for (let i = 0; i < images.length; i++) {
                var attachment = {
                    'resource_id': images[i].resource_id,
                    'url': images[i].small,
                    // 'resource_name': images[i].resource_name,
                    // 'resource_path': images[i].resource_path,
                    // 'original_filename': images[i].original_filename
                }
                attachment_url.push(attachment);
                BlogImageBindArray()
            }
            $('#UpdateBlog').show();
            $('#CreateBlog').hide();
        },
        error: function (response) {
        }
    });
}

$('#UpdateBlog').on('click', function() {
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/update_blog",
        method: 'post',
        data: {
            title: $("#Blog_title").val(),
            discription : $("#discription").val(),
            blog_text: $("#editor").val(),
            date: $("#date").val(),
            author_name: $("#author_name").val(),
            author_email: $("#author_email").val(),
            category_id: $("#category").val(),
            blog_id: $('#blog_id').val(),
            attachments: attachment_url,
        },
        success: function (response) {
            if (response == 3) {
                window.alert("Somthing Wrong");
            } else {
                window.alert("Blog Updated Successfully");
                window.location.reload();
            }
        },
        error: function (response) {
        }
    });
    
});

$('#UpdateCategory').on('click',  function() {

    var category_id = $('#category_id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/category/"+category_id,
        method: 'PUT',
        data: {
            category_name : $('#category_name').val()
        },
        success: function (data) {
            if (data == 3) {
                window.alert("Somthing Wrong");
            } else {
                window.alert("Category Updated Successfully");
                window.location.reload();
            }
        },
        error:function (data) {
        }
    });
});

$("#company_logo").on("change", function () {
    // image uploading

    var file_datas = $('#company_logo').prop('files');

    for (var x = 0; x < file_datas.length; x++) {
        var sizeInKB = parseFloat(file_datas[x].size / 1024).toFixed(2);

        if (sizeInKB < 2049) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            if (!allowedExtensions.exec(file_datas[x].name)) {
                window.alert('invalid file type');

            } else {
                var images = file_datas[x];

                var formDatas = new FormData();
                formDatas.append('file', images);
                formDatas.append('resource_type', 2);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: pageURL.split("/")[0] + "/uploadImage",
                    data: formDatas,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#loader').hide();
                        if (data == 1) {
                            $.alert("File Not Found!");
                        } else if (data == 2) {
                            $.alert("Invalid File!");
                        } else if (data == 3) {
                            $.alert("Something wrong!");
                        } else if (data == 4) {
                            $.alert("Height and Width must not exceed 1024px.!");
                        } else if (data == 5) {
                            $.alert("file size must not exceed 512KB.!");
                        } else if (data == 6) {
                            $.alert("Invalid File Type!");
                        } else {
                            var attachment = {
                                'resource_id': data.resource_id,
                                'url': data.resource_small_path+data.resource_small_name,
                                'resource_name': data.resource_large_name,
                                'resource_path': data.resource_large_path,
                                'original_filename': data.original_filename
                            }
                            attachment_url.push(attachment);
                            BlogImageBindArray();

                        }
                    },
                    error: function (data) {
                        window.alert("Something Wrong");
                        $('#loader').hide();
                    }
                });
            }
        } else {
            window.alert("Please select a file less than 2 MB");
            $('#loader').hide();
        }
    }
});

$('#CreateCompany').on('click', () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/admin/company",
        method: 'POST',
        data: {
            company_name: $("#company_name").val(),
            company_address: $("#company_address").val(),
            company_email: $("#company_email").val(),
            company_mobile: $("#company_mobile").val(),
            instagram: $("#instagram").val(),
            facebook: $("#facebook").val(),
            youtube: $("#youtube").val(),
            x_account: $("#x_account").val(),
            linkedin: $('#linkedin').val(),
            meta_title: $('#meta_title').val(),
            discription: $('#discription').val(),
            attachments: attachment_url,
        },
        success: function (data) {

            if (data == 3) {
                window.alert("Something went wrong");
            } else {
                window.alert("Data Saved successfully");
                $('#companyForm')[0].reset();
                window.location.reload();
            }
        },
        error: function (data) {
            console.log('something went wrong')
        }
    });
});

function editCompany(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: pageURL.split("/")[0] + "/admin/company/"+id,
        method: 'get',
        data: {
            company_id: id,
        },
        success: function (response) {

            $(window).scrollTop(0);
            category_id = id;
            document.getElementById('category_id').value = category_id;
            document.getElementById('company_name').value = response[0].company_name;
            document.getElementById('company_address').value = response[0].company_address;
            document.getElementById('company_email').value = response[0].company_email;
            document.getElementById('company_mobile').value = response[0].company_phone;
            document.getElementById('instagram').value = response[0].instagram_url;
            document.getElementById('facebook').value = response[0].fb_url;
            document.getElementById('youtube').value = response[0].youtube_url;
            document.getElementById('x_account').value = response[0].x_url;
            document.getElementById('linkedin').value = response[0].linkedin_url;
            document.getElementById('meta_title').value = response[0].title;
            document.getElementById('discription').value = response[0].description;
            attachment_url = [];
            var attachment = {
                'resource_id': response[0].resource_id,
                'url': response[0].small,
                // 'resource_name': images[i].resource_name,
                // 'resource_path': images[i].resource_path,
                // 'original_filename': images[i].original_filename
            }
            attachment_url.push(attachment);
            console.log(attachment_url);
            BlogImageBindArray()
            $('#UpdateCompany').removeClass('hide');
            $('#CreateCompany').hide();
        },
        error: function (response) {
        }
    });
}

$('#UpdateCompany').on('click', () => {
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        category_id : $('#category_id').val(),
        url: pageURL.split("/")[0] + "/admin/company/"+category_id,
        method: 'PUT',
        data: {
            company_name: $("#company_name").val(),
            company_address: $("#company_address").val(),
            company_email: $("#company_email").val(),
            company_mobile: $("#company_mobile").val(),
            instagram: $("#instagram").val(),
            facebook: $("#facebook").val(),
            youtube: $("#youtube").val(),
            x_account: $("#x_account").val(),
            linkedin: $('#linkedin').val(),
            meta_title: $('#meta_title').val(),
            discription: $('#discription').val(),
            attachments: attachment_url,
        },
        success: function (data) {

            if (data == 3) {
                window.alert("Something went wrong");
            } else {
                window.alert("Data Updated successfully");
                $('#companyForm')[0].reset();
                window.location.reload();
            }
        },
        error: function (data) {
            console.log('something went wrong')
        }
    });
});

function deleteCompany(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
       url : pageURL.split("/")[0] + "/admin/company/"+id,
       method : 'DELETE',
       success : (response) => {
            if(response == 1){
                window.alert("Company Data Deleted Successfully")
                window.location.reload()
            } else{
                window.alert("Something went wrong")
            }
       },
       error : (response) => {
            window.alert("Something went wrong")
       }
    });
}

$('#IsSubMenu').on('change', () => {
    if($('#IsSubMenu').is(":checked")){
        $('#mainMenuSection').removeClass('hide');
    }else {
        $('#mainMenuSection').addClass('hide');
    }
});
$(document).ready(() => {
    if($('#IsSubMenu').is(":checked")){
        $('#mainMenuSection').removeClass('hide');
    }else {
        $('#mainMenuSection').addClass('hide');
    }
});

function editHomeMenu(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url : pageURL.split('/')[0] + '/admin/header/' + id,
        method : 'GET',
        success: (response) => {
            $(window).scrollTop(0);
            document.getElementById('header_menu').value = response[0].header_menu_name;
            document.getElementById('header_link').value = response[0].header_menu_link;
            document.getElementById('headerId').value = id;
            if(response[0].is_submenu == 1){
                $('#IsSubMenu').prop('checked', true);
                $('#mainMenuSection').removeClass('hide');
                document.getElementById('main_menu').value = response[0].main_menu_id
            }else {
                $('#IsSubMenu').prop('checked', false);
                $('#mainMenuSection').addClass('hide');
            }
            $('#createHomeMenu').addClass('hide');
            $('#updateHomeMenu').removeClass('hide');
        },
        error: (response) => {

        }
    })
}

function deleteHomeMenu(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/header/'+id,
        method: 'DELETE',
        success: (data) => {
            if(data ==1 ){
                window.alert('Data deleted successfully');
            }else {
                window.alert('Something went wrong');
            }
            window.location.reload();
        },
        error: (data) => {

        }
    });
}

$('#updateHomeMenu').on('click', ()=> {
    id = $('#headerId').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    }),
    jQuery.ajax({
        url: pageURL.split('/')[0]+'/admin/header/'+id,
        method: 'PUT',
        data: {
            header_menu: $('#header_menu').val(),
            header_link: $('#header_link').val(),
            is_submenu: $('#IsSubMenu').is(":checked") ? $('#IsSubMenu').val() : 0,
            main_menu : $('#IsSubMenu').is(":checked") ? $('#main_menu').val() : 0,
        },
        success: (data) => {
            if(data == 1){
                window.alert('Data Updated Successfully');
                window.location.reload();
            }else {
                window.alert('Something went wrong');
            }
        },
        error: (data) => {
            window.alert('Something went wrong');
        }
    })
});