<?php

class FirstCest
{

    public String $IncorrectEmail = '12345689@gmail.com';
    public string $CorrectEmail  = 'Gytunass@gmail.com';
    public string $CorrectPhone = '+37069064943';
    public string $IncorrectPhone = '+3706159474';
    public String $WelcomeXpath = '//div[@class="panel-title"]';
    public String $Page = '/login';
    public String $LoginButton = '//*[@class="btn btn-primary btn-block btn-rounded text-uppercase"]';
    public String $InvalidLogInXpath = '//*[@class="alert alert-danger"]';
    public String $Password = '123456';

    public function _before(AcceptanceTester $I)
    {

    }

    // Checking if app banner is visible in big screen
    public function MaximizeScreen(AcceptanceTester $I)
    {
        $I->amOnPage($this-> Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->maximizeWindow();
        $I->seeElement('//aside/div/div[@class="login-banner-container"]');
    }

    // Checking if correct phone number validating
    public function LogInWithPhoneCorrectPhone(AcceptanceTester $I)
    {
        $I->amOnPage($this-> Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->fillField("//div/form/div/div/input[@name='userIdentifier']", $this->CorrectPhone);
        $I->click($this -> LoginButton);
        $I->waitForElement('//*[@id="login-methods-heading-user_credentials"]/strong',2);
        $I->see('+37069064943', '//div/div/strong');
        $I->fillField(["name" => "password"], $this -> Password);
        $I->click($this -> LoginButton);
        $I->wait(2);
        $I->waitForElement('//div/div/form/div');
        $I->see('Incorrect password. Please try again.');
    }

    // Checking if customer can see error if incorrect Phone number entered
    public function LogInWithPhoneIncorrectPhone(AcceptanceTester $I)
    {
        $I->amOnPage($this-> Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->fillField("//div/form/div/div/input[@name='userIdentifier']", $this-> IncorrectPhone);
        $I->click($this -> LoginButton);
        $I->waitForElement($this->InvalidLogInXpath);
        $I->see('The specified user could not be found');
    }

    //Checking if customer can go to reset password page
    public function PasswordReset(AcceptanceTester $I)
    {
        $I->amOnPage($this->Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->fillField("//div/form/div/div/input[@name='userIdentifier']", $this-> CorrectEmail);
        $I->click($this -> LoginButton);
        $I->waitForElement('//*[@id="login-methods-heading-user_credentials"]/strong',2);
        $I->click('Forgot password?');
        $I->waitForText('PASSWORD RESET');
        $I->waitForElement('//div/div/label[@Class="control-label ng-binding"]');

    }

    //Checking if user are informed that he entered incorrect email
    public function UnsuccessfullLogInWithEmail(AcceptanceTester $I)
    {
        $I->amOnPage($this->Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->fillField("//div/form/div/div/input[@name='userIdentifier']", $this->IncorrectEmail );
        $I->click($this -> LoginButton);
        $I->waitForElement($this->InvalidLogInXpath);
        $I->waitForText('The specified user could not be found');
    }

    //Checking if users get error if password incorrect
    public function LogInWithCorrectEmail(AcceptanceTester $I)
    {
        $I->amOnPage($this->Page);
        $I->see('Log in', $this-> WelcomeXpath);
        $I->fillField("//div/form/div/div/input[@name='userIdentifier']", $this-> CorrectEmail);
        $I->click($this -> LoginButton);
        $I->waitForElement('//*[@id="login-methods-heading-user_credentials"]/strong',2);
        $I->see($this-> CorrectEmail, '//div/div/strong');
        $I->fillField(["name" => "password"], $this -> Password);
        $I->click($this -> LoginButton);
        $I->wait(2);
        $I->waitForElement('//div/div/form/div',3);
        $I->see('Incorrect password. Please try again.');
    }
}