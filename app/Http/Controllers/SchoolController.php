<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;
use App\School;


class SchoolController extends Controller
{
    public $school;

    public function __construct(School $school)
	{
		$this->school = $school;
        
	}

    public function create()
    {
    	return view('escola');
    }

    public function store(SchoolRequest $request)
    {
    	$data = $request->all();
    	$inserir = $this->school->create($data);

    	if($inserir)
    	{
    		return redirect()->route('school.index')->with('success', 'Escola salva com sucesso!');
    	}
    }

    public function index()
    {
    	$arraySchool = $this->school->all();
    	return view('consulta_escola', compact('arraySchool'));
    }

    public function edit($id)
    {
    	$school = $this->school->findOrFail($id);
    	return view('escola', compact('school'));
    }

    public function update(SchoolRequest $request, $id)
    {
    	$data = $request->all();
    	$school = $this->school->findOrFail($id);
    	$update = $school->update($data);
    	if($update)
    	{
    		return redirect()->route('school.index')->with('success', 'Escola salva com sucesso!');
    	}else
        {
            return "Houve um erro ao salvar.";
        }
    }

    public function delete()
    {

    }
}
