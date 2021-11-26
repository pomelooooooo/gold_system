@extends('layouts.master')
@section('title','เพิ่มล็อตทอง')
@section('content')

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>เพิ่มล็อตทอง</h1>
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
            <h2>เพิ่มล็อตทอง</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('product.store')}} ">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-4">
                        <h4>รหัสล๊อต</h4>
                    </div>
                    <div class="col-4">
                        <h4>ประเภท</h4>
                    </div>
                    <div class="col-4">
                        <h4>น้ำหนัก</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="lot_id" type="text" class="form-control" placeholder="" disabled/>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- <div class="form-group">
                            <input name="type_gold_id" type="text" class="form-control" placeholder="" />
                        </div> -->
                        <div class="form-group">
                            <select name="type_gold_id" class="form-control" id="typeID">
                                <option value="">เลือกประเภท</option>
                            @foreach($type as $row)
                                <option value="{{$row->id}}">{{$row->category}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input name="weight" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>จำนวนสินค้า</h4>
                    </div>
                    <div class="col-4">
                        <h4>ราคาทองต่อเส้น</h4>
                    </div>
                    <div class="col-4">
                        <h4>ค่าแรงต่อเส้น</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="lot_count" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input name="price_of_gold" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input name="wage" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4>วันที่นำเข้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input name="date_of_import" type="date" class="form-control" value="{{date('Y-m-d')}}" />
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/product')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />
@endsection