<x-layouts.admin :title="__('admin.students.create')">

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <x-admin.ui.input name="name" label="Name" required />
            <x-admin.ui.input name="email" label="Email" required />

            <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('students.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Create
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>