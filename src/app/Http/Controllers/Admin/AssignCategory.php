<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Category;

class AssignCategory extends Controller
{
	public function index()
	{

	}

    public function create($oid)
    {
    	$cat = Category::all()->where('parent_id','=',0);
    	$owner = Admin::find($oid);
    	return view('admin.owner.assigncategory',compact('cat','owner'));
    }

    public function store(Request $request)
    {
    	$this->validate(request(),[
    		'admin_id'=>'required',
    		'categories'=>'required',
    	]);

    	$categories = request('categories');
    	//dd($categories);
    	$admin = Admin::find(request('admin_id'));
    	foreach ($categories as $cat) {
    		$category = Category::find($cat);
    		if($admin->categories->contains($category))
    		{
    			//dd($admin->categories);
    			return redirect('admin/owners/'.$admin->id)->with('wmessage','Category already assigned to the user');
    		}
    		else
    		{
    			$admin->categories()->save($category);
    			// return redirect('/admin/owners/'.$admin->id)->with('smessage','Category assigned successfully');
    		}
            return redirect('/admin/owners/'.$admin->id);
    	}	
    }

    /**To add or delete  category from the owner*** 
	oid :- Owner ID
    */
    public function edit($oid)
    {
    	$admin = Admin::find($oid);
        //dd($admin->categories);
    	$cat = Category::all()->where('parent_id',0);

    	return view('admin.owner.editassigncategory',compact('admin','cat'));
    }

    public function update(Request $request)
    {
        // $this->validate(request(),[
        //     'admin_id'=>'required',
        //     'categories'=>'required',
        // ]);
        // $admin = Admin::find(request('admin'));
        // dd($admin->categories);
        // foreach ($admin->categories as $cat) 
        // {
        //     $category = Category::find($cat->id);
        //     $admin->categories()->detach($category);
        // }

        // $categories = request('categories');

        // foreach ($categories as $cat) {
        //     $category = Category::find($cat);
            
        //     $admin->categories()->save($category);
        //     return redirect('/admin/owners/'.$admin->id)->with('smessage','Category assigned successfully');
        // }

    }

    public function destroy($oid,$catid)
    {
        $admin = Admin::find($oid);
        $category= Category::find($catid);
        if($admin->categories->contains($category))
        {
            $admin->categories()->detach($category);   
        }
        return redirect('/admin/owners/assigncategory/edit/'.$oid);
    }

    public function add($oid,$catid)
    {
        $admin = Admin::find($oid);

        $category=Category::find($catid);

        if($category->parent_id==0)
        {
            foreach ($category->childCategories as $child) {
                if($admin->categories->contains($child))
                {
                    return redirect('/admin/owners/assigncategory/edit/'.$oid)->with('wmessage','Alert! '.$child->name.' is already assigned to '.$admin->first_name);
                }
                else
                {
                    $admin->categories()->attach($child);
                }
            
            }
        }
        else
        {
            if($admin->categories->contains($category))
            {
                 return redirect('/admin/owners/assigncategory/edit/'.$oid)->with('wmessage','Alert! '.$category->name.' is already assigned to '.$admin->first_name);
            }
            else
            {
                $admin->categories()->attach($category);
                return redirect('/admin/owners/assigncategory/edit/'.$oid)->with('smessage','Category assigned to '.$admin->first_name);
            }
        }

        return redirect('/admin/owners/assigncategory/edit/'.$oid);
    }
}
