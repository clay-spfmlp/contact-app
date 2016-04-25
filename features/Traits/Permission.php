<?php

namespace Features\Traits;
use Faker\Factory;

use Behat\Behat\Tester\Exception\PendingException;

trait Permission
{

	public $permission;

	public $role;

    /**
     * @Given I am an Admin
     */
    public function iAmAnAdmin()
    {
        $this->iGoToTheLoginPage();
        $this->getSession()->getDriver()->setValue('//*[@id="loginEmail"]', 'claycpi@gmail.com');
        $this->getSession()->getDriver()->setValue('//*[@id="loginPassword"]', 'abc123');
        $this->pressButton('Login');
        $this->clickLink('Admin');
        $this->assertPageContainsText('DashBoard');
    }

    /**
     * @When I fill the permission form
     */
    public function iFillThePermissionForm()
    {
        throw new PendingException();
    }

    /**
     * @Given I am on permission page
     */
    public function iAmOnPermissionPage()
    {
    	$this->clickLink('Permissions');
        $this->assertPageAddress('permission');
    }

    /**
     * @When I fill in permission field :name
     */
    public function iFillInPermissionField($name)
    {	
    	$faker = Factory::create();
    	$this->permission = $faker->name;
        $this->fillField($name, $this->permission);
    }

    /**
     * @Then I fill in role field
     */
    public function iFillInRoleField()
    {
        $faker = Factory::create();
    	$this->role = $faker->word;
        $this->fillField("New Role", $this->role);
    }

    /**
     * @Then I should see the new role
     */
    public function iShouldSeeTheNewRole()
    {
        $this->assertPageContainsText($this->role);
    }

    /**
     * @Then I should see the new permission
     */
    public function iShouldSeeTheNewPermission()
    {
        $this->assertPageContainsText($this->permission);
    }

    /**
     * @Then I click the permission :name
     */
    public function iClickThePermission($name)
    {
        $this->clickLink($name);
    }

    /**
     * @Then I set back
     */
    public function iSetBack()
    {
        $this->iClickThePermission('permission-1');
        //$this->getSession()->wait(1000);
        $this->fillField("#edit-permission-1", "Add Contacts");
    }

}