@extends('layouts.app')

@section('content')
    
	<div class="container">
		<h2 class="movie-app-title text-center">Find a Movie Near You</h2>
		<div class="row">
			<div class="col-md-3 col-md-offset-4">
				<input v-model="zipCode" class="form-control" placeholder="Zip Code">
			</div>
			<div class="col-md-2">
				<button v-on:click="getTheaters" class="btn btn-primary hvr-float-shadow">GO</button>
			</div>
		</div>
		<hr>
		<div v-if="loadingTheathers" v-cloak class="loading-theathers text-center">
			<i class="fa fa-spinner fa-pulse"></i>
		</div>
		<div v-for="theater in theaters" v-show="!loadingTheathers" class="theater col-md-8 col-md-offset-2" v-cloak>
			<div class="theater-name row">
				<h3 class="col-md-12">@{{ theater.name }}</h3>
				<div class="theater-address col-md-12">@{{ theater.address }}</div>
			</div>
			
			<div class="row" v-if="theater.nomovies">CURRENTLY, THERE ARE NO MOVIES AND SHOWTIMES FOR THIS THEATER ON THIS DATE.</div>
			<div v-for="movie in theater.movies" class="movie row">
				<div class="col-md-2">
					<img class="movie-poster" src="@{{ movie.poster }}">
				</div>
				<div class="col-md-10 movie-details">
					<h4>@{{ movie.title }}</h4>
					
					<div>@{{ movie.runtime }}</div>
					<div>@{{ movie.genre }}</div>
					<button class="btn btn-small btn-primary hvr-sweep-to-right float-left movie-time" v-for="time in movie.times">
						@{{ time.time }}
					</button>
			
				</div>
				
				
			</div>
		</div>

	</div>

@endsection

@section('script')
	<script src="js/movie-app.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@endsection