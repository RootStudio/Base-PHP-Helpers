<?php use PHPUnit\Framework\TestCase;

class LayoutsTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_output_layout_contents()
    {
        $this->expectOutputString('Hello World');

        base_layout('layout');
    }

    /**
     * @test
     */
    public function it_will_return_layout_contents()
    {
        $result = base_layout('layout', [], true);

        $this->assertEquals('Hello World', $result);
    }

    /**
     * @test
     */
    public function it_will_output_nested_layout_contents()
    {
        $this->expectOutputString('Hello Parent');

        base_layout('nested/parent');
    }

    /**
     * @test
     */
    public function it_will_return_nested_layout_contents()
    {
        $result = base_layout('nested/parent', [], true);

        $this->assertEquals('Hello Parent', $result);
    }

    /**
     * @test
     */
    public function it_will_output_layout_vars()
    {
        $this->expectOutputString('Hello World');

        base_layout('layout-vars', ['page_title' => 'Hello World']);
    }

    /**
     * @test
     */
    public function it_will_return_layout_vars()
    {
        $result = base_layout('layout-vars', ['page_title' => 'Hello World'], true);

        $this->assertEquals('Hello World', $result);
    }

    /**
     * @test
     */
    public function it_will_output_nested_layout_vars()
    {
        $this->expectOutputString('Hello WorldHello World');

        base_layout('nested-vars/parent', ['page_title' => 'Hello World']);
    }

    /**
     * @test
     */
    public function it_will_return_nested_layout_vars()
    {
        $result = base_layout('nested-vars/parent', ['page_title' => 'Hello World'], true);

        $this->assertEquals('Hello WorldHello World', $result);
    }

    /**
     * @test
     */
    public function it_will_overwrite_nested_layout_vars()
    {
        $this->expectOutputString('Hello WorldGoodbye World');

        base_layout('nested-vars/parent-overwrite', ['page_title' => 'Hello World']);
    }

    /**
     * @test
     */
    public function it_will_return_overwritten_nested_layout_vars()
    {
        $result = base_layout('nested-vars/parent-overwrite', ['page_title' => 'Hello World'], true);

        $this->assertEquals('Hello WorldGoodbye World', $result);
    }

    /**
     * @test
     */
    public function it_will_detect_if_variable_exists()
    {
        $this->expectOutputString('Hello World');

        base_layout('layout-var-exists', ['page_title' => true]);
    }

    /**
     * @test
     */
    public function it_will_return_if_variable_exists()
    {
        $result = base_layout('layout-var-exists', ['page_title' => true], true);

        $this->assertEquals('Hello World', $result);
    }

    /**
     * @test
     */
    public function it_will_detect_if_variable_exists_in_nested()
    {
        $this->expectOutputString('Hello WorldHello World');

        base_layout('nested-var-exists/parent', ['page_title' => true]);
    }

    /**
     * @test
     */
    public function it_will_return_if_variable_exists_in_nested()
    {
        $result = base_layout('nested-var-exists/parent', ['page_title' => true], true);

        $this->assertEquals('Hello WorldHello World', $result);
    }

    /**
     * @test
     */
    public function it_will_detect_if_variable_exists_only_in_child_layout()
    {
        $this->expectOutputString('Hello World');

        base_layout('nested-var-exists/parent-overwrite', []);
    }

    /**
     * @test
     */
    public function it_will_return_if_variable_exists_only_in_child_layout()
    {
        $result = base_layout('nested-var-exists/parent-overwrite', [], true);

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
