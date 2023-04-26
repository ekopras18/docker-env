<x-templete_top :data="$data" />
<div class="row">
  <div class="col-xl-12">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header header-elements-inline">
            <h6 class="card-title">{{$page_active ?? ''}}</h6>
            <div class="header-elements">
              <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
              <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-accessibility mr-2"></i> Pemeriksaan Radiology</a></li>
              <li class="nav-item" onclick="render_calendar()"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-profile mr-2"></i> Pemeriksaan Ranap</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="left-icon-tab1">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-12">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                <span class="input-group-append">
                                  <span class="input-group-text"><i class="icon-search4"></i></span>
                                </span>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                          <tr>
                            @php $cols = count($grid)+1; @endphp
                            <th width="2%">NO</th>
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
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr onclick="grid_edit(1,{{$pmKey}},{{$primaryKey}}),enable_button(),set_list_items({{$pmKey}}), set_list_items_foto({{$pmKey}})">
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid as $datagrid)
                            @php
                            $field=$datagrid['field'];
                            $value=$data->$field;
                            @endphp
                            <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{!!
                              html_entity_decode($value) !!} </td>
                            @endforeach
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td colspan="{{$cols+1}}">
                              <center><i class="fa fa-info-circle"></i> Data Empty </center>
                            </td>
                          </tr>
                          @endif
                        </tbody>

                      </table>
                    </div>
                    <div class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata->appends(array('search' => $search ?? $_GET['search']))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title">DATA PASIEN</h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->
                        <input type="hidden" id="datadiri" name="datadiri" value="{{json_encode($listdata)}}">
                        <input type="hidden" id="form_datadiri" name="form_datadiri" value="{{json_encode($form_datadiri)}}">
                        <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
                        <input type="hidden" id="compId" name="compId" value="{{$compId}}">

                        <div class="row">
                          @csrf
                          @foreach($form_datadiri as $dataform)
                          @if($dataform['type']=='readonly')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder']}}" readonly>
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
                                  // minimumResultsForSearch: Infinity
                                });
                              </script>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="hidden" id="{{$dataform['field']}}Nama">
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
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
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <input type="text" class="form-control" id="{{$dataform['field2']}}" name="{{$dataform['field2']}}" placeholder="{{$dataform['placeholder'] ?? ''}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @endif
                          @endforeach
                        </div>
                        <div class="text-left">
                          <button class="btn btn-sm btn-warning mt-2" id="pasienmembayar_button" onclick="pasienmembayar({{$primaryKey}})" disabled><i class="icon-user-check mr-1"></i>
                            PASIEN
                            SUDAH MEMBAYAR ?</button>
                        </div>
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-8">
                    <!-- Advanced legend -->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title">PEMERIKSAAN</h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <fieldset class="mb-2">
                          <legend class="font-weight-semibold text-uppercase font-size-lg">
                            <i class="icon-reading mr-2"></i>
                            Items Check-Up
                            <a class="float-right text-default" data-toggle="collapse" data-target="#p_rad">
                              <i class="icon-circle-down2"></i>
                            </a>
                          </legend>

                          <div class="collapse show" id="p_rad">
                            <div class="row">
                              <input type="hidden" id="form_checkup" name="form_checkup" value="{{json_encode($form_checkup)}}">
                              <div class="col-xl-12 p-1">
                                <div class="div">
                                  @csrf
                                  @foreach($form_checkup as $dataform)
                                  @if($dataform['type']=='autocomplete')
                                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                                    <div class="form-group">
                                      <label class="form-label"><b>{{$dataform['label']}}</b></label>
                                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;" disabled>
                                        <option value="">{{$dataform['default']}}</option>
                                      </select>
                                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                                      <script type="text/javascript">
                                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                                          //validasi dokter ppa
                                          var dokterppa = parseInt($('#rawatDokterPpa').val());
                                          var dokterppaluar = $('#rawatDokterLuar').val();
                                          if (!dokterppa && !dokterppaluar) {
                                            alertify.error('Dokter PPA belum dipilih');
                                            $('#trRadMs').val(null).trigger('change'); //clear form items
                                            return false;
                                          }

                                          var postdata = {};
                                          postdata._token = document.getElementsByName('_token')[0].defaultValue;
                                          postdata.compId = parseInt($('#compId').val());
                                          postdata.trRadRawatId = parseInt($('#{{$primaryKey}}').val());
                                          postdata.trRadKategori = 1;
                                          postdata.trRadMsId = parseInt($('#{{$dataform["field"]}}').val());
                                          postdata.trRadMsNama = e.params.data.nama;
                                          postdata.trRadTarif = e.params.data.tarif; //convertAutoNumber
                                          postdata.trRadTgl = $('#rawatTglDaftar').val();
                                          postdata.trRadDokterPpa = parseInt($('#rawatDokterPpa').val());
                                          postdata.trRadDokterPpaNama = $('#rawatDokterPpaNama').val();
                                          postdata.trRadDokterLuar = $('#rawatDokterLuar').val();
                                          postdata.log = 'create_add_item_rad';

                                          var no_l = getLastNumber('tRad_list'); // no urut lab
                                          no_l == 0 ? no_l = 1 : no_l++;


                                          $.ajax({
                                            type: "POST",
                                            url: "/{{$mainroute}}-pemeriksaan",
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
                                                  if (no_l == 1) {
                                                    $('#body_rad').empty(); // untuk clear empty notif
                                                  }
                                                  var res = `<tr id="rad${data.trRadId}">
                                                                  <td class="text-center">${no_l}</td>
                                                                  <td>${data.trRadTgl}</td>
                                                                  <td>${data.trRadMsNama}</td>
                                                                  <td>
                                                                    <center>
                                                                      <i onclick="grid_delete_items('rad${data.trRadId}','${data.trRadId}','rad','${postdata.trRadRawatId}',1)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                                                    </center>
                                                                  </td>
                                                                </tr>`;

                                                  $('#tRad_list').append(res);
                                                  no_l++;
                                                  // Clear input
                                                  $('#{{$dataform["field"]}}').val(null).trigger('change');

                                                }, 500);
                                              }
                                            },
                                            error: function(dataerror) {
                                              console.log(dataerror);
                                            }
                                          });

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
                                  @endif
                                  @endforeach
                                  <br>
                                  <div class="col-xl-12 mt-">
                                    <div class="table-responsive table-scrollable">
                                      <table id="tRad_list" class="table table-xs" style="width:100% !important;">
                                        <thead style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                                          <tr>
                                            <th width="3%">No</th>
                                            <th width="15%">Tanggal</th>
                                            <th>Items</th>
                                            <th width="3%">Del</th>
                                          </tr>
                                        </thead>
                                        <tbody id="body_rad">
                                          <tr>
                                            <th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title">BERKAS</h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <fieldset class="mb-2">
                          <legend class="font-weight-semibold text-uppercase font-size-lg">
                            <i class="icon-camera mr-2"></i>
                            Upload Foto
                            <a class="float-right text-default" data-toggle="collapse" data-target="#p_rad">
                              <i class="icon-circle-down2"></i>
                            </a>
                          </legend>

                          <div class="collapse show" id="p_rad">
                            <div class="row">
                              <input type="hidden" id="form_checkup" name="form_checkup" value="{{json_encode($form_checkup)}}">
                              <div class="col-xl-12 p-1">
                                <div class="div">
                                  <table style="width: 100%;" border="0">
                                    <tr>
                                      <td style="vertical-align:bottom;">
                                        @csrf
                                        @foreach($form_upload_foto as $dataform)
                                        @if($dataform['type']=='image')
                                        <div class="col-sm-{{$dataform['col'] ?? 12}}">
                                          <div class="form-group">
                                            <label class="form-label"><b>{{$dataform['label']}}</b></label>
                                            <input type="file" class="form-control-uniform" id="{{$dataform['field']}}" name="{{$dataform['field']}}" accept="image/*" onclick="validate()" onchange="convert64(this)" disabled>
                                            <input type="hidden" id="{{$dataform['field']}}_hidden" name="{{$dataform['field']}}_hidden">
                                            <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                                          </div>
                                          <script>
                                            function validate() {
                                              var dokterppa = parseInt($('#rawatDokterPpa').val());
                                              var dokterppaluar = $('#rawatDokterLuar').val();
                                              if (!dokterppa && !dokterppaluar) {
                                                alertify.error('Dokter PPA belum dipilih');
                                                location.reload(); //clear form items
                                                return false;
                                              }
                                            }
                                          </script>
                                        </div>
                                        @endif
                                        @endforeach
                                      </td>
                                      <td style="vertical-align:bottom;padding-bottom:10px;width:15%">
                                        &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary" id="savefoto" onclick="saveFoto()" disabled><i class="icon-floppy-disk"> </i> Save</button>
                                      </td>
                                    </tr>
                                  </table>
                                  <br>
                                  <br>
                                  <div class="col-xl-12 mt-">
                                    <div class="table-responsive table-scrollable">
                                      <table id="tRad_list_foto" class="table table-xs" style="width:100% !important;">
                                        <thead style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                                          <tr>
                                            <th width="3%">No</th>
                                            <th width="15%">Tanggal</th>
                                            <th>Foto</th>
                                            <th width="3%">Del</th>
                                          </tr>
                                        </thead>
                                        <tbody id="body_rad_foto">
                                          <tr>
                                            <th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="left-icon-tab2">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-12">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                <span class="input-group-append">
                                  <span class="input-group-text"><i class="icon-search4"></i></span>
                                </span>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                          <tr>
                            @php $cols = count($grid)+1; @endphp
                            <th width="2%">NO</th>
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
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr onclick="grid_edit(2,{{$pmKey}},{{$primaryKey}}),enable_button()">
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid as $datagrid)
                            @php
                            $field=$datagrid['field'];
                            $value=$data->$field;
                            @endphp
                            <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{!!
                              html_entity_decode($value) !!} </td>
                            @endforeach
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td colspan="{{$cols+1}}">
                              <center><i class="fa fa-info-circle"></i> Data Empty </center>
                            </td>
                          </tr>
                          @endif
                        </tbody>

                      </table>
                    </div>
                    <div class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata->appends(array('search' => $search ?? $_GET['search']))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title">DATA PASIEN</h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->

                        <div class="row">
                          @csrf
                          @foreach($form_datadiri_ranap as $dataform)
                          @if($dataform['type']=='readonly')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder']}}" readonly>
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
                                  // minimumResultsForSearch: Infinity
                                });
                              </script>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="hidden" id="{{$dataform['field']}}Nama">
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
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
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-8">
                    <!-- Advanced legend -->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title">PEMERIKSAAN</h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <fieldset class="mb-2">
                          <legend class="font-weight-semibold text-uppercase font-size-lg">
                            <i class="icon-reading mr-2"></i>
                            Items Check-Up
                            <a class="float-right text-default" data-toggle="collapse" data-target="#tind">
                              <i class="icon-circle-down2"></i>
                            </a>
                          </legend>

                          <div class="collapse show" id="tind">
                            <div class="row">
                              <div class="col-xl-12 p-1">
                                <center>
                                  <div class="calendar-loading">
                                    <div class="theme_xbox_sm">
                                      <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                      <div class="pace_activity"></div>
                                    </div>
                                  </div>
                                </center>
                                <div id="fullcalendar"></div>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /advanced legend -->
