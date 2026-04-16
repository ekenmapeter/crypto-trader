
$(document).ready(function(){

    function getActivation(){
      var result = '';
      $.ajax({
        url:"register/xhrGetActivation",
        method:"POST",
        async: false, 
        success:function(data){
          result = data;
        }
      })
      return result
    }
    //Login Submission
    $('#login-form').on('submit', function(e){
        e.preventDefault();
        let loginBtn = document.getElementById('loginBtn');
        let formData = $(this).serialize();
        $.ajax({
            url:"login/authenticate",
            method:"POST",
            dataType:'JSON',
            data: formData,
            beforeSend: function(){
              loginBtn.innerHTML = '<i class="spinner-border-sm spinner-border"></i>';
              loginBtn.disabled = true;
            },
            success:function(data){
              if(data.type == 'success'){
                window.location.href = data.message;
              }else{
                if(data.type == 'error'){
                    Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...</h4><p class="text-muted mx-4 mb-0">'+data.message+'</p></div></div>',showCancelButton:!0,showConfirmButton:!1,cancelButtonClass:"btn btn-primary w-xs mb-1",cancelButtonText:"Dismiss",buttonsStyling:!1,showCloseButton:!0})
                }else{
                    Swal.fire({
                        title: data.type,
                        html: data.message,
                        icon: 'error',
                    
                    })
                }
                loginBtn.innerHTML = 'Sign In';
                loginBtn.disabled = false;
              }
            }
        })
    })

    //Forgot Password Form
    $('#forgot-password-form').on('submit', function(e){
        e.preventDefault();
        let forgotBtn = document.getElementById('forgotBtn');
        let formData = $(this).serialize();
        $.ajax({
            url:"forgot/xhrSend",
            method:"POST",
            data: formData,
            beforeSend: function(){
              forgotBtn.innerHTML = '<i class="spinner-border-sm spinner-border"></i>';
              forgotBtn.disabled = true;
            },
            success:function(data){
              if(data == 'success'){
                Swal.fire('Success!', 'A password reset link has been sent to your email address', 'success');
                $('#forgot-password-form')[0].reset();
              }else{
                Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">'+data+'</p></div></div>',showCancelButton:!0,showConfirmButton:!1,cancelButtonClass:"btn btn-primary w-xs mb-1",cancelButtonText:"Dismiss",buttonsStyling:!1,showCloseButton:!0})
              }
                forgotBtn.innerHTML = 'Send reset link';
                forgotBtn.disabled = false;
            }
          })
    })

    //Reset Password Form
    $('#reset-password-form').on('submit', function(e){
      e.preventDefault();
        let formData = $(this).serialize();
        let changeBtn = document.getElementById('resetBtn');
        $.ajax({
            url:"reset/xhrchange",
            method:"POST",
            data: formData,
            beforeSend: function(){
              changeBtn.innerHTML = '<i class="spinner-border-sm spinner-border"></i>';
              changeBtn.disabled = true;
            },
            success:function(data){
              if(data == 'success'){
                Swal.fire({
                  html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Your password has been successsfully changed. You will be redirected to the login page</p></div></div>',showCancelButton:!1,showConfirmButton:!0,confirmButtonClass:"btn btn-primary w-xs mb-1",confirmButtonText:"Continue",buttonsStyling:!1,showCloseButton:!0,
                  willClose: () => {
                    window.location.href="login";
                  }
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href="login";
                  }
                })
               
              }else{
                Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...!</h4><p class="text-muted mx-4 mb-0">'+data+'</p></div></div>',showCancelButton:!0,showConfirmButton:!1,cancelButtonClass:"btn btn-primary w-xs mb-1",cancelButtonText:"Dismiss",buttonsStyling:!1,showCloseButton:!0})
              }
              changeBtn.innerHTML = 'Reset Password';
              changeBtn.disabled = false;
            }
          })
    })

    //Resend OTP Button
    let resendOtp = document.getElementById('resendOtp');
    
    if(resendOtp){
      resendOtp.addEventListener('click', (e) => {
        e.preventDefault();
        let ul=document.querySelector(".card.resendOtp");
        insertEl='<div class="card-preloader"><div class="card-status"><div class="spinner-border text-success"><span class="visually-hidden">Loading...</span></div></div></div>';
        ul.children[0].insertAdjacentHTML("beforeend",insertEl);
        
        
        $.ajax({
          url:"login/resendOtp",
          method:"POST",
          success:function(data){
            if(data == 'success'){
              toastr.success('The OTP has been sent to your email address',"Success!",{closeButton:!0,tapToDismiss:!1})
            }else{
              toastr.error(data,"Error!",{closeButton:!0,tapToDismiss:!1})
            }
            var t=ul.getElementsByClassName("card-preloader")[0];
            setTimeout(function(){t.remove()},500+5*Math.random()*300);
          }
        })
      })
    }
    
    //OTP form
    $('.auth-otp-form').on('submit', function(e){
      e.preventDefault();
      let otpBtn = document.getElementById('otpBtn');
      let digit1 = document.getElementById('digit1-input').value;
      let digit2 = document.getElementById('digit2-input').value;
      let digit3 = document.getElementById('digit3-input').value;
      let digit4 = document.getElementById('digit4-input').value;
      let code = digit1 + digit2 + digit3 + digit4;
      $.ajax({
        url:"login/xhrVerifyOtp",
        method:"POST",
        data: {otp:code},
        beforeSend: function(){
          otpBtn.innerHTML = '<i class="spinner-border-sm spinner-border"></i>';
          otpBtn.disabled = true;
        },
        success:function(data){
          if(data == 'success'){
            window.location.reload(true);
          }else{
            Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...!</h4><p class="text-muted mx-4 mb-0">'+data+'</p></div></div>',showCancelButton:!0,showConfirmButton:!1,cancelButtonClass:"btn btn-primary w-xs mb-1",cancelButtonText:"Dismiss",buttonsStyling:!1,showCloseButton:!0})
          }
          otpBtn.innerHTML = 'Continue';
          otpBtn.disabled = false;
        }
      })
    })

    //Register Form
    $('#register-form').on('submit', function(e){
      e.preventDefault();
      let formData = $(this).serialize()
      var mnemonic = window.getMnemonic();
      let registerBtn = document.getElementById('registerBtn');
      $.ajax({
        url:"register/xhrAdd",
        method:"POST",
        data: formData+"&mnemonic="+mnemonic,
        beforeSend: function(){
          registerBtn.innerHTML = '<i class="spinner-border-sm spinner-border"></i>';
          registerBtn.disabled = true;
        },
        success:function(data){
          if(data == 'success'){
            localStorage.setItem('activation-id', getActivation());
            window.location.href = 'register?success';
          }else{
            toastr.error(data,"Error!",{closeButton:!0,tapToDismiss:!1})
            registerBtn.innerHTML = 'Sign Up';
            registerBtn.disabled = false;
          }
        }
      })
    })

    let resendEmailVerification = $('.resendEmailVerification');

    if(resendEmailVerification.length){
      resendEmailVerification.on('click', (e)=> {
        e.preventDefault();
        let id = localStorage.getItem('activation-id');
        id = id ? id : '';
        let btnWidth = resendEmailVerification.outerWidth();
        console.log(btnWidth);
        $.ajax({
          url:"register/xhrResendVerification",
          method:"POST",
          dataType:"json",
          data:{id:id},
          beforeSend: function(){
            resendEmailVerification.html('<div class="spinner-border spinner-border-sm" role="status"></div>');
            resendEmailVerification.attr('disabled', true);
            resendEmailVerification.css('width',btnWidth);
          },
          success:function(data){
            resendEmailVerification.html('Resend Verification Email');
            resendEmailVerification.attr('disabled', false);
            if(data.type=='success'){
              toastr.success(data.message,"Success!",{closeButton:!0,tapToDismiss:!1})
            }else{
              if(data.type == 'verified'){
                toastr.info(data.message,"Info!",{closeButton:!0,tapToDismiss:!1})
                setTimeout(function(){
                  window.location.href = login;
                }, 2000);
              }else{
                toastr.error(data.message,"Error!",{closeButton:!0,tapToDismiss:!1})
              }
            }
          }
        })
      })
    }
    
})