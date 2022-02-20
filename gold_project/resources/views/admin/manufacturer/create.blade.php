@extends('layouts.master')
@section('title','เพิ่มผู้ผลิตทอง')
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
                        <h1>เพิ่มผู้ผลิตทอง</h1>
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
            <h2>เพิ่มผู้ผลิต</h2>
        </div>
        <div class="card-body">
            <form method="POST" class="needs-validation" action="{{route('manufacturer.store')}}" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationid">รหัสผู้ผลิต</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtype">ชื่อผู้ผลิต</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" id="validationid" placeholder="" required/>
                            <div class="invalid-feedback">
                                โปรดกรอกรหัสผู้ผลิต
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" id="validationtype" placeholder=""  required/>
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อผู้ผลิต
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationttel">เบอร์โทร</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationttax">หมายเลขประจำตัวผู้เสียภาษี</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tel" type="text" class="form-control" id="validationttel" placeholder=""  required/>
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทร
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tax" type="text" class="form-control" id="validationttax" placeholder=""  required/>
                            <div class="invalid-feedback">
                                โปรดกรอกหมายเลขประจำตัวผู้เสียภาษี
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationaddress">ที่อยู่</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <textarea name="address" type="text" class="form-control" id="validationaddress" placeholder="" required></textarea>
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/manufacturer')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>

</div>
<br />

@endsection