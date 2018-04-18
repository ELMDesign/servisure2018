<?php
/**
 * @file
 * Contains \Drupal\recaptcha\RecaptchaTest
 */

namespace Drupal\Tests\recaptcha;

use Drupal\recaptcha\Recaptcha;
use Drupal\Tests\UnitTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Tests the recaptcha service.
 *
 * @coversDefaultClass \Drupal\recaptcha\Recaptcha
 * @group recaptcha
 */
class RecaptchaTest extends UnitTestCase {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;


  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();


    $this->configFactory = $this->getConfigFactoryStub([
      'recaptcha.settings' => ['secret_key' => $this->randomMachineName()]
    ]);

    $this->requestStack = new RequestStack();
    $request = Request::create('/foo', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
    $this->requestStack->push($request);

  }

  /**
   * Tests the verification feature.
   *
   * @covers ::verify
   */
  public function testVerifySuccess() {

    // Create a mock  handler.
    $mock = new MockHandler([
      new Response(200, [], file_get_contents(__DIR__ . '/response-success.json'))
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    /* @var \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject $logger */
    $logger = $this->getMock('\Psr\Log\LoggerInterface');
    $logger->expects($this->never())
      ->method('error');

    $recaptcha = new Recaptcha($client, $this->requestStack, $this->configFactory, $logger);
    $response = $recaptcha->verify($this->randomMachineName());

    $this->assertTrue($response['success'], "The response was success");

  }

  /**
   * Tests an error response.
   *
   * @covers ::verify
   */
  public function testVerifyError() {

    // Create a mock  handler.
    $mock = new MockHandler([
      new Response(400, [], "There was an error.")
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    /* @var \Psr\Log\LoggerInterface|\PHPUnit_Framework_MockObject_MockObject $logger */
    $logger = $this->getMock('\Psr\Log\LoggerInterface');
    $logger->expects($this->once())
      ->method('error');

    $recaptcha = new Recaptcha($client, $this->requestStack, $this->configFactory, $logger);
    $response = $recaptcha->verify($this->randomMachineName());

    $this->assertFalse($response['success'], "The response was not a success");
  }

}
