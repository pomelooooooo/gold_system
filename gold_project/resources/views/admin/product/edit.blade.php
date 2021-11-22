@extends('layouts.master')
@section('title','เพิ่มทองเข้าร้าน')
@section('content')

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                        <p class="subtitle">Gold System</p>
                        <h1>เพิ่มทองเข้าร้าน</h1>
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
            <h2>เพิ่มทองเข้าร้าน</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ProductController@update', $id)}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสล๊อต</h4>
                    </div>
                    <div class="col-6">
                        <h4>จำนวนสินค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lot_id" type="text" class="form-control" placeholder="" value="{{$product->lot_id}}"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lot_count" type="text" class="form-control" placeholder="" value="{{$product->lot_count}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h4>ราคาทอง</h4>
                    </div>
                    <div class="col-3">
                        <h4>ค่าแรง</h4>
                    </div>
                    <div class="col-6">
                        <h4>วันที่นำเข้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <input name="price_of_gold" type="text" class="form-control" placeholder="" value="{{$product->price_of_gold}}"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="wage" type="text" class="form-control" placeholder="" value="{{$product->wage}}"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_of_import" type="date" class="form-control" value="{{$product->date_of_import}}" />
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/product')}}">กลับ</a>
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