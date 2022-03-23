<template>
    <form @submit.prevent="submit">
        <button type="submit" class="bg-red-600 p-5 m-3 border-2 border-black">Kernel</button>
    </form>
</template>

<script setup>
    import { ref } from 'vue'
    import { Inertia } from '@inertiajs/inertia'

    const form = ref({
        id: null,
        name: 'Avaluació DAW2 curs 2021-22',
        description: 'Un formulari per avaluar totes les assignatures de DAW2 del curs 2021-22',
        sections: [
            {
            id: 1,
            name: 'DAW2_MP_02 - Bases de dades',
            visible: true,
            collapsed: true,
            locked: true,
            deleted: false,
            questions: [
                {
                id: 1,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: 2,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },

            {
            id: 2,
            name: 'DAW2_MP_03 - Programació',
            visible: true,
            collapsed: true,
            locked: true,
            deleted: false,
            questions: [
                {
                id: 3,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: 4,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },

            {
            id: 3,
            name: 'DAW2_MP_05 - Entorn de desenvolupament',
            visible: true,
            collapsed: true,
            locked: true,
            deleted: false,
            questions: [
                {
                id: 5,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: 6,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },

            {
            id: 4,
            name: 'DAW2_MP_06 - Desenvolupament web en entorn de client',
            visible: true,
            collapsed: true,
            locked: true,
            deleted: false,
            questions: [
                {
                id: 7,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: 8,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },

            {
            id: 5,
            name: 'DAW2_MP_08 - Desplegament d\'aplicacions web',
            visible: true,
            collapsed: false,
            locked: false,
            deleted: false,
            questions: [
                {
                id: null,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: null,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },

            {
            id: 6,
            name: 'DAW2_MP_09 - Disseny d\'interfícies web',
            visible: true,
            collapsed: true,
            locked: true,
            deleted: false,
            questions: [
                {
                id: 9,
                name: 'Què és el que més t\'ha agradat?',
                type: 'text',
                visible: true,
                deleted: false,
                content: {},
                },

                {
                id: 10,
                name: 'Què és el que menys t\'ha agradat?',
                type: 'number',
                visible: true,
                deleted: false,
                content: {
                    min: 0,
                    max: 10,
                },
                },
            ],
            },
        ]
    })

    function submit() {
        Inertia.post('/kernel', {
            form: form.value
        })
    }
</script>
