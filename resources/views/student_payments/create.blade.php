<x-app-layout>
    <div class="p-4 max-w-5xl mx-auto">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">
            Add New Payment for Student: {{ $student->name }}
        </h1>

        <div class="p-2">
            <form action="{{ route('student_payments.store', $student->id) }}" method="POST">
                @csrf

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="payment_type">Payment Type</label>
                    <input type="text" name="payment_type" id="payment_type"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('payment_type') }}" required>
                    @error('payment_type')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" step="0.01"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('amount') }}" required>
                    @error('amount')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="payment_method">Payment Method</label>
                    <input type="text" name="payment_method" id="payment_method"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('payment_method') }}" required>
                    @error('payment_method')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="payment_date">Payment Date</label>
                    <input type="date" name="payment_date" id="payment_date" min="{{ date('Y-m-d') }}"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('payment_date') }}" required>
                    @error('payment_date')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="transaction_id">Transaction ID</label>
                    <input type="text" name="transaction_id" id="transaction_id"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('transaction_id') }}">
                    @error('transaction_id')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="py-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" rows="4"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <div class="text-base text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                        Submit Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
