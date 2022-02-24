<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }

        table {
            border-collapse: collapse;
        }

        .table-bor td,
        th {
            border: 1px solid;
        }

        table.wrap-box {
            width: 100%;
            text-align: left;
            line-height: 97%;
        }

        table.wrap-top {
            width: 100%;
            text-align: left;
            line-height: 97%;
        }

        table.wrap-content,
        table.wrap-total {
            width: 100%;
            text-align: left;
            line-height: 97%;
        }

        table.wrap-content tr th {
            font-weight: bold;
            text-align: center;
            background-color: #eee;
        }

        table.wrap-content tr td {
            border-bottom-color: #ddd;
            border-bottom-style: solid;
            border-bottom-width: 0.5px;
        }

        table.wrap-total tr td {
            text-align: right;
        }

        .line-top {
            border-top: 1px solid #ccc;
        }

        .line-bottom {
            border-bottom: 1px solid #ccc;
        }

        .line-left {
            border-left: 1px solid #ccc;
        }

        .line-right {
            border-right: 1px solid #ccc;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 60%;"><span class="header-title">ห้างหุ้นส่วนจำกัด มาทอง เยาราช (สำนักงานใหญ่)</span>
                <br /> เลขที่ 158 หมู่ที่ 1 ตำบลขนอม อำเภอขนอม จังหวัดนครศรีธรรมราช
                <br /> โทรศัพท์ 086-6947040 เลขที่ประจำตัวผู้เสียภาษี Tax ID : 0803564001495
            </td>
            <td style="text-align: right;width: 40%;"><span class="header-title">ใบกำกับภาษี/ใบเสร็จรับเงิน</span>
                <br />
                เล่มที่ ...................... เลขที่......................<br />
                วันที่.........................................................
            </td>
        </tr>
    </table>
    <br>
    <div class="line"></div>

    <table class="wrap-box line-top" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:60%;">
                <table class="wrap-top" cellpadding="3" cellspacing="0">
                    <tr>
                        <td style="width:20%;"><b>ชื่อลูกค้า</b></td>
                        <td style="width:80%;"></td>
                    </tr>
                    <tr>
                        <td><b>ที่อยู่</b></td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="wrap-top" cellpadding="3" cellspacing="0">
                    <tr>
                        <td style="width:25%;"><b>เลขผู้เสียภาษี</b></td>
                        <td style="width:75%;"></td>
                    </tr>
                    <br>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <table class="wrap-box table-bor" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="wrap-content" cellpadding="3" cellspacing="0">
                    <tr>
                        <th style="width:6%;">ลำดับที่</th>
                        <th style="width:44%;">รายการสินค้า</th>
                        <th style="width:23%;">น้ำหนัก(กรัม)</th>
                        <th style="width:27%;">จำนวนเงิน(บาท)</th>
                    </tr>
                    <tr>
                        <td style="text-align:center;"></td>
                        <td></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table class="wrap-box table-bor" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="wrap-total" cellpadding="3" cellspacing="0">
                    <tr>
                        <td style="width: 60%; text-align:left">ทองคำแท่งซื้อเข้า บาทละ : </td>
                        <td style="width: 20%; font-weight: bold;">ราคาสินค้ารวมค่ากำเหน็จก่อนภาษี</td>
                        <td style="width: 20%;"> บาท</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">ทองคำแท่งขายออก บาทละ : </td>
                        <td style="font-weight: bold;">ส่วนลด</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td style="text-align:left">ทองรูปพรรณรับซื้อคืน บาทละ : </td>
                        <td style="font-weight: bold;">หักราคาซื้อทองประจำวัน</td>
                        <td> บาท</td>
                    </tr>

                    <tr>
                        <td style="text-align:left">ทองรูปพรรณรับซื้อคืน กรัมละ : </td>
                        <td style="font-weight: bold;">จำนวนส่วนต่างฐานภาษี</td>
                        <td> บาท</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-weight: bold;">ภาษีมูลค่าเพิ่ม 7%</td>
                        <td> บาท</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;background-color:#A2A2A2 ">(ตัวอักษร)</td>
                        <td style="font-weight: bold;"> รวมรับเงินสุทธิ</td>
                        <td> บาท</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:center"><b>ลงชื่อ...................................................ผู้รับสินค้า / Receiver</b><br /> </td>
            <td style="text-align:center"><b>ลงชื่อ...................................................ผู้รับเงิน / Collector</b><br /> </td>
        </tr>
        <tr>
            <td style="padding-left: 45px;"><b>วันที่ / Date.........................................</b><br /> </td>
            <td style="padding-left: 45px;"><b>วันที่ / Date.........................................</b><br /> </td>
        </tr>
    </table>



</body>

</html>