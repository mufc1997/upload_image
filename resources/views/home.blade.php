@extends('layouts.app')

@section('header')
    @component('layouts.header')
    @endcomponent
@endsection

@section('page-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
@endsection

@section('content')
<div class="breadcrumb">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php 
            if($path) {
                $arr = explode("/", $path);
                $url = route('home');
                foreach($arr as $el) {
                    if($el != "Home")
                        echo "<li class='breadcrumb-item'><a href='".$url."/".$el."'>".$el."</a></li>";
                    else 
                        echo "<li class='breadcrumb-item'><a href='".$url."'>".$el."</a></li>";
                }
            } else {
                redirect()->route('home');
            }
        ?>
    </ol>
    </nav>
</div>
<div class="table-wrap">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Extension</th>
                    <th>Create at</th>
                    <th>Update at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                <tr>
                    @if ($file->extension === "folder")
                        <td><a href="{{ $file['url']}}">{{ $file['name'] }}</a></td>
                    @else
                        <td><a href="{{ $file['url']}}" target="_blank">{{ $file['name'] }}</a></td>
                    @endif
                    <td>{{ $file['extension'] }}</td>
                    <td>{{ $file['created_at']}}</td>
                    <td>{{ $file['updated_at']}}</td>
                    <td>
                        @if ($file->extension === "folder")
                            <button type="button" class="btn btn-outline-success" id="btnEdit" data-toggle="modal" data-target="#projectModal" onClick="editProject({{ $file->id}});">
                                Edit
                            </button>
                            <a class="btn btn-outline-danger" href="{{ URL::to('project/'.$file['id']) }}">Delete</a>
                            
                        @else
                            <button type="button" class="btn btn-outline-success" id="btnEdit" data-toggle="modal" data-target="#fileModal" onClick="editFile({{ $file->id}});">
                                Edit
                            </button>
                            <a class="btn btn-outline-danger" href="{{ URL::to('file/'.$file['id']) }}">Delete</a>
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection

@section('page-script')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<script src="{{  asset("js/app.js") }}"></script>
@endsection