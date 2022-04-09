@extends('layouts.master')
@section('title','แก้ไขประเภททอง')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('keyup', '#validationid', function() {
            $.ajax({
                url: "/type_gold/validateCategory/" + $(this).val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status) {
                        $('#validate_category').css('display', 'none')
                    } else {
                        $('#validate_category').css('display', 'block')
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $(document).on('keyup', '#validationtype', function() {
            $.ajax({
                url: "/type_gold/validateName/" + $(this).val(),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status) {
                        $('#validate_name').css('display', 'none')
                    } else {
                        $('#validate_name').css('display', 'block')
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('type_gold.store')}}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        window.location = "{{route('type_gold.index')}}"
                    } else {
                        $('#validate_code').css('display', 'block')
                        $("#validate_code").focus();
                        $('#validate_name').css('display', 'block')
                        $("#validate_name").focus();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

     });
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<!-- hero area -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p class="subtitle">Gold System</p>
                    <h1>แก้ไขประเภททอง</h1>
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
                <h2>แก้ไขประเภททอง</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{action('TypeGoldController@update', $id)}}" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>รหัสประเภททอง <span style="color: red;"> *</span></h4>
                    </div>
                    <div class="col-6">
                        <h4>ชื่อประเภท <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="category" type="text" class="form-control" placeholder="" id="validationid" value="{{$type->category}}" />
                            <div class="invalid-feedback" style="display: none;" id="validate_category">
                            รหัสประเภททองซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกรหัสประเภททอง
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder=""  id="validationtype" value="{{$type->name}}" />
                            <div class="invalid-feedback" style="display: none;" id="validate_name">
                            ชื่อประเภทซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อประเภททอง
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/type_gold')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">อัพเดท</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
                <br />
            </form>
        </div>
    </div>
</div>
<br>

@endsection