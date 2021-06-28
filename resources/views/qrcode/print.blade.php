<table class="table table-bordered">
    <tr>
      <th>
        <div id="qrcode"></div>
      </th>
      <td>
        <img src="{{ asset('assets/IPB.png') }}">
      </td>
      <td>Property Of IPB</td>
      <td>{{ $item->KodeBarang}}</td>
    </tr>
</table>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
<script src="/qrcode.min.js"></script>
    <script type="text/javascript">
        new QRCode(document.getElementById("qrcode"), "{{$item->id}}");
</script>