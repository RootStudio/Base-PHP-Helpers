<?php use PHPUnit\Framework\TestCase;

class LayoutsTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_output_layout_contents()
    {
        $this->expectOutputString('Hello World');

        base_layout('layout.stub');
    }

    /**
     * @test
     */
    public function it_will_return_layout_contents()
    {
        $result = base_layout('layout.stub', [], true);

        $this->assertEquals('Hello World', $result);
    }

    public function setUp()
    {
        $externalMock = Mockery::mock('overload:RootStudio\Base');
        $externalMock->shouldReceive('getLayoutPath')->once()->andReturn(__DIR__ . '/stubs');

        parent::setUp();
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
