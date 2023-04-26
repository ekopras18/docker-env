<x-templete_top :data="$data" />

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$data['page_tittle']??''}}</h5>
        <div class="header-elements">
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
            <!-- <a class="list-icons-item" data-action="collapse"></a>
            <a class="list-icons-item" data-action="reload"></a> -->
            <!-- <a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="tData" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                @php $cols = count($grid)+4; @endphp
                <th width="3%">NO</th>
                @foreach($grid as $datagrid)
                <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                @endforeach
                <th width="5%">CETAK KARTU</th>
                <th width="5%">RIWAYAT</th>
                <th width="8%">ACTION</th>
              </tr>
            </thead>
            <tbody>
              @if(!$listdata->isEmpty())
              @php
              $rowIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                <td>{{$key+1}}</td>
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
                    <a href="{{url('/')}}/kln-pasien-pdf/{{$pmKey}}" target="_blank"><i title="Cetak Kartu" data-placement="left" class="list-icons-item text-blue-600 text-center icon-printer" style="font-size: 13px;"></i></a>
                  </center>
                </td>
                <td>
                  <center>
                    <i onclick="riwayat({{$pmKey}})" data-popup="tooltip" title="Riwayat" data-placement="left" class="list-icons-item text-center icon-search4" style="font-size: 13px;"></i>
                  </center>
                </td>
                <td>
                  <center>
                    <input type="hidden" id="gridPmKey{{$rowIndex}}" name="gridPmKey{{$rowIndex}}" value="{{$pmKey}}">
                    <a onclick="grid_edit({{$pmKey}},{{$primaryKey}}, enable_button())"><i class="icon-pencil text-success pr-1" style="font-size: 13px;"></i></a>
                    <a onclick="grid_delete({{$pmKey}},{{$primaryKey}})"><i class="icon-trash text-danger" style="font-size: 13px;"></i></a>
                  </center>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="{{$cols}}">
                  <center><i class="fa fa-info-circle"></i> Data Empty </center>
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
  </div>
</div>
<div class="row">
  <div class="col-md-12">

    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">Form Input</h5>
        <div class="header-elements">
          <div class="list-icons">
            <a class="list-icons-item" data-action="collapse"></a>
            <!-- <a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

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
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder'] ?? ''}}">
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
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='date_readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" readonly>
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
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" {{$dataform['disabled'] ?? '' }}>
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
          {{-- @elseif($dataform['type']=='combo_with_value')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
          <label class="form-label"><b>{{$dataform['label']}}</b></label>
          <div class="form-group">
            <input type="text" id="{{$dataform['field']}}Id}}">
            <input type="text" id="{{$dataform['field']}}Nama}}">
            <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="form-control {{$dataform['field']}}" {{$dataform['disabled'] ?? '' }}>
              <option value="">{{$dataform['default']}}</option>
              @foreach($dataform['combodata'] as $key => $combodata)
              <option value="{{$combodata['comboValue']}}" @if($combodata['comboValue']==$dataform['value']) selected @endif onchange="comboSetName({{$combodata['comboValue']}},{{$combodata['comboLabel']}})">
                {{$combodata['comboLabel']}}
              </option>
              @endforeach
            </select>
            <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            <script>
              $(".{{$dataform['field']}}").on("change", function(e) {
                console.log(e.params.data);
              }).select2({
                placeholder: "{{$dataform['default']}}",
                // minimumResultsForSearch: Infinity
              });
            </script>
          </div>
        </div> --}}
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
                $("#msPasKecId").append($("<option selected='selected'></option>").val(data.district_id).text(data.district)).trigger('change');
                $("#{{$dataform['field3']}}").val(data.regency);
                $("#msPasKabId").append($("<option selected='selected'></option>").val(data.regency_id).text(data.regency)).trigger('change');
                $("#{{$dataform['field4']}}").val(data.province);
                $("#msPasProvId").append($("<option selected='selected'></option>").val(data.province_id).text(data.province)).trigger('change');

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
        @elseif($dataform['type']=='autocomplete')
        <div class="col-sm-{{$dataform['col'] ?? 12}}">
          <div class="form-group">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
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
        @elseif($dataform['type']=='autocomplete_new')
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
      <div class="text-right">
        <button type="submit" class="btn btn-sm btn-primary" id="saveButton" onclick="save()" disabled><i class="icon-floppy-disk"> </i> Save</button>
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    function comboSetName(id, name) {
      // console.log(name);
      $("#{{$dataform['field']}}Id").val(id);
      $("#{{$dataform['field']}}Nama").val(name);
    }
  });

  function save() {
    var jenis = document.getElementById('{{$primaryKey}}').value;
    if (jenis == '') {
      saveNew('{{$primaryKey}}');
    } else {
      saveEdit('{{$primaryKey}}');
    }
  }

  function saveNew(primaryKey) {
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_new') {
        var evalText = 'postdata.' + fieldobj[j].field + "Id ='" + $('#' + fieldobj[j].field + 'Id').val() + "'";
        eval(evalText);
        var evalText = 'postdata.' + fieldobj[j].field + "Nama ='" + $('#' + fieldobj[j].field + 'Nama').val() + "'";
        eval(evalText);
      } else {
        var data = data;
      }
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
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

  function saveEdit(primaryKey) {
    console.log('saveEdit');
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
              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
            } else if (fieldobj[j].type == 'autocomplete_new') {
              var id = 'dataobj[i].' + fieldobj[j].field + 'Id';
              var nama = 'dataobj[i].' + fieldobj[j].field + 'Nama';

              $('#' + fieldobj[j].field + 'Id').val(eval(id));
              $('#' + fieldobj[j].field + 'Kode').val(eval(id));
              $('#' + fieldobj[j].field + 'Nama').val(eval(nama));

              setSelect2(eval(id), eval(nama), fieldobj[j].field);

            } else if (fieldobj[j].type == 'autocomplete_address') {

              var kelId = 'dataobj[i].' + fieldobj[j].field;
              var kelName = 'dataobj[i].' + fieldobj[j].field1;
              var kecId = dataobj[i].msPasKecId;
              var kecName = 'dataobj[i].' + fieldobj[j].field2;
              var kabId = dataobj[i].msPasKabId;
              var kabName = 'dataobj[i].' + fieldobj[j].field3;
              var provId = dataobj[i].msPasProvId;
              var provName = 'dataobj[i].' + fieldobj[j].field4;

              $("#" + fieldobj[j].field).append($("<option selected='selected'></option>").val(eval(b)).text(eval(kelName))).trigger('change');
              $("#msPasKecId").append($("<option selected='selected'></option>").val(kecId).text(eval(kecName))).trigger('change');
              $("#msPasKabId").append($("<option selected='selected'></option>").val(kabId).text(eval(kabName))).trigger('change');
              $("#msPasProvId").append($("<option selected='selected'></option>").val(provId).text(eval(provName))).trigger('change');

            } else if (fieldobj[j].type == 'angka') {
              $('#' + fieldobj[j].field).autoNumeric('set', eval(b));
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

  function enable_button() {
    $("#saveButton").removeAttr("disabled").button('refresh');
  }

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