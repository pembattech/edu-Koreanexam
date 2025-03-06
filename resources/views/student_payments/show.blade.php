<h2 class="text-2xl font-semibold text-center mt-10 mb-6">Payment Details</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Payment Type</th>
                        <th class="px-4 py-2 border">Amount</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Payment Date</th>
                        <th class="px-4 py-2 border">Transaction ID</th>
                        <th class="px-4 py-2 border">Remarks</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($student->payments as $payment)
                        <tr class="border-t">
                            <td class="px-4 py-2 border">{{ $payment->payment_type }}</td>
                            <td class="px-4 py-2 border">{{ number_format($payment->amount, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $payment->payment_method }}</td>
                            <td class="px-4 py-2 border">{{ $payment->payment_date }}</td>
                            <td class="px-4 py-2 border">{{ $payment->transaction_id ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $payment->remarks }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('student_payments.edit', ['student' => $student->id, 'payment' => $payment->id]) }}"
                                    class="font-medium text-blue-600 hover:underline">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                No payment records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>