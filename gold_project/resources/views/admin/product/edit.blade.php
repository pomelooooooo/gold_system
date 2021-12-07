@extends('layouts.master')
@section('title','แก้ไขข้อมูลล็อตทอง')
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

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>แก้ไขข้อมูลล็อตทอง</h1>
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
            <h2>แก้ไขข้อมูลล็อตทอง</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ProductController@update', $id)}}" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสล๊อต</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcount">จำนวนสินค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lot_id" type="text" class="form-control" placeholder="" value="{{$product->lot_id}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lot_count" type="text" class="form-control" placeholder="" value="{{$product->lot_count}}" id="validationcount" required />
                            <div class="invalid-feedback">
                                โปรดกรอกจำนวนสินค้า
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h4 for="validationprice">ราคาทองต่อเส้น</h4>
                    </div>
                    <div class="col-3">
                        <h4 for="validationmanufacturer">ผู้ผลิต</h4>
                    </div>
                    <div class="col-6">
                        <h4>วันที่นำเข้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <input name="price_of_gold" type="text" class="form-control" placeholder="" value="{{$product->price_of_gold}}" id="validationprice" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทองต่อเส้น
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <select name="manufacturer" class="form-control"  id="validationmanufacturer" required>
                                <option selected disabled value="">เลือกผู้ผลิต</option>
                                @foreach($manufacturer as $row)
                                <option value="{{$row->id}}" {{$row->id == $product->manufacturer ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกล็อตที่ต้องการ
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_of_import" type="date" class="form-control" value="{{$product->date_of_import}}" />
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/product')}}">กลับ</a>
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