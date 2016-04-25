<?php

namespace Features\Traits;

use Faker\Factory;

trait Authentication 
{

	private $name;
	private $email;
	private $password;


    /**
     * @When I register for an account
     */
    public function iRegisterForAnAccount()
    {
    	$this->fakeUser();
        $this->getSession()->wait(1000);
        $this->getSession()->getDriver()->setValue('//*[@id="name"]', $this->name);
        $this->getSession()->getDriver()->setValue('//*[@id="email"]', $this->email);
        $this->getSession()->getDriver()->setValue('//*[@id="password"]', $this->password);
        $this->getSession()->getDriver()->setValue('//*[@id="password_confirmation"]', $this->password);
        $this->pressButton('Register'); 
    }

    /**
     * @Then I should be logged in
     */
    public function iShouldBeLoggedIn()
    {
    	$this->getSession()->wait(1000);
        $this->assertPageAddress('home');
        $this->assertPageContainsText($this->name);
        $this->getSession()->wait(1000);
        $this->visit('logout');
    }

    /**
     * @Given I have an account
     */
    public function iHaveAnAccount()
    {
        $this->iRegisterForAnAccount();
        $this->visit('logout');
    }


    /**
     * @When I go to the login page
     */
    public function iGoToTheLoginPage()
    {
        $this->visit('/');
        $this->clickLink('Login');
    }

    /**
     * @When I enter my login info
     */
    public function iEnterMyLoginInfo()
    {
    	$this->getSession()->wait(1000);
        $this->getSession()->getDriver()->setValue('//*[@id="loginEmail"]', $this->email);
        $this->getSession()->getDriver()->setValue('//*[@id="loginPassword"]', $this->password);
        $this->pressButton('Login');
    }


    /**
     * @Given I do not have an account
     */
    public function iDoNotHaveAnAccount()
    {
    	$this->iGoToTheLoginPage();
        $this->email = 'nogood@email.com';
        $this->password = 'badpw';
    }

    /**
     * @When I enter wrong login info
     */
    public function iEnterWrongLoginInfo()
    {
        $this->iEnterMyLoginInfo();
    }

    /**
     * @Then I should not be logged in
     */
    public function iShouldNotBeLoggedIn()
    {
        $this->assertPageAddress('login');
        $this->assertPageContainsText('These credentials do not match our records.');
    }

    public function fakeUser()
    {
    	$faker = Factory::create();
    	$this->name     = $faker->name;
    	$this->email    = $faker->email;
    	$this->password = $faker->password;
    }

     /**
     * @When I enter an incorrect email address
     */
    public function iEnterAnIncorrectEmailAddress()
    {
    	$this->getSession()->wait(1000);
        $this->getSession()->getDriver()->setValue('//*[@id="name"]', '');
        $this->getSession()->getDriver()->setValue('//*[@id="email"]', '');
        $this->getSession()->getDriver()->setValue('//*[@id="password"]', '');
        $this->getSession()->getDriver()->setValue('//*[@id="password_confirmation"]', '');
        $this->pressButton('Register'); 
    }

    /**
     * @Then I should see an error message
     */
    public function iShouldSeeAnErrorMessage()
    {
    	$this->assertPageAddress('login#register');
    	$this->getSession()->wait(1000);
        $this->assertPageContainsText('The name field is required.');
    }
}