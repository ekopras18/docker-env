<x-templete_top :data="$data" />
<style>
  .card-header {
    padding: 0.5rem 1.25rem !important;
  }

  .input-group>.select2-container--bootstrap {
    width: auto !important;
    flex: 1 1 auto;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card rounded-left-0">
      <div class="card-header header-element-inline">
        <div class="header-elements" style="text-align: right;">
          <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
          </div>
        </div>
      </div>
      <div class="card-body">

        <form action="/{{$mainroute}}" method="GET" id="myForm">
          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2" style="text-align: right;">
              <label style="font-size: 12px;"><b>PERIODE <font color="red">*</font></b></label>
            </div>
            <div class="col-md-2">
              <div class="form-group" style="margin: 3px;">
                <input type="date" placeholder="Masukan Tanggal Awal" class="form-control" id="tgawal" name="tgawal" required>
                <small class="form-text text-muted">Tanggal Awal Wajib Diisi</small>
              </div>
            </div>
            <div class="col-md-1" style="text-align: center;">
              <label style="font-size: 12px;"><b>S/D</b></label>
            </div>
            <div class="col-md-2">
              <div class="form-group" style="margin: 3px;">
                <input type="date" placeholder="Masukan Tanggal Akhir" class="form-control" id="tgakhir" name="tgakhir" required>
                <small class="form-text text-muted">Tanggal Akhir Wajib Diisi</small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2" style="text-align: right;">
              <label style="font-size: 12px;"><b>KATEGORI PENDAFTARAN <font color="red">*</font></b></label>
            </div>
            <div class="col-md-5">
              <div class="form-group" style="margin: 3px;">
                <div class="input-group">
                  <select class="custom-select form-control js-states" id="kategori" name="kategori" onchange="selectChange()" required>
                    <option value="">Pilih Kategori</option>
                    <option value=1>Keseluruhan</option>
                    <option value=2>Rawat Jalan</option>
                    <option value=3>IGD</option>
                  </select>
                  <div class="input-group-append">
                    <a href="{{url('/')}}/kln-laporan-pendaftaran"><button type="button" class="btn btn-light"><i class="icon-spinner11" data-toggle="tooltip" data-placement="top" title="Reset Data"></i> </button></a>
                  </div>
                </div>
                <small class="form-text text-muted">Kategori Pendafataran Wajib Diisi</small>
              </div>
              <script>
                // dibuka klo dropdownnya bnyak
                $(".custom-select").select2({
                  theme: "bootstrap",
                  // width: '88%',
                  // dropdownAutoWidth: true,
                  // allowClear: true,
                  // placeholder: "Kategori Pendaftaran"
                });
              </script>
            </div>
          </div>
          <br>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header row pb-0">
        <div class="col-md-12 col-sm-12 text-left mb-1 mt-1">
          <div id="content">
            <div align="center" class="header-cetak">
              <br>
              <h5 style="line-height: 18px;"><b>{{$judul}} {{$kat}}</b></h5>
              <h5 style="line-height: 18px;"><b>KLINIK {{strtoupper($company)}}</b></h5>
              <p style="font-size: 12px;">PERIODE {{$tgawal}} S/D {{$tgakhir}}</p>
            </div>
            <?php
            $tgawal = !empty($_GET['tgawal']) ? $_GET['tgawal'] : '00-00-0000';
            $tgakhir = !empty($_GET['tgakhir']) ? $_GET['tgakhir'] : '00-00-0000';
            $kategori = !empty($_GET['kategori']) ? $_GET['kategori'] : '0';
            $title =  $judul . ' ' . $kat;
            ?>
            <div class="panel panel-flat">
              <div class="table-responsive">
                @php $cols = count($grid)+1; @endphp
                <table id="table" class="table table-striped table-xs table-hover" style="width:100%; border-collapse: collapse;">
                  <thead>
                    <tr>
                      <td colspan="{{$cols}}" class="text-right pb-2"><a href="{{url('/')}}/kln-laporan-pendaftaran-cetak/{{$tgawal}}/{{$tgakhir}}/{{$kategori}}" target="_blank"><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Download Pdf"><i class="icon-file-pdf"></i> Export PDF</button></a>
                        <a href="{{url('/')}}/kln-laporan-pendaftaran-cetak/excel/{{$tgawal}}/{{$tgakhir}}/{{$kategori}}/{{$title}}" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Download Excel"><i class="icon-file-excel"></i> Export Excel</button></a>
                      </td>
                    </tr>
                    <tr class="judul">
                      <th>NO</th>
                      @foreach($grid as $datagrid)
                      <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @if(!$listdata->isEmpty())
                    @php
                    $rowIndex=-1;
                    @endphp

                    @foreach($listdata as $key => $data)
                    <tr>
                      <td>
                        <center>{{$key+1}}</center>
                      </td>
                      @php
                      $pmKey=$data->$primaryKey;
                      $rowIndex ++;
                      @endphp

                      @foreach($grid as $datagrid)
                      @php
                      $field=$datagrid['field'];
                      $value=$data->$field;
                      @endphp
                      <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{{$value}} </td>
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
                <a id="dlink" style="display:none;"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function selectChange() {
    //Set the value of action in action attribute of form element.
    //Submit the form
    $('#myForm').submit();
  }
</script>
</script>
<x-templete_bottom />