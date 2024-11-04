<?php

namespace App\Livewire\Backend\Components\Transaction;

use stdClass;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\TransactionModel;
use Illuminate\Pagination\LengthAwarePaginator;

class Table extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $perPageOptions = [5, 10, 15, 20, 50, 100,250,500,1000];
    public $search = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $statusFilter = ''; // Filter status
    public $darkMode = false; // Toggle dark mode

    public $totalTransactions; // Total semua transaksi
    public $completedTransactions; // Total transaksi selesai
    public $totalAmount; // Total nominal transaksi
    public $processingTransactions; // Total transaksi processing
    public $expiredTransactions; // Total transaksi expired

    public $chartData = []; // Data untuk grafik

    protected $queryString = ['perPage', 'search', 'sortBy', 'sortDirection', 'statusFilter'];

    public $hasMore = true;
    public $isLoading = false; // Indikator loading
    public $count = 0;


    protected function firestore()
    {
        return new TransactionModel();
    }

    public function mount()
    {
        // $this->calculateAnalytics(); // Hitung analitik saat komponen dimuat
        // $this->generateChartData(); // Inisialisasi data grafik
        $this->loadMore(); // Ambil data awal
    }

    public function render()
    {
        $transactionsArray = $this->getAllTransactions();

        $transactions = json_decode(json_encode($transactionsArray));

        return view('livewire.backend.components.transaction.table', compact('transactions'));
    }

    private function getAllTransactions()
    {
        return $transactions = $this->firestore()->getAllTransactionQris($this->perPage);

    }

    public function calculateAnalytics()
    {
        $allTransactions = $this->getAllTransactions(); // Ambil semua transaksi

        $this->totalTransactions = $allTransactions->count();
        $this->completedTransactions = $allTransactions->where('status', 'paid')->count();
        $this->processingTransactions = $allTransactions->where('status', 'processing')->count();
        $this->expiredTransactions = $allTransactions->where('status', 'expired')->count();
        $this->totalAmount = $allTransactions->sum('totalGroosAmount');
    }


    public function generateChartData()
    {
        // Gunakan data dummy untuk grafik
        $transactions = $this->generateDummyTransactions();

        $groupedByDate = $transactions->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->createdAt)->format('Y-m-d');
        });

        // Persiapkan data untuk grafik
        $this->chartData = $groupedByDate->map(function ($items) {
            return $items->count();
        })->toArray();
    }


    // private function getPaginatedData()
    // {
    //     // Ambil transaksi dengan filter dan pagination
    //     $transactions = $this->getAllTransactions();

    //     if ($this->statusFilter) {
    //         $transactions = $transactions->where('status', $this->statusFilter);
    //     }

    //     if ($this->search) {
    //         $transactions = $transactions->filter(function ($item) {
    //             return Str::contains(strtolower($item->name), strtolower($this->search)) ||
    //                    Str::contains(strtolower($item->email), strtolower($this->search));
    //         });
    //     }

    //     return $this->paginate($transactions);
    // }

    // public function paginate($items)
    // {
    //     $page = request()->query('page', 1);
    //     $total = $items->count();

    //     return new LengthAwarePaginator(
    //         $items->slice(($page - 1) * $this->perPage, $this->perPage),
    //         $total, $this->perPage, $page,
    //         ['path' => request()->url(), 'query' => request()->query()]
    //     );
    // }

    // public function toggleDarkMode()
    // {
    //     $this->darkMode = !$this->darkMode; // Ubah state dark mode
    // }

    /**
     * Tambahkan jumlah transaksi yang ingin di-load setiap kali tombol "Muat Lebih Banyak" dipanggil.
     * Nilai perPage akan ditambahkan sebesar 10.
     */
    public function loadMore()
    {
        // Tambahkan jumlah transaksi yang ingin di-load setiap kali loadMore dipanggil
        $this->perPage += $this->perPage;
    }

    // public function getTransactionsProperty()
    // {
    //     // Ambil transaksi dengan pagination berdasarkan perPage saat ini
    //     $transactions = $this->getAllTransactions()
    //         ->take($this->perPage);

    //     if ($this->search) {
    //         $transactions = $transactions->filter(function ($item) {
    //             return Str::contains(strtolower($item->name), strtolower($this->search)) ||
    //                 Str::contains(strtolower($item->email), strtolower($this->search));
    //         });
    //     }

    //     return $transactions;
    // }

}
