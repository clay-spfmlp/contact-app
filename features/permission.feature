Feature: Permission
	
	In order to assign permission to roles
	As an administrator
	I need to be able to add new roles, permission, assign permission to roles

	@javascript
	Scenario: Successfully assigning permission to a role
		Given I am an Admin
		And I am on permission page
		When I click on a check-box
		Then permission is assign to role

	@javascript
	Scenario: Creating a new permission
		Given I am an Admin
		And I am on permission page
		And wait a sec "100"
		When I press "Create a Permission"
		And wait a sec "100"
		When I fill in permission field "New Permission"
		When I select "Contact" from "model"
		And I press "Go"
		And wait a sec "100"
		Then I should see the new permission
		And wait a sec "100"

	@javascript
	Scenario: Creating a new role
		Given I am an Admin
		And I am on permission page
		When I press "Create a Role"
		Then I fill in role field
		And I press "Go"
		And wait a sec "1000"
		Then I should see the new role
		And wait a sec "100"

	@javascript
	Scenario: Editing a permission
		Given I am an Admin
		And I am on permission page
		And wait a sec "1000"
		Then I click the permission "permission-1"
		And wait a sec "1000"
		When I fill in permission field "edit-permission-name-1"
		When I select "Label" from "edit-permission-model-1"
		And wait a sec "1000"
		And I press "edit-permission-go-1"
		And wait a sec "1000"
		Then I should see the new permission
		And wait a sec "1000"

	@javascript
	Scenario: Editing a role
		Given I am an Admin
		And I am on permission page
		When I click the role name
		Then I should see a input with the role name filled in
		And a button to submit the form
		When I submit the form
		Then I should see the role Update