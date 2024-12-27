<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Списък с часове') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Линк за добавяне на нов час -->
                    <div class="mb-4">
                        <a href="{{ route('appointments.create') }}"
                           class="px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-green-700 shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                            Добавяне на нов час
                        </a>
                    </div>

                    <!-- Филтри за търсене -->
                    <form method="GET" action="{{ route('appointments.index') }}" class="mb-6 space-y-4">
                        <div class="flex space-x-4">
                            <div>
                                <label for="from_date" class="block text-sm font-medium text-gray-700">От дата</label>
                                <input type="date" name="from_date" id="from_date"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="to_date" class="block text-sm font-medium text-gray-700">До дата</label>
                                <input type="date" name="to_date" id="to_date"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="egn" class="block text-sm font-medium text-gray-700">ЕГН</label>
                                <input type="text" name="egn" id="egn"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-green-700 shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                                Филтрирай
                            </button>
                        </div>
                    </form>

                    <!-- Таблица с часове -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата и час</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Клиент</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ЕГН</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Нотификация</th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->appointment_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->client_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->egn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->notification_method->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-900">Детайли</a>
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Редактиране</a>
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Изтриване</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Пагинация -->
                    <div class="mt-6">
                        {{ $appointments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
