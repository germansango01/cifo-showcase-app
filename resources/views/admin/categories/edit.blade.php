<x-layouts.admin :title="__('admin.categories.edit')">

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf @method('PATCH')

            <x-admin.ui.input
                name="icon"
                label="Icon"
                icon="icofont-ui-image"
                :value="$category->icon"
                required />

            <input type="text" name="name[es]"
                   value="{{ old('name.es', $category->getTranslation('name','es')) }}"
                   class="input input-bordered w-full mb-2">

            <input type="text" name="name[ca]"
                   value="{{ old('name.ca', $category->getTranslation('name','ca')) }}"
                   class="input input-bordered w-full">

            <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('categories.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Save
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>