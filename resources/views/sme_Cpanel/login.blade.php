<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">  </head>
<body>
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="login" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('collection/img/logo/logo.png') }}" alt="" style="width: 33%; margin-left: 104px;">
                            </a>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>
                                {{-- method="POST" action="{{ route('login') }}"  --}}
                                <form class="row g-3 needs-validation"  novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                            <div class="invalid-feedback">Please enter your useremail.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" style="margin-bottom: 0px; width: 100%; height: 40px; font-size: 24px; font-weight: bolder; text-decoration: line-through; display: inline-block; background-color: rgb(178, 0, 255);" id="mainCaptcha" disabled="">
                                        <button class="btn btn-success" type="button"
                                                style="display: inline-block;
      "
                                                id="refresh" onclick="Captcha();">Generate Code</button>
                                        <div style="margin-top:10px; color: #D8000C; background-color: #FFBABA; border-radius: 7px;" id="log"></div>

                                        <input style="margin-top:10px;" type="text" class="form-control" placeholder="Enter captcha" name="captcha" id="txtInput" required="">
                                        <br>
                                    </div>


                                    <div class="col-12">
                                        </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" name="submit" type="submit" id="loginButton">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>  </body>

<script>
$(document).ready(function() {
    $("#loginButton").on('click',function(){
        const name = $("#email").val();
        const password = $("#password").val();
        

        $.ajax({
    //         headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // }
            url: '/api/v1/login',
            type: 'POST',
            contentType:'application/json',
            data: JSON.stringify({
                email:name,
                password:password
            }),
            success: function(response){
                localStorage.setItem('api_token',response.token);
                window.location.href = "index";
            },
            error:function(xhr,status,error){
                alert('Error:'+xhr.responseText);
            }
        })
    })
})


function validateForm(){
        document.getElementById('log').innerHTML = '';
        var string1 = removeSpaces(document.getElementById('mainCaptcha').value);
        var string2 = removeSpaces(document.getElementById('txtInput').value);
        if (string1 != string2 || string2 == ""){
            Captcha();
            document.getElementById('log').innerHTML += '<span style="font-size:16px; padding: 25px;">Entered Invalid Captcha</span> ';
            return false;
        }
    }
    function Captcha(){
        var alpha = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9','0');
        var i;
        for (i=0;i<6;i++){
            var a = alpha[Math.floor(Math.random() * alpha.length)];
            var b = alpha[Math.floor(Math.random() * alpha.length)];
            var c = alpha[Math.floor(Math.random() * alpha.length)];
            var d = alpha[Math.floor(Math.random() * alpha.length)];
            var e = alpha[Math.floor(Math.random() * alpha.length)];
            var f = alpha[Math.floor(Math.random() * alpha.length)];
            var g = alpha[Math.floor(Math.random() * alpha.length)];
        }
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        document.getElementById("mainCaptcha").value = code
        var colors = ["#B40404", "#beb1dd", "#b200ff", "#faff00", "#0000FF", "#FE2E9A", "#FF0080", "#2EFE2E", ];
        var rand = Math.floor(Math.random() * colors.length);
        $('#mainCaptcha').css("background-color", colors[rand]);

    }
    function removeSpaces(string){
        return string.split(' ').join('');
    }

</script>
</html>