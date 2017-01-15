@extends('layouts.app')

@section('title')
<title>List Certificate | Certnote</title>
@endsection

@section('stylesheet')

<script src="/js/jquery-3.1.1.min.js"></script>
<!-- <link   href="/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">

@endsection

@section('content')

<article class="content responsive-tables-page">
    <div class="title-block">
        <h1 class="title">Certificate List</h1>
        <p class="title-description">Add, Watch and Manage your Certificates!</p>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">

                        <div class="card-title-block">
                              <p>
                                  <a href="{{ url('/note/create') }}" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add Certificate</a>
                                  <a href="parser.php" class="btn btn-large btn-primary"><i class="glyphicon glyphicon-refresh"></i>&nbsp;Refresh Data</a>
                              </p>

                        <section class="certificate-list">
                            <div class="table-responsive">
                                <table id="certlist" class="table table-striped table-bordered table-hover">
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
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>

@endsection

@section('js')

<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

@endsection

@section('script')
<script>
  $(document).ready( function () {
      $('#certlist').DataTable(
      {
      "autoWidth": true,
      "pageLength": 25


      }

      );
  } );
</script>
@endsection
