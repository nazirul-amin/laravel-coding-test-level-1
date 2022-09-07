<script setup>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeInputError from '@/Components/InputError.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeButton from '@/Components/Button.vue';
    import { ref, onMounted } from 'vue'

    const props = defineProps({
        event: Object,
    })

    const form = useForm({
        name: props.event.name,
        slug: props.event.slug,
    });

    const submit = () => {
        form.patch(route('events.update', props.event.id), {
            onFinish: () => form.reset(),
        });
    };
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Show Event" />

        <div class="mx-auto">
            <div class="mt-8 overflow-hidden bg-white shadow sm:rounded-lg">
                <form @submit.prevent="submit" class="p-8 w-96">
                    <div>
                        <BreezeLabel for="name" value="Name" class="mx-2" />
                        <BreezeInput id="name" type="text" class="block w-full m-2" v-model="form.name" required autofocus />
                        <BreezeInputError class="mx-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="slug" value="Slug" class="mx-2" />
                        <BreezeInput id="slug" type="text" class="block w-full m-2" v-model="form.slug" required />
                        <BreezeInputError class="mx-2" :message="form.errors.slug" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            UPDATE
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
