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
            font-size: 25px;
            font-weight: bold;
        }

        b {
            font-size: 19px;
            font-weight: bold;
        }

        .details {
            font-size: 19px;
        }
    </style>
</head>

<body>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:center"><u><span class="header-title">ใบรับซื้อขายฝากทอง</span></u>
            </td>
        </tr>
    </table>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>วันที่____________________________________________</b></td>
            <td style="width:20%;"><b>เล่มที่______________</b></td>
            <td style="width:30%;"><b>เลขที่_________________________</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%; padding-top: 5px; padding-bottom: 5px;"><b>ชื่อ </b>&nbsp;&nbsp;{{$form[0]->namecustomer}} {{$form[0]->lastnamecustomer}}</td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding-top: 10px; padding-bottom: 10px;" class="details">
                ได้รับเงินจาก ห้างหุ้นส่วนจำกัด มาทอง เยาราช (สำนักงานใหญ่) เลขประจำตัวผู้เสียภาษี 0803564001495
                เลขที่ 158 หมู่ที่ 1 ตำบลขนอม อำเภอขนอม จังหวัดนครศรีธรรมราช ดังรายการต่อไปนี้
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
                        <th style="width:10%;">จำนวน</th>
                        <th style="width:20%;">ราคาต่อหน่วย</th>
                        <th style="width:19%;">น้ำหนัก</th>
                        <th style="width:27%;">จำนวนเงิน(บาท)</th>
                    </tr>
                    
                    <tr>
                        <td colspan="4" style="text-align: left;">(ตัวอักษร)</td>
                        <td style="font-weight: bold; text-align:center;"> รวมเป็นเงิน</td>
                        <td align="right"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding-top: 10px; padding-bottom: 10px;" class="details">
                ข้าพเจ้าขอรับรองวำทรัพย์สินที่นำมาขายเป็นกรรมสิทธิ์ของข้าพเจ้าโดยแท้จริง และขอรับรองว่าทรัพย์สินที่นำมาขายนั้น
                เป็นทรัพย์สินที่บริสุทธิ์ ถ้าหากเป็นของทุจริตแล้ว ข้าพเจ้าขอรับผิดชอบทั้งสิ้น ข้าพเจ้าได้อ่านและรับเงินเรียบร้อยแล้ว
                จึงลงนามไว้เป็นหลักฐาน
            </td>

        </tr>
    </table>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:center"><b>ลงชื่อ...................................................ผู้รับสินค้า / Receiver</b><br /> </td>
            <td style="text-align:center"><b>ลงชื่อ...................................................ผู้รับเงิน / Collector</b><br /> </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;"><b>วันที่ / Date.........................................</b><br /> </td>
            <td style="padding-left: 20px;"><b>วันที่ / Date.........................................</b><br /> </td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding-left: 20px;">
                <p>หมายเหตุ : แนบสำเนาบัตรประชาชนของผู้รับเงิน / ผู้ขาย</p><br />
            </td>
        </tr>
    </table>




</body>

</html>