@extends('layouts.master')
@section('title','แก้ไขข้อมูลผู้ผลิต')
@section('content')

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                        <p class="subtitle">Gold System</p>
                        <h1>แก้ไขข้อมูลผู้ผลิต</h1>
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
                <div class="form-inline">
                    <h2>แก้ไขข้อมูลผู้ผลิต</h2>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{action('ManufacturerController@update', $id)}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationid">รหัสผู้ผลิต</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationtype">ชื่อผู้ผลิต</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input name="code" type="text" class="form-control" id="validationid" placeholder="" value="{{$manufacturer->code}}" required/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" id="validationtype" placeholder="" value="{{$manufacturer->name}}" required/>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-6">
                            <h4 for="validationttel">เบอร์โทร</h4>
                        </div>
                        <div class="col-6">
                            <h4 for="validationaddress">ที่อยู่</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input name="tel" type="text" class="form-control" id="validationttel" placeholder=""  value="{{$manufacturer->tel}}" required/>
                                <div class="invalid-feedback">
                                    โปรดกรอกเบอร์โทร
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea name="address" type="text" class="form-control" id="validationaddress" placeholder="" value="{{$manufacturer->address}}" required>{{$manufacturer->address}}</textarea>
                                <div class="invalid-feedback">
                                    โปรดกรอกที่อยู่
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="text-right">
                        <a type="button" class="btn btn-secondary" href="{{url('/manufacturer')}}">กลับ</a>
                        <button type="submit" class="btn btn-success">อัพเดท</button>
                    </div>
                    <input type="hidden" name="_method" value="PATCH"/>
                    <br/>
                </form>
            </div>
        </div>
    </div>
    <br>

@endsection