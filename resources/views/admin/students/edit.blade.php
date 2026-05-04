<x-layouts.admin :title="__('admin.students.edit')">

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf @method('PATCH')

            <x-admin.ui.input name="name" :value="$student->name" required />
            <x-admin.ui.input name="email" :value="$student->email" required />

            <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('students.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Save
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>