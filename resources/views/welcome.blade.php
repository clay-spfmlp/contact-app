@extends('layouts.app')

@section('css')
	<style>
	body {
		background: #222;
	}

	.navbar-default {
	    background-color: #222;
	    border-color: #222;
	}
	
	.navbar-default .navbar-nav > li > a,
	.navbar-default .navbar-brand {
		color: #eee;
	}
	.title {
		color: #eee;
	    font-size: 96px;
	    height: 143px;
	    position: absolute;
	    top:-20px;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    margin: auto;
	}

	.name.space {
		margin-left: 10px;
	}

	.name {
	  animation-duration: .5s;
	}
	

	.blinking-cursor {
		font-weight: 100;
		font-size: 96px;
		color: #eee;
		position: relative;
		top: -10px;
		left: -8px;
		-webkit-animation: 1s blink step-end infinite;
		-moz-animation: 1s blink step-end infinite;
		-ms-animation: 1s blink step-end infinite;
		-o-animation: 1s blink step-end infinite;
		animation: 1s blink step-end infinite;
	}

	@keyframes "blink" {
	  from, to {
	    color: transparent;
	  }
	  50% {
	    color: #eee;
	  }
	}

	@-moz-keyframes blink {
	  from, to {
	    color: transparent;
	  }
	  50% {
	    color: #eee;
	  }
	}

	@-webkit-keyframes "blink" {
	  from, to {
	    color: transparent;
	  }
	  50% {
	    color: #eee;
	  }
	}

	@-ms-keyframes "blink" {
	  from, to {
	    color: transparent;
	  }
	  50% {
	    color: #eee;
	  }
	}

	@-o-keyframes "blink" {
	  from, to {
	    color: transparent;
	  }
	  50% {
	    color: black;
	  }
	}

</style>
@endsection

@section('content')
<div id="home" class="container">
	<div class="content">
	    <div class="title text-center">
			    <span v-for="n in name" v-show="n.show" class="name">@{{ n.letter }}</span>
			    <span class="blinking-cursor">|</span>
	    </div>
	</div>

</div>
@endsection

@section('script')
  <script src="js/home.js"></script>
    {{-- <script src="{{ elixir('js/home.js') }}"></script> --}}
@endsection
