<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BannerRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{

    protected $repository;

    function __construct(BannerRepository $bannerRepository){
        $this->repository = $bannerRepository;
    }

    protected $rule = [
        'name' =>'required|min:3|max:255',
        'link'=>'required||min:3|max:255',
        'image'=>'required|max:1',
    ];

    protected $typeRule = [
        'name.required' => 'Names in the range of 3 to 255 characters',
        'name.min' => 'Names in the range of 3 to 255 characters',
        'name.max' => 'Names in the range of 3 to 255 characters',
        'link.required' => 'Link in the range of 3 to 100 characters',
        'link.min' => 'Link in the range of 3 to 100 characters',
        'link.max' => 'Link in the range of 3 to 100 characters',
        'image.required' =>'Please add 1 photo',
        'image.max' =>'Only 1 photo',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        if(!$user->hasPermissionTo('banner_list')) {
            return redirect()->route('admin.dashboard');
        }
        $results = $this->repository->orderBy('id','desc');
        return view('backend.pages.banners.index',compact('results'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::guard('admin')->user();
        if(!$user->hasPermissionTo('banner_create')) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.pages.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rule,$this->typeRule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('image')[0];
            $fileName = time().$file->getClientOriginalName();
            $file->move('upload\banners', $fileName);
            $this->repository->store([
                'name'=>$request->name,
                'link'=>$request->link,
                'image'=>$fileName,
            ]);
            return redirect()->route('banners.index')->with('notice','Add banner successfull !');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Register error.' . $th->getMessage());
        }
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
        $result = $this->repository->find($id);
        return view('backend.pages.banners.edit',compact('result'));
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
        // dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'name' =>'required|min:3|max:255',
            'link'=>'required||min:3|max:255',
            'image'=>'max:1',
        ],
        $this->typeRule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $banner = $this->repository->find($id); 
        $fileName = $banner->image;
        if($request->file('image')){
            $file = $request->file('image')[0];
            $fileName = time().$file->getClientOriginalName();
            $file->move('upload\banners', $fileName);
            if (file_exists(public_path('upload/banners/' . $banner->image))) {
                File::delete(public_path('upload/banners/' . $banner->image));
            }
        }
        try {
            $this->repository->update([
                'name'=>$request->name,
                'link'=>$request->link,
                'image'=>$fileName,
            ],$id);
            return redirect()->route('banners.index')->with('notice','Edit banner successfull !');
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Register error.' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $banner = $this->repository->find($id);
            $image =$banner->image;
            $linkimage = 'upload/banners/'.$image;
            if(is_file($linkimage))
            {
                unlink($linkimage);
                //xử lý khi hình không tồn tại
            }
            $this->repository->delete($id);
            return redirect()->back()->with('notice','Delete success.');
        }catch(Exception $e){
            return redirect()->back()->with('error','Delete fail.'.$e->getMessage());
        }
    }
}
