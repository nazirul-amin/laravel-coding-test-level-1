<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';

    const props = defineProps({
        event: Object,
    })
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Show Event" />

        <div class="mx-auto">
            <div class="mt-8 overflow-hidden bg-white shadow sm:rounded-lg">
                <form @submit.prevent="submit" class="p-8 w-96">
                    <div>
                        <BreezeLabel for="name" value="Name" class="mx-2" />
                        <BreezeInput id="name" type="text" class="block w-full m-2" :value="props.event.name" readonly />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="slug" value="Slug" class="mx-2" />
                        <BreezeInput id="slug" type="text" class="block w-full m-2" :value="props.event.slug" readonly />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="created_at" value="Created At" class="mx-2" />
                        <BreezeInput id="created_at" type="text" class="block w-full m-2" :value="props.event.created_at" readonly />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="updated_at" value="Updated At" class="mx-2" />
                        <BreezeInput id="updated_at" type="text" class="block w-full m-2" :value="props.event.updated_at" readonly />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link :href="route('events.edit', props.event.id)" class="ml-4">
                            EDIT
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
