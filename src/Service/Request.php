<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

/**
 * The request class authenticate with a token and
 * call data from the myhotelshop API
 *
 * @package wallstreetonline\stockquotes\Service
 */
class Request {

	/**
	 * contains the authentication token
	 *
	 * @var string
	 */
	private $secure_token = FALSE;

	/**
	 * simple the login data
	 *
	 * @var string | json
	 */
	private $login = '{"email": "company@myhotelshop.de", "password": "y41RGsFnpoCNylIp"}';

	/**
	 * The URL to the API
	 *
	 * @var string
	 */
	private $base_route = 'http://www.wallstreet-online.de/';

	/**
	 * The option name where is used in wordpress to store
	 * data in the database
	 *
	 * @var bool
	 */
	private $option_name = FALSE;

	/**
	 * Set some information about the request.
	 *
	 * @param $args array [ option_name, endpoint ]
	 * @example get_items( [ 'option_name' => '_rpc/json/instrument/quotes/', 'endpoint' => 'campaignmanagements' ] ] )
	 *
	 */
	public function __construct( $args ) {

		$this->option_name = $args['option_name'];
		$this->endpoint = $args['endpoint'];

		$this->request();

	}

	/**
	 * Prepare the requests
	 *
	 * @param bool|FALSE $action
	 *
	 * @return mixed
	 */
	private function request( $action = FALSE ) {

		$args[ 'request_type' ] = 'GET';

		$reponse = $this->get_remote( $this->endpoint, $args );

		$handle = new OptionStorageHandler( $this->option_name );
		$handle->update( $reponse );

	}

	/**
	 * Do a request
	 *
	 * @param $endpoint
	 * @param $args
	 *
	 * @return array|mixed|object|\WP_Error
	 */
	private function get_remote( $endpoint, $args ) {

		$args[ 'headers' ][ 'Content-type' ] = "application/json";

		if( $args[ 'request_type' ] == 'GET' ) {

			$response = wp_remote_get(
				$this->base_route . $endpoint,
				$args
			);

		}else {

			$response = wp_remote_post(
				$this->base_route . $endpoint,
				$args
			);
		}

		$response_body = wp_remote_retrieve_body( $response );

		if ( $response[ 'response' ][ 'code' ] == 200 ) {

			$response = json_decode( $response_body );

		}

		return $response;

	}

}