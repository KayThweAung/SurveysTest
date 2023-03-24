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

    <form id="login-form" action="api/login" method="POST">
        @csrf  
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
            <div class="col-xs-4 col-sm-4 col-md-4">           
                {{-- <input class="btn btn-primary" type="submit" value="Login"> --}}
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            <div class="col-xs-4 col-sm-4 col-md-4">
        </div>
    </form>

    <div class="content-extra-display">
       Don't have an account?  <a href="{{ route('signup') }}" class="ml-2"> Sign UP </a>
    </div>

</div>
@endsection
@section('pageJs')
<script src="{{ asset('js/login/login-form-valid.js') }}"></script>

<script type="text/javascript">
 
    $(function() {    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),           
            }
        });
        
        $('#login-form').submit(function(e) {
            
            e.preventDefault();                    
    
            $.ajax({
                type: "POST", 
                url: $(this).attr('action'),                               
                data: $(this).serialize(),            
                              
                success: function (result) {                    
                    window.localStorage.setItem('MyApp', result.data.token);                   
                    window.location = result.data.redirect; 
                },
                error: function(error) { 
                console.log("Error",error);                
                },
            });    
            
        });
    
      
    });      
        
    
</script>
@endsection
@include('layouts.footer')
