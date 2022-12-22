<?php

require_once( 'class_api_services.php' );

/**
 * @property ApiService _api_service
 */
class PiagetService {

	public function __construct() {
		$this->_api_service = new ApiService();
	}


    protected $filter_url = 'https://api-lyratec.institutoprominas.com.br';


	function get_area(){
            $result = $this->_api_service->get( $this->filter_url, '/course_areas/list');
        return (object) [
            'data'     => $result->data
        ];
    }
}