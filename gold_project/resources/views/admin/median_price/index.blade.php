@extends('layouts.master')
@section('title','ราคากลางทองประจำวัน')
@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>ราคากลางทองประจำวัน</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">ราคากลาง</span> ทองประจำวัน</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            </div>
            <div class="container  justify-content-center ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body mt-2">
                            <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0"> <img src="assets/img/products/product-img-1.jpg" width="200" height="200" alt=""> </div>
                                <div class="media-body">
                                    <h3 class="media-title font-weight-semibold text-center"> ทองคำแท่ง </h3>
                                    <ul class=" list-inline-dotted mb-3 mb-lg-3">
                                        <h6 class="list-inline-item">ราคาซื้อ </h6>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div>
                                            <h6 class="list-inline-item">ราคาขาย </h6>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" class="form-control" placeholder="" />
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
                    <div class="col-md-12">
                        <div class="card card-body mt-3">
                            <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0"> <img src="assets/img/products/product-img-2.jpg" width="200" height="200" alt=""> </div>
                                <div class="media-body">
                                    <h3 class="media-title font-weight-semibold text-center"> ทองรูปพรรณ </h3>
                                    <ul class="list-inline-dotted mb-3 mb-lg-3">
                                        <h6 class="list-inline-item">ราคาซื้อ </h6>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" class="form-control" placeholder="" />
                                                </div>
                                            </div>
                                            <h6 class="list-inline-item">ราคาขาย </h6>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" class="form-control" placeholder="" />
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
        <br />
        <div class="row">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"></th>
                        <th colspan="2" class="text-center">ทองคำแท่ง</th>
                        <th colspan="2" class="text-center">ทองรูปพรรณ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-secondary">วันที่</td>
                        <td class="table-secondary">ซื้อ</td>
                        <td class="table-secondary">ขาย</td>
                        <td class="table-secondary">ซื้อ</td>
                        <td class="table-secondary">ขาย</td>
                    </tr>
                    <tr>
                        <td>14/10/64</td>
                        <td>20000</td>
                        <td>22000</td>
                        <td>15000</td>
                        <td>60000</td>
                    </tr>

                </tbody>
            </table>

        </div>
        <!-- <a class="btn btn-success" href="#">บันทึก</a>
        <a class="btn btn-secondary" href="#">ยกเลิก</a> -->
    </div>
</div>

@endsection