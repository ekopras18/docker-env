<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>{{$data['page_tittle']}}</title>
</head>

<style>
  th,
  td {
    padding: 5px;
  }

  body {
    font-family: 'Calibri';
    font-size: 11px;
  }

  #watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
    bottom: 0px;
    right: 0px;
    width: 400px;
    height: 400px;
    opacity: .50;
  }
</style>

<body>
  <div id="watermark"><img src="{{ public_path('assets/images/logo-opnicare-warna.png') }}" height="100%" width="100%"></div>
  <div align="center">
    <table width="100%">
      <tr>
        <td style="width: 18%;text-align:right"><img src="{{ public_path('assets/images/logo-opnicare-warna.png') }}" alt="" width="100px"></td>
        <td style="text-align: center;"><br>
          <h2 style="line-height: 13px;"><b>{{$data['judul']}} {{$data['kategori']}}</b></h2>
          <h2 style="line-height: 13px;"><b>KLINIK {{strtoupper($data['company'])}}</b></h2>
          <p>PERIODE {{$data['tgawal']}} S/D {{$data['tgakhir']}}</p>
          <br>
        </td>
        <td style="width: 18%;"></td>
      </tr>
    </table>
  </div>
  <br>

  <table id="table" style="width:100%; border-collapse: collapse;" border="2">
    @php $cols = count($data['grid'])+1; @endphp
    <thead>
      <tr class="judul">
        <th>NO</th>
        @foreach($data['grid'] as $datagrid)
        <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @if(!$data['listdata']->isEmpty())
      @php
      $rowIndex=-1;
      @endphp
      @foreach($data['listdata'] as $key => $val)
      <tr>
        <td>
          <center>{{$key+1}}</center>
        </td>
        @php
        $rowIndex ++;
        @endphp

        @foreach($data['grid'] as $val2)
        @php
        $isi=$val2['field'];
        $value=$val->$isi;
        @endphp
        <td width="{{$val2['width'] ?? ''}}">{{$value}}</td>
        @endforeach
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="{{$cols}}">
          <center><i class="icon-info22"></i> Data Empty </center>
        </td>
      </tr>
      @endif
    </tbody>
  </table>
</body>

</html>