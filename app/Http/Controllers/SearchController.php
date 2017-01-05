<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Laracurl;

/**
* Search Class
*/
class SearchController extends ApiController {

    /**
     * Search Function
     */
    public function search() {
        // "query": 'Harry Potter'
        $search_query = Input::get('query');
        // $search_params = Input::get('params');

        // $params = json_decode($search_params, true);
        // return $params;

        // Search URL
        $base_url = 'http://54.254.232.234:8983/solr/solr_master/select';
        $url_params_in_lib = Laracurl::buildUrl($base_url,
            ['q' => ''. $search_query.''." AND status:1 OR 2 OR 0", 'wt' => 'json', 'indent' => 'true', 'group' => 'true', 'group.field' => 'ISBN13']);
        $data_in_lib = Laracurl::get($url_params_in_lib);
        $result_in_lib = json_decode($data_in_lib, true);
        return $this->respond(array('data' => $result_in_lib['grouped']));
    }
}
