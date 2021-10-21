@extends('layouts.master')
@section('title','เพิ่มสาขา')
@section('content')

<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>ลงทะเบียนสาขา</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br /><br />
<h2 class="text-center">ลงทะเบียนสาขา</h2>
<div class="container">
    <hr class="mt-5 mb-6" />
    <form method="POST" action="{{route('stores.store')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6">
                <h4>ชื่อร้าน</h4>
            </div>
            <div class="col-6">
                <h4>เบอร์โทร</h4>
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
                    <input name="tel" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>หมายเลขประจำตัวผู้เสียภาษี</h4>
            </div>
            <div class="col-6">
                <h4>เลขทะเบียนการค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="tax_identification_number" type="text" class="form-control" placeholder="" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="commercial_registration_number" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5>ที่อยู่</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input name="address" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <br /><br />
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/stores')}}">กลับ</a>
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
        <!-- <input type="hidden" name="_method" value="PATCH"/> -->
    </form>
</div>

@endsection