<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Jobresponse;
use App\Models\Jobpost;
use Yajra\DataTables\DataTables;

class JobpostController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Job Posts';

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

        $module_action = 'Job Post List';

        $$module_name = $module_model::where('status', 1)->latest()->paginate();

        return view(
            "frontend.$module_path.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular')
        );
    }

    public function index_datatable()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Job Post List';

        $$module_name = $module_model::where('status', 1)->get();

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('frontend.jobposts.action_jobs', compact('module_name', 'data'));
            })

            // ->addColumn('candidate', function ($data) {
            //     $module_name = $this->module_name;
            //     $job_res_model = 'App\Models\Jobresponse';

            //     return view('backend.includes.action_candi_column', compact('module_name', 'data', 'job_res_model'));
            // })
            // ->editColumn('status', function ($data) {
            //     $is_featured = ($data->status) ? '<span class="badge badge-primary">Published</span>' : '<span class="badge badge-danger">Unpublished</span>';

            //     return $is_featured;
            // })
            //////////////////////
            // ->editColumn('updated_at', function ($data) {
            //     $module_name = $this->module_name;

            //     $diff = Carbon::now()->diffInHours($data->updated_at);

            //     if ($diff < 25) {
            //         return $data->updated_at->diffForHumans();
            //     } else {
            //         return $data->updated_at->toCookieString();
            //     }
            // })
            // ->rawColumns(['name', 'status', 'action'])
            // ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Job Post List';

        $$module_name = $module_model::where('status', 1)->latest()->paginate();

        foreach ($$module_name  as $key => $value) {
            $value['encode_id'] = encode_id($value->id);
        }

        return $$module_name;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($hashid)
    {
        $id = decode_id($hashid);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $meta_page_type = 'jobs';

        $$module_name_singular = $module_model::findOrFail($id);

        $q1_ans = explode(',', $$module_name_singular->answers_1);
        $q2_ans = explode(',', $$module_name_singular->answers_2);
        $q3_ans = explode(',', $$module_name_singular->answers_3);
        $q4_ans = explode(',', $$module_name_singular->answers_4);
        $q5_ans = explode(',', $$module_name_singular->answers_5);
        $q6_ans = explode(',', $$module_name_singular->answers_6);

        // event(new PostViewed($$module_name_singular));

        return view(
            "frontend.$module_name.show",
            compact('q1_ans', 'q2_ans', 'q3_ans', 'q4_ans', 'q5_ans', 'q6_ans', 'module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type')
        );
    }

    public function uploadcv(Request $request)
    {

        $check_status = Jobpost::find($request['job_id']);

        if ($check_status['status'] == 0) {
            return redirect()->back()->withErrors(['Expired', 'This job post is expired now. You cant response anymore']);
        }

        // dd($request);

        $check_email = Jobresponse::where('jobposts_id', $request['job_id'])->get();
        foreach ($check_email as $key => $value) {
            if ($value->users_email == $request['users_email']) {
                return redirect()->back()->withErrors(['Warning', 'You have already applied for this job post.']);
            }
        }



        $request->validate(
            [
                'file' => 'required|mimes:pdf,doc,docx|max:4096',
                'users_email' => 'required',
                'users_firstname' => 'required|max:100',
                'users_telephone' => 'required|max:12',

            ],
            [
                'file.mimes' => 'The file must be in PDF, doc or docx format',
                'file.max' => 'Your file should not be greater than 4 MB',
                'file.required' => 'Please select your CV as PDF or doc,docx',
                'users_email.required' => "Candidate's email address is required",
                'users_firstname.required' => "Candidate's name is required",
                'users_telephone.required' => "Candidate's phone no is required",
                'users_telephone.max' => 'Please enter a valid phone no.'
            ]
        );


        $fileName = $request['users_email'] . '-' . $request['job_id'] . '.' . $request->file->extension();
        $request->file->move(public_path('storage/uploadedcv'), $fileName);
        $cvfilepath = 'storage/uploadedcv/' . $fileName;

        $user = Jobresponse::create([
            'jobposts_id' => $request['job_id'],
            'users_email' => $request['users_email'],
            'users_cv' => $cvfilepath,
            'users_firstname' => $request['users_firstname'],
            'users_telephone' => $request['users_telephone'],
            'status' => 0,
            'answer_1' => $request['answer_1'],
            'answer_2' => $request['answer_2'],
            'answer_3' => $request['answer_3'],
            'answer_4' => $request['answer_4'],
            'answer_5' => $request['answer_5'],
            'answer_6' => $request['answer_6'],
        ]);


        return back()->with('success', 'You have successfully applied for the Job.');
    }
}
