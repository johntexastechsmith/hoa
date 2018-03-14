<?php

namespace App\Http\Controllers;

use App\Hoa;
use App\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardMemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boardMember = Auth::user()->boardMember;
        $hoa = $boardMember->hoa;

        $owners = DB::table('owners')->where('hoa_id', $hoa->id)->get();

        return view('boardmember.index', ['hoa' => $hoa, 'owners' => $owners]);    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoardMember  $boardMember
     * @return \Illuminate\Http\Response
     */
    public function show(BoardMember $boardMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoardMember  $boardMember
     * @return \Illuminate\Http\Response
     */
    public function edit(BoardMember $boardMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoardMember  $boardMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoardMember $boardMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoardMember  $boardMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoardMember $boardMember)
    {
        //
    }
}
