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
            $result = $this->_api_service->get($this->filter_url, '/v2/courses/' . $types,
                ['area' => $area, 'limit' => $limit,'tags'=> $tags, 'certifiers' => get_active_certifiers()]);
        return (object) [
            'data'     => $result->data,
            'metadata' => $result->metadata
        ];
    }

    function get_courses($types,$area,$limit,$page,$sort){
            $result = $this->_api_service->get($this->filter_url, '/v2/courses/' . $types,
                ['area' => $area, 'limit' => $limit,'page' => $page, 'sort' => $sort, 'certifiers' => get_active_certifiers()]);
        return (object) [
            'data'     => $result->data,
            'metadata' => $result->metadata
        ];
    }


}