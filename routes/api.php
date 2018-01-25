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

    return Score::create($request->only(['name', 'score', 'wrong_answer']));
  });
});
