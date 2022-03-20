@extends('layouts.master')
@section('title','จำนำทอง')
@section('content')
<style>
    input[type=number]{
        width: 100%;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script type="text/javascript">
    $(function() {
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
                    <h1>จ่ายดอกเบี้ย</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br />
<div class="container">
    <form method="POST" action="{{action('PledgeController@interest_update', $id)}} " class="needs-validation" novalidate>
        <div class="card">
            <div class="card-header">
                <h2>รับจำนำทอง</h2>
            </div>
            <div class="card-body">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationuser">ผู้รับจำนำ*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcustomer">ลูกค้า*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="user_id" id="validationuser" disabled> 
                                <option selected disabled value="">เลือกผู้รับซื้อ</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}" {{!empty($pledges[0]->user_id)&&$row->id == $pledges[0]->user_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="customer_id" id="validationcustomer" disabled>
                                <option selected disabled value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}" {{!empty($pledges[0]->customer_id)&&$row->id == $pledges[0]->customer_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <input type="text" class="form-control" id="tel_customer" placeholder="" value="{{!empty($pledges[0])?$pledges[0]->tel:''}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" id="address_customer" placeholder="" value="{{!empty($pledges[0])?$pledges[0]->address:''}}" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>วันที่รับฝาก</h4>
                    </div>
                    <div class="col-6">
                        <h4>วันกำหนดชำระ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="date" class="form-control" name="" value="{{Carbon\Carbon::parse($pledges[0]->installment_start)->format('Y-m-d')}}" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="date" class="form-control" name="due_date" value="{{Carbon\Carbon::parse($history_pledges_due_date)->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาทองที่จำนำทั้งหมด</h4>
                    </div>
                    <div class="col-6">
                        <h4>ยอดค้างชำระ</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" value="{{number_format(!empty($pledges[0])?$pledges[0]->price_pledge: 0, 2)}}" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" value="{{number_format($deposit,2)}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>เงินที่ชำระ</h4>
                    </div>
                    <div class="col-4">
                        <h4>ดอกเบี้ยที่ชำระ</h4>
                    </div>
                    <div class="col-4">
                        <h4>ผู้ชำระเงิน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class='form-group'>
                            <input type="number" class="form-control" name="deposit" value="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input name="interest_bath" type="number" class="form-control" placeholder="" value="{{$interest_bath}}" required readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">บาท</span>
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกดอกเบี้ยบาท
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-4">
                        <div class='form-group'>
                            <input type="text" class="form-control" name="customer_name" value="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
        @foreach($pledges as $key => $value)
        <input type="hidden" name="pledges_line_id[]" value="{{$value->pledges_line_id}}">
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
                                <input name="code[]" type="text" class="form-control code" placeholder="" value="{{$value->code}}" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="hidden" name="type_gold_id[]" value="{{$value->type_gold_id}}">
                                <select class="custom-select" disabled>
                                    <option selected disabled value="">เลือกหน่วยนับ</option>
                                    @foreach($producttype as $row)
                                    <option value="{{$row->id}}" {{$row->id == $value->type_gold_id ? 'selected' : ''}}>{{$row->name}}</option>
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
                                <input type="hidden" name="size[]" value="{{$value->size}}">
                                <select class="custom-select size" name="size[]" disabled>
                                    <option disabled value="">เลือกหน่วยนับ</option>
                                    @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                    <option value="{{ $sizeWay }}" {{ $value->size == $sizeWay ? "selected" : "" }}>{{ $sizeLable }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    โปรดเลือกนํ้าหนักที่ต้องการ
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <input name="gram[]" type="text" class="form-control gram" placeholder="" value="{{$value->weight}}"  readonly/>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">กรัม</span>
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
                            <div class="input-group mb-3">
                                <input type="hidden" name="size[]" value="{{$value->striped_id}}">
                                <select class="custom-select" name="striped_id[]" id="validationstriped" disabled>
                                    <option disabled value="">เลือกลาย</option>
                                    @foreach($striped as $row)
                                    <option value="{{$row->id}}" {{$row->id == $value->striped_id ? 'selected' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    โปรดเลือกประเภทที่ต้องการ
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input name="details[]" type="text" class="form-control" placeholder="" value="{{$value->details}}" required readonly/>
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
                        <div class="col-6">
                            <h4>สถานะทอง</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <input name="allprice[]" type="text" class="form-control allprice" placeholder="" value="{{$value->allprice}}" required readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">บาท</span>
                                </div>
                                <div class="invalid-feedback">
                                    โปรดกรอกราคารับจำนำ
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pl-2">
                                <div class="form-group">
                                    @foreach(["0"=>"ยังไม่ไถ่ถอน","1"=>"ไถ่ถอนแล้ว","2"=>"หลุดจำนำ"] as $statusWay => $statusLable)
                                    <input type="radio" class="form-check-input" name="status_check[{{$key}}]"  value="{{ $statusWay }}" {{$value->pledges_line_status_check == $statusWay ? "checked" : ""}} required>
                                    <h6 class="form-check-label">{{ $statusLable }}</h6>
                                    <div class="invalid-feedback">โปรดเลือกสถานะทองที่ต้องการ</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
        @endforeach
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/pledge')}}">กลับ</a>
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
    </form>
</div>
<br>
@endsection