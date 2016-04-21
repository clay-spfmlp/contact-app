Feature: Authentication
	
	In order to let user login to my website
	As a user
	I need to be able to register, authentication and recover passwords for users

	@javascript
	Scenario: Successfully creating a new user
		When I register for an account
		Then I should be logged in

	@javascript
	Scenario: Failing to provide correct info for registration
		When I go to the login page
		And press "Need an Account?"
		And I enter an incorrect email address
		Then I should see an error message

	@javascript
	Scenario: Successfully Logging in
		Given I have an account
		When I go to the login page
		And I enter my login info
		Then I should be logged in

	@javascript
	Scenario: Logging in unsuccessfully
		Given I do not have an account
		When I go to the login page
		And I enter wrong login info
		Then I should not be logged in

	@javascript
	Scenario: Requesting a forgotten password
		Given I have an account
		When I go to the login page