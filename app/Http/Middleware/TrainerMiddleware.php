<?php

namespace App\Http\Middleware;
use App\Models\Trainee;
use Closure;
use Illuminate\Http\Request;

class TrainerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
      if ($request->user() && $request->user()->role == 'TA') {
        $trainee_id = $request->route('trainee');
        if (!$trainee_id) {
          $trainee_id = $request->route('trainee');
        }
        $trainer_id = $request->user()->id;
        $traineeList = Trainee::where('trainer_id',  $trainer_id)->pluck('id')->toArray();
        if (!in_array($trainee_id, $traineeList)) {
          abort(403, 'Unauthorized action.');
        }
      }
      return $next($request);
    }
}
