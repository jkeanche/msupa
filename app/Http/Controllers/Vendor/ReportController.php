<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Carbon\Carbon;
use PDF;
use Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated vendor's store
        $store = Auth::user()->store;
        
        // Process date range filter
        $dateRange = $request->input('date_range', 'last7days');
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
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now();
                break;
        }
        
        // Get orders within the date range
        $orders = Order::where('store_id', $store->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
            
        // Calculate previous period for comparison
        $previousStartDate = (clone $startDate)->subDays($endDate->diffInDays($startDate) + 1);
        $previousEndDate = (clone $startDate)->subDay();
        
        $previousOrders = Order::where('store_id', $store->id)
            ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->get();
        
        // Calculate summary metrics
        $totalSales = $orders->sum('total');
        $previousTotalSales = $previousOrders->sum('total');
        $salesChange = $previousTotalSales > 0 ? (($totalSales - $previousTotalSales) / $previousTotalSales) * 100 : 0;
        
        $totalOrders = $orders->count();
        $previousTotalOrders = $previousOrders->count();
        $ordersChange = $previousTotalOrders > 0 ? (($totalOrders - $previousTotalOrders) / $previousTotalOrders) * 100 : 0;
        
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        $previousAverageOrderValue = $previousTotalOrders > 0 ? $previousTotalSales / $previousTotalOrders : 0;
        $aovChange = $previousAverageOrderValue > 0 ? (($averageOrderValue - $previousAverageOrderValue) / $previousAverageOrderValue) * 100 : 0;
        
        // Assume we have a way to track visitors for conversion rate calculation
        // In a real application, this would come from analytics data
        $visitors = 1000; // Placeholder
        $previousVisitors = 900; // Placeholder
        $conversionRate = $visitors > 0 ? ($totalOrders / $visitors) * 100 : 0;
        $previousConversionRate = $previousVisitors > 0 ? ($previousTotalOrders / $previousVisitors) * 100 : 0;
        $conversionChange = $previousConversionRate > 0 ? (($conversionRate - $previousConversionRate) / $previousConversionRate) * 100 : 0;
        
        // Get top selling products
        $topProducts = Product::where('store_id', $store->id)
            ->withCount(['orderItems as quantity_sold' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->withSum(['orderItems as revenue' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }], 'price')
            ->orderBy('quantity_sold', 'desc')
            ->take(5)
            ->get();
            
        // Get recent orders
        $recentOrders = Order::where('store_id', $store->id)
            ->with('customer')
            ->withCount('orderItems as item_count')
            ->latest()
            ->take(10)
            ->get()
            ->map(function($order) {
                $order->customer_name = $order->customer ? $order->customer->name : 'Guest';
                return $order;
            });
            
        // Prepare data for sales trend chart
        $salesTrend = $this->prepareSalesTrendData($store->id, $startDate, $endDate);
        
        // Prepare data for order status chart
        $orderStatusData = $this->prepareOrderStatusData($store->id, $startDate, $endDate);
        
        // Prepare data for category sales chart
        $categorySalesData = $this->prepareCategorySalesData($store->id, $startDate, $endDate);
        
        // Prepare data for customer acquisition chart
        $customerData = $this->prepareCustomerData($store->id, $startDate, $endDate);
        
        return view('vendor.reports.index', compact(
            'totalSales', 'salesChange', 
            'totalOrders', 'ordersChange', 
            'averageOrderValue', 'aovChange', 
            'conversionRate', 'conversionChange',
            'topProducts', 'recentOrders',
            'salesTrend', 'orderStatusData',
            'categorySalesData', 'customerData'
        ));
    }
    
    private function prepareSalesTrendData($storeId, $startDate, $endDate)
    {
        // Daily sales data for the selected period
        $dailySales = Order::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date')
            ->toArray();
            
        // Weekly sales data
        $weeklySales = Order::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate->copy()->subWeeks(4), $endDate])
            ->selectRaw('YEARWEEK(created_at) as week, SUM(total) as total')
            ->groupBy('week')
            ->orderBy('week')
            ->get()
            ->pluck('total', 'week')
            ->toArray();
            
        // Monthly sales data
        $monthlySales = Order::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate->copy()->subMonths(6), $endDate])
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                $monthName = Carbon::createFromDate($item->year, $item->month, 1)->format('M');
                return [
                    'label' => $monthName,
                    'value' => $item->total
                ];
            })
            ->pluck('value', 'label')
            ->toArray();
            
        return [
            'daily' => $dailySales,
            'weekly' => $weeklySales,
            'monthly' => $monthlySales
        ];
    }
    
    private function prepareOrderStatusData($storeId, $startDate, $endDate)
    {
        return Order::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
    }
    
    private function prepareCategorySalesData($storeId, $startDate, $endDate)
    {
        return Category::whereHas('products', function($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->withSum(['products.orderItems as revenue' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }], 'price')
            ->orderBy('revenue', 'desc')
            ->take(5)
            ->get()
            ->pluck('revenue', 'name')
            ->toArray();
    }
    
    private function prepareCustomerData($storeId, $startDate, $endDate)
    {
        // Get new customers per month for the last 6 months
        $newCustomers = Customer::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate->copy()->subMonths(6), $endDate])
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                $monthName = Carbon::createFromDate($item->year, $item->month, 1)->format('M');
                return [
                    'label' => $monthName,
                    'value' => $item->count
                ];
            })
            ->pluck('value', 'label')
            ->toArray();
            
        // Get returning customers (customers who placed more than one order)
        $returningCustomers = Order::where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate->copy()->subMonths(6), $endDate])
            ->selectRaw('customer_id, YEAR(created_at) as year, MONTH(created_at) as month')
            ->groupBy('customer_id', 'year', 'month')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->groupBy(function($item) {
                return Carbon::createFromDate($item->year, $item->month, 1)->format('M');
            })
            ->map(function($group) {
                return $group->count();
            })
            ->toArray();
            
        return [
            'new' => $newCustomers,
            'returning' => $returningCustomers
        ];
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'pdf');
        $dateRange = $request->input('date_range', 'last7days');
        
        // Get the data for the report
        // This would be similar to the index method but formatted for export
        
        switch ($format) {
            case 'pdf':
                return $this->exportPdf($request);
            case 'csv':
                return $this->exportCsv($request);
            case 'excel':
                return $this->exportExcel($request);
            default:
                return redirect()->back()->with('error', 'Invalid export format');
        }
    }
    
    private function exportPdf(Request $request)
    {
        // Generate PDF report
        $data = []; // Prepare data for the PDF
        
        $pdf = PDF::loadView('vendor.reports.export.pdf', $data);
        return $pdf->download('sales_report.pdf');
    }
    
    private function exportCsv(Request $request)
    {
        // Generate CSV report
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sales_report.csv"',
        ];
        
        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Date', 'Orders', 'Sales', 'Average Order Value']);
            
            // Add data rows
            // This would come from your database
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function exportExcel(Request $request)
    {
        // Generate Excel report
        // This would typically use a package like Laravel Excel
        
        return Excel::download(new SalesExport, 'sales_report.xlsx');
    }
}
