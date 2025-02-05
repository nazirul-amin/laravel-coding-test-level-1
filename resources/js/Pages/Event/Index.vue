<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { ref, onMounted } from 'vue'

    const props = defineProps({
        events: Object,
        can: Boolean,
        catsFact: String,
    })

    const fact = ref();

    onMounted(() => {
        fact.value = (JSON.parse(props.catsFact)).data[0];
    })

    function deleteEvent(id){
        if(confirm("Are you sure?")){
            Inertia.visit(route('events.destroy', id), { method: 'delete' });
        }
    }
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Events" />

        <div class="p-8 mx-auto">
            <div v-if="props.catsFact" class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ fact }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            <div class="flex justify-end mt-8 overflow-hidden">
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <Link v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</Link>

                    <template v-else>
                        <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                        <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
                    </template>
                </div>
                <Link v-if="can" :href="route('events.create')" class="inline-flex items-center px-4 py-2 mx-2 font-bold text-gray-800 bg-gray-100 rounded hover:bg-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Create</span>
                </Link>
            </div>
            <div class="mt-8 overflow-hidden bg-white shadow sm:rounded-lg">
                <table class="m-5 table-auto">
                    <thead>
                        <tr class="content-center m-2">
                            <th>ID</th>
                            <th class="pl-5">Name</th>
                            <th class="pl-5">Slug</th>
                            <th class="pl-5">Created At</th>
                            <th class="pl-5">Update At</th>
                            <th v-if="can" class="pl-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="event in events" class="content-center m-2">
                            <td class="pl-5">{{ event.id }}</td>
                            <td class="pl-5">{{ event.name }}</td>
                            <td class="pl-5">{{ event.slug }}</td>
                            <td class="pl-5">{{ event.created_at }}</td>
                            <td class="pl-5">{{ event.updated_at }}</td>
                            <td v-if="can" class="flex justify-between pl-5">
                                <Link :href="route('events.show', event.id)" class="inline-flex items-center px-4 py-2 mx-2 font-bold text-gray-800 bg-gray-100 rounded hover:bg-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </Link>
                                <button @click="deleteEvent(event.id)" class="inline-flex items-center px-4 py-2 mx-2 font-bold text-gray-800 bg-gray-100 rounded hover:bg-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
