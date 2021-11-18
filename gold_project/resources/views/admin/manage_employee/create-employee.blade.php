@extends('layouts.master')
@section('title','เพิ่มข้อมูลพนักงาน')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    });
</script>


<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>เพิ่มข้อมูลพนักงาน</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br />
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>เพิ่มข้อมูลพนักงาน</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('manage_employee.store')}} " enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>ชื่อ</h4>
                    </div>
                    <div class="col-6">
                        <h4>นามสกุล</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lastname" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>เลขบัตรประชาชน</h4>
                    </div>
                    <div class="col-6">
                        <h4>เบอร์โทร</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="idcard" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="telephone" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ชื่อผู้ใช้</h4>
                    </div>
                    <div class="col-3">
                        <h4>อีเมล</h4>
                    </div>
                    <div class="col-3">
                        <h4>พาสเวิส</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="email" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="password" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ที่อยู่ตามบัตรประชาชน</h4>
                    </div>
                    <div class="col-6">
                        <h4>ที่อยู่ปัจจุบัน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address_now" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>อัพโหลดภาพบัตรประชาชน</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="form-group text-center">
                                <div class="card-header">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file-img">
                                                เลือกรูปภาพ <input type="file" id="imgInp" name="picture">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img id='img-upload' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/manage_employee')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />
@endsection