<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Program;
use DB;

class ModulesController extends Controller
{
  public function deleteMod()
  {
    $id=$_POST['ModID'];
    Module::where('ModuleID',$id) -> update(['Active'=>'No']);
    return 'done';
  }

  public function showEdit($p, $m)
  {
    $module=Module::find($m);
    $program=Program::find($p);
    return view ('editModule', compact('program','module'));
  }

  public function edit(Request $request, $p, $m)
  {
    $module=Module::find($m);
    $module->update($request->all());
    return redirect("/program/$p");
  }

  public function NewModule(Request $request, $p)
  {
    $module=new Module;
    $module->ModuleName = $request->ModuleName;
    $program=Program::find($p);
    $program->modules()->save($module);
    return redirect("/program/$p");
  }
}
