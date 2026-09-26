<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow-ups</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold">
                CRM Application
            </h1>

            <div class="flex items-center gap-6 text-sm">

                <a href="{{ route('leads.index') }}"
                   class="hover:text-blue-400 transition">
                    Leads
                </a>

                <a href="{{ route('follow-ups.index') }}"
                   class="text-blue-400 font-semibold">
                    Follow-ups
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    Follow-up Management
                </h2>

                <p class="text-slate-500 mt-1">
                    Track upcoming and overdue follow-ups.
                </p>
            </div>

            <a href="{{ route('follow-ups.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold transition shadow">
                + Add Follow-up
            </a>

        </div>


        <!-- Success Message -->
        @if (session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                <div class="flex items-center gap-2">
                    <span class="text-lg">✓</span>
                    <span class="font-medium">
                        {{ session('success') }}
                    </span>
                </div>
            </div>

        @endif


        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-slate-500">
                            Upcoming Follow-ups
                        </p>

                        <p class="text-3xl font-bold text-blue-600 mt-2">
                            {{ $upcomingFollowUps->count() }}
                        </p>
                    </div>

                    <div class="text-3xl">
                        📅
                    </div>

                </div>

            </div>


            <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-slate-500">
                            Overdue Follow-ups
                        </p>

                        <p class="text-3xl font-bold text-red-600 mt-2">
                            {{ $overdueFollowUps->count() }}
                        </p>
                    </div>

                    <div class="text-3xl">
                        ⚠️
                    </div>

                </div>

            </div>

        </div>


        <!-- Upcoming Follow-ups -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-10">

            <div class="px-6 py-5 border-b border-slate-200">

                <div class="flex items-center justify-between">

                    <div>
                        <h3 class="text-xl font-bold text-slate-800">
                            Upcoming Follow-ups
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Follow-ups scheduled for today or future dates.
                        </p>
                    </div>

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $upcomingFollowUps->count() }}
                    </span>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Lead
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Follow-up Date
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Notes
                            </th>

                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-600">
                                Actions
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        @forelse ($upcomingFollowUps as $followUp)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5">

                                    <p class="font-semibold text-slate-800">
                                        {{ $followUp->lead->lead_name }}
                                    </p>

                                    <p class="text-sm text-slate-500">
                                        {{ $followUp->lead->company_name }}
                                    </p>

                                </td>


                                <td class="px-6 py-5">

                                    <span class="inline-flex bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ \Carbon\Carbon::parse($followUp->follow_up_date)->format('d M Y') }}
                                    </span>

                                </td>


                                <td class="px-6 py-5 text-slate-600 max-w-md">

                                    {{ $followUp->notes ?? 'No notes' }}

                                </td>


                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('follow-ups.edit', $followUp->id) }}"
                                           class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                                            Edit
                                        </a>


                                        <form action="{{ route('follow-ups.destroy', $followUp->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this follow-up?')"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-6 py-12 text-center">

                                    <div class="text-4xl mb-3">
                                        📅
                                    </div>

                                    <p class="text-lg font-semibold text-slate-700">
                                        No upcoming follow-ups
                                    </p>

                                    <p class="text-slate-500 mt-1">
                                        There are currently no upcoming follow-ups.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- Overdue Follow-ups -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <div class="flex items-center justify-between">

                    <div>
                        <h3 class="text-xl font-bold text-slate-800">
                            Overdue Follow-ups
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Follow-ups whose scheduled date has already passed.
                        </p>
                    </div>

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $overdueFollowUps->count() }}
                    </span>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-red-50">

                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Lead
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Follow-up Date
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                Notes
                            </th>

                            <th class="px-6 py-4 text-center text-sm font-semibold text-slate-600">
                                Actions
                            </th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200">

                        @forelse ($overdueFollowUps as $followUp)

                            <tr class="hover:bg-red-50 transition">

                                <td class="px-6 py-5">

                                    <p class="font-semibold text-slate-800">
                                        {{ $followUp->lead->lead_name }}
                                    </p>

                                    <p class="text-sm text-slate-500">
                                        {{ $followUp->lead->company_name }}
                                    </p>

                                </td>


                                <td class="px-6 py-5">

                                    <span class="inline-flex bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ \Carbon\Carbon::parse($followUp->follow_up_date)->format('d M Y') }}
                                    </span>

                                </td>


                                <td class="px-6 py-5 text-slate-600 max-w-md">

                                    {{ $followUp->notes ?? 'No notes' }}

                                </td>


                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('follow-ups.edit', $followUp->id) }}"
                                           class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                                            Edit
                                        </a>


                                        <form action="{{ route('follow-ups.destroy', $followUp->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this follow-up?')"
                                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-6 py-12 text-center">

                                    <div class="text-4xl mb-3">
                                        ✓
                                    </div>

                                    <p class="text-lg font-semibold text-slate-700">
                                        No overdue follow-ups
                                    </p>

                                    <p class="text-slate-500 mt-1">
                                        All follow-ups are currently on schedule.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- Back to Leads -->
        <div class="mt-8">

            <a href="{{ route('leads.index') }}"
               class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to Leads
            </a>

        </div>

    </div>

</body>
</html>