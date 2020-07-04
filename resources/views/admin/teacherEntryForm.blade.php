@extends('layouts.adminLayout')
@section('title','Add Teacher')
@section('staffStudent')
class="active-menu"
@endsection
@section('headContent')
<script>
 $( function() {
    $( "#datepicker" ).datepicker({ 
        maxDate: 0, 
        showAnim:'slide',
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0'
     });
  } );
  </script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <h2 style="text-transform:capitalize;">Teacher Entry Form</h2>   
    </div>  
    @if(Session::get('success'))
    <div class="col-md-12 alert alert-success" style="margin:0 25px; width: 95%;">
        {{Session::get('success')}} <span class="close" style="color: #ff0000;"><strong>x</strong> </span>
    </div> 
    <script>
        $(document).ready(function(){
            $('body').on('click','.close',function(){
                $('.alert').hide();
            });
        })
    </script>
    @endif
</div>              
       <!-- /. ROW  -->
        <hr />

<div class="row">
    <form action="{{route('teacher.store')}}" method="post" enctype="multipart/form-data" id="submitForm">
    @csrf
        <div style="padding:0 30px;">
            <div class="col-md-12 form-group">
                <label for="">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control reqClass" name="name" value="{{old('name')}}" placeholder="Enter Teacher's Name">
                @error('name')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-6 form-group">
                <label for="">Email Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control reqClass" name="email" value="{{old('email')}}" placeholder="Enter Email Address">
                @error('email')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label for="">Blood Group</label>
                <input type="text" value="{{old('bloodGrp')}}" name="bloodGrp" class="form-control" placeholder="Enter Teacher's Blood Group">
            </div>

            <!-- <div class="col-md-6 form-group"> -->
                <!-- <label for="">Branch <span class="text-danger">*</span></label> -->
                <input type="hidden" value="Belgharia" name="brnch" class="form-control reqClass" placeholder="Enter Branch">
                @error('brnch')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            <!-- </div> -->
            <div class="col-md-6 form-group">
                <label for="">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control reqClass" value="{{old('image')}}">
                @error('image')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label for="">DOB <span class="text-danger">*</span></label>
                <input type="text" id="datepicker" name="dob" class="form-control reqClass" value="{{old('dob')}}" placeholder="Click to select DOB" autocomplete="off">
                @error('dob')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label for="">Gender <span class="text-danger">*</span></label><br>
                Male
                <input type="radio" name="gender" class="reqClass" value="0" {{old('gender')==0?'checked':null}}>
                Female
                <input type="radio" name="gender" class="reqClass" value="1" {{old('gender')==1?'checked':null}}>
                <!-- <div class="text-danger" id="gender" style="display:none">Select Gender</div> -->
                @error('gender')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-12 form-group">
                <label for="">Qualification <span class="text-danger">*</span></label>
                <input type="text" value="{{old('qualification')}}" name="qualification" class="form-control reqClass" placeholder="Enter Qualification. eg: B.Sc, B.Com, B.Ed, B.A. etc...">
                @error('qualification')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <!-- <div class="col-md-6"></div> -->
            <div class="col-md-12 form-group">
                <label for="">Address <span class="text-danger">*</span></label>
                <input type="text" value="{{old('add')}}" name="add" class="form-control reqClass" placeholder="Enter Teacher's Address">
                @error('add')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label for="">Zip Code <span class="text-danger">*</span></label>
                <input type="text" value="{{old('zip')}}" name="zip" class="form-control reqClass" placeholder="Enter Zip Code">
                @error('zip')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label for="">Phone <span class="text-danger">*</span></label>
                <input type="number" value="{{old('phone')}}" name="phone" class="form-control reqClass phone" placeholder="Enter Teacher's Phone Number">
                @error('phone')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
    
            <div style="float:right; margin:0 20px;">
                <button type="button" class="btn btn-lg btn-success" style="outline:none;">Submit</button>
            </div>
        </div>
    
    </form>
</div>

<script>
$(document).ready(function(){
    var formSub=true; //to get global access
    $('body').on('click','.btn',function(){
        formSub=true;
        // $('#gender').hide();
        $('.reqClass').map(function(){
            $(this).css("border","1px solid #ced4da");
            if(this.value.trim() == "") {
                $(this).css("border","solid 1px #dc3545");
                this.focus();
                formSub=false;
            }
            else{
                formSub= this.value && formSub;

            }
        });
        // if($('input[name="gender"]').val==null){
        //     formSub=false;
        //     $('#gender').show();
        // }
        if(formSub){
            // alert("success");
            $('#submitForm').submit();
        }
    });
});
</script>

<!-- phone number validation -->
<script>
        $('.phone').blur(function(){
            let ph=$(this).val();
            let phChk=($.isNumeric(ph) && ph>100)? true : false;
            if(!phChk){
                $(this).val(null);
                alert('Enter a valid phone number');
            }
                        
        })
    </script>
@endsection