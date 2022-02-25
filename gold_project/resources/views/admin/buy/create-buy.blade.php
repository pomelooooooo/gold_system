@extends('layouts.master')
@section('title','ซื้อทอง')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script type="text/javascript">
    $(function() {
        $("#validationuser").select2({
            placeholder: "เลือกผู้รับซื้อ",
            // allowClear: true
        });
        $("#validationcustomer").select2({
            placeholder: "เลือกลูกค้า",
            // allowClear: true
        });

        $("body").on('change', '.size', function() {
            var size = $(this)
            let size_arr = {
                "ครึ่งสลึง": "1.9",
                "1 สลึง": "3.8",
                "2 สลึง": "7.6",
                "3 สลึง": "11.4",
                "6 สลึง": "22.8",
                "1 บาท": "15.2",
                "2 บาท": "30.4",
                "3 บาท": "45.5",
                "4 บาท": "60.6",
                "5 บาท": "76",
                "10 บาท": "152"
            }

            var size_val = size.val()
            $.each(size_arr, function(i, el) {
                if (size_val == i) {
                    size.closest('.card.card-item').find('.gram').val(el)
                }
            })
        });
    })
    $(document).ready(function() {
        $('#btn-buy').click(function() {
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

        $('body').on('keyup', '.allprice', function() {
            var total = 0
            $('.allprice').each(function(index, el) {
                if (!isNaN(parseFloat(el.value))) {
                    total += parseFloat(el.value)
                }
            })
            $('#total-price').html(total.toFixed(2))
        })

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

        function readURL(input, img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on('change', '.imgInp', function() {
            readURL(this, $(this).closest('.card').find('.img-upload'));
        });

        $("body").on('click', '#btn-save', function(e) {
            Swal.fire({
                title: 'ต้องการรับซื้อทองหรือไม่?',
                // text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่',
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData($('#form-data')[0]);
                    $.ajax({
                        url: "/buyGroup/update",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var group_id = data.id
                            // var group_id = 1
                            if (data.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตสถานะเรียบร้อย',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    Swal.fire({
                                        title: 'ต้องการพิมพ์ใบรับเงิน/ใบรับสินค้าหรือไม่?',
                                        // text: "You won't be able to revert this!",
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'ใช่',
                                        cancelButtonText: 'ไม่',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.open('/buy/formBuy/' + group_id, '_blank')
                                        }
                                        window.location = '/buy'
                                    })
                                })
                            }
                        }
                    });
                }
            })
        })
    });


    function setItem($item) {
        var $txtFormNumber = $('*[name^="code"]', $item);
        var no = $('.card-item .code').not(':first').not(':first').length
        var code = $('.card-item .code')[0].value
        var num_code = "0"
        var code_string = code.replace('L', '')
        var items = parseInt(code_string) + parseInt(no);
        for (let i = (parseInt(code_string) + 1).toString().length; i < 3; i++) {
            num_code += "0";
        }
        $txtFormNumber.val("L" + num_code + items.toString());
    }

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
                $("#gold_spot").val(response.response.gold_spot)
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
    <form id="form-data" method="POST" action="{{route('buy.store')}} " class="needs-validation" enctype="multipart/form-data">
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
                            <input type="hidden" id="gold_spot" name="gold_buy_gram_medain_price" value="">
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
                        <h4 for="validationuser">ผู้รับซื้อ</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcustomer">ลูกค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้รับซื้อ</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->user_id)&&$row->id == $productdetail->user_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="customer_id" id="validationcustomer">
                                <option selected disabled value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->customer_id)&&$row->id == $productdetail->customer_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>วันเวลาที่รับซื้อ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="datetime-local" class="form-control" name="datetime" value="{{date('Y-m-d').'T'.date('H:i:s')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div id="card">
            <div class="card card-item">
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
                                <input name="code[]" type="text" class="form-control code" placeholder="" value="{{$code}}" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <select class="custom-select" name="type_gold_id[]" required>
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
                                <select class="custom-select size" name="size[]" required>
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
                                <input name="gram[]" type="text" class="form-control gram" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationstriped">ลาย*</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationdetails">รายละเอียด*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <select class="custom-select" name="striped_id[]" id="validationstriped" required>
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
                        <div class="col-6">
                            <div class="form-group">
                                <input name="details[]" type="text" class="form-control" placeholder="" required />
                                <div class="invalid-feedback">
                                    โปรดกรอกรายละเอียดทอง
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationprice">ราคารับซื้อ*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input name="allprice[]" type="text" class="form-control allprice" placeholder="" required />
                                <div class="invalid-feedback">
                                    โปรดกรอกราคารับซื้อ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4>อัพโหลดรูปภาพ*</h4>
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
                                                    เลือกรูปภาพ <input type="file" class="imgInp" name="pic[]">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img class='img-upload' />
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
                        <a type="button" class="btn btn-info text-white" id="btn-buy"><i class="fa fa-plus"></i> เพิ่มการซื้อ</a>
                        <a type="button" class="btn btn-danger text-white" id="btn-remove"><i class="fa fa-trash"></i> ลบ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <h4>ราคารวม</h4>
                    <h3 id="total-price">0</h3>
                </div>
            </div>
        </div>
        <br>
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/buy')}}">กลับ</a>
            <button type="button" id="btn-save" class="btn btn-success">ทำการรับซื้อ</button>
        </div>
    </form>

    <div id="templateCard" style="display: none;">
        <div class="card card-item">
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
                            <input name="code[]" type="text" class="form-control code" placeholder="" value="{{$code}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="type_gold_id[]" required>
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
                            <select class="custom-select size" name="size[]" required>
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
                            <input name="gram[]" type="text" class="form-control gram" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationstriped">ลาย*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdetails">รายละเอียด*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <select class="custom-select" name="striped_id[]" required>
                            <option selected disabled value="">เลือกลาย</option>
                            @foreach($striped as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            โปรดเลือกประเภทที่ต้องการ
                        </div>
                        <!-- <div class="form-group">
                            <input name="striped_id[]" type="text" class="form-control" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกลายที่ต้องการ
                            </div>
                        </div> -->
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="details[]" type="text" class="form-control" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกรายละเอียดทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationprice">ราคารับซื้อ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="allprice[]" type="text" class="form-control allprice" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคารับซื้อ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>อัพโหลดรูปภาพ*</h4>
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