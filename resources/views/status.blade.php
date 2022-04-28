<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Application Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!--bootstrap side nav -->
        @section('sidebar')
        <style>
            body {
            font-family: "Lato", sans-serif;
            }

            .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            }

            .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
            }

            .sidenav a:hover {
            color: #f1f1f1;
            }

            .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            }

            @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
            }
            </style>
        @endsection
       <div class="container-fluid">
       <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/dashboard">Dashboard</a>
            <a href="/status">Application Status</a>
        </div>

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        </div> 
       </div>
          


        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-2 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Student Application Status') }}
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>course</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($status as $s)
                                              
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$s->name}}</td>
                                                <td>{{$s->course}}</td>
                                                <td>{{$s->status}}</td>
                                                
                                            </tr>
                                           @php($i++)
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
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
        
    </div>
</x-app-layout>