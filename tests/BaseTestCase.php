<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Psr\Http\Message\ResponseInterface;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends TestCase {
	/**
	 * Process the application given a request method and URI
	 *
	 * @param string $requestMethod the request method (e.g. GET, POST, etc.)
	 * @param string $requestUri the request URI
	 * @param array|object|null $requestData the request data
	 *
	 * @return ResponseInterface
	 */
	public function runApp( $requestMethod, $requestUri, $requestData = null ) {
		// Create a mock environment for testing with
		$environment = Environment::mock( [
			'REQUEST_METHOD' => $requestMethod,
			'REQUEST_URI'    => $requestUri,
		] );
		// Set up a request object based on the environment
		$request = Request::createFromEnvironment( $environment );
		// Add request data, if it exists
		if ( isset( $requestData ) ) {
			$request = $request->withParsedBody( $requestData );
		}
		$response = new Response();
		$app = new App();
		require __DIR__.'/../init.php';
		$response = $app->process( $request, $response );

		return $response;
	}
}