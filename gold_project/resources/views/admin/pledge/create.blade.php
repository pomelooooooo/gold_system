@extends('layouts.master')
@section('title','จำนำทอง')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#validationuser").select2({
            placeholder: "เลือกผู้รับซื้อ",
            allowClear: true
        });
        $("#validationcustomer").select2({
            placeholder: "เลือกลูกค้า",
            allowClear: true
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
        $("body").on('click', '#btn-save', function(e) {
            if ($('#validationuser').val() != null && $('#validationcustomer').val() != null  
            && $('#validateper').val() != '' 
            && $('#validationcategory').val() != null 
            && $('#validationweight').val() != null
            && $('#validationgram').val() != ''
            && $('#validationstriped').val() != null
            && $('#validationdetails').val() != ''
            && $('#validationprice').val() != '') {
                Swal.fire({
                    title: 'ต้องการรับซื้อขายฝากทองหรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('pledge.store')}}",
                            type: 'POST',
                            data: $('#post-save').serialize(),
                            dataType: 'json',
                            success: function(data) {
                                if(data.status){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'รับซื้อขายฝากทองเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        Swal.fire({
                                            title: 'ต้องการพิมพ์ใบรับซื้อขายฝากทองหรือไม่?',
                                            // text: "You won't be able to revert this!",
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'ใช่',
                                            cancelButtonText: 'ไม่',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.open('/pledge/formpledge/' + data.id, '_blank')
                                            }
                                            window.location = '/pledge'
                                        })
                                    })
                                }
                            }
                        });
                    }
                    // window.open('/pledge/formpledge/' + group_id, '_blank')

                })
            }else{
                $('.validateUser').find('.select2-selection--single').removeClass('is-invalid')
                $('.validateUser').find('.invalid-feedback').css('display', 'none')

                $('.validateCustomer').find('.select2-selection--single').removeClass('is-invalid')
                $('.validateCustomer').find('.invalid-feedback').css('display', 'none')

                $('.validateDatenext').find('.date-next').removeClass('is-invalid')
                $('.validateDatenext').find('.invalid-feedback').css('display', 'none')

                $('.validatePer').find('.input-per').removeClass('is-invalid')
                $('.validatePer').find('.invalid-feedback').css('display', 'none')

                $('.validationCategory').find('.custom-select--single').removeClass('is-invalid')
                $('.validationCategory').find('.invalid-feedback').css('display', 'none')

                $('.validationCategory2').find('.custom-select--single2').removeClass('is-invalid')
                $('.validationCategory2').find('.invalid-feedback').css('display', 'none')

                $('.validationWeight').find('.custom-select--size').removeClass('is-invalid')
                $('.validationWeight').find('.invalid-feedback').css('display', 'none')

                $('.validationWeight2').find('.custom-select--size2').removeClass('is-invalid')
                $('.validationWeight2').find('.invalid-feedback').css('display', 'none')

                $('.validationGram').find('.input-gram').removeClass('is-invalid')
                $('.validationGram').find('.invalid-feedback').css('display', 'none')

                $('.validationGram2').find('.input-gram2').removeClass('is-invalid')
                $('.validationGram2').find('.invalid-feedback').css('display', 'none')

                $('.validationStriped').find('.custom-select--striped').removeClass('is-invalid')
                $('.validationStriped').find('.invalid-feedback').css('display', 'none')

                $('.validationStriped2').find('.custom-select--striped2').removeClass('is-invalid')
                $('.validationStriped2').find('.invalid-feedback').css('display', 'none')

                $('.validationDetails').find('.form-control--detail').removeClass('is-invalid')
                $('.validationDetails').find('.invalid-feedback').css('display', 'none')

                $('.validationDetails2').find('.form-control--detail2').removeClass('is-invalid')
                $('.validationDetails2').find('.invalid-feedback').css('display', 'none')

                $('.validationPrice').find('.form-control--price').removeClass('is-invalid')
                $('.validationPrice').find('.invalid-feedback').css('display', 'none')

                $('.validationPrice2').find('.form-control--price2').removeClass('is-invalid')
                $('.validationPrice2').find('.invalid-feedback').css('display', 'none')

                if ($('#validationuser').val() == null) {
                    $('.validateUser').find('.select2-selection--single').addClass('is-invalid')
                    $('.validateUser').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationcustomer').val() == null) {
                    $('.validateCustomer').find('.select2-selection--single').addClass('is-invalid')
                    $('.validateCustomer').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validatedatenext').val() == null) {
                    $('.validateDatenext').find('.date-next').addClass('is-invalid')
                    $('.validateDatenext').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validateper').val() == '') {
                    $('.validatePer').find('.input-per').addClass('is-invalid')
                    $('.validatePer').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationcategory').val() == null) {
                    $('.validationCategory').find('.custom-select--single').addClass('is-invalid')
                    $('.validationCategory').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationcategory2').val() == null) {
                    $('.validationCategory2').find('.custom-select--single2').addClass('is-invalid')
                    $('.validationCategory2').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationweight').val() == null) {
                    $('.validationWeight').find('.custom-select--size').addClass('is-invalid')
                    $('.validationWeight').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationweight2').val() == null) {
                    $('.validationWeight2').find('.custom-select--size2').addClass('is-invalid')
                    $('.validationWeight2').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationgram').val() == '') {
                    $('.validationGram').find('.input-gram').addClass('is-invalid')
                    $('.validationGram').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationgram2').val() == '') {
                    $('.validationGram2').find('.input-gram2').addClass('is-invalid')
                    $('.validationGram2').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationstriped').val() == null) {
                    $('.validationStriped').find('.custom-select--striped').addClass('is-invalid')
                    $('.validationStriped').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationstriped2').val() == null) {
                    $('.validationStriped2').find('.custom-select--striped2').addClass('is-invalid')
                    $('.validationStriped2').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationdetails').val() == '') {
                    $('.validationDetails').find('.form-control--detail').addClass('is-invalid')
                    $('.validationDetails').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationdetails2').val() == '') {
                    $('.validationDetails2').find('.form-control--detail2').addClass('is-invalid')
                    $('.validationDetails2').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationprice').val() == '') {
                    $('.validationPrice').find('.form-control--price').addClass('is-invalid')
                    $('.validationPrice').find('.invalid-feedback').css('display', 'block')
                }
                if ($('#validationprice2').val() == '') {
                    $('.validationPrice2').find('.form-control--price2').addClass('is-invalid')
                    $('.validationPrice2').find('.invalid-feedback').css('display', 'block')
                }
            }
        })
        $("#validationcustomer").change(function() {
            $.ajax({
                url: "/pledge/gettel/" + $("#validationcustomer").val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $("#tel_customer").val(data.customer.tel)
                    $("#address_customer").val(data.customer.address)
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
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
    });


    function setItem($item) {
        var $txtFormNumber = $('*[name^="code"]', $item);
        var no = $('.card-item .code').not(':first').not(':first').length
        var code = $('.card-item .code')[0].value
        var num_code = "0"
        var code_string = code.replace('D', '')
        var items = parseInt(code_string) + parseInt(no);
        for (let i = (parseInt(code_string) + 1).toString().length; i < 3; i++) {
            num_code += "0";
        }
        $txtFormNumber.val("D" + num_code + items.toString());
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
                    <h1>เพิ่มการจำนำทอง</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br />
<div class="container">
    <form method="POST" action="{{route('pledge.store')}}" id="post-save" class="needs-validation" novalidate>
        <div class="card">
            <div class="card-header">
                <h2>รับจำนำทอง</h2>
            </div>
            <div class="card-body">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาขายออกทองคำแท่งประจำวัน*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ราคารับซื้อทองคำแท่งประจำวัน*</h4>
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
                        <h4 for="validationuser">ผู้รับจำนำ*</h4>
                    </div>
                    <div class="col-4">
                        <h4 for="validationcustomer">ลูกค้า*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3 validateUser" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้รับซื้อ</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->user_id)&&$row->id == $productdetail->user_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกผู้รับซื้อ
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3 validateCustomer" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="customer_id" id="validationcustomer" required>
                                <option selected disabled value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->customer_id)&&$row->id == $productdetail->customer_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกลูกค้า
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <a type="button" class="btn btn-info" href="{{url('/manage_customer/create')}}">เพิ่มข้อมูลลูกค้า</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>เบอร์โทรลูกค้า</h4>
                    </div>
                    <div class="col-6">
                        <h4>ที่อยู่ลูกค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" id="tel_customer" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" id="address_customer" placeholder="" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>วันที่รับจำนำ*</h4>
                    </div>
                    <div class="col-4">
                        <h4>วันจ่ายดอกรอบถัดไป*</h4>
                    </div>
                    <div class="col-4">
                        <h4>ดอกเบี้ย*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class='form-group'>
                            <input type="date" class="form-control" name="installment_start" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class='form-group validateDatenext'>
                            <input type="date" class="form-control date-next" name="installment_next" id="validatedatenext" value="" required>
                            <div class="invalid-feedback">
                                โปรดเลือกวันจ่ายดอกรอบถัดไป
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group validatePer">
                            <input name="interest_per" type="number" class="form-control input-per" id="validateper" placeholder="" value="" required />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกดอกเบี้ย%
                            </div>
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
                            <h4>รหัสการรับจำนำ</h4>
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
                            <div class="input-group mb-3 validationCategory">
                                <select class="custom-select custom-select--single" name="type_gold_id[]" id="validationcategory" required>
                                    <option selected disabled value="">เลือกประเภททอง</option>
                                    @foreach($producttype as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    โปรดเลือกประเภททองที่ต้องการ
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationtelstore">นํ้าหนัก*</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationgram">นํ้าหนัก(กรัม)*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3 validationWeight">
                                <select class="custom-select size custom-select--size" name="size[]" id="validationweight" required>
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
                            <div class="input-group validationGram">
                                <input name="gram[]" type="text" class="form-control gram input-gram" id="validationgram" placeholder="" required/>
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
                            <h4 for="validationstriped">ลาย*</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationdetails">รายละเอียด*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3 validationStriped">
                                <select class="custom-select custom-select--striped" name="striped_id[]" id="validationstriped" required>
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
                            <div class="form-group validationDetails">
                                <input name="details[]" type="text" class="form-control form-control--detail" id="validationdetails" placeholder="" required />
                                <div class="invalid-feedback">
                                    โปรดกรอกรายละเอียดทอง
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationprice">ราคารับจำนำ*</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group validationPrice">
                                <input name="allprice[]" type="text" class="form-control allprice form-control--price" id="validationprice" placeholder="" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">บาท</span>
                                </div>
                                <div class="invalid-feedback">
                                    โปรดกรอกราคารับจำนำ
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
                        <a type="button" class="btn btn-info text-white" id="btn-buy"><i class="fa fa-plus"></i> เพิ่มการรับซื้อขายฝาก</a>
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
            <a type="button" class="btn btn-secondary" href="{{url('/pledge')}}">กลับ</a>
            <button type="button" id="btn-save" class="btn btn-success">บันทึก</button>
        </div>
    </form>

    <div id="templateCard" style="display: none;">
        <div class="card card-item">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสการรับจำนำ</h4>
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
                        <div class="input-group mb-3 validationCategory2">
                            <select class="custom-select custom-select--single2" name="type_gold_id[]" id="validationcategory2" required>
                                <option selected disabled value="">เลือกประเภททอง</option>
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
                        <h4>นํ้าหนัก*</h4>
                    </div>
                    <div class="col-6">
                        <h4>นํ้าหนัก(กรัม)*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3 validationWeight2">
                            <select class="custom-select size custom-select--size2" name="size[]" id="validationweight2" required>
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
                        <div class="input-group validationGram2">
                            <input name="gram[]" type="text" class="form-control gram input-gram2" id="validationgram2" placeholder="" />
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
                        <h4 for="validationstriped">ลาย*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdetails">รายละเอียด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 validationStriped2">
                        <select class="custom-select custom-select--striped2" name="striped_id[]" id="validationstriped2" required>
                            <option selected disabled value="">เลือกลาย</option>
                            @foreach($striped as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            โปรดเลือกประเภทที่ต้องการ
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group validationDetails2">
                            <input name="details[]" type="text" class="form-control form-control--detail2" id="validationdetails2" placeholder="" required />
                            <div class="invalid-feedback">
                                โปรดกรอกรายละเอียดทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationprice">ราคารับจำนำ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group validationPrice2">
                            <input name="allprice[]" type="text" class="form-control allprice form-control--price2" id="validationprice2" placeholder="" required />
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกราคารับซื้อ
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