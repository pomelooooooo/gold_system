@extends('layouts.master')
@section('title','ขายทอง')
@section('content')

<script>
    $(function () {
    $('.datetimepicker').datetimepicker();
});
</script>

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>ขายทอง</h1>
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
            <h2>ขายทอง</h2>
        </div>
        <div class="card-body">
            <!-- <form method="POST" action="{{route('productdetail.store')}} " enctype="multipart/form-data" class="needs-validation" novalidate> -->
                <!-- {{csrf_field()}} -->
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ราคากลางทองประจำวัน*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder="" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>วันเวลาที่ขาย*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ประเภท</h4>
                    </div>
                    <div class="col-3">
                        <h4>น้ำหนัก</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control datetimepicker" name=""> 
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h4>ผู้ขาย*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ค่าแรงทองต่อเส้น</h4>
                    </div>
                    <div class="col-3">
                        <h4>ราคาทุน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control datetimepicker" name=""> 
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาขาย*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control datetimepicker" name=""> 
                        </div>
                    </div>
                </div>
                
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/sell')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            <!-- </form> -->
        </div>
    </div>
</div>
<br />

@endsection
