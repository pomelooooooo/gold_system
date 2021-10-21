@extends('layouts.master')
@section('title','จัดการข้อมูลทอง')
@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>จัดการข้อมูลทอง</h1>
                        <!-- <div class="hero-btns">
								<a href="shop.html" class="boxed-btn">Fruit Collection</a>
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<div class="list-section pt-80 pb-80">
    <div class="container">

        <div class="row">
            <div class="col-6">
                <h3>จัดการข้อมูลทอง</h3>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="table-info">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">รายละเอียดสินค้า</th>
                            <th scope="col">นํ้าหนัก</th>
                            <th scope="col">ราคา</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </br></br>
            </div>
        </div>
    </div>
</div>



@endsection