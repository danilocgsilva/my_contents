<?php

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class)->in('Feature');

pest()->extend(TestCase::class)
    ->in('Feature');
