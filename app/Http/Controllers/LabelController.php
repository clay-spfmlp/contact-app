<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Label;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LabelController extends Controller
{

    protected $label;

    protected $user;

    public function __construct(Label $label, User $user)
    {
        $this->label = $label;
        $this->user = $user;
    }

    public function userLabels($user_id)
    {
        return $this->user->find($user_id)->labels()->get();
    }


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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //return $request->all();
        $label = $this->label;
        $label->name = $request->get('name');
        $label->save();

        $label->user()->attach($request->get('user_id'));
        $labels = $this->label->with('contacts')->find($label->id);
        return $labels;
        //return $this->labels->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
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
        $label = $this->label->find($id);
        $label->name = $request->get('name');
        $label->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->label->destroy($id);
    }
}
