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

    //listagem de areas
	function get_area(){
            $result = $this->_api_service->get( $this->filter_url, '/course_areas/list');
        return (object) [
            'data'     => $result->data
        ];
    }



    function sucess_courses($types,$area,$limit,$tags){
        $voucher = sanitize_text_field($_REQUEST['voucher']) or '';
            $result = $this->_api_service->get('piaget', '/v2/courses/' . $types,
                ['area' => $area, 'limit' => $limit,'tags'=> $tags, 'certifiers' => get_active_certifiers()]);
        return (object) [
            'data'     => $result->data,
            'metadata' => $result->metadata
        ];
    }


}