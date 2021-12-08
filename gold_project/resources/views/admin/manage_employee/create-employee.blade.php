@extends('layouts.master')
@section('title','เพิ่มข้อมูลพนักงาน')
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
        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var data = {
                picture: $('#img-upload').attr('src'),
            };
            formData.append("data", JSON.stringify(data));
            $.ajax({
                url: "{{route('manage_employee.store')}}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    window.location = "{{route('manage_employee.index')}}"
                },
                cache: false,
                contentType: false,
                processData: false
            });
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

    function openConnection() {
        // uses global 'conn' object
        if (conn.readyState === undefined || conn.readyState > 1) {

            conn = new WebSocket('ws://localhost:8100');

            conn.onopen = function() {
                conn.send("Connection Established Confirmation");
            };

            conn.onmessage = function(event) {
                //*********************************************//
                //****  Web Socket Server ***//
                //*********************************************//	

                var rawStr = event.data.toString(); // Split with '@'
                var res = rawStr.split('@');
                console.log(res);

                // Connected
                if (res[0] == "Connected") {
                    document.getElementById("content").innerHTML = rawStr;
                }
                var strtitle1 = ["-", "ID Card : ", "TH_Prefix :", "TH_Firstname : ", "TH_Lastname : ", "Sex : ", "Birthday : ", "EN_Prefix : ", "EN_Firstname : ", "EN_Lastname : ", "Issue : ", "Expire : ", "Address House No : ", "image"]

                var strtitle2 = ["-", "DocumentNo : ", "Familyname : ", "Givenname : ", "Birthday : ", "PersonalNo : ", "Nationality : ", "Sex : ", "Dateofexpiry : ", "IssueState : ", "image"]

                var img = "";
                var text = "";
                var _card = "";

                /////thaiid

                if (res[0] == "thaiid") {
                    img = "1";

                    for (i = 1; i <= res.length - 2; i++) {
                        _card += res[i] + "@";
                    }

                    for (i = 1; i < res.length - 2; i++) {
                        text += strtitle1[i] + res[i] + "<br>";

                    }
                    document.getElementById('img-upload').src = "data:image/png;base64," + res[13];
                    $('#name').val(res[3]);
                    document.getElementById("lastname").value = res[4];
                    document.getElementById("idcard").value = res[1];
                    document.getElementById("address").value = res[12];
                    $('#date_card_start').val(res[10]);
                    $('#date_card_end').val(res[11]);

                }


                /////img
                // if (img == "") {

                //     document.getElementById("chk").style.display = "none";
                //     document.getElementById("chk2").style.display = "none";
                // } else {

                //     document.getElementById("chk").style.display = "block";
                //     document.getElementById("chk2").style.display = "block";
                // }

            };

            conn.onerror = function(event) {
                // Web Socket Error
                document.getElementById("content").innerHTML = "Web Socket Error";
            };


            conn.onclose = function(event) {
                // Web Socket Closed
                document.getElementById("content").innerHTML = "Web Socket Closed";

            };
        }
    }


    // function send app server
    function doScan() {


        conn.send("thaiidauto");

    }

    function doScanpassport() {
        conn.send("passportwithphoto");

    }

    function Clear() {

        document.getElementById("content_idcard1").innerHTML = "";
        document.getElementById("content_idcard").innerHTML = "";
        document.getElementById("content_passport1").innerHTML = "";
        document.getElementById("content_passport").innerHTML = "";
        document.getElementById("chk").style.display = "none";
        document.getElementById("chk2").style.display = "none";
    }

    $(document).ready(function() {
        conn = {}, window.WebSocket = window.WebSocket || window.MozWebSocket;

        openConnection();
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
                    <h1>เพิ่มข้อมูลพนักงาน</h1>
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
            <h2>เพิ่มข้อมูลพนักงาน</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('manage_employee.store')}} " enctype="multipart/form-data" id="data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationusername">ชื่อผู้ใช้*</h4>
                    </div>
                    <div class="col-3">
                        <h4 for="validationemail">อีเมล*</h4>
                    </div>
                    <div class="col-3">
                        <h4 for="validationpassword">พาสเวิส*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="username" id="username" type="text" class="form-control" placeholder="" id="validationusername" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อผู้ใช้
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="email" id="email" type="mail" class="form-control" placeholder="" id="validationemail" required />
                            <div class="invalid-feedback">
                                โปรดกรอกอีเมล
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input name="password" id="password" type="text" class="form-control" placeholder="" id="validationpassword" required />
                            <div class="invalid-feedback">
                                โปรดกรอกพาสเวิส
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationname">ชื่อ*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationlastname">นามสกุล*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="name" id="name" type="text" class="form-control" placeholder="" id="validationname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกชื่อ
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="" id="validationlastname" required />
                            <div class="invalid-feedback">
                                โปรดกรอกนามสกุล
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationid">เลขบัตรประชาชน*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationtel">เบอร์โทร*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="idcard" id="idcard" type="text" class="form-control" placeholder="" id="validationid" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเลขบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="telephone" type="text" class="form-control" placeholder="" id="validationtel" required />
                            <div class="invalid-feedback">
                                โปรดกรอกเบอร์โทร
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationaddress">ที่อยู่ตามบัตรประชาชน*</h4>
                    </div>
                    <div class="col-6">
                        <h4>ที่อยู่ปัจจุบัน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address" id="address" type="text" class="form-control" placeholder="" id="validationaddress" required />
                            <div class="invalid-feedback">
                                โปรดกรอกที่อยู่ตามบัตรประชาชน
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="address_now" id="address_now" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 for="validationdatecardstart">วันออกบัตร*</h4>
                    </div>
                    <div class="col-6">
                        <h4 for="validationdatecardend">วันบัตรหมดอายุ*</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_start" id="date_card_start" type="text" class="form-control" placeholder="" id="validationdatecardstart" required />
                            <div class="invalid-feedback">
                                โปรดกรอกวันออกบัตร
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input name="date_card_end" id="date_card_end" type="text" class="form-control" placeholder="" id="validationdatecardend" required />
                            <div class="invalid-feedback">
                                โปรดกรอกวันบัตรหมดอายุ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4>อัพโหลดภาพบัตรประชาชน*</h4>
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
                                                เลือกรูปภาพ <input type="file" id="imgInp">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img id='img-upload' name="picture" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{url('/manage_employee')}}">กลับ</a>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>
<br />

@endsection