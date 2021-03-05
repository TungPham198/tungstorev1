<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{   
    protected $repository;
    function __construct(CategoryRepository $categoryRepository){
        $this->repository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->all();
        return view('backend.pages.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('backend.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:255',
            'index' => 'required|digits_between: 1,100',
        ],[
            'name.min' =>'Names in the range of 3 to 255 characters',
            'index.min' => 'Number only from 0 to 100',
            'name.max' =>'Names in the range of 3 to 255 characters',
            'index.max' => 'Number only from 0 to 100',
            'name.required' =>'Names in the range of 3 to 255 characters',
            'index.required' => 'Number only from 0 to 100',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category =$this->repository->store([
            'name' => $request->name,
            'index' => $request->index
        ]);
        return redirect()->route('categories.index')->with('notice','Add category successfull !');
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
        if(!is_numeric($id)|| !$result = $this->repository->find($id)){
            abort(404);
        }
        else{
            return view('backend.pages.categories.edit',compact('result'));
        }
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

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:255',
            'index' => 'required|digits_between: 1,100',
        ],[
            'name.min' =>'Names in the range of 3 to 255 characters',
            'index.min' => 'Number only from 0 to 100',
            'name.max' =>'Names in the range of 3 to 255 characters',
            'index.max' => 'Number only from 0 to 100',
            'name.required' =>'Names in the range of 3 to 255 characters',
            'index.required' => 'Number only from 0 to 100',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = $this->repository->find($id);
        $category->fill([
            'name'=>$request['name'],
            'index' =>$request['index']
        ])->save();
        return redirect()->route('categories.index')->with('notice','Update success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!is_numeric($id)|| !$result = $this->repository->find($id)){
            abort(404);
        }
        else{
           $result->delete();
            return redirect()->back()->with('notice','Delete success.');
        }
    }
}
