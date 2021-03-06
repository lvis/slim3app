<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

// --------------------------------------Register: Settings
$container = $app->getContainer();
$settings  = $container->get( 'settings' );
$settings->replace( [
	'displayErrorDetails'    => true, // For Production set: false
	'addContentLengthHeader' => false, // Allow the web server to send the content-length header
] );
// [Container: View - PhpRenderer]
$container['view'] = new Slim\Views\PhpRenderer( __DIR__.'/templates/' );
// [Container: Logger - Monolog]
$logger = new Logger( 'Slim3App' );
$logger->pushProcessor( new UidProcessor() );
$logger->pushHandler( new StreamHandler( __DIR__.'/logs/app.log', Logger::DEBUG ) );
$container['logger'] = $logger;
// --------------------------------------Register: Middleware
// $app->add(new \Slim\Csrf\Guard);
// --------------------------------------Register: Routes
$app->get( '/[{name}]', function ( Request $request, Response $response, array $args ) {
	// Write Log Message
	$this->logger->info( "Executed '/[{name}]' route with attribute", $args );

	// Render View
	return $this->view->render( $response, 'index.phtml', $args );
} );