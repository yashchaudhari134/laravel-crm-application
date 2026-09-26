```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads | CRM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen">

    <!-- Top Navigation -->
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold tracking-wide">
                    CRM
                </h1>
                <p class="text-slate-400 text-xs">
                    Customer Relationship Management
                </p>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-300">
                    Leads
                </span>

                <a href="{{ route('follow-ups.index') }}"
                   class="text-sm text-slate-300 hover:text-white transition">
                    Follow-ups
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="text-sm text-slate-300 hover:text-white transition">
                    Profile
                </a>
            </div>

        </div>
    </nav>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <p class="text-blue-600 font-semibold text-sm uppercase tracking-wide">
                    Sales Management
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-1">
                    Leads
                </h2>

                <p class="text-slate-500 mt-1">
                    Manage, track and follow up with your potential customers.
                </p>
            </div>

            <a href="{{ route('leads.create') }}"
               class="inline-flex items-center justify-center bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg transition">

                <span class="text-xl mr-2">+</span>
                Add New Lead

            </a>

        </div>


        <!-- Success Message -->
        @if (session('success'))

            <div class="flex items-center bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl mb-6 shadow-sm">

                <span class="text-lg mr-3">✓</span>

                <span class="font-medium">
                    {{ session('success') }}
                </span>

            </div>

        @endif


        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

            <!-- Total Leads -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200 hover:shadow-md transition">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-sm text-slate-500">
                            Total Leads
                        </p>

                        <p class="text-3xl font-bold text-slate-900 mt-2">
                            {{ $leads->count() }}
                        </p>
                    </div>

                    <div class="bg-blue-100 text-blue-600 rounded-xl p-3 text-xl">
                        👥
                    </div>

                </div>

            </div>


            <!-- New Leads -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200 hover:shadow-md transition">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-sm text-slate-500">
                            New Leads
                        </p>

                        <p class="text-3xl font-bold text-slate-900 mt-2">
                            {{ $leads->where('status', 'New')->count() }}
                        </p>
                    </div>

                    <div class="bg-indigo-100 text-indigo-600 rounded-xl p-3 text-xl">
                        ✨
                    </div>

                </div>

            </div>


            <!-- Qualified -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200 hover:shadow-md transition">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-sm text-slate-500">
                            Qualified
                        </p>

                        <p class="text-3xl font-bold text-slate-900 mt-2">
                            {{ $leads->where('status', 'Qualified')->count() }}
                        </p>
                    </div>

                    <div class="bg-green-100 text-green-600 rounded-xl p-3 text-xl">
                        ✓
                    </div>

                </div>

            </div>


            <!-- Won -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200 hover:shadow-md transition">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-sm text-slate-500">
                            Won
                        </p>

                        <p class="text-3xl font-bold text-slate-900 mt-2">
                            {{ $leads->where('status', 'Won')->count() }}
                        </p>
                    </div>

                    <div class="bg-emerald-100 text-emerald-600 rounded-xl p-3 text-xl">
                        ★
                    </div>

                </div>

            </div>

        </div>


        <!-- Search & Filters -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="text-lg font-bold text-slate-900">
                        Search & Filters
                    </h3>

                    <p class="text-sm text-slate-500">
                        Find leads quickly using the options below.
                    </p>
                </div>

            </div>


            <form action="{{ route('leads.index') }}" method="GET">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Search -->
                    <div class="lg:col-span-1">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            placeholder="Lead, company or phone"
                            value="{{ request('search') }}"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                        >

                    </div>


                    <!-- Status -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                            <option value="">All Statuses</option>

                            <option value="New" {{ request('status') == 'New' ? 'selected' : '' }}>
                                New
                            </option>

                            <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>
                                Contacted
                            </option>

                            <option value="Follow-up" {{ request('status') == 'Follow-up' ? 'selected' : '' }}>
                                Follow-up
                            </option>

                            <option value="Qualified" {{ request('status') == 'Qualified' ? 'selected' : '' }}>
                                Qualified
                            </option>

                            <option value="Proposal Sent" {{ request('status') == 'Proposal Sent' ? 'selected' : '' }}>
                                Proposal Sent
                            </option>

                            <option value="Won" {{ request('status') == 'Won' ? 'selected' : '' }}>
                                Won
                            </option>

                            <option value="Lost" {{ request('status') == 'Lost' ? 'selected' : '' }}>
                                Lost
                            </option>

                        </select>

                    </div>


                    <!-- Lead Source -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Lead Source
                        </label>

                        <select
                            name="lead_source_id"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                            <option value="">All Sources</option>

                            @foreach ($leadSources as $source)

                                <option value="{{ $source->id }}"
                                    {{ request('lead_source_id') == $source->id ? 'selected' : '' }}>
                                    {{ $source->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Salesperson -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Salesperson
                        </label>

                        <select
                            name="assigned_salesperson_id"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                            <option value="">All Salespeople</option>

                            @foreach ($salespeople as $salesperson)

                                <option value="{{ $salesperson->id }}"
                                    {{ request('assigned_salesperson_id') == $salesperson->id ? 'selected' : '' }}>
                                    {{ $salesperson->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3 mt-5">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 shadow-sm hover:shadow-md transition">

                        Search / Filter

                    </button>

                    <a
                        href="{{ route('leads.index') }}"
                        class="border border-slate-300 bg-white text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-50 transition">

                        Clear Filters

                    </a>

                </div>

            </form>

        </div>


        <!-- Leads Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <!-- Table Header -->
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center">

                <div>
                    <h3 class="text-lg font-bold text-slate-900">
                        All Leads
                    </h3>

                    <p class="text-sm text-slate-500">
                        {{ $leads->count() }} lead(s) found
                    </p>
                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Lead
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Company
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Contact
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Source
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Salesperson
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Deal Value
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Follow-up
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-slate-600">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($leads as $lead)

                            <tr class="hover:bg-slate-50 transition">

                                <!-- Lead -->
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-slate-900">
                                        {{ $lead->lead_name }}
                                    </div>

                                    <div class="text-xs text-slate-400 mt-1">
                                        ID #{{ $lead->id }}
                                    </div>

                                </td>


                                <!-- Company -->
                                <td class="px-6 py-5">

                                    <span class="text-slate-700">
                                        {{ $lead->company_name }}
                                    </span>

                                </td>


                                <!-- Contact -->
                                <td class="px-6 py-5">

                                    <div class="text-slate-700">
                                        {{ $lead->email ?? 'No email' }}
                                    </div>

                                    <div class="text-xs text-slate-400 mt-1">
                                        {{ $lead->phone }}
                                    </div>

                                </td>


                                <!-- Source -->
                                <td class="px-6 py-5">

                                    {{ $lead->leadSource->name ?? 'N/A' }}

                                </td>


                                <!-- Status -->
                                <td class="px-6 py-5">

                                    @if ($lead->status == 'New')

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            New
                                        </span>

                                    @elseif ($lead->status == 'Contacted')

                                        <span class="bg-purple-100 text-purple-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Contacted
                                        </span>

                                    @elseif ($lead->status == 'Follow-up')

                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Follow-up
                                        </span>

                                    @elseif ($lead->status == 'Qualified')

                                        <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Qualified
                                        </span>

                                    @elseif ($lead->status == 'Proposal Sent')

                                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Proposal Sent
                                        </span>

                                    @elseif ($lead->status == 'Won')

                                        <span class="bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Won
                                        </span>

                                    @elseif ($lead->status == 'Lost')

                                        <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                            Lost
                                        </span>

                                    @endif

                                </td>


                                <!-- Salesperson -->
                                <td class="px-6 py-5">

                                    {{ $lead->assignedSalesperson->name ?? 'Not Assigned' }}

                                </td>


                                <!-- Deal Value -->
                                <td class="px-6 py-5">

                                    <span class="font-semibold text-slate-900">
                                        ₹{{ number_format($lead->expected_deal_value, 2) }}
                                    </span>

                                </td>


                                <!-- Follow-up -->
                                <td class="px-6 py-5">

                                    @if ($lead->follow_up_date)

                                        <span class="text-slate-700">
                                            {{ $lead->follow_up_date }}
                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            Not Set
                                        </span>

                                    @endif

                                </td>


                                <!-- Actions -->
                                <td class="px-6 py-5 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a
                                            href="{{ route('leads.show', $lead->id) }}"
                                            class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">

                                            View

                                        </a>


                                        <a
                                            href="{{ route('leads.edit', $lead->id) }}"
                                            class="bg-green-50 text-green-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-green-100 transition">

                                            Edit

                                        </a>


                                        <form
                                            action="{{ route('leads.destroy', $lead->id) }}"
                                            method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-100 transition">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="px-6 py-12 text-center">

                                    <div class="text-4xl mb-3">
                                        📋
                                    </div>

                                    <p class="text-lg font-semibold text-slate-700">
                                        No leads found
                                    </p>

                                    <p class="text-sm text-slate-400 mt-1">
                                        Try changing your filters or add a new lead.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>
```
