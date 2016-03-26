<?php

class HistoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /history
	 *
	 * @return Response
	 */
	public function index()
	{
		$status = [

			'0' => 'Not Paid',
			'1' => 'Paid',
			];

		$month = [
			'1' => 'January',
			'2' => 'February',
			'3' => 'March',
			'4' => 'April',
			'5' => 'May',
			'6' => 'June',
			'7' => 'July',
			'8' => 'August',
			'9' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December'	

		];
		$data = History::all();
		return View::make('history.index')
					->with('title','Employee Payment History & Status')
					->with('histories',$data)
					->with('status', $status)
					->with('month', $month);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /history/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$status = [

			'0' => 'Not Paid',
			'1' => 'Paid',
			];
		$users = User::lists('employeeID','id');
		$month = [
			'1' => 'January',
			'2' => 'February',
			'3' => 'March',
			'4' => 'April',
			'5' => 'May',
			'6' => 'June',
			'7' => 'July',
			'8' => 'August',
			'9' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December'	
		];

		return View::make('history.create')
					->with('userID',$users)
					->with('title','Employee Payment')
					->with('status', $status)
					->with('month',$month);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /history
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = [

			'user_id' => 'required',
			'year'    => 'required',
			'month'   => 'required',
			'status'  => 'required'
		];

		$data = Input::all();
		$validator = Validator::make($data,$rules);

		if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$history = new History();
		$history->user_id = $data['user_id'];
		$history->year = $data['year'];
		$history->month = $data['month'];
		$history->status =$data['status'];
		$history->salary = Helper::calculation($data['user_id']);

		if($history->save()){

			return Redirect::route('history.index')->with('success',"Record Added Successfully");
		} else {
			return Redirect::route('history.create')->with('error',"Something went wrong.Try again");

		}
	}

	/**
	 * Display the specified resource.
	 * GET /history/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /history/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /history/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /history/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}