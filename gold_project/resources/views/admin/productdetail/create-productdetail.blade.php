@extends('layouts.master')
@section('title','เพิ่มทองเข้าร้าน')
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
                    <h1>เพิ่มทองเข้าร้าน</h1>
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
            <h2>เพิ่มทองเข้าร้าน</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('productdetail.store')}} " enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtellotid">ล๊อต*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" placeholder="" value="{{$code}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="lot_id" class="form-control" id="validationtellotid" required>
                                <option selected disabled value="">เลือกล๊อต</option>
                                @foreach($product as $row)
                                <option value="{{$row->lot_id}}">{{$row->lot_id}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกล็อตที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationcategory">ประเภท*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationstriped">ลาย</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="category" id="validationcategory" required>
                                <option selected disabled value="">เลือกหน่วยนับ</option>
                                @foreach(["ทองแท่ง"=>"ทองแท่ง","สร้อยคอ"=>"สร้อยคอ","สร้อยข้อมือ"=>"สร้อยข้อมือ","แหวน"=>"แหวน","กำไล"=>"กำไล","ต่างหู"=>"ต่างหู","จี้"=>"จี้"] as $categoryWay => $categoryLable)
                                <option value="{{ $categoryWay }}">{{ $categoryLable }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="striped" type="text" class="form-control" placeholder="" id="validationstriped" required />
                            <div class="invalid-feedback">
                                โปรดกรอกลายที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationtelcategory">นํ้าหนัก*</h4>
                    </div>
                    <div class="col-6">
                        <h4>นํ้าหนัก(กรัม)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="size" id="validationcategory" required>
                                <option selected disabled value="">เลือกหน่วยนับ</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}">{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกนํ้าหนักที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gram" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationtray">ถาด*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdetails">รายละเอียด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">

                        <div class="form-group">
                            <input name="tray" type="text" class="form-control" placeholder="" id="validationtray" required />
                            <div class="invalid-feedback">
                                โปรดกรอกถาดที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="details" type="text" class="form-control" placeholder="" id="validationdetails" required />
                            <div class="invalid-feedback">
                                โปรดกรอกรายละเอียดทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาทองต่อเส้น*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationgratuity">ค่าแรงทองต่อเส้น*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gratuity" type="text" class="form-control" placeholder="" id="validationgratuity" required />
                            <div class="invalid-feedback">
                                โปรดกรอกค่าแรง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationallprice">ราคาทุน*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationstatus">สถานะทอง*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="allprice" type="text" class="form-control" placeholder="" id="validationallprice" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทุน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="pl-2">
                            <div class="form-group">
                                @foreach(["0"=>"ทองในถาด","1"=>"ทองในสต๊อค"] as $statusWay => $statusLable)
                                <input type="radio" class="form-check-input" name="status" type="checkbox" value="{{ $statusWay }}" id="validationstatus" required>
                                <h6 class="form-check-label">{{ $statusLable }}</h6>
                                <div class="invalid-feedback">โปรดเลือกสถานะทองที่ต้องการ</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>อัพโหลดรูปภาพ</h4>
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
                                <img id='img-upload' />
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/productdetail')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />
@endsection