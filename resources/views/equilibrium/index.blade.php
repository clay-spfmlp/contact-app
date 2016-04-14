@extends('layouts.main')

@section('css')
<link href="css/equilibrium.css" rel="stylesheet">

@endsection

@section('content')
<div id='equilibrium'>
	<div class="col-md-8 col-md-offset-2">
		<div class="form-group equilibrium__item equilibrium__input">
			<input type="number" class="form-control" v-model="equilibriumInput" maxlength="3" v-on:keyUp.enter="addToArray(equilibriumInput)">
		</div>
		<div class="equilibrium">
			<div class="equilibrium__item" v-for="equilibrium in equilibriums">
				<div v-on:click="remove($index)" class="remove"><i class="fa fa-times-circle"></i></div>
				<div class="number">@{{equilibrium.number}},</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-8 col-md-offset-2">
	<!-- <form method="POST">
	{!! csrf_field() !!}
	<input type="hidden" v-for="equilibrium in equilibriumArray" value="@{{equilibrium}}" name="equilibrium[]" > -->
		<div class="form-group">
			<button v-on:click="getEquilibriumIndex()" class="btn btn--Main form-control">
			Return Equilibrium Indices
			</button>
		</div>
	<!-- </form> -->
	</div>
	<div class="results col-md-8 col-md-offset-2">
		<div class="result" v-for="results in equilibriumResult" v-bind:class="results.class">
			<div class="index">[@{{ $index }}]</div><div class="string-1">@{{{ results.string1 }}}</div><div class="string-2">@{{{ results.string2 }}}</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="js/equilibrium.js"></script>
@endsection
