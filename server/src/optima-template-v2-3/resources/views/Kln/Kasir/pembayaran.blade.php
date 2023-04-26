<x-templete_top :data="$data" />
<div class="row">
  <div class="col-xl-12">
    <div class="row">

      <div class="col-xl-12">
        <!-- Basic layout-->
        <div class="card">
          <div class="card-header header-elements-inline">
            <h5 class="card-title"></h5>
            <div class="header-elements">
              <div class="list-icons">
                <form action="/{{$mainroute}}" method="GET">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control"
                        placeholder="Search Here">
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

                  <tr
                    onclick="grid_edit({{$pmKey}},{{$primaryKey}}),enable_button(),set_list_pemeriksaan({{$pmKey}}),set_informasi_pasien_resep({{$pmKey}},{{$primaryKey}})">
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
            <br>
            <div class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm">
              {{ $listdata->appends(array('search' => $search ?? $_GET['search']
              ))->onEachSide(0)->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
        <!-- /basic layout -->
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Basic layout-->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">DATA PASIEN</h5>
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
        <input type="hidden" id="datadiri" name="datadiri" value="{{json_encode($listdata)}}">
        <input type="hidden" id="form_datadiri" name="form_datadiri" value="{{json_encode($form_datadiri)}}">
        <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
        <input type="hidden" id="compId" name="compId" value="{{$compId}}">

        <div class="row">
          @csrf
          @foreach($form_datadiri as $dataform)
          @if($dataform['type']=='text')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='readonly')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder']}}" readonly>
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='hidden')
          <div class="form-group">
            <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
              value="{{$dataform['value']}}" placeholder="{{$dataform['placeholder']}}">
          </div>
          @elseif($dataform['type']=='number')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                placeholder="{{$dataform['placeholder']}}">
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
          @elseif($dataform['type']=='angka')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <div class="form-group">
              <label class="form-label"><b>{{$dataform['label']}}</b></label>
              <input type="text" class="AutoNumeric angka form-control" id="{{$dataform['field']}}"
                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
            </div>
          </div>
          @elseif($dataform['type']=='combo')
          <div class="col-sm-{{$dataform['col'] ?? 12}}">
            <label class="form-label"><b>{{$dataform['label']}}</b></label>
            <div class="form-group">
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                class="form-control {{$dataform['field']}}" {{$dataform['disabled'] ?? '' }}>
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
              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                class="{{$dataform['field']}} form-control" style="width: 100%;">
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
          @endif
          @endforeach
        </div>
        <div class="text-left">
          <button type="submit" class="btn btn-sm btn-danger mt-2" id="pasienkabur_button"
            onclick="pasienkabur({{$primaryKey}})" disabled><i class="icon-user-block mr-1"></i> PASIEN KABUR</button>
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
        <h5 class="card-title">TAGIHAN</h5>
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
            Tagihan Kamar
            <a href="#" class="float-right text-default" data-toggle="collapse" data-target="#kmr">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="kmr">
            <input type="hidden" id="rawattglDaftar" name="rawattglDaftar">
            <input type="hidden" id="form_kamar" name="form_kamar" value="{{json_encode($form_kamar)}}">
            <div class="row">
              @csrf
              @foreach($form_kamar as $dataform)
              @if($dataform['type']=='number')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <input type="number" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                    placeholder="{{$dataform['placeholder']}}">
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @elseif($dataform['type']=='date')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <input type="text" onfocus="(this.type='date')" class="form-control"
                    placeholder="{{$dataform['placeholder']}}" id="{{$dataform['field']}}"
                    name="{{$dataform['field']}}">
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @elseif($dataform['type']=='autocomplete_kamar')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <input type="hidden" id="{{$dataform['field']}}Id" name="{{$dataform['field']}}Id">
                  <input type="hidden" id="{{$dataform['field']}}Kode" name="{{$dataform['field']}}Kode">
                  <input type="hidden" id="{{$dataform['field']}}Nama" name="{{$dataform['field']}}Nama">
                  <input type="hidden" id="{{$dataform['field1']}}" name="{{$dataform['field1']}}">
                  <input type="hidden" id="{{$dataform['field2']}}" name="{{$dataform['field2']}}">
                  <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                    class="{{$dataform['field']}} form-control" style="width: 100%;">
                    <option value="">{{$dataform['default']}}</option>
                  </select>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                  <script type="text/javascript">
                    $(".{{$dataform['field']}}").on("select2:select", function(e) {
                    var jumlahHari = $("#{{$dataform['field3']}}").val();
                    var tarif = e.params.data.tarif;

                    if(jumlahHari == ''){
                      alertify.error('Jumlah Hari Belum Diisi');
                      $("#{{$dataform['field']}}").val(null).trigger('change');
                      return ;
                    }

                    $("#{{$dataform['field']}}Id").val(e.params.data.id);
                    $("#{{$dataform['field']}}Kode").val(e.params.data.kode);
                    $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                    $("#{{$dataform['field1']}}").val(e.params.data.tarif);
                    $("#{{$dataform['field2']}}").val(parseInt(jumlahHari) * tarif);

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
              <div class="col-sm-2">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="kamar_button" onclick="saveKamar()" disabled><i
                      class="icon-floppy-disk mr-1"></i> Save</button>
                </div>
              </div>
              <div class="col-xl-12 mt-2">
                <div class="table-responsive table-scrollable">
                  <table id="tKamar_list" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%">No</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Kamar</th>
                        <th>Hari</th>
                        <th>Tarif</th>
                        <th>Total</th>
                        <th width="3%">Del</th>
                      </tr>
                    </thead>
                    <tbody id="body_kamar">
                      <tr>
                        <th colspan="8" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="d-flex rounded">
                  <div class="border-left-1 border-white mt-2 ml-auto rounded">
                    <input type="text" class="form-control text-right AutoNumeric" id='tKamar_total'
                      placeholder="Total Akomodasi" value="0.00" disabled>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </fieldset>
        <fieldset class="mb-2">
          <legend class="font-weight-semibold text-uppercase font-size-lg">
            <i class="icon-reading mr-2"></i>
            Tagihan Tindakan
            <a class="float-right text-default" data-toggle="collapse" data-target="#tind">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="tind">
            <div class="row">
              <input type="hidden" id="form_tindakan" name="form_tindakan" value="{{json_encode($form_tindakan)}}">
              <div class="col-xl-12 p-1">
                <div class="row">
                  @csrf
                  @foreach($form_tindakan as $dataform)
                  @if($dataform['type']=='autocomplete_ruangan')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Id">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <input type="hidden" id="{{$dataform['field']}}Jenis">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Id").val(e.params.data.id);
                          $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                          $("#{{$dataform['field']}}Jenis").val(e.params.data.jenis);
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
                  @elseif($dataform['type']=='autocomplete_tindakan')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <input type="hidden" id="{{$dataform['field']}}Tarif">
                      <input type="hidden" id="{{$dataform['field']}}Jenis">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                          $("#{{$dataform['field']}}Tarif").val(e.params.data.tarif);
                          $("#{{$dataform['field']}}Jenis").val(e.params.data.jenis);
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
                  @elseif($dataform['type']=='autocomplete_dokter')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Id">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Id").val(e.params.data.id);
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
                  @elseif($dataform['type']=='date')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="text" onfocus="(this.type='date')" class="form-control"
                        placeholder="{{$dataform['placeholder']}}" id="{{$dataform['field']}}"
                        name="{{$dataform['field']}}">
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                    </div>
                  </div>
                  @endif
                  @endforeach
                  <div class="col-sm-2">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" id="tindakan_button" onclick="saveTindakan()"
                        disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
                    </div>
                    <br>
                  </div>
                  <div class="col-xl-12">
                    <div class="table-responsive table-scrollable">
                      <table id="tTindakan_list" class="table table-xs" style="width:100% !important;">
                        <thead
                          style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                          <tr>
                            <th width="3%">No</th>
                            <th>Tanggal</th>
                            <th>Ruangan / Poli</th>
                            <th>Tindakan</th>
                            <th>Tarif</th>
                            <th>Del</th>
                          </tr>
                        </thead>
                        <tbody id="body_tindakan">
                          <tr>
                            <th colspan="6" class="text-center"><i class="icon-info22"></i> Empty</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex rounded">
                      <div class="border-left-1 border-white mt-2 ml-auto rounded">
                        <input type="text" class="form-control text-right AutoNumeric" id='tTindakan_total'
                          placeholder="Total Tindakan" value="0.00" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        {{-- <fieldset class="mb-2">
          <legend class="font-weight-semibold text-uppercase font-size-lg">
            <i class="icon-reading mr-2"></i>
            Tagihan Radiologi
            <a class="float-right text-default" data-toggle="collapse" data-target="#rad">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="rad">
            <div class="row">
              <input type="hidden" id="form_radiologi" name="form_radiologi" value="{{json_encode($form_tindakan)}}">
              <div class="col-xl-12 p-1">
                <div class="row">
                  @csrf
                  @foreach($form_tindakan as $dataform)
                  @if($dataform['type']=='autocomplete_ruangan')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Id">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <input type="hidden" id="{{$dataform['field']}}Jenis">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Id").val(e.params.data.id);
                          $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                          $("#{{$dataform['field']}}Jenis").val(e.params.data.jenis);
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
                  @elseif($dataform['type']=='autocomplete_tindakan')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <input type="hidden" id="{{$dataform['field']}}Tarif">
                      <input type="hidden" id="{{$dataform['field']}}Jenis">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Nama").val(e.params.data.nama);
                          $("#{{$dataform['field']}}Tarif").val(e.params.data.tarif);
                          $("#{{$dataform['field']}}Jenis").val(e.params.data.jenis);
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
                  @elseif($dataform['type']=='autocomplete_dokter')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" id="{{$dataform['field']}}Id">
                      <input type="hidden" id="{{$dataform['field']}}Nama">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;">
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          // console.log(e.params.data);
                          $("#{{$dataform['field']}}Id").val(e.params.data.id);
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
                  @elseif($dataform['type']=='date')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="text" onfocus="(this.type='date')" class="form-control"
                        placeholder="{{$dataform['placeholder']}}" id="{{$dataform['field']}}"
                        name="{{$dataform['field']}}">
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                    </div>
                  </div>
                  @endif
                  @endforeach
                  <div class="col-sm-2">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" id="radiologi_button" onclick="saveRadiologi()"
                        disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
                    </div>
                    <br>
                  </div>
                  <div class="col-xl-12">
                    <div class="table-responsive table-scrollable">
                      <table id="tRadiologi_list" class="table table-xs" style="width:100% !important;">
                        <thead
                          style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                          <tr>
                            <th width="3%">No</th>
                            <th>Tanggal</th>
                            <th>Ruangan / Poli</th>
                            <th>Tindakan</th>
                            <th>Tarif</th>
                            <th>Del</th>
                          </tr>
                        </thead>
                        <tbody id="body_radiologi">
                          <tr>
                            <th colspan="6" class="text-center"><i class="icon-info22"></i> Empty</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex rounded">
                      <div class="border-left-1 border-white mt-2 ml-auto rounded">
                        <input type="text" class="form-control text-right AutoNumeric" id='tRadiologi_total'
                          placeholder="Total Radiologi" value="0.00" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset> --}}
        <fieldset>
          <legend class="font-weight-semibold text-uppercase font-size-lg">
            <i class="icon-reading mr-2"></i>
            E-Prescribing
            <a class="float-right text-default" data-toggle="collapse" data-target="#epres">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="epres">
            <div class="row">

              <input type="hidden" id="form_resep" name="form_resep" value="{{json_encode($form_resep)}}">
              <input type="hidden" id="grid_resep" name="grid_resep" value="{{json_encode($grid_resep)}}">
              <div class="col-xl-12 p-1">
                <input type="hidden" id="obat_racikan" value="{{$combo_obatracikan}}">
                <input type="hidden" id="obat_dosis" value="{{$combo_obatdosis}}">
                <input type="hidden" id="obat_aturan" value="{{$combo_obataturan}}">
                <input type="hidden" id="obat_waktu" value="{{$combo_obatwaktu}}">
                <div class="row">
                  @csrf
                  @foreach($form_resep as $dataform)
                  @if($dataform['type']=='autocomplete')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <label class="form-label"><b>{{$dataform['label']}}</b></label>
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;" disabled>
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {

                              var racikan = JSON.parse($('#obat_racikan').val());
                              var dosis = JSON.parse($('#obat_dosis').val());
                              var waktu = JSON.parse($('#obat_waktu').val());
                              var aturan = JSON.parse($('#obat_aturan').val());

                              var no_r = getLastNumber('tResep_list');  // no urut diagnosa

                              no_r == 0 ? no_r = 1 : no_r++;

                              if(no_r == 1){
                                $('#body_resep').empty(); // untuk clear empty notif
                              }
                              
                              var res = `<tr id="resep${no_r}">
                                          <td>${no_r}</td>
                                          <td>${e.params.data.kode}<input type="hidden" id="brgKode${no_r}" value="${e.params.data.kode}"></td>
                                          <td>${e.params.data.nama}<input type="hidden" id="brgNama${no_r}" value="${e.params.data.nama}"></td>
                                          <td><input type="text" id="brgKet${no_r}" class="form-control" placeholder="Keterangan Obat"></td>
                                          <td><select id="brgRacikan${no_r}" class="brgRacikan form-control" style="width: 100%;">
                                              <option value="">Racikan</option>`;
                                              racikan.forEach((val,key) => {
                                                res += `<option value="${val.comboValue}">${val.comboLabel}</option>`;
                                              });
                                    res += `</select>
                                          </td>
                                          <td><select id="brgDosis${no_r}" class="brgDosis form-control" style="width: 100%;">
                                              <option value="">Dosis</option>`;
                                              dosis.forEach((val,key) => {
                                                res += `<option value="${val.comboValue}">${val.comboLabel}</option>`;
                                              });
                                    res += `</select>
                                          </td>
                                          <td><select id="brgWaktu${no_r}" class="brgWaktu form-control" style="width: 100%;">
                                              <option value="">Waktu</option>`;
                                              waktu.forEach((val,key) => {
                                                res += `<option value="${val.comboValue}">${val.comboLabel}</option>`;
                                              });
                                    res += `</select>
                                          </td>
                                          <td>
                                            <select id="brgAturan${no_r}" class="brgAturan form-control" style="width: 100%;">
                                              <option value="">Aturan</option>`;
                                              aturan.forEach((val,key) => {
                                                res += `<option value="${val.comboValue}">${val.comboLabel}</option>`;
                                              });
                                    res += `</select>
                                          </td>
                                          <td><input type="number" id="brgQty${no_r}" class="form-control" placeholder="Qty"></td>
                                          <td class="hide"><input type="hidden" id="brgHarga${no_r}" value="${e.params.data.harga == '' ? 0 : e.params.data.harga}"></td>
                                          <td>${e.params.data.satuankecil == '' ? "-" : e.params.data.satuankecil}<input type="hidden" id="brgSatuan${no_r}" value="${e.params.data.satuankecil == '' ? "-" : e.params.data.satuankecil}"></td>
                                          <td>
                                            <center>
                                              <i onclick="delete_raw_resep(${no_r})" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                            </center>
                                          </td>
                                        </tr>`;

                              $('#tResep_list').append(res);
                              no_r++;
                              $(".brgRacikan").select2({
                                  placeholder: "Racikan",
                                  minimumResultsForSearch: Infinity
                              });
                              $(".brgDosis").select2({
                                  placeholder: "Dosis",
                                  // minimumResultsForSearch: Infinity
                              });
                              $(".brgWaktu").select2({
                                  placeholder: "Waktu",
                                  // minimumResultsForSearch: Infinity
                              });
                              $(".brgAturan").select2({
                                  placeholder: "Aturan",
                                  // minimumResultsForSearch: Infinity
                              });
                              // Clear inputan
                              $('#{{$dataform["field"]}}').val(null).trigger('change');
                              // enable button save
                              $("#resep_button").removeAttr("disabled").button('refresh');
                              // $("#resep_list_button").removeAttr("disabled").button('refresh');
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
                  @elseif($dataform['type']=='number')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <label class="form-label"><b>{{$dataform['label']}}</b></label>
                      <input type="number" class="form-control" id="{{$dataform['field']}}"
                        name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                    </div>
                  </div>
                  @elseif($dataform['type']=='hidden')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="{{$dataform['field']}}"
                        name="{{$dataform['field']}}" value="{{$dataform['value']}}"
                        placeholder="{{$dataform['placeholder']}}">
                    </div>
                  </div>
                  @endif
                  @endforeach
                  <div class="col-xl-12">
                    <br>
                    <div class="table-responsive table-scrollable">
                      <table id="tResep_list" class="table table-xs" style="width:100% !important;">
                        <thead
                          style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                          <tr>
                            @php $colspan = count($grid_resep)+2; @endphp
                            <th width="2%">No</th>
                            @foreach($grid_resep as $datagrid)
                            @if($datagrid['type'] == 'hidden')
                            <th class="hide">{{$datagrid['label']}}</th>
                            @else
                            <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                            @endif
                            @endforeach
                            <th width="2%">Del</th>
                          </tr>
                        </thead>
                        <tbody id="body_resep">
                          <tr>
                            <th colspan="{{$colspan}}" class="text-center"><i class="icon-info22"></i> Empty</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <br>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="text-left">
                          <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#pasien_keluar">
                            <i class="icon-spam mr-1"></i> Closing</button>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="text-right">
                          {{-- id="resep_list_button" --}}
                          <button type="submit" class="btn btn-success" data-toggle="modal"
                            data-target="#list_resep_modal">
                            <i class="icon-clipboard3 mr-1"></i> List Transaksi</button>
                          <button type="submit" class="btn btn-primary" id="resep_button"
                            onclick="resep({{$primaryKey}})" disabled><i class="icon-floppy-disk mr-1"></i>
                            Save</button>
                        </div>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>

      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="list_resep_modal" tabindex="-1" role="dialog" aria-labelledby="list_resep_modal"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" width="100%">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Data Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-xl-12">
                <div class="table-responsive">
                  <table id="tData_transaksi" class="table listtransaksi table-striped table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th width="2%">No</th>
                        @foreach($grid_resep_transaksi as $datagrid)
                        @if($datagrid['type'] == 'hidden')
                        <th class="hide">{{$datagrid['label']}}</th>
                        @else
                        <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                        @endif
                        @endforeach
                        <th width="3%">Print</th>
                        <th width="3%">Del</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($listtransaksi as $key => $data)
                      <tr>
                        <td class="text-center">{{$key+1}}.</td>
                        @foreach($grid_resep_transaksi as $datagrid)
                        @php
                        $pmKey=$data->resepId;
                        $field=$datagrid['field'];
                        $value=$data->$field;
                        @endphp
                        <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{!!
                          html_entity_decode($value) !!} </td>
                        @endforeach
                        <td>
                          <center>
                            <i onclick="cetak_resep({{$pmKey}})" data-popup="tooltip" title="Cetak Resep"
                              data-placement="left" class="list-icons-item text-blue-600 text-center icon-printer"></i>
                          </center>
                        </td>
                        <td>
                          <center>
                            @if($data->resepStatus == 0)
                            <i onclick="grid_transaksi_delete({{$pmKey}})"
                              class="list-icons-item text-danger-600 text-center icon-trash"></i>
                            @else
                            <i class="list-icons-item text-grey-600 text-center icon-trash"></i>
                            @endif
                          </center>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end Modal -->
    <!-- Modal -->
    <div class="modal fade" id="pasien_keluar" tabindex="-1" role="dialog" aria-labelledby="pasien_keluar"
      aria-hidden="true">
      <div class="modal-dialog" role="document" width="100%">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pasien Keluar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{-- <input type="hidden" id="datadiri" name="datadiri" value="{{json_encode($listdata)}}"> --}}
            <input type="hidden" id="form_pasien_keluar" name="form_pasien_keluar"
              value="{{json_encode($form_pasien_keluar)}}">
            <div class="row">
              @csrf
              @foreach($form_pasien_keluar as $dataform)
              @if($dataform['type']=='text')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <label class="form-label"><b>{{$dataform['label']}}</b></label>
                  <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                    placeholder="{{$dataform['placeholder']}}">
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @elseif($dataform['type']=='readonly')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <label class="form-label"><b>{{$dataform['label']}}</b></label>
                  <input type="text" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                    value="{{$dataform['value'] ?? ''}}" placeholder="{{$dataform['placeholder']}}" readonly>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @elseif($dataform['type']=='hidden')
              <div class="form-group">
                <input type="hidden" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                  value="{{$dataform['value']}}" placeholder="{{$dataform['placeholder']}}">
              </div>
              @elseif($dataform['type']=='date')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <label class="form-label"><b>{{$dataform['label']}}</b></label>
                  <input type="date" class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}"
                    value="{{$dataform['value'] ?? ''}}" readonly>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @elseif($dataform['type']=='combo')
              <div class="col-sm-{{$dataform['col'] ?? 12}}">
                <label class="form-label"><b>{{$dataform['label']}}</b></label>
                <div class="form-group">
                  <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                    class="form-control {{$dataform['field']}}" {{$dataform['disabled'] ?? '' }}>
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
                  <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                    class="{{$dataform['field']}} form-control" style="width: 100%;">
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
              @endif
              @endforeach
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-sm btn-primary" id="pasienkabur_button"
                onclick="update({{$primaryKey}})" disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end Modal -->
  <!-- /advanced legend -->
