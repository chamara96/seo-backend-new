<?php

namespace Modules\Article\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Modules\Article\Entities\Category;
use Modules\Article\Events\PostCreated;
use Modules\Article\Events\PostUpdated;
use Modules\Article\Http\Requests\Backend\PostsRequest;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Posts';

        // module name
        $this->module_name = 'posts';

        // directory path of the module
        $this->module_path = 'posts';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "Modules\Article\Entities\Post";
    }

    // function encode_id_2($id)
    // {
    //     $hashids = new Hashids\Hashids(config('app.salt'), 0, 'abcdefghijklmnopqrstuvwxyz1234567890');
    //     $hashid = $hashids->encode($id);

    //     return $hashid;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return Response
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

        $$module_name = $module_model::paginate();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_path.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    public function index_user()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        // $view_mode=1; #user
        session()->put('view_mode', '1');
        session()->put('current_list', 'all');

        $$module_name = $module_model::paginate();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_path.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    public function index_merchant()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        // $view_mode=0; #merchant
        session()->put('view_mode', '0');
        session()->put('current_list', 'all');

        $$module_name = $module_model::paginate();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_path.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }



    public function index_data($view_mode)
    {
        // dd($view_mode);
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $current_list = session()->get('current_list');
        $authId = auth()->user()->id;

        if ($current_list == 'published') {
            $$module_name = $module_model::where([
                ['view_type',$view_mode],
                ['status', 1],
                ['created_by', $authId]
            ])->select('id', 'name', 'category_name', 'hits', 'status','created_by_name','created_at', 'updated_at', 'published_at', 'is_featured');
        } elseif ($current_list == 'unpublished') {
            $$module_name = $module_model::where([
                ['view_type',$view_mode],
                ['status', 0],
                ['created_by', $authId]
            ])->select('id', 'name', 'category_name', 'hits', 'status','created_by_name','created_at', 'updated_at', 'published_at', 'is_featured');
        } elseif ($current_list == 'draft') {
            $$module_name = $module_model::where([
                ['view_type',$view_mode],
                ['status', 2],
                ['created_by', $authId]
            ])->select('id', 'name', 'category_name', 'hits', 'status','created_by_name','created_at', 'updated_at', 'published_at', 'is_featured');
        } else {
            $$module_name = $module_model::where([
                ['view_type',$view_mode],
                ['created_by', $authId]
            ])->select('id', 'name', 'category_name', 'hits', 'status','created_by_name','created_at', 'updated_at', 'published_at', 'is_featured');
        }

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', function ($data) {
                $is_featured = ($data->is_featured) ? '<span class="badge badge-primary">Featured</span>' : '';

                return $data->name . ' ' . $data->status_formatted . ' ' . $is_featured;
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->toCookieString();
                }
            })
            ->editColumn('created_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->created_at);

                if ($diff < 25) {
                    return $data->created_at->diffForHumans();
                } else {
                    return $data->created_at->toCookieString();
                }
            })
            ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Select Options for Select 2 Request/ Response.
     *
     * @return Response
     */
    public function index_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = $module_model::where('name', 'LIKE', "%$term%")->published()->limit(10)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id'   => $row->id,
                'text' => $row->name,
            ];
        }

        return response()->json($$module_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $categories = Category::pluck('name', 'id');

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_name.create",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', 'categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PostsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $data = $request->except('tags_list', 'featured_image');
        $data['created_by_name'] = auth()->user()->name;

        if ($request->status != 0) {
            $data['published_at'] = Carbon::now()->toDateTimeString();
        }


        // dd(encode_id('150'));

        if ($request->hasFile('featured_image')) {
            $photoName = time() . '.' . $request->featured_image->getClientOriginalExtension();
            $request->featured_image->move(public_path('storage/featured_image/blog'), $photoName);

            $file_path = 'storage/featured_image/blog/' . $photoName;
            $data['featured_image'] = $file_path;
        }

        // $e_id=encode_id($$request->id);

        // dd($data);

        $$module_name_singular = $module_model::create($data);
        $$module_name_singular->tags()->attach($request->input('tags_list'));

        event(new PostCreated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> New '" . Str::singular($module_title) . "' Added")->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . '(ID:' . $$module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("admin/$module_name");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
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

        $activities = Activity::where('subject_type', '=', $module_model)
            ->where('log_name', '=', $module_name)
            ->where('subject_id', '=', $id)
            ->latest()
            ->paginate();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular", 'activities')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
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

        $categories = Category::pluck('name', 'id');

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . '(ID:' . $$module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "article::backend.$module_name.edit",
            compact('categories', 'module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PostsRequest $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::findOrFail($id);

        // dd($request);
        $data = $request->except('tags_list');
        // dd($data);

        if ($request->status == 1) {
            $data['published_at'] = Carbon::now()->toDateTimeString();
        }

        if ($request->hasFile('featured_image')) {
            $photoName = time() . '.' . $request->featured_image->getClientOriginalExtension();
            $request->featured_image->move(public_path('storage/featured_image/blog'), $photoName);

            $file_path = 'storage/featured_image/blog/' . $photoName;
            $data['featured_image'] = $file_path;
        }

        $$module_name_singular->update($data);

        if ($request->input('tags_list') == null) {
            $tags_list = [];
        } else {
            $tags_list = $request->input('tags_list');
        }
        $$module_name_singular->tags()->sync($tags_list);

        event(new PostUpdated($$module_name_singular));

        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Updated Successfully")->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . '(ID:' . $$module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("admin/$module_name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->delete();

        Flash::success('<i class="fas fa-check"></i> ' . label_case($module_name_singular) . ' Deleted Successfully!')->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . ', ID:' . $$module_name_singular->id . " ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("admin/$module_name");
    }

    /**
     * List of trashed ertries
     * works if the softdelete is enabled.
     *
     * @return Response
     */
    public function trashed()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Trash List';

        $$module_name = $module_model::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name);

        return view(
            "article::backend.$module_name.trash",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Restore a soft deleted entry.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function restore($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Restore';

        $$module_name_singular = $module_model::withTrashed()->find($id);
        $$module_name_singular->restore();

        Flash::success('<i class="fas fa-check"></i> ' . label_case($module_name_singular) . ' Data Restoreded Successfully!')->important();

        Log::info(label_case($module_action) . " '$module_name': '" . $$module_name_singular->name . ', ID:' . $$module_name_singular->id . " ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("admin/$module_name");
    }

    public function list_published()
    {
        $module_name = $this->module_name;
        session()->put('current_list', 'published');
        return redirect("admin/$module_name");
    }

    public function list_unpublished()
    {
        $module_name = $this->module_name;
        session()->put('current_list', 'unpublished');
        return redirect("admin/$module_name");
    }

    public function list_draft()
    {
        $module_name = $this->module_name;
        session()->put('current_list', 'draft');
        return redirect("admin/$module_name");
    }

    public function list_all()
    {
        $module_name = $this->module_name;
        session()->put('current_list', 'all');
        return redirect("admin/$module_name");
    }
}
