<?php


namespace App\Http\Controllers;

use App\Exceptions\JsonRpcException;
use App\Services\JsonRpcService\Hydrators\PageHydrator;
use App\Services\JsonRpcService\PageHandlingService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @param Request $request
     * @param PageHandlingService $service
     * @param PageHydrator $hydrator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index(Request $request, PageHandlingService $service, PageHydrator $hydrator)
    {
        $pageUID = $request->get('page_uid', '');
        $viewData = [];
        if ($pageUID) {
            try {
                $pageDTO = $service->getPageByUID($pageUID);
                $viewData = $hydrator->extract($pageDTO);
            } catch (JsonRpcException $e) {
                $viewData = ['error' => $e->getMessage()];
            }
        }

        return view('page', $viewData);
    }

    /**
     * @param Request $request
     * @param PageHandlingService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addPage(Request $request, PageHandlingService $service)
    {
        $name = $request->get('name', '');
        $author = $request->get('author', '');

        $viewData = [];
        if ($name && $author) {
            try {
                $pageUID = $service->addPage($name, $author);
                $viewData = ['uid' => $pageUID->getUid()];
            } catch (JsonRpcException $e) {
                $viewData = ['error' => $e->getMessage()];
            }
        }

        return view('add_page', $viewData);
    }
}
