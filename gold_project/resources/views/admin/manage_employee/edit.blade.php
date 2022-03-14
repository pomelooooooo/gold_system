@extends('layouts.master')
@section('title','แก้ไขข้อมูลพนักงาน')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('keyup', '#idcard', function() {
            $.ajax({
                url: "/manage_employee/validateIdcard/"+$(this).val()+'/'+$('#id').val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.status){
                        $('#validate_id_card').css('display', 'none')
                    } else {
                        $('#validate_id_card').css('display', 'block')
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $(document).on('change', '.btn-file-img :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });
        $(document).on('click', '#reset_password', function(){
            Swal.fire({
            title: 'แก้ไขรหัสผ่าน',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch(`/manage_employee/reset_password`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        password: password,
                        id: $('#id').val()
                    }),
                })
                .then(response => {
                    if (response.status != 200) {
                        throw new Error(response.status)
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขรหัสผ่านเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `กรุณากรอกรหัสผ่าน`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
            })
        });

        $("form#data").submit(function(e) {
            // Swal.fire({
            // icon: 'success',
            // title: 'อัปเดตข้อมูลเรียบร้อย',
            // showConfirmButton: false,
            // timer: 1500
            // })
            e.preventDefault();
            var formData = new FormData(this);
            var data = {
                picture: $('#img-upload').attr('src'),
            };
            formData.append("data", JSON.stringify(data));
            $.ajax({
                url: "{{action('ManageEmployeeController@update', $id)}}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if(data.status){
                        // window.location = "{{route('manage_employee.index')}}"
                        Swal.fire({
                        icon: 'success',
                        title: 'อัปเดตข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    } else {
                        $('#validate_id_card').css('display', 'block')
                        $("#validate_id_card").focus();
                    }
                    // window.location = "{{route('manage_employee.index')}}"
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('.btn-file-img :file').on('fileselect', function(event, label) {

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

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>แก้ไขข้อมูลพนักงาน</h1>
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
            <h2>แก้ไขข้อมูลพนักงาน</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ManageEmployeeController@update', $id)}}" id="data" enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <input type="hidden" value="{{$manageemployee->id}}" id="id" />
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationusername">ชื่อผู้ใช้</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationemail">อีเมล</h4>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="" value="{{$manageemployee->username}}" id="validationusername" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อผู้ใช้
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input name="email" type="text" class="form-control" placeholder="" value="{{$manageemployee->email}}" id="validationemail" required />
                            <div class="invalid-feedback">
                                โปรดกรอกอีเมล
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" type="button" id="reset_password"><i class="fa fa-edit"></i> แก้ไขรหัสผ่าน</button>
                        <!-- <div class="form-group">
                            <input name="password" type="text" class="form-control" placeholder="" value="{{$manageemployee->password}}" id="validationpassword" required  />
                            <div class="invalid-feedback">
                                โปรดกรอกพาสเวิส
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationname">ชื่อ</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationlastname">นามสกุล</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" value="{{$manageemployee->name}}" id="validationname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lastname" type="text" class="form-control" placeholder="" value="{{$manageemployee->lastname}}" id="validationlastname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกนามสกุล
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="idcard">เลขบัตรประชาชน</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtel">เบอร์โทร</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="idcard" type="text" class="form-control" placeholder="" value="{{$manageemployee->idcard}}" id="idcard" required />
                            <div class="invalid-feedback" style="display: none;" id="validate_id_card">
                               เลขบัตรประชาชนซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกเลขบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="telephone" type="text" class="form-control" placeholder="" value="{{$manageemployee->telephone}}" id="validationtel" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทร
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationaddress">ที่อยู่ตามบัตรประชาชน</h4>
                    </div>
                    <div class="col-6">
                        <h4>ที่อยู่ปัจจุบัน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address" type="text" class="form-control" placeholder="" value="{{$manageemployee->address}}" id="validationaddress" required />
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่ตามบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address_now" type="text" class="form-control" placeholder="" value="{{$manageemployee->address_now}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationdatecardstart">วันออกบัตร*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdatecardend">วันบัตรหมดอายุ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_start" id="date_card_start" type="text" class="form-control" placeholder="" value="{{$manageemployee->date_card_start}}" id="validationdatecardstart" required />
                            <div class="invalid-feedback">
                                โปรดกรอกวันออกบัตร
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_end" id="date_card_end" type="text" class="form-control" placeholder="" value="{{$manageemployee->date_card_end}}" id="validationdatecardend" required />
                            <div class="invalid-feedback">
                                โปรดกรอกวันบัตรหมดอายุ
                            </div>
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
                                    <div class="single-article-text-image-top">
                                        <p>รูปเดิม</p>
                                    </div>
                                    <img src="{{ asset('assets/img/employee/'. $manageemployee->picture) }}" width="250px" height="250px" alt="Image">
                                    <div class="single-article-text-image-bottom">
                                        <p>รูปใหม่</p>
                                        <img id='img-upload' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <br />
                <div class="text-right">
                @if(\Auth::user()->row_id == '0')
                    <a type="button" class="btn btn-secondary" href="{{url('/manage_employee')}}">กลับ</a>
                @endif
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
                <br />
            </form>
        </div>
    </div>
</div>
<br />

@endsection