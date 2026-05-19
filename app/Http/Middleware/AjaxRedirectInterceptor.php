<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxRedirectInterceptor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->wantsJson() && $response instanceof \Illuminate\Http\RedirectResponse) {
            $message = session()->get('success') ?? session()->get('error') ?? 'Action completed successfully';
            $success = session()->has('error') ? false : true;
            
            // Forget session data so it doesn't show up on next page load
            session()->forget(['success', 'error']);

            return response()->json([
                'success' => $success,
                'message' => $message,
                'redirect' => $response->getTargetUrl()
            ]);
        }

        return $response;
    }
}
