<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SurveyResource;
use App\Mail\SurveyMail;
use App\Models\Survey;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Validator;

class SurveyController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        try {
            $survey = Survey::create($input);
            Mail::to($request->email)->send(new SurveyMail());
            $redirect = url('/success');
        } catch (Exception $e) {
            Log::channel('error')->error('Fail to create survey and send mail.' . $e);
            // Log::channel('error')->error($e);
            return $this->sendError('Survey Save and Send Mail Error.', $e->getMessage());
        }

        return $this->sendResponse(new SurveyResource($survey), $redirect);
    }
}
