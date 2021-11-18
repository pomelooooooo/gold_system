@extends('layouts.master')
@section('title','เพิ่มทองเข้าร้าน')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    });
</script>

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
            <form method="POST" action="{{route('managegold.store')}} " enctype="multipart/form-data">
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
                            <select class="custom-select" name="unit" >
                                <option selected>เลือกหน่วยนับ</option>
                                @foreach(["เส้น"=>"เส้น","แท่ง"=>"แท่ง","วง"=>"วง"] as $unitWay => $unitLable)
                                    <option value="{{ $unitWay }}" >{{ $unitLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="striped" type="text" class="form-control" placeholder="" />
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
                            <input name="bath" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="salung" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gram" type="text" class="form-control" placeholder="" />
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
                            <select class="custom-select" name="status">
                                @foreach(["ทองเก่า"=>"ทองเก่า","ทองใหม่"=>"ทองใหม่"] as $statusWay => $statusLable)
                                    <option value="{{ $statusWay }}" >{{ $statusLable }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_of_import" type="date" class="form-control" value="{{date('Y-m-d')}}" />
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
                            <input name="tray" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="price_of_gold" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>อัพโหลดรูปภาพ</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="form-group text-center">
                                <div class="card-header">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file-img">
                                                เลือกรูปภาพ <input type="file" id="imgInp" name="pic">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img id='img-upload' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/managegold')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />
@endsection