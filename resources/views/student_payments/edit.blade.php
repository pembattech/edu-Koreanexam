<x-app-layout>

    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">Edit
            Payment</h1>

        <form
            action="{{ route('student_payments.update', ['student' => $studentPayment->student_id, 'payment' => $studentPayment->id]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <!-- Payment Type -->
            <div class="mb-4">
                <label for="payment_type" class="block mb-2 text-base font-medium text-gray-900">Payment Type</label>
                <input type="text" name="payment_type" id="payment_type"
                    value="{{ old('payment_type', $studentPayment->payment_type) }}"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('payment_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block mb-2 text-base font-medium text-gray-900">Amount</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount', $studentPayment->amount) }}"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block mb-2 text-base font-medium text-gray-900">Payment
                    Method</label>
                <input type="text" name="payment_method" id="payment_method"
                    value="{{ old('payment_method', $studentPayment->payment_method) }}"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('payment_method')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment Date -->
            <div class="mb-4">
                <label for="payment_date" class="block mb-2 text-base font-medium text-gray-900">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" min="{{ date('Y-m-d') }}"
                    value="{{ old('payment_date', $studentPayment->payment_date) }}"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('payment_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Transaction ID -->
            <div class="mb-4">
                <label for="transaction_id" class="block mb-2 text-base font-medium text-gray-900">Transaction
                    ID</label>
                <input type="text" name="transaction_id" id="transaction_id"
                    value="{{ old('transaction_id', $studentPayment->transaction_id) }}"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('transaction_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remarks -->
            <div class="mb-4">
                <label for="remarks" class="block mb-2 text-base font-medium text-gray-900">Remarks</label>
                <textarea name="remarks" id="remarks" rows="4"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('remarks', $studentPayment->remarks) }}</textarea>
                @error('remarks')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Update Payment
                </button>

                <a href="{{ route('students.show', $studentPayment->student_id) }}"
                    class="bg-gray-800 px-5 py-2.5 border border-transparent rounded-lg text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancel</a>
                    
            </div>
        </form>

    </div>
</x-app-layout>
