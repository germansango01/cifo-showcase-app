<x-layouts.admin :title="__('admin.teachers.edit')">

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('teachers.update', $teacher) }}">
            @csrf @method('PATCH')

            <x-admin.ui.input name="name" :value="$teacher->name" required />
            <x-admin.ui.input name="email" :value="$teacher->email" required />

            <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('teachers.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Save
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>