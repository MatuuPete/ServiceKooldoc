<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Validator;
use Buchin\Badwords\Badwords;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedback = new Feedback;

        $validator = Validator::make($request->all(), 
        [
            'service_id' => 'required|integer',
            'rating' => 'required|integer',
            'review' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $badwords = new Badwords();
        $filtered_review = $badwords->strip($request->input('review'));

        $feedback->fill($request->all());
        $feedback->review = $filtered_review;
        $feedback->save();

        return response()->json([
            'message' => 'Service feedback submitted successfully!',
            'feedback' => $feedback,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Feedback::where('id', $id)->with('service')->first(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->update($request->all());

        return response()->json([
            'message' => 'Service feedback updated successfully!',
            'feedback' => $feedback,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return response()->json(['message' => 'Service feedback deleted successfully']);
    }
}
