<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{   
    public function frontPage() {
        $featured_blogs = DB::table('tbl_blogs')->where('blog_is_featured', true)->get();
        $recent_blogs = DB::table('tbl_blogs')->latest('blog_created_at')->take(3)->get();
        $recent_species_blogs = DB::table('tbl_blogs')
            ->join('tbl_categories', 'tbl_blogs.blog_category', '=', 'tbl_categories.id')
            ->where('tbl_blogs.blog_category', 1)
            ->select('tbl_blogs.*', 'tbl_categories.category_slug', 'tbl_categories.category_title') // get blog fields + category_slug
            ->latest('tbl_blogs.blog_created_at')
            ->take(2)
            ->get();
        $recent_fishing_calendar_blogs = DB::table('tbl_blogs')
            ->join('tbl_categories', 'tbl_blogs.blog_category', '=', 'tbl_categories.id')
            ->where('tbl_blogs.blog_category', 2)
            ->select('tbl_blogs.*', 'tbl_categories.category_slug', 'tbl_categories.category_title') // get blog fields + category_slug
            ->latest('tbl_blogs.blog_created_at')
            ->take(2)
            ->get();
        $recent_tips_blogs = DB::table('tbl_blogs')
            ->join('tbl_categories', 'tbl_blogs.blog_category', '=', 'tbl_categories.id')
            ->where('tbl_blogs.blog_category', 3)
            ->select('tbl_blogs.*', 'tbl_categories.category_slug', 'tbl_categories.category_title') // get blog fields + category_slug
            ->latest('tbl_blogs.blog_created_at')
            ->take(2)
            ->get();
        $recent_gear_blogs = DB::table('tbl_blogs')
            ->join('tbl_categories', 'tbl_blogs.blog_category', '=', 'tbl_categories.id')
            ->where('tbl_blogs.blog_category', 4)
            ->select('tbl_blogs.*', 'tbl_categories.category_slug', 'tbl_categories.category_title') // get blog fields + category_slug
            ->latest('tbl_blogs.blog_created_at')
            ->take(2)
            ->get();
        $fishing_spots = DB::table('tbl_fishing_spots')->orderBy('fishing_created_at', 'desc')->get();
        $data = [
            'featured_blogs' => $featured_blogs,
            'recent_blogs' => $recent_blogs,
            'recent_species_blogs' => $recent_species_blogs,
            'recent_fishing_calendar_blogs' => $recent_fishing_calendar_blogs,
            'recent_tips_blogs' => $recent_tips_blogs,
            'recent_gear_blogs' => $recent_gear_blogs,
            'fishing_spots' => $fishing_spots
        ];
        return view('pages.index', compact('data'));
    }
    public function getFeaturedBlogs() {
        $blog_data = DB::table('tbl_blogs')->where('blog_is_featured', true)->get();
    }

    public function getBlogsPerCategory() {

    }

    public function getRecentBlogsPerCategory() {

    }
}
