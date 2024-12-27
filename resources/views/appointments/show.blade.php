<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Детайли за часа') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Основни данни за часа -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Информация за часа</h3>
                        <dl class="mt-4 space-y-2">
                            <div>
                                <dt class="font-medium text-gray-700">Дата и час:</dt>
                                <dd class="text-gray-900">{{ $appointment->appointment_date }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">Клиент:</dt>
                                <dd class="text-gray-900">{{ $appointment->client_name }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">ЕГН:</dt>
                                <dd class="text-gray-900">{{ $appointment->egn }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">Описание:</dt>
                                <dd class="text-gray-900">{{ $appointment->description ?? 'Няма' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">Метод за уведомление:</dt>
                                <dd class="text-gray-900">{{ $appointment->notification_method->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">Потребител:</dt>
                                <dd class="text-gray-900">{{ $appointment->user->name }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Други предстоящи часове за същия клиент -->
                    @if ($otherAppointments->count() > 0)
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Други предстоящи часове за този клиент</h3>
                            <ul class="mt-4 space-y-2">
                                @foreach ($otherAppointments as $other)
                                    <li class="text-gray-900">
                                        {{ $other->appointment_date }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-gray-700">Няма други предстоящи часове за този клиент.</p>
                @endif

                <!-- Бутони за редакция и изтриване -->
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                           class="px-4 py-2 bg-green-500 text-black font-semibold rounded-lg border border-green-700 shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                            Редактирай
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-black font-semibold rounded-lg border border-red-700 shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                Изтрий
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
