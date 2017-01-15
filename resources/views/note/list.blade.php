@extends('layouts.app')

@section('title')
<title>List Certificate | Certnote</title>
@endsection

@push('stylesheets')

<!-- Datatables -->
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">

@endpush



@section('main_container')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Certificate List</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

<!-- TABLE START -->
     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>My Note <small>Domains</small></h2>
            <div class="clearfix"></div>
	         </div>
          <div class="x_content">
            <table id="datatable-buttons" class="table table-striped table-bordered display">
              <thead>
                <tr>
                  <th>Domain(FQDN)</th>
                  <th>Days Left</th>
                  <th>MEMO</th>
                  <th>Port No.</th>
                  <th>Updated</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>

                @foreach($notes as $note)
                <tr>
                  <td>{{$note->fqdn}}</td>
                  <td>{{$note->daysleft}}</td>
                  <td>{{$note->memo}}</td>
                  <td>{{$note->port}}</td>
                  <td>{{$note->updated_at}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" aria-label="Center Align" title="Detail">
                      <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default" aria-label="Center Align" title="Edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default" aria-label="Center Align" title="Delete">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                  </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- TABLE END -->

<!-- /page content -->
@endsection

@section('js')

<!-- Datatables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.bootstrap.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<!-- Datatables -->
<script src="js/dataTables.fixedHeader.min.js"></script>
<script src="js/dataTables.keyTable.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap.js"></script>
<script src="js/dataTables.scroller.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>

@endsection

@section('scripts')
<!-- Datatables -->
<script>
$(document).ready(function() {
var handleDataTableButtons = function() {
  if ($("#datatable-buttons").length) {
    $("#datatable-buttons").DataTable({
      dom: "Bfrtip",
      buttons: [
        {
          extend: "copy",
          className: "btn-sm"
        },
        {
          extend: "csv",
          className: "btn-sm"
        },
        {
          extend: "excel",
          className: "btn-sm"
        },
        {
          extend: "pdfHtml5",
          className: "btn-sm"
        },
        {
          extend: "print",
          className: "btn-sm"
        },
      ],
      responsive: true
    });
  }
};
TableManageButtons = function() {
  "use strict";
  return {
    init: function() {
      handleDataTableButtons();
    }
  };
}();
$('#datatable').dataTable();
$('#datatable-keytable').DataTable({
  keys: true
});
$('#datatable-responsive').DataTable();
$('#datatable-scroller').DataTable({
  ajax: "js/datatables/json/scroller-demo.json",
  deferRender: true,
  scrollY: 380,
  scrollCollapse: true,
  scroller: true
});
$('#datatable-fixed-header').DataTable({
  fixedHeader: true
});
var $datatable = $('#datatable-checkbox');
$datatable.dataTable({
  'order': [[ 1, 'asc' ]],
  'columnDefs': [
    { orderable: false, targets: [0] }
  ]
});
$datatable.on('draw.dt', function() {
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green'
  });
});
TableManageButtons.init();
});
</script>
<!-- /Datatables -->
@endsection
