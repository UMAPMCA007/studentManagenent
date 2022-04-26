<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Status') }}
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
            <a href="/course">Course</a>
            <a href="/application">Application Management</a>
        </div>

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        </div> 
       </div>
          <!-- model edit  -->
            <div class="modal " id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Edit Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form  method="POST">
                        @csrf
                            <input type="hidden"  id="id" >
                        <div class="form-group">
                            <label for="exampleInputEmail1">Student Name</label>
                            <input type="text" class="form-control" id="name"   name="name"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Application Status</label>
                            <select  class="form-control"  id="status"  name="status" >
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
             </div>
           </div>
         </div>   
    
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-2 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Application Status') }}
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Qulification</th>
                                                <th>Applied Course</th>
                                                <th>Application Status</th>
                                                <th >Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i=1)
                                            @foreach($status as $s)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$s->name}}</td>
                                                    <td>{{$s->state}}</td>
                                                    <td>{{$s->city}}</td>
                                                    <td>{{$s->qualification}}</td>
                                                    <td>{{$s->course_id}}</td>
                                                    <td>{{$s->status}}</td>
                                                    <td>
                                                        <button id="{{$s->id}}" class="btn btn-primary edit">Edit Status</a>
                                                        
                                                    </td>   
                                                </tr>
                                               @php($i++) 
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- button to print the page -->
                                <div class="text-center">
                                    <button  id ="print" class="btn btn-success">Print</button>
                                </div>    
                            </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
</script>
<script>
    $(document).ready(function(){
        $('.edit').click(function(){
            var id = $(this).attr('id');
            $.ajax({
                url: '/application_edit/'+id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#status').val(data.status);
                    $('#editModal').show();   
                }
            });
        });

        // update data
        $('#editModal').on('submit',function(e){
            e.preventDefault();
            var id = $('#id').val();
            var status = $('#status').val();
            $.ajax({
                url: '/application_update/'+id,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    status: status
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('#editModal').hide();
                    location.reload();
                }
            });
        });

        // print the page
        $('#print').click(function(){
            $("#print").hide();
            $(".edit").hide();
            window.print();
            location.reload();
        });

    });
</script>
        
</div>
</x-app-layout>