<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="bg-red-600 p-5 m-3 border-2 border-black"
            v-text="`Kernel`"
        />
    </form>
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const form = ref({
    id: null,
    name: "Avaluació DAW2 curs 2021-22",
    description:
        "Un formulari per avaluar totes les assignatures de DAW2 del curs 2021-22",
    published: false,
    sections: [
        {
            id: null,
            name: "DAW2_MP_02 - Bases de dades",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },

        {
            id: null,
            name: "DAW2_MP_03 - Programació",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },

        {
            id: null,
            name: "DAW2_MP_05 - Entorn de desenvolupament",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },

        {
            id: null,
            name: "DAW2_MP_06 - Desenvolupament web en entorn de client",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },

        {
            id: null,
            name: "DAW2_MP_08 - Desplegament d'aplicacions web",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },

        {
            id: null,
            name: "DAW2_MP_09 - Disseny d'interfícies web",
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                    id: null,
                    name: "Què és el que més t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },

                {
                    id: null,
                    name: "Què és el que menys t'ha agradat?",
                    type: "text",
                    visible: true,
                    deleted: false,
                    content: {},
                },
            ],
        },
    ],
});

function submit() {
    Inertia.post("/kernel", { form: form.value });
}

// todo -> this file is temporal, delete it when functionality is done
</script>
