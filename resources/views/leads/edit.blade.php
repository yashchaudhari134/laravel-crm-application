```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lead | CRM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">CRM</h1>
                <p class="text-slate-400 text-xs">
                    Customer Relationship Management
                </p>
            </div>

            <a href="{{ route('leads.index') }}"
               class="text-sm text-slate-300 hover:text-white transition">
                ← Back to Leads
            </a>

        </div>
    </nav>


    <!-- Main -->
    <main class="max-w-5xl mx-auto px-6 py-8">

        <!-- Page Header -->
        <div class="mb-8">

            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wide">
                Lead Management
            </p>

            <h2 class="text-3xl font-bold text-slate-900 mt-1">
                Edit Lead
            </h2>

            <p class="text-slate-500 mt-1">
                Update the information and status of this lead.
            </p>

        </div>


        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-6">

                <div class="flex items-center mb-3">

                    <span class="text-red-600 text-xl mr-2">
                        ⚠
                    </span>

                    <h3 class="font-semibold text-red-700">
                        Please fix the following errors:
                    </h3>

                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">

            <form action="{{ route('leads.update', $lead->id) }}" method="POST">

                @csrf
                @method('PUT')


                <!-- Basic Information -->
                <div class="mb-8">

                    <h3 class="text-lg font-bold text-slate-900 mb-1">
                        Basic Information
                    </h3>

                    <p class="text-sm text-slate-500 mb-5">
                        Update the lead and company details.
                    </p>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Lead Name -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Lead Name
                            </label>

                            <input
                                type="text"
                                name="lead_name"
                                value="{{ old('lead_name', $lead->lead_name) }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            >

                        </div>


                        <!-- Company -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Company Name
                            </label>

                            <input
                                type="text"
                                name="company_name"
                                value="{{ old('company_name', $lead->company_name) }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            >

                        </div>


                        <!-- Email -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $lead->email) }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            >

                        </div>


                        <!-- Phone -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', $lead->phone) }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            >

                        </div>

                    </div>

                </div>


                <!-- Lead Management -->
                <div class="mb-8 pt-6 border-t border-slate-200">

                    <h3 class="text-lg font-bold text-slate-900 mb-1">
                        Lead Management
                    </h3>

                    <p class="text-sm text-slate-500 mb-5">
                        Manage the source, status and salesperson.
                    </p>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Lead Source -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Lead Source
                            </label>

                            <select
                                name="lead_source_id"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                                @foreach ($leadSources as $source)

                                    <option
                                        value="{{ $source->id }}"
                                        {{ old('lead_source_id', $lead->lead_source_id) == $source->id ? 'selected' : '' }}>
                                        {{ $source->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- Status -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                                @foreach (['New', 'Contacted', 'Follow-up', 'Qualified', 'Proposal Sent', 'Won', 'Lost'] as $status)

                                    <option
                                        value="{{ $status }}"
                                        {{ old('status', $lead->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- Salesperson -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Assigned Salesperson
                            </label>

                            <select
                                name="assigned_salesperson_id"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">

                                <option value="">
                                    Select Salesperson
                                </option>

                                @foreach ($salespeople as $salesperson)

                                    <option
                                        value="{{ $salesperson->id }}"
                                        {{ old('assigned_salesperson_id', $lead->assigned_salesperson_id) == $salesperson->id ? 'selected' : '' }}>
                                        {{ $salesperson->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- Deal Value -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Expected Deal Value
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-3 text-slate-400">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="expected_deal_value"
                                    step="0.01"
                                    value="{{ old('expected_deal_value', $lead->expected_deal_value) }}"
                                    class="w-full border border-slate-300 rounded-xl pl-9 pr-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                                >

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Follow-up -->
                <div class="mb-8 pt-6 border-t border-slate-200">

                    <h3 class="text-lg font-bold text-slate-900 mb-1">
                        Follow-up
                    </h3>

                    <p class="text-sm text-slate-500 mb-5">
                        Update the follow-up date and notes.
                    </p>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Follow-up Date -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Follow-up Date
                            </label>

                            <input
                                type="date"
                                name="follow_up_date"
                                value="{{ old('follow_up_date', $lead->follow_up_date) }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            >

                        </div>


                        <!-- Notes -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Notes
                            </label>

                            <textarea
                                name="notes"
                                rows="4"
                                class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">{{ old('notes', $lead->notes) }}</textarea>

                        </div>

                    </div>

                </div>


                <!-- Buttons -->
                <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:justify-end">

                    <a
                        href="{{ route('leads.index') }}"
                        class="text-center border border-slate-300 bg-white text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-50 transition">

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-7 py-3 rounded-xl font-semibold shadow-sm hover:bg-blue-700 hover:shadow-md transition">

                        Update Lead

                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>
```
