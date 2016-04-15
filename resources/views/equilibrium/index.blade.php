@extends('layouts.main')

@section('css')
<link href="css/equilibrium.css" rel="stylesheet">

@endsection

@section('content')
<div id='equilibrium'>
	<div class="col-md-8 col-md-offset-2">
		<div class="InputAddOn equilibrium__item equilibrium__input">
			<input v-focus-model="equilibriumFocus" type="number" class="InputAddOn-field" v-model="equilibriumInput" maxlength="3" v-on:keyUp.enter="addToArray(equilibriumInput)">
			<button class="InputAddOn-item" v-on:click="addToArray(equilibriumInput)">Add</button>
		</div>
		<div class="equilibrium">
			<div class="equilibrium__item" v-for="equilibrium in equilibriums">
				<div v-on:click="remove($index)" class="remove"><i class="fa fa-times-circle"></i></div>
				<div class="number">@{{equilibrium.number}},</div>
			</div>
		</div>
		
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class="InputAddOn InputAddOn--Reverse equilibrium__item">
			<button v-on:click="getEquilibriumIndex()" class="InputAddOn-item InputAddOn-item--W100">
			Return Equilibrium Indices
			</button>
		</div>
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
