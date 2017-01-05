<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

use App\IndiaReads\Repository\Eloquent\TrendingBooksRepository;

class Trending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trending:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * @var TrendingBooksRepository
     */
    protected $trendingBooksRepository;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(TrendingBooksRepository $trendingBooksRepository) {
        parent::__construct();
        $this->trendingBooksRepository = $trendingBooksRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ten_days_difference = time() - 24*60*60*10;
        $books = DB::table('book_library_new')->select('*')
            // ->where('last_circulated_on', '>=', $ten_days_difference)
            ->where('circulation', '>=', 5)
            ->groupBy('ISBN13')->havingRaw('count(ISBN13) > 1')
            ->orderBy(DB::raw('count(ISBN13)', 'desc'))
            ->take(20)->get();
        DB::table('trending_books')->truncate();
        foreach($books as $book) {
            DB::insert('Insert into trending_books(ISBN13, title) values (?, ?)', [$book->ISBN13, $book->title]);
        }
    }
}
