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

        function readURL(input, row) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    row.find('.img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on('change', '.imgInp', function() {
            let row = $(this).closest('.card-body')
            readURL(this, row);
        });

        function setItem($item) {
            var $txtFormNumber = $('*[name^="code"]', $item);
            var no = $('.card-item .code').not(':first').not(':first').length
            var code = $('.card-item .code')[0].value
            var num_code = "0"
            var code_string = code.replace('N', '')
            var items = parseInt(code_string) + parseInt(no);
            for (let i = (parseInt(code_string) + 1).toString().length; i < 3; i++) {
                num_code += "0";
            }
            $txtFormNumber.val("N" + num_code + items.toString());


            $('.radio_status').not(':last').each(function(index, el) {
                $(this).find('.validationstatus').attr('name', 'status[' + index + ']')
            })
        }

        $("body").on('change', '.validationtellotid', function() {
            var row = $(this).closest('.card-body')
            $.ajax({
                url: "/productdetail/price_of_gold/" + row.find('.validationtellotid').val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    row.find('.priceofgold').val(data.product.price_of_gold)
                    row.find('.validationcategory').val(data.product.id)
                    row.find('.type_gold_id_hide').val(data.product.id)
                    // $(".priceofgold").val(data.product.price_of_gold)
                    // $("#validationcategory").val(data.product.id)
                    let size_arr = {
                        "ครึ่งสลึง": "001:1.9",
                        "1 สลึง": "01:3.8",
                        "2 สลึง": "02:7.6",
                        "3 สลึง": "03:11.4",
                        "6 สลึง": "06:22.8",
                        "1 บาท": "1:15.2",
                        "2 บาท": "2:30.4",
                        "3 บาท": "3:45.5",
                        "4 บาท": "4:60.6",
                        "5 บาท": "5:76",
                        "10 บาท": "10:152"
                    }

                    $.each(size_arr, function(i, el) {
                        let weight = el.split(':')
                        if (data.product.weight == weight[0]) {
                            row.find('.size option[value="' + i + '"]').prop("selected", true)
                            row.find('.gram').val(weight[1])

                            row.find('.size_hide').val(i)
                            // $('#size option[value="' + i + '"]').prop("selected", true)
                            // $('#gram').val(weight[1])
                        }
                    })

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("body").on('keyup', '.validationgratuity', function() {
            let row = $(this).closest('.card-body')
            row.find('.validationallprice').val((row.find('.priceofgold').val() * 1) + (row.find('.validationgratuity').val() * 1))
        });

        $('#btn-add').click(function() {
            var $item = $('#templateCard .card-item').clone();
            $item.appendTo('#card');
            setItem($item)
        })

        $('#btn-remove').click(function() {
            var item_card = $('.card-item').not(':first').not(':last').last();
            if (item_card.length > 0) {
                item_card.remove()
            }
        })
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
    <form method="POST" action="{{route('productdetail.store')}} " enctype="multipart/form-data" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="card">
            <div class="card-header">
                <h2>เพิ่มทองเข้าร้าน</h2>
            </div>
            <div id="card">
                <div class="card card-item">
                    <div class="card-body card-item">
                        <div class="row">
                            <div class="col-6">
                                <h4>รหัสสินค้า <span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="validationtellotid">ล็อต <span style="color: red;"> *</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input name="code[]" type="text" class="form-control code" placeholder="" value="{{$code}}" readonly />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <select name="lot_id[]" class="custom-select validationtellotid" required>
                                        <option selected disabled value="">เลือกล็อต</option>
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
                                <h4 for="validationcategory">ประเภท <span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="validationstriped">ลาย <span style="color: red;"> *</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="type_gold_id_hide" name="type_gold_id[]">
                                    <select class="custom-select validationcategory" required disabled>
                                        <option selected disabled value="">เลือกประเภท</option>
                                        @foreach($producttype as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        โปรดเลือกประเภทที่ต้องการ
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select validationstriped" name="striped_id[]" required>
                                        <option selected disabled value="">เลือกลาย</option>
                                        @foreach($striped as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        โปรดเลือกประเภทที่ต้องการ
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4 for="size">นํ้าหนัก <span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="gram">นํ้าหนัก(กรัม) <span style="color: red;"> *</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="size[]" class="size_hide">
                                    <select class="custom-select size" required disabled>
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
                                <div class="input-group">
                                    <input type="text" class="form-control gram" name="gram[]" placeholder="" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">กรัม</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        โปรดกรอกน้ำหนักกรัม
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4>ราคาทองต่อเส้น <span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="validationgratuity">ค่าแรงทองต่อเส้น <span style="color: red;"> *</span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="text" class="form-control priceofgold" placeholder="" readonly />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input name="gratuity[]" type="number" class="form-control validationgratuity" placeholder="" min="0" max="3000" required style="width: 100% !important;" />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">บาท</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        โปรดกรอกค่าแรงในช่วง 0-3000
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4 for="validationallprice">ราคาทุน<span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="validationdetails">รายละเอียด</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <input name="allprice[]" type="text" class="form-control validationallprice" placeholder="" required readonly />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">บาท</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        โปรดกรอกราคาทุน
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input name="details[]" type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4 for="validationstatus">สถานะทอง<span style="color: red;"> *</span></h4>
                            </div>
                            <div class="col-6">
                                <h4 for="validationtray">ถาด</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="pl-2">
                                    <div class="form-group radio_status">
                                        @foreach(["0"=>"ทองในถาด","1"=>"ทองในสต๊อค"] as $statusWay => $statusLable)
                                        <input type="radio" class="form-check-input validationstatus" name="status[]" type="checkbox" value="{{ $statusWay }}" required>
                                        <h6 class="form-check-label">{{ $statusLable }}</h6>
                                        <div class="invalid-feedback">โปรดเลือกสถานะทองที่ต้องการ</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input name="tray[]" type="text" class="form-control validationtray" placeholder="" />
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
                                                    เลือกรูปภาพ <input type="file" class="imgInp" name="pic[]">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img class="img-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <div class='form-group'>
                        <a type="button" class="btn btn-info text-white" id="btn-add"><i class="fa fa-plus"></i> เพิ่มการซื้อ</a>
                        <a type="button" class="btn btn-danger text-white" id="btn-remove"><i class="fa fa-trash"></i> ลบ</a>
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
    <div id="templateCard" style="display: none;">
        <div class="card card-item">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtellotid">ล็อต <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code[]" type="text" class="form-control code" placeholder="" value="" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="lot_id[]" class="custom-select validationtellotid" required>
                                <option selected disabled value="">เลือกล็อต</option>
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
                        <h4 for="validationcategory">ประเภท <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationstriped">ลาย <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="hidden" class="type_gold_id_hide" name="type_gold_id[]">
                            <select class="custom-select validationcategory" required disabled>
                                <option selected disabled value="">เลือกประเภท</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกประเภทที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select validationstriped" name="striped_id[]" required>
                                <option selected disabled value="">เลือกลาย</option>
                                @foreach($striped as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกประเภทที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="size">นํ้าหนัก <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="gram">นํ้าหนัก(กรัม) <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="hidden" name="size[]" class="size_hide">
                            <select class="custom-select size" required disabled>
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
                        <div class="input-group">
                            <input type="text" class="form-control gram" name="gram[]" placeholder="" required />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">กรัม</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกน้ำหนักกรัม
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาทองต่อเส้น <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationgratuity">ค่าแรงทองต่อเส้น <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <input type="text" class="form-control priceofgold" placeholder="" readonly />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <input name="gratuity[]" type="number" class="form-control validationgratuity" placeholder="" min="0" max="3000" required style="width: 100% !important;" />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกค่าแรงในช่วง 0-3000
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationallprice">ราคาทุน<span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdetails">รายละเอียด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <input name="allprice[]" type="text" class="form-control validationallprice" placeholder="" required readonly />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทุน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="details[]" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationstatus">สถานะทอง<span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtray">ถาด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="pl-2">
                            <div class="form-group radio_status">
                                @foreach(["0"=>"ทองในถาด","1"=>"ทองในสต๊อค"] as $statusWay => $statusLable)
                                <input type="radio" class="form-check-input validationstatus" name="status" type="checkbox" value="{{ $statusWay }}" required>
                                <h6 class="form-check-label">{{ $statusLable }}</h6>
                                <div class="invalid-feedback">โปรดเลือกสถานะทองที่ต้องการ</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tray[]" type="text" class="form-control validationtray" placeholder="" />
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
                                            เลือกรูปภาพ <input type="file" class="imgInp" name="pic[]">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="img-upload" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br />
@endsection