<?php

declare(strict_types=1);

namespace Yii\ContactForm\Tests\Acceptance;

use Yii\ContactForm\Tests\Support\AcceptanceTester;

final class ContactPageCest
{
    public function contactPageWorks(AcceptanceTester $I)
    {
        $I->amGoingTo('go to the contact page');
        $I->amOnPage('/contact');
        $I->wantTo('ensure that contact page works');
        $I->see('Contact');
    }

    public function contactFormCanBeSubmitted(AcceptanceTester $I)
    {
        $I->amGoingTo('go to the contact page');
        $I->amOnPage('/contact');
        $I->wantTo('ensure that contact page works');
        $I->see('Contact');

        $I->amGoingTo('submit contact form with correct data');
        $I->fillField('ContactForm[name]', 'tester');
        $I->fillField('ContactForm[email]', 'tester@example.com');
        $I->fillField('ContactForm[subject]', 'test subject');
        $I->fillField('ContactForm[message]', 'test content');

        $I->click('send');
    }
}
