<?php

use Domain\Content;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;
use Domain\Interfaces\ContentInterface;

// uses(Tests\TestCase::class)->in('Feature');

/**
 * @var ContentInterface|null
 */
$content = null;

beforeEach(function () use (&$content) {
    $content = $this->app->make(Content::class);
});

test('May return NoContentException if anything setted to save', function () use (&$content) {
    $content->persist();
})->throws(NoDataToSaveException::class);

test("Add one content with a single meta", function() use (&$content) {
    $content->addMeta(new MetaData("name", "John Doe"));
    $content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 1);
    $this->assertDatabaseCount('string_metadata', 1);
});

test("Add one content with a single meta, but with a numerical one", function() use (&$content) {
    $content->addMeta(new MetaData("age", 33));
    $content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 1);
    $this->assertDatabaseCount('int_metadata', 1);
});

test("Add one content with two meta, the name and the age", function() use (&$content) {
    $content->addMeta(new MetaData("age", 33));
    $content->addMeta(new MetaData("name", "Oliver Cohen"));
    $content->persist();

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 2);
    $this->assertDatabaseCount('int_metadata', 1);
    $this->assertDatabaseCount('string_metadata', 1);
});
