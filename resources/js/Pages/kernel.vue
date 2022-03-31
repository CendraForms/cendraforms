<template>
    <!-- todo -> this file is temporal, delete it when functionality is done -->
    <button
        class="bg-red-600 p-5 m-3 border-2 border-black"
        v-text="`Kernel`"
        @click="Inertia.post('/kernel', { form: form })"
    />
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const form = ref({
    id: null,
    name: "random form name",
    description: "random description",
    published: false,
    sections: [
        {
            id: null,
            name: "random section name",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "random question name",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },
    ],
    roles: {
        edit: [
            {
                id: 0,
                name: "Professor",
                deleted: false,
            },
        ],
        answer: [
            {
                id: 1,
                name: "DAW",
                deleted: false,
            },

            {
                id: 2,
                name: "SMX",
                deleted: false,
            },
        ],
    },
});
</script>
