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

        .pt-10 {
            padding-top: 10px;
        }

        .pl-10 {
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td width="45%" style="vertical-align: top;border: 1px solid;">
                <table class="wrap-box" cellpadding="0" cellspacing="0" style="padding:10px;">
                    <tr style="padding-left: 10px;">
                        <td><u><span class="header-title">ใบรับซื้อขายฝาก</span></u></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10"><b>วันที่รับฝาก............................</b></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10"><b>ชื่อ-นามสกุล............................</b></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10"><b>รายการขายฝาก............................</b></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10"><b>จำนวน.............ชิ้น นํ้าหนัก............กรัม</b></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10"><b>จำนวนเงิน....................บาท</b></td>
                    </tr>
                    <tr class="pl-10">
                        <td class="pt-10">
                            <div style="background-color: gray; width:50%; margin:auto; text-align:center;">
                                สามพันบาท
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
            <td width="45%" style="vertical-align: top;border: 1px solid;">
                <table class="wrap-box" cellpadding="0" cellspacing="0" style="padding: 10px;">
                    <tr>
                        <td style="padding-bottom:10px;"><u><span class="header-title">ใบรับซื้อขายฝาก</span></u></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:inline-block;padding:0 10px 0 0">วันกำหนดชำระ</div>
                            <div style="display:inline-block;padding:0 10px">วันที่ชำระ</div>
                            <div style="display:inline-block;padding:0 10px">ยอดรับฝากคงเหลือ</div>
                            <div style="display:inline-block;padding:0 10px">ผู้รับชำระ</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%;"><b>.....................................................................................................</b></td>
                    </tr>
                    <tr>
                        <td style="width:50%;"><b>.....................................................................................................</b></td>
                    </tr>
                    <tr>
                        <td style="width:50%;"><b>.....................................................................................................</b></td>
                    </tr>
                    <tr>
                        <td style="width:70%;"><b>.....................................................................................................</b></td>
                    </tr>
                    <tr>
                        <td style="width:50%;"><b>.....................................................................................................</b></td>
                    </tr>
                    <tr>
                        <td style="width:50%;"><b>.....................................................................................................</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </tr>
    <!-- <tr>

        </tr> -->
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:left; width:50%;"><u><span class="header-title">ใบรับซื้อขายฝาก</span></u></td>
            <td>วันกำหนดชำระ</td>
            <td>วันที่ชำระ</td>
            <td>ยอดรับฝากคงเหลือ</td>
            <td>ผู้รับชำระ</td>
        </tr>
    </table>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>วันที่รับฝาก............................</b></td>
            <td style="width:50%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>ชื่อ-นามสกุล............................</b></td>
            <td style="width:50%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>รายการขายฝาก............................</b></td>
            <td style="width:50%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:20%;"><b>จำนวน.............ชิ้น</b></td>
            <td style="width:50%;"><b>นํ้าหนัก............กรัม</b></td>
            <td style="width:70%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>จำนวนเงิน....................บาท</b></td>
            <td style="width:50%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style=" width:50%;">
                <div style="background-color: gray; width:50%; margin:auto; text-align:center;">
                    สามพันบาท
                </div>
            </td>
            <!-- <td style="width:25%;"></td> -->
            <td style="width:50%;"><b>........................................................................................................</b></td>

        </tr>
    </table>
    <br>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:left; width:50%;"><u><span class="header-title">ใบรับซื้อขายฝาก</span></u></td>
            <td style="text-align:left; width:50%;"><u><span class="header-title">ใบรับซื้อขายฝาก</span></u></td>
        </tr>
    </table>
    <br>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>วันที่รับฝาก............................</b></td>
            <td style="width:50%;"><b>วันที่รับฝาก............................</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>ชื่อ-นามสกุล............................</b></td>
            <td style="width:50%;"><b>ชื่อ-นามสกุล............................</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>เบอร์มือถือ............................</b></td>
            <td style="width:50%;"><b>เบอร์มือถือ............................</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:20%;"><b>นํ้าหนัก............กรัม</b></td>
            <td style="width:50%;"><b>จำนวนเงิน............บาท</b></td>
            <td style="width:70%;"><b>ที่อยู่ปัจจุบัน.....................</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:15%;">วันกำหนดชำระ</td>
            <td style="width:10%;">วันที่ชำระ</td>
            <td style="width:20%;">ยอดรับฝากคงเหลือ</td>
            <td style="width:20%;">ผู้รับชำระ</td>
            <td style="width:65%;"><b>รายการขายฝาก............................</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:70%;"><b>..........................................................................................</b></td>
            <td style="width:20%;"><b>จำนวน.............ชิ้น</b></td>
            <td style="width:50%;"><b>นํ้าหนัก............กรัม</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>..........................................................................................</b></td>
            <td style="width:50%;"><b>จำนวนเงิน............บาท</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>..........................................................................................</b></td>
            <td style="width:50%;"><b>ลงชื่อ............ผู้ขายฝาก</b></td>
        </tr>
    </table>
    <table class="wrap-box" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width:50%;"><b>..........................................................................................</b></td>
            <td></td>
        </tr>
    </table>
</body>

</html>