</div>
</div>
<script type="text/javascript">
  // Function Set Datatable Resep Transaksi
  // Kalau menggunakan datatable tinggal panggil function DataTable('class-tabelnya-apa');
  DataTable('listtransaksi');

  function enable_button()
  {
    $("#pasienkabur_button").removeAttr("disabled").button('refresh');
    $("#kamar_button").removeAttr("disabled").button('refresh');
    $("#tindakan_button").removeAttr("disabled").button('refresh');
    $("#radiologi_button").removeAttr("disabled").button('refresh');
    $("#trDiagMsPrimerId").removeAttr("disabled").button('refresh');
    // $("#trTindRuangan").removeAttr("disabled").button('refresh');
    // $("#trTindMsId").removeAttr("disabled").button('refresh');
    $("#brgFarmasiId").removeAttr("disabled").button('refresh');
    $("#brgProduksiId").removeAttr("disabled").button('refresh');
  }

  function set_informasi_pasien_resep(id, primaryKey)
  {
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
        for (var j = 0; j < fieldobj.length; j++) {
          if (fieldobj[j].type != 'combo') {
            var b = 'dataobj[i].' + fieldobj[j].field;
            $('.'+fieldobj[j].field+'_hidden').hide();
            $('.'+fieldobj[j].field).empty().trigger('change');
            $('.'+fieldobj[j].field).append(eval(b));
          }
        }
      }
    }
  }

  function saveKamar()
  {
    var field = document.getElementById('form_kamar').value;
    var fieldobj = JSON.parse(field);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    postdata.trkRawatId = document.getElementById('{{$primaryKey}}').value;
    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if(fieldobj[j].type == 'angka'){
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_kamar') {
        postdata[fieldobj[j].field+'Id'] = $('#' + fieldobj[j].field + 'Id').val();
        postdata[fieldobj[j].field+'Nama'] = $('#' + fieldobj[j].field + 'Nama').val();
        postdata[fieldobj[j].field1] = parseInt($('#' + fieldobj[j].field1).val());
        postdata[fieldobj[j].field2] = parseInt($('#' + fieldobj[j].field2).val());
      } else{
        var data = data;
      }

      postdata[fieldobj[j].field] = `${data}`;
    }

    var no_k = getLastNumber('tKamar_list');  // no urut kamar
    no_k == 0 ? no_k = 1 : no_k++;
    // console.log(postdata);
    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-kamar",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.status == 401) {
          alertify.error(data.message);
          return;
        } else {
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            if(no_k == 1){
              $('#body_kamar').empty(); // untuk clear empty notif
            }
            var res = `<tr id='kmr${data.trkId}'>
                          <td class="text-center">${no_k}</td>
                          <td>${data.trkTglAwal}</td>
                          <td>${data.trkTglAkhir}</td>
                          <td>${data.trkKamarNama}</td>
                          <td>${data.trkJumHari}</td>
                          <td class="text-right AutoNumeric">${data.trkTarif}</td>
                          <td class="text-right AutoNumeric">${data.trkTotal}</td>
                          <td class="hide"><input type="hidden" id="trkTotal${no_k}" value="${data.trkTotal}"></td>
                          <td>
                            <center>
                              <i onclick="grid_delete_tagihan('kmr${data.trkId}','${data.trkId}','kamar','tKamar_list','trkTotal','tKamar_total')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                            </center>
                          </td>
                        </tr>`;
            $('#tKamar_list').append(res);
            no_k++;
            $('.AutoNumeric').autoNumeric('init');
            sumTable('tKamar_list','trkTotal','tKamar_total');
            // Clear input
            for (var j = 0; j < fieldobj.length; j++) {
              $('#'+fieldobj[j].field).val('');
              $('#'+fieldobj[j].field).val(null).trigger('change');
            }

          }, 500);
        }
      },
      error: function(dataerror) {
        alertify.error(dataerror.responseJSON.message);

      }
    });
  }

  function saveTindakan()
  {
    var field = document.getElementById('form_tindakan').value;
    var fieldobj = JSON.parse(field);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = $('#compId').val();
    postdata.trTindRawatId = $('#{{$primaryKey}}').val();

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if(fieldobj[j].type == 'angka'){
        var data = convertAutoNumber(data); //custom.js
      } else if (fieldobj[j].type == 'autocomplete_ruangan') {
        var jenis = $('#' + fieldobj[j].field + 'Jenis').val();
        if(jenis == 1){
          postdata['trTindPoli'] = $('#' + fieldobj[j].field + 'Id').val();
          postdata['trTindPoliNama'] = $('#' + fieldobj[j].field + 'Nama').val();
          postdata['trTindRuangan'] = null;
          postdata['trTindRuanganNama'] = null;
        }else if(jenis == 2){
          postdata['trTindRuangan'] = $('#' + fieldobj[j].field + 'Id').val();
          postdata['trTindRuanganNama'] = $('#' + fieldobj[j].field + 'Nama').val();
          postdata['trTindPoli'] = null;
          postdata['trTindPoliNama'] = null;
        }else{
          postdata['trTindRuangan'] = $('#' + fieldobj[j].field + 'Id').val();
          postdata['trTindRuanganNama'] = $('#' + fieldobj[j].field + 'Nama').val();
          postdata['trTindPoli'] = null;
          postdata['trTindPoliNama'] = null;
        }
      }else if (fieldobj[j].type == 'autocomplete_tindakan') {
        postdata[fieldobj[j].field+'Nama'] = $('#' + fieldobj[j].field + 'Nama').val();
        postdata[fieldobj[j].field+'Tarif'] = $('#' + fieldobj[j].field + 'Tarif').val();
        postdata['trTindJenis'] = $('#' + fieldobj[j].field + 'Jenis').val();
      }else if (fieldobj[j].type == 'autocomplete_dokter') {
        postdata['trTindDokterId'] = $('#' + fieldobj[j].field + 'Id').val();
        postdata['trTindUser'] = $('#' + fieldobj[j].field + 'Nama').val();
      } else{
        var data = data;
      }

      postdata[fieldobj[j].field] = `${data}`;
    }

    var no_t = getLastNumber('tTindakan_list');  // no urut Tindakan
    no_t == 0 ? no_t = 1 : no_t++;

    if(postdata.trTindMs == ''){
      alertify.error('Tindakan harus diisi');
      return;
    }
    // console.log(postdata);

    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-tindakan",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        console.log('res : ',data);
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            // console.log(data);
            if(no_t == 1){
              $('#body_tindakan').empty(); // untuk clear empty notif
            }
            if(data.trTindKategori == 1){
              var ruangan = data.trTindPoliNama;
            }else{
              var ruangan = data.trTindRuanganNama;
            }
            var res = `<tr id="tind${data.trTindId}">
                        <td class="text-center">${no_t}</td>
                        <td>${data.trTindTgl}</td>
                        <td>${ruangan}</td>
                        <td>${data.trTindTindakan}</td>
                        <td class="text-right AutoNumeric">${data.trTindTarif}</td>
                        <td class="hide"><input type="hidden" id="trTindTarif${no_t}" value="${data.trTindTarif}"></td>
                        <td>
                          <center>
                            <i onclick="grid_delete_tagihan('tind${data.trTindId}','${data.trTindId}','tindakan','tTindakan_list','trTindTarif','tTindakan_total')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                          </center>
                        </td>
                      </tr>`;

            $('#tTindakan_list').append(res);
            no_t++;
            $('.AutoNumeric').autoNumeric('init');
            sumTable('tTindakan_list','trTindTarif','tTindakan_total');
            // Clear input
            for (var j = 0; j < fieldobj.length; j++) {
              $('#'+fieldobj[j].field).val('');
              $('#'+fieldobj[j].field).val(null).trigger('change');
            }

          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function resep(primaryKey)
  {
    var field1 = $('#brgNoResep_show').val();
    var field2 = $('#brgNoTrans_show').val();
    if (field1 == '' || field2 == '') {
      saveResep(primaryKey,1);
    } else {
      saveResep(primaryKey,2);
    }
  }

  function saveResep(primaryKey,update) 
  {
    var field = document.getElementById('form_resep').value;
    var fieldobj = JSON.parse(field);
    //data header ambil dari form_datadiri
    var datadiri = document.getElementById('form_datadiri').value;
    var datadiriobj = JSON.parse(datadiri);
    //data detail ambil dari resep_list
    var table=document.getElementById('tResep_list');
    var nrow=table.rows.length;

    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    postdata.brgRawatId = $('#{{$primaryKey}}').val();
    postdata.brgRuangId = $('#rawatPoliId').val(); //Bisa Poli bisa juga Ruangan (Kamar Ranap)
    postdata.update = update;

    for (var d = 0; d < datadiriobj.length; d++) {
      var val = $('#'+datadiriobj[d].field).val();
      if(datadiriobj[d].type != 'number'){
        if(datadiriobj[d].type == 'angka'){
          var val = convertAutoNumber(val); //custom.js
        }else{
          var val = val;
        }
        var evalText = 'postdata.' + datadiriobj[d].field + "='" + val + "'";
        eval(evalText);
      }
    }

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if(fieldobj[j].type == 'angka'){
        var data = convertAutoNumber(data); //custom.js
      }else{
        var data = data;
      }
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
    }

    // Save resep Detail
    var grid_resep = JSON.parse($('#grid_resep').val());
    var resep_detail=[];
    for (var i=1;i<nrow;i++) {
      var id_ = table.rows[i].cells[0].innerHTML;
      grid_resep.forEach((val,key) => {
        var evalDetail = 'postdata.' + val.field+id_+ "='" + $('#'+val.field+id_).val() + "'";
        eval(evalDetail);
        resep_detail[i]=table.rows[i].cells[0].innerHTML;
      });

      // Validasi Wajib Untuk Qty
      if(eval('postdata.brgQty'+id_) == ''){
        alertify.error('Qty Tidak Boleh Kosong!');
        return '';
      }
      
    }
    postdata.resep_detail = resep_detail;

    // console.log(postdata);

    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-resep",
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          // console.log('data : ',data);
          alertify.success('Berhasil Disimpan');
          setTimeout(function() {
            alertify.confirm('Anda Akan Mengeluarkan Pasien ?',
            function() {
              $('#pasien_keluar').modal("show");
            },
            function() {
              window.open("{{$mainroute}}", "_self");
              alertify.dismissAll();
            }).setHeader('<b> Pasien Keluar !</b> ');
          }, 1000);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  //ketika pilih opsi ex: racikan makan tombol save resep akan enabled.
  function enable_update_button_save_resep(){
    $("#resep_button").removeAttr("disabled").button('refresh');
  }

  function getLastNumber(tabelId)
  {
    var tabel = document.getElementById(tabelId);
    var nrow = tabel.rows.length;
    var lastNumber = parseInt(tabel.rows[nrow-1].cells[0].innerHTML);

    if(lastNumber){
      return lastNumber;
    }else{
      return 0;
    }
  }

  function update(primaryKey) 
  {
    var field = document.getElementById('form_datadiri').value;
    var fieldobj = JSON.parse(field);
    // var pkValue = document.getElementById($primaryKey).value;
    var pkValue = primaryKey.value;
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if(fieldobj[j].type == 'angka'){
        var data = convertAutoNumber(data); //custom.js
      }else{
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

  function grid_edit(id, primaryKey) 
  {
    var data = document.getElementById('datadiri').value;
    var dataobj = JSON.parse(data).data;
    for (var i = 0; i < dataobj.length; i++) {
      var a = 'dataobj[i].' + primaryKey.id;
      // console.log(a);
      if (eval(a) == id) {
        var field = document.getElementById('form_datadiri').value;
        var fieldobj = JSON.parse(field);

        var field2 = document.getElementById('form_pasien_keluar').value;
        var fieldobj2 = JSON.parse(field2);
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
              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
            } else if (fieldobj[j].type == 'angka') {
              $('#'+fieldobj[j].field).autoNumeric('set', eval(b));
            }else {
              document.getElementById(fieldobj[j].field).value = eval(b);
            }
          }
        }
      }
    }
  }

  function sumTable(table,field,field_total)
  {
    var tdata=document.getElementById(table);
    let nrow=tdata.rows.length;
    sumHasil = 0;
    for(var i=1;i<nrow;i++)
    {
      var valTotal = $('#'+field+tdata.rows[i].cells[0].innerHTML).val();
      sumHasil = parseInt(sumHasil)+parseInt(valTotal);
    }

    $('#'+field_total).autoNumeric('set', sumHasil);
    return sumHasil;
  }

  function set_list_pemeriksaan(id)
  {
    $('#body_kamar').empty();
    // $('#body_diagnosa').empty();
    $('#body_tindakan').empty();
    $('#body_resep').empty();
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.tgl = $('#rawatTglDaftar').val();
    $.ajax({
        type: "GET",
        url: "{{$mainroute}}-get-tagihan/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          if (data.kamar.length > 0) {
            data.kamar.forEach((val,key) => {
              var res_k = `<tr id='kmr${val.trkId}'>
                                  <td class="hide">${val.trkId}</td>
                                  <td class="text-center">${key+1}</td>
                                  <td>${val.trkTglAwal}</td>
                                  <td>${val.trkTglAkhir}</td>
                                  <td>${val.trkKamarNama}</td>
                                  <td>${val.trkJumHari}</td>
                                  <td class="text-right AutoNumeric">${val.trkTarif}</td>
                                  <td class="text-right AutoNumeric">${val.trkTotal}</td>
                                  <td class="hide"><input type="text" id="trkTotal${val.trkId}" name="trkTotal${val.trkId}" value="${val.trkTotal}"></td>
                                  <td>
                                    <center>
                                      <i onclick="grid_delete_tagihan('kmr${val.trkId}','${val.trkId}','kamar','tKamar_list','trkTotal','tKamar_total')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                    </center>
                                  </td>
                                </tr>`;
              $('#tKamar_list').append(res_k);
              $('.AutoNumeric').autoNumeric('init');
              sumTable('tKamar_list','trkTotal','tKamar_total');
            });
          }else{
            var res_k = `<tr><th colspan="8" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
            $('#tKamar_list').append(res_k);
          }

          if (data.tindakan.length > 0) {
            data.tindakan.forEach((val,key) => {
              if(val.trTindKategori == 1){
                var ruangan = val.trTindPoliNama;
              }else{
                var ruangan = val.trTindRuanganNama;
              }
              var res_t = `<tr id="tind${val.trTindId}">
                            <td class="hide">${val.trTindId}</td>
                            <td class="text-center">${key+1}</td>
                            <td>${val.trTindTgl}</td>
                            <td>${ruangan}</td>
                            <td>${val.trTindTindakan}</td>
                            <td class="text-right AutoNumeric">${val.trTindTarif}</td>
                            <td class="hide"><input type="text" id="trTindTarif${val.trTindId}" name="trTindTarif${val.trTindId}" value="${val.trTindTarif}"></td>
                            <td>
                              <center>
                                <i onclick="grid_delete_tagihan('tind${val.trTindId}','${val.trTindId}','tindakan','tTindakan_list','trTindTarif','tTindakan_total')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                              </center>
                            </td>
                          </tr>`;
              $('#tTindakan_list').append(res_t);
              $('.AutoNumeric').autoNumeric('init');
              sumTable('tTindakan_list','trTindTarif','tTindakan_total');
            });
          }else{
            var res_t = `<tr><th colspan="6" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
            $('#tTindakan_list').append(res_t);
          }

          if (data.resep.length > 0) {
            var racikan = JSON.parse($('#obat_racikan').val());
            var dosis = JSON.parse($('#obat_dosis').val());
            var waktu = JSON.parse($('#obat_waktu').val());
            var aturan = JSON.parse($('#obat_aturan').val());
            data.resep.forEach((val,key) => {
              // console.log(val);
              $('#brgNoResep_show').val(val.resepNo);
              $('#brgNoTrans_show').val(val.resepNoTrans);
              $('#brgRc1').val(val.resepRc1);
              $('#brgRc2').val(val.resepRc2);
              $('#brgRc3').val(val.resepRc3);
              $('#brgRc4').val(val.resepRc4);

              //disable tombol inputan obat jika resep sudah diproses
              if(val.resepStatus == 1){
                $("#brgFarmasiId").attr("disabled", "disabled").button('refresh');
                $("#brgProduksiId").attr("disabled", "disabled").button('refresh');
              }
              
              data.resep[key].detail.forEach((val2,key2) => {
                var res_r = `<tr id="resep${key2+1}">
                              <td>${key2+1}</td>
                              <td>${val2.resepDetKode}<input type="hidden" id="brgKode${key2+1}" value="${val2.resepDetKode}"></td>
                              <td>${val2.resepDetNama}<input type="hidden" id="brgNama${key2+1}" value="${val2.resepDetNama}"></td>
                              <td><input type="text" id="brgKet${key2+1}" class="form-control" placeholder="Keterangan Obat" value="${val2.resepDetKeterangan == null ? "" : val2.resepDetKeterangan}" onChange="enable_update_button_save_resep()"></td>
                              <td><select id="brgRacikan${key2+1}" class="brgRacikan form-control" style="width: 100%;" onChange="enable_update_button_save_resep()">
                                              <option value="">Racikan</option>`;
                                              racikan.forEach((val_r,key) => {
                                                res_r += `<option value="${val_r.comboValue}" ${val_r.comboValue == val2.resepDetRacikan ? 'selected' : ''}>${val_r.comboLabel}</option>`;
                                              });
                                    res_r += `</select>
                              </td>
                              <td><select id="brgDosis${key2+1}" class="brgDosis form-control" style="width: 100%;" onChange="enable_update_button_save_resep()">
                                              <option value="">Dosis</option>`;
                                              dosis.forEach((val_d,key) => {
                                                res_r += `<option value="${val_d.comboValue}" ${val_d.comboValue == val2.resepDetDosis ? 'selected' : ''}>${val_d.comboLabel}</option>`;
                                              });
                                    res_r += `</select>
                              </td>
                              <td><select id="brgWaktu${key2+1}" class="brgWaktu form-control" style="width: 100%;" onChange="enable_update_button_save_resep()">
                                              <option value="">Waktu</option>`;
                                              waktu.forEach((val_w,key) => {
                                                res_r += `<option value="${val_w.comboValue}" ${val_w.comboValue == val2.resepDetWaktu ? 'selected' : ''}>${val_w.comboLabel}</option>`;
                                              });
                                    res_r += `</select>
                              </td>
                              <td><select id="brgAturan${key2+1}" class="brgAturan form-control" style="width: 100%;" onChange="enable_update_button_save_resep()">
                                              <option value="">Aturan</option>`;
                                              aturan.forEach((val_a,key) => {
                                                res_r += `<option value="${val_a.comboValue}" ${val_a.comboValue == val2.resepDetAturan ? 'selected' : ''}>${val_a.comboLabel}</option>`;
                                              });
                                    res_r += `</select>
                              </td>
                              <td><input type="number" id="brgQty${key2+1}" class="form-control" placeholder="Qty" value="${val2.resepDetQty}" onChange="enable_update_button_save_resep()"></td>
                              <td class="hide"><input type="hidden" id="brgHarga${key2+1}" value="${val2.resepDetHarga == '' ? 0 : val2.resepDetHarga}"></td>
                              <td>${val2.resepDetSatuan == '' ? "-" : val2.resepDetSatuan}<input type="hidden" id="brgSatuan${key2+1}" value="${val2.resepDetSatuan == '' ? "-" : val2.resepDetSatuan}"></td>
                              <td>
                                <center>`;
                                  if (val.resepStatus == 0) {
                                    res_r += `<i onclick="grid_delete_resep('resep${key2+1}','${val2.resepDetId}','model_resepdetail')" class="list-icons-item text-danger-600 text-center icon-trash"></i>`;
                                  }else{
                                    res_r += `<i class="list-icons-item text-grey-600 text-center icon-trash"></i>`;
                                  }
                            res_r += `</center>
                              </td>
                            </tr>`;
                $('#tResep_list').append(res_r);
                $(".brgRacikan").select2({
                    placeholder: "Racikan",
                    minimumResultsForSearch: Infinity
                });
                $(".brgDosis").select2({
                    placeholder: "Dosis",
                });
                $(".brgWaktu").select2({
                    placeholder: "Waktu",
                });
                $(".brgAturan").select2({
                    placeholder: "Aturan",
                });
              });
            });
          }else{
            var res_r = `<tr><th colspan="11" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
            $('#tResep_list').append(res_r);
          }



        },
        error: function(dataerror) {
          console.log(dataerror);
        }
    });
  }

  function setAutocompleteVal(api,idx,tx,field) 
  {
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

  function grid_delete_tagihan(item,id,model,table,field,field_total) 
  {
    //item,id,model = untuk kebutuhan delete item
    //table,field,field_total = untuk menghitung total tabel kembali
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}-del-tagihan/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          // console.log(data);
          alertify.success('Berhasil Dihapus');
          setTimeout(function() {
            $('#'+item).remove();
            sumTable(table,field,field_total);
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

  function delete_raw_resep(id)
  {
    $('#resep'+id).remove();
    //jika countrow 0 maka tombol disabled
    var countrow = getLastNumber('tResep_list');
    if(countrow == 0){
      $("#resep_button").attr("disabled", "disabled").button('refresh');
      // $("#resep_list_button").attr("disabled", "disabled").button('refresh');
    }
  }

</script>
<x-templete_bottom />