<?php

use Domain\Content;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;

test('May return NoContentException if anything setted to save', function () {
    $content = new Content();
    $content->persist();
})->throws(NoDataToSaveException::class);

test("Add one content with a single meta", function() {
    $content = new Content();
    $content->addMeta(new MetaData("name", "John Doe"));
    $content->persist();
});
