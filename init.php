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
// [Container:  View - PhpRenderer]
$container['view'] = new Slim\Views\PhpRenderer( 'templates/' );
// [Container: Logger - Monolog]
$logger = new Logger( 'SlimApp' );
$logger->pushProcessor( new UidProcessor() );
$logger->pushHandler( new StreamHandler( 'logs/app.log', Logger::DEBUG ) );
$container['logger'] = $logger;
// --------------------------------------Register: Middleware
// $app->add(new \Slim\Csrf\Guard);
// --------------------------------------Register: Routes
$app->get( '/[{name}]', function ( Request $request, Response $response, array $args ) {
	// Write Log Message
	$this->logger->info( "Slim-Skeleton '/' route", $args );

	// Render View
	return $this->view->render( $response, 'index.phtml', $args );
} );