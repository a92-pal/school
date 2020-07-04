<div class="row" style="margin:4px;">
    <div class="col-md-4" style=" padding:44px; background-color: #f5f5f5; box-sizing:border-box;">
        <div style="width:100%; margin-bottom:34px;">
            <img src="{{asset($user['user_detail']['image'])}}" alt="" style="height:250px; border:7px solid #ffffff; width:250px; border-radius:50%;">
        </div>

        <!-- start change image secion -->
        <div>
            <button class="btn btn-success chng_image" style="width:100%; outline:none;"> Change Image</button>
        </div>
        <div style="margin:5px 0; display:none; border:1px solid #ccc; padding:5px;" id="image_form" >
            <form action="{{route('teacher_image')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-12" style="margin:5px 0;">
                        <button type="submit" class="btn btn-success uploadImage" style="outline:none; float:right;" disabled>Upload <i class="fa fa-upload" aria-hidden="true"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $('.chng_image').click(function(){
                $('input[name="image"]').val(null);
                $('.uploadImage').attr('disabled',true);
                $('#image_form').toggle(200);
            });

            $('body').on('change','input[name="image"]',function(){
                var image=$('input[name="image"]').val();
                image ? $('.uploadImage').attr('disabled',false) : $('.uploadImage').attr('disabled',true);
            });
        </script>
<!-- end change image section -->

        <div>
            <button class="btn btn-success change_password" style="width:100%; outline:none; margin-top:15px;"  data-toggle="modal" data-target="#myModal"> Change Password</button>
        </div>

        <!-- change password form section -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
                 @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                    <script>
                    $(document).ready(function(){

                        $('.change_password').click();
                    });
                    </script>
                @endif
                </div>
                <div class="modal-body">

                    <form action="{{route('teacher_password')}}" method="post">
                    @csrf
                        <div class="col-md-12 form-group">
                            <label for="">Old Password</label>
                            <input type="password" class="form-control" value="{{old('oldPassword')}}" name="oldPassword" placeholder="Enter Your Old Password" autocomplete="off">
                            @error('oldPassword')
                            <div class="alert alert-danger">
                                {{$message}}
                                <script>
                                    $(document).ready(function(){

                                        $('.change_password').click();
                                    });
                                </script>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" value="{{old('newPassword')}}" name="newPassword" placeholder="Enter Your New Password" autocomplete="off">
                            @error('newPassword')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            <script>
                                $(document).ready(function(){

                                    $('.change_password').click();
                                });
                            </script>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" value="{{old('confirmed')}}" name="confirmedPassword" placeholder="Enter Your Confirm Password" autocomplete="off">
                            @error('confirmed')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            <script>
                                $(document).ready(function(){

                                    $('.change_password').click();
                                });
                            </script>
                            @enderror
                        </div>
                        <button class="btn btn-success" style="float:right; margin:0 10px; outline:none;">Submit</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            
            </div>
        </div>
        
        <!-- change password form section end -->
        
    </div>
    <div class="col-md-8">
        <div class="row" style="padding:20px; margin:4px;">
            <div class="col-md-12">
                <h3><strong>Name : </strong> {{$user['name']}}</h3>
            </div>
            <div class="col-md-6">
                <h4><strong>Email : </strong> {{$user['email']}}</h4>
            </div>
            <div class="col-md-6">
                <h4><strong>Age : </strong> {{$age}} Years</h4>
            </div>

            <div class="col-md-6">
                <h4><strong>DOB : </strong> {{date('d-M-Y',strtotime($user['user_detail']['dob']))}}</h4>
            </div>

            <div class="col-md-6">
                <h4><strong>Gender : </strong> {{$user['user_detail']['gen']==0? 'Male' : 'Female'}}</h4>
            </div>

            <div class="col-md-6">
                <h4><strong>Blood Group : </strong> {{$user['user_detail']['blood_group']!==null? $user['user_detail']['blood_group'] : 'Not Mentioned'}}</h4>
            </div>

            <div class="col-md-12">
                <h4><strong>Address : </strong> {{$user['user_detail']['address']}}, {{$user['user_detail']['zipcode']}}</h4>
            </div>
            <div class="col-md-6">
                <h4><strong>Contact Number : </strong> {{$user['phone']}}</h4>
            </div>
            <!-- <div class="col-md-6">
                <h4><strong>Zip Code : </strong> {{$user['user_detail']['zipcode']}}</h4>
            </div> -->
            <div class="col-md-6">
                <h4><strong>Branch : </strong> {{$user['user_detail']['branch']}}</h4>
            </div>
            <div class="col-md-12">
                <h4><strong>Qualification : </strong> {{$user['user_detail']['qualification']}}</h4>
            </div>
            
        </div>
    </div>
</div>