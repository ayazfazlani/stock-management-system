<div class="flex flex-col min-h-screen bg-gray-50 text-gray-700">
    <!-- Header -->
    <div class="p-6 flex justify-between items-center bg-white border-b shadow-sm">
        <h1 class="text-2xl font-semibold text-gray-800">Analytics</h1>
        <button wire:click="exportExcel"
            class="bg-green-600 text-white py-2 px-5 rounded-lg hover:bg-green-700 transition font-medium">
            Export to Excel
        </button>
    </div>

    <!-- Main content area -->
    <div class="flex-grow p-4 md:p-6 space-y-6">
        <!-- Filter Section -->
        <div class="bg-white p-5 rounded-xl shadow-sm">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter</h3>
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" wire:model.live="filterName" id="item_name"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="Search by item name..." />
                </div>
                <!-- You can re-enable this if needed -->
                <!--
                <button 
                    wire:click="fetchData"
                    class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition"
                >
                    Apply Filter
                </button>
                -->
            </div>
        </div>

        <!-- Analytics Table Section -->
        <div class="bg-white p-5 rounded-xl shadow-sm flex flex-col max-h-[520px] overflow-hidden">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Item Analytics</h3>

            <div class="flex min-w-0 flex-grow overflow-hidden">
                <!-- Left fixed column - Item Names (visible on md+) -->
                <div class="hidden md:block w-80 flex-none bg-gray-50 border-r overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-2 py-6 text-left text-sm font-semibold text-gray-700 md:min-w-[180px]">
                                    Item Name</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach (json_decode($filteredAnalyticsDataJson, true) as $data)
                            <tr>
                                <td class="h-12 px-4 text-sm text-gray-600">{{ $data['item_name'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Scrollable main analytics table -->
                <div class="flex-1 overflow-x-auto overflow-y-auto">
                    <table class="min-w-max divide-y divide-gray-200">
                        <thead class="bg-gray-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 md:min-w-[180px]">
                                    Item</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Current Qty</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[160px]">
                                    Inventory Assets</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Avg Quantity</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Turnover Ratio</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Stock Out Days</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Total In</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[140px]">
                                    Total Out</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[150px]">
                                    Avg Daily In</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 md:min-w-[150px]">
                                    Avg Daily Out</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach (json_decode($filteredAnalyticsDataJson, true) as $data)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-600 md:hidden">{{ $data['item_name'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 hidden md:table-cell">
                                    {{ $data['item_name'] }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">{{ $data['current_quantity'] }}
                                </td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    ${{ number_format($data['inventory_assets'] ?? 0, 2) }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ number_format($data['average_quantity'] ?? 0, 1) }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ number_format($data['turnover_ratio'] ?? 0, 2) }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ $data['stock_out_days_estimate'] ?? '—' }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ $data['total_stock_in'] ?? 0 }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ $data['total_stock_out'] ?? 0 }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ number_format($data['avg_daily_stock_in'] ?? 0, 1) }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ number_format($data['avg_daily_stock_out'] ?? 0, 1) }}</td>
                            </tr>
                            @endforeach

                            <!-- Totals row -->
                            <tr class="bg-gray-100 font-medium">
                                <td class="px-4 py-3 text-sm">Total</td>
                                <td class="px-4 py-3 text-right text-sm">{{ $this->calculate('current_quantity') }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    ${{ number_format($this->calculate('inventory_assets'), 2) }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    {{ number_format($this->calculate('average_quantity'), 1) }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    {{ number_format($this->calculate('turnover_ratio'), 2) }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    {{ $this->calculate('stock_out_days_estimate') }}</td>
                                <td class="px-4 py-3 text-right text-sm">{{ $this->calculate('total_stock_in') }}</td>
                                <td class="px-4 py-3 text-right text-sm">{{ $this->calculate('total_stock_out') }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    {{ number_format($this->calculate('avg_daily_stock_in'), 1) }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    {{ number_format($this->calculate('avg_daily_stock_out'), 1) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>