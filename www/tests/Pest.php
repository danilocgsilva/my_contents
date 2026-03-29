<?php

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

uses(RefreshDatabase::class)->in('Feature');

pest()->extend(TestCase::class)
    ->in('Feature');
