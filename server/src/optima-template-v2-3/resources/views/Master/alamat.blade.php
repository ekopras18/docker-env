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
              <li onclick="tab('prov')" class="nav-item"><a href="#left-icon-tab1" id="tab1" class="nav-link active" data-toggle="tab"><i
                    class="icon-location4 mr-2"></i> PROVINSI</a></li>
              <li onclick="tab('kab')" class="nav-item"><a href="#left-icon-tab2" id="tab2" class="nav-link" data-toggle="tab"><i
                    class="icon-location4 mr-2"></i> KABUPATEN</a></li>
              <li onclick="tab('kec')" class="nav-item"><a href="#left-icon-tab3" id="tab3" class="nav-link" data-toggle="tab"><i
                    class="icon-location4 mr-2"></i> KECAMATAN</a></li>
              <li onclick="tab('kel')" class="nav-item"><a href="#left-icon-tab4" id="tab4" class="nav-link" data-toggle="tab"><i
                    class="icon-location4 mr-2"></i> KELURAHAN</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="left-icon-tab1">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-8">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="hidden" id="type" name="type" value="prov">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                  class="form-control" placeholder="Search Here">
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
                            @php $cols = count($grid_prov)+1; @endphp
                            <th width="2%">NO</th>
                            @foreach($grid_prov as $datagrid)
                            <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                            @endforeach
                            <th width="8%">ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!$listdata_prov->isEmpty())
                          @php
                          $rowIndex=-1;
                          @endphp

                          @foreach($listdata_prov as $key => $data)
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr>
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid_prov as $datagrid)
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
                                <a onclick="grid_edit('alldata_prov','formAllField_prov','_prov',{{$pmKey}})"><i
                                    class="icon-pencil text-success pr-1"></i></a>
                                <a onclick="grid_delete({{$pmKey}},'model_prov')"><i
                                    class="icon-trash text-danger"></i></a>
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
                    <div
                      class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata_prov->appends(array('type' => 'prov','search' => $search ?? $_GET['search']
                      ))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->
                        <input type="hidden" id="alldata_prov" name="alldata_prov"
                          value="{{json_encode($listdata_prov)}}">
                        <input type="hidden" id="formAllField_prov" name="formAllField_prov"
                          value="{{json_encode($form_prov)}}">
                        <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
                        <input type="hidden" id="compId" name="compId" value="{{$compId}}">

                        <div class="row">
                          @csrf
                          @foreach($form_prov as $dataform)
                          @if($dataform['type']=='text')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}_prov"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='number')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="number" class="form-control" id="{{$dataform['field']}}_prov"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}_prov"
                                class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                                  $("#{{$dataform['setfield']}}").val(e.params.data.id);
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
                          <button type="submit" class="btn btn-sm btn-primary"
                            onclick="save('formAllField_prov','model_prov','_prov')"><i class="icon-floppy-disk"> </i>
                            Save</button>
                        </div>
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="left-icon-tab2">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-8">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="hidden" id="type" name="type" value="kab">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                  class="form-control" placeholder="Search Here">
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
                            @php $cols = count($grid_kab)+1; @endphp
                            <th width="2%">NO</th>
                            @foreach($grid_kab as $datagrid)
                            <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                            @endforeach
                            <th width="8%">ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!$listdata_kab->isEmpty())
                          @php
                          $rowIndex=-1;
                          @endphp

                          @foreach($listdata_kab as $key => $data)
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr>
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid_kab as $datagrid)
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
                                <a onclick="grid_edit('alldata_kab','formAllField_kab','_kab',{{$pmKey}})"><i
                                    class="icon-pencil text-success pr-1"></i></a>
                                <a onclick="grid_delete({{$pmKey}},'model_kab')"><i
                                    class="icon-trash text-danger"></i></a>
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
                    <div
                      class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata_kab->appends(array('type' => 'kab','search' => $search ?? $_GET['search']
                      ))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->
                        <input type="hidden" id="alldata_kab" name="alldata_kab"
                          value="{{json_encode($listdata_kab)}}">
                        <input type="hidden" id="formAllField_kab" name="formAllField_kab"
                          value="{{json_encode($form_kab)}}">
                        {{-- <input type="hidden" id="{{$primaryKey}}" name="{{$primaryKey}}" value="">
                        <input type="hidden" id="compId" name="compId" value="{{$compId}}"> --}}

                        <div class="row">
                          @csrf
                          @foreach($form_kab as $dataform)
                          @if($dataform['type']=='text')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}_kab"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='number')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="number" class="form-control" id="{{$dataform['field']}}_kab"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}_kab"
                                class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                                  $("#{{$dataform['setfield']}}").val(e.params.data.id);
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
                          <button type="submit" class="btn btn-sm btn-primary"
                            onclick="save('formAllField_kab','model_kab','_kab')"><i class="icon-floppy-disk"> </i>
                            Save</button>
                        </div>
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="left-icon-tab3">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-8">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="hidden" id="type" name="type" value="kec">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                  class="form-control" placeholder="Search Here">
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
                            @php $cols = count($grid_kec)+1; @endphp
                            <th width="2%">NO</th>
                            @foreach($grid_kec as $datagrid)
                            <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                            @endforeach
                            <th width="8%">ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!$listdata_kec->isEmpty())
                          @php
                          $rowIndex=-1;
                          @endphp

                          @foreach($listdata_kec as $key => $data)
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr>
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid_kec as $datagrid)
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
                                <a onclick="grid_edit('alldata_kec','formAllField_kec','_kec',{{$pmKey}})"><i
                                    class="icon-pencil text-success pr-1"></i></a>
                                <a onclick="grid_delete({{$pmKey}},'model_kec')"><i
                                    class="icon-trash text-danger"></i></a>
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
                    <div
                      class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata_kab->appends(array('type' => 'kec','search' => $search ?? $_GET['search']
                      ))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->
                        <input type="hidden" id="alldata_kec" name="alldata_kec"
                          value="{{json_encode($listdata_kec)}}">
                        <input type="hidden" id="formAllField_kec" name="formAllField_kec"
                          value="{{json_encode($form_kec)}}">

                        <div class="row">
                          @csrf
                          @foreach($form_kec as $dataform)
                          @if($dataform['type']=='text')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}_kec"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='number')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="number" class="form-control" id="{{$dataform['field']}}_kec"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}_kec"
                                class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                                  $("#{{$dataform['setfield']}}").val(e.params.data.id);
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
                          <button type="submit" class="btn btn-sm btn-primary"
                            onclick="save('formAllField_kec','model_kec','_kec')"><i class="icon-floppy-disk"> </i>
                            Save</button>
                        </div>
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="left-icon-tab4">
                <div class="row">
                  <!-- Basic layout-->
                  <div class="col-xl-8">
                    <div class="mb-2 header-elements-inline">
                      <h5 class="card-title"></h5>
                      <div class="header-elements">
                        <div class="list-icons">
                          <form action="/{{$mainroute}}" method="GET">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="hidden" id="type" name="type" value="kel">
                                <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                  class="form-control" placeholder="Search Here">
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
                            @php $cols = count($grid_kel)+1; @endphp
                            <th width="2%">NO</th>
                            @foreach($grid_kel as $datagrid)
                            <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                            @endforeach
                            <th width="8%">ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!$listdata_kel->isEmpty())
                          @php
                          $rowIndex=-1;
                          @endphp

                          @foreach($listdata_kel as $key => $data)
                          @php
                          $pmKey=$data->$primaryKey;
                          $rowIndex ++;
                          @endphp

                          <tr>
                            <td class="text-center">{{$key+1}}</td>
                            @foreach($grid_kel as $datagrid)
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
                                <a onclick="grid_edit('alldata_kel','formAllField_kel','_kel',{{$pmKey}})"><i
                                    class="icon-pencil text-success pr-1"></i></a>
                                <a onclick="grid_delete({{$pmKey}},'model_kel')"><i
                                    class="icon-trash text-danger"></i></a>
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
                    <div
                      class="justify-content-sm-end pagination pagination-rounded align-self-center pagination-sm mt-2 mb-2">
                      {{ $listdata_kab->appends(array('type' => 'kel','search' => $search ?? $_GET['search']
                      ))->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- /basic layout -->
                  </div>
                  <div class="col-xl-4">
                    <!-- Basic layout-->
                    <div class="card">
                      <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <!-- <form action="#"> -->
                        <input type="hidden" id="alldata_kel" name="alldata_kel"
                          value="{{json_encode($listdata_kel)}}">
                        <input type="hidden" id="formAllField_kel" name="formAllField_kel"
                          value="{{json_encode($form_kel)}}">

                        <div class="row">
                          @csrf
                          @foreach($form_kel as $dataform)
                          @if($dataform['type']=='text')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="text" class="form-control" id="{{$dataform['field']}}_kel"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='number')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <input type="number" class="form-control" id="{{$dataform['field']}}_kel"
                                name="{{$dataform['field']}}" placeholder="{{$dataform['placeholder']}}">
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                            </div>
                          </div>
                          @elseif($dataform['type']=='autocomplete')
                          <div class="col-sm-{{$dataform['col'] ?? 12}}">
                            <div class="form-group">
                              <label class="form-label"><b>{{$dataform['label']}}</b></label>
                              <select name="{{$dataform['field']}}" id="{{$dataform['field']}}_kel"
                                class="{{$dataform['field']}} form-control" style="width: 100%;">
                                <option value="">{{$dataform['default']}}</option>
                              </select>
                              <small class="form-text text-muted">{{$dataform['keterangan']}}</small>
                              <script type="text/javascript">
                                $(".{{$dataform['field']}}").on("select2:select", function(e) {
                                  $("#{{$dataform['setfield']}}").val(e.params.data.id);
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
                          <button type="submit" class="btn btn-sm btn-primary"
                            onclick="save('formAllField_kel','model_kel','_kel')"><i class="icon-floppy-disk"> </i>
                            Save</button>
                        </div>
                        <!-- </form> -->
                      </div>
                    </div>
                    <!-- /basic layout -->
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



<script type="text/javascript">
$( document ).ready(function() {
  var type = location.search.slice(1).split("&")[0].split("=")[1];
  
  if(type){
    var type = type;
  }else{
    var type = 'prov';
  }

  if(type == 'prov'){
    $('#tab1').addClass('active');
    $('#tab2').removeClass('active');
    $('#tab3').removeClass('active');
    $('#tab4').removeClass('active');
    $('#left-icon-tab1').addClass('show active');
    $('#left-icon-tab2').removeClass('show active');
    $('#left-icon-tab3').removeClass('show active');
    $('#left-icon-tab4').removeClass('show active');
  }else if(type == 'kab'){
    $('#tab1').removeClass('active');
    $('#tab2').addClass('active');
    $('#tab3').removeClass('active');
    $('#tab4').removeClass('active');
    $('#left-icon-tab1').removeClass('show active');
    $('#left-icon-tab2').addClass('show active');
    $('#left-icon-tab3').removeClass('show active');
    $('#left-icon-tab4').removeClass('show active');
  }else if(type == 'kec'){
    $('#tab1').removeClass('active');
    $('#tab2').removeClass('active');
    $('#tab3').addClass('active');
    $('#tab4').removeClass('active');
    $('#left-icon-tab1').removeClass('show active');
    $('#left-icon-tab2').removeClass('show active');
    $('#left-icon-tab3').addClass('show active');
    $('#left-icon-tab4').removeClass('show active');
  }else if(type == 'kel'){
    $('#tab1').removeClass('active');
    $('#tab2').removeClass('active');
    $('#tab3').removeClass('active');
    $('#tab4').addClass('active');
    $('#left-icon-tab1').removeClass('show active');
    $('#left-icon-tab2').removeClass('show active');
    $('#left-icon-tab3').removeClass('show active');
    $('#left-icon-tab4').addClass('show active');
  }

});
// set Tab 
  function tab(tab)
  {
    window.open("{{url('/')}}/{{$mainroute}}?type="+tab, "_self");
  }


  function save(form,model,prefix)
  {
    var jenis = document.getElementById('{{$primaryKey}}').value;
    if (jenis == '') {
      saveNew(form,model,prefix);
    } else {
      saveEdit('{{$primaryKey}}', form,model,prefix);
    }
  }

  function saveNew(form,model,prefix)
  {
    var field = document.getElementById(form).value;
    var fieldobj = JSON.parse(field);
    // console.log(fieldobj);
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model; //set model
    for (var j = 0; j < fieldobj.length; j++) {
      //with prefix
      var data = document.getElementById(fieldobj[j].field+prefix).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
        postdata[fieldobj[j].field] = data;
      } else {
        postdata[fieldobj[j].field] = data;
      }
    }

    // console.log('tes:',postdata);

    $.ajax({
      type: "POST",
      url: "{{$mainroute}}",
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
            window.open(window.location.href, "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function saveEdit(primaryKey, form, model, prefix) 
  {
    var field = document.getElementById(form).value;
    var fieldobj = JSON.parse(field);
    var pkValue = document.getElementById(primaryKey).value;
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model; //set model

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field+prefix).value;
      if (fieldobj[j].type == 'angka') {
        var data = convertAutoNumber(data); //custom.js
        postdata[fieldobj[j].field] = data;
      } else {
        postdata[fieldobj[j].field] = data;
      }
    }

    // console.log('edit :', postdata);

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
            window.open(window.location.href, "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function grid_edit(field_data, field_form,prefix,id)
  {
    var data = document.getElementById(field_data).value;
    var dataobj = JSON.parse(data).data;
    for (var i = 0; i < dataobj.length; i++) {
      var a = 'dataobj[i].id';
      // console.log(a);
      if (eval(a) == id) {
        var field = document.getElementById(field_form).value;
        var fieldobj = JSON.parse(field);
        //masukkan PK dulu
        document.getElementById('id').value = id;
        //masukkan field yang lain
        for (var j = 0; j < fieldobj.length; j++) {
          var b = 'dataobj[i].' + fieldobj[j].field;
          // console.log(fieldobj[j].type);
          if (fieldobj[j].type != 'password') {
            if (fieldobj[j].type == 'combo') {
              $("#" + fieldobj[j].field).val(eval(b)).find(':selected').trigger('change');
            } else if (fieldobj[j].type == 'autocomplete') {
              
              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field+prefix);
            } else {
              document.getElementById(fieldobj[j].field+prefix).value = eval(b);
            }
          }
        }
      }
    }
  }

  function setAutocompleteVal(api, idx, tx, field) 
  {
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

  function grid_delete(id,model) 
  {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.model = model;
    // console.log(postdata);
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
              window.open(window.location.href, "_self");
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