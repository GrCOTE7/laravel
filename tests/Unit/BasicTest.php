<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class BasicTest extends TestCase
{
	/**
	 * A basic test example.
	 */
	public function testBasicTest(): void
	{
		$data   = [10, 20, 30];
		$result = array_sum($data);
		$this->assertEquals(60, $result);
	}

	public function testAStringTest(): void
	{
		$data = 'Je suis petit';
		$this->assertTrue(str()->startsWith($data, 'Je'));
		$this->assertFalse(str()->startsWith($data, 'Tu'));
		$this->assertSame(str()->startsWith($data, 'Tu'), false);
		$this->assertStringStartsWith('Je', $data);
		$this->assertStringEndsWith('petit', $data);
	}
}
