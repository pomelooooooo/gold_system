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
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <img src="assets/img/products/product-img-2.jpg" class="rounded" alt="">
                    </div>
                    <h3>ทองคำแท่ง</h3>
                    <p class="gold-price-buy"><span>ราคาซื้อ</span> 70฿ </p>
                    <p class="gold-price-sell"><span>ราคาขาย</span> 70฿ </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <img src="assets/img/products/product-img-2.jpg" class="rounded" alt="">
                    </div>
                    <h3>ทองคำรูปพรรณ</h3>
                    <p class="gold-price-buy"><span>ราคาซื้อ</span> 70฿ </p>
                    <p class="gold-price-sell"><span>ราคาขาย</span> 70฿ </p>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col="2"">ทองคำแท่ง</th>
                        <th scope="col="2"">ทองคำรูปพรรณ</th>
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
            <a class="btn btn-success" href="#">บันทึก</a>
            <a class="btn btn-secondary" href="#">ยกเลิก</a>
    </div>
</div>

@endsection