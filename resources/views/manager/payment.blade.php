<x-manager-layout>
 

    <div class="py-8 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">


            {{-- User Payment Tracking Section --}}
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-600/5 to-cyan-600/5 rounded-3xl"></div>
                <div class="relative bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 flex items-center mb-2">
                                <div class="bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl p-3 mr-4 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent">
                                    User Payment Tracking
                                </span>
                            </h3>
                            <p class="text-gray-600 ml-20">Track all user payments with associated dates</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl px-6 py-3 border border-teal-200">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-teal-600">{{ isset($users) ? $users->count() : 0 }}</div>
                                    <div class="text-xs text-gray-600">Total Users</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Payment Table -->
                    <div class="overflow-hidden rounded-2xl border-2 border-gray-200 shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm border-collapse">
                                <thead>
                                    <tr class="bg-gradient-to-r from-teal-100 to-cyan-100">
                                        <th class="border-r border-gray-300 py-4 px-4 font-bold text-gray-800 text-left min-w-[180px]">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>User Name</span>
                                            </div>
                                        </th>
                                        <th class="border-r border-gray-300 py-4 px-4 font-bold text-gray-800 text-center min-w-[120px]">
                                            <div class="flex flex-col items-center space-y-1">
                                                <span>Total Paid</span>
                                                <div class="text-xs font-medium text-gray-500">Amount</div>
                                            </div>
                                        </th>
                                        <th class="border-r border-gray-300 py-4 px-4 font-bold text-gray-800 text-center min-w-[120px]">
                                            <div class="flex flex-col items-center space-y-1">
                                                <span>Last Payment</span>
                                                <div class="text-xs font-medium text-gray-500">Date</div>
                                            </div>
                                        </th>
                                        <th class="border-r border-gray-300 py-4 px-4 font-bold text-gray-800 text-center min-w-[150px]">
                                            <div class="flex flex-col items-center space-y-1">
                                                <span>Payment History</span>
                                                <div class="text-xs font-medium text-gray-500">Recent Transactions</div>
                                            </div>
                                        </th>
                                        <th class="py-4 px-4 font-bold text-gray-800 text-center min-w-[120px]">
                                            <div class="flex flex-col items-center space-y-1">
                                                <span>Status</span>
                                                <div class="text-xs font-medium text-gray-500">Payment</div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users ?? [] as $user)
                                        @php
                                            $userPayments = isset($payments) ? $payments->where('user_id', $user->id) : collect();
                                            $totalPaid = $userPayments->sum('amount');
                                            $lastPayment = $userPayments->sortByDesc('date')->first();
                                            $recentPayments = $userPayments->sortByDesc('date')->take(3);
                                            $paymentStatus = $totalPaid > 0 ? 'Paid' : 'Pending';
                                            $statusColor = $totalPaid > 0 ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800';
                                        @endphp
                                        <tr class="bg-white hover:bg-teal-50/30 transition-all duration-300 border-b border-gray-200">
                                            <td class="border-r border-gray-300 py-4 px-4 font-semibold text-gray-800">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg flex-shrink-0">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <span class="text-gray-900 font-semibold">{{ $user->name }}</span>
                                                        <div class="text-xs text-gray-500 mt-1">{{ $user->email ?? 'No email' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-r border-gray-300 py-4 px-4 text-center">
                                                <div class="flex flex-col items-center justify-center space-y-1">
                                                    <div class="text-2xl font-black bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent">
                                                        ৳{{ number_format($totalPaid, 2) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">total paid</div>
                                                </div>
                                            </td>
                                            <td class="border-r border-gray-300 py-4 px-4 text-center">
                                                @if($lastPayment)
                                                    <div class="flex flex-col items-center justify-center space-y-1">
                                                        <div class="text-lg font-bold text-gray-800">
                                                            {{ \Carbon\Carbon::parse($lastPayment->date)->format('M d, Y') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            ৳{{ number_format($lastPayment->amount, 2) }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-gray-400 text-sm">No payments</div>
                                                @endif
                                            </td>
                                            <td class="border-r border-gray-300 py-4 px-4">
                                                <div class="flex flex-col space-y-2">
                                                    @if($recentPayments->count() > 0)
                                                        @foreach($recentPayments as $payment)
                                                            <div class="flex items-center justify-between bg-gray-50/50 rounded-lg px-3 py-2">
                                                                <div class="text-xs font-medium text-gray-700">
                                                                    {{ \Carbon\Carbon::parse($payment->date)->format('M d') }}
                                                                </div>
                                                                <div class="text-sm font-bold text-teal-600">
                                                                    ৳{{ number_format($payment->amount, 2) }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="text-center text-gray-400 text-sm py-2">
                                                            No payment history
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                                    @if($paymentStatus === 'Paid')
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                    {{ $paymentStatus }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-8 text-gray-500">
                                                No users found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Payment Button -->
                    <div class="flex justify-center mt-8">
                        <button type="button" onclick="openPaymentModal()" class="group relative overflow-hidden">
                            <div class="absolute -inset-2 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-3xl blur-xl opacity-50 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white px-16 py-5 rounded-2xl font-black text-sm shadow-2xl transition-all duration-500 flex items-center space-x-4 transform hover:scale-105">
                                <svg class="w-7 h-7 group-hover:rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Add New Payment</span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden transition-opacity duration-300">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md transform transition-all duration-500 scale-95 opacity-0" id="modalContent">
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 rounded-t-3xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-black">Add New Payment</h3>
                        <button onclick="closePaymentModal()" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form action="{{ route('addpayment') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="payment_user_id" class="block text-sm font-bold text-gray-700 mb-2">
                                Select User
                            </label>
                            <select name="user_id" id="payment_user_id" required
                                class="w-full px-4 py-3 bg-white border-2 border-teal-300 rounded-2xl focus:ring-4 focus:ring-teal-300 focus:border-teal-400 transition-all duration-300 text-gray-700 shadow-inner">
                                <option value="">Select User</option>
                                @if(isset($users))
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="payment_amount" class="block text-sm font-bold text-gray-700 mb-2">
                                Amount
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-xl font-black text-teal-600">৳</span>
                                <input type="number" name="amount" id="payment_amount" placeholder="0.00" step="0.01" min="0" required
                                    class="w-full pl-12 pr-4 py-3 bg-white border-2 border-teal-300 rounded-2xl focus:ring-4 focus:ring-teal-300 focus:border-teal-400 transition-all duration-300 text-gray-700 shadow-inner">
                            </div>
                        </div>
                        <div>
                            <label for="payment_date" class="block text-sm font-bold text-gray-700 mb-2">
                                Payment Date
                            </label>
                            <input type="date" name="date" id="payment_date" value="{{ now()->format('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-white border-2 border-teal-300 rounded-2xl focus:ring-4 focus:ring-teal-300 focus:border-teal-400 transition-all duration-300 text-gray-700 shadow-inner">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" onclick="closePaymentModal()"
                            class="px-6 py-3 text-gray-600 hover:text-gray-800 font-semibold transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white px-8 py-3 rounded-2xl font-bold shadow-lg transition-all duration-300 transform hover:scale-105">
                            Add Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  
    <style>
        @keyframes modalOpen {
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .modal-open {
            animation: modalOpen 0.3s ease-out forwards;
        }
        
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        .backdrop-blur-xl {
            backdrop-filter: blur(20px);
        }
    </style>
    
    <script>
        // Payment Modal Functions
        function openPaymentModal() {
            const modal = document.getElementById('paymentModal');
            const modalContent = document.getElementById('modalContent');
            
            if(modal && modalContent) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.add('modal-open');
                }, 10);
            }
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            const modalContent = document.getElementById('modalContent');
            
            if(modalContent) {
                modalContent.classList.remove('modal-open');
            }
            setTimeout(() => {
                if(modal) modal.classList.add('hidden');
            }, 300);
        }

        // Show notification function
        window.showNotification = function(message, type = 'success') {
            const bgGradient = type === 'error'
                ? 'bg-gradient-to-r from-red-500 to-red-600'
                : 'bg-gradient-to-r from-green-500 to-emerald-600';

            const notification = document.createElement('div');
            notification.className = `fixed top-8 right-8 ${bgGradient} text-white px-8 py-4 rounded-2xl shadow-2xl transform translate-x-full transition-all duration-500 z-50 flex items-center space-x-3 border border-white/20 backdrop-blur-sm`;

            const icon = type === 'error'
                ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';

            notification.innerHTML = `
                <div class="bg-white/20 rounded-full p-2">${icon}</div>
                <span class="font-semibold text-lg">${message}</span>
            `;

            document.body.appendChild(notification);

            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => document.body.contains(notification) && document.body.removeChild(notification), 500);
            }, 4000);
        };

        // Auto-close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if(event.key === 'Escape') {
                closePaymentModal();
            }
        });

        // Check for success/error messages from session
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
    </script>
   
</x-manager-layout>