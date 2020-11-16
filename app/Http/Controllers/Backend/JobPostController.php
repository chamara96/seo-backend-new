<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobpost;
use App\Models\Jobresponse;
use Illuminate\Support\Str;

use Yajra\DataTables\DataTables;
use Modules\Article\Http\Requests\Backend\JobsRequest;
use Flash;
use Auth;
use Spatie\Activitylog\Models\Activity;
use Log;
use Carbon\Carbon;

class JobPostController extends Controller
{

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Jobs';

        // module name
        $this->module_name = 'jobposts';

        // directory path of the module
        $this->module_path = 'jobposts';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "App\Models\Jobpost";
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

        $$module_name = $module_model::where('created_by', auth()->user()->id)->select('id', 'jobtitle', 'jobdescription', 'intro', 'updated_by', 'type', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })

            ->addColumn('candidate', function ($data) {
                $module_name = $this->module_name;
                $job_res_model = 'App\Models\Jobresponse';

                return view('backend.includes.action_candi_column', compact('module_name', 'data', 'job_res_model'));
            })
            ->editColumn('status', function ($data) {
                $is_featured = ($data->status) ? '<span class="badge badge-primary">Published</span>' : '<span class="badge badge-danger">Unpublished</span>';

                return $is_featured;
            })
            // ->editColumn('updated_at', function ($data) {
            //     $module_name = $this->module_name;

            //     $diff = Carbon::now()->diffInHours($data->updated_at);

            //     if ($diff < 25) {
            //         return $data->updated_at->diffForHumans();
            //     } else {
            //         return $data->updated_at->toCookieString();
            //     }
            // })
            ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }


    public function index_list(Request $request)
    {
        echo "Index List";
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
    public function store(JobsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $data = $request->except('tags_list');
        $data = $request;
        // $data['created_by'] = auth()->user()->id;


        $userData = array(
            'jobtitle' => $data['jobtitle'],
            'city' => $data['city'],
            'intro' => $data['intro'],
            'content' => $data['content'],
            'type' => $data['type'],
            'status' => $data['status'],

            'question_1' => $data['question_1'],
            'answers_1' => $data['answers_1'],
            'question_2' => $data['question_2'],
            'answers_2' => $data['answers_2'],
            'question_3' => $data['question_3'],
            'answers_3' => $data['answers_3'],
            'question_4' => $data['question_4'],
            'answers_4' => $data['answers_4'],
            'question_5' => $data['question_5'],
            'answers_5' => $data['answers_5'],
            'question_6' => $data['question_6'],
            'answers_6' => $data['answers_6'],

            'meta_title' => $data['meta_title'],
            'meta_keywords' => $data['meta_keywords'],
            'meta_description' => $data['meta_description'],

            'created_by_name' => auth()->user()->name,
            'created_by' => auth()->user()->id
        );

        // dd($userData);

        $module_model::create($userData);
        // dd($test123);

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
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobsRequest $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        // $photoName = time() . '.' . $request->featured_image->getClientOriginalExtension();
        // $request->featured_image->move(public_path('storage/featured_image/job'), $photoName);

        // $file_path = 'storage/featured_image/job/' . $photoName;

        $$module_name_singular = $module_model::findOrFail($id);

        // dd($request);

        $userData = array(
            'jobtitle' => $request['jobtitle'],
            'city' => $request['city'],
            'intro' => $request['intro'],
            'content' => $request['content'],
            'type' => $request['type'],
            'status' => $request['status'],

            'question_1' => $request['question_1'],
            'answers_1' => $request['answers_1'],
            'question_2' => $request['question_2'],
            'answers_2' => $request['answers_2'],
            'question_3' => $request['question_3'],
            'answers_3' => $request['answers_3'],
            'question_4' => $request['question_4'],
            'answers_4' => $request['answers_4'],
            'question_5' => $request['question_5'],
            'answers_5' => $request['answers_5'],
            'question_6' => $request['question_6'],
            'answers_6' => $request['answers_6'],

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],

            'updated_by' => auth()->user()->id
        );

        $$module_name_singular->update($userData);

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
     * @param  int  $id
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

        $module_action = 'Delete';

        $module_model::find($id)->delete();


        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Deleted Successfully")->important();

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return redirect("admin/$module_name");
    }


    public function testing()
    {
        //
        return "Under Developing";
    }


    public function active($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = '[Active Candidates]';

        $canditype = 'active_index_data';
        $export_name='Active';


        session()->put('last_url', url()->current());

        // $$module_name_singular = Jobresponse::where([
        //     ['jobposts_id', $jpid],
        //     ['status', 0]
        // ])->get();



        // $$module_name_singular = $module_model::findOrFail($jpid);
        $question_list=Jobpost::findOrFail($jpid);

        // $categories = Category::pluck('name', 'id');
        $categories = '';

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.index_candi_datatable",
            compact('categories','question_list', 'export_name', 'jpid', 'canditype', 'module_title', 'module_name', 'module_icon', 'module_action')
        );
    }

    public function await($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = '[Awating Candidates]';

        $canditype = 'await_index_data';
        $export_name='Await';

        session()->put('last_url', url()->current());

        // $$module_name_singular = Jobresponse::where([
        //     ['jobposts_id', $jpid],
        //     ['status', 0]
        // ])->get();



        // $$module_name_singular = $module_model::findOrFail($jpid);
        $question_list=Jobpost::findOrFail($jpid);

        // $categories = Category::pluck('name', 'id');
        $categories = '';

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.index_candi_datatable",
            compact('categories', 'jpid','question_list', 'export_name', 'canditype', 'module_title', 'module_name', 'module_icon', 'module_action')
        );
    }

    public function reviewed($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = '[Reviewed Candidates]';

        $canditype = 'reviewed_index_data';
        $export_name='Reviewed';

        session()->put('last_url', url()->current());

        // $$module_name_singular = Jobresponse::where([
        //     ['jobposts_id', $jpid],
        //     ['status', 0]
        // ])->get();



        // $$module_name_singular = $module_model::findOrFail($jpid);
        $question_list=Jobpost::findOrFail($jpid);

        // $categories = Category::pluck('name', 'id');
        $categories = '';

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.index_candi_datatable",
            compact('categories', 'jpid','question_list','export_name', 'canditype', 'module_title', 'module_name', 'module_icon', 'module_action')
        );
    }

    public function allcandi($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = '[All Candidates]';

        $canditype = 'allcandi_index_data';
        $export_name='All';

        session()->put('last_url', url()->current());

        // $$module_name_singular = Jobresponse::where([
        //     ['jobposts_id', $jpid],
        //     ['status', 0]
        // ])->get();



        // $$module_name_singular = $module_model::findOrFail($jpid);
        $question_list=Jobpost::findOrFail($jpid);
        // dd($question_list);

        // $categories = Category::pluck('name', 'id');
        $categories = '';

        // Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_name.index_candi_datatable",
            compact('categories', 'jpid','question_list', 'export_name', 'canditype', 'module_title', 'module_name', 'module_icon', 'module_action')
        );
    }



    public function active_index_data($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';


        $$module_name = Jobresponse::where('jobposts_id', $jpid)->where('status', 1)->select('id', 'users_email', 'users_firstname', 'users_telephone', 'status', 'created_at', 'answer_1', 'answer_2','answer_3', 'answer_4','answer_5', 'answer_6');

        // $$module_name = $module_model::select('id', 'jobtitle', 'jobdescription', 'intro', 'updated_by', 'type', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = 'jobresponses';
                $tb_type='shortlisted';
                return view('backend.includes.action_column_show_candi', compact('module_name', 'data','tb_type'));
            })
            ->editColumn('status', function ($data) {
                return view('backend.includes.action_candi_status', compact('data'));
                // if ($data->status == 0) {
                //     $output = '<span class="badge badge-primary">Awating</span>';
                // } elseif ($data->status == 1) {
                //     $output = '<span class="badge badge-primary">Shortlisted</span>';
                // } elseif ($data->status == 2) {
                //     $output = '<span class="badge badge-primary">Review later</span>';
                // } else {
                //     $output = '<span class="badge badge-primary">Rejected</span>';
                // }
                // $output = ($data->status) ? "<a>Published</a>": "<a>Unpublished</a>";

                // return $is_featured;

                // return $output;
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
            // ->rawColumns(['name', 'status', 'action'])
            // ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function await_index_data($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Jobresponse::where('jobposts_id', $jpid)->whereIn('status', [0, 2])->select('id', 'users_email', 'users_firstname', 'users_telephone', 'status', 'created_at', 'answer_1', 'answer_2','answer_3', 'answer_4','answer_5', 'answer_6');

        // $$module_name = $module_model::select('id', 'jobtitle', 'jobdescription', 'intro', 'updated_by', 'type', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = 'jobresponses';
                $tb_type='await';
                return view('backend.includes.action_column_show_candi', compact('module_name', 'data','tb_type'));
            })
            ->editColumn('status', function ($data) {
                return view('backend.includes.action_candi_status', compact('data'));
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
            // ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function reviewed_index_data($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Jobresponse::where('jobposts_id', $jpid)->where('status', 3)->select('id', 'users_email', 'users_firstname', 'users_telephone', 'status', 'created_at', 'answer_1', 'answer_2','answer_3', 'answer_4','answer_5', 'answer_6');

        // $$module_name = $module_model::select('id', 'jobtitle', 'jobdescription', 'intro', 'updated_by', 'type', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = 'jobresponses';
                $tb_type='reviewed';
                return view('backend.includes.action_column_show_candi', compact('module_name', 'data','tb_type'));
            })
            ->editColumn('status', function ($data) {
                return view('backend.includes.action_candi_status', compact('data'));
            })
            // ->editColumn('name', function ($data) {
            //     $is_featured = ($data->is_featured) ? '<span class="badge badge-primary">Featured</span>' : '';

            //     return $data->name.' '.$data->status_formatted.' '.$is_featured;
            // })
            ->editColumn('created_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->created_at);

                if ($diff < 25) {
                    return $data->created_at->diffForHumans();
                } else {
                    return $data->created_at->toCookieString();
                }
            })
            // ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function allcandi_index_data($jpid)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = Jobresponse::where('jobposts_id', $jpid)->whereIn('status', [0, 1, 2, 3])->select('id', 'users_email', 'users_firstname', 'users_telephone', 'status', 'created_at', 'answer_1', 'answer_2','answer_3', 'answer_4','answer_5', 'answer_6');

        // $$module_name = $module_model::select('id', 'jobtitle', 'jobdescription', 'intro', 'updated_by', 'type', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = 'jobresponses';
                $tb_type='all';
                return view('backend.includes.action_column_show_candi', compact('module_name', 'data','tb_type'));
            })
            ->editColumn('status', function ($data) {
                return view('backend.includes.action_candi_status', compact('data'));
            })
            // ->editColumn('name', function ($data) {
            //     $is_featured = ($data->is_featured) ? '<span class="badge badge-primary">Featured</span>' : '';

            //     return $data->name.' '.$data->status_formatted.' '.$is_featured;
            // })
            ->editColumn('created_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->created_at);

                if ($diff < 25) {
                    return $data->created_at->diffForHumans();
                } else {
                    return $data->created_at->toCookieString();
                }
            })
            // ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}
