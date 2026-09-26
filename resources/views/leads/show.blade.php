<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Details</title>

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
                   class="hover:text-blue-400 transition">
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
    <div class="max-w-5xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    Lead Details
                </h2>

                <p class="text-slate-500 mt-1">
                    View complete information about this lead.
                </p>
            </div>

            <div class="flex gap-3">

                <a href="{{ route('leads.edit', $lead->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium transition">
                    Edit Lead
                </a>

                <a href="{{ route('leads.index') }}"
                   class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-2.5 rounded-lg font-medium transition">
                    Back to Leads
                </a>

            </div>

        </div>


        <!-- Lead Information Card -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            <!-- Card Header -->
            <div class="bg-slate-800 text-white px-6 py-5">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                    <div>
                        <h3 class="text-2xl font-bold">
                            {{ $lead->lead_name }}
                        </h3>

                        <p class="text-slate-300 mt-1">
                            {{ $lead->company_name }}
                        </p>
                    </div>

                    <!-- Status -->
                    <span class="inline-flex w-fit px-4 py-2 rounded-full text-sm font-semibold
                        @if($lead->status === 'New')
                            bg-blue-100 text-blue-700
                        @elseif($lead->status === 'Contacted')
                            bg-yellow-100 text-yellow-700
                        @elseif($lead->status === 'Follow-up')
                            bg-purple-100 text-purple-700
                        @elseif($lead->status === 'Qualified')
                            bg-green-100 text-green-700
                        @elseif($lead->status === 'Proposal Sent')
                            bg-indigo-100 text-indigo-700
                        @elseif($lead->status === 'Won')
                            bg-emerald-100 text-emerald-700
                        @else
                            bg-red-100 text-red-700
                        @endif">

                        {{ $lead->status }}

                    </span>

                </div>

            </div>


            <!-- Details -->
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Contact Information -->
                    <div class="border border-slate-200 rounded-xl p-5">

                        <h4 class="text-lg font-semibold text-slate-800 mb-4">
                            Contact Information
                        </h4>

                        <div class="space-y-4">

                            <div>
                                <p class="text-sm text-slate-500">Email</p>
                                <p class="font-medium text-slate-800">
                                    {{ $lead->email ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Phone</p>
                                <p class="font-medium text-slate-800">
                                    {{ $lead->phone }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Lead Source</p>
                                <p class="font-medium text-slate-800">
                                    {{ $lead->leadSource->name ?? 'N/A' }}
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- Lead Management -->
                    <div class="border border-slate-200 rounded-xl p-5">

                        <h4 class="text-lg font-semibold text-slate-800 mb-4">
                            Lead Management
                        </h4>

                        <div class="space-y-4">

                            <div>
                                <p class="text-sm text-slate-500">
                                    Assigned Salesperson
                                </p>

                                <p class="font-medium text-slate-800">
                                    {{ $lead->assignedSalesperson->name ?? 'Not Assigned' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Expected Deal Value
                                </p>

                                <p class="text-xl font-bold text-green-600">
                                    ₹{{ number_format($lead->expected_deal_value, 2) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Follow-up Date
                                </p>

                                <p class="font-medium text-slate-800">
                                    {{ $lead->follow_up_date ?? 'Not Set' }}
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- Notes -->
                    <div class="md:col-span-2 border border-slate-200 rounded-xl p-5">

                        <h4 class="text-lg font-semibold text-slate-800 mb-3">
                            Notes
                        </h4>

                        <p class="text-slate-600 leading-relaxed">
                            {{ $lead->notes ?? 'No notes available.' }}
                        </p>

                    </div>


                    <!-- Created / Updated -->
                    <div class="md:col-span-2 bg-slate-50 rounded-xl p-5">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <p class="text-sm text-slate-500">
                                    Created At
                                </p>

                                <p class="font-medium text-slate-700">
                                    {{ $lead->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Last Updated
                                </p>

                                <p class="font-medium text-slate-700">
                                    {{ $lead->updated_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>