<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduleLelangComponent extends Component
{
    use WithPagination;
    public $categories = [];
    public $getCat, $getMonth, $getKpknl, $getName;
    public $setMonth, $setYear;
    private $datas = [];

    public function getCategories()
    {
        $this->categories = DB::table('categories')
            ->select('id', 'name')
            ->where('status', '!=', 0)
            ->get();
    }

    public function getDatas()
    {
        $this->datas =
            DB::table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('auction_schedules as ac', 'p.id', '=', 'ac.product_id')
            ->join('product_photos as pp', function ($join) {
                $join->on('p.id', '=', 'pp.product_id')
                    ->where('pp.is_primary', '=', 1);
            })
            ->select(
                'p.id',
                'p.name',
                'p.slug',
                'c.name as nameCategory',
                'ac.kpknl',
                'ac.schedule',
                'pp.photo'
            )
            ->groupBy(
                'p.id',
                'p.name',
                'p.slug',
                'nameCategory',
                'ac.kpknl',
                'ac.schedule',
                'pp.photo'
            )
            ->paginate(10);
        // ->get();

        // dd($this->datas);
    }

    public function filter()
    {
        $cat = $this->getCat;
        $kpknl = $this->getKpknl;
        $name = $this->getName;
        $month = $this->getMonth;
        $this->datas = DB::table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('auction_schedules as ac', 'p.id', '=', 'ac.product_id')
            ->join('product_photos as pp', function ($join) {
                $join->on('p.id', '=', 'pp.product_id')
                    ->where('pp.is_primary', '=', 1);
            })
            ->where(function ($query) use ($cat, $kpknl, $name, $month) {
                $query->Where('p.name', $name)
                    ->orWhere(DB::raw('DATE_FORMAT(ac.schedule, "%Y-%m")'), $month)
                    ->orWhere('ac.kpknl', $kpknl)
                    ->orWhere('c.name', 'LIKE', '%' . $cat . '%');
            })
            ->select(
                'p.id',
                'p.name',
                'p.slug',
                'c.name as nameCategory',
                'ac.kpknl',
                'ac.schedule',
                'pp.photo'
            )
            ->orderByDesc('p.created_at')
            ->groupBy(
                'p.id',
                'p.name',
                'p.slug',
                'nameCategory',
                'ac.kpknl',
                'ac.schedule',
                'pp.photo'
            )
            ->paginate(10);
    }

    public function boot()
    {
        $this->getCategories();

        // Set month
        $currentDate = now();
        $this->setYear = $currentDate->year;
        $this->setMonth = $currentDate->addMonth()->format('m');
        $this->getDatas();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.schedule.index', ['datas' => $this->datas]);
    }
}
