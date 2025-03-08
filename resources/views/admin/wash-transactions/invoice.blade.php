<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            text-align: center;
            width: 100%;
        }

        .invoice-container {
            max-width: 80mm;
            margin: auto;
            padding: 10px;
            border-bottom: 1px dashed #000;
        }

        .header {
            text-align: center;
        }

        .logo img {
            width: 50px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 3px 0;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('storage/images/' . setting()->small_icon) }}" alt="Logo">
            </div>
            <h2>{{ setting()->name }}</h2>
            <p style="font-size:8px ">{{ setting()->address }}</p>
        </div>

        <h2>Invoice</h2>

        <p><strong>No:</strong> {{ $washTransaction->transaction_number }}</p>
        <p><strong>Tanggal & Waktu:</strong>
            {{ now()->format('d-m-Y H:i:s') }}</p>
        <p><strong>Jenis Kendaraan:</strong> {{ $washTransaction->washTransactionDetail->vehicle->name ?? '' }}</p>
        <p><strong>Nomor Plat:</strong> {{ $washTransaction->washTransactionDetail->plate_number }}</p>

        <table>
            <tr>
                <td>Biaya</td>
                <td class="text-right">
                    {{ toRupiah($washTransaction->total_cost - $washTransaction->washTransactionDetail->additional_cost) }}
                </td>
            </tr>
            <tr style="border-bottom: 1px dashed #000;">
                <td>Biaya Tambahan</td>
                <td class="text-right">{{ toRupiah($washTransaction->washTransactionDetail->additional_cost) }}</td>
            </tr>
            <tr style="border-bottom: 1px dashed #000;" class="total">
                <td>Total</td>
                <td class="text-right">{{ toRupiah($washTransaction->total_cost) }}</td>
            </tr>
            <tr>
                <td>Total Bayar</td>
                <td class="text-right">{{ toRupiah($washTransaction->payment_amount) }}</td>
            </tr>
            <tr>
                <td>Total Kembalian</td>
                <td class="text-right">{{ toRupiah($washTransaction->change_amount) }}</td>
            </tr>
        </table>

        <p><strong>PIC:</strong> {{ $washTransaction->washer->name ?? '' }}</p>
        <div style="text-align: right;">
            <p>
                {{ $washTransaction->updatedBy ? $washTransaction->updatedBy->name : $washTransaction->createdBy->name }}
            </p>
            <br>
            <p>Kasir
            </p>
        </div>
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>=====</p>
    </div>
</body>

</html>
