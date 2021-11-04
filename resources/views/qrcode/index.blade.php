<div style="text-align: center">
    <h1>QRCodes de devoirs</h1>
</div>
<div class="row" style="display: flex; flex-wrap: wrap; padding-left: 40px">
    @foreach ($qrcodes as $qr)
        <div style="width: 25%; margin-right: 40px; margin-bottom: 40px">{!! DNS2D::getBarcodeHTML($qr, 'QRCODE', 7, 7) !!}</div>
    @endforeach
</div>

<script>
    window.print();
    window.addEventListener('afterprint', (event) => {
       // window.history.back();
    });

</script>

