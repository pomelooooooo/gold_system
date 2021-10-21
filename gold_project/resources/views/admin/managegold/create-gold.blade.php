@extends('layouts.master')
@section('title','เพิ่มทองเข้าร้าน')
@section('content')

<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>เพิ่มทองเข้าร้าน</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br /><br />
<h2 class="text-center">เพิ่มทองเข้าร้าน</h2>
<div class="container">
    <hr class="mt-5 mb-6" />
    <form method="POST" action="{{route('managegold.store')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6">
                <h4>รหัสสินค้า</h4>
            </div>
            <div class="col-6">
                <h4>รายละเอียดสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="code" type="text" class="form-control" placeholder="" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="details" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>หน่วยนับ</h4>
            </div>
            <div class="col-6">
                <h4>นํ้าหนัก</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="unit" type="text" class="form-control" placeholder="" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="weight" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>ราคาทอง</h4>
            </div>
            <div class="col-6">
                <h4>ค่ากำเหน็จ</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="price" type="text" class="form-control" placeholder="" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="gratuity" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>ราคารวม</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="allprice" type="text" class="form-control  form-control-lg" placeholder="" />
                </div>
            </div>
        </div>
        <br /><br />
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/managegold')}}">กลับ</a>
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
        <!-- <input type="hidden" name="_method" value="PATCH"/> -->
    </form>
</div>

@endsection