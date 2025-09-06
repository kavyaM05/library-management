<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('library.index');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'published_year' => 'required|integer|min:1901|max:2155',
            'copies' => 'nullable|integer|min:0',
            'author_name' => 'required|string|max:100',
            'author_email' => 'required|email|unique:authors,email',
        ]);

        DB::transaction(function () use ($request) {
            $author = Author::firstOrCreate(
                ['email' => $request->input('author_email')],
                ['name' => $request->input('author_name')]
            );

            Book::create([
                'title' => $request->input('title'),
                'published_year' => $request->input('published_year'),
                'copies' => $request->input('copies') ?: null,
                'author_id' => $author->id,
            ]);
        });

        return redirect()->route('books.list')->with('success', 'Books saved successfully!');

    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function list(Request $request)
    {
        $filter = collect($request->only(['author_id', 'published_year', 'from_date', 'to_date']));

        $query = Book::with('author')
            ->when($filter->get('author_id'), function ($query, $authorId) {
                $query->where('author_id', $authorId);
            })
            ->when($filter->get('published_year'), function ($query, $year) {
                $query->where('published_year', $year);
            })
            ->when($filter->get('from_date') && $filter->get('to_date'), function ($query) use ($filter) {
                $from = Carbon::parse($filter->get('from_date'))->startOfDay();
                $to = Carbon::parse($filter->get('to_date'))->endOfDay();
                $query->whereBetween('created_at', [$from, $to]);
            });

        $books = $query->paginate(10)->withQueryString();
        $authors = Author::orderBy('name')->get();

        return view('library.partials.list', compact('books', 'authors'));
    }
}
