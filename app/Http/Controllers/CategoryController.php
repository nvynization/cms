<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $categories=Category::all();
        // foreach($categories as $category){
        //     dd($category->parent);
        // }
        $categories=Category::latest()->paginate(5);
        return view('admin.categories.categories',['categories'=>$categories])->with('i',($request->input('page')-1)*5);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parent=Category::where('parent_id',"=",null)->get();
        return view('admin.categories.create',['parents'=>$parent]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                "name"=>"required"
            ],
            [
                "name.required"=>"enter category name"
            ]
        );
        Category::create($request->except('_token'));
        return redirect()->route('categories.index')->with('success','Category is successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        //dd($category);
        $parent=Category::where('parent_id',"=",null)->get();
        return view('admin.categories.edit',['category'=>$category],['parents'=>$parent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                "name"=>"required"
            ],
            [
                "name.required"=>"enter category name"
            ]
        );
        $category=Category::find($id);
        $category->name=$request->input('name');
        $category->parent_id=$request->input('parent_id');
        $category->save();
        
        return redirect()->route('categories.index')->with('success','Category is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category=Category::find($id);
        try{
            $category->delete();
        }catch(QueryException $e){
            return redirect()->route('categories.index')->with(["success"=>"category cant be deleted"]);
        }       
        //return redirect()->route('categories.index')->with(["success"=>"category is successfully deleted"]);
        return response()->json(["success"=>"successfully deleted"]);
    }

    public function restore(){
        $categories=Category::all();
        //$trashed=Category::withTrashed()->get();
        $trashed=Category::onlyTrashed()->get();
        foreach($trashed as $item){
            $item->restore();
        }
        dd($trashed);
    }
}
