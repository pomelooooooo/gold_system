@extends('layouts.master')
@section('title','แก้ไขข้อมูลสาขา')
@section('content')
<script>
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
                    <h1>แก้ไขข้อมูลสาขา</h1>
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
                <h2>แก้ไขข้อมูลสาขา</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('StoresController@update', $id)}}" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationstore">ชื่อร้าน</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtelstore">เบอร์โทรร้าน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" value="{{$stores->name}}" id="validationstore" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อร้าน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tel" type="text" class="form-control" placeholder="" value="{{$stores->tel}}" id="validationtelstore" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทรร้าน
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationtax">หมายเลขประจำตัวผู้เสียภาษี</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcommercial">เลขทะเบียนการค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tax_identification_number" type="text" class="form-control" placeholder="" value="{{$stores->tax_identification_number}}" id="validationtax" required />
                            <div class="invalid-feedback">
                                โปรดกรอกหมายเลขประจำตัวผู้เสียภาษี
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="commercial_registration_number" type="text" class="form-control" placeholder="" value="{{$stores->commercial_registration_number}}" id="validationcommercial" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเลขทะเบียนการค้า
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5 for="validationaddress">ที่อยู่</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="address" type="text" class="form-control" placeholder="" id="validationaddress" required>{{$stores->address}}</textarea>
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่ร้าน
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/stores')}}">กลับ</a>
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