<x-app-layout>
    <h1>Student Payments</h1>
    <a href="{{ route('student_payments.create') }}">Add New Payment</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->student->name }}</td>
                    <td>{{ $payment->payment_type }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        <a href="{{ route('student_payments.show', $payment->id) }}">View</a>
                        <a href="{{ route('student_payments.edit', $payment->id) }}">Edit</a>
                        <form action="{{ route('student_payments.destroy', $payment->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
