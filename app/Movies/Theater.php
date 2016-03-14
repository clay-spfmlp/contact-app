<?php 

namespace App\Movies;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use RuntimeException;

class Theater 
{

	public $theaters = '.showtimes-theater';
	public $theaterName = '.showtimes-theater-title';
	public $theaterAddress = '.showtimes-theater-address';
	public $movies = '.showtimes-movie-container';
	public $moviesTitle = '.showtimes-movie-title';
	public $moviesPoster = '.showtimes-movie-poster img';
	public $moviesRunTime = '.showtimes-movie-rating-runtime';
	public $moviesGenre = '.showtimes-movie-genre';
	public $times = '.showtimes-times';
	public $moviesTimes = '.timeInfo';


	public function all($zipCode = 78217)
	{
		// if(!$zipCode) {dd('need zipCode')}
		$theaters = $this->grabSource($zipCode);
		
		$results = [];
		if (iterator_count($theaters) > 1) {
 
		    foreach ($theaters as $i => $theater) {
		        $theater = new Crawler($theater);
		        $details = new \stdClass;
	            $details->name = trim($theater->filter($this->theaterName)->text());
	            $details->address = trim($theater->filter($this->theaterAddress)->text());

		        $movies = $theater->filter($this->movies);

		        if(iterator_count($movies) > 1) {

			        foreach ($movies as $ii => $movie) {
			        	$movie = new Crawler($movie);
			        	$details2 = new \stdClass;
			            $details2->title = trim($movie->filter($this->moviesTitle)->text());
			            $details2->poster = $movie->filter($this->moviesPoster)->attr('src');
			            $details2->runtime = trim(preg_replace('/\s+/', ' ', $movie->filter($this->moviesRunTime)->text()));
			            $details2->genre = trim($movie->filter($this->moviesGenre)->text());

			            $times = $movie->filter($this->moviesTimes);
			            //dd($times);
			            foreach ($times as $iii => $time) {
			            	$time = new Crawler($time);
			            	$details3 = new \stdClass;
			            	$details3->time = trim($time->filter($this->moviesTimes)->text());
			            	$details3->id = str_slug($details->name.' '.$details2->title.' '.$details3->time, '-');
			            	$t[$iii] = $details3;
			            }

			   //          $details2->times = $movie->filter($this->moviesTimes)->each(function (Crawler $node, $i) {
						//     return $node->text();
						// });
						//dd($t);

			            $details2->times = $t;
			            $t = [];
			            $m[$ii] = $details2;
			        }

		        } else {
		        	$result[$i]['nomovies'] = true;
		        	$m = '';
		        }
		        $details->movies = $m;
		        $result[$i] = $details;
		    }
		} else {
		    throw new RuntimeException('Got empty result processing the dataset!');
		}

		// foreach ($result as $key => $theater) {
		// 	foreach ($theater['movies'] as $k => $movie) {
		// 		foreach ($movie['times'] as $t => $time) {

		// 			$result[$key]['movies'][$k]['times'][$t] = [
		// 				'time' => $time,
		// 				'id' => str_slug($zipCode.' '.$theater['name'].' '.$movie['title'].' '.$time, '-')
		// 			];

		// 			//[] = $time;
		// 		}
		// 	}
		// }


		//dd($result);

		return $result;
	}

	public function grabSource($zipCode)
	{
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.fandango.com/78217_movietimes?date=2/22/2016&q=78217');
	 	
		return $crawler->filter($this->theaters);
	}

}