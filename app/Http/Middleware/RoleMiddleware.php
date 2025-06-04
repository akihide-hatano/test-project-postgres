<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
 if (!Auth::check()) {
            // ログインしていない場合は、ログインページにリダイレクト
            return redirect()->route('login'); // または '/login'
        }

        // 2. ログインしているユーザーを取得
        // Auth::user() は、Auth::check() が true の場合のみ安全に呼び出せます。
        $user = Auth::user();

        // 3. ロールチェックのロジック
        // ユーザーが存在し、かつロールが 'admin' であるかを確認
        // $user が null でないことを保証してから role プロパティにアクセスします。
        if ($user && $user->role == 'admin') {
            return $next($request); // 管理者の場合はリクエストを次の処理へ続行
        }

        // 4. ロールが 'admin' ではない場合の処理
        // 管理者でない場合は、'dashboard' ルートにリダイレクト
        return redirect()->route('dashboard');
    }
}
