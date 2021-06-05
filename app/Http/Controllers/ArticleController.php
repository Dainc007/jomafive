<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Admin\Competition;
use App\Models\Admin\Fixture;
use App\Models\Admin\JuniorCompetition;
use App\Models\Admin\JuniorLeagueTable;
use App\Models\Admin\LeagueTable;
use App\Models\Admin\PlayerStats;
use App\Models\Article;
use App\Models\JuniorFixture;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'allArticles'      => DB::table('articles')->orderBy('id', 'DESC')->limit(4)->get(),
            'leagueHeader'     => 'W JOMAFIVE',
            'photos' => Photo::limit(4)->get('path'),
        ]);
    }

    public function business(int $level)
    {
        $competitionID = Competition::where('level', $level)->where('league', Article::getLeague('Business'))
            ->orderBy('start', 'DESC')->pluck('id')->first();

        return view('articles.business', [
            'leagueHeader' => 'W LIDZE BIZNESOWEJ',
            'league'       => 'Biznesowa',
            'businessArticles' => Article::where('league', Article::getLeague('Business'))->orderBy('id', 'DESC')->limit(3)->get(),
            'leagueTable' => LeagueTable::where('competitionID', $competitionID)
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),
            'fixtures' => Fixture::where('competitionID', $competitionID)->where('hosts_goals', null)
                ->orderBy('date', 'ASC')->get(),
            'latest_scores' => Fixture::where('competitionID', $competitionID)->where('hosts_goals', '!=', null)
                ->orderBy('date', 'DESC')
                ->orderBy('hour', 'DESC')->get(),

            'scorers' => PlayerStats::where('competitionID', $competitionID)
                ->where('goal', '>', 0)
                ->select('playerID', 'name', 'surname', 'players.teamName as teamName', DB::raw('SUM(goal) as goals'))
                ->groupBy('playerID')
                ->orderBy('goals', 'DESC')
                ->join('players', 'player_stats.playerID', '=', 'players.id')
                ->get(),

            'assistants' => PlayerStats::where('competitionID', $competitionID)
                ->where('assist', '>', 0)
                ->select('playerID', 'name', 'surname', 'players.teamName as teamName', DB::raw('SUM(assist) as assists'))
                ->orderBy('assists', 'DESC')
                ->groupBy('playerID')
                ->join('players', 'player_stats.playerID', '=', 'players.id')
                ->get(),

            'canadian' => PlayerStats::where('competitionID', $competitionID)
                ->select(
                    'playerID',
                    'name',
                    'surname',
                    'players.teamName as teamName',
                    DB::raw('SUM(goal) as goals'),
                    DB::raw('SUM(assist) as assists'),
                    DB::raw('SUM(goal) + SUM(assist) as canadian')
                )
                ->orderBy('canadian', 'DESC')
                ->groupBy('playerID')
                ->join('players', 'player_stats.playerID', '=', 'players.id')
                ->get(),



        ]);
    }

    public function weekend(int $level)
    {
        $competitionID = Competition::where('level', $level)->where('league', 'weekend')->orderBy('start', 'DESC')->first()->pluck('id');

        return view('articles.weekend', [
            'leagueHeader' => 'W LIDZE WEEKENDOWEJ',
            'league'       => 'Weekendowa',
            'fixtures' => Fixture::where('competitionID', $competitionID)->where('hosts_goals', null)
                ->orderBy('date', 'ASC')->get(),
                'latest_scores' => Fixture::where('competitionID', $competitionID)->where('hosts_goals', '!=', null)
                ->orderBy('date', 'ASC')->get(),
            'weekendArticles'  => Article::where('league', Article::getLeague('Weekend'))->orderBy('id', 'DESC')->limit(3)->get(),
            'leagueTable' => LeagueTable::where('competitionID', $competitionID)
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),
        ]);
    }

    public function kid(string $class)
    {

        $competitionID = JuniorCompetition::where('class', $class)->orderBy('start', 'DESC')->pluck('id')->first();

        return view('articles.kid', [
            'leagueHeader' => 'w lidze Dziecięcej',
            'league'       => 'Dziecięca',
            'kidArticles'      => Article::where('league', Article::getLeague('Kid'))->orderBy('id', 'DESC')->limit(3)->get(),
            'leagueTable' => JuniorLeagueTable::where('competitionID', $competitionID)
            ->select('level', 'teamId', 'teamName', DB::raw(
                'SUM(points) as points, SUM(bilans) as bilans, SUM(games) as games, SUM(wins) as wins,
                SUM(draws) as draws, SUM(losts) as losts'
            ))
            ->groupBy('teamId', 'level', 'teamName')
            ->orderBy('points', 'DESC')
            ->orderBy('bilans', 'DESC') 
            ->get(),

            'fixtures' => JuniorFixture::where('competitionID', $competitionID)->where('hosts_goals', null)
                ->orderBy('date', 'ASC')->get(),
            'latest_scores' => JuniorFixture::where('competitionID', $competitionID)->where('hosts_goals', '!=', null)
                ->orderBy('date', 'DESC')
                ->orderBy('hour', 'DESC')->get(),
        ]);
    }

    public function add()
    {
        if (session('username') != 'admin') {
            return back();
        } else {
            return view('articles.add');
        }
    }

    public function store(StoreArticleRequest $request)
    {
        //adding gallery
        if ($request->hasFile('photos')) {

            $galleryName = $request->input('galleryName');

            foreach ($request->photos as $photo) {

                $photoName = $photo->getClientOriginalName();

                $path = $photo->storeAs('/images/gallery', $photoName);

                $model = new Photo;

                $model->name = $photoName;
                $model->galleryName = $galleryName;
                $model->path = $path;
                $model->save();
            }
        }

        if ($request->hasFile('photo')) {

            $photoName = $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('/images/gallery', $photoName, '');
            $request['photoName'] = $photoName;
            $request['photoPath'] = $photoPath;
        }

        return redirect(
            route(
                'articles.show',
                [
                    'article' => Article::create($request->all())
                ]
            )
        );
    }


    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
            'photos' => Photo::where('galleryName', $article->galleryName)->limit(4)->pluck('path')
        ]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        if ($article->update($request->validated())) {
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoj artykuł został edytowany'
            ]);
        } else {
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoj artykuł nie mógł zostać zaktualizowany :('
            ]);
        }

        return redirect(
            route(
                'articles.show',
                ['article' => $article]
            )
        );
    }

    public function delete(Request $request, Article $article)
    {
        if ($article->delete()) {
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoj artykuł został usunięty'
            ]);
        } else {
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoj artykuł nie mógł zostać usunięty :('
            ]);
        }

        return redirect(
            route(
                'articles.index'
            )
        );
    }
}
