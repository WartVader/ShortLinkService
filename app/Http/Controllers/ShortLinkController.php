<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShortLinkController extends Controller
{
    protected ShortLinkService $shortLinkService;

    public function __construct(ShortLinkService $shortLinkService)
    {
        $this->shortLinkService = $shortLinkService;
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request, string $slug)
    {
        $redirectUrl = $this->shortLinkService->getRedirectUrl($slug);

        return redirect($redirectUrl);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShortLinkRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $shortLink = $this->shortLinkService->create($data);

        return response()->json($shortLink->toArray(), 201);
    }
}
