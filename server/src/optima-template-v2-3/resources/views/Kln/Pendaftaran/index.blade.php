<x-templete_top :data="$data" />

<div class="row">
  <div class="col-md-8">

    <!-- Basic layout-->
    <div class="card border-left-3 border-left-success rounded-left-0">
      <div class="card-header header-elements-inline">
        <h5 class="card-title font-weight-semibold">Data Diri Pasien</h5>
        <div class="header-elements">
          <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
          <div>
            <h6 class="font-weight-semibold"><span class="nama_hidden">-</span><span class="nama"></span></h6>
            <ul class="list list-unstyled mb-0">
              <li><span class="lahir_hidden">-</span><span class="lahir"></span> (<span class="umur_hidden">-</span><span class="umur"></span> Tahun)</li>
              <li><span class="alamat_hidden">-</span><span class="alamat"></span></li>
            </ul>
          </div>

          <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
            <h6 class="font-weight-semibold"><span class="rm_hidden">-</span><span class="rm"></span></h6>
            <ul class="list list-unstyled mb-0">
              <li><span class="kelamin_hidden">-</span><span class="kelamin"></span></li>
              <li><span class="telepon_hidden">-</span><span class="telepon"></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Basic layout-->
    <div class="card">
      <div class="card-header row pb-0">
        <div class="col-md-6 col-sm-12 text-left mb-1 mt-1">
          <h5 class="card-title"><span class="badge badge-light badge-striped badge-striped-left border-left-info">
              <i class="icon-user-plus"></i>
              <b>
                @if($status_user == 1)
                Pendaftaran Rawat Jalan
                @elseif($status_user == 2)
                Pendaftaran Instalasi Gawat Darurat (IGD)
                @elseif($status_user == 3)
                Pendaftaran Hemodialisa
                @else
                ! Administrator (Dilarang Input Menggunakan Akun Ini!!!)
                @endif
              </b></span></h5>
        </div>
        <div class="col-md-6 col-sm-12 text-right mb-1 mt-1">
          <div class="list-icons">
            <form action="/{{$mainroute}}" method="GET">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                  <span class="input-group-append">
                    <span class="input-group-text"><i class="icon-search4"></i></span>
                    <span class="input-group-text">
                      <a class="list-icons-item" data-action="collapse"></a>
                    </span>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                @php $cols = count($grid)+1; @endphp
                @foreach($grid as $datagrid)
                <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                @endforeach
                <th width="11%">ACTION</th>
              </tr>
            </thead>
            <tbody>
              @if(!$listdata->isEmpty())
              @php
              $rowIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
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
                <td>
                  <center>
                    <input type="hidden" id="gridPmKey{{$rowIndex}}" name="gridPmKey{{$rowIndex}}" value="{{$pmKey}}">
                    <a onclick="grid_edit({{$pmKey}},{{$primaryKey}})"><i class="icon-pencil text-success pr-1"></i></a>
                    <a onclick="setDetailPasien({{$pmKey}},{{$primaryKey}})"><i class="icon-question3 text-secondary pr-1"></i></a>
                    <a onclick="grid_delete({{$pmKey}},{{$primaryKey}})"><i class="icon-trash text-danger"></i></a>
                  </center>
                </td>
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
        </div>
        <br>
        <div class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm">
          {{ $listdata->appends(array('search' => $search ?? $_GET['search']))->onEachSide(0)->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
    <!-- /basic layout -->
  </div>


  <div class="col-md-4">

    <!-- Basic layout-->
    <div class="card">

      <div class="card-body">
        <!-- <form action="#"> -->
        <input type="hidden" id="alldata" name="alldata" value="{{json_encode($listdata)}}">
        <input type="hidden" id="formAllField" name="formAllField" value="{{json_encode($form)}}">
        <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
        <input type="hidden" id="compId" name="compId" value="{{$compId}}">
        <div class="row">
          @csrf
          @foreach($form as $dataform)
          @if($dataform['type']=='text')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='button')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <button type="button" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="left" title="Tambah Pasien Baru" onclick="tambahPasien();"><i class="{{$dataform['icon']}}"> </i>
                {{$dataform['placeholder'] ?? ''}}</button>
            </div>
          </div>
          @elseif($dataform['type']=='readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder']}}" readonly>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='hidden')
          <div class="form-group">
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
          </div>
          @elseif($dataform['type']=='number')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date_readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}} col-xs-12">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" readonly value="{{$dataform['value'] ?? ''}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='datetime')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="datetime-local" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='time')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="time" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='color')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="color" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='file')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='image')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='angka')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="AutoNumeric angka form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='textarea')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <textarea class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" cols="20" rows="3" placeholder="{{$dataform['placeholder']}}"></textarea>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='password')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="password" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" requ>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='combo')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <div class="form-group">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" onchange="{{$dataform['onChange'] ?? ''}}">
                <option value="">{{$dataform['default']}}</option>
                @foreach($dataform['combodata'] as $key => $combodata)
                <option value="{{$combodata['comboValue']}}">{{$combodata['comboLabel']}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script>
                $(".{{$dataform['field']}}").select2({
                  placeholder: "{{$dataform['default']}}",
                  minimumResultsForSearch: Infinity
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete_advance')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="{{$dataform['field']}}Id" name="{{$dataform['field']}}Id">
              <input type="hidden" id="{{$dataform['field']}}Kode" name="{{$dataform['field']}}Kode">
              <input type="hidden" id="{{$dataform['field']}}Nama" name="{{$dataform['field']}}Nama">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $("#{{$dataform['field']}}Id").val(e.params.data.id);
                  $("#{{$dataform['field']}}Kode").val(e.params.data.kode);
                  $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                        value: "{{$dataform['value'] ?? ''}}"
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="id{{$dataform['field']}}" name="id{{$dataform['field']}}">
              <input type="hidden" id="kd{{$dataform['field']}}" name="kd{{$dataform['field']}}">
              <input type="hidden" id="nm{{$dataform['field']}}" name="nm{{$dataform['field']}}">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $("#id{{$dataform['field']}}").val(e.params.data.id);
                  $("#kd{{$dataform['field']}}").val(e.params.data.kode);
                  $("#nm{{$dataform['field']}}").val(e.params.data.nama);
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete_pasien')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <div class="input-group-select2">
                <input type="hidden" id="{{$dataform['field']}}Id" name="{{$dataform['field']}}Id">
                <input type="hidden" id="{{$dataform['field']}}Kode" name="{{$dataform['field']}}Kode">
                <input type="hidden" id="{{$dataform['field']}}Nama" name="{{$dataform['field']}}Nama">
                <input type="hidden" id="{{$dataform['field']}}Rm" name="{{$dataform['field']}}Rm">
                <input type="hidden" id="{{$dataform['field']}}Umur" name="{{$dataform['field']}}Umur">
                <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" style="border-radius: 0.1875rem 0rem 0rem 0.1875rem !important;">
                  <option value="">{{$dataform['default']}}</option>
                </select>
                <div class="input-group-append">
                  <button type="button" class="btn btn-sm btn-success" style="border-radius : 0rem 0.125rem 0.125rem 0rem !important;" data-bs-toggle="tooltip" data-bs-placement="left" title="Tambah Pasien Baru" onclick="tambahPasien();"><i class="icon-googleplus5 "></i></button>
                </div>
              </div>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $('.rm_hidden').hide();
                  $('.rm').empty().trigger('change');
                  $('.rm').append(e.params.data.kode);

                  $('.nama_hidden').hide();
                  $('.nama').empty().trigger('change');
                  $('.nama').append(e.params.data.nama);

                  $('.telepon_hidden').hide();
                  $('.telepon').empty().trigger('change');
                  $('.telepon').append(e.params.data.telepon);

                  $('.alamat_hidden').hide();
                  $('.alamat').empty().trigger('change');
                  $('.alamat').append(e.params.data.alamat);

                  $('.lahir_hidden').hide();
                  $('.lahir').empty().trigger('change');
                  $('.lahir').append(e.params.data.tgllahir);

                  $('.umur_hidden').hide();
                  $('.umur').empty().trigger('change');
                  $('.umur').append(e.params.data.umur);

                  $('.kelamin_hidden').hide();
                  $('.kelamin').empty().trigger('change');
                  $('.kelamin').append(e.params.data.kelamin);

                  $("#{{$dataform['field']}}Id").val(e.params.data.id);
                  // $("#{{$dataform['field']}}Kode").val(e.params.data.kode);
                  $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                  $("#{{$dataform['field']}}Rm").val(e.params.data.kode);
                  $("#{{$dataform['field']}}Umur").val(e.params.data.umur);

                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  width: '90%',
                  "language": {
                    "noResults": function() {
                      return "<a id='aa' onclick='add()' style='color: green;'><i class='icon-googleplus5'></i>Tambah Pasien Baru</a>";
                    },
                  },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                        value: "{{$dataform['value'] ?? ''}}"
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='multiple')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" multiple="multiple" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {

                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @endif
          @endforeach
        </div>
        <br>
        <div class="text-right">
          <button type="submit" class="btn btn-sm btn-primary" onclick="save()"><i class="icon-floppy-disk"> </i>
            Save</button>
        </div>
        <!-- </form> -->
      </div>
    </div>
    <!-- /basic layout -->

  </div>
</div>

<div id="myModal" class="modal fade" role="dialog" style="width:100%">
  <div class="modal-dialog modal-lg" style="width:100%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">TAMBAH PASIEN BARU</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>

      <div class="modal-body">
        <!-- <form id="detail"> -->
        <input type="hidden" id="formAllField2" name="formAllField2" value="{{json_encode($form2)}}">
        <div class="row">
          @csrf
          @foreach($form2 as $dataform)
          @if($dataform['type']=='text')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" readonly>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='readonly_umur')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" readonly>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='hidden')
          <div class="form-group">
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
          </div>
          @elseif($dataform['type']=='number')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" onchange="setUmur()">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date_readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" readonly value="{{$dataform['value'] ?? ''}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='datetime')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="datetime-local" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='time')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="time" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='color')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="color" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='file')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='image')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='angka')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="AutoNumeric angka form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='textarea')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <textarea class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" cols="20" rows="2" placeholder="{{$dataform['placeholder']}}"></textarea>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='password')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="password" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" requ>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='combo')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <div class="form-group">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" onchange="{{$dataform['onChange'] ?? ''}}">
                <option value="">{{$dataform['default']}}</option>
                @foreach($dataform['combodata'] as $key => $combodata)
                <option value="{{$combodata['comboValue']}}">{{$combodata['comboLabel']}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script>
                $(".{{$dataform['field']}}").select2({
                  placeholder: "{{$dataform['default']}}",
                  minimumResultsForSearch: Infinity
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete_address')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="{{$dataform['field1']}}">
              <input type="hidden" id="{{$dataform['field2']}}">
              <input type="hidden" id="{{$dataform['field3']}}">
              <input type="hidden" id="{{$dataform['field4']}}">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {

                  var data = e.params.data;
                  // set value alamat
                  $("#{{$dataform['field1']}}").val(data.village);
                  $("#{{$dataform['field2']}}").val(data.district);
                  $("#" + data.field[0]).append($("<option selected='selected'></option>").val(data.district_id).text(data.district)).trigger('change');
                  $("#{{$dataform['field3']}}").val(data.regency);
                  $("#" + data.field[1]).append($("<option selected='selected'></option>").val(data.regency_id).text(data.regency)).trigger('change');
                  $("#{{$dataform['field4']}}").val(data.province);
                  $("#" + data.field[2]).append($("<option selected='selected'></option>").val(data.province_id).text(data.province)).trigger('change');

                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete_advance')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="{{$dataform['field']}}Id" name="{{$dataform['field']}}Id">
              <input type="hidden" id="{{$dataform['field']}}Kode" name="{{$dataform['field']}}Kode">
              <input type="hidden" id="{{$dataform['field']}}Nama" name="{{$dataform['field']}}Nama">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $("#{{$dataform['field']}}Id").val(e.params.data.id);
                  $("#{{$dataform['field']}}Kode").val(e.params.data.kode);
                  $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                        value: "{{$dataform['value'] ?? ''}}"
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='readonly_autocomplete')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;" disabled>
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {}).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      // console.log('response : ', response[0]);
                      return {
                        results: response[0]
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @endif
          @endforeach
        </div>
        <hr>
        <input type="hidden" id="formAllField3" name="formAllField3" value="{{json_encode($form3)}}">
        <div class="row">
          @csrf
          @foreach($form3 as $dataform)
          @if($dataform['type']=='text')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}" readonly>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='hidden')
          <div class="form-group">
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
          </div>
          @elseif($dataform['type']=='number')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date_readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" readonly value="{{$dataform['value'] ?? ''}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='datetime')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="datetime-local" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='angka')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="AutoNumeric angka form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='combo')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <div class="form-group">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" onchange="{{$dataform['onChange'] ?? ''}}">
                <option value="">{{$dataform['default']}}</option>
                @foreach($dataform['combodata'] as $key => $combodata)
                <option value="{{$combodata['comboValue']}}">{{$combodata['comboLabel']}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script>
                $(".{{$dataform['field']}}").select2({
                  placeholder: "{{$dataform['default']}}",
                  minimumResultsForSearch: Infinity
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {}).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @elseif($dataform['type']=='autocomplete_advance')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="hidden" id="{{$dataform['field']}}Id" name="{{$dataform['field']}}Id">
              <input type="hidden" id="{{$dataform['field']}}Kode" name="{{$dataform['field']}}Kode">
              <input type="hidden" id="{{$dataform['field']}}Nama" name="{{$dataform['field']}}Nama">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" onchange="{{$dataform['onChange'] ?? ''}}" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                  $("#{{$dataform['field']}}Id").val(e.params.data.id);
                  $("#{{$dataform['field']}}Kode").val(e.params.data.kode);
                  $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                }).select2({
                  placeholder: "{{$dataform['default']}}",
                  ajax: {
                    url: "{{$dataform['url']}}?text={{$dataform['text']}}",
                    dataType: 'json',
                    delay: 250,
                    data: function(data) {
                      return {
                        search: data.term,
                        value: "{{$dataform['value'] ?? ''}}"
                      };
                    },
                    processResults: function(response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }
                });
              </script>
            </div>
          </div>
          @endif
          @endforeach
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-primary" onclick="save_pasien_baru()"><i class="icon-floppy-disk"> </i>
            Save</button>
        </div>
        <!-- </form> -->

      </div>
    </div>
  </div>
</div>
<!-- /horizontal form modal -->

<script type="text/javascript">
  function tambahPasien() {
    $('#myModal').modal('show');
  }

  function add() {
    $('#myModal').modal('show');
  }

  function setUmur() {
    var field = document.getElementById('formAllField2').value;
    var fieldobj = JSON.parse(field);
    //masukkan field yang lain
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if (fieldobj[j].type == 'date') {
        var tanggal_lahir = new Date(data);
        var tahun_lahir = tanggal_lahir.getFullYear();
        var tanggal_sekarang = new Date();
        var tahun_sekarang = tanggal_sekarang.getFullYear();
        var tahun = 0;
        if (tanggal_sekarang.getMonth() < tanggal_lahir.getMonth()) {
          tahun = 1;
        } else if ((tanggal_sekarang.getMonth() == tanggal_lahir.getMonth()) && tanggal_sekarang.getDate() < tanggal_lahir.getDate()) {
          tahun = 1;
        }
        var umur = tahun_sekarang - tahun_lahir - tahun;
      }
      if (fieldobj[j].type == 'readonly_umur') {
        var fieldumur = fieldobj[j].field;
        $('#' + fieldumur).val(umur);
        $('#' + fieldumur).prop('readonly', true);
      }
    }
  }

  function setDetailPasien(id, primaryKey) {
    $.ajax({
      type: "GET",
      url: "kln-detail-pasien",
      data: ({
        id: id
      }),
      dataType: "json",
      success: function(data) {
        // console.log(data);
        $('.rm_hidden').hide();
        $('.rm').empty().trigger('change');
        $('.rm').append(data.kode);

        $('.nama_hidden').hide();
        $('.nama').empty().trigger('change');
        $('.nama').append(data.nama);

        $('.telepon_hidden').hide();
        $('.telepon').empty().trigger('change');
        $('.telepon').append(data.telepon);

        $('.alamat_hidden').hide();
        $('.alamat').empty().trigger('change');
        $('.alamat').append(data.alamat);

        $('.lahir_hidden').hide();
        $('.lahir').empty().trigger('change');
        $('.lahir').append(data.tgllahir);

        $('.umur_hidden').hide();
        $('.umur').empty().trigger('change');
        $('.umur').append(data.umur);

        $('.kelamin_hidden').hide();
        $('.kelamin').empty().trigger('change');
        $('.kelamin').append(data.kelamin);

      }
    });
  }

  function save_pasien_baru(primaryKey) {
    var field = document.getElementById('formAllField2').value;
    var fieldobj = JSON.parse(field);
    var field3 = document.getElementById('formAllField3').value;
    var fieldobj3 = JSON.parse(field3);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_advance') {
        var evalText = 'postdata.' + fieldobj[j].field + "Id ='" + $('#' + fieldobj[j].field + 'Id').val() + "'";
        eval(evalText);
        var evalText = 'postdata.' + fieldobj[j].field + "Nama ='" + $('#' + fieldobj[j].field + 'Nama').val() + "'";
        eval(evalText);
      } else if (fieldobj[j].type == 'autocomplete_address') {

        postdata[fieldobj[j].field] = $('#' + fieldobj[j].field).val();
        postdata[fieldobj[j].field1] = $('#' + fieldobj[j].field1).val();
        postdata[fieldobj[j].field2] = $('#' + fieldobj[j].field2).val();
        postdata[fieldobj[j].field3] = $('#' + fieldobj[j].field3).val();
        postdata[fieldobj[j].field4] = $('#' + fieldobj[j].field4).val();

      } else {
        var data = data;
      }
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
    }

    for (var j = 0; j < fieldobj3.length; j++) {
      var data = document.getElementById(fieldobj3[j].field).value;
      if (fieldobj3[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj3[j].type == 'autocomplete_advance') {
        var evalText = 'postdata.' + fieldobj3[j].field + "Id ='" + $('#' + fieldobj3[j].field + 'Id').val() + "'";
        eval(evalText);
        var evalText = 'postdata.' + fieldobj3[j].field + "Nama ='" + $('#' + fieldobj3[j].field + 'Nama').val() + "'";
        eval(evalText);
      } else {
        var data = data;
      }
      var evalText = 'postdata.' + fieldobj3[j].field + "='" + data + "'";
      eval(evalText);
    }

    // console.log(postdata);

    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-new",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        // console.log(data);
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else if (data.status == 403) {
          alertify.error('Pasien Sudah Terdaftar');
          return;
        } else {
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function save() {
    var jenis = document.getElementById('{{$primaryKey}}').value;
    if (jenis == '') {
      save_pasien_lama('{{$primaryKey}}');
    } else {
      save_pasien_edit('{{$primaryKey}}');
    }
  }

  function save_pasien_lama() {
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    // console.log(fieldobj);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_pasien') {
        postdata[fieldobj[j].field+'Id'] = `${$('#'+fieldobj[j].field+'Id').val()}`;
        postdata[fieldobj[j].field+'Nama'] = `${$('#'+fieldobj[j].field+'Nama').val()}`;
        postdata[fieldobj[j].field+'Rm'] = `${$('#'+fieldobj[j].field+'Rm').val()}`;
        postdata[fieldobj[j].field+'Umur'] = `${$('#'+fieldobj[j].field+'Umur').val()}`;
      } else if (fieldobj[j].type == 'autocomplete_advance') {
        postdata[fieldobj[j].field+'Id'] = `${$('#'+fieldobj[j].field+'Id').val()}`;
        postdata[fieldobj[j].field+'Nama'] = `${$('#'+fieldobj[j].field+'Nama').val()}`;
      } else {
        var data = data;
      }
      postdata[fieldobj[j].field] = `${data}`;
    }

    console.log(postdata);

    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function save_pasien_edit(primaryKey) {
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var pkValue = document.getElementById(primaryKey).value;
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_pasien') {
        postdata[fieldobj[j].field+'Id'] = `${$('#'+fieldobj[j].field+'Id').val()}`;
        postdata[fieldobj[j].field+'Nama'] = `${$('#'+fieldobj[j].field+'Nama').val()}`;
        postdata[fieldobj[j].field+'Rm'] = `${$('#'+fieldobj[j].field+'Rm').val()}`;
      } else if (fieldobj[j].type == 'autocomplete_advance') {
        postdata[fieldobj[j].field+'Id'] = `${$('#'+fieldobj[j].field+'Id').val()}`;
        postdata[fieldobj[j].field+'Nama'] = `${$('#'+fieldobj[j].field+'Nama').val()}`;
      } else {
        var data = data;
      }
      postdata[fieldobj[j].field] = `${data}`;
    }

    // console.log(postdata);

    $.ajax({
      type: "PUT",
      url: "/{{$mainroute}}/" + pkValue,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        // console.log(data);
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Diupdate');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function grid_edit(id, primaryKey) {
    var data = document.getElementById('alldata').value;
    var dataobj = JSON.parse(data).data;
    for (var i = 0; i < dataobj.length; i++) {
      var a = 'dataobj[i].' + primaryKey.id;
      // console.log(a);
      if (eval(a) == id) {
        var field = document.getElementById('formAllField').value;
        var fieldobj = JSON.parse(field);
        //masukkan PK dulu
        document.getElementById(primaryKey.id).value = id;
        //masukkan field yang lain
        for (var j = 0; j < fieldobj.length; j++) {
          var b = 'dataobj[i].' + fieldobj[j].field;
          // console.log(fieldobj[j].type);
          if (fieldobj[j].type != 'password') {
            if (fieldobj[j].type == 'combo') {
              $("#" + fieldobj[j].field).val(eval(b)).find(':selected').trigger('change');
            } else if (fieldobj[j].type == 'autocomplete') {
              // komentar karena tidak dipakai untuk set alamat
              // if (fieldobj[j].field == 'newPasKel') {
              //   setAlamat(eval(b));
              // }

              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);

            } else if (fieldobj[j].type == 'autocomplete_pasien') {
              var b = 'dataobj[i].' + fieldobj[j].field+'Id';
              // var kd = 'dataobj[i].' + fieldobj[j].field+'Kode';
              var nm = 'dataobj[i].' + fieldobj[j].field+'Nama';
              var rm = 'dataobj[i].' + fieldobj[j].field+'Rm';
              var um = 'dataobj[i].' + fieldobj[j].field+'Umur';
              // console.log('eval :', eval(dataobj[i]));
              $('#'+fieldobj[j].field+'Id').val(eval(b))
              // $('#'+fieldobj[j].field+'Kode').val(eval(kd));
              $('#'+fieldobj[j].field+'Nama').val(eval(nm));
              $('#'+fieldobj[j].field+'Rm').val(eval(rm));
              $('#'+fieldobj[j].field+'Umur').val(eval(um));
              setAutocompleteValPasien(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
            } else if (fieldobj[j].type == 'angka') {
              $('#' + fieldobj[j].field).autoNumeric('set', eval(b));
            } else if (fieldobj[j].type == 'autocomplete_advance') {
              var id = 'dataobj[i].' + fieldobj[j].field + 'Id';
              var nama = 'dataobj[i].' + fieldobj[j].field + 'Nama';

              $('#' + fieldobj[j].field + 'Id').val(eval(id));
              $('#' + fieldobj[j].field + 'Kode').val(eval(id));
              $('#' + fieldobj[j].field + 'Nama').val(eval(nama));

              setSelect2(eval(id), eval(nama), fieldobj[j].field);
            } else {
              document.getElementById(fieldobj[j].field).value = eval(b);
            }
          }
        }
      }
    }
  }

  function setSelect2(id, name, field) {
    var $newOption = $("<option selected='selected'></option>").val(id).text(name);
    $("#" + field).append($newOption).trigger('change');
  }

  function setDisble(id, field) {
    // kode pelayanan 4,5,6 Poli disabled
    if (id == 4 || id == 5 || id == 6) {
      $('#' + field).attr('disabled', true);
    } else {
      $('#' + field).attr('disabled', false);
    }
  }

  function getAntrianRajal(id, field) {
    $.ajax({
      type: "GET",
      url: "get-antrian-kln-rajal/" + id,
      dataType: "json",
      success: function(data) {
        $('#' + field).val(data[0].antriNow);
      }
    });
  }

  // function setAlamat(id, field_kec, field_kab, field_prov) {
  //   $.ajax({
  //     type: "GET",
  //     url: "set-alamat-kln/" + id,
  //     dataType: "json",
  //     async: false,
  //     success: function(data) {
  //       var $kec = $("<option selected='selected'></option>").val(data[0].kecKode).text(data[0].kecNama);
  //       $("#" + field_kec).append($kec).trigger('change');
  //       var $kab = $("<option selected='selected'></option>").val(data[0].kabKode).text(data[0].kabNama);
  //       $("#" + field_kab).append($kab).trigger('change');
  //       var $prov = $("<option selected='selected'></option>").val(data[0].provKode).text(data[0].provNama);
  //       $("#" + field_prov).append($prov).trigger('change');
  //     }
  //   });

  // }

  function setAutocompleteVal(api, idx, tx, field) {
    $.ajax({
      type: "GET",
      url: api,
      data: ({
        text: eval(tx),
        search: idx,
        status_edit: true
      }),
      dataType: "json",
      success: function(data) {
        if (data.length > 0) {
          // Set selected
          var $newOption = $("<option selected='selected'></option>").val(data[0].id).text(data[0].text);
          $("#" + field).append($newOption);
          // $("#" + field).append($newOption).trigger('change');
        } else {
          $('#' + field).val(null).trigger('change');
        }

      }
    });
  }

  function setAutocompleteValPasien(api, idx, tx, field) {
    $.ajax({
      type: "GET",
      url: api,
      data: ({
        text: eval(tx),
        search: idx,
        kdpas: 1,
      }),
      dataType: "json",
      success: function(data) {
        if (data.length > 0) {
          // Set selected
          // console.log(data);
          var $newOption = $("<option selected='selected'></option>").val(data[0].id).text(data[0].text);
          $("#" + field).append($newOption).trigger('change');
        } else {
          $('#' + field).val(null).trigger('change');
        }

      }
    });
  }

  function grid_delete(id, pmkey) {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
          type: "DELETE",
          url: "/{{$mainroute}}/" + id,
          data: (postdata),
          dataType: "json",
          async: false,
          success: function(data) {
            alertify.success('Berhasil Dihapus');
            setTimeout(function() {
              window.open("{{$mainroute}}", "_self");
            }, 500);
          },
          error: function(dataerror) {
            console.log(dataerror);
          }
        });
      },
      function() {
        alertify.dismissAll();
      }).setHeader('<b> Hapus Data !</b> ');

  }
</script>

<x-templete_bottom />