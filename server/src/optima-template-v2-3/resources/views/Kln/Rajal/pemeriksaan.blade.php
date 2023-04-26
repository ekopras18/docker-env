<x-templete_top :data="$data" />
<div class="row">
  <div class="col-xl-8">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card card-body">
          <div class="media">
            <div class="mr-1">
              <li class="list-inline-item"><a href="#"
                  class="btn btn-outline bg-primary btn-icon text-primary-green border-primary-green border-2 rounded-round">
                  <i class="fa fa-user-md"></i></a>
              </li>
            </div>
            <div class="col-xl-7">
              <div class="media-body">
                <div class="font-weight-semibold">{{$dokter_info['info']->dokNama ?? '-'}} <span
                    class="badge badge-mark bg-success border-success"></span></div>
                <span class="text-muted">{{$dokter_info['info']->dokNip ?? '-'}}</span>
              </div>
            </div>
            <div class="col-xl-5">
              <div class="media-body">
                <input type="hidden" id="rawatPoliId" value="{{$dokter_info['info']->rId ?? 0}}">
                <input type="hidden" id="rawatPoliNama" value="{{$dokter_info['info']->rNama ?? '-'}}">
                <!-- idpoli untuk disimpan didiagnosa & tindakan -->
                <div class="font-weight-semibold">{{$dokter_info['info']->rNama ?? '-'}}</div>
                <span class="text-muted">{{$dokter_info['info']->jenisPoli ?? '-'}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

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
                    <th width="8%">ACTION</th>
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
                    onclick="grid_edit({{$pmKey}},{{$primaryKey}}),enable_button(),set_list_pemeriksaan({{$primaryKey}}),set_list_histori({{$pmKey}}),set_informasi_pasien_resep({{$pmKey}},{{$primaryKey}})">
                    <td class="text-center">{{$key+1}}</td>
                    @foreach($grid as $datagrid)
                    @php
                    $field=$datagrid['field'];
                    $value=$data->$field;
                    @endphp
                    <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['class'] ?? ''}}">{!!
                      html_entity_decode($value) !!} </td>
                    @endforeach
                    <td>
                      <center>
                        <input type="hidden" id="gridPmKey{{$rowIndex}}" name="gridPmKey{{$rowIndex}}"
                          value="{{$pmKey}}">
                        <a onclick="cetak_kartu({{$pmKey}})" data-popup="tooltip" title="Cetak Kartu"
                          data-placement="left"
                          style=" color: #2196F3; padding:4px;max-width: 30px;max-height: 30px;"><i
                            class="icon-printer"></i></a>
                        <a onclick="cetak_history({{$pmKey}})" data-popup="tooltip" title="Cetak History"
                          data-placement="top" style=" color: #2196F3; padding:4px;max-width: 30px;max-height: 30px;"><i
                            class="icon-printer"></i></a>

                      </center>
                    </td>
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
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">HISTORI PASIEN</h5>
        <div class="header-elements">
          <div class="list-icons">
            <a class="list-icons-item" data-action="fullscreen"></a>
            <a class="list-icons-item" data-action="collapse"></a>
            <!-- <a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a> -->
          </div>
        </div>
      </div>

      <div class="card-body p-0">
        <!-- Accordion with right control button -->
        <div class="card-group-control card-group-control-right" id="accordion-control-right">
          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a data-toggle="collapse" class="text-default font-size-sm" href="#riwayat0"></span>TANDA - TANDA
                  VITAL<span class="badge badge-flat badge-pill border-primary-green text-secondary ml-2"
                    id="tanda_count">0</span></a>
              </h6>
            </div>

            <div id="riwayat0" class="collapse show font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tTanda_history" class="table table-xs" style="width:100% !important;">
                    <tbody id="body_h_tanda">
                      <tr>
                        <th colspan="7" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat1">TINDAKAN <span
                    class="badge badge-flat badge-pill border-primary-green text-secondary ml-2"
                    id="tindakan_count">0</span></a></a>
              </h6>
            </div>

            <div id="riwayat1" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tTindakan_history" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th>Tindakan</th>
                        <th>Keterangan</th>
                        <th width="3%">Hasil</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody id="body_h_tindakan">
                      <tr>
                        <th colspan="6" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat2">OBAT <span
                    class="badge badge-flat badge-pill border-primary-green text-secondary ml-2">0</span></a></a>
              </h6>
            </div>

            <div id="riwayat2" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tObat" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th colspan="2">Obat</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="alpha-primary">
                        <td colspan="2">1.</td>
                        <td colspan="2"><b>DR. RIO ARDONA, MMRS</b></td>
                        <td><b>12 April 2022</b></td>
                        <td></td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>1.</td>
                        <td colspan="3">Nama Obat sasdadas</td>
                        <td>23.90</td>
                      </tr>
                      <tr class="alpha-primary">
                        <td colspan="2">2.</td>
                        <td colspan="2"><b>DR. RIO ARDONA, MMRS</b></td>
                        <td><b>11 April 2022</b></td>
                        <td></td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>1.</td>
                        <td colspan="3">Nama Obat sasdadas</td>
                        <td>23.90</td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>2.</td>
                        <td colspan="3">Nama Obat </td>
                        <td>23.90</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat3">DIAGNOSA <span
                    class="badge badge-flat badge-pill border-primary-green text-secondary ml-2"
                    id="diagnosa_count">0</span></a>
              </h6>
            </div>

            <div id="riwayat3" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tDiagnosa_history" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th>Jenis</th>
                        <th colspan="3" width="45%">Diagnosa</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody id="body_h_diagnosa">
                      <tr>
                        <th colspan="7" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat4">ANAMNESA
                  <span class="badge badge-flat badge-pill border-primary-green text-secondary ml-2"
                    id="anamnesa_count">0</span></a>
              </h6>
            </div>

            <div id="riwayat4" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tAnamnesa_history" class="table table-xs" style="width:100% !important;" border="0">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th colspan="2">Anamnesa</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody id="body_h_anamnesa">
                      <tr>
                        <th colspan="5" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat5">LABORATORIUM
                  <span class="badge badge-flat badge-pill border-primary-green text-secondary ml-2">0</span></a>
              </h6>
            </div>

            <div id="riwayat5" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tLab" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th>Laboratorium</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="alpha-primary">
                        <td colspan="2">1.</td>
                        <td><b> Hasil Pemeriksaan Tanggal : 12 April 2022</b></td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>1.</td>
                        <td>Nama Tindakan 1</td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>2.</td>
                        <td>Nama Tindakan 2</td>
                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-0 rounded-bottom-0">
            <div class="card-header pb-1 pt-1">
              <h6 class="card-title">
                <a class="collapsed text-default font-size-sm" data-toggle="collapse" href="#riwayat6">RADIOLOGI <span
                    class="badge badge-flat badge-pill border-primary-green text-secondary ml-2">0</span></a>
              </h6>
            </div>

            <div id="riwayat6" class="collapse font-size-sm" data-parent="#accordion-control-right">
              <div class="card-body">
                <div class="table-responsive table-scrollable">
                  <table id="tRad" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%" colspan="2">No</th>
                        <th>Radiologi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="alpha-primary">
                        <td colspan="2">1.</td>
                        <td><b> Hasil Pemeriksaan Tanggal : 12 April 2022</b></td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>1.</td>
                        <td>Nama Tindakan 1</td>
                      </tr>
                      <tr class="font-size-sm">
                        <td></td>
                        <td>2.</td>
                        <td>Nama Tindakan 2</td>
                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /accordion with right control button -->
      </div>
    </div>
  </div>
  <div class="col-xl-3">
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
        <div class="text-right">
          <button type="submit" class="btn btn-sm btn-primary" id="datadiri_button" onclick="update({{$primaryKey}})"
            disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
        </div>
        <!-- </form> -->
      </div>
    </div>
    <!-- /basic layout -->
  </div>
  <div class="col-xl-9">
    <!-- Advanced legend -->
    <div class="card">
      <div class="card-header header-elements-inline">
        <h5 class="card-title">PEMERIKSAAN PASIEN</h5>
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
            SUBJECTIVE & OBJECTIVE
            <a href="#" class="float-right text-default" data-toggle="collapse" data-target="#anam">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="anam">
            <input type="hidden" id="rawattglDaftar" name="rawattglDaftar">
            <input type="hidden" id="form_anamnesa" name="form_anamnesa" value="{{json_encode($form_anamnesa)}}">
            <div class="row">
              @csrf
              @foreach($form_anamnesa as $dataform)
              @if($dataform['type']=='textarea')
              <div class="col-xl-{{$dataform['col'] ?? 12}}">
                <div class="form-group">
                  <label class="form-label"><b>{{$dataform['label']}}</b></label>
                  <textarea class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" cols="20"
                    rows="3" placeholder="{{$dataform['placeholder']}}"></textarea>
                  <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                </div>
              </div>
              @endif
              @endforeach
              <div class="col-xl-12">
                <br>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary" id="anamnesa_button" onclick="saveAnamnesa()"
                    disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
                </div>
                <br>
              </div>
              <div class="col-xl-12 mt-2">
                <div class="table-responsive table-scrollable">
                  <table id="tAnamnesa_list" class="table table-xs" style="width:100% !important;">
                    <thead
                      style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                      <tr>
                        <th width="3%">No</th>
                        <th>Tanggal</th>
                        <th>Anamnesa</th>
                        <th width="3%">Del</th>
                      </tr>
                    </thead>
                    <tbody id="body_anamnesa">
                      <tr>
                        <th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </fieldset>
        <fieldset class="mb-2">
          <legend class="font-weight-semibold text-uppercase font-size-lg">
            <i class="icon-reading mr-2"></i>
            Diagnosa & Tindakan
            <a class="float-right text-default" data-toggle="collapse" data-target="#tind">
              <i class="icon-circle-down2"></i>
            </a>
          </legend>

          <div class="collapse show" id="tind">
            <div class="row">
              <input type="hidden" id="form_diagnosa" name="form_diagnosa" value="{{json_encode($form_diagnosa)}}">
              <div class="col-xl-6 p-1">
                <div class="div">
                  @csrf
                  @foreach($form_diagnosa as $dataform)
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
                            // console.log(e.params.data);
                              var postdata = {};
                              postdata._token = document.getElementsByName('_token')[0].defaultValue;
                              postdata.compId = $('#compId').val();
                              postdata.rawatId = $('#{{$primaryKey}}').val();
                              postdata.rawatPoliId = $('#rawatPoliId').val();
                              postdata.rawatTglDaftar = $('#rawatTglDaftar').val();
                              postdata.{{$dataform["field"]}} = $('#{{$dataform["field"]}}').val();
                              postdata.nama = e.params.data.nama;

                              var no_d = getLastNumber('tDiagnosa_list');  // no urut diagnosa
                              no_d == 0 ? no_d = 1 : no_d++;
                              // console.log(postdata);

                              $.ajax({
                                type: "POST",
                                url: "/{{$mainroute}}-diagnosa",
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
                                      // console.log(data);
                                      if(no_d == 1){
                                        $('#body_diagnosa').empty(); // untuk clear empty notif
                                      }
                                      var res = `<tr id="diag${data.trDiagId}">
                                                  <td class="text-center">${no_d}</td>
                                                  <td>${data.trDiagTgl}</td>
                                                  <td>${data.trDiagDiagnosa}</td>
                                                  <td>
                                                    <center>
                                                      <i onclick="grid_delete_pemeriksaan('diag${data.trDiagId}','${data.trDiagId}','diagnosa')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                                    </center>
                                                  </td>
                                                </tr>`;

                                      $('#tDiagnosa_list').append(res);
                                      no_d++;
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
                  <div class="col-xl-12 mt-2">
                    <div class="table-responsive table-scrollable">
                      <table id="tDiagnosa_list" class="table table-xs" style="width:100% !important;">
                        <thead
                          style="position: sticky; top: 0;box-shadow: 0 2px 2px -1px rgba(147, 147, 147, 0.4); z-index: 1;">
                          <tr>
                            <th width="3%">No</th>
                            <th>Tanggal</th>
                            <th>Diagnosa</th>
                            <th>Del</th>
                          </tr>
                        </thead>
                        <tbody id="body_diagnosa">
                          <tr>
                            <th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" id="form_tindakan" name="form_tindakan" value="{{json_encode($form_tindakan)}}">
              <div class="col-xl-6 p-1">
                <div class="row">
                  @csrf
                  @foreach($form_tindakan as $dataform)
                  @if($dataform['type']=='autocomplete')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <label class="form-label"><b>{{$dataform['label']}}</b></label>
                      <input type="hidden" id="{{$dataform['field']}}_name">
                      <input type="hidden" id="{{$dataform['field']}}_tarif">
                      <input type="hidden" id="{{$dataform['field']}}_jenis">
                      <select name="{{$dataform['field']}}" id="{{$dataform['field']}}"
                        class="{{$dataform['field']}} form-control" style="width: 100%;" disabled>
                        <option value="">{{$dataform['default']}}</option>
                      </select>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                      <script type="text/javascript">
                        $(".{{$dataform['field']}}").on("select2:select", function(e) {
                          $("#{{$dataform['field']}}_name").val(e.params.data.nama);
                          $("#{{$dataform['field']}}_tarif").val(e.params.data.tarif);
                          $("#{{$dataform['field']}}_jenis").val(e.params.data.jenis);
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
                  @elseif($dataform['type']=='textarea')
                  <div class="col-sm-{{$dataform['col'] ?? 12}}">
                    <div class="form-group">
                      <label class="form-label"><b>{{$dataform['label']}}</b></label>
                      <textarea class="form-control" id="{{$dataform['field']}}" name="{{$dataform['field']}}" cols="20"
                        rows="3" placeholder="{{$dataform['placeholder']}}"></textarea>
                      <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                    </div>
                  </div>
                  @endif
                  @endforeach
                  <div class="col-xl-12">
                    <br>
                    <div class="text-right">
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
                            <th>Tindakan</th>
                            <th>keterangan</th>
                            <th>Hasil</th>
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
                </div>
              </div>
            </div>
          </div>
        </fieldset>
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
              <div class="col-xl-12 p-1">
                <div class="card border-left-3 border-left-success rounded-left-0">
                  <div class="card-header header-elements-inline">
                    <h5 class="card-title font-weight-semibold font-size-lg">Informasi Pasien</h5>
                    <div class="header-elements">
                      <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="media">
                      <div class="col-xl-4">
                        <div class="media-body">
                          <h6 class="font-weight-semibold"><span class="rawatNama_hidden">-</span><span
                              class="rawatNama"></span></h6>
                          <ul class="list list-unstyled mb-0">
                            <li><span class="rawatLahir_hidden">-</span><span class="rawatLahir"></span> (<span
                                class="rawatUmur_hidden">-</span><span class="rawatUmur"></span>)</li>
                            <li><span class="rawatAlm_hidden">-</span><span class="rawatAlm"></span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-xl-4">
                        <div class="media-body">
                          <h6 class="font-weight-semibold"><span class="rawatRm_hidden">-</span><span
                              class="rawatRm"></span> </h6>
                          <ul class="list list-unstyled mb-0">
                            <li><span class="rawatGen_hidden">-</span><span class="rawatGen"></span></li>
                            <li><span class="rawatAsuransi_hidden">-</span><span class="rawatAsuransi"></span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-xl-4">
                        <div class="media-body">
                          <h6 class="font-weight-semibold"><span class="rawatDokter_hidden">-</span><span
                              class="rawatDokter"></span></h6>
                          <ul class="list list-unstyled mb-0">
                            <li><span class="rawatPol_hidden">-</span><span class="rawatPol"></span></li>
                            <li><span class="rawatNoAsuransi_hidden">-</span><span class="rawatNoAsuransi"></span></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
                                          <td class="text-center">${no_r}</td>
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
                            <i class="icon-exit3 mr-1"></i> Pasien Keluar</button>
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
              <button type="submit" class="btn btn-sm btn-primary" id="keluar_button"
                onclick="pasienkeluar({{$primaryKey}})" disabled><i class="icon-floppy-disk mr-1"></i> Save</button>
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
    $("#keluar_button").removeAttr("disabled").button('refresh');
    $("#datadiri_button").removeAttr("disabled").button('refresh');
    $("#anamnesa_button").removeAttr("disabled").button('refresh');
    $("#tindakan_button").removeAttr("disabled").button('refresh');
    $("#trDiagMsPrimerId").removeAttr("disabled").button('refresh');
    $("#trTindMsId").removeAttr("disabled").button('refresh');
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

  function saveAnamnesa()
  {
    var field = document.getElementById('form_anamnesa').value;
    var fieldobj = JSON.parse(field);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;
    postdata.rawatId = document.getElementById('{{$primaryKey}}').value;
    postdata.rawatTglDaftar = $('#rawatTglDaftar').val();
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

    var no_a = getLastNumber('tAnamnesa_list');  // no urut anamnesa
    no_a == 0 ? no_a = 1 : no_a++;
    // console.log(postdata);
    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-anamnesa",
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
            // console.log('no : ',no_a);
            // console.log('tes : ',data);
            if(no_a == 1){
              $('#body_anamnesa').empty(); // untuk clear empty notif
            }
            var res = `<tr id='anam${data.anamId}'>
                          <td class="text-center">${no_a}</td>
                          <td>${data.anamTgl}</td>
                          <td>${data.anamAnamnesa}</td>
                          <td>
                            <center>
                              <i onclick="grid_delete_pemeriksaan('anam${data.anamId}','${data.anamId}','anamnesa')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                            </center>
                          </td>
                        </tr>`;
            $('#tAnamnesa_list').append(res);
            no_a++;
            // Clear input
            for (var j = 0; j < fieldobj.length; j++) {
              $('#'+fieldobj[j].field).val('');
            }

          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });
  }

  function saveTindakan()
  {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = $('#compId').val();
    postdata.tindRawatId = $('#{{$primaryKey}}').val();
    postdata.tindPoliId = $('#rawatPoliId').val();
    postdata.tindPoliNama = $('#rawatPoliNama').val();
    postdata.tindTglDaftar = $('#rawatTglDaftar').val();
    postdata.tindMsId = $('#trTindMsId').val();
    postdata.tindNama = $('#trTindMsId_name').val();
    postdata.tindJenis = $('#trTindMsId_jenis').val();
    postdata.tindKeterangan = $('#trTindKeterangan').val();
    postdata.tindHasil = $('#trTindHasil').val();
    postdata.tindTarif = $('#trTindMsId_tarif').val();

    var no_t = getLastNumber('tTindakan_list');  // no urut Tindakan
    no_t == 0 ? no_t = 1 : no_t++;

    // console.log(postdata);

    $.ajax({
      type: "POST",
      url: "/{{$mainroute}}-tindakan",
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
            // console.log(data);
            if(no_t == 1){
              $('#body_tindakan').empty(); // untuk clear empty notif
            }
            var res = `<tr id="tind${data.trTindId}">
                        <td class="text-center">${no_t}</td>
                        <td>${data.trTindTgl}</td>
                        <td>${data.trTindTindakan}</td>
                        <td>${data.trTindKeterangan}</td>
                        <td>${data.trTindHasil}</td>
                        <td>
                          <center>
                            <i onclick="grid_delete_pemeriksaan('tind${data.trTindId}','${data.trTindId}','tindakan')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                          </center>
                        </td>
                      </tr>`;

            $('#tTindakan_list').append(res);
            no_t++;
            // Clear input
            $('#trTindMsId').val(null).trigger('change');
            $('#trTindKeterangan').val(null).trigger('change');
            $('#trTindHasil').val(null).trigger('change');

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
        postdata[datadiriobj[d].field] = `${val}`;
      }
    }

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      if(fieldobj[j].type == 'angka'){
        var data = convertAutoNumber(data); //custom.js
      }else{
        var data = data;
      }
      postdata[fieldobj[j].field] = `${data}`;
    }

    // Save resep Detail
    var grid_resep = JSON.parse($('#grid_resep').val());
    var resep_detail=[];
    for (var i=1;i<nrow;i++) {
      var id_ = table.rows[i].cells[0].innerHTML;
      grid_resep.forEach((val,key) => {
        postdata[val.field+id_] = `${$('#'+val.field+id_).val()}`;
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
  function enable_update_button_save_resep()
  {
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

  function pasienkeluar(primaryKey)
  {
    var field = document.getElementById('form_pasien_keluar').value;
    var fieldobj = JSON.parse(field);

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
      postdata[fieldobj[j].field] = `${data}`;
    }
    console.log(postdata);
    console.log(pkValue);
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
            }else if (fieldobj[j].type == 'angka') {
              $('#'+fieldobj[j].field).autoNumeric('set', eval(b));
            } else {
              document.getElementById(fieldobj[j].field).value = eval(b);
            }
          }
        }

        //Pasien Keluar
        for (var k = 0; k < fieldobj2.length; k++) {
          var val = 'dataobj[i].' + fieldobj2[k].field;
          if (fieldobj2[k].type != 'password') {
            if (fieldobj2[k].type == 'combo') {
              $("#" + fieldobj2[k].field).val(eval(val)).find(':selected').trigger('change');
            }else if (fieldobj2[k].type == 'angka') {
              $('#'+fieldobj2[k].field).autoNumeric('set', eval(val));
            }else if(fieldobj2[k].type == 'date'){
              const d = new Date();
              const date = d.toLocaleDateString("id-ID", { 
                    year: "numeric",
                    month: "2-digit",
                    day: "2-digit",
                  });
              //merubah 02/09/2022 -> 2022-09-02
              var curr_date = date.replace(/\//g, "-").split("-").reverse().join("-");
              $('#'+fieldobj2[k].field).val(curr_date);
            } else {
              document.getElementById(fieldobj2[k].field).value = eval(val);
            }
          }
        }
      }
    }
  }

  function set_list_pemeriksaan(primaryKey)
  {
    var id = primaryKey.value;
    $('#body_anamnesa').empty();
    $('#body_diagnosa').empty();
    $('#body_tindakan').empty();
    $('#body_resep').empty();
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.tgl = $('#rawatTglDaftar').val();
    $.ajax({
        type: "GET",
        url: "{{$mainroute}}-get-pemeriksaan/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          if (data.anamnesa.length > 0) {
            data.anamnesa.forEach((val,key) => {
              var res_a = `<tr id='anam${val.anamId}'>
                                  <td class="text-center">${key+1}</td>
                                  <td>${val.anamTgl}</td>
                                  <td>${val.anamAnamnesa}</td>
                                  <td>
                                    <center>
                                      <i onclick="grid_delete_pemeriksaan('anam${val.anamId}','${val.anamId}','anamnesa')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                                    </center>
                                  </td>
                                </tr>`;
              $('#tAnamnesa_list').append(res_a);
            });
          }else{
            var res_a = `<tr><th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
            $('#tAnamnesa_list').append(res_a);
          }

          if (data.diagnosa.length > 0) {
            data.diagnosa.forEach((val,key) => {
              var res_d = `<tr id="diag${val.trDiagId}">
                            <td class="text-center">${key+1}</td>
                            <td>${val.trDiagTgl}</td>
                            <td>${val.trDiagDiagnosa}</td>
                            <td>
                              <center>
                                <i onclick="grid_delete_pemeriksaan('diag${val.trDiagId}','${val.trDiagId}','diagnosa')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                              </center>
                            </td>
                          </tr>`;
              $('#tDiagnosa_list').append(res_d);
            });
          }else{
            var res_d = `<tr><th colspan="4" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
            $('#tDiagnosa_list').append(res_d);
          }

          if (data.tindakan.length > 0) {
            data.tindakan.forEach((val,key) => {
              var res_t = `<tr id="tind${val.trTindId}">
                            <td class="text-center">${key+1}</td>
                            <td>${val.trTindTgl}</td>
                            <td>${val.trTindTindakan}</td>
                            <td>${val.trTindKeterangan}</td>
                            <td>${val.trTindHasil}</td>
                            <td>
                              <center>
                                <i onclick="grid_delete_pemeriksaan('tind${val.trTindId}','${val.trTindId}','tindakan')" class="list-icons-item text-danger-600 text-center icon-trash"></i>
                              </center>
                            </td>
                          </tr>`;
              $('#tTindakan_list').append(res_t);
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
              
              if (data.resep[key].detail.length > 0) {

                data.resep[key].detail.forEach((val2,key2) => {
                  var res_r = `<tr id="resep${key2+1}">
                                <td class="text-center">${key2+1}</td>
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

              }else{
                var res_r = `<tr><th colspan="11" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
                $('#tResep_list').append(res_r);
              }

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

  function set_list_histori(id)
  {
    $('#body_h_tanda').empty();
    $('#body_h_anamnesa').empty();
    $('#body_h_diagnosa').empty();
    $('#body_h_tindakan').empty();

    $.getJSON("{{$mainroute}}-get-histori/"+id, function(data) {
      if (data.h_tanda.length > 0) {
        data.h_tanda.forEach((val,key) => { // layer 1
          data.h_tanda[key].tanda.forEach((val2,key2) => { //layer 2
            var res_td = `<tr class="alpha-primary">
                  <td>${key2+1}.</td>
                  <td colspan="6"><b>${val2.dokter} - ${val2.tgl}</b></td>
                </tr>
                <tr class="font-size-sm">
                  <td></td>
                  <td>TB</td>
                  <td><b>: ${val2.tb}</b></td>
                  <td>BB</td>
                  <td><b>: ${val2.bb}</b></td>
                  <td>Gol. Darah</td>
                  <td><b>: ${val2.gd}</b></td>
                </tr>
                <tr class="font-size-sm">
                  <td></td>
                  <td>L. Perut</td>
                  <td><b>: ${val2.lp}</b></td>
                  <td>IMT</td>
                  <td><b>: ${val2.imt}</b></td>
                  <td>Suhu</td>
                  <td><b>: ${val2.suhu}</b></td>
                </tr>
                <tr class="font-size-sm">
                  <td></td>
                  <td>Sistole</td>
                  <td><b>: ${val2.stole}</b></td>
                  <td>Diastole</td>
                  <td><b>: ${val2.dtole}</b></td>
                  <td>Resp. Rate</td>
                  <td><b>: ${val2.rr}</b></td>
                </tr>
                <tr class="font-size-sm">
                  <td></td>
                  <td>Heart Rate</td>
                  <td><b>: ${val2.hr}</b></td>
                  <td>Nadi</td>
                  <td><b>: ${val2.nadi}</b></td>
                  <td>Spo2</td>
                  <td><b>: ${val2.spo}</b></td>
                </tr>`;

                $('#tTanda_history').append(res_td);
                $('#tanda_count').html(data.h_tanda[key].tanda.length);
            });
        });
      }else{
        var res_td = `<tr><th colspan="7" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
        $('#tTanda_history').append(res_td);
        $('#tanda_count').html(data.h_tanda.length);
      }

      if (data.h_anamnesa.length > 0) {
        data.h_anamnesa.forEach((val,key) => {
          var res_a = `<tr class="alpha-primary">
                        <td colspan="2">${key+1}.</td>
                        <td colspan="2"><b>${val.dokter}</b></td>
                        <td><b>${val.tgl}</b></td>
                      </tr>`;
                  data.h_anamnesa[key].anamnesa.forEach((val2,key2) => {
                    res_a += `<tr class="font-size-sm">
                        <td></td>
                        <td>${key2+1}.</td>
                        <td colspan="2">${val2.anamnesa}</td>
                        <td></td>
                      </tr>`;
                  });
          $('#tAnamnesa_history').append(res_a);
          // set count items
          $('#anamnesa_count').html(data.h_anamnesa.length);
        });
      }else{
        var res_a = `<tr><th colspan="5" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
        $('#tAnamnesa_history').append(res_a);
        $('#anamnesa_count').html(data.h_anamnesa.length);
      }

      if (data.h_diagnosa.length > 0) {
        data.h_diagnosa.forEach((val,key) => {
          var res_d = `<tr class="alpha-primary">
                        <td colspan="2">${key+1}.</td>
                        <td colspan="4"><b>${val.dokter}</b></td>
                        <td colspan="2"><b>${val.tgl}</b></td>
                      </tr>`;
                      data.h_diagnosa[key].diagnosa.forEach((val2,key2) => {
                      res_d += `<tr class="font-size-sm">
                                  <td></td>
                                  <td>${key2+1}.</td>
                                  <td>${val2.jenis}</td>
                                  <td colspan="4">${val2.name}</td>
                              </tr>`;
                      });
          $('#tDiagnosa_history').append(res_d);
          // set count items
          $('#diagnosa_count').html(data.h_diagnosa.length);
        });
      }else{
        var res_d = `<tr><th colspan="7" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
        $('#tDiagnosa_history').append(res_d);
        $('#diagnosa_count').html(data.h_diagnosa.length);
      }

      if (data.h_tindakan.length > 0) {
        data.h_tindakan.forEach((val,key) => {
          var res_t = `<tr class="alpha-primary">
                        <td colspan="2">${key+1}.</td>
                        <td colspan="3"><b>${val.dokter}</b></td>
                        <td><b>${val.tgl}</b></td>
                      </tr>`;
                  data.h_tindakan[key].tindakan.forEach((val2,key2) => {
                       res_t += `<tr class="font-size-sm">
                                  <td></td>
                                  <td>${key2+1}.</td>
                                  <td>${val2.name}</td>
                                  <td>${val2.keterangan}</td>
                                  <td>${val2.hasil}</td>
                                  <td></td>
                                </tr>`;
                      });
          $('#tTindakan_history').append(res_t);
          // set count items
          $('#tindakan_count').html(data.h_tindakan.length);
        });
      }else{
        var res_t = `<tr><th colspan="6" class="text-center"><i class="icon-info22"></i> Empty</th></tr>`;
        $('#tTindakan_history').append(res_t);
        $('#tindakan_count').html(data.h_tindakan.length);
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

  function grid_delete_pemeriksaan(item,id,model) 
  {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}-pemeriksaan-del/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          // console.log(data);
          alertify.success('Berhasil Dihapus');
          setTimeout(function() {
            // $('#'+item).remove();
            set_list_pemeriksaan({{$primaryKey}}); // set auto number list
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

  // diarahkan ke fungsi destroy_pemeriksaan
  function grid_delete_resep(item,id,model)
  {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}-pemeriksaan-del/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          // console.log(data);
          alertify.success('Berhasil Dihapus');
          setTimeout(function() {
            // $('#'+item).remove();
            set_list_pemeriksaan({{$primaryKey}}); // set auto number list
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

  function grid_transaksi_delete(id)
  {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}-resep-trans-del/" + id,
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