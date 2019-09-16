<?php

namespace Tests;

use Tests\Models\Comment;
use Tests\Models\Country;

class HasOneDeepTest extends TestCase
{
    public function testLazyLoading()
    {
        $comment = Country::first()->comment;

        $this->assertEquals(31, $comment->id);
    }

    public function testLazyLoadingWithDefault()
    {
        $comment = Country::find(2)->comment;

        $this->assertInstanceOf(Comment::class, $comment);
        $this->assertFalse($comment->exists);
    }

    public function testEagerLoading()
    {
        $countries = Country::with('comment')->get();

        $this->assertEquals(31, $countries[0]->comment->id);
        $this->assertInstanceOf(Comment::class, $countries[1]->comment);
        $this->assertFalse($countries[1]->comment->exists);
    }

    public function testLazyEagerLoading()
    {
        $countries = Country::all()->load('comment');

        $this->assertEquals(31, $countries[0]->comment->id);
        $this->assertInstanceOf(Comment::class, $countries[1]->comment);
        $this->assertFalse($countries[1]->comment->exists);
    }

    public function testFromRelations()
    {
        $comment = Country::first()->commentFromRelations;

        $this->assertEquals(31, $comment->id);
    }
}
