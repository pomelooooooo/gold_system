@extends('layouts.master')
@section('title','เพิ่มประเภททอง')
@section('content')

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                        <p class="subtitle">Gold System</p>
                        <h1>เพิ่มประเภททอง</h1>
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
            <h2>เพิ่มประเภททอง</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('type_gold.store')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสประเภททอง</h4>
                    </div>
                    <div class="col-6">
                        <h4>ชื่อประเภท</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="category" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/type_gold')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>

</div>
<br />

@endsection