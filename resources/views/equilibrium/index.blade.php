@extends('layouts.main')

@section('css')
<link href="css/login.css" rel="stylesheet">
<style type="text/css">

	.equilibrium {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.equilibrium__item {
		font-size: 2em;
		padding: 0 10px;
	}

	.equilibrium__item:hover .remove {
		display: block;
	}

	.equilibrium__item:hover .number {
		display: none;
	}

	.equilibrium__item .remove {
		display: none;
		cursor: pointer;
	}

	.equilibrium__input {

	}

	.equilibrium__input .form-control {
		font-size: 32px;
		padding: 0 7px;
		height: 45px;
		text-align: center;
	}

	.results .error {
		color: red;
	}

	.results .sucess {
		color: green;
	}

</style>
@endsection

@section('content')
<div id='equilibrium'>
	<div class="col-md-8 col-md-offset-2">
		<div class="form-group equilibrium__item equilibrium__input">
				<input type="number" class="form-control" v-model="equilibriumInput" v-on:keyUp.enter="addToArray(equilibriumInput)">
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
			Returns Equilibrium Indices
			</button>
		</div>
	<!-- </form> -->
	</div>
	<div class="results col-md-8 col-md-offset-2">
		<div v-for="results in equilibriumResult">
			<div v-bind:class="results.class">@{{ results.string }}</div>

		</div>
	</div>
</div>

@endsection

@section('script')
<script src="js/equilibrium.js"></script>
@endsection
