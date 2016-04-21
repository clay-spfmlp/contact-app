<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     * @test
     */
    public function i_can_login_to_my_site()
    {
        $this->visit('/')
        	->click('Login')
        	->seePageIs('/login')
        	->see('Login');
        	
    }
}
