<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JavaScript;
use App\Models\Contact;
use App\Models\User;
use App\Models\Label;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    protected $contact;

    protected $user;
    
    protected $label;

    public function __construct(Contact $contact, User $user, Label $label)
    {
        $this->contact = $contact;
        $this->user = $user;
        $this->label = $label;
    }

    public function contacts()
    {
        JavaScript::put([
            'user' => \Auth::user(),
        ]);

        return view('contacts.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userContacts($user_id)
    {
        return $this->user->find($user_id)->contacts()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->contact()->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$contact = $this->contact->create($request->all());
        $contact->user()->attach($request->get('user_id'));
        $contact->labels->sync($request->get('labels'));
        
        return $this->contact->find($contact->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->contact->find($id);

        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = $this->contact->find($id);

        return view('contact.edit', compact('contact'));
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
        $contact = $this->contact->find($id);
        $contact->update($request->all());
        $contact->labels()->sync($request->get('labels'));
        
        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->contact->destroy($id);
    }

    /**
     * @param  Request
     * @return \Illuminate\Http\Response
     */
	public function deleteCheck(Request $request)
	{
		foreach ($request->get('ids') as $id) {
			$this->contact->destroy($id);
		}
	}

	public function addLabel(Request $request)
	{
		foreach ($request->get('ids') as $id) {
			//$label = $this->label->find($request->get('labelId'));
			$contact = $this->contact->find($id);

			if (!$contact->labels->contains($request->get('labelId'))) {
			    $contact->labels()->attach($request->get('labelId'));
			}


			//$contact->labels()->sync([$request->get('labelId')]);
		}
	}

}
