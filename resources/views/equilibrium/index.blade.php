@extends('layouts.main')

@section('css')
<link href="css/equilibrium.css" rel="stylesheet">

@endsection

@section('content')
<div id='equilibrium'>
	<div class="col-md-8 col-md-offset-2">
		<div class="InputAddOn Equilibrium__Item Equilibrium__Input">
			<button class="InputAddOn-item" v-on:click="clearAll()"><i class="fa fa-times-circle"></i> Clear All</button>
			<input v-focus-model="equilibriumFocus" type="number" class="InputAddOn-field" v-model="equilibriumInput" maxlength="3" v-on:keyUp.enter="addToArray(equilibriumInput)">
			<button class="InputAddOn-item" v-on:click="addToArray(equilibriumInput)"><i class="fa fa-plus-circle"></i> Add</button>
		</div>
		<div class="Equilibrium">
			<div class="Equilibrium__Item" v-for="equilibrium in equilibriums">
				<div v-on:click="remove($index)" class="remove"><i class="fa fa-times-circle"></i></div>
				<div class="number">@{{equilibrium.number}}</div>
			</div>
		</div>
	</div>
	<div v-if="equilibriumResult" class="results col-md-8 col-md-offset-2">
		<div class="result" v-for="results in equilibriumResult" v-bind:class="results.class">
			<div class="index">[@{{ $index }}]</div><div class="string-1">@{{{ results.string1 }}}</div><div class="string-2">@{{{ results.string2 }}}</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="js/equilibrium.js"></script>
@endsection
