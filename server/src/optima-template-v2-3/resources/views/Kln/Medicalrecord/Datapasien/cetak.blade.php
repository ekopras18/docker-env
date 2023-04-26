<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Cetak Kartu Pasien</title>
</head>

<style>
  @page {
    margin: 0in;
  }

  body {
    background-color: #0C6839;
    padding: 25px 10px 20px 10px;
    color: white;
    font-family:"Arial, Helvetica, sans-serif";
  }
</style>

<body>

  <table style="width:100%">
    <tr>
      <td style="width: 60%;">
        <table style="width: 100%;">
          <tr>
            <td style="width: 20%;"><img src="{{ $data['logo'] }}" height="40px" width="40px"></td>
            <td style="font-size:14px"><b> KLINIK {{strtoupper($data['company'])}}</b> <br>
              <b> <span style="font-size: 10px;">{{$data['detail']}}, {{$data['lokasi']}}</span></b>
            </td>
          </tr>
          <br>
          <tr>
            <td colspan="2" style="font-size: 13px;"><b>{{$data['listdata'][0]->namaumur}}</b></td>
          </tr>
          <br>
          <tr>
            <td colspan="2" style="font-size: 10px;">
              <ul style="padding-left: 7px;">
                <li>{{$data['listdata'][0]->msPasRm}}</li>
                <li>{{$data['listdata'][0]->msPasTlp}}</li>
                <li>{{$data['listdata'][0]->msPasAlamat}}</li>
              </ul>
            </td>
          </tr>
        </table>
      </td>
      <td><img src="data:image/png;base64, {{ base64_encode($data['qr']) }}" style="width: 170px;height:170px"></td>
    </tr>
  </table>
</body>

</html>