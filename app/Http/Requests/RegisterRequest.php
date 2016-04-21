<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }

	public function response(array $errors)
	{
	    // Optionally, send a custom response on authorize failure 
	    // (default is to just redirect to initial page with errors)
	    // 
	    // Can return a response, a view, a redirect, or whatever else

	    if ($this->ajax() || $this->wantsJson())
	    {
	        return new JsonResponse($errors, 422);
	    }
	    return $this->redirector->to('login#register')
	         ->withInput($this->except($this->dontFlash))
	         ->withErrors($errors, $this->errorBag);
	}
}
