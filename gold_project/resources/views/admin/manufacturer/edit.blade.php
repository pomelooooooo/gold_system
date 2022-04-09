@extends('layouts.master')
@section('title','แก้ไขข้อมูลผู้ผลิต')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('keyup', '#validationid', function() {
            $.ajax({
                url: "/manufacturer/validateCode/" + $(this).val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status) {
                        $('#validate_code').css('display', 'none')
                    } else {
                        $('#validate_code').css('display', 'block')
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $(document).on('keyup', '#validationtype', function() {
            $.ajax({
                url: "/manufacturer/validateName/" + $(this).val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status) {
                        $('#validate_name').css('display', 'none')
                    } else {
                        $('#validate_name').css('display', 'block')
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('manufacturer.store')}}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        window.location = "{{route('manufacturer.index')}}"
                    } else {
                        $('#validate_code').css('display', 'block')
                        $("#validate_code").focus();
                        $('#validate_name').css('display', 'block')
                        $("#validate_name").focus();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
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
                    <h1>แก้ไขข้อมูลผู้ผลิต</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="form-inline">
                <h2>แก้ไขข้อมูลผู้ผลิต</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ManufacturerController@update', $id)}}" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationid">รหัสผู้ผลิต <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtype">ชื่อผู้ผลิต <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" id="validationid" placeholder="" value="{{$manufacturer->code}}" required />
                            <div class="invalid-feedback" style="display: none;" id="validate_code">
                                รหัสผู้ผลิตซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกรหัสผู้ผลิต
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" id="validationtype" placeholder="" value="{{$manufacturer->name}}" required />
                            <div class="invalid-feedback" style="display: none;" id="validate_name">
                            ชื่อผู้ผลิตซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อผู้ผลิต
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationttel">เบอร์โทร <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationttax">หมายเลขประจำตัวผู้เสียภาษี <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tel" type="tel" class="form-control" id="validationttel" placeholder="" value="{{$manufacturer->tel}}" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทร
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tax" type="text" class="form-control" pattern="\d{13}" id="validationttax" placeholder="" value="{{$manufacturer->tax}}" required />
                            <div class="invalid-feedback">
                                โปรดกรอกหมายเลขประจำตัวผู้เสียภาษี(13หลัก)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationaddress">ที่อยู่ <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <textarea name="address" type="text" class="form-control" id="validationaddress" placeholder="" value="{{$manufacturer->address}}" required>{{$manufacturer->address}}</textarea>
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/manufacturer')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">อัพเดท</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
                <br />
            </form>
        </div>
    </div>
</div>
<br>

@endsection