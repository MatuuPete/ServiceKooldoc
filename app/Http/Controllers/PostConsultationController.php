<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostConsultation;
use Validator;

class PostConsultationController extends Controller
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
        $post_consultation = new PostConsultation;

        $validator = Validator::make($request->all(), 
        [
            'service_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $post_consultation->consultation_date = date('Y-m-d');
        $post_consultation->fill($request->except('consultation_date'));
        $post_consultation->save();

        return response()->json([
            'message' => 'Service post consultation sent successfully!',
            'post_consultation' => $post_consultation,
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
        return response(PostConsultation::where('id', $id)->with('service')->first(), 200);
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
        $post_consultation = PostConsultation::find($id);
        $post_consultation->update($request->all());

        return response()->json([
            'message' => 'Service post consultation replied successfully!',
            'post_consultation' => $post_consultation,
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
        $post_consultation = PostConsultation::find($id);
        $post_consultation->delete();
        return response()->json(['message' => 'Service post consultation deleted successfully']);
    }
}
