<?php

namespace Flex\IdenticonAvatar\Tests;

use PHPUnit\Framework\TestCase;
use Flex\IdenticonAvatar\Identicon;

class IdenticonTest extends TestCase
{

    public function testSaveAvatar(){
        $ide = new Identicon();
        $ide->saveAvatar('sdp',25,'sdp.png');
        $this->assertTrue(true);
    }

    public function testGetAvatarDataUri(){
        $ide = new Identicon();
        $ide->getAvatarDataUri('sdp',25);
        $this->assertTrue(true);
    }
}