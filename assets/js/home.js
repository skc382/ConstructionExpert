/**************/
var csrf_token=$('#user_csrf').val();
var page = $("#page").val();
$(".add_service").hide();
/**************/

$('#customword').autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: baseurl + 'home/loadservicetitle',
      type: 'post',
      dataType: 'json',
      data: {
        search: request.term,
        csrf_token_name:csrf_token
      },
      success: function (data) {
        console.log(data);
        response(data);
      },
      error: function (x) {
        console.log(x);
      },
    });
  },
  select: function (event, ui) {
    // Set selection
    $('#customword').val(ui.item.label); // display the selected text
    $('#customword').val(ui.item.value); // save selected id to input
    return false;
  },
});

var v = jQuery("#registerform").validate({
  rules: {
    surname: {
      required: true,
      minlength: 2,
      maxlength: 16
    },
    role: {
      required: true
    },
    mobile: {
      required: true,
      minlength: 10,
      maxlength: 10,
    },
    email: {
      required: true,
      minlength: 2,
      email: true,
      maxlength: 100,
    },
    pass: {
      required: true
      // minlength: 6,
      // maxlength: 8,
    },
    rpass: {
      required: true,
      equalTo: "#pass"
    },
    agree:{
      required:true
    }
  
  },
  errorElement: "p",
  errorClass: "text-danger",
  });

  $("#role").change(function(e){
    e.preventDefault();
     var roleid = $(this).val();
     if(roleid == 3){
      $(".add_service").show();
     }else{
      $(".add_service").hide();
     }
  })

  $("#registerform").submit(function (e) { 
    e.preventDefault();
        $.ajax({
          type: "POST",
          url: baseurl+"user/register",
          data: $(this).serialize(),
          beforeSend:function(){
             $("#regbtn").attr("disabled",true);
          },
          success: function (response) {
              
            var rep=JSON.parse(response); 
            
            if(rep.status === 2){
                $("#regbtn").attr("disabled",false);
                  $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');
                  console.log("http://wa.me/"+rep.registerphone+"/?text="+rep.verificationlink);
                  setTimeout(function(){
                window.location.href = "http://wa.me/91"+rep.registerphone+"/?text="+rep.verificationlink;      
                  },1000)
                
                
            }
            if(rep.status === 0){
                $("#regbtn").attr("disabled",false);
              $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          }
        });
  });

// login
$("#userlogin").submit(function (e) { 
  e.preventDefault();
      $.ajax({
        type: "POST",
        url: baseurl+"user/processUserLogin",
        data: $(this).serialize(),
        success: function (response) {
          var rep=JSON.parse(response); 
          if(rep.status == 1){            
            // $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');
            // $("#login")[0].reset();
            window.location.href =rep.msg;
          }
          if(rep.status == 0){
            $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
          }
        },error:function(x){
          console.log(x);
        }
      });
});


// forgot
$("#forgotform").submit(function (e) { 
  e.preventDefault();
      $.ajax({
        type: "POST",
        url: baseurl+"user/processForgot",
        data: $(this).serialize(),
        success: function (response) {
          var rep=JSON.parse(response); 
          if(rep.status == 1){            
            $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');
             $("#forgotform")[0].reset();
            
          }
          if(rep.status == 0){
            $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
          }
        },error:function(x){
          console.log(x);
        }
      });
});



var v = jQuery("#changepassform").validate({
  rules: {
   
    pass: {
      required: true
      // minlength: 6,
      // maxlength: 8,
    },
    cpass: {
      required: true,
      equalTo: "#pass"
    }
  
  },
  errorElement: "p",
  errorClass: "text-danger",
  });

// forgot
$("#changepassform").submit(function (e) { 
  e.preventDefault();
      $.ajax({
        type: "POST",
        url: baseurl+"user/updatepassword",
        data: $(this).serialize(),
        success: function (response) {
            console.log(response);
          var rep=JSON.parse(response); 
          if(rep.status == 1){            
            console.log(rep.msg);
            $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');
             $("#changepassform")[0].reset();
            
          }
          if(rep.status == 0){
            $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
          }
        },error:function(x){
          console.log(x);
        }
      });
});

setInterval(function() {
  load_chat_messages();
}, 2000);

function load_chat_messages(){
  var wrkid = $("#wrkid").val();
  $.ajax({
    type: "post",
    url:baseurl+'user/loadmsg',
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
  
// user profile
if(page == 'userprofile'){
  //alert(page);

  $("#profileform").submit(function (e) { 
    e.preventDefault();
        $.ajax({
          type: "POST",
          url: baseurl+"user/updateprofile",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function (response) {
            var rep=JSON.parse(response); 
            if(rep.status == 1){   
               picimg =  baseurl+"assets/img/author/thumb/"+rep.pic;
               $("#picimg").attr('src',picimg);
               $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');            
            }
            if(rep.status == 0){
              $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          }
        });
  });

  $("#cmpform").submit(function (e) { 
    e.preventDefault();
        $.ajax({
          type: "POST",
          url: baseurl+"user/addcompanyprofile",
          data: $(this).serialize(),
          success: function (response) {
            var rep=JSON.parse(response); 
            if(rep.status == 1){   
               $("#cmp_error").html('<div class="alert alert-success">'+rep.msg+'</div>');            
            }
            if(rep.status == 0){
              $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          },
          error:function(x){
            console.log(x);
          }
        });
  });

}


// add service
if(page == 'addservice'){
  //alert(page);

  $("#addserviceform").submit(function (e) { 
    e.preventDefault();

        $.ajax({
          type: "POST",
          url: baseurl+"services/addservice",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function (response) {
            var rep=JSON.parse(response); console.log(response);
            if(rep.status == 1){   
               $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');            
            }
            if(rep.status == 0){
              $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          }
        });
  });

}

// add service
if(page == 'editservice'){
  //alert(page);

  $("#editserviceform").submit(function (e) { 
    e.preventDefault();

        $.ajax({
          type: "POST",
          url: baseurl+"services/editservice",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function (response) {
            var rep=JSON.parse(response); console.log(response);
            if(rep.status == 1){   
               $("#reg_error").html('<div class="alert alert-success">'+rep.msg+'</div>');            
            }
            if(rep.status == 0){
              $("#reg_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          }
        });
  });


  function removeimg(id){
    //alert(id);
    var userserviceid = $("#userserviceid").val(); 
    $.ajax({
      type: "post",
      url:baseurl+'user/removeserviceimg',
      data:{csrf_token_name:csrf_token,id:id,usid:userserviceid},
      success:function(res){   
        // console.log(res);
        $("#imgbox").html('');  
          $("#imgbox").html(res);
      },
      error:function(x){
        console.log(x);
      }
    })
  }

  function removepdf(id){
        var userserviceid = $("#userserviceid").val(); 
    $.ajax({
      type: "post",
      url:baseurl+'user/removeservicepdf',
      data:{csrf_token_name:csrf_token,id:id,usid:userserviceid},
      success:function(res){   
        // console.log(res);
        $("#pdfbox").html('');  
          $("#pdfbox").html(res);
      },
      error:function(x){
        console.log(x);
      }
    })
  }

}

// post ad
if(page == 'postads'){

  $("#jobform").submit(function (e) { 
    e.preventDefault();
        $.ajax({
          type: "POST",
          url: baseurl+"customer/postad",
          data: $(this).serialize(),
          success: function (response) {
            var rep=JSON.parse(response); 
            if(rep.status == 1){   
               $("#ads_error").html('<div class="alert alert-success">'+rep.msg+'</div>');
               $("#jobform")[0].reset();            
            }
            if(rep.status == 0){
              $("#ads_error").html('<div class="alert alert-danger">'+rep.msg+'</div>');
            }
          },
          error:function(x){
            console.log(x);
          }
        });
  });

}

// adinfo
function invite(id){  
  var adid = $("#adid").val();
  var srsuid = $("#s"+id).val();  
  
  $.ajax({
    type: "post",
    url:baseurl+"customer/invitesrs",
    data:{"adid":adid,"srsuid":srsuid,csrf_token_name:csrf_token},
    success:function(res){
      var rep =JSON.parse(res);
      if(rep.status == 1){
        $("#invite_msg").html(rep.msg)
        setInterval(() => {
          $("#invite_msg").html('')
        }, 3000);
        
      }
      if(rep.status == 0){
        $("#invite_msg").html(rep.msg)
        setInterval(() => {
          $("#invite_msg").html('')
        }, 3000);
      }
      
    },error:function(x){
      console.log(x);
    }
  })
}

// chat

if(page == 'chat'){


  $("#award").click(function(e){
    e.preventDefault();
    var receiverid = $("#receiveruserid").val();
    var adid = $("#adid").val();
    $.ajax({
      type: "post",
      url:baseurl+'user/awardproject',
      data:{csrf_token_name:csrf_token,adid:adid,receiverid:receiverid},
      success:function(res){
        
        if(res==1){
          $("#award").text('Awarded');
        }
      },
      error:function(x){
        console.log(x);
      }
    })
  })


  $('#reply').keypress(function(e){
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if(keycode == 13){
    var msg = $("#reply").val();
    var sender = $("#senderid").val();
    var receiver = $("#receiverid").val();
    var wrkid = $("#wrkid").val();
    $.ajax({
      type: "post",
      url:baseurl+'user/sendmsg',
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

  $("#markcomplete").click(function(e){
    e.preventDefault();
    var adid = $("#adid").val();
    $.ajax({
      type: "post",
      url:baseurl+'user/markprojectcomplete',
      data:{csrf_token_name:csrf_token,adid:adid},
      success:function(res){
        if(res == 1){
          $("#markcomplete").text('Completed');
        }
        
      },
      error:function(x){
        console.log(x);
      }
    })
  })
}

if(page == 'blogpost'){

  $("#commentform").submit(function(e){
    e.preventDefault();    
    $.ajax({
      type: "post",
      url:baseurl+'blog/postcomment',
      data:$(this).serialize(),
      success:function(res){
        var rep = JSON.parse(res);
        if(rep.status == 1){
          $("#cmt_error").html(rep.msg);
        }
        if(rep.status == 0){
          $("#cmt_error").html(rep.msg);
        }
        
      },
      error:function(x){
        console.log(x);
      }
    })
  })


}


if(page == 'myads'){

$(".deletead").click(function(){
  var res = confirm('Do you want to delete this ad');
  if(res){
    var id = $(this).attr('id');
    window.location = baseurl+'delete-my-ad/'+id;
  }
})
}


if(page == 'myservices'){
// console.log(page);

  $(".deleteservice").click(function(){ 
    var res = confirm('Do you want to delete this service');
    if(res){
      var id = $(this).attr('id');
      window.location = baseurl+'delete-my-services/'+id;
    }
  })
  
  $(".editrequest").click(function(){
    var id = $(this).attr('id'); 
    $.ajax({
      type: "post",
      url:baseurl+'user/sendeditrequest',
      data:{csrf_token_name:csrf_token,id:id},
      success:function(res){     
          alert(res);
      },
      error:function(x){
        console.log(x);
      }
    })
  });

  
}



  
  $("#quoteForm").submit(function(e){
    e.preventDefault();    
    //console.log($(this).serialize());
    $.ajax({
      type: "post",
      url:baseurl+'home/send_mail_user',
      data:$(this).serialize(),
      beforeSend:function(){
        $("#btnquote").attr('disabled',true)  ;
      },
      success:function(res){   
          //alert(res);
          $("#msgSubmit").html(res);
           
          $("#btnquote").attr('disabled',false)  ;
          $("#quoteForm")[0].reset();
      },
      error:function(x){
        console.log(x);
      }
    })
  })


    $("#contactForm").submit(function(e){
    e.preventDefault();    
    $.ajax({
      type: "post",
      url:baseurl+'home/send_mail',
      data:$(this).serialize(),
      beforeSend:function(){
        $("#btnquote").attr('disabled',true)  ;
      },
      success:function(res){     
          $("#msgSubmit").html(res);
           $("#btnquote").attr('disabled',false)  ;
          $("#contactForm")[0].reset();
      },
      error:function(x){
        console.log(x);
      }
    })
  })


  $("#serviceinquiryform").submit(function(e){
    e.preventDefault();    
    $.ajax({
      type: "post",
      url:baseurl+'home/send_mail_srs',
      data:$(this).serialize(),
      success:function(res){     
          $("#msgSubmit").html(res);
      },
      error:function(x){
        console.log(x);
      }
    })
  })



