@extends('layouts.master')
@section('title','แก้ไขข้อมูลทอง')
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
                    <h1>แก้ไขข้อมูลทอง</h1>
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
            <h2>แก้ไขข้อมูลทอง</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('ProductDetailController@update', $id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสสินค้า</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtellotid">ล็อต</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="code" type="text" class="form-control" placeholder="" value="{{$productdetail->code}}" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="lot_id" class="form-control" id="userID" id="validationtellotid" required>
                                <option value="0" label="เลือกล๊อต">เลือกล็อต</option>
                                @foreach($product as $row)
                                <option value="{{$row->lot_id}}" {{$row->lot_id == $productdetail->lot_id ? 'selected' : ''}}>{{$row->lot_id}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกล็อตที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationcategory">ประเภท</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationstriped">ลาย</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="type_gold_id" id="validationcategory" required>
                                <option selected disabled value="">เลือกหน่วยนับ</option>
                                @foreach($producttype as $row)
                                <option value="{{$row->id}}" {{$row->id == $productdetail->type_gold_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกหน่วยนับที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="striped_id" id="validationstriped" required>
                                <option selected disabled value="">เลือกลาย</option>
                                @foreach($striped as $row)
                                <option value="{{$row->id}}"{{$row->id == $productdetail->striped_id ? 'selected' : ''}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกประเภทที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationtelcategory">นํ้าหนัก</h4>
                    </div>
                    <div class="col-6">
                        <h4>นํ้าหนัก(กรัม)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" name="size" id="validationcategory" required>
                                <!-- <option selected>เลือกหน่วยนับ</option> -->
                                @foreach(["ครึ่งสลึง"=>"ครึ่งสลึง","1 สลึง"=>"1 สลึง","2 สลึง"=>"2 สลึง","3 สลึง"=>"3 สลึง","6 สลึง"=>"6 สลึง","1 บาท"=>"1 บาท","2 บาท"=>"2 บาท","3 บาท"=>"3 บาท","4 บาท"=>"4 บาท","5 บาท"=>"5 บาท","10 บาท"=>"10 บาท"] as $sizeWay => $sizeLable)
                                <option value="{{ $sizeWay }}" {{ old("size", $productdetail->size) == $sizeWay ? "selected" : "" }}>{{ $sizeLable }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                โปรดเลือกนํ้าหนักที่ต้องการ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                            <input name="gram" type="text" class="form-control" placeholder="" value="{{$productdetail->gram}}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>ราคาทองต่อเส้น*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationgratuity">ค่าแรงทองต่อเส้น*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$productdetail->price_of_gold}}" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="gratuity" type="text" class="form-control" placeholder="" value="{{$productdetail->gratuity}}" id="validationgratuity" required />
                            <div class="invalid-feedback">
                                โปรดกรอกค่าแรง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationallprice">ราคาทุน*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdetails">รายละเอียด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="allprice" type="text" class="form-control" placeholder="" value="{{$productdetail->allprice}}" id="validationallprice" required />
                            <div class="invalid-feedback">
                                โปรดกรอกราคาทุน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="details" type="text" class="form-control" placeholder="" value="{{$productdetail->details}}" id="validationdetails" required />
                            <div class="invalid-feedback">
                                โปรดกรอกรายละเอียดทอง
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationstatus">สถานะทอง</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtray">ถาด</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="pl-2">
                            <div class="form-group">
                                @foreach($gold_type as $statusWay => $statusLable)
                                <input class="form-check-input" name="status" type="radio" id="validationstatus" required value="{{ $statusWay }}" {{ $productdetail->status == $statusWay ? "checked" : "" }} />
                                <h5 class="form-check-label">{{ $statusLable }}</h5>
                                <div class="invalid-feedback">โปรดเลือกสถานะทองที่ต้องการ</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="tray" type="text" class="form-control" placeholder="" value="{{$productdetail->tray}}" id="validationtray" required />
                            <div class="invalid-feedback">
                                โปรดกรอกถาดที่ต้องการ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>อัพโหลดรูปภาพ</h4>
                    </div>
                </div>
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
                                <div class="single-article-text-image-top">
                                    <p>รูปเดิม</p>
                                </div>
                                <img src="{{ asset('assets/img/gold/'. $productdetail->pic) }}" width="250px" height="250px" alt="Image">
                                <div class="single-article-text-image-bottom">
                                    <p>รูปใหม่</p>
                                    <img id='img-upload' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/productdetail')}}">กลับ</a>
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