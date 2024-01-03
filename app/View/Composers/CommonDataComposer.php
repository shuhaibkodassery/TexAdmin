<?php
namespace App\View\Composers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Header_menu;
use Session;
use Log;
use DB;

class CommonDataComposer {

    /**
     * Write the code to fetch all common variables needed in all or most pages (blades) 
     * in this function
     */
    public function compose(View $view): void {
        $variables_to_pass = []; # initialize

        $path_url = request()->path();
        $path_url_segments = !empty($path_url) ? explode('/', $path_url) : [];
        $base_url_path = !empty($path_url_segments) ? (!empty($path_url_segments[1]) ?  $path_url_segments[1] : $path_url_segments[0]): '';

        
        $variables_to_pass = array_merge($variables_to_pass,
            [
                'path' => $base_url_path,
            ]
        );

        $view->with($variables_to_pass);

    }
}