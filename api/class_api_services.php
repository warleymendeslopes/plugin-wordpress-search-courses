<?php

class ApiService {

	public function __construct() {
		if ( ! defined( 'DEBUG_REQUESTS' ) ) {
			define( 'DEBUG_REQUESTS', false );
		}

		if ( ! defined( 'CACHE_REQUESTS_SECONDS' ) ) {
			define( 'CACHE_REQUESTS_SECONDS', 900 );
		}
	}

	function get( $api, $path, $params = [], $headers = [], $json_data = true, $timeout = 5 ) {

		if ( function_exists( 'wp_cache_get' ) && function_exists( 'wp_cache_set' ) ) {
			$cached_response = wp_cache_get( $api . $path . implode( ",", (array) $params ) . implode( ",", (array) $headers ), 'api_request', false, $found );

			if ( $found ) {

				if ( DEBUG_REQUESTS ) {

					$url = $api . $path . '?' . http_build_query( $params, '', '&' );

					echo '<blockquote>';
					echo '<strong>FOUND CACHE: </strong> ' . $url . '<br/>';
					echo '</blockquote>';
				}

				return $cached_response;
			}
		}

		if ( DEBUG_REQUESTS ) {
			$time = microtime( 1 );
		}

		if ( $api === null ) {
			die( "API $api not defined" );
		}

		$url = $api . $path . '?' . http_build_query( $params, '', '&' );
        $api_response = wp_remote_get( $url, [
			'sslverify' => false,
			'headers'   => $headers,
			'timeout'   => $timeout
		] );

        $response = (object) [
			'status'   => wp_remote_retrieve_response_code( $api_response ),
			'headers'  => wp_remote_retrieve_headers( $api_response ),
			'data'     => $json_data ? @json_decode( wp_remote_retrieve_body( $api_response ) )->data : wp_remote_retrieve_body( $api_response ),
			'metadata' => @json_decode( wp_remote_retrieve_body( $api_response ) )->metadata ?: null
		];

		if ( DEBUG_REQUESTS ) {
			echo ' <blockquote>';
			echo ' <strong>Request </strong >: ' . $url . ' (' . $response->status . ') <br/>';
			echo ' <strong>Tempo </strong>: ', ( microtime( 1 ) - $time ), "s";
			echo ' </blockquote> ';
		}

		if ( function_exists( 'wp_cache_get' ) && function_exists( 'wp_cache_set' ) && $response->status == 200 ) {
			wp_cache_set( $api . $path . implode( ",", (array) $params ) . implode( ",", (array) $headers ), $response, 'api_request', CACHE_REQUESTS_SECONDS );
		}

		return $response;
	}

}
