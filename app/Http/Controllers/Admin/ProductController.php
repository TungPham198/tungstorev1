<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $repository;

    function __construct(ProductRepository $producPepository){
        $this->repository = $producPepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->repository->all();
        return view('backend.pages.products.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'sku' =>'required|min:3|max:100',
            'name' =>'required|min:3|max:255',
            'import_price'=>'required|gt:0',
            'price'=>'required|gt:0',
            'amount'=>'required|gt:0',
            'category_id'=>'required|',
            'summary'=>'required|',
            'des'=>'required|',
            'status'=>'required|digits_between: 1,2'
        ],[
            'name.required' => 'Names in the range of 3 to 255 characters',
            'sku.required' => 'Sku in the range of 3 to 100 characters',
            'import_price.required' =>'Min value is 0',
            'price.required' =>'Min value is 0',
            'amount.required' =>'Min value is 0',
            'summary.required' => 'must not be left blank',
            'des.required' => 'must not be left blank',
            'status.required'=>'must not be left blank',
            'name.min' =>'Names in the range of 3 to 255 characters',
            'sku.min' =>'Sku in the range of 3 to 10 characters',
            'import_price.gt' =>'Min value is 0',
            'amount.gt' =>'Min value is 0',
            'status.max'=>'Must not be left blank',
            'name.max' =>'Names in the range of 3 to 255 characters',
            'sku.max' =>'Sku in the range of 3 to 10 characters',
            'status.max'=>'Must not be left blank'
        ]);
        // dd($validator);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd(Str::slug($request->name));
        try{
            if($request->hasFile('images')) {
                $allowedfileExtension=['jpg','png'];
                $files = $request->file('images');
                // flag xem có thực hiện lưu DB không. Mặc định là có
                $exe_flg = true;
                // kiểm tra tất cả các files xem có đuôi mở rộng đúng không
                foreach($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);
    
                    if(!$check) {
                        // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                        $exe_flg = false;
                        break;
                    }
                } 
                // nếu không có file nào vi phạm validate thì tiến hành lưu DB
                if($exe_flg) {
                    // lưu product
                    // $products= Product::create($request->all());
                    // duyệt từng ảnh và thực hiện lưu
                    $images = "";
                    foreach ($request->images as $photo) {
                        $fileName = time().$photo->getClientOriginalName();
                        $endName = $photo->getClientOriginalExtension();
                        $fullNameFile = $fileName;
                        $images.=$fullNameFile."//";
                        $photo->move('upload', $fileName);
                    }
                } else {
                    return redirect()->back()->with('error', 'Load file error');
                }
            }
            $this->repository->store([
                'sku'=>$request->sku,
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'import_price'=>$request->import_price,
                'price'=>$request->price,
                'amount'=>$request->amount,
                'category_id'=>$request->category_id,
                'summary'=>$request->summary,
                'des'=>$request->des,
                'status'=>$request->status,
                'images'=>$images
            ]);
            return redirect()->route('products.index')->with('notice','Add product successfull !');
        }
        catch(Exception $th){
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}