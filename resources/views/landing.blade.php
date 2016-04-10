@extends('layouts.app')

@section('css')
<link href="css/landing.css" rel="stylesheet">
@endsection

@section('content')
<div id="home">
    <div class="title">
		<span v-cloak v-for="n in name" v-show="n.show" class="name" v-bind:class="n.highlight ? 'highlight' : ''">@{{{ n.letter }}}</span>
		<span class="blinking-cursor">|</span>
    </div>
</div>
@endsection

@section('script')
  <script src="js/landing.js"></script>
@endsection
