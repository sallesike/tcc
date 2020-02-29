<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Http\Requests\InstructorRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Gate;

class InstructorController extends Controller
{
    public $instructor;

    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }
    public function create()
    {
        if(Gate::allows('eAdmin'))
        {
        return view('instrutor');
        }
        if(Gate::denies('eAdmin'))
        {
        return view('erro-403');
        }
    }

    public function store(InstructorRequest $request)
    {
        $nameFile = null;

        if ($request->hasFile('signature') && $request->file('signature')->isValid()) 
        {    		
            $extension = $request->signature->extension();
            if(($extension != 'png') and ($extension != 'jpg') and ($extension != 'jpeg'))
            {
                return redirect()->back()->with('error', 'formato invalido, os formatos aceitos são png e jpg');
            }
            $signature = uniqid(date('HisYmd')).".".$extension;
            $img = Image::make($request['signature']);
            $img->resize(50, 80);
            $upload = $img->save(public_path('signature/'. $signature));
            if($upload)
            {
                $instructor = $this->instructor->create(['name' => $request['name'], 'signature' => $signature]);
                return redirect()->back()->with('success', 'Instrutor cadastrado com sucesso');
            }
            if ( !$upload )
            {
                return redirect()
                ->back()
                ->with('error', 'Falha ao fazer upload')
                ->withInput();
            }
        }
    }

    public function index()
    {
        if(Gate::allows('eAdmin'))
        {
            $arrayInstructor = $this->instructor->all();
            return view('lista_instrutor', compact('arrayInstructor'));
        }
        if(Gate::denies('eAdmin'))
        {
            return view('erro-403');
        }
    }

    public function edit($id)
    {
        if(Gate::allows('eAdmin'))
        {
            $instructor = $this->instructor->find($id);
            return view('instrutor', compact('instructor'));
        }
        if(Gate::denies('eAdmin'))
        {
            return view('erro-403');
        }
    }

    public function update(Request $request, $id)
    {
        $data 		= $request->all();
        $instructor = $this->instructor->findOrfail($id);

        if(isset($instructor->signature))
        {
            if ($request->hasFile('signature') && $request->file('signature')->isValid())
            {
              $signature 	= $instructor['signature'];
              $img 		= Image::make($request['signature']);
              $img->resize(200, 60);
              $img->save('signature/'. $signature);
              $instructor->update(['name' => $request['name'], 'signature' => $signature]);
              return redirect()->route('event.index')->with('success', 'Assinatura alterada com sucesso!');
          }
          $instructor->update($data);
          return redirect()->route('event.index')->with('success', 'Nome alterado com sucesso!');
      }
    }
}
