<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Auth;

class NewsController extends Controller
{
	public function getList(Request $request)
	{
		$newsData = News::paginate(15);
		return response()->json([
			'status'	=> TRUE,
			'news'		=> $newsData
		], 200);
	}

	public function getDetail(Request $request, $id)
	{
		$data = "Welcome " . Auth::user()->name;
		return response()->json($data, 200);
	}
}
