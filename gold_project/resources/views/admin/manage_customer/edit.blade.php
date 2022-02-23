@extends('layouts.master')
@section('title','แก้ไขข้อมูลลูกค้า')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file-img :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
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
                    <h1>แก้ไขข้อมูลลูกค้า</h1>
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
            <h2>แก้ไขข้อมูลลูกค้า</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ManageCustomerController@update', $id)}} " enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationname">ชื่อ*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationlastname">นามสกุล*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" value="{{$managecustomer->name}}" id="validationname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lastname" type="text" class="form-control" placeholder="" value="{{$managecustomer->lastname}}" id="validationlastname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกนามสกุล
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationid">เลขบัตรประชาชน/เลขประจำตัวผู้เสียภาษี*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtel">เบอร์โทร*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="idcard" type="text" class="form-control" placeholder="" value="{{$managecustomer->idcard}}" id="validationid" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเลขบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tel" type="text" class="form-control" placeholder="" value="{{$managecustomer->tel}}" id="validationtel" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทร
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationaddress">ที่อยู่ตามบัตรประชาชน*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ที่อยู่ปัจจุบัน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address" type="text" class="form-control" placeholder="" value="{{$managecustomer->address}}" id="validationaddress" required />
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่ตามบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address_now" type="text" class="form-control" placeholder="" value="{{$managecustomer->address_now}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationdatecardstart">วันออกบัตร</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdatecardend">วันบัตรหมดอายุ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_start" id="date_card_start" type="text" class="form-control" placeholder="" value="{{$managecustomer->date_card_start}}" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_end" id="date_card_end" type="text" class="form-control" placeholder="" value="{{$managecustomer->date_card_end}}"  />
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
                                    <img src="{{ asset('assets/img/customer/'. $managecustomer->picture) }}" width="250px" height="250px" alt="Image">
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
                    <a type="button" class="btn btn-secondary" href="{{url('/manage_customer')}}">กลับ</a>
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