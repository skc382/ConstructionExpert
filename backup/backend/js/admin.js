  /*********************/
  var page = $("#page").val();
  var base_url = $("#baseurl").val();
  var csrf_token=$('#admin_csrf').val();

  /******************** */
  

  

 /*********************/  
   $("#loginform").submit(function(e){
     e.preventDefault();     
     $.ajax({
       type:"POST",
       url: baseurl+"admin/processLogin",
       data:$(this).serialize(),
       success:function(res){        
        var rep = JSON.parse(res);
         if(rep.status == 1){
           window.location.href=baseurl+"customer-inquiries";
          }else{
            $("#msg").text(rep.msg);
          }        
       },error:function(xhr){
         console.log(xhr);
       }
     });
   });
/*********************/
   $('#addIndustry').submit(function(e){
    e.preventDefault(); 
        $.ajax({
        url:'industry/addIndustry_upload',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        beforeSend:function(){
          $("#btn").attr('disabled',true);
        },
        success: function(res){        
        $("#btn").attr('disabled',false);
        $("#Add_Specialities_details").modal('hide');
          if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
        load_industry();
        }
        });
    });

   if(page == 'industry'){     
    load_industry();
    
    $(document).on('submit','#editindustry',function(e){
      e.preventDefault(); 
          $.ajax({
          url:'industry/editIndustry_upload',
          type:"post",
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function(res){ 
            console.log(res);
            $("#edit_industry_details").modal('hide');
              if ($.fn.DataTable.isDataTable('#industry_table')) {
                $('#industry_table').DataTable().clear().destroy();
              }
            load_industry();
          },
          error:function(x){
            console.log(x);
          }
          });
    });

    $(document).on('click','.edit-industry',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $.ajax({
        type:"post",
        url: base_url+"industry/getIndustrybyid",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
          var imgpath ='./backend/img/industry/thumb/'+ rep.orgimage;
          $("#indimg").attr('src',imgpath);
          $("#indid").val(rep.industryid);
          $("#industryname").val(rep.industryname);          
          $("#edit_industry_details").modal('show');
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })

    $(document).on('click','.delete-industry',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#indid").val(id);
      $("#delete_modal").modal('show');
    })

    $(document).on('click','#delind',function(e){
      e.preventDefault();
      var id = $("#indid").val();
      $.ajax({
        type:"post",
        url: base_url+"industry/delete_industry",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
          load_industry();
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      $("#delete_modal").modal('hide');
    })

   }
   
   function load_industry(){
    $('#industry_table').DataTable({ 
      pageLength: 10,     
      ajax: base_url+"industry/industries_list",
      serverMethod: 'get',
      bFilter:false
   });
   }

/****************/

if(page == 'tags'){

  load_tags();

  function load_tags(){    
    $('#industry_table').DataTable({ 
        pageLength: 10,     
        ajax: base_url+"tag/tag_list",
        serverMethod: 'get',
        bFilter:false
    });
  }

  $(document).on('submit','#addTag',function(e){
    e.preventDefault();
    $.ajax({
      type:"post",
      url: base_url+"tag/add_tag",
      data:$(this).serialize(),
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        $("#Add_Tag").modal('hide');
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_tags();
       }else{
          alert(rep.msg);
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

  $(document).on('click','#deltag',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"tag/delete_tag",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          $("#delete_modal").modal('hide');
          load_tags();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('submit','#edittag',function(e){
    e.preventDefault(); 
        $.ajax({
        url:'tag/updateTag',
        type:"post",
        data:$(this).serialize(),
        success: function(res){ 
          console.log(res);
          $("#edit_tag").modal('hide');
            if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_tags();
        },
        error:function(x){
          console.log(x);
        }
        });
  });

  $(document).on('click','.edit-tag',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $.ajax({
      type:"post",
      url: base_url+"tag/getTagbyid",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res); 
        $("#etagid").val(rep.tagid);
        $("#etagname").val(rep.tagname);          
        $("#edit_tag").modal('show');
      },error:function(xhr){
        console.log(xhr);
      }
    })      
  })

  $(document).on('click','.delete-tag',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#delete_modal").modal('show');
  })

}

/*********************/

   if(page == 'category'){     
    load_category();

    $(document).on('click','.edit-country',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $.ajax({
        type:"post",
        url: base_url+"category/getCategorybyid",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res); console.log(rep.country);
          $("#ecid").val(rep.catid);
          $("#ecatname").val(rep.category);          
          $("#edit_country").modal('show');
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })

    $(document).on('submit','#editcategory',function(e){
      e.preventDefault(); 
      $.ajax({
        type:"post",
        url: base_url+"category/updateCategory",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success:function(res){ 
          var rep =JSON.parse(res);
          if(rep.status == 1){
            $("#edit_country").modal('hide');
            if ($.fn.DataTable.isDataTable('#industry_table')) {
                $('#industry_table').DataTable().clear().destroy();
              }
              load_category();
           }else{
              alert(rep.msg);
           }
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })

    $(document).on('submit','#addCategory',function(e){
      e.preventDefault();
      $.ajax({
        type:"post",
        url: base_url+"category/add_category",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          $("#Add_Country").modal('hide');
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_category();
         }else{
            alert(rep.msg);
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      
    })

    $(document).on('click','.delete-country',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#delete_modal").modal('show');
    })

    $(document).on('click','#delctry',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"category/delete_category",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_category();
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      $("#delete_modal").modal('hide');
    })

   }

   function load_category(){
    $('#industry_table').DataTable({ 
      pageLength: 10,     
      ajax: base_url+"category/category_list",
      serverMethod: 'get',
      bFilter:false
   });
   }

   $(document).on('submit','#addJob,#editJob',function(e){
    e.preventDefault();    
    $.ajax({
      type:"post",
      url: base_url+"jobs/add_job",
      data:$(this).serialize(),
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
         alert(rep.msg);
         $("#addJob")[0].reset();
       }else{
          alert(rep.msg);
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

   /*********************/
   if(page == 'job'){    
     load_jobs();  

     $(document).on('click','.delete-jobs',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#delete_modal").modal('show');
    })

    $(document).on('click','.approve-jobs',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#approve_modal").modal('show');
    })

    $(document).on('click','#approvejob',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"jobs/approve_job",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_jobs();
            $("#approve_modal").modal('hide');
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })

    $(document).on('click','.reject-job',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#reject_modal").modal('show');
    })

    $(document).on('click','#banjob',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"jobs/ban_job",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_jobs();
            $("#reject_modal").modal('hide');
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })

    $(document).on('click','#deljob',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"jobs/delete_job",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_jobs();
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      $("#delete_modal").modal('hide');
    })


   }

   function load_jobs(){
    $('#industry_table').DataTable({ 
      pageLength: 10,     
      ajax: base_url+"jobs/jobs_list",
      serverMethod: 'get',
      bFilter:false
   });
   }
 
//srs
   /*********************/
   if(page == 'srs'){       
     load_srs();   
     
     $(document).on('click','.activate-user',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#activate_modal").modal('show');
    })

    $(document).on('click','.block-user',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $("#cid").val(id);
      $("#block_modal").modal('show');
    })

    $(document).on('click','#blkctrl',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"user/block_user",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_srs(); 
            $("#block_modal").modal('hide'); 
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      $("#delete_modal").modal('hide');
    })

    $(document).on('click','#actctrl',function(e){
      e.preventDefault();
      var id = $("#cid").val();
      $.ajax({
        type:"post",
        url: base_url+"user/activate_user",
        data:{id:id, csrf_token_name:csrf_token},
        success:function(res){
          var rep = JSON.parse(res);
         if(rep.status == 1){
          if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_srs(); 
            $("#activate_modal").modal('hide'); 
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })
      $("#delete_modal").modal('hide');
    })


   }
     
  function load_srs(){
    $('#industry_table').DataTable({ 
      pageLength: 10,     
      ajax: base_url+"user/serviceprovider_list",
      serverMethod: 'get',
      bFilter:false
   });
   }



     // banner
  if(page == 'banner'){

    $(document).on('submit','#updatebanner',function(e){
      e.preventDefault();    
      $.ajax({
        type:"post",
        url: base_url+"settings/update_bannerimage",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success:function(res){
          var rep = JSON.parse(res);
          console.log(rep);
         if(rep.status == 1){
           alert(rep.msg);           
         }else if(rep.status == 0){
            alert(rep.msg);
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })
  }

  // setting
  if(page == 'setting'){

    $(document).on('submit','#updatesite',function(e){
      e.preventDefault();    
      $.ajax({
        type:"post",
        url: base_url+"settings/update_site",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success:function(res){
          var rep = JSON.parse(res);
          console.log(rep);
         if(rep.status == 1){
           alert(rep.msg);
           $("#addJob")[0].reset();
         }else if(rep.status == 0){
            alert(rep.msg);
         }
        },error:function(xhr){
          console.log(xhr);
        }
      })      
    })
  }




/***********************/
if(page == 'profile'){

  $(document).on('click','#showpass',function(e){
    e.preventDefault();    
      $("#pass").attr('type','text');
      $(".sp").removeClass('fa fa-eye-slash');
      $(".sp").addClass('fa fa-eye');
  })

  $(document).on('submit','#updateprofile',function(e){
    e.preventDefault();    
    $.ajax({
      type:"post",
      url: base_url+"settings/update_profile",
      data:$(this).serialize(),
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
         alert(rep.msg);         
       }else{
          alert(rep.msg);
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })      
  })
}

/************&*********/

if(page == 'usrsrs'){
  
  load_srs_services();

  $(document).on('click','.activate-service',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#activate_modal").modal('show');
  })

  $(document).on('click','.block-service',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#block_modal").modal('show');
  })

  $(document).on('click','.approve-edit-service',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#approve_edit_modal").modal('show');
  })

  $(document).on('click','.block-edit-service',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#blockedit_modal").modal('show');
  })

  $(document).on('click','#sblkctrl',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"user/block_service",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srs_services();
          $("#block_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

  $(document).on('click','#sactctrl',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"user/activate_service",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srs_services(); 
          $("#activate_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','#approvedit',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"user/approved_edit_service",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srs_services(); 
          $("#approve_edit_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','#blockedit',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"user/block_edit_service",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srs_services(); 
          $("#blockedit_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  function load_srs_services(){
    var usr_sid = $("#usr_sid").val();
    console.log(usr_sid);
    $('#industry_table').DataTable({ 
      "processing":true,
      "serverSide":true,
      ajax:{
        url:base_url+"user/user_services_list/",
        type:"post",
        data:{csrf_token_name:csrf_token,id:usr_sid}   
      }
   });

  // $('#industry_table').DataTable({ 
  //   pageLength: 10,     
  //   ajax: base_url+"user/user_services_list",
  //   serverMethod: 'get',
  //   bFilter:false
  // });
 
   }
}


/***********customer enquiry********/

if(page == 'enquiries'){
  
  load_customer_enquiries();

  function load_customer_enquiries(){   
        $('#industry_table').DataTable({ 
          pageLength: 10,     
          ajax: base_url+"customer/customer_enquiry_list",
          serverMethod: 'get',
          bFilter:false
      }); 
   }

   $(document).on('click','.viewad',function(e){
    e.preventDefault();
    var id = $(this).attr('id');    
    $.ajax({
      type:"POST",
      url:base_url+"customer/viewad_details_byId",
      data:{csrf_token_name:csrf_token,adid:id},
      dataType:'json',
      success:function(res){
        console.log(res);
        $("#cat").text(res.category);
        $("#title").text(res.title);
        $("#addesc").html(res.jobdesc);
        $("#budget").text(res.budget);
        $("#view_modal").modal('show');
      },
      error:function(x){
        console.log(x);
      }
    })
    
  })

}
// sendjob notification

if(page == 'invitesrs'){
  
  load_srs();

  function load_srs(){
    $('#industry_table').DataTable({ 
      pageLength: 10,     
      ajax: base_url+"customer/serviceprovider_list",
      serverMethod: 'get',
      bFilter:false
   });
   }

   $("#sendjobinvite").click(function(e){
      e.preventDefault();
      var chk= $("input:checkbox:checked").length;
      var arr=[];
      if(chk == 0){
        alert("Select service provider");
      }else{
       $.each($("input:checkbox:checked"),function(){
         arr.push($(this).val());
       })
       var userids = JSON.stringify(arr);
       $.ajax({
         type:"post",
         url:base_url+"customer/sendjobrequest",
         data:{csrf_token_name:csrf_token,userids:userids,adid:$("#adid").val()},         
         success:function(res){     
           var rep =JSON.parse(res);
          if(rep.status == 1){
            $("#invmsg").html(rep.msg); 
            setInterval(() => {
              $("#invmsg").html('')
            }, 3000);      
          }else{
            $("#invmsg").html(rep.msg);
            setInterval(() => {
              $("#invmsg").html('')
            }, 3000);    
          }
         }
       })
      }
   })
}

// sendjob notification

if(page == 'jobnotify'){
  
  load_notify();

  $(document).on('click','.approve-invite',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#approve_modal").modal('show');
  })

  $(document).on('click','.unapprove-invite',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#block_modal").modal('show');
  })


  $(document).on('click','#apctrl',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/approve_invitation",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_notify(); 
          $("#approve_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })



  $(document).on('click','#blkapctrl',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/unapprove_invitation",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_notify(); 
          $("#block_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


    function load_notify(){

          var adid = $("#adid").val();
          console.log(adid);
          $('#industry_table').DataTable({ 
            "processing":true,
            "serverSide":true,
            ajax:{
              url:base_url+"admin/viewjobnotification/",
              type:"post",
              data:{csrf_token_name:csrf_token,id:adid}
            }
        });

    }

}

if(page == 'chat'){

setInterval(function() {
  load_chat_messages();
}, 2000);

function load_chat_messages(){
  var wrkid = $("#wrkid").val();
  $.ajax({
    type: "post",
    url:base_url+'admin/loadmsg',
    data:{csrf_token_name:csrf_token,wrkid:wrkid},
    success:function(res){      
       // console.log(res);          
        $("#msgcont").html(res);      
    },
    error:function(x){
      console.log(x);
    }

   });
}

$("#reply").keypress(function(e){  
  var keycode = (e.keyCode ? e.keyCode : e.which);
  if(keycode == 13){
    var msg = $("#reply").val();
    var sender = $("#senderid").val();
    var receiver = $("#receiverid").val();
    var wrkid = $("#wrkid").val();
    $.ajax({
      type: "post",
      url:base_url+'admin/sendmsg',
      data:{csrf_token_name:csrf_token,msg:msg,senderid:sender,receiverid:receiver,wrkid:wrkid},
     
      success:function(res){
        load_chat_messages();
        $("#reply").val('');
      },
      error:function(x){
        console.log(x);
      }
    })
    
  }
  
})

}


if(page == 'createpost'){

  $("#addpost").submit(function(e){
    e.preventDefault(); 
    $.ajax({
      type:"post",
      data:$(this).serialize(),
      url:base_url+'admin/addpost',
      success:function(res){
        var rep = JSON.parse(res);        
       if(rep.status == 1){
        alert(rep.msg);
         $("#addpost")[0].reset();
       }else{
          alert(rep.msg);
       }
      },
      error:function(x){
        console.log(x);
      }
    })
  })
}

if(page == 'editpost'){

  $("#editpost").submit(function(e){
    e.preventDefault(); 
    $.ajax({
      type:"post",
      data:$(this).serialize(),
      url:base_url+'admin/updatepost',
      success:function(res){  
        alert(res) ;          
       if(res == 1){
         window.location = base_url + 'view-post';
       }
      },
      error:function(x){
        console.log(x);
      }
    })
  })
}

if(page == 'viewpost'){

  load_blogpost();

  function load_blogpost(){
      $('#industry_table').DataTable({ 
        pageLength: 10,     
        ajax: base_url+"admin/viewblogposts",
        serverMethod: 'get',
        bFilter:false
    });
   }

   
  $(document).on('click','.delete-post',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#delete_modal").modal('show');
  })


  $(document).on('click','#delpost',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/delete_post",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_blogpost();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    $("#delete_modal").modal('hide');
  })


}

if(page == 'comments'){

  load_blogcomments();

  function load_blogcomments(){
    var blogid = $("#blogid").val();    
    $('#industry_table').DataTable({ 
      "processing":true,
      "serverSide":true,
      ajax:{
        url:base_url+"admin/viewblogcomments/",
        type:"post",
        data:{csrf_token_name:csrf_token,id:blogid}
      }
  });
   }

   
  $(document).on('click','.delete-comment',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#delete_modal").modal('show');
  })


  $(document).on('click','#delcmt',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/delete_comment",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_blogcomments();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    $("#delete_modal").modal('hide');
  })


  $(document).on('click','.approve-cmt',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#approve_modal").modal('show');
  })

  $(document).on('click','.block-cmt',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#block_modal").modal('show');
  })


  $(document).on('click','#apcmt',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/approve_comment",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_blogcomments();
          $("#approve_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })



  $(document).on('click','#blkcmt',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/block_comment",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_blogcomments();
          $("#block_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


}


if(page == 'crinquiry'){

  load_mailinquiries();

  function load_mailinquiries(){
      $('#industry_table').DataTable({ 
        pageLength: 10,     
        ajax: base_url+"admin/viewmailinquiries",
        serverMethod: 'get',
        bFilter:false
    });
   }

   $(document).on('click','.delete-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#indid").val(id);
    $("#delete_modal").modal('show');
  })


  $(document).on('click','#delsrinq',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/delete_srinq",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          $("#delete_modal").modal('hide');
          load_mailinquiries();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

  $(document).on('click','#markunread',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/markunread_inquriy",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_mailinquiries();
          $("#block_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

  $(document).on('click','#markread',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/markread_inquriy",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_mailinquiries();
          $("#approve_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','.read-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id'); 
    $("#cid").val(id);
    $("#approve_modal").modal('show');
  })

  $(document).on('click','.unread-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#block_modal").modal('show');
  })


}


if(page == 'srinquiry'){

  $(document).on('click','.delete-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#indid").val(id);
    $("#delete_modal").modal('show');
  })


  $(document).on('click','#delsrinq',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/delete_srinq",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          $("#delete_modal").modal('hide');
          load_srmailinquiries();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','#markunread',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/markunread_inquriy",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srmailinquiries();
          $("#block_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })

  $(document).on('click','#markread',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/markread_inquriy",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_srmailinquiries();
          $("#approve_modal").modal('hide'); 
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','.read-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id'); 
    $("#cid").val(id);
    $("#approve_modal").modal('show');
  })

  $(document).on('click','.unread-inquiry',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#block_modal").modal('show');
  })

  load_srmailinquiries();

  function load_srmailinquiries(){
      $('#industry_table').DataTable({ 
        pageLength: 10,     
        ajax: base_url+"admin/viewsrmailinquiries",
        serverMethod: 'get',
        bFilter:false
    });
   }
}

if(page == 'feedback'){

  load_feedback();

  function load_feedback(){    
    $('#industry_table').DataTable({ 
        pageLength: 10,     
        ajax: base_url+"admin/viewfeedbacks",
        serverMethod: 'get',
        bFilter:false
    });
  }

  $(document).on('submit','#addfeedback',function(e){
    e.preventDefault();
    $.ajax({
      type:"post",
      url: base_url+"admin/add_feedback",
      data:$(this).serialize(),
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        $("#Add_Country").modal('hide');
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          load_feedback();
       }else{
          alert(rep.msg);
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','.delete-feed',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $("#cid").val(id);
    $("#delete_modal").modal('show');
  })


  $(document).on('click','#delfeed',function(e){
    e.preventDefault();
    var id = $("#cid").val();
    $.ajax({
      type:"post",
      url: base_url+"admin/delete_feedback",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res);
       if(rep.status == 1){
        if ($.fn.DataTable.isDataTable('#industry_table')) {
            $('#industry_table').DataTable().clear().destroy();
          }
          $("#delete_modal").modal('hide');
          load_feedback();
       }
      },error:function(xhr){
        console.log(xhr);
      }
    })
    
  })


  $(document).on('click','.edit-feed',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    $.ajax({
      type:"post",
      url: base_url+"admin/getfeedbyid",
      data:{id:id, csrf_token_name:csrf_token},
      success:function(res){
        var rep = JSON.parse(res); 
        $("#etagid").val(rep.tid);
        $("#euname").val(rep.name);        
        $("#emsg").val(rep.feedback);    
        $("#edit_tag").modal('show');
      },error:function(xhr){
        console.log(xhr);
      }
    })      
  })

  $(document).on('submit','#editfeed',function(e){
    e.preventDefault(); 
        $.ajax({
        url:'admin/updateFeed',
        type:"post",
        data:$(this).serialize(),
        success: function(res){ 
          console.log(res);
          $("#edit_tag").modal('hide');
            if ($.fn.DataTable.isDataTable('#industry_table')) {
              $('#industry_table').DataTable().clear().destroy();
            }
            load_feedback();
        },
        error:function(x){
          console.log(x);
        }
        });
  });


}