<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Store;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Process date range filter
        $dateRange = $request->input('date_range', 'last30days');
        $startDate = null;
        $endDate = null;
        
        switch ($dateRange) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'last7days':
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::now();
                break;
            case 'last30days':
                $startDate = Carbon::now()->subDays(30);
                $endDate = Carbon::now();
                break;
            case 'thismonth':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'lastmonth':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'thisyear':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now();
                break;
        }
        
        // Calculate previous period for comparison
        $daysDiff = $endDate->diffInDays($startDate) + 1;
        $previousStartDate = (clone $startDate)->subDays($daysDiff);
        $previousEndDate = (clone $startDate)->subDay();
        
        // Get orders within the date range
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $previousOrders = Order::whereBetween('created_at', [$previousStartDate, $previousEndDate])->get();
        
        // Calculate summary metrics
        $totalRevenue = $orders->sum('total');
        $previousTotalRevenue = $previousOrders->sum('total');
        $revenueChange = $previousTotalRevenue > 0 ? (($totalRevenue - $previousTotalRevenue) / $previousTotalRevenue) * 100 : 0;
        
        $totalOrders = $orders->count();
        $previousTotalOrders = $previousOrders->count();
        $ordersChange = $previousTotalOrders > 0 ? (($totalOrders - $previousTotalOrders) / $previousTotalOrders) * 100 : 0;
        
        $totalUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $previousTotalUsers = User::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $usersChange = $previousTotalUsers > 0 ? (($totalUsers - $previousTotalUsers) / $previousTotalUsers) * 100 : 0;
        
        $totalStores = Store::whereBetween('created_at', [$startDate, $endDate])->count();
        $previousTotalStores = Store::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $storesChange = $previousTotalStores > 0 ? (($totalStores - $previousTotalStores) / $previousTotalStores) * 100 : 0;
        
        // Additional metrics
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $previousAverageOrderValue = $previousTotalOrders > 0 ? $previousTotalRevenue / $previousTotalOrders : 0;
        $aovChange = $previousAverageOrderValue > 0 ? (($averageOrderValue - $previousAverageOrderValue) / $previousAverageOrderValue) * 100 : 0;
        
        // Get top performing stores
        $topStores = Store::withCount(['orders as orders_count' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->withSum(['orders as revenue' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }], 'total')
            ->orderBy('revenue', 'desc')
            ->take(10)
            ->get();
            
        // Get top selling products across all stores
        $topProducts = Product::withCount(['orderItems as quantity_sold' => function($query) use ($startDate, $endDate) {
                $query->whereHas('order', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                });
            }])
            ->withSum(['orderItems as revenue' => function($query) use ($startDate, $endDate) {
                $query->whereHas('order', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                });
            }], 'price')
            ->with('store')
            ->orderBy('quantity_sold', 'desc')
            ->take(10)
            ->get();
            
        // Get recent orders
        $recentOrders = Order::with(['user', 'store'])
            ->latest()
            ->take(10)
            ->get();
            
        // Prepare chart data
        $salesTrend = $this->prepareSalesTrendData($startDate, $endDate);
        $orderStatusData = $this->prepareOrderStatusData($startDate, $endDate);
        $categorySalesData = $this->prepareCategorySalesData($startDate, $endDate);
        $userGrowthData = $this->prepareUserGrowthData($startDate, $endDate);
        $storeGrowthData = $this->prepareStoreGrowthData($startDate, $endDate);
        $paymentMethodData = $this->preparePaymentMethodData($startDate, $endDate);
        
        // Get subscription metrics
        $subscriptionMetrics = $this->getSubscriptionMetrics($startDate, $endDate);
        
        $statistics = [
            'total_revenue' => $totalRevenue,
            'revenue_change' => $revenueChange,
            'total_orders' => $totalOrders,
            'orders_change' => $ordersChange,
            'total_users' => $totalUsers,
            'users_change' => $usersChange,
            'total_stores' => $totalStores,
            'stores_change' => $storesChange,
            'average_order_value' => $averageOrderValue,
            'aov_change' => $aovChange,
        ];
        
        return view('admin.reports.index', compact(
            'statistics',
            'topStores',
            'topProducts', 
            'recentOrders',
            'salesTrend', 
            'orderStatusData',
            'categorySalesData', 
            'userGrowthData',
            'storeGrowthData',
            'paymentMethodData',
            'subscriptionMetrics',
            'dateRange',
            'startDate',
            'endDate'
        ));
    }
    
    private function prepareSalesTrendData($startDate, $endDate)
    {
        // Daily sales data for the selected period
        $dailySales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as total, COUNT(*) as orders')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->date => [
                    'revenue' => $item->total,
                    'orders' => $item->orders
                ]];
            })
            ->toArray();
            
        return $dailySales;
    }
    
    private function prepareOrderStatusData($startDate, $endDate)
    {
        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
    }
    
    private function prepareCategorySalesData($startDate, $endDate)
    {
        return Category::whereHas('products.orderItems.order', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->withSum(['products.orderItems as revenue' => function($query) use ($startDate, $endDate) {
                $query->whereHas('order', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                });
            }], 'price')
            ->orderBy('revenue', 'desc')
            ->take(10)
            ->get()
            ->pluck('revenue', 'name')
            ->toArray();
    }
    
    private function prepareUserGrowthData($startDate, $endDate)
    {
        return User::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();
    }
    
    private function prepareStoreGrowthData($startDate, $endDate)
    {
        return Store::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();
    }
    
    private function preparePaymentMethodData($startDate, $endDate)
    {
        return Payment::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->payment_method => [
                    'count' => $item->count,
                    'total' => $item->total
                ]];
            })
            ->toArray();
    }
    
    private function getSubscriptionMetrics($startDate, $endDate)
    {
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $newSubscriptions = Subscription::whereBetween('created_at', [$startDate, $endDate])->count();
        $cancelledSubscriptions = Subscription::where('status', 'cancelled')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->count();
        $subscriptionRevenue = Subscription::where('status', 'active')
            ->sum('amount');
            
        return [
            'active' => $activeSubscriptions,
            'new' => $newSubscriptions,
            'cancelled' => $cancelledSubscriptions,
            'revenue' => $subscriptionRevenue
        ];
    }
    
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        
        switch ($format) {
            case 'pdf':
                return $this->exportPdf($request);
            case 'excel':
                return $this->exportExcel($request);
            default:
                return $this->exportCsv($request);
        }
    }
    
    private function exportCsv(Request $request)
    {
        $dateRange = $request->input('date_range', 'last30days');
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        
        // Process date range (same logic as index method)
        switch ($dateRange) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'last7days':
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::now();
                break;
            case 'last30days':
                $startDate = Carbon::now()->subDays(30);
                $endDate = Carbon::now();
                break;
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now();
                break;
        }
        
        $orders = Order::with(['user', 'store'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
            
        $filename = 'admin_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Order ID',
                'Date',
                'Customer',
                'Store',
                'Status',
                'Total',
                'Payment Status'
            ]);
            
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->user ? $order->user->name : 'Guest',
                    $order->store ? $order->store->name : 'N/A',
                    $order->status,
                    $order->total,
                    $order->payment_status
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function exportPdf(Request $request)
    {
        // PDF export functionality would be implemented here
        // For now, return a simple response
        return response()->json(['message' => 'PDF export functionality will be implemented']);
    }
    
    private function exportExcel(Request $request)
    {
        // Excel export functionality would be implemented here
        // For now, return a simple response
        return response()->json(['message' => 'Excel export functionality will be implemented']);
    }
} 