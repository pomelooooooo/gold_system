@extends('layouts.master')
@section('title','จัดการข้อมูลร้าน')
@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>จัดการข้อมูลร้าน</h1>
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
                <h3>ข้อมูลสาขา</h3>
            </div>
            <div class="col-6 text-right">
                <a type="button" class="btn btn-outline-info" href="{{ url('/stores/create') }}"><i class="fa fa-plus"></i> เพิ่มสาขา</a>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">ชื่อร้าน</th>
                            <th scope="col">ที่อยู่</th>
                            <th scope="col">เบอร์โทร</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>name</td>
                            <td>address</td>
                            <td>tel</td>
                            <td>address</td>
                            <td>tel</td>
                        </tr>

                    </tbody>
                </table>
                </br></br>
            </div>
        </div>
    </div>
</div>



@endsection