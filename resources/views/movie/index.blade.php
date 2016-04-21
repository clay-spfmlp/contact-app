@extends('layouts.main')

@section('css')
<link href="css/movie.css" rel="stylesheet">
@endsection

@section('content')
    
<div class="container">
	<h2 class="movie-app-title text-center">Find a Movie Near You</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 InputAddOn">
			<input type="number" v-model="zipCode" name="zip" 
				   class="form-control InputAddOn-field" 
				   placeholder="Zip Code" v-on:keyup.enter="getTheaters">
			<button v-on:click="getTheaters" class="btn btn--Main InputAddOn-item">GO</button>
		</div>
	</div>

	<div v-if="loadingTheathers" v-cloak class="loading-theathers text-center">
		<i class="fa fa-spinner fa-pulse"></i>
	</div>

	<div v-for="theater in theaters" v-show="!loadingTheathers" class="theater" v-cloak>
		<div class="theater__info theater__row">
			<h3 class="col-md-12">@{{ theater.name }}</h3>
			<div class="theater__address col-md-12">@{{ theater.address }}</div>
		</div>
		
		<div class="theater__row" v-if="theater.nomovies">
			CURRENTLY, THERE ARE NO MOVIES AND SHOWTIMES FOR THIS THEATER ON THIS DATE.
		</div>

		<div v-for="movie in theater.movies" class="movie theater__row">
			<div class="movie__item movie__poster">
				<img src="@{{ movie.poster }}">
			</div>
			<div class="movie__item movie__details">
				<h4 class="movie__title">@{{ movie.title }}</h4>
				<div class="movie__runtime">@{{ movie.runtime }}</div>
				<div class="movie__genre">@{{ movie.genre }}</div>
				<div class="movie__times">
				<button class="btn btn-small btn--Main movie__time" v-for="time in movie.times">
					@{{ time.time }}
				</button>
				<div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="js/movie.js"></script>
@endsection