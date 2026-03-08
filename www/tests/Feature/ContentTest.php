<?php

use Domain\Content;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;
use Domain\Interfaces\ContentInterface;

$content = null;

beforeEach(function () use (&$content) {
    $content = $this->app->make(Content::class);
});

test('May return NoContentException if anything setted to save', function () use (&$content) {
    $content->persist();
})->throws(NoDataToSaveException::class);

test("Add one content with a single meta", function() {
    // $content = $this->app->make(Content::class);
    $this->content->addMeta(new MetaData("name", "John Doe"));
    $this->content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 1);
    $this->assertDatabaseCount('string_metadata', 1);
});

test("Add one content with a single meta, but with a numerical one", function() {
    // $content = $this->app->make(Content::class);
    $this->content->addMeta(new MetaData("age", 33));
    $this->content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 1);
    $this->assertDatabaseCount('int_metadata', 1);
});

test("Add one content with two meta, the name and the age", function() {
    // $content = $this->app->make(Content::class);
    $this->content->addMeta(new MetaData("age", 33));
    $this->content->addMeta(new MetaData("name", "Oliver Cohen"));
    $this->content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 2);
    $this->assertDatabaseCount('int_metadata', 1);
    $this->assertDatabaseCount('string_metadata', 1);
});
