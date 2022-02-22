@extends('layouts.master')
@section('title','ขายทอง')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

<script type="text/javascript">
    $(function() {
        $("#validationuser").select2({
            placeholder: "เลือกผู้ขาย",
            // allowClear: true
        });
        $("#validationcustomer").select2({
            placeholder: "เลือกลูกค้า",
            // allowClear: true
        });
        $.ajax({
            url: "http://127.0.0.1:3000/latest",
            type: 'GET',
            success: function(response) {
                // console.log(response.response)
                $("#gold_bar_sell").val(response.response.price.gold_bar.sell)
                $("#gold_sell").val(response.response.price.gold.sell)
                let size_arr = {
                    "ครึ่งสลึง": 0.125,
                    "1 สลึง": 0.25,
                    "2 สลึง": 0.5,
                    "3 สลึง": 0.75,
                    "6 สลึง": 1.5,
                    "1 บาท": 1,
                    "2 บาท": 2,
                    "3 บาท": 3,
                    "4 บาท": 4,
                    "5 บาท": 5,
                    "10 บาท": 10
                }
                $('.gold_sell_cal').each(function(i, obj) {
                    let price_gold_sell = parseFloat(response.response.price.gold.sell.replace(",", ""))
                    let gratuity_cal = parseFloat($("#gratuity_cal" + i).val())
                    let size = ''
                    $.each(size_arr, function(key, value) {
                        if ($('#size' + i).val() == key) {
                            size = value
                        }
                    });
                    let vat = ((price_gold_sell * size) + gratuity_cal) * 0.07

                    $("#gold_sell_cal" + i).val((((price_gold_sell * size) + gratuity_cal) + vat).toFixed(2))
                });

                var totals = 0
                $('.gold_sell_cal').each(function(index, el) {
                    if (!isNaN(parseFloat(el.value))) {
                        totals += parseFloat(el.value)
                    }
                })
                $('#total-price').html(totals.toFixed(2))
            },
            error: function(xhr) {
                "Not have Data!!"
            }
        })
    });
    $(document).ready(function() {
        $('body').on('keyup', '.gold_sell_cal', function() {
            var total = 0
            $('.gold_sell_cal').each(function(index, el) {
                if (!isNaN(parseFloat(el.value))) {
                    total += parseFloat(el.value)
                }
            })
            $('#total-price').html(total.toFixed(2))
        })

        $("body").on('click', '#btn-save', function(e) {
            Swal.fire({
                title: 'ต้องการขายทองหรือไม่?',
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
                        url: "/sellGroup/update",
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
                                        title: 'ต้องการพิมพ์ใบเสร็จรับเงิน/ใบกำกับภาษีหรือไม่?',
                                        // text: "You won't be able to revert this!",
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'ใช่',
                                        cancelButtonText: 'ไม่',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.open('/sellGroup/formSell/'+group_id, '_blank')
                                        }
                                        window.location = '/sell'
                                    })
                                })
                            }
                        }
                    });
                }
            })
        })
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
    <form id="form-data" method="POST" action="{{url('/sellGroup/update')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="card">
            <div class="card-header">
                <h2>ขายทอง</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาขายออกทองคำแท่งประจำวัน*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ราคาขายออกทองรูปพรรณประจำวัน*</h4>
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
                        <h4 for="validationuser">ผู้ขาย*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ลูกค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
                            <select class="custom-select selectpicker" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้ขาย</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->user_id)&&$row->id == $productdetail->user_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกผู้ขาย
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3" style="margin-top: 0.5em;">
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
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>วันเวลาที่ขาย*</h4>
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
        <br />
        @foreach($productdetail as $key => $value)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id[]" value="{{$value->id}}">
                    <div class="col-6">
                        <h4>รหัสสินค้า*</h4>
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
                        <div class="form-group">
                            <input name="code[]" type="text" class="form-control" placeholder="" value="{{$value->code}}" readonly />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <input type="hidden" name="type_gold_id[]" value="{{$value->type_gold_id}}">
                            <select class="custom-select" disabled>
                                <option selected disabled value="">เลือกประเภททอง</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}" {{$row->id == $value->type_gold_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <input type="hidden" name="size[]" value="{{$value->size}}">
                            <select class="custom-select" id="size{{$key}}" disabled>
                                <option selected>เลือกหน่วยนับ</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{ old("size", $value->size) == $sizeWay ? "selected" : "" }}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h4>ค่าแรงทองต่อเส้น</h4>
                    </div>
                    <div class="col-3">
                        <h4>ราคาทุน</h4>
                    </div>
                    <div class="col-6">
                        <h4>ลาย</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <input name="gratuity[]" type="text" class="form-control gratuity_cal" value="{{$value->gratuity}}" id="gratuity_cal{{$key}}" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="allprice[]" type="text" class="form-control allprice" placeholder="" value="{{$value->allprice}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="hidden" name="striped_id[]" value="{{$value->striped_id}}">
                            <select class="custom-select" disabled>
                                <option selected disabled value="">เลือกลายทอง</option>
                                @foreach($striped as $row)
                                <option value="{{$row->id}}" {{$row->id == $value->striped_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
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
                            <input type="text" class="form-control gold_sell_cal " name="sellprice[]" id="gold_sell_cal{{$key}}" value="{{$value->sellprice}}" required>
                        </div>
                        <div class="invalid-feedback">
                            โปรดกรอกราคาขาย
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        @endforeach
        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <h4>ราคารวม</h4>
                    <h3 id="total-price">0</h3>
                </div>
            </div>
        </div>
        <br />
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/sell')}}">กลับ</a>
            <button type="button" class="btn btn-info"><i class="fas fa-receipt"></i> พิมพ์ใบเสร็จรับเงิน</button>
            <button type="button" id="btn-update" class="btn btn-info"><i class="fas fa-receipt"></i> พิมพ์ใบกำกับภาษี</button>
            <button id="btn-save" type="button" class="btn btn-success">ทำการขาย</button>
        </div>
        <!-- <input type="hidden" name="_method" value="PATCH" /> -->
    </form>
</div>
<br />

@endsection