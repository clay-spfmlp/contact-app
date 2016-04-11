@extends('layouts.main')

@section('css')
<link href="css/home.css" rel="stylesheet">
@endsection

@section('content')
<div id="home" class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel--Site">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="js/home.js"></script>
@endsection