</div>

<div id="modalitemsrad" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pemeriksaan Pasien Ranap</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Tanggal yg di select pada kalender --}}
        <input type="hidden" id="tgl_periksa">
        {{-- <div class="div"> --}}
        @csrf
        @foreach($form_checkup_ranap as $dataform)
        @if($dataform['type']=='autocomplete')
        <div class="row">
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}" class="{{$dataform['field']}} form-control" style="width: 100%;">
                <option value="">{{$dataform['default']}}</option>
              </select>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
              <script type="text/javascript">
                $(".{{$dataform['field']}}").on("select2:select", function(e) {

                  var postdata = {};
                  postdata._token = document.getElementsByName('_token')[0].defaultValue;
                  postdata.compId = parseInt($('#compId').val());
                  postdata.trRadRawatId = parseInt($('#{{$primaryKey}}').val());
                  postdata.trRadKategori = 2;
                  postdata.trRadMsId = e.params.data.id;
                  postdata.trRadMsNama = e.params.data.nama;
                  postdata.trRadTarif = e.params.data.tarif; //convertAutoNumber
                  postdata.trRadTgl = $('#tgl_periksa').val();
                  postdata.trRadDokterPpa = parseInt($('#rawatDokterPpa_ranap').val());
                  postdata.trRadDokterPpaNama = $('#rawatDokterPpa_ranapNama').val();
                  postdata.trRadDokterLuar = null;
                  postdata.log = 'create_add_item_rad_ranap';

                  var no_l = getLastNumber('tRad_list_ranap'); // no urut lab
                  no_l == 0 ? no_l = 1 : no_l++;

                  console.log(postdata);
                  $.ajax({
                    type: "POST",
                    url: "/{{$mainroute}}-pemeriksaan",
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
                          if (no_l == 1) {
                            $('#body_rad_ranap').empty(); // untuk clear empty notif
                          }
                          var res = `<tr id="rad_ranap${data.trRadId}">
                            <td class="text-center">${no_l}</td>
                            <td>${data.trRadTgl}</td>
                            <td>${data.trRadMsNama}</td>
                            <td>
                              <center>
                                <i onclick="grid_delete_items('rad_ranap${data.trRadId}','${data.trRadId}','rad','${postdata.trRadRawatId}',2)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                </center>
                                </td>
                                </tr>`;

                          $('#tRad_list_ranap').append(res);
                          no_l++;
                          // Clear input
                          $('#{{$dataform["field"]}}').val(null).trigger('change');

                        }, 500);
                      }
                    },
                    error: function(dataerror) {
                      console.log(dataerror);
                    }
                  });
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
        </div>
        @endif
        @endforeach
        <br>
        <div class="row">
          <div class="col-xl-12 mt-">
            <div class="table-responsive table-scrollable">
              <table id="tRad_list_ranap" class="table table-xs" style="width:100% !important;">
                <thead style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                  <tr>
                    <th width="3%">No</th>
                    <th width="15%">Tanggal</th>
                    <th>Items</th>
                    <th width="3%">Del</th>
                  </tr>
                </thead>
                <tbody id="body_rad_ranap">
                  <tr>
                    <th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        {{--
        </div> --}}

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function enable_button() {
    $("#pasienmembayar_button").removeAttr("disabled").button('refresh');
    $("#trRadMs").removeAttr("disabled").button('refresh');
    $("#trRadFoto").removeAttr("disabled").button('refresh');
    $("#savefoto").removeAttr("disabled").button('refresh');
  }

  function saveFoto() {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = parseInt($('#compId').val());
    postdata.trRadRawatId = parseInt($('#{{$primaryKey}}').val());
    postdata.trRadKategori = 1;
    postdata.trRadTgl = $('#rawatTglDaftar').val();
    postdata.trRadDokterPpa = parseInt($('#rawatDokterPpa').val());
    postdata.trRadDokterPpaNama = $('#rawatDokterPpaNama').val();
    postdata.trRadDokterLuar = $('#rawatDokterLuar').val();
    postdata.log = 'create_add_foto_rad';
    postdata.trRadFoto = $('#trRadFoto_hidden').val();

    var no_1 = getLastNumber('tRad_list_foto');
    no_1 == 0 ? no_1 = 1 : no_1++;

    $.ajax({
      type: 'POST',
      url: "/{{$mainroute}}-pemeriksaan-foto",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Bberhasil Disimpan');
          setTimeout(function() {
            if (no_1 == 1) {
              $('#body_rad_foto').empty();
            }

            var res = `<tr id="radFoto${data.trRadId}">
            <td class="text-center">${no_1}</td>
            <td>${data.trRadTgl}</td>
            <td>
              <a href="${data.trRadFoto}" data-popup="lightbox">
                 <img src="${data.trRadFoto}" width="50px" alt="" class="img-preview rounded">
              </a>
            </td>
            <td>
                <center>
                 <i onclick="grid_delete_items('radFoto${data.trRadId}','${data.trRadId}','radFoto','${postdata.trRadRawatId}',1)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                </center>
             </td>
            </tr>`;

            $('#tRad_list_foto').append(res);
            no_1++;
            $('#{{$dataform["field"]}}').val(null).trigger('change');
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function getLastNumber(tabelId) {
    var tabel = document.getElementById(tabelId);
    var nrow = tabel.rows.length;
    var lastNumber = parseInt(tabel.rows[nrow - 1].cells[0].innerHTML);
    if (lastNumber) {
      return lastNumber;
    } else {
      return 0;
    }
  }

  function set_list_items(id) {
    $('#body_rad').empty();
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.tgl = $('#rawatTglDaftar').val();
    $.ajax({
      type: "GET",
      url: "{{$mainroute}}-get-items/" + id + "/" + 1,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.rad.length > 0) {
          data.rad.forEach((val, key) => {
            var res_l = `<tr id='rad${val.trRadId}'>
                                  <td class="text-center">${key+1}</td>
                                  <td>${val.trRadTgl}</td>
                                  <td>${val.trRadMsNama}</td>
                                  <td>
                                    <center>
                                      <i onclick="grid_delete_items('rad${val.trRadId}','${val.trRadId}','rad','${id}',1)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                    </center>
                                  </td>
                                </tr>`;
            $('#tRad_list').append(res_l);
            $('.AutoNumeric').autoNumeric('init');
          });
        } else {
          var res_l = `<tr><th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
          $('#tRad_list').append(res_l);
        }


      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function set_list_items_ranap(primaryKey) {
    var id = primaryKey.value;

    $('#body_rad_ranap').empty();
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.tgl = $('#tgl_periksa').val();
    $.ajax({
      type: "GET",
      url: "{{$mainroute}}-get-items/" + id + "/" + 2,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.rad.length > 0) {
          data.rad.forEach((val, key) => {
            var res_l = `<tr id='rad_ranap${val.trRadId}'>
                                  <td class="text-center">${key+1}</td>
                                  <td>${val.trRadTgl}</td>
                                  <td>${val.trRadMsNama}</td>
                                  <td>
                                    <center>
                                      <i onclick="grid_delete_items('rad_ranap${val.trRadId}','${val.trRadId}','rad','${id}',2)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                    </center>
                                  </td>
                                </tr>`;
            $('#tRad_list_ranap').append(res_l);
            $('.AutoNumeric').autoNumeric('init');
          });
        } else {
          var res_l = `<tr><th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
          $('#tRad_list_ranap').append(res_l);
        }


      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function pasienmembayar(pasien) {
    let id = $('#' + pasien.id).val();
    if (id == '') {
      alertify.error('Pasien Belum Dipilih asdasd');
      return;
    }
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = parseInt($('#compId').val());
    postdata.trRadKasir = 1;
    postdata.trRadTgl = $('#rawatTglDaftar').val();

    alertify.confirm('Pasien Sudah Membayar?',
      function() {
        $.ajax({
          type: "PUT",
          url: "/{{$mainroute}}-bayar/" + id,
          data: (postdata),
          dataType: "json",
          async: false,
          success: function(data) {
            console.log('js : ', data);
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
      },
      function() {
        alertify.dismissAll();
      }).setHeader('<b> Status Bayar !</b> ');
  }

  function grid_edit(status, id, primaryKey) {
    if (status == 1) {
      var data = document.getElementById('datadiri').value;
      var dataobj = JSON.parse(data).data;
      for (var i = 0; i < dataobj.length; i++) {
        var a = 'dataobj[i].' + primaryKey.id;
        // console.log(a);
        if (eval(a) == id) {
          var field = document.getElementById('form_datadiri').value;
          var fieldobj = JSON.parse(field);
          //masukkan PK dulu
          document.getElementById(primaryKey.id).value = id;
          //masukkan field yang lain
          //datadiri
          for (var j = 0; j < fieldobj.length; j++) {
            var b = 'dataobj[i].' + fieldobj[j].field;
            if (fieldobj[j].type != 'password') {
              if (fieldobj[j].type == 'combo') {
                $("#" + fieldobj[j].field).val(eval(b)).find(':selected').trigger('change');
              } else if (fieldobj[j].type == 'autocomplete') {
                setAutocomplete(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
              } else if (fieldobj[j].type == 'angka') {
                $('#' + fieldobj[j].field).autoNumeric('set', eval(b));
              } else {
                document.getElementById(fieldobj[j].field).value = eval(b);
              }
            }
          }
        }
      }
    } else if (status == 2) {
      var data = document.getElementById('datadiri').value;
      var dataobj = JSON.parse(data).data;
      for (var i = 0; i < dataobj.length; i++) {
        var a = 'dataobj[i].' + primaryKey.id;
        // console.log(a);
        if (eval(a) == id) {
          var field = document.getElementById('form_datadiri').value;
          var fieldobj = JSON.parse(field);
          //masukkan PK dulu
          document.getElementById(primaryKey.id).value = id;
          //masukkan field yang lain
          //datadiri
          for (var j = 0; j < fieldobj.length; j++) {
            var b = 'dataobj[i].' + fieldobj[j].field;
            if (fieldobj[j].type != 'password') {
              if (fieldobj[j].type == 'combo') {
                $("#" + fieldobj[j].field + '_ranap').val(eval(b)).find(':selected').trigger('change');
              } else if (fieldobj[j].type == 'autocomplete') {
                setAutocomplete(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
              } else if (fieldobj[j].type == 'angka') {
                $('#' + fieldobj[j].field + '_ranap').autoNumeric('set', eval(b));
              } else {
                document.getElementById(fieldobj[j].field + '_ranap').value = eval(b);
              }
            }
          }
        }
      }
    }

  }

  function setAutocomplete(api, idx, tx, field) {
    $.ajax({
      type: "GET",
      url: api,
      data: ({
        text: eval(tx),
        search: idx,
        status_edit: true // untuk menandai bahwa ini adalah edit jadi where search nya berbeda
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

  function grid_delete_items(item, id, model, id_rawat, jenis) {
    //item,id,model = untuk kebutuhan delete item
    //jenis = 1 = lab, 2 = lab ranap
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
          type: "DELETE",
          url: "/{{$mainroute}}-del-items/" + id,
          data: (postdata),
          dataType: "json",
          async: false,
          success: function(data) {
            alertify.success('Berhasil Dihapus');
            setTimeout(function() {
              // $('#'+item).remove();
              if (jenis == 1) {
                if(model == 'rad'){
                set_list_items(id_rawat);
                }else if(model == 'radFoto'){
                  set_list_items_foto(id_rawat);
                }
              } else if (jenis == 2) {
                set_list_items_ranap({{$primaryKey}});
              }

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

  function render_calendar() {
    var events = [];

    var calendarEl = document.querySelector('#fullcalendar');

    if (calendarEl) {

      var calendar = new FullCalendar.Calendar(calendarEl, {
        // initialView: 'dayGridMonth',
        // initialDate: '2022-12-07',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function(arg) {
          var dokterppa = parseInt($('#rawatDokterPpa_ranap').val());
          if (!dokterppa) {
            alertify.error('Dokter PPA belum dipilih');
            return false;
          }
          //set ke inputan hidden tanggal periksa
          $('#tgl_periksa').val(arg.startStr);
          set_list_items_ranap({{$primaryKey}});
          $('#modalitemsrad').modal('show');
          calendar.unselect()
        },
        // editable: true,
        dayMaxEvents: true,
        events: events,
      });

      setTimeout(function() {
        calendar.render();
        $('.calendar-loading').css('display', 'none');
      }, 500);

    }
  }

  function set_list_items_foto(id) {
    $('#body_rad_foto').empty();
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.tgl = $('#rawatTglDaftar').val();
    $.ajax({
      type: "GET",
      url: "{{$mainroute}}-get-items-foto/" + id ,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.rad.length > 0) {
          data.rad.forEach((val, key) => {
            var res_l = `<tr id='radFoto${val.trRadId}'>
                                  <td class="text-center">${key+1}</td>
                                  <td>${val.trRadTgl}</td>
                                  <td>
                                  <a href="${val.trRadFoto}" data-popup="lightbox">
                                    <img src="${val.trRadFoto}" width="50px" alt="" class="img-preview rounded">
                                  </a>
                                  </td>
                                  <td>
                                    <center>
                                      <i onclick="grid_delete_items('radFoto${val.trRadId}','${val.trRadId}','radFoto','${id}',1)" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                    </center>
                                  </td>
                                </tr>`;
            $('#tRad_list_foto').append(res_l);
            $('.AutoNumeric').autoNumeric('init');
          });
        } else {
          var res_l = `<tr><th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
          $('#tRad_list_foto').append(res_l);
        }


      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function convert64(element) {
    $("#savefoto").prop("disabled", true);
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      document.getElementById(element.id + '_hidden').value = reader.result;
      $("#savefoto").removeAttr('disabled');
    }
    reader.readAsDataURL(file);
  };
</script>
<x-templete_bottom />