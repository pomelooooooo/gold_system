@extends('layouts.master')
@section('title','แก้ไขลายทอง')
@section('content')

<script>
    $(document).ready(function() {
        $(document).on('keyup', '#validationname', function() {
            $.ajax({
                url: "/striped/validateName/" + $(this).val(),
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
                url: "{{route('striped.store')}}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        window.location = "{{route('striped.index')}}"
                    } else {
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
                    <h1>แก้ไขลายทอง</h1>
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
                <h2>แก้ไขลายทอง</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" class="needs-validation" action="{{action('StripedController@update', $id)}}" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4>ชื่อลายทอง <span style="color: red;"> *</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="" id="validationname" value="{{$striped->name}}" />
                            <div class="invalid-feedback" style="display: none;" id="validate_name">
                                ชื่อลายทองซ้ำ
                            </div>
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อลายทอง
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/striped')}}">กลับ</a>
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