<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;

use Flash;
use Modules\Article\Http\Requests\Backend\CarouselsRequest;

class CarouselController extends Controller
{

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Carousel';

        // module name
        $this->module_name = 'carousels';

        // directory path of the module
        $this->module_path = 'carousels';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "App\Models\Carousel";
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        // $$module_name = $module_model::paginate();
        $$module_name = Carousel::orderBy('position', 'asc')->get();

        // $$module_name = Carousel::all();

        // $users = DB::table('carousels')->orderBy('position', 'asc')->get();
        // return $$module_name;
        // dd($$module_name);

        // @if ($key%4 == 0)
        // <p>New Line</p>
        // @endif

        // @if ($key%5 == 0)
        //                     <br>
        //                     <p style="margin-top: 0px;">New Line {{$page_i+=1}}</p>
        //                     <hr style="border-top: 4px solid rgba(0, 0, 0, 0.50);">
        //                     @endif

        //
        // echo "Index Working";
        // return view("backend.carousels.index");
        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    public function tableview()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::paginate();

        return view(
            "backend.$module_path.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }



    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::select('id', 'image_url', 'position', 'web_url', 'title', 'created_at');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('created_at', function ($data) {
                $new_time = $data->created_at->format('Y F d, h:i:s A');
                return $new_time;
            })
            // ->editColumn('web_url', function ($data) {
            //     return '<a>' . $data->web_url . '</a>';
            // })
            // ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['position'], '-:column $1')
            ->make(true);
    }


    public function orderUpdate(Request $request)
    {
        $idArray = explode(",", $request->ids);
        // $idArray = $request->ids;
        // return $idArray;

        $count = 1;
        foreach ($idArray as $id) {
            // $updateOrder = Carousel::find($id)->update([
            //     'position' => $count
            // ]);

            $module_name_singular = Carousel::findOrFail($id);

            $module_name_singular->update([
                'position' => $count
            ]);

            $count++;
        }
        return 'Done';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // echo "Create";
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        // $categories = Category::pluck('name', 'id');
        $categories = "cata123";

        // Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.create",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', 'categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $data = $request;
        // $data = $request->except('image_url');

        // $photoName = time() . '.' . $request->image_url->getClientOriginalExtension();
        // $request->image_url->move(public_path('storage/carousel'), $photoName);

        // $file_path = 'storage/carousel/' . $photoName;

        $max_position = $module_model::max('position');

        $imageData = array(
            'title' => $data['title'],
            // 'web_url' => $data['web_url'],
            'position' => $max_position + 1
        );

        if ($data['web_url']==null){
            $imageData['web_url'] = '#';
        }else{
            $imageData['web_url'] = $data['web_url'];
        }

        // dd($imageData);
        

        if ($request->hasFile('image_url')) {
            $photoName = time() . '.' . $request->image_url->getClientOriginalExtension();
            $request->image_url->move(public_path('storage/carousel'), $photoName);

            $file_path = 'storage/carousel/' . $photoName;
            $imageData['image_url'] = $file_path;
        }


        $module_model::create($imageData);

        // echo $data;
        // $$module_name_singular = $module_model::create($data);
        // $$module_name_singular->tags()->attach($request->input('tags_list'));

        // event(new PostCreated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> New '" . Str::singular($module_title) . "' Added")->important();

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return redirect("admin/$module_name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        // echo $$module_name_singular;

        $activities = '';
        // $activities = Activity::where('subject_type', '=', $module_model)
        //                         ->where('log_name', '=', $module_name)
        //                         ->where('subject_id', '=', $id)
        //                         ->latest()
        //                         ->paginate();

        // Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular", 'activities')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::findOrFail($id);

        // $categories = Category::pluck('name', 'id');
        $categories = '';

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.edit",
            compact('categories', 'module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselsRequest $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $data = $request;

        $$module_name_singular = $module_model::findOrFail($id);

        $imageData = array(
            'title' => $data['title'],
            // 'web_url' => $data['web_url'],
        );

        if ($data['web_url']==null){
            $imageData['web_url'] = '#';
        }else{
            $imageData['web_url'] = $data['web_url'];
        }

        if ($request->hasFile('image_url')) {
            $photoName = time() . '.' . $request->image_url->getClientOriginalExtension();
            $request->image_url->move(public_path('storage/carousel'), $photoName);

            $file_path = 'storage/carousel/' . $photoName;
            $imageData['image_url'] = $file_path;
        }

        $$module_name_singular->update($imageData);

        // if ($request->input('tags_list') == null) {
        //     $tags_list = [];
        // } else {
        //     $tags_list = $request->input('tags_list');
        // }
        // $$module_name_singular->tags()->sync($tags_list);

        // event(new PostUpdated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Updated Successfully")->important();

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return redirect("admin/$module_name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $module_model::find($id)->delete();


        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Deleted Successfully")->important();

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return redirect("admin/$module_name");
    }
}
