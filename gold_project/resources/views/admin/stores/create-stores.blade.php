@extends('layouts.master')
@section('title','เพิ่มสาขา')
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
                    <h1>ลงทะเบียนสาขา</h1>
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
            <h2>ลงทะเบียนสาขา</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('stores.store')}}" class="needs-validation" novalidate>
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
                            <input name="name" type="text" class="form-control " id="validationstore" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อร้าน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tel" type="text" class="form-control" id="validationtelstore" placeholder="" required />
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
                            <input name="tax_identification_number" type="text" class="form-control" id="validationtax" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกหมายเลขประจำตัวผู้เสียภาษี
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="commercial_registration_number" type="text" class="form-control" id="validationcommercial" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเลขทะเบียนการค้า
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4 for="validationaddress">ที่อยู่</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="address" type="text" class="form-control" id="validationaddress" placeholder="" required></textarea>
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่ร้าน
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/stores')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>

</div>
<br />

@endsection