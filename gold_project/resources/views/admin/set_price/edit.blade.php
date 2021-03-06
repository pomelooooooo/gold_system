@extends('layouts.master')
@section('title','ตั้งราคาขาย')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

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

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>ตั้งราคาขาย</h1>
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
            <h2>ตั้งราคาขาย</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('SetPriceController@update', $id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า</h4>
                    </div>
                    <div class="col-6">
                        <h4>รายละเอียดสินค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" placeholder="" value="{{$productdetail->code}}" readonly/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="details" type="text" class="form-control" placeholder="" value="{{$productdetail->details}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ประเภท</h4>
                    </div>
                    <div class="col-6">
                        <h4>ลาย</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="category">
                                <!-- <option selected>เลือกหน่วยนับ</option> -->
                                @foreach(["ทองแท่ง"=>"ทองแท่ง","สร้อยคอ"=>"สร้อยคอ","สร้อยข้อมือ"=>"สร้อยข้อมือ","แหวน"=>"แหวน","กำไล"=>"กำไล","ต่างหู"=>"ต่างหู","จี้"=>"จี้"] as $categoryWay => $categoryLable)
                                <option readonly value="{{ $categoryWay }}" {{ old("category", $productdetail->category) == $categoryWay ? "selected" : "" }}>{{ $categoryLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="striped" type="text" class="form-control" placeholder="" value="{{$productdetail->striped}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>นํ้าหนัก</h4>
                    </div>
                    <div class="col-6">
                        <h4>นํ้าหนัก(กรัม)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="size">
                                <!-- <option selected>เลือกหน่วยนับ</option> -->
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option readonly value="{{ $sizeWay }}" {{ old("size", $productdetail->size) == $sizeWay ? "selected" : "" }}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gram" type="text" class="form-control" placeholder="" value="{{$productdetail->gram}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>สถานะทอง</h4>
                    </div>
                    <div class="col-6">
                        <h4>ล๊อต</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="status">
                                @foreach(["ทองในถาด"=>"ทองในถาด","ทองในสต๊อก"=>"ทองในสต๊อก"] as $statusWay => $statusLable)
                                <option readonly value="{{ $statusWay }}" {{ old("status", $productdetail->status) == $statusWay ? "selected" : "" }}>{{ $statusLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="lot_id" class="form-control" id="userID">
                                <option value="0" label="เลือกล๊อต">เลือกล๊อต</option>
                                @foreach($product as $row)
                                <option readonly value="{{$row->lot_id}}"{{$row->lot_id == $productdetail->lot_id ? 'selected' : ''}}>{{$row->lot_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ถาด</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationgratuity">ค่ากำเหน็จ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tray" type="text" class="form-control" placeholder="" value="{{$productdetail->tray}}" readonly/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gratuity" type="text" class="form-control" placeholder="" value="{{$productdetail->gratuity}}" id="validationgratuity" required />
                            <div class="invalid-feedback">
                                โปรดกรอกค่ากำเหน็จทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationallprice">ราคารวม</h4>
                    </div>
                    <div class="col-6">
                        <h4>อัพโหลดรูปภาพ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="allprice" type="text" class="form-control" placeholder="" value="{{$productdetail->allprice}}" id="validationallprice" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคารวมทอง
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="form-group text-center">
                                <div class="card-header">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file-img">
                                                เลือกรูปภาพ <input type="file" id="imgInp" name="pic">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="single-article-text-image-top">
                                        <p>รูปเดิม</p>
                                    </div>
                                    <img src="{{ asset('assets/img/gold/'. $productdetail->pic) }}" width="250px" height="250px" alt="Image">
                                    <div class="single-article-text-image-bottom">
                                        <p>รูปใหม่</p>
                                        <img id='img-upload' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/set_price')}}">กลับ</a>
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