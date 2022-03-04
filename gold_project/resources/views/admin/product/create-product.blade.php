@extends('layouts.master')
@section('title','เพิ่มล็อตทอง')
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
                    <h1>เพิ่มล็อตทอง</h1>
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
            <h2>เพิ่มล็อตทอง</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('product.store')}} " class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-4">
                        <h4>รหัสล็อต</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationtype">ประเภท</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationweight">น้ำหนัก</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="lot_id" type="text" class="form-control" placeholder="" disabled />
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- <div class="form-group">
                            <input name="type_gold_id" type="text" class="form-control" placeholder="" />
                        </div> -->
                        <div class="form-group">
                            <select name="type_gold_id" class="form-control" id="validationtype" required>
                                <option selected disabled value="">เลือกประเภท</option>
                                @foreach($type as $row)
                                <option value="{{$row->id}}">{{$row->category." - ".$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกประเภททอง
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select name="weight" class="form-control" id="validationweight" required>
                                <option selected disabled value="">เลือกน้ำหนักทอง</option>
                                <option value="001">ครึ่งสลึง</option>
                                <option value="01">1 สลึง</option>
                                <option value="02">2 สลึง</option>
                                <option value="03">3 สลึง</option>
                                <option value="06">6 สลึง</option>
                                <option value="1">1 บาท</option>
                                <option value="2">2 บาท</option>
                                <option value="3">3 บาท</option>
                                <option value="4">4 บาท</option>
                                <option value="5">5 บาท</option>
                                <option value="10">10 บาท</option>
                            </select>
                            <!-- <input name="weight" type="text" class="form-control" placeholder="" id="validationweight" required /> -->
                            <div class="invalid-feedback">
                                โปรดกรอกน้ำหนักทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4 for="validationcount">จำนวนสินค้า</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationprice">ราคาทองต่อเส้น</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationmanufacturer">ผู้ผลิต</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="lot_count" type="text" class="form-control" placeholder="" id="validationcount" required />
                            <div class="invalid-feedback">
                                โปรดกรอกจำนวนสินค้า
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input name="price_of_gold" type="number" class="form-control" placeholder="" id="validationprice" required >
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทองต่อเส้น
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select name="manufacturer" class="form-control" id="validationmanufacturer" required>
                                <option selected disabled value="">เลือกผู้ผลิต</option>
                                @foreach($manufacturer as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกผู้ผลิต
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>วันที่นำเข้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="date_of_import" type="date" class="form-control" value="{{date('Y-m-d')}}" />
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/product')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />
@endsection