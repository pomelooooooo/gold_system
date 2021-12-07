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
            <!-- <form method="POST" action="{{route('productdetail.store')}} " enctype="multipart/form-data" class="needs-validation" novalidate> -->
                <!-- {{csrf_field()}} -->
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
                            <input name="gold_id" type="text" class="form-control" placeholder="" readonly />
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
                            <input type="datetime-local" class="form-control" name="date_time"> 
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="type_gold" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="weight" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <h4>ผู้ขาย*</h4>
                    </div>
                    <div class="col-3">
                        <h4>ค่าแรงทองต่อเส้น</h4>
                    </div>
                    <div class="col-3">
                        <h4>ราคาทุน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class='form-group'>
                            <input type="text" class="form-control" name="user_id"> 
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="wage" type="text" class="form-control" placeholder=""  />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="price_of_gold" type="text" class="form-control" placeholder=""  />
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
                            <input type="text" class="form-control datetimepicker" name="sell_price"> 
                        </div>
                    </div>
                </div>
                
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/sell')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            <!-- </form> -->
        </div>
    </div>
</div>
<br />

@endsection
