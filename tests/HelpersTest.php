<?php use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function public_path_returns_valid_path()
    {
        $result = base_public_path();

        $this->assertIsString( $result);
        $this->assertEquals(__DIR__, $result);
    }

    /**
     * @test
     */
    public function public_path_can_be_appended_to()
    {
        $result = base_public_path('/my_directory');

        $this->assertIsString($result);
        $this->assertEquals(__DIR__ . '/my_directory', $result);
    }

    /**
     * @test
     */
    public function it_will_output_versioned_asset_path()
    {
        $file = 'unversioned.css';

        touch(base_public_path('mix-manifest.json'));

        file_put_contents(base_public_path('mix-manifest.json'), json_encode([
            '/unversioned.css' => '/versioned.css',
        ]));

        $result = base_asset($file);

        $this->assertEquals($result, '/versioned.css');

        unlink(base_public_path('mix-manifest.json'));
    }

    /**
     * @test
     */
    public function it_will_output_a_new_faker_factory_instance()
    {
        $result = base_faker_factory();

        $this->assertInstanceOf(Faker\Generator::class, $result);
    }

    /**
     * @test
     */
    public function it_will_output_http_host()
    {
        $host = 'base.dev';

        $_SERVER['HTTP_HOST'] = $host;

        $result = base_http_host();

        $this->assertEquals('http://' . $host, $result);
    }

    /**
     * @test
     */
    public function it_will_output_ssl_protocol_on_http_host()
    {
        $host = 'base.dev';

        $_SERVER['HTTP_HOST'] = $host;
        $_SERVER['HTTPS'] = 'on';

        $result = base_http_host();

        $this->assertEquals('https://' . $host, $result);
    }

    public function setUp() : void
    {
        $externalMock = Mockery::mock('overload:RootStudio\Base');
        $externalMock->shouldReceive('getPublicPath')->andReturn(__DIR__);

        parent::setUp();
    }

    public function tearDown() : void
    {
        Mockery::close();
    }
}
