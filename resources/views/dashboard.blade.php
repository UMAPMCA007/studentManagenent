<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
            @if(Auth::user()->Is_admin == 1)
                <a href="/course">Course</a>
                <a href="/application"> Application Management </a>
            @endif 
            @if(Auth::user()->Is_admin != 1)   
            <a href="/status">Application Status</a>
            @endif

        </div>

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        </div> 
       </div>
          


        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-2">
                @if(Auth::user()->Is_admin != 1) 
                   <!-- validation error  -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                    <!-- success msg -->
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif    
                    <div class="card">
                        <div class="card-body">
                           <!-- form select cource -->
                          
                            <form action="{{route('student_course')}}" method="POST">
                                  @csrf
                                  <div class="form-group">
                                        <label for="cource">Course</label>
                                        <select class="form-control" id="course" name="course">
                                         <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}">{{$course->course}}</option>
                                            @endforeach    
                                         
                                        </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                             </form>
                        </div>
                    </div> 
                @endif    

                <!-- validation error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @if(Auth::user()->Is_admin == 1)      
                    <div class="card mb-5">
                        <div class="card-body">
                             <!-- form for admin -->
                                <form action="{{route('save_course')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                            <label for="cource">Course Name</label>
                                            <input type="text" class="form-control" id="course" name="course" placeholder="Enter Course Name">    
                                    </div>
                                    <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
                                    </div>  
                                    <div class="form-group">
                                            <label for="description">Registration End date</label>
                                            <input type="date" class="form-control" id="reg_end" name="reg_end" placeholder="Enter last registration date">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>    
                        </div>
                    </div>
                 @endif   
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
