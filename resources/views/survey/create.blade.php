@extends('layouts.login-master')
@section('pageCss')
@endsection
@include('layouts.head_meta')
@include('layouts.head_links')
@section('content')
<div class="container mt-2">    

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Survey Form</h2>
            </div>            
        </div>
    </div>  
    @if(session('success'))
    <div class="alert alert-success mb-1 mt-1">
            {{ session('success') }}
        </div>
    @endif

    @if(session('fail'))
    <div class="alert alert-danger mb-1 mt-1">
        {{ session('fail') }}
    </div>
    @endif
    
    <form id="survey-form" action="/api/survey/add" method="POST">
        {{-- @csrf --}}
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Name</strong>
                    <input type="text" name="name" id="name" class="name form-control" placeholder="Enter Name">
                     <!-- client error -->
                     <div class="nameError mt-2"></div>
                     <!-- end client error -->
                    <!-- server error -->
                    @if($errors->has('name'))
                    <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('name') }}</div>
                    @endif
                     <!-- end server error -->
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
                    <!-- server error -->
                    @if($errors->has('email'))
                    <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('email') }}</div>
                    @endif
                     <!-- end server error -->
                </div>
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Phone Number</strong>
                    <input type="text" name="phone_number" id="phone_number" class="phone_number form-control" placeholder="Enter Phone Number">
                     <!-- client error -->
                     <div class="phone_numberError mt-2"></div>
                     <!-- end client error -->
                    <!-- server error -->
                    @if($errors->has('phone_number'))
                    <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('phone_number') }}</div>
                    @endif
                     <!-- end server error -->
                </div>
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Date Of Birth</strong> 
                    <div class="form-group">
                        <div class="input-group datepicker">
                            <input type="text" name="date_of_birth" id="date_of_birth" class="date_of_birth input-datepicker form-control" placeholder="Date Of Birth" >
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </div>                
               
                <!-- client error -->
                <div class="date_of_birthError mt-1"></div>
                <!-- end client error -->
                <!-- server error -->
                @if($errors->has('date_of_birth'))
                <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('date_of_birth') }}</div>
                @endif
                    <!-- end server error -->                
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Gender</strong>
                    <input type="radio" name="gender" value="1" checked > Male
                    <input type="radio" name="gender" value="0"> Female
                     
                    <!-- server error -->
                    @if($errors->has('gender'))
                    <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('gender') }}</div>
                    @endif
                     <!-- end server error -->
                </div>
            </div>             
        </div>

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">           
                {{-- <input class="btn btn-primary" type="submit" value="Save"> --}}

                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            <div class="col-xs-4 col-sm-4 col-md-4">
        </div>
    </form>
</div>
@endsection
@section('pageJs')
<script src="{{ asset('js/survey/survey-form-valid.js') }}"></script>   
<script type="text/javascript"> 
    $(function() {
        console.log("Token: ",window.localStorage.getItem('MyApp'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept' :'application/json',
                'Authorization' : 'Bearer ' + window.localStorage.getItem('MyApp'),
            }
         });
        
         $("#survey-form").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.          

            $.ajax({
                type: "POST", 
                url: $(this).attr('action'), 
                dataType: 'json',                              
                data: $(this).serialize(), 
                success: function (result) {                    
                    window.location=result.message;
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
