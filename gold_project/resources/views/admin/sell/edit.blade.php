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
                console.log(response.response)
                $("#gold_bar_sell").val(response.response.price.gold_bar.sell)
                $("#gold_sell").val(response.response.price.gold.sell)
                $('.gold_sell_cal').each(function(i, obj) {
                    $("#gold_sell_cal" + i).val(parseFloat(response.response.price.gold.sell.replace(",", "")) + (parseFloat($("#gratuity_cal" + i).val()) * 0.7))
                });
                // console.log(response.response.price.gold.sell, parseFloat($(".gratuity_cal").val()) * 0.7)
            },
            error: function(xhr) {
                "Not have Data!!"
            }
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
    <form method="POST" action="{{url('/sellGroup/update')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h2>ขายทอง</h2>
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
                        <h4 for="validationuser">ผู้ขาย*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationcustomer">ลูกค้า*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select selectpicker" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้ขาย</option>
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
                        <div class="input-group mb-3">
                            <select class="custom-select selectpicker" name="customer_id" id="validationcustomer" required>
                                <option selected disabled value="">เลือกลูกค้า</option>
                                @foreach($customer as $row)
                                <option value="{{$row->id}}" {{!empty($productdetail->customer_id)&&$row->id == $productdetail->customer_id ? 'selected' : ''}}>{{$row->name}} {{$row->lastname}}</option>
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
                            <select class="custom-select" name="type_gold_id[]" readonly>
                                <option selected disabled value="">เลือกประเภททอง</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}" {{$row->id == $value->type_gold_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="size[]" readonly>
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
                            <input name="allprice[]" type="text" class="form-control" placeholder="" value="{{$value->allprice}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class='form-group'>
                            <input name="striped[]" type="text" class="form-control" placeholder="" value="{{$value->striped}}" readonly />
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
                            <input type="text" class="form-control gold_sell_cal " name="sellprice[]" id="gold_sell_cal{{$key}}" value="{{$value->sellprice}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        @endforeach
        <br />
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/sell')}}">กลับ</a>
            <a type="button" class="btn btn-info" href="{{url('/sell')}}">พิมพ์ใบเสร็จรับเงิน</a>
            <a type="button" class="btn btn-info" href="{{url('/sell')}}">พิมพ์ใบกำกับภาษี</a>
            <button id="btn-save" type="submit" class="btn btn-success">ทำการขาย</button>
        </div>
        <!-- <input type="hidden" name="_method" value="PATCH" /> -->
    </form>
</div>
<br />

@endsection