<?php
/**
 * Created by PhpStorm.
 * User: yatin
 * Date: 23/07/15
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {


    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $items
     * @param $data
     * @return mixed
     */
    public function respondWithPagination(array $paginator_items, $data)
    {
        if(count($data) == 0) {
            return $this->respondNotFound();
        }
        // foreach ($paginator_items as $key => $value) {
        //     if( ($key == 'prev_page_url') || ($key == 'data') || ($key == 'next_page_url')
        //         || ($key == 'from') || ($key == 'to') ){
        //         array_splice($paginator_items, array_search($key, $paginator_items), 1);
        //     }
        // }
        $paginator_items['data'] = $data;
        return $this->respond($paginator_items);
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondInternalError($message = 'Internal Error !')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respondNotAuthorized($message = 'Not Authorized !')
    {
        return $this->setStatusCode(405)->respondWithError($message);
    }

    public function respondInvalidInputData($message = 'Invalid input data!')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }
}
