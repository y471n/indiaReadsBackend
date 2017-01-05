<?php

namespace App\Http\Controllers;

use App\IndiaReads\Repository\Eloquent\TrendingRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

/**
 * Class TrendingController
 * @package App\Http\Controllers
 */
class TrendingController extends ApiController
{

    /**
     * @var TrendingRepository
     */
    protected $trendingRepository;

    /**
     * @param TrendingRepository $trendingRepository
     */
    function __construct(TrendingRepository $trendingRepository)
    {
        $this->trendingRepository = $trendingRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if($this->trendingRepository->limited(10)) {
            return $this->respond($this->trendingRepository->limited(10));
        }
        return $this->respondNotFound();
    }

}
