@extends('layouts.login-master')

@include('layouts.head_meta')
@include('layouts.head_links')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Survey</h2>
            </div>            
        </div>
    </div>   

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="register-form">
        @csrf 
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Name</strong>
                    <input type="text" id="name" name="name" class="name form-control" placeholder="Enter Name">
                     <!-- client error -->
                     <div class="nameError mt-2"></div>
                     <!-- end client error -->                      
                    
                </div>
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Email</strong>
                    <input type="text" id="email" name="email" class="email form-control" placeholder="Enter Email Address">
                     <!-- client error -->
                     <div class="emailError mt-2"></div>
                     <!-- end client error -->                      
                    
                </div>
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Password</strong>
                    <input type="password" id="password" name="password" class="password form-control" placeholder="Enter Password">
                     <!-- client error -->
                     <div class="passwordError mt-2"></div>
                     <!-- end client error -->
                </div>
            </div>             
        </div>
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2">           
                {{-- <input class="btn btn-primary btn-submit" type="submit" value="Register"> --}}
                <button class="btn btn-success btn-submit">Register</button>
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2">           
                <a href="/" class="ml-2 btn btn-primary ">Back To Login </a>
             </div>           
        </div>
    </form> 
</div>
@endsection
@section('pageJs')
<script src="{{ asset('js/register/register-form-valid.js') }}"></script>
<script type="text/javascript">  
  
    $(".btn-submit").click(function(e){    
        e.preventDefault();     
        var name = $("#name").val();        
        var email = $("#email").val();
        var password=$("#password").val();
     
        $.ajax({
           type:'POST',
           url:"api/register",
           data:{name:name, email:email,password:password},
           success:function(result){
            console.log("Data",result.data.redirect); 
            window.location = result.data.redirect;           
           },
           error: function(error) { 
            console.log("Error",error);                
            },
        });
    
    }); 
   

</script>
@endsection
@include('layouts.footer')
