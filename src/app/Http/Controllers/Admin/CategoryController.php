<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all()->where('parent_id','=',0);
        return view('admin.category.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pcategories = Category::all()->whereIn('parent_id',0);
        //dd($pcategories);
        return view('admin.category.createcategory',compact('pcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name'=>'required|unique:categories',
            'desc'=>'required',
        ]);
        $cat = new Category;
        $cat->name=request('name');
        $cat->description=request('desc');
        $cat->parent_id=request('parent_id');
        $cat->save();
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::find($id);
        return view('admin.category.showcategories',compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        $pcategories = Category::all()->whereIn('parent_id',0);
        return view('admin.category.editcategory',compact('cat','pcategories'));
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
        $cat = Category::find($id);
        if(($cat->name)==(request('name')))
        {
            $this->validate(request(),[
                'name'=>'required',
                'description'=>'required',
            ]);
        }
        else{
             $this->validate(request(),[
                'name'=>'required|unique:categories',
                'description'=>'required',
            ]);
        }

        
        
            DB::table('categories')->where([['id',$id]])->update(['name'=>request('name'),'description'=>request('description'),'updated_at'=>Carbon::now()]);
        alert()->success('Updated Successfully');
        return redirect('admin/category/'.$id)->with('success','Category updated succesfully');
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
    public function dummy()
    {
        $v=phpinfo();
        dd($v);
    }
}
