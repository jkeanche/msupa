<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        .header p {
            color: #7f8c8d;
            margin-top: 0;
        }
        .summary {
            margin-bottom: 30px;
        }
        .summary-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .summary-grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .summary-item {
            width: 25%;
            padding: 10px;
            box-sizing: border-box;
        }
        .summary-item-inner {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            height: 100%;
        }
        .summary-item-title {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        .summary-item-value {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .summary-item-change {
            font-size: 12px;
            margin-top: 5px;
        }
        .positive-change {
            color: #27ae60;
        }
        .negative-change {
            color: #e74c3c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 10px;
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 2px solid #ddd;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .chart-container {
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sales Report</h1>
        <p>{{ $dateRange ?? 'Last 7 Days' }} | Generated on {{ date('F j, Y') }}</p>
    </div>
    
    <div class="summary">
        <div class="summary-title">Summary</div>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-item-inner">
                    <div class="summary-item-title">Total Sales</div>
                    <div class="summary-item-value">Ksh.{{ number_format($totalSales ?? 0, 2) }}</div>
                    @if(isset($salesChange))
                        <div class="summary-item-change {{ $salesChange > 0 ? 'positive-change' : 'negative-change' }}">
                            {{ $salesChange > 0 ? '+' : '' }}{{ number_format($salesChange, 1) }}% vs previous period
                        </div>
                    @endif
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-item-inner">
                    <div class="summary-item-title">Orders</div>
                    <div class="summary-item-value">{{ $totalOrders ?? 0 }}</div>
                    @if(isset($ordersChange))
                        <div class="summary-item-change {{ $ordersChange > 0 ? 'positive-change' : 'negative-change' }}">
                            {{ $ordersChange > 0 ? '+' : '' }}{{ number_format($ordersChange, 1) }}% vs previous period
                        </div>
                    @endif
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-item-inner">
                    <div class="summary-item-title">Average Order Value</div>
                    <div class="summary-item-value">Ksh.{{ number_format($averageOrderValue ?? 0, 2) }}</div>
                    @if(isset($aovChange))
                        <div class="summary-item-change {{ $aovChange > 0 ? 'positive-change' : 'negative-change' }}">
                            {{ $aovChange > 0 ? '+' : '' }}{{ number_format($aovChange, 1) }}% vs previous period
                        </div>
                    @endif
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-item-inner">
                    <div class="summary-item-title">Conversion Rate</div>
                    <div class="summary-item-value">{{ number_format($conversionRate ?? 0, 1) }}%</div>
                    @if(isset($conversionChange))
                        <div class="summary-item-change {{ $conversionChange > 0 ? 'positive-change' : 'negative-change' }}">
                            {{ $conversionChange > 0 ? '+' : '' }}{{ number_format($conversionChange, 1) }}% vs previous period
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="top-products">
        <div class="summary-title">Top Products</div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($topProducts) && count($topProducts) > 0)
                    @foreach($topProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity_sold }}</td>
                            <td>Ksh.{{ number_format($product->revenue, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align: center;">No product data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    
    <div class="recent-orders">
        <div class="summary-title">Recent Orders</div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($recentOrders) && count($recentOrders) > 0)
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ date('M d, Y', strtotime($order->created_at)) }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->item_count }}</td>
                            <td>Ksh.{{ number_format($order->total, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center;">No recent orders found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }} | This report is generated automatically and is confidential.</p>
    </div>
</body>
</html>
