<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактиране на час') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700">Дата и час</label>
                            <input type="datetime-local" name="appointment_date" id="appointment_date" required
                                   value="{{ old('appointment_date', $appointment->appointment_date) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('appointment_date') border-red-500 @enderror">

                            @error('appointment_date')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700">Имена на клиента</label>
                            <input type="text" name="client_name" id="client_name" required
                                   value="{{ old('client_name', $appointment->client_name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('client_name') border-red-500 @enderror">

                            @error('client_name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="egn" class="block text-sm font-medium text-gray-700">ЕГН</label>
                            <input type="text" name="egn" id="egn" required
                                   value="{{ old('egn', $appointment->egn) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('egn') border-red-500 @enderror">

                            @error('egn')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $appointment->description) }}</textarea>

                            @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="notification_method" class="block text-sm font-medium text-gray-700">Метод за уведомление</label>
                            <select name="notification_method" id="notification_method" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('notification_method') border-red-500 @enderror">
                                <option value="SMS" {{ old('notification_method', $appointment->notification_method) == 'SMS' ? 'selected' : '' }}>SMS</option>
                                <option value="Email" {{ old('notification_method', $appointment->notification_method) == 'Email' ? 'selected' : '' }}>Email</option>
                            </select>

                            @error('notification_method')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-green-700 shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                                Обнови
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
