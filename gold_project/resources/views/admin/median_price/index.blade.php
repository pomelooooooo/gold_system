@extends('layouts.master')
@section('title','ราคากลางทองประจำวัน')
@section('content')

<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:3000/latest",
            type: 'GET',
            success: function(response) {
                console.log(response.response)
                $("#date").html(response.response.date)
                $("#update_time").html(response.response.update_time)
                $("#gold_bar_buy").val(response.response.price.gold_bar.buy)
                $("#gold_bar_sell").val(response.response.price.gold_bar.sell)
                $("#gold_buy").val(response.response.price.gold.buy)
                $("#gold_sell").val(response.response.price.gold.sell)

                $("#gold_table_bar_buy").html(response.response.price.gold_bar.buy)
                $("#gold_table_bar_sell").html(response.response.price.gold_bar.sell)
                $("#gold_table_buy").html(response.response.price.gold.buy)
                $("#gold_table_sell").html(response.response.price.gold.sell)
                $("#gold_spot").html(response.response.gold_spot)
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
                    <h1><span class="orange-text">ราคากลาง</span> ทองประจำวัน</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->
<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><span class="orange-text">ราคาทองล่าสุด</span></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="container  justify-content-center ">
                    <div class="row">
                        <div class="col-md-8 medien-center">
                            <div class="card card-body mt-2">
                                <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                    <div class="mr-2 mb-3 mb-lg-0"> <img src="assets/img/products/product-img-1.jpg" width="200" height="200" alt=""> </div>
                                    <div class="media-body">
                                        <h3 class="media-title font-weight-semibold text-center"> ทองคำแท่ง </h3>
                                        <hr>
                                        <ul class=" list-inline-dotted mb-3 mb-lg-3">
                                            <div class="row">
                                                <h6 class="list-inline-item">ราคาซื้อ </h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" id="gold_bar_buy" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h6 class="list-inline-item">ราคาขาย </h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" id="gold_bar_sell" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container  justify-content-center ">
                    <div class="row">
                        <div class="col-md-8 medien-center">
                            <div class="card card-body mt-3">
                                <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                    <div class="mr-2 mb-3 mb-lg-0"> <img src="assets/img/products/product-img-2.jpg" width="200" height="200" alt=""> </div>
                                    <div class="media-body">
                                        <h3 class="media-title font-weight-semibold text-center"> ทองรูปพรรณ </h3>
                                        <hr>
                                        <ul class="list-inline-dotted mb-3 mb-lg-3">
                                            <div class="row">
                                                <h6 class="list-inline-item">ราคาซื้อ </h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" id="gold_buy" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                               <h6 class="list-inline-item">ราคาขาย </h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" id="gold_sell" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="2" class="text-center">ทองคำแท่ง (96.5%)</th>
                                <th colspan="3" class="text-center">ทองรูปพรรณ (96.5%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary text-center">วันที่</td>
                                <td class="table-secondary">เวลา</td>
                                <td class="table-secondary">รับซื้อ(บาท)</td>
                                <td class="table-secondary">ขายออก(บาท)</td>
                                <td class="table-secondary">รับซื้อ(บาท)</td>
                                <td class="table-secondary">ขายออก(บาท)</td>
                                <td class="table-secondary">รับซื้อ(กรัม)</td>
                            </tr>
                            <tr>
                                <td id="date"></td>
                                <td id="update_time"></td>
                                <td id="gold_table_bar_buy"></td>
                                <td id="gold_table_bar_sell"></td>
                                <td id="gold_table_buy"></td>
                                <td id="gold_table_sell"></td>
                                <td id="gold_spot"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>




@endsection