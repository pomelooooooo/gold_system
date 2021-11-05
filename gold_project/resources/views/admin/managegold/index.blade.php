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
            <div class="col-6 text-right">
                <a type="button" class="btn btn-outline-info" href="{{ route('managegold.create') }}"><i class="fa fa-plus"></i> เพิ่มทองเข้าร้าน</a>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">รายละเอียดสินค้า</th>
                            <th scope="col">นํ้าหนัก(บาท)</th>
                            <th scope="col">นํ้าหนัก(สลึง)</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($managegold as $row)
                        <tr>
                            <td>{{$row['code']}}</td>
                            <td>{{$row['details']}}</td>
                            <td>{{$row['weight']}}</td>
                            <td>{{$row['price']}}</td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="{{action('ManagegoldController@edit',$row['id'])}}"><i class="fa fa-edit"></i> แก้ไข</a>
                            </td>
                            <td class="text-center">
                                <form method="POST" class="delete_from" action="{{action('ManagegoldController@destroy',$row['id'])}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </br></br>
            </div>
        </div>
    </div>
</div>



@endsection