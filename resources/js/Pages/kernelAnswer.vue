<template>
    <!-- todo -> this file is temporal, delete it when functionality is done -->
    <button
        class="bg-red-600 p-5 m-3 border-2 border-black"
        v-text="`Answer form`"
        @click="Inertia.post('/kernel/answer', { form: form })"
    />
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const form = ref({
    id: 1,
    name: "random form name",
    description: "random description",
    published: false,
    anonymized: true,
    sections: [
        {
            id: 1,
            name: "random section name",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: 1,
                    name: "Quin àmbit prefereixes?",
                    type: "switch",
                    content: {
                        left: {
                            text: "frontend",
                            selected: false,
                            defaultVal: false,
                        },
                        right: {
                            text: "backend",
                            selected: false,
                            defaultVal: true,
                        },
                    },
                    answer: "backend",
                },

                {
                    id: 2,
                    name: "Fruita, verdura o xocolata?",
                    type: "radio",
                    content: {
                        options: [
                            {
                                text: "fruita",
                                selected: false,
                            },

                            {
                                text: "verdura",
                                selected: false,
                            },

                            {
                                text: "xocolata",
                                selected: false,
                            },
                        ],
                    },
                    answer: "xocolata",
                },
            ],
        },
    ],
});
</script>
