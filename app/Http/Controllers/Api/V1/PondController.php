<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pond;
use Illuminate\Validation\Rule;
use Encore\Admin\Layout\Content;


class PondController extends Controller
{
    public function Index()
    {
        // $jml_ikan
        $jml_ikan = DB::table('detail_koi')
            ->selectRaw('count(*) as jml_ikan, fish_id')
            ->groupBy('fish_id')
            ->get();
        $ponds = Pond::latest()->get();
        return view("admin.allponds", compact('ponds', 'jml_ikan'));
    }

    public function ManagePonds()
    {
        // $jml_ikan
        $jml_ikan = DB::table('detail_koi')
            ->selectRaw('count(*) as jml_ikan, fish_id')
            ->groupBy('fish_id')
            ->get();
        $ponds = Pond::latest()->get();
        return view("admin.manageponds", compact('ponds', 'jml_ikan'));
    }

    public function SearchPond(Request $request)
    {
        $search = $request->search;

        $ponds = Pond::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
        })->get();

        return view('admin.allponds', compact('ponds', 'search'));
    }

    public function AddPond()
    {
        return view("admin.addponds");
    }

    public function StorePond(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:ponds',
            'volume' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->img->move(public_path('uploads/images'), $img_name);
        $img_url = 'images/' . $img_name;

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Pond::insert([
            'name' => $request->name,
            'volume' => $request->volume,
            'created_at' => $mytime,
            'updated_at' => $mytime,
            'img' => $img_url,
        ]);

        return redirect()->route('allponds')->with('message', 'Kolam telah berhasil ditambah!');
    }

    public function EditPond($id)
    {

        $pondinfo = Pond::findOrFail($id);
        // $category_parent = $pondinfo->type_id;
        // $parent_title = FoodType::where('id',$category_parent)->first();
        // $typeid = FoodType::latest()->get();

        return view('admin.editpond', compact('pondinfo'));
    }

    public function EditPondImg($id)
    {
        $pondinfo = Pond::findOrFail($id);
        return view('admin.editpondimg', compact('pondinfo'));
    }

    public function UpdatePondImg(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->img->move(public_path('uploads/images'), $img_name);
        $img_url = 'images/' . $img_name;

        Pond::findOrFail($id)->update([
            'img' => $img_url,
        ]);

        return redirect()->route('allponds')->with('message', 'Update Foto Kolam Berhasil!');
    }

    public function UpdatePond(Request $request)
    {
        $pondid = $request->id;

        $request->validate([
            'name' => ['required', Rule::unique('ponds')->ignore($request->id),],
            'volume' => 'required'
        ]);

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Pond::findOrFail($pondid)->update([
            'name' => $request->name,
            'updated_at' => $mytime,
            'volume' => $request->volume,
        ]);

        return redirect()->route('allponds')->with('message', 'Update Informasi Kolam Berhasil!');
    }

    public function DeletePond($id)
    {
        Pond::findOrFail($id)->delete();

        return redirect()->route('allponds')->with('message', 'Penghapusan Kolam Berhasil!');
    }

    public function get_pond_list()
    {
        $pond = Pond::get(); // Retrieve all records from the 'pond' table

        return response()->json($pond, 200);
    }


    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ponds';

    // /**
    //  * Make a grid builder.
    //  *
    //  * @return Grid
    //  */
    // protected function grid()
    // {
    //     $grid = new Grid(new Food());
    //     $grid->model()->latest();
    //     $grid->column('id', __('Id'));
    //     $grid->column('name', __('Name'));
    //      $grid->column('FoodType.title', __('Category'));
    //     $grid->column('price', __('Price'));
    //     //$grid->column('location', __('Location'));
    //     $grid->column('stars', __('Stars'));
    //     $grid->column('img', __('Thumbnail Photo'))->image('',60,60);
    //     $grid->column('description', __('Description'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
    //         return substr($val,0,30);
    //     });
    //     //$grid->column('total_people', __('People'));
    //    // $grid->column('selected_people', __('Selected'));
    //     $grid->column('created_at', __('Created_at'));
    //     $grid->column('updated_at', __('Updated_at'));

    //     return $grid;
    // }

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Food::findOrFail($id));



    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Food());
    //     $form->text('name', __('Name'));
    //       $form->select('type_id', __('Type_id'))->options((new FoodType())::selectOptions());
    //     $form->number('price', __('Price'));
    //     $form->text('location', __('Location'));
    //     $form->number('stars', __('Stars'));
    //     $form->number('people', __('People'));
    //     $form->number('selected_people', __('Selected'));
    //     $form->image('img', __('Thumbnail'))->uniqueName();
    //     $form->UEditor('description','Description');



    //     return $form;
    // }
}
