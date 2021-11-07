@extends('layouts.master')
@section('title','ตั้งราคาขาย')
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

<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Gold System</p>
                        <h1>ตั้งราคาขาย</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<br /><br />
<h2 class="text-center">ตั้งราคาขาย</h2>
<div class="container">
    <hr class="mt-5 mb-6" />
    <form method="POST" action="{{action('SetPriceController@update', $id)}}" enctype="multipart/form-data">
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
                    <input name="code" type="text" class="form-control" placeholder="" value="{{$managegold->code}}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="details" type="text" class="form-control" placeholder="" value="{{$managegold->details}}" />
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
                    <select class="custom-select" name="unit">
                        <option selected>เลือกหน่วยนับ</option>
                        @foreach(["เส้น"=>"เส้น","แท่ง"=>"แท่ง","วง"=>"วง"] as $unitWay => $unitLable)
                        <option value="{{ $unitWay }}" {{ old("unit", $managegold->unit) == $unitWay ? "selected" : "" }}>{{ $unitLable }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="striped" type="text" class="form-control" placeholder="" value="{{$managegold->striped}}" />
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
                    <input name="bath" type="text" class="form-control" placeholder="" value="{{$managegold->bath}}" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input name="salung" type="text" class="form-control" placeholder="" value="{{$managegold->salung}}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="gram" type="text" class="form-control" placeholder="" value="{{$managegold->gram}}" />
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
                        <option value="{{ $statusWay }}" {{old("status", $managegold->status) == $statusWay ? "selected" : ""}}>{{ $statusLable }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="date_of_import" type="date" class="form-control" value="{{$managegold->date_of_import}}" />
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
                    <input name="tray" type="text" class="form-control" placeholder="" value="{{$managegold->tray}}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="price_of_gold" type="text" class="form-control" placeholder="" value="{{$managegold->price_of_gold}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>ค่ากำเหน็จ</h4>
            </div>
            <div class="col-6">
                <h4>ราคารวม</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input name="gratuity" type="text" class="form-control" placeholder="" value="{{$managegold->gratuity}}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input name="allprice" type="text" class="form-control" placeholder="" value="{{$managegold->allprice}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>รูปภาพ</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <br>
                    <div class="form-group text-center">       
                        <img src="{{ asset('assets/img/gold/'. $managegold->pic) }}" width="250px" height="250px" alt="Image">
                    </div>
                
            </div>
        </div>
        <br />
        <div class="text-right">
            <a type="button" class="btn btn-secondary" href="{{url('/set_price')}}">กลับ</a>
            <button type="submit" class="btn btn-success">อัพเดท</button>
        </div>
        <input type="hidden" name="_method" value="PATCH" />
        <br />
    </form>
</div>

@endsection