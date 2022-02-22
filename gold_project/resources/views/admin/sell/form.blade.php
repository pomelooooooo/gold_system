@extends('layouts.form')
@section('title','ใบเสร็จรับเงิน/ใบกำกับภาษี')
@section('content')

<table class="wrap-box" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width: 60%;"><span class="header-title">ห้างทองมาทอง</span>
            <br /> ที่อยู่
            <br /> เลขที่ประจำตัวผู้เสียภาษี
        </td>
        <td style="text-align: right;width: 40%;"><span class="header-title">ใบกำกับภาษี/ใบเสร็จรับเงิน</span><br/>123456</td>
    </tr>
</table>
<div class="line"></div>

<table class="wrap-box line-top" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:70%;"><table class="wrap-top" cellpadding="3" cellspacing="0">
                <tr>
                    <td style="width:20%;"><b>รหัสลูกค้า</b></td>
                    <td style="width:80%;">123456</td>
                </tr>
                <tr>
                    <td><b>ชื่อลูกค้า</b></td>
                    <td>Name Surname</td>
                </tr>
                <tr>
                    <td><b>ที่อยู่</b></td>
                    <td>address</td>
                </tr>
                <tr>                    
                    <td colspan="2"><b>เบอร์โทร</b> 092666666, <b>แฟกซ์</b> 18584212120</td>
                </tr>
                <tr>
                    <td colspan="2"><b>เลขประจำตัวผู้เสียภาษี</b> 3954542154</td>
                </tr>
            </table>
        </td>
        <td><table class="wrap-top" cellpadding="3" cellspacing="0">
                <tr>
                    <td style="width:25%;"><b>เลขที่เอกสาร</b></td>
                    <td style="width:75%;">12/45/4411</td>
                </tr>
                <tr>
                    <td><b>วันที่เอกสาร</b></td>
                    <td>12/45/4411></td>
                </tr>
                <tr>
                    <td><b>วันที่ครบกำหนด</b></td>
                    <td>12/45/4411</td>
                </tr>
                <tr>
                    <td><b>เอกสารอ้างอิง</b></td>
                    <td>9999999</td>
                </tr>
                <tr>
                    <td><b>ผู้ติดต่อ</b></td>
                    <td>sssssssss</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div class="line"></div>
<table class="wrap-box" cellpadding="0" cellspacing="0">
    <tr>
        <td><table class="wrap-content" cellpadding="3" cellspacing="0">
            <tr>
                <th style="width:5%;">#</th>                
                <th style="width:55%;">รายละเอียด</th>
                <th style="width:13%;">จำนวน</th>
                <th style="width:12%;">ราคา/หน่วย</th>
                <th style="width:15%;">รวม</th>
            </tr>
           
                <tr>
                    <td style="text-align:center;"></td>                    
                    <td></td>
                    <td style="text-align:right;"></td>
                    <td style="text-align:right;"></td>
                    <td style="text-align:right;"></td> 
                </tr>

        </table></td>
    </tr>
</table>


    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td><table class="wrap-total" cellpadding="3" cellspacing="0">
                    <tr>
                        <td style="width: 60%"></td>
                        <td style="width: 20%; font-weight: bold;">รวมทั้งหมด</td>
                        <td style="width: 20%;">5000 บาท</td>
                    </tr>                    
                        <tr>
                            <td>&nbsp;</td>
                            <td style="font-weight: bold;">ส่วนลด</td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td style="font-weight: bold;">ราคาหลังหักส่วนลด</td>
                            <td> บาท</td>
                        </tr>    
                                   
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-weight: bold;">ภาษีมูลค่าเพิ่ม 7%</td>
                        <td> บาท</td>
                    </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style="font-weight: bold;">ราคาไม่รวมภาษี</td>
                            <td> บาท</td>
                        </tr>
                    <tr>
                        <td style="text-align: center;">()</td>
                        <td style="font-weight: bold;"> รวมสุทธิทั้งหมด</td>
                        <td> บาท</td>
                    </tr>
                    <tr>
                        <td style="width: 50%"></td>
                        <td style="width: 10%"></td>
                        <td style="border-top: 0.5px solid #ccc; width: 40%;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

        <table class="wrap-box" cellpadding="0" cellspacing="0">
            <tr>
                <td><b>หมายเหตุ</b><br />
               
                </td>
            </tr>
        </table>
@endsection