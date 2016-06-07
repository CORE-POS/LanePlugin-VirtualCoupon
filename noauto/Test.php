<?php

use COREPOS\pos\lib\FormLib;

class Test extends PHPUnit_Framework_TestCase
{
    public function testPlugin()
    {
        $obj = new VirtualCoupon();
    }

    public function testParser()
    {
        $p = new VirtualCouponParser();
        $this->assertEquals(true, $p->check('VC'));
        $this->assertEquals(false, $p->check('Foo'));
        $json = $p->parse('VC');
        $this->assertArrayHasKey('output', $json);
        CoreLocal::set('memberID', 1);
        $json = $p->parse('VC');
        $this->assertNotEquals(false, strstr($json['main_frame'], 'VirtCoupDisplay'));
    }

    public function testPages()
    {
        $page = new VirtCoupDisplay();
        $this->assertEquals(true, $page->preprocess());
        ob_start();
        $page->head_content();
        $page->body_content();
        ob_end_clean();
    }
}

