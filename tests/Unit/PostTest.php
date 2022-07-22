<?php

namespace Tests\Unit;

use App\Models\Post;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //public function test_example()
    //{
    //    $this->assertTrue(true);
    //}

    public function testPostContents()
    {
        $box = new Post(['Delta']);
        $this->assertTrue($box->has('Delta'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOneFromThePost()
    {
        $box = new Post(['Delta']);
        $this->assertEquals('Delta', $box->takeOne());
        // Null, now the box is empty
        $this->assertNull($box->takeOne());
    }
}
