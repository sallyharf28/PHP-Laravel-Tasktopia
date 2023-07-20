@extends('Layout.layout')
@section('content')
  @php
  $twhere ="";
  if(auth()->user()->type!= 1)
    $twhere = "  ";
  @endphp
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        Welcome {{ ucwords(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}!
      </div>
    </div>
  </div>
  <hr>

  @php
  $where = "";
  $where2 = "";
  $loginType = auth()->user()->type;
  $loginId = auth()->user()->id;

  // Filter projects based on user's login type and role
  if ($loginType == 2) {
    // If login type is 2 (manager), show only projects where user is a manager
    $where = " where manager_id = '".$loginId."' ";
    $where2 = " where p.manager_id = '".$loginId."' ";
  // } elseif ($loginType == 3) {
  //   // If login type is 3 (employee), show only projects where user is a team member
  //   $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[".$loginId."]%' ";
  //   $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[".$loginId."]%' ";
  // }
  }
  @endphp
  <div class="row">
    <div class="col-md-8">
      <div class="card card-outline card-success">
        <div class="card-header">
          <b>Task Progress</b>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0 table-hover">
              <colgroup>
                <col width="5%">
                <col width="30%">
                <col width="35%">
                <col width="15%">
                <col width="15%">
              </colgroup>
              <thead>
                <th>#</th>
                <th>Tasks</th>
                <th>Progress</th>
                <th>Status</th>
                <th></th>
              </thead>
              <tbody>
                @php
                    $i = 1;
                    $stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
                    $projects = DB::select("SELECT * FROM projects p $where order by name asc");
                  @endphp
                  
                  @foreach($projects as $row)
                  <tr>
                    <td>
                      {{ $i++ }}
                    </td>
                    <td>
                      <a href="#">
                        {{ ucwords($row->name) }}
                      </a>
                      <br>
                      <small>
                        Due: {{ date("Y-m-d",strtotime($row->end_date)) }}
                      </small>
                    </td>
                    <td class="main">
                      <input type="range" min="0" max="100" value="50" id="slider-{{$row->id}}">
                      <div id="selector-{{$row->id}}">
                        <div class="SelectBtn"></div>
                        <div id="SelectValue-{{$row->id}}"></div>
                      </div>
                      <div id="progressBar-{{$row->id}}"></div>
                    </td>
                    <td class="project-state">
                      <span class="badge" id="status-badge-{{$row->id}}">
                        <!-- Print status value here -->
                      </span>
                      <script>
                        var slider{{$row->id}} = document.getElementById("slider-{{$row->id}}");
                        var selector{{$row->id}} = document.getElementById("selector-{{$row->id}}");
                        var selectValue{{$row->id}} = document.getElementById("SelectValue-{{$row->id}}");
                        var progressBar{{$row->id}} = document.getElementById("progressBar-{{$row->id}}");
                        var statusBadge{{$row->id}} = document.getElementById("status-badge-{{$row->id}}");

                        slider{{$row->id}}.oninput = function() {
                          var value = "";
                          var status;
                          selector{{$row->id}}.style.left = this.value + "%";
                          progressBar{{$row->id}}.style.width = this.value + "%";
                          if (slider{{$row->id}}.value == 0) {
                            value = "Pending";
                            status = 1;
                          } else if (slider{{$row->id}}.value <= 5) {
                            value = "Started";
                            status = 1;
                          } else if (slider{{$row->id}}.value < 100) {
                            value = "On Progress";
                            status = 2;
                          } else if (slider{{$row->id}}.value == 100) {
                            value = "Done";
                            status = 3;
                          } else {
                            status = 2;
                          }
                          
                          statusBadge{{$row->id}}.innerHTML = value; // Update status value in frontend
                        };
                      </script>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="#" onclick="event.preventDefault(); document.getElementById('view-form-{{$row->id}}').submit();"><i class="fas fa-folder"></i>
                        View</a>
                      <form id="view-form-{{$row->id}}" action="/view_project" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="project_id" value="{{$row->id}}">
                      </form>
                    </td>
                  </tr>
                @endforeach


            </tbody>  
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-12">
        <div class="small-box bg-light shadow-sm border">
          <div class="inner">
            <h3>{{count(DB::select("SELECT * FROM projects $where"))}}</h3>
              <p>Total Tasks</p>
          </div>
          <div class="icon">
              <i class="fa fa-layer-group"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
