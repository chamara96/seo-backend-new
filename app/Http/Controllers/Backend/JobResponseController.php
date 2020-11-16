<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Flash;
use App\Models\Jobresponse;
use App\Models\Setting;
use App\Models\Jobpost;
use Mail;
// use Illuminate\Support\Facades\Input;

class JobResponseController extends Controller
{
    //
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Jobs Responses';

        // module name
        $this->module_name = 'jobresponses';

        // directory path of the module
        $this->module_path = 'jobresponses';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "App\Models\Jobresponse";
    }

    public function findEnvSetting($name)
    {
        $env_settings = Setting::all()->toArray();
        foreach ($env_settings as $key => $value) {
            if ($value['name'] == $name) {
                return $value['val'];
            }
            // return $value['name'];
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(session()->get('last_url'));
        // $module_title = $this->module_title;
        // $module_name = $this->module_name;
        // $module_path = $this->module_path;
        // $module_icon = $this->module_icon;
        // $module_model = $this->module_model;
        // $module_name_singular = Str::singular($module_name);

        // $module_action = 'List';

        // $$module_name = $module_model::paginate();

        // return view(
        //     "backend.$module_path.index_datatable",
        //     compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        // );
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

        $$module_name = $module_model::select('id', 'users_email', 'users_cv', 'users_firstname', 'status', 'reviewed_by', 'created_at');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            // ->editColumn('name', function ($data) {
            //     $is_featured = ($data->is_featured) ? '<span class="badge badge-primary">Featured</span>' : '';

            //     return $data->name.' '.$data->status_formatted.' '.$is_featured;
            // })
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
    public function store(Request $request)
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
            'intro' => $data['intro'],
            'content' => $data['content'],
            'type' => $data['type'],
            'status' => $data['status'],
            'meta_title' => $data['meta_title'],
            'meta_keywords' => $data['meta_keywords'],
            'meta_description' => $data['meta_description'],

            'created_by_name' => auth()->user()->name,
            'created_by' => auth()->user()->id
        );
        $module_model::create($userData);

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

        // $show_type=Input::get('type');
        $show_type = request('type');
        // dd($show_type);

        $$module_name_singular = $module_model::findOrFail($id);

        //cv extention
        $cv_info = pathinfo($$module_name_singular->users_cv);
        $cv_ext = $cv_info['extension'];
        // dd($ext);

        if ($show_type == 'all') {
            $raw_value_next = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->whereIn('status', [0, 1, 2, 3])->where('id', '>', $id)->first();
            if ($raw_value_next == null) {
                $btn_next = 0;
            } else {
                $btn_next = $raw_value_next->id;
            }

            $raw_value_prev = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->whereIn('status', [0, 1, 2, 3])->where('id', '<', $id)->latest('id')->first();
            if ($raw_value_prev == null) {
                $btn_prev = 0;
            } else {
                $btn_prev = $raw_value_prev->id;
            }
        } elseif ($show_type == 'reviewed') {
            $raw_value_next = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->where('status', 3)->where('id', '>', $id)->first();
            if ($raw_value_next == null) {
                $btn_next = 0;
            } else {
                $btn_next = $raw_value_next->id;
            }

            $raw_value_prev = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->where('status', 3)->where('id', '<', $id)->latest('id')->first();
            if ($raw_value_prev == null) {
                $btn_prev = 0;
            } else {
                $btn_prev = $raw_value_prev->id;
            }
        } elseif ($show_type == 'await') {
            $raw_value_next = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->whereIn('status', [0, 2])->where('id', '>', $id)->first();
            if ($raw_value_next == null) {
                $btn_next = 0;
            } else {
                $btn_next = $raw_value_next->id;
            }

            $raw_value_prev = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->whereIn('status', [0, 2])->where('id', '<', $id)->latest('id')->first();
            if ($raw_value_prev == null) {
                $btn_prev = 0;
            } else {
                $btn_prev = $raw_value_prev->id;
            }
        } elseif ($show_type == 'shortlisted') {
            $raw_value_next = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->where('status', 1)->where('id', '>', $id)->first();
            if ($raw_value_next == null) {
                $btn_next = 0;
            } else {
                $btn_next = $raw_value_next->id;
            }

            $raw_value_prev = $module_model::where('jobposts_id', $$module_name_singular->jobposts_id)->where('status', 1)->where('id', '<', $id)->latest('id')->first();
            if ($raw_value_prev == null) {
                $btn_prev = 0;
            } else {
                $btn_prev = $raw_value_prev->id;
            }
        }

        $job_details = Jobpost::find($$module_name_singular->jobposts_id);
        // dd($job_details);

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
            compact('job_details', 'module_title', 'module_name', 'btn_next', 'btn_prev', 'show_type', 'cv_ext', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular", 'activities')
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

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->update([
            'jobtitle' => $request['jobtitle'],
            'intro' => $request['intro'],
            'content' => $request['content'],
            'type' => $request['type'],
            'status' => $request['status'],
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],

            'updated_by' => auth()->user()->id
        ]);

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
        //
        echo "Under Developing";
    }

    public function set_await(Request $responseid)
    {
        $id = $responseid['job_response_id'];
        $return_val = Jobresponse::findOrfail($id);
        // $job_details=Jobpost::find($return_val['jobposts_id']);
        $post_details_url = route("frontend.jobposts.show", [encode_id($return_val['jobposts_id'])]);


        $return_val->status = 1;
        $return_val->reviewed_by = auth()->user()->id;
        $return_val->reviewed_by_name = auth()->user()->name;
        $return_val->save();

        // mail section
        $data = array(
            'users_firstname' => $return_val['users_firstname'],
            'users_email' => $return_val['users_email'],
            // 'sender_mail' => $this->findEnvSetting('email'),
            'mail_subject' => $this->findEnvSetting('awaiting_subject'),
            'app_name' => $this->findEnvSetting('app_name'),
            'mail_body' => $this->findEnvSetting('email_temp'),
            'jobpostlink' => $post_details_url,

        );

        // Mail::send(['text' => 'mail'], $data, function ($message) use ($data) {
        //     $message->to($data['users_email'], $data['users_firstname'])->subject($data['mail_subject']);
        //     $message->from($data['sender_mail'], $data['app_name']);
        // });

        $admin_email_setting = \App\Providers\AppServiceProvider::findEnvSetting("email");

        Mail::send('mail', $data, function ($mail) use ($data, $admin_email_setting) {
            $mail->from($admin_email_setting);
            $mail->to($data['users_email']);
            $mail->subject($data['mail_subject']);
        });
        // end mail

        Flash::success("<i class='fas fa-check'></i> New '" . $return_val->users_email . "' Set Awaiting. Email has been sent.")->important();
        return redirect(session()->get('last_url'));
    }

    public function set_reviewed(Request $responseid)
    {
        $id = $responseid['job_response_id'];
        $return_val = Jobresponse::findOrfail($id);

        $post_details_url = route("frontend.jobposts.show", [encode_id($return_val['jobposts_id'])]);

        $return_val->status = 2;
        $return_val->reviewed_by = auth()->user()->id;
        $return_val->reviewed_by_name = auth()->user()->name;
        $return_val->save();

        // mail section
        $data = array(
            'users_firstname' => $return_val['users_firstname'],
            'users_email' => $return_val['users_email'],
            'sender_mail' => $this->findEnvSetting('email'),
            'mail_subject' => $this->findEnvSetting('reviewed_subject'),
            'app_name' => $this->findEnvSetting('app_name'),
            'mail_body' => $this->findEnvSetting('email_temp'),
            'jobpostlink' => $post_details_url,

        );

        // Mail::send(['text' => 'mail'], $data, function ($message) use ($data) {
        //     $message->to($data['users_email'], $data['users_firstname'])->subject($data['mail_subject']);
        //     $message->from($data['sender_mail'], $data['app_name']);
        // });

        $admin_email_setting = \App\Providers\AppServiceProvider::findEnvSetting("email");

        Mail::send('mail', $data, function ($mail) use ($data, $admin_email_setting) {
            $mail->from($admin_email_setting);
            $mail->to($data['users_email']);
            $mail->subject($data['mail_subject']);
        });

        // end mail

        Flash::success("<i class='fas fa-check'></i> New '" . $return_val->users_email . "' Set Awaiting. Email has been sent.")->important();
        return redirect(session()->get('last_url'));
    }

    public function set_reject(Request $responseid)
    {
        $id = $responseid['job_response_id'];
        $return_val = Jobresponse::findOrfail($id);

        $post_details_url = route("frontend.jobposts.show", [encode_id($return_val['jobposts_id'])]);

        $return_val->status = 3;
        $return_val->reviewed_by = auth()->user()->id;
        $return_val->reviewed_by_name = auth()->user()->name;
        $return_val->save();

        // mail section
        $data = array(
            'users_firstname' => $return_val['users_firstname'],
            'users_email' => $return_val['users_email'],
            'sender_mail' => $this->findEnvSetting('email'),
            'mail_subject' => $this->findEnvSetting('rejected_subject'),
            'app_name' => $this->findEnvSetting('app_name'),
            'mail_body' => $this->findEnvSetting('email_temp'),
            'jobpostlink' => $post_details_url,

        );

        // Mail::send(['text' => 'mail'], $data, function ($message) use ($data) {
        //     $message->to($data['users_email'], $data['users_firstname'])->subject($data['mail_subject']);
        //     $message->from($data['sender_mail'], $data['app_name']);
        // });

        $admin_email_setting = \App\Providers\AppServiceProvider::findEnvSetting("email");

        Mail::send('mail', $data, function ($mail) use ($data, $admin_email_setting) {
            $mail->from($admin_email_setting);
            $mail->to($data['users_email']);
            $mail->subject($data['mail_subject']);
        });

        // end mail

        Flash::success("<i class='fas fa-check'></i> New '" . $return_val->users_email . "' Set Awaiting. Email has been sent.")->important();
        return redirect(session()->get('last_url'));
    }
}
