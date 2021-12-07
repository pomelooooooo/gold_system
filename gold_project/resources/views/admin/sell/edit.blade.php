@extends('layouts.master')
@section('title','ขายทอง')
@section('content')

<script type="text/javascript">
    $(function () {
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
    <div class="card">
        <div class="card-header">
            <h2>ขายทอง</h2>
        </div>
        <div class="card-body">
        <form method="POST" action="{{action('SellController@update', $id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ราคากลางทองแท่งประจำวัน*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ราคากลางทองรูปพรรณประจำวัน*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" placeholder="" value="{{$productdetail->code}}" readonly />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="gold_bar_sell" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="gold_sell" placeholder="" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>วันเวลาที่ขาย*</h4>
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
                        <div class='form-group'>
                            <input type="datetime-local" class="form-control" name="datetime"> 
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="type_gold_id" id="validationcategory" required>
                                <option selected disabled value="">เลือกหน่วยนับ</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}" {{$row->id == $productdetail->type_gold_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="size" id="validationcategory" required>
                                <option selected>เลือกหน่วยนับ</option>
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{ old("size", $productdetail->size) == $sizeWay ? "selected" : "" }}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกนํ้าหนักที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h4 for="validationuser">ผู้ขาย*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ค่าแรงทองต่อเส้น</h4>
                    </div>
                    <div class="col-3">
                        <h4 for="validationallprice">ราคาทุน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="user_id" id="validationuser" required>
                                <option selected disabled value="">เลือกผู้ขาย</option>
                                @foreach($users as $row)
                                <option value="{{$row->id}}"{{$row->id == $productdetail->user_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$productdetail->price_of_gold}}" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="allprice" type="text" class="form-control" placeholder="" value="{{$productdetail->allprice}}" id="validationallprice" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทุน
                            </div>
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
                            <input type="text" class="form-control datetimepicker" name="sellprice" value="{{$productdetail->sellprice}}"> 
                        </div>
                    </div>
                </div>
                
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/sell')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
                <br />
            </form>
        </div>
    </div>
</div>
<br />

@endsection
