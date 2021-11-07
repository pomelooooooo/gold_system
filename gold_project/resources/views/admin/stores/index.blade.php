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
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>ข้อมูลสาขา</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a type="button" class="btn btn-outline-info" href="{{ route('stores.create') }}"><i class="fa fa-plus"></i> เพิ่มร้านสาขา</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ชื่อร้าน</th>
                                    <th scope="col">ที่อยู่</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stores as $row)
                                <tr>
                                    <td>{{$row['name']}}</td>
                                    <td>{{$row['address']}}</td>
                                    <td>{{$row['tel']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{action('StoresController@edit',$row['id'])}}"><i class="fa fa-edit"></i> แก้ไข</a>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" class="delete_from" action="{{action('StoresController@destroy',$row['id'])}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection