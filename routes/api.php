<?php

use Illuminate\Http\Request;

use App\Score;

Route::middleware(['cors'])->group(function () {
  Route::get('scores', function (Request $request) {
    return Score::orderBy('score', 'desc')->take(20)->get();
  });

  Route::post('scores', function (Request $request) {
    $validator = Validator::make($request->all(), [
      'name'  => 'required',
      'score' => 'required'
    ]);
    
    if ($validator->fails()) {
      return $validator->messages();
    }

    $name = $request->input('name');
    $score = $request->input('score');
    $wrong_answer = $request->input('wrong_answer') ?: '';

    return Score::create([
      'name'         => $name,
      'score'        => $score,
      'wrong_answer' => $wrong_answer
    ]);
  });
});
