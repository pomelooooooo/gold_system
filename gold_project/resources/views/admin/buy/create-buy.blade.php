@extends('layouts.master')
@section('title','ซื้อทอง')
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
    $(function() {
        $.ajax({
            url: "http://127.0.0.1:3000/latest",
            type: 'GET',
            success: function(response) {
                console.log(response.response)
                $("#gold_bar_sell").val(response.response.price.gold_bar.sell)
                $("#gold_sell").val(response.response.price.gold.sell)
            },
            error: function(xhr) {
                "Not have Data!!"
            }
        })

    });
</script>

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>ซื้อทอง</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br />
<div class="container">
    <form method="POST" action="{{route('buy.store')}} " enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="card">
            <div class="card-header">
                <h2>ซื้อทองเข้าร้าน</h2>
            </div>
            <div class="card-body">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>ราคากลางทองแท่งประจำวัน*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ราคากลางทองรูปพรรณประจำวัน*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="gold_bar_sell" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="gold_sell" placeholder="" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationuser">ผู้รับซื้อ*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcustomer">ลูกค้า*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้รับซื้อ</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}"{{!empty($productdetail->user_id)&&$row->id == $productdetail->user_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="customer_id" id="validationcustomer" required>
                                <option selected disabled value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}"{{!empty($productdetail->customer_id)&&$row->id == $productdetail->customer_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4>รหัสสินค้า</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationcategory">ประเภท*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input name="code" type="text" class="form-control" placeholder="" value="{{$code}}" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <select class="custom-select" name="type_gold_id" id="validationcategory" required>
                                    <option selected disabled value="">เลือกหน่วยนับ</option>
                                    @foreach($producttype as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    โปรดเลือกหน่วยนับที่ต้องการ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationtelstore">นํ้าหนัก*</h4>
                        </div>
                        <div class="col-6">
                            <h4>นํ้าหนัก(กรัม)*</h4>
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
                            <h4 for="validationstriped">ลาย*</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationdetails">รายละเอียด</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input name="striped" type="text" class="form-control" placeholder="" id="validationstriped" required />
                                <div class="invalid-feedback">
                                    โปรดกรอกลายที่ต้องการ
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
                            <h4 for="validationprice">ราคารับซื้อ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                            <div class="form-group">
                                <input name="allprice" type="text" class="form-control" placeholder="" id="validationprice" required />
                                <div class="invalid-feedback">
                                    โปรดกรอกราคารับซื้อ
                                </div>
                            </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-6">
                            <h4>อัพโหลดรูปภาพ</h4>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
            </div>
        </div>
        <br>
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/buy')}}">กลับ</a>
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
    </form>
</div>
<br />
@endsection