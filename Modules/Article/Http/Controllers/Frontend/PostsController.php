<?php

namespace Modules\Article\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Article\Events\PostViewed;

class PostsController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index_user()
    {
        // dd("user");
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $current_view='user';

        $module_action = 'List';

        $$module_name = $module_model::where('status', 1)->where('view_type', 1)->latest()->paginate();

        return view(
            "article::frontend.$module_path.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular','current_view')
        );
    }

    public function index_merchant()
    {
        // dd("merchant");
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $current_view='merchant';

        $module_action = 'List';

        $$module_name = $module_model::where('status', 1)->where('view_type', 0)->latest()->paginate();

        return view(
            "article::frontend.$module_path.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular','current_view')
        );
    }


    public function index_data_user()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::where('status', 1)->where('view_type', 1)->latest()->paginate();

        foreach ($$module_name  as $key => $value) {
            $value['encode_id'] = encode_id($value->id);
        }

        return $$module_name;
    }

    public function index_data_merchant()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::where('status', 1)->where('view_type', 0)->latest()->paginate();

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

        $meta_page_type = 'article';

        $$module_name_singular = $module_model::findOrFail($id);

        // dd($$module_name_singular);
        if ($$module_name_singular->view_type==1) {
            $current_view='user';
        } else {
            $current_view='merchant';
        }


        event(new PostViewed($$module_name_singular));

        return view(
            "article::frontend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type','current_view')
        );
    }
}
