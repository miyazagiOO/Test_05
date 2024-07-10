<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสนอราคา</title>
    <style>
        body { font-family: 'TH Sarabun New', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; }
        .right { text-align: right; }
        .center { text-align: center; }
        .red { color: red; }
        input { width: 100%; border: none; font-family: inherit; font-size: inherit; }
        input:focus { outline: none; background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 class="center">ใบเสนอราคา บริษัท ดิจิทัลเทคโนโลยี</h2>
    <p class="center">123 ต.หนองกองเกาะ อ.เมือง จ.หนองคาย 43000</p>
    
    <table>
        <tr>
            <td>ชื่อลูกค้า <input type="text" id="customerName"></td>
            <td>เลขที่ใบเสนอราคา <input type="text" id="quoteNumber"></td>
        </tr>
        <tr>
            <td>เลขที่ผู้เสียภาษี <input type="text" id="taxId"></td>
            <td>วันที่ <input type="date" id="quoteDate" value="<?php echo date('Y-m-d'); ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่ <input type="text" id="address"></td>
            <td></td>
        </tr>
        <tr>
            <td>เบอร์ติดต่อ <input type="text" id="contact"></td>
            <td></td>
        </tr>
    </table>

    <table id="itemsTable">
        <tr>
            <th>ลำดับที่</th>
            <th>รายการสินค้า หรือบริการ</th>
            <th>จำนวน</th>
            <th>ราคาต่อหน่วย</th>
            <th>จำนวนเงิน</th>
        </tr>
        <tr>
            <td class="center">1</td>
            <td><input type="text" onchange="calculateTotal()"></td>
            <td><input type="number" class="center" onchange="calculateTotal()"></td>
            <td><input type="number" class="right" onchange="calculateTotal()"></td>
            <td class="right red"></td>
        </tr>
        <tr>
            <td colspan="4" class="right">ราคารวม</td>
            <td id="total" class="right red">0</td>
        </tr>
        <tr>
            <td colspan="4" class="right">ภาษีมูลค่าเพิ่ม (VAT 7%)</td>
            <td id="vat" class="right red">0</td>
        </tr>
        <tr>
            <td colspan="4" class="right">ราคารวมทั้งหมด</td>
            <td id="grandTotal" class="right red">0</td>
        </tr>
    </table>

    <button onclick="addRow()">เพิ่มรายการ</button>

    <script>
        function addRow() {
            const table = document.getElementById('itemsTable');
            const newRowIndex = table.rows.length - 3;
            const newRow = table.insertRow(newRowIndex);
            newRow.innerHTML = `
                <td class="center">${newRowIndex}</td>
                <td><input type="text" onchange="calculateTotal()"></td>
                <td><input type="number" class="center" onchange="calculateTotal()"></td>
                <td><input type="number" class="right" onchange="calculateTotal()"></td>
                <td class="right red"></td>
            `;
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.getElementById('itemsTable').rows;
            for (let i = 1; i < rows.length - 3; i++) {
                rows[i].cells[0].textContent = i; // อัพเดตลำดับที่
                const quantity = parseFloat(rows[i].cells[2].getElementsByTagName('input')[0].value) || 0;
                const price = parseFloat(rows[i].cells[3].getElementsByTagName('input')[0].value) || 0;
                const subtotal = quantity * price;
                rows[i].cells[4].textContent = subtotal.toLocaleString('th-TH');
                total += subtotal;
            }
            document.getElementById('total').textContent = total.toLocaleString('th-TH');
            const vat = total * 0.07;
            document.getElementById('vat').textContent = vat.toLocaleString('th-TH');
            const grandTotal = total + vat;
            document.getElementById('grandTotal').textContent = grandTotal.toLocaleString('th-TH');
        }

        window.onload = calculateTotal;
    </script>
</body>
</html>
