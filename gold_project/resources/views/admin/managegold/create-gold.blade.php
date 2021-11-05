@extends('layouts.master')
@section('title','เพิ่มทองเข้าร้าน')
@section('content')
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
                <h4>ลาย</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>เลือกหน่วยนับ</option>
                        <option value="1">เส้น</option>
                        <option value="2">แท่ง</option>
                        <option value="3">วง</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="weight" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <h4>นํ้าหนัก(บาท)</h4>
            </div>
            <div class="col-3">
                <h4>นํ้าหนัก(สลึง)</h4>
            </div>
            <div class="col-6">
                <h4>นํ้าหนัก(กรัม)</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <input name="code" type="text" class="form-control" placeholder="" />
                </div>
            </div>
            <div class="col-3">
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
                <h4>สถานะทอง</h4>
            </div>
            <div class="col-6">
                <h4>วันที่นำทองเข้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>เลือกสถานะทอง</option>
                        <option value="1">ทองเก่า</option>
                        <option value="2">ทองใหม่</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="gratuity" type="date" class="form-control" value="{{date('Y-m-d')}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>ถาด</h4>
            </div>
            <div class="col-6">
                <h4>ราคาทอง</h4>
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
                <h4>อัพโหลดรูปภาพ</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="file" class="form-control" id="customFile" />
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