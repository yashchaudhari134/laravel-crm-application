<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Follow-up</title>

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
    <div class="max-w-3xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="mb-8">

            <h2 class="text-3xl font-bold text-slate-800">
                Edit Follow-up
            </h2>

            <p class="text-slate-500 mt-1">
                Update the follow-up information.
            </p>

        </div>


        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-5">

                <h3 class="font-semibold text-red-700 mb-2">
                    Please fix the following errors:
                </h3>

                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-md p-8">

            <form action="{{ route('follow-ups.update', $followUp->id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                <!-- Lead -->
                <div class="mb-6">

                    <label for="lead_id"
                           class="block text-sm font-semibold text-slate-700 mb-2">

                        Lead

                    </label>

                    <select name="lead_id"
                            id="lead_id"
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        @foreach ($leads as $lead)

                            <option value="{{ $lead->id }}"
                                {{ old('lead_id', $followUp->lead_id) == $lead->id ? 'selected' : '' }}>

                                {{ $lead->lead_name }} - {{ $lead->company_name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Follow-up Date -->
                <div class="mb-6">

                    <label for="follow_up_date"
                           class="block text-sm font-semibold text-slate-700 mb-2">

                        Follow-up Date

                    </label>

                    <input type="date"
                           name="follow_up_date"
                           id="follow_up_date"
                           value="{{ old('follow_up_date', $followUp->follow_up_date) }}"
                           class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                </div>


                <!-- Notes -->
                <div class="mb-8">

                    <label for="notes"
                           class="block text-sm font-semibold text-slate-700 mb-2">

                        Notes

                    </label>

                    <textarea name="notes"
                              id="notes"
                              rows="5"
                              placeholder="Enter follow-up notes..."
                              class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none">{{ old('notes', $followUp->notes) }}</textarea>

                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('follow-ups.index') }}"
                       class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-lg font-medium transition">

                        Cancel

                    </a>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">

                        Update Follow-up

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>